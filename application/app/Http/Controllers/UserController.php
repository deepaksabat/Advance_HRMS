<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\AwardList;
use App\Classes\permission;
use App\EmailTemplate;
use App\Employee;
use App\Expense;
use App\Holiday;
use App\JobApplicants;
use App\Jobs;
use App\Leave;
use App\Notice;
use App\SupportTickets;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;

date_default_timezone_set(app_config('Timezone'));

class UserController extends Controller
{
    /* login  Function Start Here */
    public function login()
    {
        if (\Auth::check()) {
            if(\Auth::user()->role_id=='0'){
                return redirect('employee/dashboard');
            }else{
                return redirect('dashboard');
            }
        } else {
            return view('admin.login');
        }
    }

    /* getLogin  Function Start Here */
    public function getLogin(Request $request)
    {
        $this->validate($request, [
            'user_name' => 'required', 'password' => 'required',
        ]);

        $check_input = $request->only('user_name', 'password');


        $remember = (Input::has('remember')) ? true : false;

        if (\Auth::attempt($check_input, $remember)) {

            if(\Auth::user()->role_id=='0'){
                return redirect()->intended('employee/dashboard');
            }else{
                return redirect()->intended('dashboard');
            }
        } else {
            return redirect('/')->withInput($request->only('user_name'))->withErrors([
                'user_name' => language_data('Invalid User Name or Password'),
            ]);
        }
    }

    /* dashboard  Function Start Here */
    public function dashboard()
    {

        $self='dashboard';

        if (\Auth::check()) {

            if (\Auth::user()->role_id==0){
                \Auth::logout();

                return redirect('/')->with([
                    'message'=> language_data('Invalid Access'),
                    'message_important'=>true
                ]);
            }


            if (\Auth::user()->user_name!=='admin'){
                $get_perm=permission::permitted($self);

                if ($get_perm=='access denied'){
                    return redirect('permission-error')->with([
                        'message' => language_data('You do not have permission to view this page'),
                        'message_important'=>true
                    ]);
                }
            }

            $employee=Employee::where('user_name','!=','admin')->count();
            $leave=Leave::where('status','pending')->count();
            $expense=Expense::where('status','Pending')->count();
            $tickets=SupportTickets::where('status','Pending')->count();

            $leave_application=Leave::where('status','pending')->limit(6)->orderBy('id','desc')->get();
            $recent_expense=Expense::where('status','Pending')->limit(6)->orderBy('id','desc')->get();
            $recent_task=Task::limit(6)->orderBy('id','desc')->get();
            $recent_tickets=SupportTickets::where('status','Pending')->limit(6)->orderBy('id','desc')->get();

            $st_pending=SupportTickets::where('status','Pending')->count();
            $st_answered=SupportTickets::where('status','Answered')->count();
            $st_replied=SupportTickets::where('status','Customer Reply')->count();
            $st_closed=SupportTickets::where('status','Closed')->count();

            $expense_json=$recent_expense->toJson();

            $get_expense=Expense::whereRaw('year(`created_at`) = ?', array(date('Y')))->select('amount','purchase_date')->get()->toJson();


            return view('admin.dashboard',compact('employee','leave','expense','tickets','leave_application','recent_expense','recent_task','recent_tickets','expense_json','st_pending','st_closed','st_answered','st_replied', 'get_expense'));
        } else {
            return redirect('/');
        }
    }


    /* employeeDashboard  Function Start Here */
    public function employeeDashboard()
    {
        if (\Auth::check()) {

            if (\Auth::user()->user_name=='admin'){
                \Auth::logout();

                return redirect('/')->with([
                    'message'=> language_data('Invalid Access'),
                    'message_important'=>true
                ]);
            }

            $first_day_this_month = date('Y-m-01');
            $last_day_this_month  = date('Y-m-t');

            $first_day_this_year=date('Y-01-01');
            $last_day_this_year=date('Y-12-31');


            $attendance=Attendance::where('emp_id',\Auth::user()->id)->whereBetween('date',[$first_day_this_month,$last_day_this_month])->count();
            $holiday=Holiday::whereBetween('holiday',[$first_day_this_year,$last_day_this_year])->count();
            $award=AwardList::where('emp_id',\Auth::user()->employee_code)->where('year',date('Y'))->count();

            $recent_notice=Notice::where('status','Published')->orderBy('id','desc')->limit(5)->get();
            $recent_tickets=SupportTickets::where('status','!=','Closed')->where('emp_id',\Auth::user()->id)->orderBy('id','desc')->limit(5)->get();

            $user_info=Employee::find(\Auth::user()->id);

            $clock_state=Attendance::where('date',date('Y-m-d'))->where('emp_id',\Auth::user()->id)->first();

            if($clock_state){
                if($clock_state->clock_status=='Clock In'){
                    $clock_status= language_data('Clock In');
                }else{
                    $clock_status= language_data('Clock Out');
                }
            }else{
                $clock_status= language_data('Clock Out');
            }

            return view('employee.dashboard',compact('user_info','attendance','holiday','award','recent_notice','recent_tickets','clock_state','clock_status'));
        } else {
            return redirect('/');
        }
    }


    /* logout  Function Start Here */
    public function logout()
    {
        \Auth::logout();
        return redirect('/')->with(['message' => language_data('Logout Successfully')]);
    }


    /* editProfile  Function Start Here */
    public function editProfile()
    {
        $employee = _info(\Auth::user()->id);

        return view('admin.edit-profile', compact('employee'));
    }

    /* editEditProfile  Function Start Here */
    public function editEditProfile()
    {
        $employee = _info(\Auth::user()->id);
        return view('employee.edit-profile', compact('employee'));
    }


