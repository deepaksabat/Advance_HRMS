<?php

namespace App\Http\Controllers;

use App\Classes\permission;
use App\EmailTemplate;
use App\Employee;
use App\SupportDepartments;
use App\SupportTicketFiles;
use App\SupportTickets;
use App\SupportTicketsReplies;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
date_default_timezone_set(app_config('Timezone'));
class SupportTicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    /* all  Function Start Here */
    public function all()
    {
        $self='support-tickets';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $st = SupportTickets::all();
        return view('admin.support-tickets', compact('st'));
    }

    /* department  Function Start Here */
    public function department()
    {
        $self='support-department';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $sd = SupportDepartments::all();
        return view('admin.support-department', compact('sd'));
    }

    /* postDepartment  Function Start Here */
    public function postDepartment(Request $request)
    {
        $self='add-support-department';
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
            'dname' => 'required', 'email' => 'required', 'show' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('support-tickets/add-department')->withErrors($v->errors());
        }

        $dname = Input::get('dname');
        $demail = Input::get('email');
        $show = Input::get('show');

        if ($dname != '') {
            $d = SupportDepartments::where('name', '=', $dname)->first();
            if ($d) {
                return redirect('support-tickets/add-department')->with([
                    'message' => language_data('Department Name Already exist, Please use different name'),
                    'message_important' => true
                ]);
            }
        }

        if ($demail != '') {
            $d = SupportDepartments::where('email', '=', $demail)->first();
            if ($d) {
                return redirect('support-tickets/add-department')->with([
                    'message' => language_data('Email Address Already exist, Please use different email address'),
                    'message_important' => true
                ]);
            }
        }

        $ord = SupportDepartments::orderBy('id', 'desc')->first();
        if ($ord) {
            $order = $ord->order;
            $order++;
        } else {
            $order = '1';
        }

        $d = new SupportDepartments();
        $d->name = $dname;
        $d->email = $demail;
        $d->order = $order;
        $d->show = $show;
        $d->save();

        return redirect('support-tickets/department')->with([
            'message' => language_data('Department Added Successfully')
        ]);


    }

    /* viewDepartment  Function Start Here */
    public function viewDepartment($id)
    {
        $self='support-department';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $d = SupportDepartments::find($id);
        return view('admin.view-department', compact('d'));
    }

    /* updateDepartment  Function Start Here */
    public function updateDepartment(Request $request)
    {
        $self='support-department';
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
            'dname' => 'required', 'email' => 'required', 'show' => 'required'
        ]);

        $id = Input::get('cmd');

        $appStage = app_config('AppStage');
        if ($appStage == 'Demo') {
            return redirect('support-tickets/view-department/' . $id)->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important' => true
            ]);
        }


        if ($v->fails()) {
            return redirect('support-tickets/view-department/' . $id)->withErrors($v->errors());
        }

        $dname = Input::get('dname');
        $demail = Input::get('email');
        $show = Input::get('show');

        $findEmail = SupportDepartments::find($id);
        $exitEmail = $findEmail->email;

        if ($demail == $exitEmail) {
            $demail = $exitEmail;
        } else {
            $findEmail = SupportDepartments::where('email', '=', $demail)->count('id');
            if ($findEmail != '0') {
                return redirect('support-tickets/view-department/' . $id)->with([
                    'message' => language_data('Email Address Already exist, Please use different email address'),
                    'message_important' => true
                ]);
            }
        }


        $findName = SupportDepartments::find($id);
        $exitName = $findName->name;

        if ($dname == $exitName) {
            $dname = $exitName;
        } else {
            $findName = SupportDepartments::where('name', '=', $dname)->count('id');
            if ($findName != '0') {
                return redirect('support-tickets/view-department/' . $id)->with([
                    'message' => language_data('Department Name Already exist, Please use different name'),
                    'message_important' => true
                ]);
            }
        }

        $d = SupportDepartments::find($id);
        $d->name = $dname;
        $d->email = $demail;
        $d->show = $show;
        $d->save();

        return redirect('support-tickets/department')->with([
            'message' => language_data('Department Updated Successfully')
        ]);
    }


    /* createNew  Function Start Here */
    public function createNew()
    {
        $self='create-new-ticket';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $sd = SupportDepartments::all();
        $cl = Employee::where('status', 'active')->where('user_name','!=','admin')->get();
        return view('admin.create-new-ticket', compact('sd', 'cl'));
    }

    /* postTicket  Function Start Here */
    public function postTicket(Request $request)
    {
        $self='create-new-ticket';
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
            'cid' => 'required', 'subject' => 'required', 'message' => 'required', 'did' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('support-tickets/create-new')->withErrors($v->errors());
        }

        $cid = Input::get('cid');
        $subject = Input::get('subject');
        $st_message = Input::get('message');
        $did = Input::get('did');

        $cl = Employee::find($cid);
        $cl_name = $cl->fname . ' ' . $cl->lname;
        $cl_email = $cl->email;
        $admin = \Auth::user()->fname;

        $d = new SupportTickets();
        $d->did = $did;
        $d->emp_id = $cid;
        $d->name = $cl_name;
        $d->email = $cl_email;
        $d->date = date('Y-m-d');
        $d->subject = $subject;
        $d->message = $st_message;
        $d->status = 'Pending';
        $d->admin = $admin;
        $d->replyby = '';
        $d->closed_by = '';
        $d->save();
        $cmd = $d->id;


        /*For Email Confirmation*/

        $conf = EmailTemplate::where('tplname', '=', 'Ticket Reply')->first();

        $estatus = $conf->status;
        if ($estatus == '1') {

            $deprt = SupportDepartments::find($did);

            $sysEmail = $deprt->email;
            $sysCompany = $deprt->name;
            $sysUrl = url('/');

            $template = $conf->message;
            $subject = $conf->subject;

            $data = array('name' => $cl_name,
                'business_name' => $sysCompany,
                'ticket_id' => $cmd,
                'ticket_subject' => $subject,
                'message' => $st_message,
                'reply_by' => $admin,
                'template' => $template,
                'sys_url' => $sysUrl
            );


            $message = _render($template, $data);
            $mail_subject = _render($subject, $data);
            $body = $message;


            /*Set Authentication*/

            $default_gt = app_config('Gateway');

            if ($default_gt == 'default') {

                $mail = new \PHPMailer();

                $mail->setFrom($sysEmail, $sysCompany);
                $mail->addAddress($cl_email, $cl_name);     // Add a recipient
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $mail_subject;
                $mail->Body = $body;
                if (!$mail->send()) {

                    return redirect('support-tickets/view-ticket/' . $cmd)->with([
                        'message' => language_data('Support Ticket Created Successfully But Email Not Send')
                    ]);
                } else {

                    return redirect('support-tickets/view-ticket/' . $cmd)->with([
                        'message' => language_data('Support Ticket Created Successfully')
                    ]);
                }

            } else {
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
                $mail->addAddress($cl_email, $cl_name);     // Add a recipient
                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = $mail_subject;
                $mail->Body = $body;

                if (!$mail->send()) {

                    return redirect('support-tickets/view-ticket/' . $cmd)->with([
                        'message' => language_data('Support Ticket Created Successfully But Email Not Send')
                    ]);
                } else {

                    return redirect('support-tickets/view-ticket/' . $cmd)->with([
                        'message' => language_data('Support Ticket Created Successfully')
                    ]);
                }

            }
        }
        return redirect('support-tickets/view-ticket/' . $cmd)->with([
            'message' => language_data('Support Ticket Created Successfully')
        ]);
    }

    /* viewTicket  Function Start Here */
    public function viewTicket($id)
    {
        $self='manage-support-ticket';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $st = SupportTickets::find($id);
        $did = $st->did;
        $td = SupportDepartments::find($did);
        $trply = SupportTicketsReplies::where('tid', $id)->orderBy('date', 'desc')->get();
        $department = SupportDepartments::all();
        $ticket_file = SupportTicketFiles::where('ticket_id', $id)->get();

        return view('admin.view-support-ticket', compact('st', 'sd', 'td', 'trply', 'department', 'ticket_file'));
    }


    /* postBasicInfo  Function Start Here */
    public function postBasicInfo(Request $request)
    {

        $self='manage-support-ticket';
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
            'department' => 'required', 'status' => 'required'
        ]);

        $cmd = Input::get('cmd');
        $department = Input::get('department');
        $status = Input::get('status');
        if ($v->fails()) {
            return redirect('support-tickets/view-ticket/' . $cmd)->withErrors($v->errors());
        }

        $d = SupportTickets::find($cmd);
        $d->did = $department;
        $d->status = $status;
        if ($status == 'Closed') {
            $d->closed_by = \Auth::user()->fname;
        }
        $d->save();

        return redirect('support-tickets/view-ticket/' . $cmd)->with([
            'message' => language_data('Basic Info Update Successfully')
        ]);

    }


    /* replayTicket  Function Start Here */
    public function replayTicket(Request $request)
    {
        $self='manage-support-ticket';
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
            'message' => 'required'
        ]);

        $cmd = Input::get('cmd');

        if ($v->fails()) {
            return redirect('support-tickets/view-ticket/' . $cmd)->withErrors($v->errors());
        }

        $message = Input::get('message');

        $st = SupportTickets::find($cmd);
        $cid = $st->emp_id;
        $did = $st->did;

        $cl = Employee::find($cid);
        $cl_name = $cl->fname . ' ' . $cl->lname;
        $cl_email = $cl->email;

        $admin_name = \Auth::user()->fname;
        $image = \Auth::user()->avatar;

        SupportTicketsReplies::insert([
            'tid' => $cmd,
            'emp_id' => $cid,
            'name' => $cl_name,
            'date' => date('Y-m-d'),
            'message' => $message,
            'admin' => $admin_name,
            'image' => $image,
        ]);

        $st->replyby = $admin_name;
        $st->status = 'Answered';
        $st->save();

        /*For Email Confirmation*/

        $conf = EmailTemplate::where('tplname', '=', 'Ticket Reply')->first();
        $estatus = $conf->status;

        if ($estatus == '1') {
            $deprt = SupportDepartments::find($did);

            $sysEmail = $deprt->email;
            $sysDepartment = $deprt->name;
            $sysCompany = app_config('AppName');
            $sysUrl = url('/');

            $template = $conf->message;
            $subject = $conf->subject;

            $data = array('name' => $cl_name,
                'business_name' => $sysCompany,
                'ticket_id' => $cmd,
                'ticket_subject' => $subject,
                'message' => $message,
                'reply_by' => $admin_name,
                'template' => $template,
                'sys_url' => $sysUrl
            );

            $message = _render($template, $data);
            $mail_subject = _render($subject, $data);
            $body = $message;


            /*Set Authentication*/

            $default_gt = app_config('Gateway');

            if ($default_gt == 'default') {

                $mail = new \PHPMailer();

                $mail->setFrom($sysEmail, $sysDepartment);
                $mail->addAddress($cl_email, $cl_name);     // Add a recipient
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $mail_subject;
                $mail->Body = $body;
                if (!$mail->send()) {
                    return redirect('support-tickets/view-ticket/' . $cmd)->with([
                        'message' => language_data('Ticket Reply Successfully But Email Not Send')
                    ]);
                } else {
                    return redirect('support-tickets/view-ticket/' . $cmd)->with([
                        'message' => language_data('Ticket Reply Successfully')
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

                $mail->setFrom($sysEmail, $sysDepartment);
                $mail->addAddress($cl_email, $cl_name);     // Add a recipient
                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = $mail_subject;
                $mail->Body = $body;

                if (!$mail->send()) {
                    return redirect('support-tickets/view-ticket/' . $cmd)->with([
                        'message' => language_data('Ticket Reply Successfully But Email Not Send')
                    ]);
                } else {
                    return redirect('support-tickets/view-ticket/' . $cmd)->with([
                        'message' => language_data('Ticket Reply Successfully')
                    ]);
                }

            }
        }
        return redirect('support-tickets/view-ticket/' . $cmd)->with([
            'message' => language_data('Ticket Reply Successfully')
        ]);

    }


    /* postTicketFiles  Function Start Here */
    public function postTicketFiles(Request $request)
    {
        $self='manage-support-ticket';
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
            'file_title' => 'required', 'file' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('support-tickets/view-ticket/' . $cmd)->withErrors($v->errors());
        }

        $file_title = Input::get('file_title');
        $file = Input::file('file');

        if ($file != '') {
            $destinationPath = public_path() . '/assets/ticket_file/';
            $file_name = $file->getClientOriginalName();
            $file_size = $file->getSize();
            Input::file('file')->move($destinationPath, $file_name);

            $tf = new SupportTicketFiles();
            $tf->ticket_id = $cmd;
            $tf->emp_id = \Auth::user()->id;
            $tf->file_title = $file_title;
            $tf->file_size = $file_size;
            $tf->file = $file_name;
            $tf->save();

            return redirect('support-tickets/view-ticket/' . $cmd)->with([
                'message' => language_data('File Uploaded Successfully')
            ]);

        } else {
            return redirect('support-tickets/view-ticket/' . $cmd)->with([
                'message' => language_data('Please Upload a File'),
                'message_important' => true
            ]);
        }

    }


    /* downloadTicketFile  Function Start Here */
    public function downloadTicketFile($id)
    {
        $self='manage-support-ticket';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $ticket_file = SupportTicketFiles::find($id)->file;
        return response()->download(public_path('assets/ticket_file/' . $ticket_file));
    }

    /* deleteTicketFile  Function Start Here */
    public function deleteTicketFile($id)
    {
        $self='manage-support-ticket';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $ticket_file = SupportTicketFiles::find($id);

        if ($ticket_file) {
            $ticket_id = $ticket_file->ticket_id;
            $file = $ticket_file->file;
            \File::delete(public_path('assets/ticket_file/' . $file));
            $ticket_file->delete();

            return redirect('support-tickets/view-ticket/' . $ticket_id)->with([
                'message' => language_data('File Deleted Successfully')
            ]);
        } else {
            return redirect('support-tickets/all')->with([
                'message' => language_data('Ticket File not found'),
                'message_important' => true
            ]);
        }
    }


    /* deleteTicket  Function Start Here */
    public function deleteTicket($id)
    {
        $appStage = app_config('AppStage');
        if ($appStage == 'Demo') {
            return redirect('support-tickets/all')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important' => true
            ]);
        }

        $self='support-tickets';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $d = SupportTickets::find($id);
        if ($d) {
            SupportTicketsReplies::where('tid', '=', $id)->delete();
            $ticket = SupportTicketFiles::where('ticket_id', $id)->get();

            foreach ($ticket as $tf) {
                $file = $tf->file;
                \File::delete(public_path('assets/ticket_file/' . $file));
                $tf->delete();
            }

            $d->delete();

            return redirect('support-tickets/all')->with([
                'message' => language_data('Ticket Deleted Successfully')
            ]);
        } else {
            return redirect('support-tickets/all')->with([
                'message' => language_data('There Have no Ticket For Delete'),
                'message_important' => true
            ]);
        }

    }


    /* deleteDepartment  Function Start Here */
    public function deleteDepartment($id)
    {

        $appStage = app_config('AppStage');
        if ($appStage == 'Demo') {
            return redirect('support-tickets/department')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important' => true
            ]);
        }


        $self='support-department';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $d = SupportDepartments::find($id);

        if ($d) {
            $d->delete();
            return redirect('support-tickets/department')->with([
                'message' => language_data('Department Deleted Successfully')
            ]);
        } else {
            return redirect('support-tickets/all')->with([
                'message' => language_data('Department Not Found'),
                'message_important' => true
            ]);
        }

    }


}
