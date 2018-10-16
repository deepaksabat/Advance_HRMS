<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Classes\permission;
use App\Department;
use App\Designation;
use App\EmailTemplate;
use App\Employee;
use App\EmployeeBankAccount;
use App\EmployeeFiles;
use App\EmployeeRoles;
use App\EmployeeRolesPermission;
use App\Http\Requests;
use App\TaxRules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
date_default_timezone_set(app_config('Timezone'));
class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    /* allEmployees  Function Start Here */
    public function allEmployees()
    {
        $self='employees';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $check_status=Employee::where('status','active')->where('user_name','!=','admin')->get();
        if ($check_status){
            foreach ($check_status as $cs){
                $leave_date=$cs->dol;
                if ($leave_date){
                    if (strtotime($leave_date) < strtotime('now')){
                        $cs->status='inactive';
                        $cs->save();
                    }
                }

            }
        }

        $employees = Employee::where('user_name', '!=', 'admin')->get();
        return view('admin.employees', compact('employees'));
    }

    /* addEmployee  Function Start Here */
    public function addEmployee()
    {

        $self='add-employee';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $department=Department::all();
        $tax=TaxRules::where('status','active')->get();
        $role=EmployeeRoles::where('status','Active')->get();
        return view('admin.add-employee', compact('department','tax','role'));
    }

    /* addEmployeePost  Function Start Here */
    public function addEmployeePost(Request $request)
    {

        $self='add-employee';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $v = \Validator::make($request->all(), [
            'fname' => 'required', 'employee_code' => 'required', 'username' => 'required', 'email' => 'required', 'password' => 'required', 'rpassword' => 'required', 'department' => 'required','designation' => 'required', 'gender' => 'required', 'tax' => 'required', 'role' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('employees/add')->withErrors($v->errors());
        }

        $employee_code = Input::get('employee_code');
        if ($employee_code != '') {
            $exist = Employee::where('employee_code', '=', $employee_code)->first();
            if ($exist) {
                return redirect('employees/add')->with([
                    'message' => language_data('Employee Code Already Exist'),
                    'message_important' => true
                ]);
            }
        }

        $username = Input::get('username');
        if ($username != '') {
            $exist = Employee::where('user_name', '=', $username)->first();
            if ($exist) {
                return redirect('employees/add')->with([
                    'message' => language_data('Username Already Exist'),
                    'message_important' => true
                ]);
            }
        }
        $email = Input::get('email');
        if ($email != '') {
            $exist = Employee::where('email', '=', $email)->first();
            if ($exist) {
                return redirect('employees/add')->with([
                    'message' => language_data('Email Already Exist'),
                    'message_important' => true
                ]);
            }
        }

        $passowrd = Input::get('password');
        $rpassowrd = Input::get('rpassword');

        if ($passowrd != '') {
            if ($passowrd != $rpassowrd) {
                return redirect('employees/add')->with([
                    'message' => language_data('Both Password Does not Match'),
                    'message_important' => true
                ]);
            }
        }

        $employee = new Employee();
        $employee->fname = $request->fname;
        $employee->lname = $request->lname;
        $employee->employee_code = $employee_code;
        $employee->user_name = $username;
        $employee->email = $email;
        $employee->password = bcrypt($passowrd);
        $employee->designation = $request->designation;
        $employee->department = $request->department;
        $employee->role_id = $request->role;
        $employee->tax_id = $request->tax;
        $employee->gender = $request->gender;
        $employee->save();


        /*For Email Confirmation*/

        $conf = EmailTemplate::where('tplname', '=', 'Employee SignUp')->first();

        $estatus = $conf->status;

        if ($estatus == '1') {

            $sysEmail = app_config('Email');
            $sysCompany = app_config('AppName');
            $sysUrl = url('/');

            $template = $conf->message;
            $subject = $conf->subject;
            $employee_name=$request->fname . $request->lname;
            $data = array(
                'name' => $employee_name,
                'business_name' => $sysCompany,
                'from' => $sysEmail,
                'username' => $username,
                'email' => $email,
                'password' => $passowrd,
                'sys_url' => $sysUrl,
                'template' => $template
            );

            $message = _render($template, $data);
            $mail_subject = _render($subject, $data);
            $body = $message;

            /*Set Authentication*/

            $default_gt = app_config('Gateway');

            if ($default_gt == 'default') {

                $mail=new \PHPMailer();

                $mail->setFrom($sysEmail, $sysCompany);
                $mail->addAddress($email, $employee_name);     // Add a recipient
                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = $mail_subject;
                $mail->Body    = $body;

                if(!$mail->send()) {
                    return redirect('employees/all')->with([
                        'message' => language_data('Employee Added Successfully But Email Not Send')
                    ]);
                } else {
                    return redirect('employees/all')->with([
                        'message' => language_data('Employee Added Successfully')
                    ]);
                }

            }
            else {
                $host = app_config('SMTPHostName');
                $smtp_username = app_config('SMTPUserName');
                $stmp_password = app_config('SMTPPassword');
                $port = app_config('SMTPPort');
                $secure = app_config('SMTPSecure');


                $mail=new \PHPMailer();

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = $host;  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = $smtp_username;                 // SMTP username
                $mail->Password = $stmp_password;                           // SMTP password
                $mail->SMTPSecure = $secure;                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = $port;

                $mail->setFrom($sysEmail, $sysCompany);
                $mail->addAddress($email, $employee_name);     // Add a recipient
                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = $mail_subject;
                $mail->Body    = $body;

                if(!$mail->send()) {
                    return redirect('employees/all')->with([
                        'message' => language_data('Employee Added Successfully But Email Not Send')
                    ]);
                } else {
                    return redirect('employees/all')->with([
                        'message' => language_data('Employee Added Successfully')
                    ]);
                }

            }
        }

        return redirect('employees/all')->with([
            'message' => language_data('Employee Added Successfully')
        ]);
    }


    /* viewEmployee  Function Start Here */
    public function viewEmployee($id)
    {

        $self='update-employee';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $employee = Employee::find($id);

        if ($employee) {
            $designation = Designation::all();
            $department=Department::all();
            $tax=TaxRules::where('status','active')->get();
            $role=EmployeeRoles::where('status','Active')->get();

            $bank_accounts=EmployeeBankAccount::where('emp_id',$id)->get();
            $employee_doc=EmployeeFiles::where('emp_id',$id)->get();

            return view('admin.view-employee', compact('employee', 'designation','department','bank_accounts','employee_doc','tax','role'));
        } else {
            return redirect('employees/all')->with([
                'message' => language_data('Employee Not Found'),
                'message_important' => true
            ]);
        }
    }


    /* postEmployeePersonalInfo  Function Start Here */
    public function postEmployeePersonalInfo(Request $request)
    {
        $self='update-employee';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $cmd = Input::get('cmd');
        $appStage=app_config('AppStage');
        if($appStage=='Demo'){
            return redirect('employees/view/'.$cmd)->with([
                'message' => language_data('You do not have permission to view this page'),
                'message_important'=>true
            ]);
        }

        $v = \Validator::make($request->all(), [
            'fname' => 'required', 'employee_code' => 'required', 'username' => 'required', 'email' => 'required', 'designation' => 'required', 'tax' => 'required', 'role' => 'required', 'gender' => 'required', 'doj' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('employees/view/' . $cmd)->withErrors($v->errors());
        }

        $employee = Employee::find($cmd);

        $employee_code = Input::get('employee_code');
        $exist_emp_code = $employee->employee_code;
        if ($employee_code != '' AND $employee_code != $exist_emp_code) {
            $exist = Employee::where('employee_code', '=', $employee_code)->first();
            if ($exist) {
                return redirect('employees/view/' . $cmd)->with([
                    'message' => language_data('Employee Code Already Exist'),
                    'message_important' => true
                ]);
            }
        }

        $username = Input::get('username');
        $exist_user_name = $employee->user_name;
        if ($username != '' AND $username != $exist_user_name) {
            $exist = Employee::where('user_name', '=', $username)->first();
            if ($exist) {
                return redirect('employees/view/' . $cmd)->with([
                    'message' => language_data('Username Already Exist'),
                    'message_important' => true
                ]);
            }
        }
        $email = Input::get('email');
        $exist_email = $employee->email;
        if ($email != '' AND $email != $exist_email) {
            $exist = Employee::where('email', '=', $email)->first();
            if ($exist) {
                return redirect('employees/view/' . $cmd)->with([
                    'message' => language_data('Email Already Exist'),
                    'message_important' => true
                ]);
            }
        }

        $passowrd = Input::get('password');
        $rpassowrd = Input::get('rpassword');

        if ($passowrd != '') {
            if ($passowrd != $rpassowrd) {
                return redirect('employees/view/' . $cmd)->with([
                    'message' => language_data('Both Password Does not Match'),
                    'message_important' => true
                ]);
            } else {
                $passowrd = bcrypt($passowrd);
            }
        } else {
            $passowrd = $employee->password;
        }


        if ($request->dol==''){
            $status=$employee->status;
            $date_leave=$employee->dol;
        }else{
            $date_leave=date('Y-m-d',strtotime($request->dol));
        }

        $date_join=date('Y-m-d',strtotime($request->doj));
        $dob=date('Y-m-d',strtotime($request->dob));



        $employee->fname = $request->fname;
        $employee->lname = $request->lname;
        $employee->employee_code = $employee_code;
        $employee->user_name = $username;
        $employee->email = $email;
        $employee->password = $passowrd;
        $employee->designation = $request->designation;
        $employee->role_id = $request->role;
        $employee->doj = $date_join;
        $employee->dol = $date_leave;
        $employee->phone = $request->phone;
        $employee->phone2 = $request->phone2;
        $employee->status = $status;
        $employee->father_name = $request->father_name;
        $employee->mother_name = $request->mother_name;
        $employee->dob = $dob;
        $employee->tax_id = $request->tax;
        $employee->gender = $request->gender;
        $employee->pre_address = $request->pre_address;
        $employee->per_address = $request->per_address;

        $employee->save();

        return redirect('employees/all')->with([
            'message' => language_data('Employee Updated Successfully')
        ]);


    }

    /* updateEmployeeAvatar  Function Start Here */
    public function updateEmployeeAvatar(Request $request)
    {
        $cmd = Input::get('cmd');
        $appStage=app_config('AppStage');
        if($appStage=='Demo'){
            return redirect('employees/view/'.$cmd)->with([
                'message' => language_data('You do not have permission to view this page'),
                'message_important'=>true
            ]);
        }

        $self='update-employee';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $v = \Validator::make($request->all(), [
            'image' => 'required', 'cmd' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('employees/view/' . $cmd)->withErrors($v->errors());
        }

        $image = Input::file('image');

        $employee = Employee::find($cmd);

        if ($employee) {
            if ($image != '') {
                $destinationPath = public_path() . '/assets/employee_pic/';
                $image_name = $image->getClientOriginalName();
                Input::file('image')->move($destinationPath, $image_name);

                $employee->avatar = $image_name;
                $employee->save();

                return redirect('employees/view/' . $cmd)->with([
                    'message' => language_data('Avatar Changed Successfully')
                ]);

            } else {
                return redirect('employees/view/' . $cmd)->with([
                    'message' => language_data('Upload an Image'),
                    'message_important' => true
                ]);
            }
        } else {
            return redirect('employees/all')->with([
                'message' => language_data('Employee Not Found'),
                'message_important' => true
            ]);
        }
    }


    /* getDesignation  Function Start Here */
    public function getDesignation(Request $request)
    {
        $dep_id = $request->dep_id;
        if ($dep_id) {
            $designation = Designation::where('did', $dep_id)->get();
            foreach ($designation as $d) {
                echo '<option value="' . $d->id . '">' . $d->designation . '</option>';
            }
        }
    }

    /* addBankInfo  Function Start Here */
    public function addBankInfo(Request $request)
    {

        $self='update-employee';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $cmd=Input::get('cmd');
        $v=\Validator::make($request->all(),[
            'bank_name'=>'required','branch_name'=>'required','account_name'=>'required','account_number'=>'required'
        ]);

        if($v->fails()){
            return redirect('employees/view/'.$cmd)->withErrors($v->errors());
        }


        $employee_bank=EmployeeBankAccount::firstOrCreate(['emp_id'=>$cmd,'bank_name'=>$request->bank_name,'branch_name'=>$request->branch_name,'account_name'=>$request->account_name,'account_number'=>$request->account_number,'ifsc_code'=>$request->ifsc_code,'pan_no'=>$request->pan_number]);

        if($employee_bank->wasRecentlyCreated){
            return redirect('employees/view/'.$cmd)->with([
                'message'=>language_data('Bank Account Added Successfully')
            ]);

        }else{
            return redirect('employees/view/'.$cmd)->with([
                'message'=>language_data('Bank Account Already Exist'),
                'message_important'=>true
            ]);
        }
    }

    /* deleteBankAccount  Function Start Here */
    public function deleteBankAccount($id)
    {

        $self='update-employee';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $emp_bank=EmployeeBankAccount::find($id);
        $cmd=$emp_bank->emp_id;
        if($emp_bank){
            $emp_bank->delete();

            return redirect('employees/view/'.$cmd)->with([
                'message'=>language_data('Bank Account Deleted Successfully')
            ]);

        }else{
            return redirect('employees/view/'.$cmd)->with([
                'message'=>language_data('Bank Account Not Found'),
                'message_important'=>true
            ]);
        }
    }

    /* addDocument  Function Start Here */
    public function addDocument(Request $request)
    {

        $self='update-employee';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $cmd = Input::get('cmd');

        $v = \Validator::make($request->all(), [
            'document_name' => 'required','file' => 'required', 'cmd' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('employees/view/' . $cmd)->withErrors($v->errors());
        }

        $document_name=Input::get('document_name');
        $file = Input::file('file');

        $exist=EmployeeFiles::where('file_title',$document_name)->where('emp_id',$cmd)->first();

        if($exist){
            return redirect('employees/view/' . $cmd)->with([
                'message' => language_data('This Document Already Exist'),
                'message_important' => true
            ]);
        }

        $employee = Employee::find($cmd);

        if ($employee) {
            if ($file != '') {
                $destinationPath = public_path() . '/assets/employee_doc/';
                $file_name = $file->getClientOriginalName();
                Input::file('file')->move($destinationPath, $file_name);

                $employee_doc=new EmployeeFiles();
                $employee_doc->emp_id=$cmd;
                $employee_doc->file_title=$document_name;
                $employee_doc->file=$file_name;
                $employee_doc->save();

                return redirect('employees/view/' . $cmd)->with([
                    'message' => language_data('Document Uploaded Successfully')
                ]);

            } else {
                return redirect('employees/view/' . $cmd)->with([
                    'message' => language_data('Upload an Image'),
                    'message_important' => true
                ]);
            }
        } else {
            return redirect('employees/all')->with([
                'message' => language_data('Employee Not Found'),
                'message_important' => true
            ]);
        }
    }

    /* downloadEmployeeDocument  Function Start Here */
    public function downloadEmployeeDocument($id)
    {

        $self='update-employee';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }



        $file = EmployeeFiles::find($id)->file;
        return response()->download(public_path('assets/employee_doc/' . $file));
    }


    /* deleteEmployeeDoc  Function Start Here */
    public function deleteEmployeeDoc($id)
    {
        $self='update-employee';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $emp_doc=EmployeeFiles::find($id);
        $file=$emp_doc->file;
        $cmd=$emp_doc->emp_id;
        if($emp_doc){
            \File::delete(public_path('assets/employee_doc/' . $file));
            $emp_doc->delete();

            return redirect('employees/view/'.$cmd)->with([
                'message'=>language_data('Document Deleted Successfully')
            ]);

        }else{
            return redirect('employees/view/'.$cmd)->with([
                'message'=>language_data('Document Not Found'),
                'message_important'=>true
            ]);
        }
    }

    /* deleteEmployee  Function Start Here */
    public function deleteEmployee($id)
    {

        $appStage=app_config('AppStage');
        if($appStage=='Demo'){
            return redirect('employees/all')->with([
                'message' => language_data('You do not have permission to view this page'),
                'message_important'=>true
            ]);
        }

        $self='delete-employee';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $employee=Employee::find($id);
        if ($employee) {
            EmployeeBankAccount::where('emp_id',$id)->delete();
            $employee_doc=EmployeeFiles::where('emp_id',$id)->get();

            foreach($employee_doc as $ed){
                \File::delete(public_path('assets/employee_doc/' . $ed->file));
                $ed->delete();
            }
            \File::delete(public_path('assets/employee_pic/' . $employee->avatar));

            $employee->delete();

            return redirect('employees/all')->with([
                'message' => language_data('Employee Deleted Successfully')
            ]);

        } else {
            return redirect('employees/all')->with([
                'message' => language_data('Employee Not Found'),
                'message_important' => true
            ]);
        }
    }


    /*Version 1.5*/

    /* employeeRoles  Function Start Here */
    public function employeeRoles()
    {
        $self='employee-roles';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $emp_roles=EmployeeRoles::all();
        return view('admin.employee-roles',compact('emp_roles'));
    }

    /* addEmployeeRoles  Function Start Here */
    public function addEmployeeRoles(Request $request){

        $self='add-employee-role';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $v=\Validator::make($request->all(),[
            'role_name'=>'required','status'=>'required'
        ]);

        if ($v->fails()){
            return redirect('employees/roles')->withErrors($v->errors());
        }

        $emp_roles=new EmployeeRoles();
        $emp_roles->role_name=$request->role_name;
        $emp_roles->status=$request->status;
        $emp_roles->save();

        return redirect('employees/roles')->with([
            'message'=> language_data('Employee Role added successfully')
        ]);

    }

    /* updateEmployeeRoles  Function Start Here */
    public function updateEmployeeRoles(Request $request){

        $self='employee-roles';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $cmd=Input::get('cmd');

        $v=\Validator::make($request->all(),[
            'role_name'=>'required','status'=>'required'
        ]);

        if ($v->fails()){
            return redirect('employees/roles')->withErrors($v->errors());
        }

        $emp_roles=EmployeeRoles::find($cmd);

        if ($emp_roles){
            $emp_roles->role_name=$request->role_name;
            $emp_roles->status=$request->status;
            $emp_roles->save();

            return redirect('employees/roles')->with([
                'message'=> language_data('Employee Role updated successfully')
            ]);
        }else{

            return redirect('employees/roles')->with([
                'message'=> language_data('Employee Role info not found'),
                'message_important'=>true
            ]);
        }

    }

    /* setEmployeeRoles  Function Start Here */
    public function setEmployeeRoles($id)
    {
        $self='employee-roles';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $emp_roles=EmployeeRoles::find($id);
        return view('admin.set-employee-roles',compact('emp_roles'));
    }

    /* updateEmployeeSetRoles  Function Start Here */
    public function updateEmployeeSetRoles(Request $request)
    {
        $self='employee-roles';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $role_id=Input::get('role_id');

        $v=\Validator::make($request->all(),[
            'perms'=>'required','role_id'=>'required'
        ]);

        if ($v->fails()){
            return redirect('employees/set-roles/'.$role_id)->withErrors($v->errors());
        }

        $perms = Input::get('perms');
        if (count($perms) == 0) {
            return redirect('employees/set-roles/'.$role_id)->with([
                'message' => language_data('Permission not assigned'),
                'message_important' => true
            ]);
        }

        EmployeeRolesPermission::where('role_id',$role_id)->delete();

        foreach($perms as $perm){
            $emp_r_perm=new EmployeeRolesPermission();

            $emp_r_perm->role_id=$role_id;
            $emp_r_perm->perm_id=$perm;
            $emp_r_perm->save();
        }

        return redirect('employees/set-roles/'.$role_id)->with([
            'message'=> language_data('Permission Updated')
        ]);


    }

    /* deleteEmployeeRoles  Function Start Here */
    public function deleteEmployeeRoles($id)
    {
        $appStage=app_config('AppStage');
        if($appStage=='Demo'){
            return redirect('employees/roles')->with([
                'message' => language_data('You do not have permission to view this page'),
                'message_important'=>true
            ]);
        }


        $self='delete-employee-role';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $emp_role=EmployeeRoles::find($id);

        if ($emp_role){

            $emp_check=Employee::where('role_id',$id)->where('user_name','!=','admin')->first();

            if ($emp_check){
                return redirect('employees/roles')->with([
                    'message'=> language_data('An Employee contain this role'),
                    'message_important'=>true
                ]);
            }


            EmployeeRolesPermission::where('role_id',$id)->delete();
            $emp_role->delete();

            return redirect('employees/roles')->with([
                'message'=> language_data('Employee role deleted successfully')
            ]);

        }else{
            return redirect('employees/roles')->with([
                'message'=> language_data('Employee Role info not found'),
                'message_important'=>true
            ]);
        }



    }


}