    /* postUserPersonalInfo  Function Start Here */
    public function postUserPersonalInfo(Request $request)
    {
        $appStage = app_config('AppStage');
        if ($appStage == 'Demo') {
            return redirect('user/edit-profile')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important' => true
            ]);
        }

        $v = \Validator::make($request->all(), [
            'fname' => 'required', 'email' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('user/edit-profile')->withErrors($v->errors());
        }

        $cmd = \Auth::user()->id;
        $employee = Employee::find($cmd);

        $email = Input::get('email');
        $exist_email = $employee->email;
        if ($email != '' AND $email != $exist_email) {
            $exist = Employee::where('email', '=', $email)->first();
            if ($exist) {
                return redirect('user/edit-profile')->with([
                    'message' => language_data('Email Already Exist'),
                    'message_important' => true
                ]);
            }
        }

        $employee->fname = $request->fname;
        $employee->lname = $request->lname;
        $employee->email = $email;
        $employee->phone = $request->phone;
        $employee->save();

        return redirect('user/edit-profile')->with([
            'message' => language_data('Profile Updated Successfully')
        ]);


    }

    /* postEmployeePersonalInfo  Function Start Here */
    public function postEmployeePersonalInfo(Request $request)
    {
        $appStage = app_config('AppStage');
        if ($appStage == 'Demo') {
            return redirect('employee/edit-profile')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important' => true
            ]);
        }

        $v = \Validator::make($request->all(), [
            'fname' => 'required', 'email' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('employee/edit-profile')->withErrors($v->errors());
        }

        $cmd = \Auth::user()->id;
        $employee = Employee::find($cmd);

        $email = Input::get('email');
        $exist_email = $employee->email;
        if ($email != '' AND $email != $exist_email) {
            $exist = Employee::where('email', '=', $email)->first();
            if ($exist) {
                return redirect('employee/edit-profile')->with([
                    'message' => language_data('Email Already Exist'),
                    'message_important' => true
                ]);
            }
        }

        $employee->fname = $request->fname;
        $employee->lname = $request->lname;
        $employee->email = $email;
        $employee->phone = $request->phone;
        $employee->save();

        return redirect('employee/edit-profile')->with([
            'message' => language_data('Profile Updated Successfully')
        ]);


    }

    /* updateUserAvatar  Function Start Here */
    public function updateUserAvatar(Request $request)
    {
        $appStage = app_config('AppStage');
        if ($appStage == 'Demo') {
            return redirect('user/edit-profile')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important' => true
            ]);
        }

        $v = \Validator::make($request->all(), [
            'image' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('user/edit-profile')->withErrors($v->errors());
        }

        $cmd = \Auth::user()->id;
        $image = Input::file('image');
        $employee = Employee::find($cmd);

        if ($employee) {
            if ($image != '') {
                $destinationPath = public_path() . '/assets/employee_pic/';
                $image_name = $image->getClientOriginalName();
                Input::file('image')->move($destinationPath, $image_name);

                $employee->avatar = $image_name;
                $employee->save();

                return redirect('user/edit-profile')->with([
                    'message' => language_data('Avatar Changed Successfully')
                ]);

            } else {
                return redirect('user/edit-profile')->with([
                    'message' => language_data('Upload an Image'),
                    'message_important' => true
                ]);
            }
        } else {
            return $this->logout();
        }
    }

    /* updateEmployeeAvatar  Function Start Here */
    public function updateEmployeeAvatar(Request $request)
    {

        $appStage = app_config('AppStage');
        if ($appStage == 'Demo') {
            return redirect('employee/edit-profile')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important' => true
            ]);
        }

        $v = \Validator::make($request->all(), [
            'image' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('employee/edit-profile')->withErrors($v->errors());
        }

        $cmd = \Auth::user()->id;
        $image = Input::file('image');
        $employee = Employee::find($cmd);

        if ($employee) {
            if ($image != '') {
                $destinationPath = public_path() . '/assets/employee_pic/';
                $image_name = $image->getClientOriginalName();
                Input::file('image')->move($destinationPath, $image_name);

                $employee->avatar = $image_name;
                $employee->save();

                return redirect('employee/edit-profile')->with([
                    'message' => language_data('Avatar Changed Successfully')
                ]);

            } else {
                return redirect('employee/edit-profile')->with([
                    'message' => language_data('Upload an Image'),
                    'message_important' => true
                ]);
            }
        } else {
            return $this->logout();
        }
    }

    /* changePassword  Function Start Here */
    public function changePassword()
    {
        return view('admin.change-password');
    }

    /* changeEmployeePassword  Function Start Here */
    public function changeEmployeePassword()
    {
        return view('employee.change-password');
    }

    /* updateUserPassword  Function Start Here */
    public function updateUserPassword(Request $request)
    {
        $appStage = app_config('AppStage');
        if ($appStage == 'Demo') {
            return redirect('user/change-password')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important' => true
            ]);
        }

        $v = \Validator::make($request->all(), [
            'current_password' => 'required', 'new_password' => 'required', 'confirm_password' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('user/change-password')->withErrors($v->errors());
        }

        $user = Employee::find(\Auth::user()->id);

        $current_password = Input::get('current_password');
        $new_password = Input::get('new_password');
        $confirm_password = Input::get('confirm_password');

        if (\Hash::check($current_password, $user->password)) {

            if ($new_password == $confirm_password) {
                $user->password = bcrypt($new_password);
                $user->save();

                return redirect('user/change-password')->with([
                    'message' => language_data('Password Change Successfully')
                ]);

            } else {
                return redirect('user/change-password')->with([
                    'message' => language_data('Both New Password Does Not Match'),
                    'message_important' => true
                ]);
            }

        } else {
            return redirect('user/change-password')->with([
                'message' => language_data('Current Password Does Not Match'),
                'message_important' => true
            ]);
        }

    }


    /* updateEmployeePassword  Function Start Here */
    public function updateEmployeePassword(Request $request)
    {
        $appStage = app_config('AppStage');
        if ($appStage == 'Demo') {
            return redirect('employee/change-password')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important' => true
            ]);
        }

        $v = \Validator::make($request->all(), [
            'current_password' => 'required', 'new_password' => 'required', 'confirm_password' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('employee/change-password')->withErrors($v->errors());
        }

        $user = Employee::find(\Auth::user()->id);

        $current_password = Input::get('current_password');
        $new_password = Input::get('new_password');
        $confirm_password = Input::get('confirm_password');

        if (\Hash::check($current_password, $user->password)) {

            if ($new_password == $confirm_password) {
                $user->password = bcrypt($new_password);
                $user->save();

                return redirect('employee/change-password')->with([
                    'message' => language_data('Password Change Successfully')
                ]);

            } else {
                return redirect('employee/change-password')->with([
                    'message' => language_data('Both New Password Does Not Match'),
                    'message_important' => true
                ]);
            }

        } else {
            return redirect('employee/change-password')->with([
                'message' => language_data('Current Password Does Not Match'),
                'message_important' => true
            ]);
        }

    }


    /* forgotPassword  Function Start Here */
    public function forgotPassword()
    {
        return view('admin.forgot-password');
    }



    /* forgotPasswordToken  Function Start Here */
    public function forgotPasswordToken(Request $request)
    {

        $appStage=app_config('AppStage');
        if($appStage=='Demo'){
            return redirect('/')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important'=>true
            ]);
        }

        $v=\Validator::make($request->all(),[
            'email'=>'required'
        ]);

        if($v->fails()){
            return redirect('forgot-password')->withErrors($v->errors());
        }

        $email=Input::get('email');

        $d=Employee::where('email','=',$email)->count();
        if($d=='1'){
            $fprand=substr(str_shuffle(str_repeat('0123456789','16')),0,'16');
            $ef=Employee::where('email','=',$email)->first();
            $name=$ef->fname .' '.$ef->lname;
            $username=$ef->user_name;
            $ef->passwordresetkey = $fprand;
            $ef->save();

            $ip=\Request::getClientIp();

            /*For Email Confirmation*/

            $conf = EmailTemplate::where('tplname', '=', 'Forgot Admin Password')->first();

            $estatus=$conf->status;
            if($estatus=='1'){
                $sysEmail = app_config('Email');
                $sysCompany = app_config('AppName');
                $fpw_link = url('forgot-password-token-code/'.$fprand);

                $template = $conf->message;
                $subject = $conf->subject;

                $data = array('name' => $name,
                    'business_name'=> $sysCompany,
                    'username'=> $username,
                    'ip_address'=> $ip,
                    'from'=> $sysEmail,
                    'template'=> $template,
                    'forgotpw_link' => $fpw_link
                );

                $message = _render($template, $data);
                $mail_subject = _render($subject, $data);
                $body = $message;

                /*Set Authentication*/

                $default_gt = app_config('Gateway');

                if ($default_gt == 'default') {

                    $mail = new \PHPMailer();

                    $mail->setFrom($sysEmail, $sysCompany);
                    $mail->addAddress($email,$name);     // Add a recipient
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = $mail_subject;
                    $mail->Body = $body;
                    if (!$mail->send()) {
                        return redirect('forgot-password')->with([
                            'message' => language_data('Please check your email setting')
                        ]);
                    } else {
                        return redirect('forgot-password')->with([
                            'message' => language_data('Password Reset Successfully. Please check your email')
                        ]);
                    }

                }
                else {
                    $host = app_config('SMTPHostName');
                    $smtp_username = app_config('SMTPUserName');
                    $stmp_password = app_config('SMTPPassword');
                    $port = app_config('SMTPPort');
                    $secure = app_config('SMTPSecure');


                    $mail = new \PHPMailer();

                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = $host;  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = $smtp_username;                 // SMTP username
                    $mail->Password = $stmp_password;                           // SMTP password
                    $mail->SMTPSecure = $secure;                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = $port;

                    $mail->setFrom($sysEmail, $sysCompany);
                    $mail->addAddress($email,$name);     // Add a recipient
                    $mail->isHTML(true);                                  // Set email format to HTML

                    $mail->Subject = $mail_subject;
                    $mail->Body = $body;

                    if (!$mail->send()) {
                        return redirect('forgot-password')->with([
                            'message' => language_data('Please check your email setting')
                        ]);
                    } else {
                        return redirect('forgot-password')->with([
                            'message' => language_data('Password Reset Successfully. Please check your email')
                        ]);
                    }

                }
            }

            return redirect('forgot-password')->with([
                'message'=> language_data('Your Password Already Reset. Please Check your email')
            ]);
        }else{
            return redirect('forgot-password')->with([
                'message'=> language_data('Sorry There is no registered user with this email address'),
                'message_important'=>true
            ]);
        }

    }


    /* forgotPasswordTokenCode  Function Start Here */
    public function forgotPasswordTokenCode($token)
    {

        $appStage=app_config('AppStage');
        if($appStage=='Demo'){
            return redirect('/')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important'=>true
            ]);
        }

        $tfnd=Employee::where('passwordresetkey','=',$token)->count();

        if($tfnd=='1'){
            $d=Employee::where('passwordresetkey','=',$token)->first();
            $name=$d->fname .' '.$d->lname;
            $email=$d->email;
            $username=$d->user_name;

            $rawpass=substr(str_shuffle(str_repeat('0123456789','16')),0,'16');
            $password=bcrypt($rawpass);

            $d->password=$password;
            $d->passwordresetkey = '';
            $d->save();

            /*For Email Confirmation*/

            $conf = EmailTemplate::where('tplname', '=', 'Admin Password Reset')->first();

            $estatus=$conf->status;
            if($estatus=='1'){
                $sysEmail = app_config('Email');
                $sysCompany = app_config('AppName');
                $fpw_link = url('/');

                $template = $conf->message;
                $subject = $conf->subject;

                $data = array('name' => $name,
                    'business_name'=> $sysCompany,
                    'username'=> $username,
                    'password'=> $rawpass,
                    'template'=>$template,
                    'sys_url' => $fpw_link
                );

                $message = _render($template, $data);
                $mail_subject = _render($subject, $data);
                $body = $message;

                /*Set Authentication*/

                $default_gt = app_config('Gateway');

                if ($default_gt == 'default') {

                    $mail = new \PHPMailer();

                    $mail->setFrom($sysEmail, $sysCompany);
                    $mail->addAddress($email,$name);     // Add a recipient
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = $mail_subject;
                    $mail->Body = $body;
                    if (!$mail->send()) {
                        return redirect('/')->with([
                            'message' => language_data('Please check your email setting')
                        ]);
                    } else {
                        return redirect('/')->with([
                            'message' => language_data('A New Password Generated. Please Check your email.')
                        ]);
                    }

                }
                else {
                    $host = app_config('SMTPHostName');
                    $smtp_username = app_config('SMTPUserName');
                    $stmp_password = app_config('SMTPPassword');
                    $port = app_config('SMTPPort');
                    $secure = app_config('SMTPSecure');


                    $mail = new \PHPMailer();

                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = $host;  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = $smtp_username;                 // SMTP username
                    $mail->Password = $stmp_password;                           // SMTP password
                    $mail->SMTPSecure = $secure;                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = $port;

                    $mail->setFrom($sysEmail, $sysCompany);
                    $mail->addAddress($email,$name);     // Add a recipient
                    $mail->isHTML(true);                                  // Set email format to HTML

                    $mail->Subject = $mail_subject;
                    $mail->Body = $body;

                    if (!$mail->send()) {
                        return redirect('/')->with([
                            'message' => language_data('Please check your email setting')
                        ]);
                    } else {
                        return redirect('/')->with([
                            'message' => language_data('A New Password Generated. Please Check your email.')
                        ]);
                    }

                }

            }
            return redirect('/')->with([
                'message'=> language_data('A New Password Generated. Please Check your email.')
            ]);
        }else{
            return redirect('/')->with([
                'message'=> language_data('Sorry Password reset Token expired or not exist, Please try again.'),
                'message_important'=>true
            ]);
        }

    }

    /* applyJob  Function Start Here */
    public function applyJob()
    {
        $jobs=Jobs::where('status','opening')->get();
        return view('employee.apply-job',compact('jobs'));

    }

    /* applyJobDetails  Function Start Here */
    public function applyJobDetails($id)
    {
        $job=Jobs::find($id);

        if($job){
            return view('employee.job-details',compact('job'));
        }else{
            return redirect('apply-job')->with([
                'message'=> language_data('Job Details Not found'),
                'message_important'=>true
            ]);
        }

    }

    /* postApplicantResume  Function Start Here */
    public function postApplicantResume(Request $request)
    {
        $cmd=Input::get('cmd');


        $v=\Validator::make($request->all(),[
            'name'=>'required','email'=>'required','phone'=>'required','resume'=>'mimes:'.app_config('JobFileExtension')
        ]);

        if($v->fails()){
            return redirect('apply-job/details/'.$cmd)->withErrors($v->errors());
        }



        $name = Input::get('name');
        $email = Input::get('email');
        $phone = Input::get('phone');
        $resume = Input::file('resume');

        if ($request->hasFile('resume')) {
            $destinationPath = storage_path() . '/app/resume/';
            $resume_name = $resume->getClientOriginalName();
            Input::file('resume')->move($destinationPath, $resume_name);
        } else {
            return redirect('apply-job/details/'.$cmd)->with([
                'message'=> language_data('Please upload your resume'),
                'message_important'=>true
            ]);
        }

        $job_applicant=new JobApplicants();
        $job_applicant->job_id=$cmd;
        $job_applicant->name=$name;
        $job_applicant->email=$email;
        $job_applicant->phone=$phone;
        $job_applicant->status='Unread';
        $job_applicant->resume=$resume_name;
        $job_applicant->save();

        return redirect('apply-job/details/'.$cmd)->with([
            'message'=> language_data('Resume Submitted Successfully')
        ]);

    }

    /* permissionError  Function Start Here */
    public function permissionError()
    {
        return view('admin.permission-error');
    }


    /* updateApplication  Function Start Here */
    public function updateApplication()
    {
        $msg = 'Running SQL Update.... <br>';
        $v = '1.0.0';
        $v_1_5='1.5.0';
        $latest = '1.6.0';


        $find=app_config('SoftwareVersion');


        if ($find=='1.6.0') {
            $v = '1.6.0';
            $msg .= 'It seems, your version is up to date for version 1.6.0 <br>';
        } elseif($find=='1.0.0') {
            $msg .= 'Running update for Version 1.5.0 ..... <br>';

            $sql=<<<EOF
ALTER TABLE `sys_employee` CHANGE `role` `role_id` INT(11) NOT NULL;

UPDATE `sys_employee` SET `role_id`=0 WHERE `user_name`!='admin';

CREATE TABLE `sys_employee_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_name` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



CREATE TABLE `sys_employee_roles_permission` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `perm_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



CREATE TABLE `sys_employee_training` (
  `id` int(10) UNSIGNED NOT NULL,
  `training_type` enum('Online Training','Seminar','Lecture','Workshop','Hands On Training','Webinar') COLLATE utf8_unicode_ci NOT NULL,
  `training_subject` enum('HR Training','Employees Development','IT Training','Finance Training','Others') COLLATE utf8_unicode_ci NOT NULL,
  `training_nature` enum('Internal','External') COLLATE utf8_unicode_ci NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `trainer` int(11) DEFAULT NULL,
  `training_location` text COLLATE utf8_unicode_ci,
  `sponsored_by` text COLLATE utf8_unicode_ci,
  `organized_by` text COLLATE utf8_unicode_ci,
  `training_from` date NOT NULL,
  `training_to` date NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DELETE FROM `sys_language_data` WHERE `lan_id`='1';

INSERT INTO `sys_language_data` (`id`, `lan_id`, `lan_data`, `lan_value`, `created_at`, `updated_at`) VALUES
(null, 1, 'Login', 'Login', '2016-10-18 00:55:33', '2016-10-18 00:55:33'),
(null, 1, 'Forget Password', 'Forget Password', '2016-10-18 00:55:33', '2016-10-18 00:55:33'),
(null, 1, 'Sign to your account', 'Sign to your account', '2016-10-18 00:55:33', '2016-10-18 00:55:33'),
(null, 1, 'User Name', 'User Name', '2016-10-18 00:55:33', '2016-10-18 00:55:33'),
(null, 1, 'Password', 'Password', '2016-10-18 00:55:33', '2016-10-18 00:55:33'),
(null, 1, 'Remember Me', 'Remember Me', '2016-10-18 00:55:33', '2016-10-18 00:55:33'),
(null, 1, 'Reset your password', 'Reset your password', '2016-10-18 00:55:33', '2016-10-18 00:55:33'),
(null, 1, 'Email', 'Email', '2016-10-18 00:55:33', '2016-10-18 00:55:33'),
(null, 1, 'Reset My Password', 'Reset My Password', '2016-10-18 00:55:33', '2016-10-18 00:55:33'),
(null, 1, 'Back To Sign in', 'Back To Sign in', '2016-10-18 00:55:33', '2016-10-18 00:55:33'),
(null, 1, 'Dashboard', 'Dashboard', '2016-10-18 00:55:33', '2016-10-18 00:55:33'),
(null, 1, 'Departments', 'Departments', '2016-10-18 00:55:33', '2016-10-18 00:55:33'),
(null, 1, 'Designations', 'Designations', '2016-10-18 00:55:33', '2016-10-18 00:55:33'),
(null, 1, 'Employees', 'Employees', '2016-10-18 00:55:33', '2016-10-18 00:55:33'),
(null, 1, 'All Employees', 'All Employees', '2016-10-18 00:55:33', '2016-10-18 00:55:33'),
(null, 1, 'Add Employee', 'Add Employee', '2016-10-18 00:55:33', '2016-10-18 00:55:33'),
(null, 1, 'Job Application', 'Job Application', '2016-10-18 00:55:33', '2016-10-18 00:55:33'),
(null, 1, 'Attendance', 'Attendance', '2016-10-18 00:55:33', '2016-10-18 00:55:33'),
(null, 1, 'Attendance Report', 'Attendance Report', '2016-10-18 00:55:33', '2016-10-18 00:55:33'),
(null, 1, 'Update Attendance', 'Update Attendance', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Leave', 'Leave', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Holiday', 'Holiday', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Holiday Calender', 'Holiday Calender', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Add New Holiday', 'Add New Holiday', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Award', 'Award', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Notice Board', 'Notice Board', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Expense', 'Expense', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Payroll', 'Payroll', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Employee Salary List', 'Employee Salary List', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Make Payment', 'Make Payment', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Generate Payslip', 'Generate Payslip', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Task', 'Task', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Support Tickets', 'Support Tickets', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'All Support Tickets', 'All Support Tickets', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Create New Ticket', 'Create New Ticket', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Support Department', 'Support Department', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Settings', 'Settings', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'System Settings', 'System Settings', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Localization', 'Localization', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Email Templates', 'Email Templates', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Language Settings', 'Language Settings', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Recent 5 Leave Applications', 'Recent 5 Leave Applications', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'See All Applications', 'See All Applications', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Recent 5 Pending Tasks', 'Recent 5 Pending Tasks', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'See All Tasks', 'See All Tasks', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Recent 5 Pending Tickets', 'Recent 5 Pending Tickets', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'See All Tickets', 'See All Tickets', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Update Profile', 'Update Profile', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Change Password', 'Change Password', '2016-10-18 00:55:34', '2016-10-18 00:55:34'),
(null, 1, 'Logout', 'Logout', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Department', 'Department', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Add Department', 'Add Department', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Account Department', 'Account Department', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Add', 'Add', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'All Departments', 'All Departments', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'SL', 'SL', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Department Name', 'Department Name', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Actions', 'Actions', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Edit', 'Edit', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Delete', 'Delete', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Designations', 'Designations', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Add Designation', 'Add Designation', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Designation Name', 'Designation Name', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Software Engineer', 'Software Engineer', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'All Designations', 'All Designations', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Designation', 'Designation', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Code', 'Code', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Name', 'Name', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Username', 'Username', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Status', 'Status', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Active', 'Active', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Inactive', 'Inactive', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'First Name', 'First Name', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Last Name', 'Last Name', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Employee Code', 'Employee Code', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Unique For every User', 'Unique For every User', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Confirm Password', 'Confirm Password', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Select Department', 'Select Department', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'User Role', 'User Role', '2016-10-18 00:55:35', '2016-10-18 00:55:35'),
(null, 1, 'Admin', 'Admin', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Employee', 'Employee', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'View Profile', 'View Profile', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Phone', 'Phone', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Address', 'Address', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Personal Details', 'Personal Details', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Bank Info', 'Bank Info', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Document', 'Document', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Change Picture', 'Change Picture', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Leave blank if you no need to change password', 'Leave blank if you no need to change password', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Date Of Join', 'Date Of Join', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Date Of Leave', 'Date Of Leave', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Phone Number', 'Phone Number', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Alternative Phone', 'Alternative Phone', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Father Name', 'Father Name', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Mother Name', 'Mother Name', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Date Of Birth', 'Date Of Birth', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Present Address', 'Present Address', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Permanent Address', 'Permanent Address', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Update', 'Update', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Add Bank Account', 'Add Bank Account', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Bank Name', 'Bank Name', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Branch Name', 'Branch Name', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Account Name', 'Account Name', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Account Number', 'Account Number', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'IFSC Code', 'IFSC Code', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'PAN Number', 'PAN Number', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'All Bank Accounts', 'All Bank Accounts', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Branch', 'Branch', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Account No', 'Account No', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'PAN No', 'PAN No', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Add Document', 'Add Document', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Document Name', 'Document Name', '2016-10-18 00:55:36', '2016-10-18 00:55:36'),
(null, 1, 'Select Document', 'Select Document', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Browse', 'Browse', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'All Documents', 'All Documents', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Download', 'Download', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Job Applications', 'Job Applications', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Add New Job', 'Add New Job', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Position', 'Position', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Posted Date', 'Posted Date', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Apply Last Date', 'Apply Last Date', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Close Date', 'Close Date', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Open', 'Open', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Drafted', 'Drafted', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Closed', 'Closed', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Applicants', 'Applicants', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Number Of Post', 'Number Of Post', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Post Date', 'Post Date', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Last Date To Apply', 'Last Date To Apply', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Description', 'Description', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Close', 'Close', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Search Condition', 'Search Condition', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Date', 'Date', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Select Employee', 'Select Employee', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Select Designation', 'Select Designation', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Search', 'Search', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Employee Name', 'Employee Name', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Clock In', 'Clock In', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Clock Out', 'Clock Out', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Late', 'Late', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Early Leaving', 'Early Leaving', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Overtime', 'Overtime', '2016-10-18 00:55:37', '2016-10-18 00:55:37'),
(null, 1, 'Total Work', 'Total Work', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Absent', 'Absent', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Present', 'Present', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Set Overtime', 'Set Overtime', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Leave Application', 'Leave Application', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Leave Type', 'Leave Type', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Leave From', 'Leave From', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Leave To', 'Leave To', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Approved', 'Approved', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Pending', 'Pending', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Rejected', 'Rejected', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'View', 'View', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'View Application', 'View Application', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Applied On', 'Applied On', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Leave Reason', 'Leave Reason', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Current Status', 'Current Status', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Change Status', 'Change Status', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Remark', 'Remark', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Update', 'Update', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Prev', 'Prev', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'This Month', 'This Month', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Next', 'Next', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Occasion Name', 'Occasion Name', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Occasion', 'Occasion', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Award List', 'Award List', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Add New Award', 'Add New Award', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Award Name', 'Award Name', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Gift', 'Gift', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Month', 'Month', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Gift Item', 'Gift Item', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'Cash Price', 'Cash Price', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'January', 'January', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'February', 'February', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'March', 'March', '2016-10-18 00:55:38', '2016-10-18 00:55:38'),
(null, 1, 'April', 'April', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'May', 'May', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'June', 'June', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'July', 'July', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'August', 'August', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'September', 'September', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'October', 'October', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'November', 'November', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'December', 'December', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'Year', 'Year', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'Edit Award', 'Edit Award', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'Add New Notice', 'Add New Notice', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'Title', 'Title', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'Published', 'Published', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'Unpublished', 'Unpublished', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'Notice Title', 'Notice Title', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'Notice Status', 'Notice Status', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'Edit Notice', 'Edit Notice', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'Expense List', 'Expense List', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'Add New Expense', 'Add New Expense', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'Item Name', 'Item Name', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'Purchase From', 'Purchase From', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'Purchase Date', 'Purchase Date', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'Amount', 'Amount', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'Cancel', 'Cancel', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'Bill Copy', 'Bill Copy', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'Purchase By', 'Purchase By', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'Edit Expense', 'Edit Expense', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'Working Hourly Rate', 'Working Hourly Rate', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'Overtime Hourly Rate', 'Overtime Hourly Rate', '2016-10-18 00:55:39', '2016-10-18 00:55:39'),
(null, 1, 'Edit Employee Salary', 'Edit Employee Salary', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Hourly Working Rate', 'Hourly Working Rate', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Hourly Overtime Rate', 'Hourly Overtime Rate', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Payment Amount', 'Payment Amount', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Details', 'Details', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Pay Payment', 'Pay Payment', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Payment For', 'Payment For', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Net Salary', 'Net Salary', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Overtime Salary', 'Overtime Salary', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Payment Type', 'Payment Type', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Cash Payment', 'Cash Payment', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Bank Payment', 'Bank Payment', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Cheque Payment', 'Cheque Payment', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Pay', 'Pay', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'All Payments', 'All Payments', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Payment Month', 'Payment Month', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Payment Date', 'Payment Date', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Paid Amount', 'Paid Amount', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Payslip', 'Payslip', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Task List', 'Task List', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Add New Task', 'Add New Task', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Created Date', 'Created Date', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Due Date', 'Due Date', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Completed', 'Completed', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Started', 'Started', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Task Title', 'Task Title', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Assign To', 'Assign To', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Start Date', 'Start Date', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Estimated Hour', 'Estimated Hour', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Progress', 'Progress', '2016-10-18 00:55:40', '2016-10-18 00:55:40'),
(null, 1, 'Edit Task', 'Edit Task', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Manage Task', 'Manage Task', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Task Basic Info', 'Task Basic Info', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Task Management', 'Task Management', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Task Details', 'Task Details', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Task Discussion', 'Task Discussion', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Task Files', 'Task Files', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Task Description', 'Task Description', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Task Members', 'Task Members', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Leave Comment', 'Leave Comment', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Reply', 'Reply', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Member', 'Member', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Comment', 'Comment', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Last Update', 'Last Update', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'File Title', 'File Title', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Files', 'Files', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Upload', 'Upload', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Size', 'Size', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Upload By', 'Upload By', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Select File', 'Select File', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Subject', 'Subject', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Answered', 'Answered', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Customer Reply', 'Customer Reply', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Department Email', 'Department Email', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Show in Client', 'Show in Client', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Yes', 'Yes', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'No', 'No', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Add New', 'Add New', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Manage', 'Manage', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'View Department', 'View Department', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Ticket For Client', 'Ticket For Client', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Message', 'Message', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Create Ticket', 'Create Ticket', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Manage Support Ticket', 'Manage Support Ticket', '2016-10-18 00:55:41', '2016-10-18 00:55:41'),
(null, 1, 'Change Basic Info', 'Change Basic Info', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'Change Department', 'Change Department', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'Ticket Management', 'Ticket Management', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'Ticket Details', 'Ticket Details', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'Ticket Discussion', 'Ticket Discussion', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'Ticket Files', 'Ticket Files', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'Ticket For', 'Ticket For', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'Created By', 'Created By', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'Closed By', 'Closed By', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'Reply Ticket', 'Reply Ticket', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'General', 'General', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'Office Time', 'Office Time', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'Job', 'Job', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'Application Name', 'Application Name', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'Application Title', 'Application Title', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'System Email', 'System Email', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'Remember: All Email Going to the Receiver from this Email', 'Remember: All Email Going to the Receiver from this Email', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'Footer Text', 'Footer Text', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'Application Logo', 'Application Logo', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'Application Favicon', 'Application Favicon', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'Email Gateway', 'Email Gateway', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'SMTP Host Name', 'SMTP Host Name', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'SMTP User Name', 'SMTP User Name', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'SMTP Password', 'SMTP Password', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'SMTP Port', 'SMTP Port', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'SMTP Secure', 'SMTP Secure', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'Office In Time', 'Office In Time', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'Office Out Time', 'Office Out Time', '2016-10-18 00:55:42', '2016-10-18 00:55:42'),
(null, 1, 'Add New Expense Title', 'Add New Expense Title', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Expense Title', 'Expense Title', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Employee Salary', 'Employee Salary', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Expense Title List', 'Expense Title List', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Leave Title', 'Leave Title', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Sick Leave', 'Sick Leave', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Leave Quota', 'Leave Quota', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Leave Title List', 'Leave Title List', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Best Employee', 'Best Employee', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Job File Extension', 'Job File Extension', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Supported File Extension', 'Supported File Extension', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Remember: File Extension Separated By Comma', 'Remember: File Extension Separated By Comma', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Award Name List', 'Award Name List', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Save', 'Save', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Default Country', 'Default Country', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Date Format', 'Date Format', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Default Language', 'Default Language', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Current Code', 'Current Code', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Current Symbol', 'Current Symbol', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Email Templates', 'Email Templates', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Template Name', 'Template Name', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Manage Email Template', 'Manage Email Template', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Language', 'Language', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Add Language', 'Add Language', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Language Name', 'Language Name', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Flag', 'Flag', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'All Languages', 'All Languages', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Translate', 'Translate', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'To', 'To', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'Current Password', 'Current Password', '2016-10-18 00:55:43', '2016-10-18 00:55:43'),
(null, 1, 'New Password', 'New Password', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'All Leave Details', 'All Leave Details', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Total Leave', 'Total Leave', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'New Leave', 'New Leave', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Request For New Leave', 'Request For New Leave', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Send', 'Send', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Published Date', 'Published Date', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Payment History', 'Payment History', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Payment Salary Details', 'Payment Salary Details', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Print Payslip', 'Print Payslip', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Salary Month', 'Salary Month', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Employee ID', 'Employee ID', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Payslip NO', 'Payslip NO', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Joining Date', 'Joining Date', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Payment By', 'Payment By', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Payment Details', 'Payment Details', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Earning', 'Earning', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Grand Total', 'Grand Total', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Overtime Amount', 'Overtime Amount', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Job Type', 'Job Type', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Contractual', 'Contractual', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Part Time', 'Part Time', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Full Time', 'Full Time', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Experience', 'Experience', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Age', 'Age', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Job Location', 'Job Location', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Salary Range', 'Salary Range', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Short Description', 'Short Description', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Edit Job', 'Edit Job', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'All Jobs', 'All Jobs', '2016-10-18 00:55:44', '2016-10-18 00:55:44'),
(null, 1, 'Home', 'Home', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Jobs', 'Jobs', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Deadline', 'Deadline', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Job Summary', 'Job Summary', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Published on', 'Published on', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Application Deadline', 'Application Deadline', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Apply Now', 'Apply Now', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Apply For', 'Apply For', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Upload Resume', 'Upload Resume', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Apply', 'Apply', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Language Manage', 'Language Manage', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'View All', 'View All', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Expense Request', 'Expense Request', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Recent', 'Recent', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Tasks', 'Tasks', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Timezone', 'Timezone', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Today is', 'Today is', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Time', 'Time', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Notice', 'Notice', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Total', 'Total', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Subtotal', 'Subtotal', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'TAX', 'TAX', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Edit Department', 'Edit Department', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Job Applicants', 'Job Applicants', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Unread', 'Unread', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Primary Selected', 'Primary Selected', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Call For Interview', 'Call For Interview', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Confirm', 'Confirm', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Rejected', 'Rejected', '2016-10-18 00:55:45', '2016-10-18 00:55:45'),
(null, 1, 'Resume', 'Resume', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Status', 'Status', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'View Holiday', 'View Holiday', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Tax Rules', 'Tax Rules', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Add Tax Rule', 'Add Tax Rule', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Tax Rule Name', 'Tax Rule Name', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Set Rules', 'Set Rules', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Save Values', 'Save Values', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Salary From', 'Salary From', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Salary To', 'Salary To', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Tax Percentage', 'Tax Percentage', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Additional Tax Amount', 'Additional Tax Amount', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Gender', 'Gender', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Both', 'Both', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Male', 'Male', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Female', 'Female', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Remove', 'Remove', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Add More', 'Add More', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Provident Fund', 'Provident Fund', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Provident Fund Type', 'Provident Fund Type', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Employee Share', 'Employee Share', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Organization Share', 'Organization Share', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Paid', 'Paid', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Unpaid', 'Unpaid', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Loan', 'Loan', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Repayment Start Date', 'Repayment Start Date', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Remaining Amount', 'Remaining Amount', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Ongoing', 'Ongoing', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Include Loan Amount in Payslip', 'Include Loan Amount in Payslip', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Monthly Repayment Amount', 'Monthly Repayment Amount', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Employee Salary Increment', 'Employee Salary Increment', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'SMS Gateways', 'SMS Gateways', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Gateway Name', 'Gateway Name', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'API Link', 'API Link', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Tax Template', 'Tax Template', '2016-10-18 00:55:46', '2016-10-18 00:55:46'),
(null, 1, 'Salary Type', 'Salary Type', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'Monthly', 'Monthly', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'Hourly', 'Hourly', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'Basic Salary', 'Basic Salary', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'Overtime Salary', 'Overtime Salary', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'Reports', 'Reports', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'Employee Payroll Summery', 'Employee Payroll Summery', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'No working hour', 'No working hour', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'Add with basic salary', 'Add with basic salary', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'Salary Statement', 'Salary Statement', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'Date From', 'Date From', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'Date To', 'Date To', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'Find', 'Find', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'Send Email', 'Send Email', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'Send SMS', 'Send SMS', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'For', 'For', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'Employee Summery', 'Employee Summery', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'Set Working Rate', 'Set Working Rate', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'Generate PDF', 'Generate PDF', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'Training', 'Training', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'Training Needs Assessment', 'Training Needs Assessment', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'Training Events', 'Training Events', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'Trainers', 'Trainers', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'Trainer', 'Trainer', '2016-10-18 00:55:47', '2016-10-18 00:55:47'),
(null, 1, 'Training Evaluations', 'Training Evaluations', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Add New Trainer', 'Add New Trainer', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Organization', 'Organization', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'City', 'City', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'State', 'State', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Country', 'Country', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Zip Code', 'Zip Code', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Trainer Expertise', 'Trainer Expertise', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'View Trainer Info', 'View Trainer Info', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Employee Training', 'Employee Training', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Add New Training', 'Add New Training', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Training Type', 'Training Type', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Training From', 'Training From', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Training To', 'Training To', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Online Training', 'Online Training', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Seminar', 'Seminar', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Lecture', 'Lecture', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Workshop', 'Workshop', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Hands On Training', 'Hands On Training', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Webinar', 'Webinar', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'HR Training', 'HR Training', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Employees Development', 'Employees Development', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'IT Training', 'IT Training', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Finance Training', 'Finance Training', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Nature Of Training', 'Nature Of Training', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Internal', 'Internal', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'External', 'External', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Training Location', 'Training Location', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Sponsored By', 'Sponsored By', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Organized By', 'Organized By', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'View Employee Training', 'View Employee Training', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'Preferred', 'Preferred', '2016-10-18 00:55:48', '2016-10-18 00:55:48'),
(null, 1, 'End Date', 'End Date', '2016-10-18 00:55:49', '2016-10-18 00:55:49'),
(null, 1, 'Reason', 'Reason', '2016-10-18 00:55:49', '2016-10-18 00:55:49'),
(null, 1, 'Training Cost', 'Training Cost', '2016-10-18 00:55:49', '2016-10-18 00:55:49'),
(null, 1, 'Travel Cost', 'Travel Cost', '2016-10-18 00:55:49', '2016-10-18 00:55:49'),
(null, 1, 'Add New Event', 'Add New Event', '2016-10-18 00:55:49', '2016-10-18 00:55:49'),
(null, 1, 'Upcoming', 'Upcoming', '2016-10-18 00:55:49', '2016-10-18 00:55:49'),
(null, 1, 'Externals', 'Externals', '2016-10-18 00:55:49', '2016-10-18 00:55:49'),
(null, 1, 'Employee Roles', 'Employee Roles', '2016-10-18 00:55:49', '2016-10-18 00:55:49'),
(null, 1, 'Role Name', 'Role Name', '2016-10-18 00:55:49', '2016-10-18 00:55:49'),
(null, 1, 'Set Roles', 'Set Roles', '2016-10-18 00:55:49', '2016-10-18 00:55:49'),
(null, 1, 'My Portal', 'My Portal', '2016-10-18 00:55:49', '2016-10-18 00:55:49');




CREATE TABLE `sys_trainers` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `designation` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `organization` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `expertise` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



CREATE TABLE `sys_training_evaluations` (
  `id` int(10) UNSIGNED NOT NULL,
  `training_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `sys_training_events` (
  `id` int(10) UNSIGNED NOT NULL,
  `training_type` enum('Online Training','Seminar','Lecture','Workshop','Hands On Training','Webinar') COLLATE utf8_unicode_ci NOT NULL,
  `training_subject` enum('HR Training','Employees Development','IT Training','Finance Training','Others') COLLATE utf8_unicode_ci NOT NULL,
  `training_nature` enum('Internal','External') COLLATE utf8_unicode_ci NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `training_location` text COLLATE utf8_unicode_ci,
  `sponsored_by` text COLLATE utf8_unicode_ci,
  `organized_by` text COLLATE utf8_unicode_ci,
  `training_from` date NOT NULL,
  `training_to` date NOT NULL,
  `status` enum('upcoming','completed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'upcoming',
  `externals` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `sys_training_events_employee` (
  `id` int(10) UNSIGNED NOT NULL,
  `training_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `sys_training_events_trainers` (
  `id` int(10) UNSIGNED NOT NULL,
  `training_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `sys_training_members` (
  `id` int(10) UNSIGNED NOT NULL,
  `training_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `sys_training_needs_assessment` (
  `id` int(10) UNSIGNED NOT NULL,
  `department` int(11) NOT NULL,
  `training_type` enum('Online Training','Seminar','Lecture','Workshop','Hands On Training','Webinar') COLLATE utf8_unicode_ci NOT NULL,
  `training_subject` enum('HR Training','Employees Development','IT Training','Finance Training','Others') COLLATE utf8_unicode_ci NOT NULL,
  `training_nature` enum('Internal','External') COLLATE utf8_unicode_ci NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `training_reason` text COLLATE utf8_unicode_ci,
  `trainer` int(11) DEFAULT NULL,
  `training_location` text COLLATE utf8_unicode_ci,
  `training_from` date NOT NULL,
  `training_to` date NOT NULL,
  `training_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `travel_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` enum('pending','approved','rejected','completed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `sys_training_needs_assessment_members` (
  `id` int(10) UNSIGNED NOT NULL,
  `training_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `sys_employee_roles`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sys_employee_roles_permission`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sys_employee_training`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sys_trainers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sys_training_evaluations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sys_training_events`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sys_training_events_employee`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sys_training_events_trainers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sys_training_members`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sys_training_needs_assessment`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sys_training_needs_assessment_members`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sys_employee_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
  ALTER TABLE `sys_employee_roles_permission`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
  ALTER TABLE `sys_employee_training`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
  ALTER TABLE `sys_trainers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
  ALTER TABLE `sys_training_evaluations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
  ALTER TABLE `sys_training_events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
  ALTER TABLE `sys_training_events_employee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
  ALTER TABLE `sys_training_events_trainers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
  ALTER TABLE `sys_training_members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
  ALTER TABLE `sys_training_needs_assessment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
  ALTER TABLE `sys_training_needs_assessment_members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

UPDATE `sys_appconfig` SET `value` = '1.5.0' WHERE `sys_appconfig`.`id` = 4;

EOF;

            $msg .= 'Importing Version 1.5.0 SQL Data....... <br>';

            // Execute SQL QUERY
            \DB::connection()->getPdo()->exec($sql);

            $msg .= 'Data import Completed....... <br>';
            $msg .= '=====Version 1.5.0 Update Complete ======" <br>';

        }else{

            $msg .= 'Running update for Version 1.5.0 ..... <br>';

            $sql=<<<EOF


CREATE TABLE `sys_disable_menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `emp_ids` text COLLATE utf8_unicode_ci,
  `menu` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `sys_disable_menu` (`id`, `emp_ids`, `menu`, `status`, `created_at`, `updated_at`) VALUES
(1, '2', 'Departments', 'active', '2017-06-11 03:16:36', '2017-06-11 10:09:40'),
(2, '', 'Designations', 'active', '2017-06-11 03:16:36', '2017-06-11 03:16:36'),
(3, '', 'Employees', 'active', '2017-06-11 03:16:36', '2017-06-11 03:16:36'),
(4, '', 'Job Application', 'active', '2017-06-11 03:16:36', '2017-06-11 03:16:36'),
(5, '', 'Attendance', 'active', '2017-06-11 03:16:36', '2017-06-11 03:16:36'),
(6, '', 'Leave', 'active', '2017-06-11 03:16:36', '2017-06-11 03:16:36'),
(7, '', 'Holiday', 'active', '2017-06-11 03:16:36', '2017-06-11 03:16:36'),
(8, '', 'Award', 'active', '2017-06-11 03:16:37', '2017-06-11 03:16:37'),
(9, '', 'Notice Board', 'active', '2017-06-11 03:16:37', '2017-06-11 03:16:37'),
(10, '', 'Expense', 'active', '2017-06-11 03:16:37', '2017-06-11 03:16:37'),
(11, '', 'Payroll', 'active', '2017-06-11 03:16:37', '2017-06-11 03:16:37'),
(12, '', 'Training', 'active', '2017-06-11 03:16:37', '2017-06-11 03:16:37'),
(13, '', 'Task', 'active', '2017-06-11 03:16:37', '2017-06-11 03:16:37'),
(14, '', 'Support Tickets', 'active', '2017-06-11 03:16:37', '2017-06-11 03:16:37'),
(15, '', 'Reports', 'active', '2017-06-11 03:16:37', '2017-06-11 03:16:37'),
(16, '', 'Settings', 'active', '2017-06-11 03:16:37', '2017-06-11 03:16:37');


ALTER TABLE `sys_disable_menu`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `sys_disable_menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

DELETE FROM `sys_language_data` WHERE `lan_id`='1';

INSERT INTO `sys_language_data` (`id`, `lan_id`, `lan_data`, `lan_value`, `created_at`, `updated_at`) VALUES
(1, 1, 'Login', 'Login', '2017-06-11 03:47:01', '2017-06-11 03:47:01'),
(2, 1, 'Forget Password', 'Forget Password', '2017-06-11 03:47:01', '2017-06-11 03:47:01'),
(3, 1, 'Sign to your account', 'Sign to your account', '2017-06-11 03:47:01', '2017-06-11 03:47:01'),
(4, 1, 'User Name', 'User Name', '2017-06-11 03:47:02', '2017-06-11 03:47:02'),
(5, 1, 'Password', 'Password', '2017-06-11 03:47:02', '2017-06-11 03:47:02'),
(6, 1, 'Remember Me', 'Remember Me', '2017-06-11 03:47:02', '2017-06-11 03:47:02'),
(7, 1, 'Reset your password', 'Reset your password', '2017-06-11 03:47:02', '2017-06-11 03:47:02'),
(8, 1, 'Email', 'Email', '2017-06-11 03:47:02', '2017-06-11 03:47:02'),
(9, 1, 'Reset My Password', 'Reset My Password', '2017-06-11 03:47:02', '2017-06-11 03:47:02'),
(10, 1, 'Back To Sign in', 'Back To Sign in', '2017-06-11 03:47:02', '2017-06-11 03:47:02'),
(11, 1, 'Dashboard', 'Dashboard', '2017-06-11 03:47:02', '2017-06-11 03:47:02'),
(12, 1, 'Departments', 'Departments', '2017-06-11 03:47:02', '2017-06-11 03:47:02'),
(13, 1, 'Designations', 'Designations', '2017-06-11 03:47:02', '2017-06-11 03:47:02'),
(14, 1, 'Employees', 'Employees', '2017-06-11 03:47:02', '2017-06-11 03:47:02'),
(15, 1, 'All Employees', 'All Employees', '2017-06-11 03:47:02', '2017-06-11 03:47:02'),
(16, 1, 'Add Employee', 'Add Employee', '2017-06-11 03:47:02', '2017-06-11 03:47:02'),
(17, 1, 'Job Application', 'Job Application', '2017-06-11 03:47:02', '2017-06-11 03:47:02'),
(18, 1, 'Attendance', 'Attendance', '2017-06-11 03:47:02', '2017-06-11 03:47:02'),
(19, 1, 'Attendance Report', 'Attendance Report', '2017-06-11 03:47:02', '2017-06-11 03:47:02'),
(20, 1, 'Update Attendance', 'Update Attendance', '2017-06-11 03:47:02', '2017-06-11 03:47:02'),
(21, 1, 'Leave', 'Leave', '2017-06-11 03:47:02', '2017-06-11 03:47:02'),
(22, 1, 'Holiday', 'Holiday', '2017-06-11 03:47:02', '2017-06-11 03:47:02'),
(23, 1, 'Holiday Calender', 'Holiday Calender', '2017-06-11 03:47:03', '2017-06-11 03:47:03'),
(24, 1, 'Add New Holiday', 'Add New Holiday', '2017-06-11 03:47:03', '2017-06-11 03:47:03'),
(25, 1, 'Award', 'Award', '2017-06-11 03:47:03', '2017-06-11 03:47:03'),
(26, 1, 'Notice Board', 'Notice Board', '2017-06-11 03:47:03', '2017-06-11 03:47:03'),
(27, 1, 'Expense', 'Expense', '2017-06-11 03:47:03', '2017-06-11 03:47:03'),
(28, 1, 'Payroll', 'Payroll', '2017-06-11 03:47:03', '2017-06-11 03:47:03'),
(29, 1, 'Employee Salary List', 'Employee Salary List', '2017-06-11 03:47:03', '2017-06-11 03:47:03'),
(30, 1, 'Make Payment', 'Make Payment', '2017-06-11 03:47:03', '2017-06-11 03:47:03'),
(31, 1, 'Generate Payslip', 'Generate Payslip', '2017-06-11 03:47:03', '2017-06-11 03:47:03'),
(32, 1, 'Task', 'Task', '2017-06-11 03:47:03', '2017-06-11 03:47:03'),
(33, 1, 'Support Tickets', 'Support Tickets', '2017-06-11 03:47:03', '2017-06-11 03:47:03'),
(34, 1, 'All Support Tickets', 'All Support Tickets', '2017-06-11 03:47:03', '2017-06-11 03:47:03'),
(35, 1, 'Create New Ticket', 'Create New Ticket', '2017-06-11 03:47:03', '2017-06-11 03:47:03'),
(36, 1, 'Support Department', 'Support Department', '2017-06-11 03:47:03', '2017-06-11 03:47:03'),
(37, 1, 'Settings', 'Settings', '2017-06-11 03:47:03', '2017-06-11 03:47:03'),
(38, 1, 'System Settings', 'System Settings', '2017-06-11 03:47:03', '2017-06-11 03:47:03'),
(39, 1, 'Localization', 'Localization', '2017-06-11 03:47:03', '2017-06-11 03:47:03'),
(40, 1, 'Email Templates', 'Email Templates', '2017-06-11 03:47:03', '2017-06-11 03:47:03'),
(41, 1, 'Language Settings', 'Language Settings', '2017-06-11 03:47:03', '2017-06-11 03:47:03'),
(42, 1, 'Recent 5 Leave Applications', 'Recent 5 Leave Applications', '2017-06-11 03:47:03', '2017-06-11 03:47:03'),
(43, 1, 'See All Applications', 'See All Applications', '2017-06-11 03:47:03', '2017-06-11 03:47:03'),
(44, 1, 'Recent 5 Pending Tasks', 'Recent 5 Pending Tasks', '2017-06-11 03:47:04', '2017-06-11 03:47:04'),
(45, 1, 'See All Tasks', 'See All Tasks', '2017-06-11 03:47:04', '2017-06-11 03:47:04'),
(46, 1, 'Recent 5 Pending Tickets', 'Recent 5 Pending Tickets', '2017-06-11 03:47:04', '2017-06-11 03:47:04'),
(47, 1, 'See All Tickets', 'See All Tickets', '2017-06-11 03:47:04', '2017-06-11 03:47:04'),
(48, 1, 'Update Profile', 'Update Profile', '2017-06-11 03:47:04', '2017-06-11 03:47:04'),
(49, 1, 'Change Password', 'Change Password', '2017-06-11 03:47:04', '2017-06-11 03:47:04'),
(50, 1, 'Logout', 'Logout', '2017-06-11 03:47:04', '2017-06-11 03:47:04'),
(51, 1, 'Department', 'Department', '2017-06-11 03:47:04', '2017-06-11 03:47:04'),
(52, 1, 'Add Department', 'Add Department', '2017-06-11 03:47:04', '2017-06-11 03:47:04'),
(53, 1, 'Account Department', 'Account Department', '2017-06-11 03:47:04', '2017-06-11 03:47:04'),
(54, 1, 'Add', 'Add', '2017-06-11 03:47:04', '2017-06-11 03:47:04'),
(55, 1, 'All Departments', 'All Departments', '2017-06-11 03:47:04', '2017-06-11 03:47:04'),
(56, 1, 'SL', 'SL', '2017-06-11 03:47:04', '2017-06-11 03:47:04'),
(57, 1, 'Department Name', 'Department Name', '2017-06-11 03:47:04', '2017-06-11 03:47:04'),
(58, 1, 'Actions', 'Actions', '2017-06-11 03:47:04', '2017-06-11 03:47:04'),
(59, 1, 'Edit', 'Edit', '2017-06-11 03:47:04', '2017-06-11 03:47:04'),
(60, 1, 'Delete', 'Delete', '2017-06-11 03:47:04', '2017-06-11 03:47:04'),
(61, 1, 'Designations', 'Designations', '2017-06-11 03:47:04', '2017-06-11 03:47:04'),
(62, 1, 'Add Designation', 'Add Designation', '2017-06-11 03:47:04', '2017-06-11 03:47:04'),
(63, 1, 'Designation Name', 'Designation Name', '2017-06-11 03:47:04', '2017-06-11 03:47:04'),
(64, 1, 'Software Engineer', 'Software Engineer', '2017-06-11 03:47:05', '2017-06-11 03:47:05'),
(65, 1, 'All Designations', 'All Designations', '2017-06-11 03:47:05', '2017-06-11 03:47:05'),
(66, 1, 'Designation', 'Designation', '2017-06-11 03:47:05', '2017-06-11 03:47:05'),
(67, 1, 'Code', 'Code', '2017-06-11 03:47:05', '2017-06-11 03:47:05'),
(68, 1, 'Name', 'Name', '2017-06-11 03:47:05', '2017-06-11 03:47:05'),
(69, 1, 'Username', 'Username', '2017-06-11 03:47:05', '2017-06-11 03:47:05'),
(70, 1, 'Status', 'Status', '2017-06-11 03:47:05', '2017-06-11 03:47:05'),
(71, 1, 'Active', 'Active', '2017-06-11 03:47:05', '2017-06-11 03:47:05'),
(72, 1, 'Inactive', 'Inactive', '2017-06-11 03:47:05', '2017-06-11 03:47:05'),
(73, 1, 'First Name', 'First Name', '2017-06-11 03:47:05', '2017-06-11 03:47:05'),
(74, 1, 'Last Name', 'Last Name', '2017-06-11 03:47:05', '2017-06-11 03:47:05'),
(75, 1, 'Employee Code', 'Employee Code', '2017-06-11 03:47:05', '2017-06-11 03:47:05'),
(76, 1, 'Unique For every User', 'Unique For every User', '2017-06-11 03:47:05', '2017-06-11 03:47:05'),
(77, 1, 'Confirm Password', 'Confirm Password', '2017-06-11 03:47:05', '2017-06-11 03:47:05'),
(78, 1, 'Select Department', 'Select Department', '2017-06-11 03:47:05', '2017-06-11 03:47:05'),
(79, 1, 'User Role', 'User Role', '2017-06-11 03:47:05', '2017-06-11 03:47:05'),
(80, 1, 'Admin', 'Admin', '2017-06-11 03:47:05', '2017-06-11 03:47:05'),
(81, 1, 'Employee', 'Employee', '2017-06-11 03:47:06', '2017-06-11 03:47:06'),
(82, 1, 'View Profile', 'View Profile', '2017-06-11 03:47:06', '2017-06-11 03:47:06'),
(83, 1, 'Phone', 'Phone', '2017-06-11 03:47:06', '2017-06-11 03:47:06'),
(84, 1, 'Address', 'Address', '2017-06-11 03:47:06', '2017-06-11 03:47:06'),
(85, 1, 'Personal Details', 'Personal Details', '2017-06-11 03:47:06', '2017-06-11 03:47:06'),
(86, 1, 'Bank Info', 'Bank Info', '2017-06-11 03:47:06', '2017-06-11 03:47:06'),
(87, 1, 'Document', 'Document', '2017-06-11 03:47:06', '2017-06-11 03:47:06'),
(88, 1, 'Change Picture', 'Change Picture', '2017-06-11 03:47:06', '2017-06-11 03:47:06'),
(89, 1, 'Leave blank if you no need to change password', 'Leave blank if you no need to change password', '2017-06-11 03:47:06', '2017-06-11 03:47:06'),
(90, 1, 'Date Of Join', 'Date Of Join', '2017-06-11 03:47:06', '2017-06-11 03:47:06'),
(91, 1, 'Date Of Leave', 'Date Of Leave', '2017-06-11 03:47:06', '2017-06-11 03:47:06'),
(92, 1, 'Phone Number', 'Phone Number', '2017-06-11 03:47:06', '2017-06-11 03:47:06'),
(93, 1, 'Alternative Phone', 'Alternative Phone', '2017-06-11 03:47:06', '2017-06-11 03:47:06'),
(94, 1, 'Father Name', 'Father Name', '2017-06-11 03:47:06', '2017-06-11 03:47:06'),
(95, 1, 'Mother Name', 'Mother Name', '2017-06-11 03:47:06', '2017-06-11 03:47:06'),
(96, 1, 'Date Of Birth', 'Date Of Birth', '2017-06-11 03:47:06', '2017-06-11 03:47:06'),
(97, 1, 'Present Address', 'Present Address', '2017-06-11 03:47:06', '2017-06-11 03:47:06'),
(98, 1, 'Permanent Address', 'Permanent Address', '2017-06-11 03:47:06', '2017-06-11 03:47:06'),
(99, 1, 'Update', 'Update', '2017-06-11 03:47:06', '2017-06-11 03:47:06'),
(100, 1, 'Add Bank Account', 'Add Bank Account', '2017-06-11 03:47:07', '2017-06-11 03:47:07'),
(101, 1, 'Bank Name', 'Bank Name', '2017-06-11 03:47:07', '2017-06-11 03:47:07'),
(102, 1, 'Branch Name', 'Branch Name', '2017-06-11 03:47:07', '2017-06-11 03:47:07'),
(103, 1, 'Account Name', 'Account Name', '2017-06-11 03:47:07', '2017-06-11 03:47:07'),
(104, 1, 'Account Number', 'Account Number', '2017-06-11 03:47:07', '2017-06-11 03:47:07'),
(105, 1, 'IFSC Code', 'IFSC Code', '2017-06-11 03:47:07', '2017-06-11 03:47:07'),
(106, 1, 'PAN Number', 'PAN Number', '2017-06-11 03:47:07', '2017-06-11 03:47:07'),
(107, 1, 'All Bank Accounts', 'All Bank Accounts', '2017-06-11 03:47:07', '2017-06-11 03:47:07'),
(108, 1, 'Branch', 'Branch', '2017-06-11 03:47:07', '2017-06-11 03:47:07'),
(109, 1, 'Account No', 'Account No', '2017-06-11 03:47:07', '2017-06-11 03:47:07'),
(110, 1, 'PAN No', 'PAN No', '2017-06-11 03:47:07', '2017-06-11 03:47:07'),
(111, 1, 'Add Document', 'Add Document', '2017-06-11 03:47:07', '2017-06-11 03:47:07'),
(112, 1, 'Document Name', 'Document Name', '2017-06-11 03:47:07', '2017-06-11 03:47:07'),
(113, 1, 'Select Document', 'Select Document', '2017-06-11 03:47:07', '2017-06-11 03:47:07'),
(114, 1, 'Browse', 'Browse', '2017-06-11 03:47:07', '2017-06-11 03:47:07'),
(115, 1, 'All Documents', 'All Documents', '2017-06-11 03:47:07', '2017-06-11 03:47:07'),
(116, 1, 'Download', 'Download', '2017-06-11 03:47:07', '2017-06-11 03:47:07'),
(117, 1, 'Job Applications', 'Job Applications', '2017-06-11 03:47:07', '2017-06-11 03:47:07'),
(118, 1, 'Add New Job', 'Add New Job', '2017-06-11 03:47:07', '2017-06-11 03:47:07'),
(119, 1, 'Position', 'Position', '2017-06-11 03:47:07', '2017-06-11 03:47:07'),
(120, 1, 'Posted Date', 'Posted Date', '2017-06-11 03:47:08', '2017-06-11 03:47:08'),
(121, 1, 'Apply Last Date', 'Apply Last Date', '2017-06-11 03:47:08', '2017-06-11 03:47:08'),
(122, 1, 'Close Date', 'Close Date', '2017-06-11 03:47:08', '2017-06-11 03:47:08'),
(123, 1, 'Open', 'Open', '2017-06-11 03:47:08', '2017-06-11 03:47:08'),
(124, 1, 'Drafted', 'Drafted', '2017-06-11 03:47:08', '2017-06-11 03:47:08'),
(125, 1, 'Closed', 'Closed', '2017-06-11 03:47:08', '2017-06-11 03:47:08'),
(126, 1, 'Applicants', 'Applicants', '2017-06-11 03:47:08', '2017-06-11 03:47:08'),
(127, 1, 'Number Of Post', 'Number Of Post', '2017-06-11 03:47:08', '2017-06-11 03:47:08'),
(128, 1, 'Post Date', 'Post Date', '2017-06-11 03:47:08', '2017-06-11 03:47:08'),
(129, 1, 'Last Date To Apply', 'Last Date To Apply', '2017-06-11 03:47:08', '2017-06-11 03:47:08'),
(130, 1, 'Description', 'Description', '2017-06-11 03:47:08', '2017-06-11 03:47:08'),
(131, 1, 'Close', 'Close', '2017-06-11 03:47:08', '2017-06-11 03:47:08'),
(132, 1, 'Search Condition', 'Search Condition', '2017-06-11 03:47:08', '2017-06-11 03:47:08'),
(133, 1, 'Date', 'Date', '2017-06-11 03:47:08', '2017-06-11 03:47:08'),
(134, 1, 'Select Employee', 'Select Employee', '2017-06-11 03:47:08', '2017-06-11 03:47:08'),
(135, 1, 'Select Designation', 'Select Designation', '2017-06-11 03:47:08', '2017-06-11 03:47:08'),
(136, 1, 'Search', 'Search', '2017-06-11 03:47:08', '2017-06-11 03:47:08'),
(137, 1, 'Employee Name', 'Employee Name', '2017-06-11 03:47:08', '2017-06-11 03:47:08'),
(138, 1, 'Clock In', 'Clock In', '2017-06-11 03:47:08', '2017-06-11 03:47:08'),
(139, 1, 'Clock Out', 'Clock Out', '2017-06-11 03:47:08', '2017-06-11 03:47:08'),
(140, 1, 'Late', 'Late', '2017-06-11 03:47:08', '2017-06-11 03:47:08'),
(141, 1, 'Early Leaving', 'Early Leaving', '2017-06-11 03:47:09', '2017-06-11 03:47:09'),
(142, 1, 'Overtime', 'Overtime', '2017-06-11 03:47:09', '2017-06-11 03:47:09'),
(143, 1, 'Total Work', 'Total Work', '2017-06-11 03:47:09', '2017-06-11 03:47:09'),
(144, 1, 'Absent', 'Absent', '2017-06-11 03:47:09', '2017-06-11 03:47:09'),
(145, 1, 'Present', 'Present', '2017-06-11 03:47:09', '2017-06-11 03:47:09'),
(146, 1, 'Set Overtime', 'Set Overtime', '2017-06-11 03:47:09', '2017-06-11 03:47:09'),
(147, 1, 'Leave Application', 'Leave Application', '2017-06-11 03:47:09', '2017-06-11 03:47:09'),
(148, 1, 'Leave Type', 'Leave Type', '2017-06-11 03:47:09', '2017-06-11 03:47:09'),
(149, 1, 'Leave From', 'Leave From', '2017-06-11 03:47:09', '2017-06-11 03:47:09'),
(150, 1, 'Leave To', 'Leave To', '2017-06-11 03:47:09', '2017-06-11 03:47:09'),
(151, 1, 'Approved', 'Approved', '2017-06-11 03:47:09', '2017-06-11 03:47:09'),
(152, 1, 'Pending', 'Pending', '2017-06-11 03:47:09', '2017-06-11 03:47:09'),
(153, 1, 'Rejected', 'Rejected', '2017-06-11 03:47:09', '2017-06-11 03:47:09'),
(154, 1, 'View', 'View', '2017-06-11 03:47:09', '2017-06-11 03:47:09'),
(155, 1, 'View Application', 'View Application', '2017-06-11 03:47:09', '2017-06-11 03:47:09'),
(156, 1, 'Applied On', 'Applied On', '2017-06-11 03:47:09', '2017-06-11 03:47:09'),
(157, 1, 'Leave Reason', 'Leave Reason', '2017-06-11 03:47:09', '2017-06-11 03:47:09'),
(158, 1, 'Current Status', 'Current Status', '2017-06-11 03:47:09', '2017-06-11 03:47:09'),
(159, 1, 'Change Status', 'Change Status', '2017-06-11 03:47:09', '2017-06-11 03:47:09'),
(160, 1, 'Remark', 'Remark', '2017-06-11 03:47:09', '2017-06-11 03:47:09'),
(161, 1, 'Update', 'Update', '2017-06-11 03:47:09', '2017-06-11 03:47:09'),
(162, 1, 'Prev', 'Prev', '2017-06-11 03:47:09', '2017-06-11 03:47:09'),
(163, 1, 'This Month', 'This Month', '2017-06-11 03:47:10', '2017-06-11 03:47:10'),
(164, 1, 'Next', 'Next', '2017-06-11 03:47:10', '2017-06-11 03:47:10'),
(165, 1, 'Occasion Name', 'Occasion Name', '2017-06-11 03:47:10', '2017-06-11 03:47:10'),
(166, 1, 'Occasion', 'Occasion', '2017-06-11 03:47:10', '2017-06-11 03:47:10'),
(167, 1, 'Award List', 'Award List', '2017-06-11 03:47:10', '2017-06-11 03:47:10'),
(168, 1, 'Add New Award', 'Add New Award', '2017-06-11 03:47:10', '2017-06-11 03:47:10'),
(169, 1, 'Award Name', 'Award Name', '2017-06-11 03:47:10', '2017-06-11 03:47:10'),
(170, 1, 'Gift', 'Gift', '2017-06-11 03:47:10', '2017-06-11 03:47:10'),
(171, 1, 'Month', 'Month', '2017-06-11 03:47:10', '2017-06-11 03:47:10'),
(172, 1, 'Gift Item', 'Gift Item', '2017-06-11 03:47:10', '2017-06-11 03:47:10'),
(173, 1, 'Cash Price', 'Cash Price', '2017-06-11 03:47:10', '2017-06-11 03:47:10'),
(174, 1, 'January', 'January', '2017-06-11 03:47:10', '2017-06-11 03:47:10'),
(175, 1, 'February', 'February', '2017-06-11 03:47:10', '2017-06-11 03:47:10'),
(176, 1, 'March', 'March', '2017-06-11 03:47:10', '2017-06-11 03:47:10'),
(177, 1, 'April', 'April', '2017-06-11 03:47:10', '2017-06-11 03:47:10'),
(178, 1, 'May', 'May', '2017-06-11 03:47:10', '2017-06-11 03:47:10'),
(179, 1, 'June', 'June', '2017-06-11 03:47:10', '2017-06-11 03:47:10'),
(180, 1, 'July', 'July', '2017-06-11 03:47:10', '2017-06-11 03:47:10'),
(181, 1, 'August', 'August', '2017-06-11 03:47:10', '2017-06-11 03:47:10'),
(182, 1, 'September', 'September', '2017-06-11 03:47:11', '2017-06-11 03:47:11'),
(183, 1, 'October', 'October', '2017-06-11 03:47:11', '2017-06-11 03:47:11'),
(184, 1, 'November', 'November', '2017-06-11 03:47:11', '2017-06-11 03:47:11'),
(185, 1, 'December', 'December', '2017-06-11 03:47:11', '2017-06-11 03:47:11'),
(186, 1, 'Year', 'Year', '2017-06-11 03:47:11', '2017-06-11 03:47:11'),
(187, 1, 'Edit Award', 'Edit Award', '2017-06-11 03:47:11', '2017-06-11 03:47:11'),
(188, 1, 'Add New Notice', 'Add New Notice', '2017-06-11 03:47:11', '2017-06-11 03:47:11'),
(189, 1, 'Title', 'Title', '2017-06-11 03:47:11', '2017-06-11 03:47:11'),
(190, 1, 'Published', 'Published', '2017-06-11 03:47:11', '2017-06-11 03:47:11'),
(191, 1, 'Unpublished', 'Unpublished', '2017-06-11 03:47:11', '2017-06-11 03:47:11'),
(192, 1, 'Notice Title', 'Notice Title', '2017-06-11 03:47:11', '2017-06-11 03:47:11'),
(193, 1, 'Notice Status', 'Notice Status', '2017-06-11 03:47:11', '2017-06-11 03:47:11'),
(194, 1, 'Edit Notice', 'Edit Notice', '2017-06-11 03:47:11', '2017-06-11 03:47:11'),
(195, 1, 'Expense List', 'Expense List', '2017-06-11 03:47:11', '2017-06-11 03:47:11'),
(196, 1, 'Add New Expense', 'Add New Expense', '2017-06-11 03:47:11', '2017-06-11 03:47:11'),
(197, 1, 'Item Name', 'Item Name', '2017-06-11 03:47:11', '2017-06-11 03:47:11'),
(198, 1, 'Purchase From', 'Purchase From', '2017-06-11 03:47:11', '2017-06-11 03:47:11'),
(199, 1, 'Purchase Date', 'Purchase Date', '2017-06-11 03:47:11', '2017-06-11 03:47:11'),
(200, 1, 'Amount', 'Amount', '2017-06-11 03:47:11', '2017-06-11 03:47:11'),
(201, 1, 'Cancel', 'Cancel', '2017-06-11 03:47:11', '2017-06-11 03:47:11'),
(202, 1, 'Bill Copy', 'Bill Copy', '2017-06-11 03:47:11', '2017-06-11 03:47:11'),
(203, 1, 'Purchase By', 'Purchase By', '2017-06-11 03:47:11', '2017-06-11 03:47:11'),
(204, 1, 'Edit Expense', 'Edit Expense', '2017-06-11 03:47:12', '2017-06-11 03:47:12'),
(205, 1, 'Working Hourly Rate', 'Working Hourly Rate', '2017-06-11 03:47:12', '2017-06-11 03:47:12'),
(206, 1, 'Overtime Hourly Rate', 'Overtime Hourly Rate', '2017-06-11 03:47:12', '2017-06-11 03:47:12'),
(207, 1, 'Edit Employee Salary', 'Edit Employee Salary', '2017-06-11 03:47:12', '2017-06-11 03:47:12'),
(208, 1, 'Hourly Working Rate', 'Hourly Working Rate', '2017-06-11 03:47:12', '2017-06-11 03:47:12'),
(209, 1, 'Hourly Overtime Rate', 'Hourly Overtime Rate', '2017-06-11 03:47:12', '2017-06-11 03:47:12'),
(210, 1, 'Payment Amount', 'Payment Amount', '2017-06-11 03:47:12', '2017-06-11 03:47:12'),
(211, 1, 'Details', 'Details', '2017-06-11 03:47:12', '2017-06-11 03:47:12'),
(212, 1, 'Pay Payment', 'Pay Payment', '2017-06-11 03:47:12', '2017-06-11 03:47:12'),
(213, 1, 'Payment For', 'Payment For', '2017-06-11 03:47:12', '2017-06-11 03:47:12'),
(214, 1, 'Net Salary', 'Net Salary', '2017-06-11 03:47:12', '2017-06-11 03:47:12'),
(215, 1, 'Overtime Salary', 'Overtime Salary', '2017-06-11 03:47:12', '2017-06-11 03:47:12'),
(216, 1, 'Payment Type', 'Payment Type', '2017-06-11 03:47:12', '2017-06-11 03:47:12'),
(217, 1, 'Cash Payment', 'Cash Payment', '2017-06-11 03:47:12', '2017-06-11 03:47:12'),
(218, 1, 'Bank Payment', 'Bank Payment', '2017-06-11 03:47:12', '2017-06-11 03:47:12'),
(219, 1, 'Cheque Payment', 'Cheque Payment', '2017-06-11 03:47:12', '2017-06-11 03:47:12'),
(220, 1, 'Pay', 'Pay', '2017-06-11 03:47:12', '2017-06-11 03:47:12'),
(221, 1, 'All Payments', 'All Payments', '2017-06-11 03:47:12', '2017-06-11 03:47:12'),
(222, 1, 'Payment Month', 'Payment Month', '2017-06-11 03:47:12', '2017-06-11 03:47:12'),
(223, 1, 'Payment Date', 'Payment Date', '2017-06-11 03:47:13', '2017-06-11 03:47:13'),
(224, 1, 'Paid Amount', 'Paid Amount', '2017-06-11 03:47:13', '2017-06-11 03:47:13'),
(225, 1, 'Payslip', 'Payslip', '2017-06-11 03:47:13', '2017-06-11 03:47:13'),
(226, 1, 'Task List', 'Task List', '2017-06-11 03:47:13', '2017-06-11 03:47:13'),
(227, 1, 'Add New Task', 'Add New Task', '2017-06-11 03:47:13', '2017-06-11 03:47:13'),
(228, 1, 'Created Date', 'Created Date', '2017-06-11 03:47:13', '2017-06-11 03:47:13'),
(229, 1, 'Due Date', 'Due Date', '2017-06-11 03:47:13', '2017-06-11 03:47:13'),
(230, 1, 'Completed', 'Completed', '2017-06-11 03:47:13', '2017-06-11 03:47:13'),
(231, 1, 'Started', 'Started', '2017-06-11 03:47:13', '2017-06-11 03:47:13'),
(232, 1, 'Task Title', 'Task Title', '2017-06-11 03:47:13', '2017-06-11 03:47:13'),
(233, 1, 'Assign To', 'Assign To', '2017-06-11 03:47:13', '2017-06-11 03:47:13'),
(234, 1, 'Start Date', 'Start Date', '2017-06-11 03:47:13', '2017-06-11 03:47:13'),
(235, 1, 'Estimated Hour', 'Estimated Hour', '2017-06-11 03:47:13', '2017-06-11 03:47:13'),
(236, 1, 'Progress', 'Progress', '2017-06-11 03:47:13', '2017-06-11 03:47:13'),
(237, 1, 'Edit Task', 'Edit Task', '2017-06-11 03:47:13', '2017-06-11 03:47:13'),
(238, 1, 'Manage Task', 'Manage Task', '2017-06-11 03:47:13', '2017-06-11 03:47:13'),
(239, 1, 'Task Basic Info', 'Task Basic Info', '2017-06-11 03:47:13', '2017-06-11 03:47:13'),
(240, 1, 'Task Management', 'Task Management', '2017-06-11 03:47:13', '2017-06-11 03:47:13'),
(241, 1, 'Task Details', 'Task Details', '2017-06-11 03:47:13', '2017-06-11 03:47:13'),
(242, 1, 'Task Discussion', 'Task Discussion', '2017-06-11 03:47:13', '2017-06-11 03:47:13'),
(243, 1, 'Task Files', 'Task Files', '2017-06-11 03:47:13', '2017-06-11 03:47:13'),
(244, 1, 'Task Description', 'Task Description', '2017-06-11 03:47:13', '2017-06-11 03:47:13'),
(245, 1, 'Task Members', 'Task Members', '2017-06-11 03:47:14', '2017-06-11 03:47:14'),
(246, 1, 'Leave Comment', 'Leave Comment', '2017-06-11 03:47:14', '2017-06-11 03:47:14'),
(247, 1, 'Reply', 'Reply', '2017-06-11 03:47:14', '2017-06-11 03:47:14'),
(248, 1, 'Member', 'Member', '2017-06-11 03:47:14', '2017-06-11 03:47:14'),
(249, 1, 'Comment', 'Comment', '2017-06-11 03:47:14', '2017-06-11 03:47:14'),
(250, 1, 'Last Update', 'Last Update', '2017-06-11 03:47:14', '2017-06-11 03:47:14'),
(251, 1, 'File Title', 'File Title', '2017-06-11 03:47:14', '2017-06-11 03:47:14'),
(252, 1, 'Files', 'Files', '2017-06-11 03:47:14', '2017-06-11 03:47:14'),
(253, 1, 'Upload', 'Upload', '2017-06-11 03:47:14', '2017-06-11 03:47:14'),
(254, 1, 'Size', 'Size', '2017-06-11 03:47:14', '2017-06-11 03:47:14'),
(255, 1, 'Upload By', 'Upload By', '2017-06-11 03:47:14', '2017-06-11 03:47:14'),
(256, 1, 'Select File', 'Select File', '2017-06-11 03:47:14', '2017-06-11 03:47:14'),
(257, 1, 'Subject', 'Subject', '2017-06-11 03:47:14', '2017-06-11 03:47:14'),
(258, 1, 'Answered', 'Answered', '2017-06-11 03:47:14', '2017-06-11 03:47:14'),
(259, 1, 'Customer Reply', 'Customer Reply', '2017-06-11 03:47:14', '2017-06-11 03:47:14'),
(260, 1, 'Department Email', 'Department Email', '2017-06-11 03:47:14', '2017-06-11 03:47:14'),
(261, 1, 'Show in Client', 'Show in Client', '2017-06-11 03:47:14', '2017-06-11 03:47:14'),
(262, 1, 'Yes', 'Yes', '2017-06-11 03:47:14', '2017-06-11 03:47:14'),
(263, 1, 'No', 'No', '2017-06-11 03:47:14', '2017-06-11 03:47:14'),
(264, 1, 'Add New', 'Add New', '2017-06-11 03:47:15', '2017-06-11 03:47:15'),
(265, 1, 'Manage', 'Manage', '2017-06-11 03:47:15', '2017-06-11 03:47:15'),
(266, 1, 'View Department', 'View Department', '2017-06-11 03:47:15', '2017-06-11 03:47:15'),
(267, 1, 'Ticket For Client', 'Ticket For Client', '2017-06-11 03:47:15', '2017-06-11 03:47:15'),
(268, 1, 'Message', 'Message', '2017-06-11 03:47:15', '2017-06-11 03:47:15'),
(269, 1, 'Create Ticket', 'Create Ticket', '2017-06-11 03:47:15', '2017-06-11 03:47:15'),
(270, 1, 'Manage Support Ticket', 'Manage Support Ticket', '2017-06-11 03:47:15', '2017-06-11 03:47:15'),
(271, 1, 'Change Basic Info', 'Change Basic Info', '2017-06-11 03:47:15', '2017-06-11 03:47:15'),
(272, 1, 'Change Department', 'Change Department', '2017-06-11 03:47:15', '2017-06-11 03:47:15'),
(273, 1, 'Ticket Management', 'Ticket Management', '2017-06-11 03:47:15', '2017-06-11 03:47:15'),
(274, 1, 'Ticket Details', 'Ticket Details', '2017-06-11 03:47:15', '2017-06-11 03:47:15'),
(275, 1, 'Ticket Discussion', 'Ticket Discussion', '2017-06-11 03:47:15', '2017-06-11 03:47:15'),
(276, 1, 'Ticket Files', 'Ticket Files', '2017-06-11 03:47:15', '2017-06-11 03:47:15'),
(277, 1, 'Ticket For', 'Ticket For', '2017-06-11 03:47:15', '2017-06-11 03:47:15'),
(278, 1, 'Created By', 'Created By', '2017-06-11 03:47:15', '2017-06-11 03:47:15'),
(279, 1, 'Closed By', 'Closed By', '2017-06-11 03:47:15', '2017-06-11 03:47:15'),
(280, 1, 'Reply Ticket', 'Reply Ticket', '2017-06-11 03:47:15', '2017-06-11 03:47:15'),
(281, 1, 'General', 'General', '2017-06-11 03:47:15', '2017-06-11 03:47:15'),
(282, 1, 'Office Time', 'Office Time', '2017-06-11 03:47:15', '2017-06-11 03:47:15'),
(283, 1, 'Job', 'Job', '2017-06-11 03:47:15', '2017-06-11 03:47:15'),
(284, 1, 'Application Name', 'Application Name', '2017-06-11 03:47:16', '2017-06-11 03:47:16'),
(285, 1, 'Application Title', 'Application Title', '2017-06-11 03:47:16', '2017-06-11 03:47:16'),
(286, 1, 'System Email', 'System Email', '2017-06-11 03:47:16', '2017-06-11 03:47:16'),
(287, 1, 'Remember: All Email Going to the Receiver from this Email', 'Remember: All Email Going to the Receiver from this Email', '2017-06-11 03:47:16', '2017-06-11 03:47:16'),
(288, 1, 'Footer Text', 'Footer Text', '2017-06-11 03:47:16', '2017-06-11 03:47:16'),
(289, 1, 'Application Logo', 'Application Logo', '2017-06-11 03:47:16', '2017-06-11 03:47:16'),
(290, 1, 'Application Favicon', 'Application Favicon', '2017-06-11 03:47:16', '2017-06-11 03:47:16'),
(291, 1, 'Email Gateway', 'Email Gateway', '2017-06-11 03:47:16', '2017-06-11 03:47:16'),
(292, 1, 'SMTP Host Name', 'SMTP Host Name', '2017-06-11 03:47:16', '2017-06-11 03:47:16'),
(293, 1, 'SMTP User Name', 'SMTP User Name', '2017-06-11 03:47:16', '2017-06-11 03:47:16'),
(294, 1, 'SMTP Password', 'SMTP Password', '2017-06-11 03:47:16', '2017-06-11 03:47:16'),
(295, 1, 'SMTP Port', 'SMTP Port', '2017-06-11 03:47:16', '2017-06-11 03:47:16'),
(296, 1, 'SMTP Secure', 'SMTP Secure', '2017-06-11 03:47:16', '2017-06-11 03:47:16'),
(297, 1, 'Office In Time', 'Office In Time', '2017-06-11 03:47:16', '2017-06-11 03:47:16'),
(298, 1, 'Office Out Time', 'Office Out Time', '2017-06-11 03:47:16', '2017-06-11 03:47:16'),
(299, 1, 'Add New Expense Title', 'Add New Expense Title', '2017-06-11 03:47:16', '2017-06-11 03:47:16'),
(300, 1, 'Expense Title', 'Expense Title', '2017-06-11 03:47:16', '2017-06-11 03:47:16'),
(301, 1, 'Employee Salary', 'Employee Salary', '2017-06-11 03:47:16', '2017-06-11 03:47:16'),
(302, 1, 'Expense Title List', 'Expense Title List', '2017-06-11 03:47:16', '2017-06-11 03:47:16'),
(303, 1, 'Leave Title', 'Leave Title', '2017-06-11 03:47:16', '2017-06-11 03:47:16'),
(304, 1, 'Sick Leave', 'Sick Leave', '2017-06-11 03:47:16', '2017-06-11 03:47:16'),
(305, 1, 'Leave Quota', 'Leave Quota', '2017-06-11 03:47:16', '2017-06-11 03:47:16'),
(306, 1, 'Leave Title List', 'Leave Title List', '2017-06-11 03:47:17', '2017-06-11 03:47:17'),
(307, 1, 'Best Employee', 'Best Employee', '2017-06-11 03:47:17', '2017-06-11 03:47:17'),
(308, 1, 'Job File Extension', 'Job File Extension', '2017-06-11 03:47:17', '2017-06-11 03:47:17'),
(309, 1, 'Supported File Extension', 'Supported File Extension', '2017-06-11 03:47:17', '2017-06-11 03:47:17'),
(310, 1, 'Remember: File Extension Separated By Comma', 'Remember: File Extension Separated By Comma', '2017-06-11 03:47:17', '2017-06-11 03:47:17'),
(311, 1, 'Award Name List', 'Award Name List', '2017-06-11 03:47:17', '2017-06-11 03:47:17'),
(312, 1, 'Save', 'Save', '2017-06-11 03:47:17', '2017-06-11 03:47:17'),
(313, 1, 'Default Country', 'Default Country', '2017-06-11 03:47:17', '2017-06-11 03:47:17'),
(314, 1, 'Date Format', 'Date Format', '2017-06-11 03:47:17', '2017-06-11 03:47:17'),
(315, 1, 'Default Language', 'Default Language', '2017-06-11 03:47:17', '2017-06-11 03:47:17'),
(316, 1, 'Current Code', 'Current Code', '2017-06-11 03:47:17', '2017-06-11 03:47:17'),
(317, 1, 'Current Symbol', 'Current Symbol', '2017-06-11 03:47:17', '2017-06-11 03:47:17'),
(318, 1, 'Email Templates', 'Email Templates', '2017-06-11 03:47:17', '2017-06-11 03:47:17'),
(319, 1, 'Template Name', 'Template Name', '2017-06-11 03:47:17', '2017-06-11 03:47:17'),
(320, 1, 'Manage Email Template', 'Manage Email Template', '2017-06-11 03:47:17', '2017-06-11 03:47:17'),
(321, 1, 'Language', 'Language', '2017-06-11 03:47:17', '2017-06-11 03:47:17'),
(322, 1, 'Add Language', 'Add Language', '2017-06-11 03:47:17', '2017-06-11 03:47:17'),
(323, 1, 'Language Name', 'Language Name', '2017-06-11 03:47:17', '2017-06-11 03:47:17'),
(324, 1, 'Flag', 'Flag', '2017-06-11 03:47:17', '2017-06-11 03:47:17'),
(325, 1, 'All Languages', 'All Languages', '2017-06-11 03:47:17', '2017-06-11 03:47:17'),
(326, 1, 'Translate', 'Translate', '2017-06-11 03:47:17', '2017-06-11 03:47:17'),
(327, 1, 'To', 'To', '2017-06-11 03:47:17', '2017-06-11 03:47:17'),
(328, 1, 'Current Password', 'Current Password', '2017-06-11 03:47:18', '2017-06-11 03:47:18'),
(329, 1, 'New Password', 'New Password', '2017-06-11 03:47:18', '2017-06-11 03:47:18'),
(330, 1, 'All Leave Details', 'All Leave Details', '2017-06-11 03:47:18', '2017-06-11 03:47:18'),
(331, 1, 'Total Leave', 'Total Leave', '2017-06-11 03:47:18', '2017-06-11 03:47:18'),
(332, 1, 'New Leave', 'New Leave', '2017-06-11 03:47:18', '2017-06-11 03:47:18'),
(333, 1, 'Request For New Leave', 'Request For New Leave', '2017-06-11 03:47:18', '2017-06-11 03:47:18'),
(334, 1, 'Send', 'Send', '2017-06-11 03:47:18', '2017-06-11 03:47:18'),
(335, 1, 'Published Date', 'Published Date', '2017-06-11 03:47:18', '2017-06-11 03:47:18'),
(336, 1, 'Payment History', 'Payment History', '2017-06-11 03:47:18', '2017-06-11 03:47:18'),
(337, 1, 'Payment Salary Details', 'Payment Salary Details', '2017-06-11 03:47:18', '2017-06-11 03:47:18'),
(338, 1, 'Print Payslip', 'Print Payslip', '2017-06-11 03:47:18', '2017-06-11 03:47:18'),
(339, 1, 'Salary Month', 'Salary Month', '2017-06-11 03:47:18', '2017-06-11 03:47:18'),
(340, 1, 'Employee ID', 'Employee ID', '2017-06-11 03:47:18', '2017-06-11 03:47:18'),
(341, 1, 'Payslip NO', 'Payslip NO', '2017-06-11 03:47:18', '2017-06-11 03:47:18'),
(342, 1, 'Joining Date', 'Joining Date', '2017-06-11 03:47:18', '2017-06-11 03:47:18'),
(343, 1, 'Payment By', 'Payment By', '2017-06-11 03:47:18', '2017-06-11 03:47:18'),
(344, 1, 'Payment Details', 'Payment Details', '2017-06-11 03:47:18', '2017-06-11 03:47:18'),
(345, 1, 'Earning', 'Earning', '2017-06-11 03:47:18', '2017-06-11 03:47:18'),
(346, 1, 'Grand Total', 'Grand Total', '2017-06-11 03:47:18', '2017-06-11 03:47:18'),
(347, 1, 'Overtime Amount', 'Overtime Amount', '2017-06-11 03:47:19', '2017-06-11 03:47:19'),
(348, 1, 'Job Type', 'Job Type', '2017-06-11 03:47:19', '2017-06-11 03:47:19'),
(349, 1, 'Contractual', 'Contractual', '2017-06-11 03:47:19', '2017-06-11 03:47:19'),
(350, 1, 'Part Time', 'Part Time', '2017-06-11 03:47:19', '2017-06-11 03:47:19'),
(351, 1, 'Full Time', 'Full Time', '2017-06-11 03:47:19', '2017-06-11 03:47:19'),
(352, 1, 'Experience', 'Experience', '2017-06-11 03:47:19', '2017-06-11 03:47:19'),
(353, 1, 'Age', 'Age', '2017-06-11 03:47:19', '2017-06-11 03:47:19'),
(354, 1, 'Job Location', 'Job Location', '2017-06-11 03:47:19', '2017-06-11 03:47:19'),
(355, 1, 'Salary Range', 'Salary Range', '2017-06-11 03:47:19', '2017-06-11 03:47:19'),
(356, 1, 'Short Description', 'Short Description', '2017-06-11 03:47:19', '2017-06-11 03:47:19'),
(357, 1, 'Edit Job', 'Edit Job', '2017-06-11 03:47:19', '2017-06-11 03:47:19'),
(358, 1, 'All Jobs', 'All Jobs', '2017-06-11 03:47:19', '2017-06-11 03:47:19'),
(359, 1, 'Home', 'Home', '2017-06-11 03:47:19', '2017-06-11 03:47:19'),
(360, 1, 'Jobs', 'Jobs', '2017-06-11 03:47:19', '2017-06-11 03:47:19'),
(361, 1, 'Deadline', 'Deadline', '2017-06-11 03:47:19', '2017-06-11 03:47:19'),
(362, 1, 'Job Summary', 'Job Summary', '2017-06-11 03:47:19', '2017-06-11 03:47:19'),
(363, 1, 'Published on', 'Published on', '2017-06-11 03:47:19', '2017-06-11 03:47:19'),
(364, 1, 'Application Deadline', 'Application Deadline', '2017-06-11 03:47:19', '2017-06-11 03:47:19'),
(365, 1, 'Apply Now', 'Apply Now', '2017-06-11 03:47:19', '2017-06-11 03:47:19'),
(366, 1, 'Apply For', 'Apply For', '2017-06-11 03:47:19', '2017-06-11 03:47:19'),
(367, 1, 'Upload Resume', 'Upload Resume', '2017-06-11 03:47:19', '2017-06-11 03:47:19'),
(368, 1, 'Apply', 'Apply', '2017-06-11 03:47:20', '2017-06-11 03:47:20'),
(369, 1, 'Language Manage', 'Language Manage', '2017-06-11 03:47:20', '2017-06-11 03:47:20'),
(370, 1, 'View All', 'View All', '2017-06-11 03:47:20', '2017-06-11 03:47:20'),
(371, 1, 'Expense Request', 'Expense Request', '2017-06-11 03:47:20', '2017-06-11 03:47:20'),
(372, 1, 'Recent', 'Recent', '2017-06-11 03:47:20', '2017-06-11 03:47:20'),
(373, 1, 'Tasks', 'Tasks', '2017-06-11 03:47:20', '2017-06-11 03:47:20'),
(374, 1, 'Timezone', 'Timezone', '2017-06-11 03:47:20', '2017-06-11 03:47:20'),
(375, 1, 'Today is', 'Today is', '2017-06-11 03:47:20', '2017-06-11 03:47:20'),
(376, 1, 'Time', 'Time', '2017-06-11 03:47:20', '2017-06-11 03:47:20'),
(377, 1, 'Notice', 'Notice', '2017-06-11 03:47:20', '2017-06-11 03:47:20'),
(378, 1, 'Total', 'Total', '2017-06-11 03:47:20', '2017-06-11 03:47:20'),
(379, 1, 'Subtotal', 'Subtotal', '2017-06-11 03:47:20', '2017-06-11 03:47:20'),
(380, 1, 'TAX', 'TAX', '2017-06-11 03:47:20', '2017-06-11 03:47:20'),
(381, 1, 'Edit Department', 'Edit Department', '2017-06-11 03:47:20', '2017-06-11 03:47:20'),
(382, 1, 'Job Applicants', 'Job Applicants', '2017-06-11 03:47:20', '2017-06-11 03:47:20'),
(383, 1, 'Unread', 'Unread', '2017-06-11 03:47:20', '2017-06-11 03:47:20'),
(384, 1, 'Primary Selected', 'Primary Selected', '2017-06-11 03:47:20', '2017-06-11 03:47:20'),
(385, 1, 'Call For Interview', 'Call For Interview', '2017-06-11 03:47:20', '2017-06-11 03:47:20'),
(386, 1, 'Confirm', 'Confirm', '2017-06-11 03:47:20', '2017-06-11 03:47:20'),
(387, 1, 'Rejected', 'Rejected', '2017-06-11 03:47:20', '2017-06-11 03:47:20'),
(388, 1, 'Resume', 'Resume', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(389, 1, 'Status', 'Status', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(390, 1, 'View Holiday', 'View Holiday', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(391, 1, 'Tax Rules', 'Tax Rules', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(392, 1, 'Add Tax Rule', 'Add Tax Rule', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(393, 1, 'Tax Rule Name', 'Tax Rule Name', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(394, 1, 'Set Rules', 'Set Rules', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(395, 1, 'Save Values', 'Save Values', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(396, 1, 'Salary From', 'Salary From', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(397, 1, 'Salary To', 'Salary To', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(398, 1, 'Tax Percentage', 'Tax Percentage', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(399, 1, 'Additional Tax Amount', 'Additional Tax Amount', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(400, 1, 'Gender', 'Gender', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(401, 1, 'Both', 'Both', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(402, 1, 'Male', 'Male', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(403, 1, 'Female', 'Female', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(404, 1, 'Remove', 'Remove', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(405, 1, 'Add More', 'Add More', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(406, 1, 'Provident Fund', 'Provident Fund', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(407, 1, 'Provident Fund Type', 'Provident Fund Type', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(408, 1, 'Employee Share', 'Employee Share', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(409, 1, 'Organization Share', 'Organization Share', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(410, 1, 'Paid', 'Paid', '2017-06-11 03:47:21', '2017-06-11 03:47:21'),
(411, 1, 'Unpaid', 'Unpaid', '2017-06-11 03:47:22', '2017-06-11 03:47:22'),
(412, 1, 'Loan', 'Loan', '2017-06-11 03:47:22', '2017-06-11 03:47:22'),
(413, 1, 'Repayment Start Date', 'Repayment Start Date', '2017-06-11 03:47:22', '2017-06-11 03:47:22'),
(414, 1, 'Remaining Amount', 'Remaining Amount', '2017-06-11 03:47:22', '2017-06-11 03:47:22'),
(415, 1, 'Ongoing', 'Ongoing', '2017-06-11 03:47:22', '2017-06-11 03:47:22'),
(416, 1, 'Include Loan Amount in Payslip', 'Include Loan Amount in Payslip', '2017-06-11 03:47:22', '2017-06-11 03:47:22'),
(417, 1, 'Monthly Repayment Amount', 'Monthly Repayment Amount', '2017-06-11 03:47:22', '2017-06-11 03:47:22'),
(418, 1, 'Employee Salary Increment', 'Employee Salary Increment', '2017-06-11 03:47:22', '2017-06-11 03:47:22'),
(419, 1, 'SMS Gateways', 'SMS Gateways', '2017-06-11 03:47:22', '2017-06-11 03:47:22'),
(420, 1, 'Gateway Name', 'Gateway Name', '2017-06-11 03:47:22', '2017-06-11 03:47:22'),
(421, 1, 'API Link', 'API Link', '2017-06-11 03:47:22', '2017-06-11 03:47:22'),
(422, 1, 'Tax Template', 'Tax Template', '2017-06-11 03:47:22', '2017-06-11 03:47:22'),
(423, 1, 'Salary Type', 'Salary Type', '2017-06-11 03:47:22', '2017-06-11 03:47:22'),
(424, 1, 'Monthly', 'Monthly', '2017-06-11 03:47:22', '2017-06-11 03:47:22'),
(425, 1, 'Hourly', 'Hourly', '2017-06-11 03:47:22', '2017-06-11 03:47:22'),
(426, 1, 'Basic Salary', 'Basic Salary', '2017-06-11 03:47:22', '2017-06-11 03:47:22'),
(427, 1, 'Overtime Salary', 'Overtime Salary', '2017-06-11 03:47:22', '2017-06-11 03:47:22'),
(428, 1, 'Reports', 'Reports', '2017-06-11 03:47:22', '2017-06-11 03:47:22'),
(429, 1, 'Employee Payroll Summery', 'Employee Payroll Summery', '2017-06-11 03:47:22', '2017-06-11 03:47:22'),
(430, 1, 'No working hour', 'No working hour', '2017-06-11 03:47:22', '2017-06-11 03:47:22'),
(431, 1, 'Add with basic salary', 'Add with basic salary', '2017-06-11 03:47:23', '2017-06-11 03:47:23'),
(432, 1, 'Salary Statement', 'Salary Statement', '2017-06-11 03:47:23', '2017-06-11 03:47:23'),
(433, 1, 'Date From', 'Date From', '2017-06-11 03:47:23', '2017-06-11 03:47:23'),
(434, 1, 'Date To', 'Date To', '2017-06-11 03:47:23', '2017-06-11 03:47:23'),
(435, 1, 'Find', 'Find', '2017-06-11 03:47:23', '2017-06-11 03:47:23'),
(436, 1, 'Send Email', 'Send Email', '2017-06-11 03:47:23', '2017-06-11 03:47:23'),
(437, 1, 'Send SMS', 'Send SMS', '2017-06-11 03:47:23', '2017-06-11 03:47:23'),
(438, 1, 'For', 'For', '2017-06-11 03:47:23', '2017-06-11 03:47:23'),
(439, 1, 'Employee Summery', 'Employee Summery', '2017-06-11 03:47:23', '2017-06-11 03:47:23'),
(440, 1, 'Set Working Rate', 'Set Working Rate', '2017-06-11 03:47:23', '2017-06-11 03:47:23'),
(441, 1, 'Generate PDF', 'Generate PDF', '2017-06-11 03:47:23', '2017-06-11 03:47:23'),
(442, 1, 'Training', 'Training', '2017-06-11 03:47:23', '2017-06-11 03:47:23'),
(443, 1, 'Training Needs Assessment', 'Training Needs Assessment', '2017-06-11 03:47:23', '2017-06-11 03:47:23'),
(444, 1, 'Training Events', 'Training Events', '2017-06-11 03:47:23', '2017-06-11 03:47:23'),
(445, 1, 'Trainers', 'Trainers', '2017-06-11 03:47:23', '2017-06-11 03:47:23'),
(446, 1, 'Trainer', 'Trainer', '2017-06-11 03:47:23', '2017-06-11 03:47:23'),
(447, 1, 'Training Evaluations', 'Training Evaluations', '2017-06-11 03:47:23', '2017-06-11 03:47:23'),
(448, 1, 'Add New Trainer', 'Add New Trainer', '2017-06-11 03:47:23', '2017-06-11 03:47:23'),
(449, 1, 'Organization', 'Organization', '2017-06-11 03:47:23', '2017-06-11 03:47:23'),
(450, 1, 'City', 'City', '2017-06-11 03:47:23', '2017-06-11 03:47:23'),
(451, 1, 'State', 'State', '2017-06-11 03:47:24', '2017-06-11 03:47:24'),
(452, 1, 'Country', 'Country', '2017-06-11 03:47:24', '2017-06-11 03:47:24'),
(453, 1, 'Zip Code', 'Zip Code', '2017-06-11 03:47:24', '2017-06-11 03:47:24'),
(454, 1, 'Trainer Expertise', 'Trainer Expertise', '2017-06-11 03:47:24', '2017-06-11 03:47:24'),
(455, 1, 'View Trainer Info', 'View Trainer Info', '2017-06-11 03:47:24', '2017-06-11 03:47:24'),
(456, 1, 'Employee Training', 'Employee Training', '2017-06-11 03:47:24', '2017-06-11 03:47:24'),
(457, 1, 'Add New Training', 'Add New Training', '2017-06-11 03:47:24', '2017-06-11 03:47:24'),
(458, 1, 'Training Type', 'Training Type', '2017-06-11 03:47:24', '2017-06-11 03:47:24'),
(459, 1, 'Training From', 'Training From', '2017-06-11 03:47:24', '2017-06-11 03:47:24'),
(460, 1, 'Training To', 'Training To', '2017-06-11 03:47:24', '2017-06-11 03:47:24'),
(461, 1, 'Online Training', 'Online Training', '2017-06-11 03:47:24', '2017-06-11 03:47:24'),
(462, 1, 'Seminar', 'Seminar', '2017-06-11 03:47:24', '2017-06-11 03:47:24'),
(463, 1, 'Lecture', 'Lecture', '2017-06-11 03:47:24', '2017-06-11 03:47:24'),
(464, 1, 'Workshop', 'Workshop', '2017-06-11 03:47:24', '2017-06-11 03:47:24'),
(465, 1, 'Hands On Training', 'Hands On Training', '2017-06-11 03:47:24', '2017-06-11 03:47:24'),
(466, 1, 'Webinar', 'Webinar', '2017-06-11 03:47:24', '2017-06-11 03:47:24'),
(467, 1, 'HR Training', 'HR Training', '2017-06-11 03:47:24', '2017-06-11 03:47:24'),
(468, 1, 'Employees Development', 'Employees Development', '2017-06-11 03:47:24', '2017-06-11 03:47:24'),
(469, 1, 'IT Training', 'IT Training', '2017-06-11 03:47:24', '2017-06-11 03:47:24'),
(470, 1, 'Finance Training', 'Finance Training', '2017-06-11 03:47:25', '2017-06-11 03:47:25'),
(471, 1, 'Nature Of Training', 'Nature Of Training', '2017-06-11 03:47:25', '2017-06-11 03:47:25'),
(472, 1, 'Internal', 'Internal', '2017-06-11 03:47:25', '2017-06-11 03:47:25'),
(473, 1, 'External', 'External', '2017-06-11 03:47:25', '2017-06-11 03:47:25'),
(474, 1, 'Training Location', 'Training Location', '2017-06-11 03:47:25', '2017-06-11 03:47:25'),
(475, 1, 'Sponsored By', 'Sponsored By', '2017-06-11 03:47:25', '2017-06-11 03:47:25'),
(476, 1, 'Organized By', 'Organized By', '2017-06-11 03:47:25', '2017-06-11 03:47:25'),
(477, 1, 'View Employee Training', 'View Employee Training', '2017-06-11 03:47:25', '2017-06-11 03:47:25'),
(478, 1, 'Preferred', 'Preferred', '2017-06-11 03:47:25', '2017-06-11 03:47:25'),
(479, 1, 'End Date', 'End Date', '2017-06-11 03:47:25', '2017-06-11 03:47:25'),
(480, 1, 'Reason', 'Reason', '2017-06-11 03:47:25', '2017-06-11 03:47:25'),
(481, 1, 'Training Cost', 'Training Cost', '2017-06-11 03:47:25', '2017-06-11 03:47:25'),
(482, 1, 'Travel Cost', 'Travel Cost', '2017-06-11 03:47:25', '2017-06-11 03:47:25'),
(483, 1, 'Add New Event', 'Add New Event', '2017-06-11 03:47:25', '2017-06-11 03:47:25'),
(484, 1, 'Upcoming', 'Upcoming', '2017-06-11 03:47:25', '2017-06-11 03:47:25'),
(485, 1, 'Externals', 'Externals', '2017-06-11 03:47:26', '2017-06-11 03:47:26'),
(486, 1, 'Employee Roles', 'Employee Roles', '2017-06-11 03:47:26', '2017-06-11 03:47:26'),
(487, 1, 'Role Name', 'Role Name', '2017-06-11 03:47:26', '2017-06-11 03:47:26'),
(488, 1, 'Set Roles', 'Set Roles', '2017-06-11 03:47:26', '2017-06-11 03:47:26'),
(489, 1, 'My Portal', 'My Portal', '2017-06-11 03:47:26', '2017-06-11 03:47:26'),
(490, 1, 'Disable Menu/Module', 'Disable Menu/Module', '2017-06-11 03:47:26', '2017-06-11 03:47:26'),
(491, 1, 'Menu Name', 'Menu Name', '2017-06-11 03:47:26', '2017-06-11 03:47:26'),
(492, 1, 'You do not have permission to view this page', 'You do not have permission to view this page', '2017-06-11 03:47:26', '2017-06-11 03:47:26'),
(493, 1, 'Insert your time perfectly', 'Insert your time perfectly', '2017-06-11 03:47:26', '2017-06-11 03:47:26'),
(494, 1, 'Attendance Updated Successfully', 'Attendance Updated Successfully', '2017-06-11 03:47:26', '2017-06-11 03:47:26'),
(495, 1, 'Attendance Info Not Found', 'Attendance Info Not Found', '2017-06-11 03:47:26', '2017-06-11 03:47:26'),
(496, 1, 'Office time: In Time', 'Office time: In Time', '2017-06-11 03:47:26', '2017-06-11 03:47:26'),
(497, 1, 'and Out Time', 'and Out Time', '2017-06-11 03:47:26', '2017-06-11 03:47:26'),
(498, 1, 'This Option is Disable In Demo Mode', 'This Option is Disable In Demo Mode', '2017-06-11 03:47:26', '2017-06-11 03:47:26'),
(499, 1, 'Attendance Deleted Successfully', 'Attendance Deleted Successfully', '2017-06-11 03:47:26', '2017-06-11 03:47:26'),
(500, 1, 'Attendance Update Successfully', 'Attendance Update Successfully', '2017-06-11 03:47:26', '2017-06-11 03:47:26'),
(501, 1, 'Award Added Successfully', 'Award Added Successfully', '2017-06-11 03:47:26', '2017-06-11 03:47:26'),
(502, 1, 'Award Deleted Successfully', 'Award Deleted Successfully', '2017-06-11 03:47:26', '2017-06-11 03:47:26'),
(503, 1, 'Award Not Found', 'Award Not Found', '2017-06-11 03:47:27', '2017-06-11 03:47:27'),
(504, 1, 'Award Updated Successfully', 'Award Updated Successfully', '2017-06-11 03:47:27', '2017-06-11 03:47:27'),
(505, 1, 'Department Added Successfully', 'Department Added Successfully', '2017-06-11 03:47:27', '2017-06-11 03:47:27'),
(506, 1, 'Department Already Exist', 'Department Already Exist', '2017-06-11 03:47:27', '2017-06-11 03:47:27'),
(507, 1, 'Department Updated Successfully', 'Department Updated Successfully', '2017-06-11 03:47:27', '2017-06-11 03:47:27'),
(508, 1, 'Department Not Found', 'Department Not Found', '2017-06-11 03:47:27', '2017-06-11 03:47:27'),
(509, 1, 'Employee added on this department. To remove; unassigned employee', 'Employee added on this department. To remove; unassigned employee', '2017-06-11 03:47:27', '2017-06-11 03:47:27'),
(510, 1, 'Department Deleted Successfully', 'Department Deleted Successfully', '2017-06-11 03:47:27', '2017-06-11 03:47:27'),
(511, 1, 'Designation Added Successfully', 'Designation Added Successfully', '2017-06-11 03:47:27', '2017-06-11 03:47:27'),
(512, 1, 'Designation Already Exist', 'Designation Already Exist', '2017-06-11 03:47:27', '2017-06-11 03:47:27'),
(513, 1, 'Employee added on this designation. To remove; unassigned employee', 'Employee added on this designation. To remove; unassigned employee', '2017-06-11 03:47:27', '2017-06-11 03:47:27'),
(514, 1, 'Designation Deleted Successfully', 'Designation Deleted Successfully', '2017-06-11 03:47:27', '2017-06-11 03:47:27'),
(515, 1, 'Designation Not Found', 'Designation Not Found', '2017-06-11 03:47:27', '2017-06-11 03:47:27'),
(516, 1, 'Designation Update Successfully', 'Designation Update Successfully', '2017-06-11 03:47:27', '2017-06-11 03:47:27'),
(517, 1, 'Employee Code Already Exist', 'Employee Code Already Exist', '2017-06-11 03:47:27', '2017-06-11 03:47:27'),
(518, 1, 'Username Already Exist', 'Username Already Exist', '2017-06-11 03:47:27', '2017-06-11 03:47:27'),
(519, 1, 'Email Already Exist', 'Email Already Exist', '2017-06-11 03:47:27', '2017-06-11 03:47:27'),
(520, 1, 'Both Password Does not Match', 'Both Password Does not Match', '2017-06-11 03:47:27', '2017-06-11 03:47:27'),
(521, 1, 'Employee Added Successfully But Email Not Send', 'Employee Added Successfully But Email Not Send', '2017-06-11 03:47:27', '2017-06-11 03:47:27'),
(522, 1, 'Employee Added Successfully', 'Employee Added Successfully', '2017-06-11 03:47:27', '2017-06-11 03:47:27'),
(523, 1, 'Employee Not Found', 'Employee Not Found', '2017-06-11 03:47:27', '2017-06-11 03:47:27'),
(524, 1, 'Employee Updated Successfully', 'Employee Updated Successfully', '2017-06-11 03:47:27', '2017-06-11 03:47:27'),
(525, 1, 'Avatar Changed Successfully', 'Avatar Changed Successfully', '2017-06-11 03:47:28', '2017-06-11 03:47:28'),
(526, 1, 'Upload an Image', 'Upload an Image', '2017-06-11 03:47:28', '2017-06-11 03:47:28'),
(527, 1, 'Bank Account Added Successfully', 'Bank Account Added Successfully', '2017-06-11 03:47:28', '2017-06-11 03:47:28'),
(528, 1, 'Bank Account Already Exist', 'Bank Account Already Exist', '2017-06-11 03:47:28', '2017-06-11 03:47:28'),
(529, 1, 'Bank Account Deleted Successfully', 'Bank Account Deleted Successfully', '2017-06-11 03:47:28', '2017-06-11 03:47:28'),
(530, 1, 'Bank Account Not Found', 'Bank Account Not Found', '2017-06-11 03:47:28', '2017-06-11 03:47:28'),
(531, 1, 'This Document Already Exist', 'This Document Already Exist', '2017-06-11 03:47:28', '2017-06-11 03:47:28'),
(532, 1, 'Document Uploaded Successfully', 'Document Uploaded Successfully', '2017-06-11 03:47:28', '2017-06-11 03:47:28'),
(533, 1, 'Document Deleted Successfully', 'Document Deleted Successfully', '2017-06-11 03:47:28', '2017-06-11 03:47:28'),
(534, 1, 'Document Not Found', 'Document Not Found', '2017-06-11 03:47:28', '2017-06-11 03:47:28'),
(535, 1, 'Employee Deleted Successfully', 'Employee Deleted Successfully', '2017-06-11 03:47:29', '2017-06-11 03:47:29'),
(536, 1, 'Employee Role added successfully', 'Employee Role added successfully', '2017-06-11 03:47:29', '2017-06-11 03:47:29'),
(537, 1, 'Employee Role updated successfully', 'Employee Role updated successfully', '2017-06-11 03:47:29', '2017-06-11 03:47:29'),
(538, 1, 'Employee Role info not found', 'Employee Role info not found', '2017-06-11 03:47:29', '2017-06-11 03:47:29'),
(539, 1, 'Permission not assigned', 'Permission not assigned', '2017-06-11 03:47:29', '2017-06-11 03:47:29'),
(540, 1, 'Permission Updated', 'Permission Updated', '2017-06-11 03:47:29', '2017-06-11 03:47:29'),
(541, 1, 'An Employee contain this role', 'An Employee contain this role', '2017-06-11 03:47:29', '2017-06-11 03:47:29'),
(542, 1, 'Employee role deleted successfully', 'Employee role deleted successfully', '2017-06-11 03:47:29', '2017-06-11 03:47:29'),
(543, 1, 'Leave Request Send Successfully', 'Leave Request Send Successfully', '2017-06-11 03:47:29', '2017-06-11 03:47:29'),
(544, 1, 'Expense Added Successfully', 'Expense Added Successfully', '2017-06-11 03:47:29', '2017-06-11 03:47:29'),
(545, 1, 'Support Ticket Created Successfully But Email Not Send', 'Support Ticket Created Successfully But Email Not Send', '2017-06-11 03:47:29', '2017-06-11 03:47:29'),
(546, 1, 'Support Ticket Created Successfully', 'Support Ticket Created Successfully', '2017-06-11 03:47:29', '2017-06-11 03:47:29'),
(547, 1, 'Basic Info Update Successfully', 'Basic Info Update Successfully', '2017-06-11 03:47:29', '2017-06-11 03:47:29'),
(548, 1, 'Ticket Reply Successfully But Email Not Send', 'Ticket Reply Successfully But Email Not Send', '2017-06-11 03:47:29', '2017-06-11 03:47:29'),
(549, 1, 'Ticket Reply Successfully', 'Ticket Reply Successfully', '2017-06-11 03:47:29', '2017-06-11 03:47:29'),
(550, 1, 'File Uploaded Successfully', 'File Uploaded Successfully', '2017-06-11 03:47:29', '2017-06-11 03:47:29'),
(551, 1, 'File Deleted Successfully', 'File Deleted Successfully', '2017-06-11 03:47:29', '2017-06-11 03:47:29'),
(552, 1, 'Ticket File not found', 'Ticket File not found', '2017-06-11 03:47:30', '2017-06-11 03:47:30'),
(553, 1, 'Please Upload a File', 'Please Upload a File', '2017-06-11 03:47:30', '2017-06-11 03:47:30'),
(554, 1, 'Payment Details Not found', 'Payment Details Not found', '2017-06-11 03:47:30', '2017-06-11 03:47:30'),
(555, 1, 'Ticket Deleted Successfully', 'Ticket Deleted Successfully', '2017-06-11 03:47:30', '2017-06-11 03:47:30'),
(556, 1, 'There Have no Ticket For Delete', 'There Have no Ticket For Delete', '2017-06-11 03:47:30', '2017-06-11 03:47:30'),
(557, 1, 'Comment Posted Successfully', 'Comment Posted Successfully', '2017-06-11 03:47:30', '2017-06-11 03:47:30'),
(558, 1, 'Please try again', 'Please try again', '2017-06-11 03:47:30', '2017-06-11 03:47:30'),
(559, 1, 'Clock In Successfully', 'Clock In Successfully', '2017-06-11 03:47:30', '2017-06-11 03:47:30'),
(560, 1, 'Clock Out Successfully', 'Clock Out Successfully', '2017-06-11 03:47:30', '2017-06-11 03:47:30');
INSERT INTO `sys_language_data` (`id`, `lan_id`, `lan_data`, `lan_value`, `created_at`, `updated_at`) VALUES
(561, 1, 'Loan Added Successfully', 'Loan Added Successfully', '2017-06-11 03:47:30', '2017-06-11 03:47:30'),
(562, 1, 'Loan information not found', 'Loan information not found', '2017-06-11 03:47:30', '2017-06-11 03:47:30'),
(563, 1, 'Loan information updated Successfully', 'Loan information updated Successfully', '2017-06-11 03:47:30', '2017-06-11 03:47:30'),
(564, 1, 'Employee training info not found', 'Employee training info not found', '2017-06-11 03:47:30', '2017-06-11 03:47:30'),
(565, 1, 'Expense Added Successfully', 'Expense Added Successfully', '2017-06-11 03:47:31', '2017-06-11 03:47:31'),
(566, 1, 'Expense Deleted Successfully', 'Expense Deleted Successfully', '2017-06-11 03:47:31', '2017-06-11 03:47:31'),
(567, 1, 'Expense not found', 'Expense not found', '2017-06-11 03:47:31', '2017-06-11 03:47:31'),
(568, 1, 'Expense Updated Successfully', 'Expense Updated Successfully', '2017-06-11 03:47:31', '2017-06-11 03:47:31'),
(569, 1, 'Holiday Added Successfully', 'Holiday Added Successfully', '2017-06-11 03:47:31', '2017-06-11 03:47:31'),
(570, 1, 'Holiday Already Exist', 'Holiday Already Exist', '2017-06-11 03:47:31', '2017-06-11 03:47:31'),
(571, 1, 'Holiday Occasion Not Found', 'Holiday Occasion Not Found', '2017-06-11 03:47:31', '2017-06-11 03:47:31'),
(572, 1, 'Holiday Deleted Successfully', 'Holiday Deleted Successfully', '2017-06-11 03:47:31', '2017-06-11 03:47:31'),
(573, 1, 'Holiday Updated Successfully', 'Holiday Updated Successfully', '2017-06-11 03:47:31', '2017-06-11 03:47:31'),
(574, 1, 'This Job Post Already Exist', 'This Job Post Already Exist', '2017-06-11 03:47:31', '2017-06-11 03:47:31'),
(575, 1, 'Job Added Successfully', 'Job Added Successfully', '2017-06-11 03:47:31', '2017-06-11 03:47:31'),
(576, 1, 'Job not found', 'Job not found', '2017-06-11 03:47:31', '2017-06-11 03:47:31'),
(577, 1, 'Job Update Successfully', 'Job Update Successfully', '2017-06-11 03:47:31', '2017-06-11 03:47:31'),
(578, 1, 'Job Deleted Successfully', 'Job Deleted Successfully', '2017-06-11 03:47:31', '2017-06-11 03:47:31'),
(579, 1, 'Applicant Deleted Successfully', 'Applicant Deleted Successfully', '2017-06-11 03:47:32', '2017-06-11 03:47:32'),
(580, 1, 'Applicant not found', 'Applicant not found', '2017-06-11 03:47:32', '2017-06-11 03:47:32'),
(581, 1, 'Status updated successfully', 'Status updated successfully', '2017-06-11 03:47:32', '2017-06-11 03:47:32'),
(582, 1, 'Leave added Successfully', 'Leave added Successfully', '2017-06-11 03:47:32', '2017-06-11 03:47:32'),
(583, 1, 'Leave Application not found', 'Leave Application not found', '2017-06-11 03:47:32', '2017-06-11 03:47:32'),
(584, 1, 'Leave Application Deleted Successfully', 'Leave Application Deleted Successfully', '2017-06-11 03:47:32', '2017-06-11 03:47:32'),
(585, 1, 'Notice Added Successfully', 'Notice Added Successfully', '2017-06-11 03:47:32', '2017-06-11 03:47:32'),
(586, 1, 'Notice Deleted Successfully', 'Notice Deleted Successfully', '2017-06-11 03:47:32', '2017-06-11 03:47:32'),
(587, 1, 'Notice not found', 'Notice not found', '2017-06-11 03:47:32', '2017-06-11 03:47:32'),
(588, 1, 'Notice Updated Successfully', 'Notice Updated Successfully', '2017-06-11 03:47:32', '2017-06-11 03:47:32'),
(589, 1, 'Salary Updated Successfully', 'Salary Updated Successfully', '2017-06-11 03:47:32', '2017-06-11 03:47:32'),
(590, 1, 'Amount Paid Successfully', 'Amount Paid Successfully', '2017-06-11 03:47:32', '2017-06-11 03:47:32'),
(591, 1, 'Payment Already Paid', 'Payment Already Paid', '2017-06-11 03:47:32', '2017-06-11 03:47:32'),
(592, 1, 'Payment Details Not found', 'Payment Details Not found', '2017-06-11 03:47:32', '2017-06-11 03:47:32'),
(593, 1, 'Provident Fund already running', 'Provident Fund already running', '2017-06-11 03:47:32', '2017-06-11 03:47:32'),
(594, 1, 'Provident Fund Added Successfully', 'Provident Fund Added Successfully', '2017-06-11 03:47:32', '2017-06-11 03:47:32'),
(595, 1, 'Provident Fund information not found', 'Provident Fund information not found', '2017-06-11 03:47:32', '2017-06-11 03:47:32'),
(596, 1, 'Provident Fund Updated Successfully', 'Provident Fund Updated Successfully', '2017-06-11 03:47:32', '2017-06-11 03:47:32'),
(597, 1, 'Provident Fund paid successfully', 'Provident Fund paid successfully', '2017-06-11 03:47:32', '2017-06-11 03:47:32'),
(598, 1, 'Provident Fund delete successfully', 'Provident Fund delete successfully', '2017-06-11 03:47:32', '2017-06-11 03:47:32'),
(599, 1, 'Loan Added Successfully', 'Loan Added Successfully', '2017-06-11 03:47:33', '2017-06-11 03:47:33'),
(600, 1, 'Loan information not found', 'Loan information not found', '2017-06-11 03:47:33', '2017-06-11 03:47:33'),
(601, 1, 'Loan information delete Successfully', 'Loan information delete Successfully', '2017-06-11 03:47:33', '2017-06-11 03:47:33'),
(602, 1, 'User pay transaction data not found', 'User pay transaction data not found', '2017-06-11 03:47:33', '2017-06-11 03:47:33'),
(603, 1, 'Please check your email setting', 'Please check your email setting', '2017-06-11 03:47:33', '2017-06-11 03:47:33'),
(604, 1, 'Email send successfully', 'Email send successfully', '2017-06-11 03:47:33', '2017-06-11 03:47:33'),
(605, 1, 'SMS sent successfully', 'SMS sent successfully', '2017-06-11 03:47:33', '2017-06-11 03:47:33'),
(606, 1, 'Please check your Twilio Credentials', 'Please check your Twilio Credentials', '2017-06-11 03:47:33', '2017-06-11 03:47:33'),
(607, 1, 'Success', 'Success', '2017-06-11 03:47:33', '2017-06-11 03:47:33'),
(608, 1, 'User Validation Failed', 'User Validation Failed', '2017-06-11 03:47:33', '2017-06-11 03:47:33'),
(609, 1, 'Insufficient Credit', 'Insufficient Credit', '2017-06-11 03:47:33', '2017-06-11 03:47:33'),
(610, 1, 'Internal Error', 'Internal Error', '2017-06-11 03:47:33', '2017-06-11 03:47:33'),
(611, 1, 'Invalid receiver', 'Invalid receiver', '2017-06-11 03:47:33', '2017-06-11 03:47:33'),
(612, 1, 'Invalid SMS', 'Invalid SMS', '2017-06-11 03:47:33', '2017-06-11 03:47:33'),
(613, 1, 'Invalid sender', 'Invalid sender', '2017-06-11 03:47:33', '2017-06-11 03:47:33'),
(614, 1, 'In progress', 'In progress', '2017-06-11 03:47:33', '2017-06-11 03:47:33'),
(615, 1, 'Scheduled', 'Scheduled', '2017-06-11 03:47:33', '2017-06-11 03:47:33'),
(616, 1, 'Authentication failure', 'Authentication failure', '2017-06-11 03:47:33', '2017-06-11 03:47:33'),
(617, 1, 'Data validation failed', 'Data validation failed', '2017-06-11 03:47:33', '2017-06-11 03:47:33'),
(618, 1, 'Upstream credits not available', 'Upstream credits not available', '2017-06-11 03:47:33', '2017-06-11 03:47:33'),
(619, 1, 'You have exceeded your daily quota', 'You have exceeded your daily quota', '2017-06-11 03:47:34', '2017-06-11 03:47:34'),
(620, 1, 'Upstream quota exceeded', 'Upstream quota exceeded', '2017-06-11 03:47:34', '2017-06-11 03:47:34'),
(621, 1, 'Temporarily unavailable', 'Temporarily unavailable', '2017-06-11 03:47:34', '2017-06-11 03:47:34'),
(622, 1, 'Maximum batch size exceeded', 'Maximum batch size exceeded', '2017-06-11 03:47:34', '2017-06-11 03:47:34'),
(623, 1, 'Failed', 'Failed', '2017-06-11 03:47:34', '2017-06-11 03:47:34'),
(624, 1, 'Gateway information not found', 'Gateway information not found', '2017-06-11 03:47:34', '2017-06-11 03:47:34'),
(625, 1, 'Setting Update Successfully', 'Setting Update Successfully', '2017-06-11 03:47:34', '2017-06-11 03:47:34'),
(626, 1, 'Expense Title Added Successfully', 'Expense Title Added Successfully', '2017-06-11 03:47:34', '2017-06-11 03:47:34'),
(627, 1, 'Expense Title Already Exist', 'Expense Title Already Exist', '2017-06-11 03:47:34', '2017-06-11 03:47:34'),
(628, 1, 'Leave Type Added Successfully', 'Leave Type Added Successfully', '2017-06-11 03:47:34', '2017-06-11 03:47:34'),
(629, 1, 'Leave Type Already Exist', 'Leave Type Already Exist', '2017-06-11 03:47:34', '2017-06-11 03:47:34'),
(630, 1, 'Award Added Successfully', 'Award Added Successfully', '2017-06-11 03:47:34', '2017-06-11 03:47:34'),
(631, 1, 'Award Already Exist', 'Award Already Exist', '2017-06-11 03:47:34', '2017-06-11 03:47:34'),
(632, 1, 'File Extension Update Successfully', 'File Extension Update Successfully', '2017-06-11 03:47:34', '2017-06-11 03:47:34'),
(633, 1, 'Email Template Not Found', 'Email Template Not Found', '2017-06-11 03:47:34', '2017-06-11 03:47:34'),
(634, 1, 'Email Template Update Successfully', 'Email Template Update Successfully', '2017-06-11 03:47:34', '2017-06-11 03:47:34'),
(635, 1, 'Language Already Exist', 'Language Already Exist', '2017-06-11 03:47:34', '2017-06-11 03:47:34'),
(636, 1, 'Language Added Successfully', 'Language Added Successfully', '2017-06-11 03:47:35', '2017-06-11 03:47:35'),
(637, 1, 'Language Translate Successfully', 'Language Translate Successfully', '2017-06-11 03:47:35', '2017-06-11 03:47:35'),
(638, 1, 'Language not found', 'Language not found', '2017-06-11 03:47:35', '2017-06-11 03:47:35'),
(639, 1, 'Language updated Successfully', 'Language updated Successfully', '2017-06-11 03:47:35', '2017-06-11 03:47:35'),
(640, 1, 'Language deleted successfully', 'Language deleted successfully', '2017-06-11 03:47:35', '2017-06-11 03:47:35'),
(641, 1, 'Expense title deleted successfully', 'Expense title deleted successfully', '2017-06-11 03:47:35', '2017-06-11 03:47:35'),
(642, 1, 'Expense title not found', 'Expense title not found', '2017-06-11 03:47:35', '2017-06-11 03:47:35'),
(643, 1, 'Leave type deleted successfully', 'Leave type deleted successfully', '2017-06-11 03:47:35', '2017-06-11 03:47:35'),
(644, 1, 'Leave type not found', 'Leave type not found', '2017-06-11 03:47:35', '2017-06-11 03:47:35'),
(645, 1, 'Award name deleted successfully', 'Award name deleted successfully', '2017-06-11 03:47:35', '2017-06-11 03:47:35'),
(646, 1, 'Award name not found', 'Award name not found', '2017-06-11 03:47:35', '2017-06-11 03:47:35'),
(647, 1, 'Expense Title Updated Successfully', 'Expense Title Updated Successfully', '2017-06-11 03:47:35', '2017-06-11 03:47:35'),
(648, 1, 'Leave Type Updated Successfully', 'Leave Type Updated Successfully', '2017-06-11 03:47:35', '2017-06-11 03:47:35'),
(649, 1, 'Award Already Exist', 'Award Already Exist', '2017-06-11 03:47:35', '2017-06-11 03:47:35'),
(650, 1, 'Award Updated Successfully', 'Award Updated Successfully', '2017-06-11 03:47:35', '2017-06-11 03:47:35'),
(651, 1, 'Tax Rules Added Successfully', 'Tax Rules Added Successfully', '2017-06-11 03:47:35', '2017-06-11 03:47:35'),
(652, 1, 'Tax Rules Already Exist', 'Tax Rules Already Exist', '2017-06-11 03:47:35', '2017-06-11 03:47:35'),
(653, 1, 'Tax Rules Updated Successfully', 'Tax Rules Updated Successfully', '2017-06-11 03:47:35', '2017-06-11 03:47:35'),
(654, 1, 'Tax Rule deleted successfully', 'Tax Rule deleted successfully', '2017-06-11 03:47:36', '2017-06-11 03:47:36'),
(655, 1, 'Tax Rule not found', 'Tax Rule not found', '2017-06-11 03:47:36', '2017-06-11 03:47:36'),
(656, 1, 'Another Gateway already active', 'Another Gateway already active', '2017-06-11 03:47:36', '2017-06-11 03:47:36'),
(657, 1, 'Gateway updated successfully', 'Gateway updated successfully', '2017-06-11 03:47:36', '2017-06-11 03:47:36'),
(658, 1, 'Menu not found', 'Menu not found', '2017-06-11 03:47:36', '2017-06-11 03:47:36'),
(659, 1, 'Information updated successfully', 'Information updated successfully', '2017-06-11 03:47:36', '2017-06-11 03:47:36'),
(660, 1, 'Department Name Already exist, Please use different name', 'Department Name Already exist, Please use different name', '2017-06-11 03:47:36', '2017-06-11 03:47:36'),
(661, 1, 'Email Address Already exist, Please use different email address', 'Email Address Already exist, Please use different email address', '2017-06-11 03:47:36', '2017-06-11 03:47:36'),
(662, 1, 'Employee not assigned', 'Employee not assigned', '2017-06-11 03:47:36', '2017-06-11 03:47:36'),
(663, 1, 'Task Created Successfully', 'Task Created Successfully', '2017-06-11 03:47:36', '2017-06-11 03:47:36'),
(664, 1, 'Task not found', 'Task not found', '2017-06-11 03:47:37', '2017-06-11 03:47:37'),
(665, 1, 'Task Updated Successfully', 'Task Updated Successfully', '2017-06-11 03:47:37', '2017-06-11 03:47:37'),
(666, 1, 'Task File not found', 'Task File not found', '2017-06-11 03:47:37', '2017-06-11 03:47:37'),
(667, 1, 'Task Deleted Successfully', 'Task Deleted Successfully', '2017-06-11 03:47:37', '2017-06-11 03:47:37'),
(668, 1, 'Trainer added successfully', 'Trainer added successfully', '2017-06-11 03:47:37', '2017-06-11 03:47:37'),
(669, 1, 'Trainer deleted successfully', 'Trainer deleted successfully', '2017-06-11 03:47:37', '2017-06-11 03:47:37'),
(670, 1, 'Trainer info not found', 'Trainer info not found', '2017-06-11 03:47:37', '2017-06-11 03:47:37'),
(671, 1, 'Trainer updated successfully', 'Trainer updated successfully', '2017-06-11 03:47:37', '2017-06-11 03:47:37'),
(672, 1, 'Training added successfully', 'Training added successfully', '2017-06-11 03:47:37', '2017-06-11 03:47:37'),
(673, 1, 'Employee training deleted successfully', 'Employee training deleted successfully', '2017-06-11 03:47:37', '2017-06-11 03:47:37'),
(674, 1, 'Training info updated successfully', 'Training info updated successfully', '2017-06-11 03:47:37', '2017-06-11 03:47:37'),
(675, 1, 'Training needs assessment added successfully', 'Training needs assessment added successfully', '2017-06-11 03:47:37', '2017-06-11 03:47:37'),
(676, 1, 'Training needs assessment deleted successfully', 'Training needs assessment deleted successfully', '2017-06-11 03:47:37', '2017-06-11 03:47:37'),
(677, 1, 'Training needs assessment info not found', 'Training needs assessment info not found', '2017-06-11 03:47:37', '2017-06-11 03:47:37'),
(678, 1, 'Training needs assessment updated successfully', 'Training needs assessment updated successfully', '2017-06-11 03:47:37', '2017-06-11 03:47:37'),
(679, 1, 'Trainer not assigned', 'Trainer not assigned', '2017-06-11 03:47:37', '2017-06-11 03:47:37'),
(680, 1, 'Training event added successfully', 'Training event added successfully', '2017-06-11 03:47:37', '2017-06-11 03:47:37'),
(681, 1, 'Training event deleted successfully', 'Training event deleted successfully', '2017-06-11 03:47:37', '2017-06-11 03:47:37'),
(682, 1, 'Training event info not found', 'Training event info not found', '2017-06-11 03:47:37', '2017-06-11 03:47:37'),
(683, 1, 'Training event updated successfully', 'Training event updated successfully', '2017-06-11 03:47:37', '2017-06-11 03:47:37'),
(684, 1, 'Training evaluation completed', 'Training evaluation completed', '2017-06-11 03:47:38', '2017-06-11 03:47:38'),
(685, 1, 'Training evaluation updated', 'Training evaluation updated', '2017-06-11 03:47:38', '2017-06-11 03:47:38'),
(686, 1, 'Training evaluation info not found', 'Training evaluation info not found', '2017-06-11 03:47:38', '2017-06-11 03:47:38'),
(687, 1, 'Training evaluation deleted successfully', 'Training evaluation deleted successfully', '2017-06-11 03:47:38', '2017-06-11 03:47:38'),
(688, 1, 'Invalid User Name or Password', 'Invalid User Name or Password', '2017-06-11 03:47:38', '2017-06-11 03:47:38'),
(689, 1, 'Invalid Access', 'Invalid Access', '2017-06-11 03:47:38', '2017-06-11 03:47:38'),
(690, 1, 'Logout Successfully', 'Logout Successfully', '2017-06-11 03:47:38', '2017-06-11 03:47:38'),
(691, 1, 'Profile Updated Successfully', 'Profile Updated Successfully', '2017-06-11 03:47:38', '2017-06-11 03:47:38'),
(692, 1, 'Password Change Successfully', 'Password Change Successfully', '2017-06-11 03:47:38', '2017-06-11 03:47:38'),
(693, 1, 'Both New Password Does Not Match', 'Both New Password Does Not Match', '2017-06-11 03:47:38', '2017-06-11 03:47:38'),
(694, 1, 'Current Password Does Not Match', 'Current Password Does Not Match', '2017-06-11 03:47:38', '2017-06-11 03:47:38'),
(695, 1, 'Password Reset Successfully. Please check your email', 'Password Reset Successfully. Please check your email', '2017-06-11 03:47:38', '2017-06-11 03:47:38'),
(696, 1, 'Your Password Already Reset. Please Check your email', 'Your Password Already Reset. Please Check your email', '2017-06-11 03:47:38', '2017-06-11 03:47:38'),
(697, 1, 'Sorry There is no registered user with this email address', 'Sorry There is no registered user with this email address', '2017-06-11 03:47:38', '2017-06-11 03:47:38'),
(698, 1, 'A New Password Generated. Please Check your email.', 'A New Password Generated. Please Check your email.', '2017-06-11 03:47:38', '2017-06-11 03:47:38'),
(699, 1, 'Sorry Password reset Token expired or not exist, Please try again.', 'Sorry Password reset Token expired or not exist, Please try again.', '2017-06-11 03:47:38', '2017-06-11 03:47:38'),
(700, 1, 'Job Details Not found', 'Job Details Not found', '2017-06-11 03:47:38', '2017-06-11 03:47:38'),
(701, 1, 'Please upload your resume', 'Please upload your resume', '2017-06-11 03:47:38', '2017-06-11 03:47:38'),
(702, 1, 'Resume Submitted Successfully', 'Resume Submitted Successfully', '2017-06-11 03:47:38', '2017-06-11 03:47:38');




UPDATE `sys_appconfig` SET `value` = '1.6.0' WHERE `sys_appconfig`.`id` = 4;

EOF;

            $msg .= 'Importing Version 1.6.0 SQL Data....... <br>';

            // Execute SQL QUERY
            \DB::connection()->getPdo()->exec($sql);

            $msg .= 'Data import Completed....... <br>';
            $msg .= '=====Version 1.6.0 Update Complete ======" <br>';
            $msg .= 'If you refresh this page now, you should see this message- "Your Version is Up to Date!" <br>';

        }

        if ($v == $latest){
            echo 'Your Version is Up to Date!';
        }

        else{

            echo $msg;
        }


    }


}
