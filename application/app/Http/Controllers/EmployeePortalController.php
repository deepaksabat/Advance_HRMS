<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\AwardList;
use App\EmailTemplate;
use App\Employee;
use App\EmployeeTraining;
use App\Expense;
use App\Holiday;
use App\Leave;
use App\LeaveType;
use App\Loan;
use App\Notice;
use App\Payroll;
use App\SupportDepartments;
use App\SupportTicketFiles;
use App\SupportTickets;
use App\SupportTicketsReplies;
use App\Task;
use App\TaskComments;
use App\TaskEmployee;
use App\TaskFiles;
use App\Trainers;
use App\TrainingMembers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;

date_default_timezone_set(app_config('Timezone'));

class EmployeePortalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('employee');
    }

    /* holiday  Function Start Here */
    public function holiday()
    {
        return view('employee.holiday');
    }


    /* eventCalendar  Function Start Here */
    public function eventCalendar()
    {
        $fdate = Input::get('from');
        $fdate = $fdate / 1000;
        $fdate = date('Y-m-d', $fdate);
        $tdate = Input::get('to');
        $tdate = $tdate / 1000;
        $tdate = date('Y-m-d', $tdate);
        $out = array();

        //find current month
        $d = Holiday::all();
        foreach ($d as $xs) {
            $id = $xs->id;
            $date = $xs->holiday;
            $occasion = $xs->occasion;
            $occasion_name = language_data('Occasion Name') . ': ' . $occasion;

            $out[] = array(
                'id' => $id,
                'title' => $occasion_name,
                'class' => 'event-important',
                'start' => strtotime($date) . '000',
                'end' => strtotime($date) . '000'
            );
        }

        echo json_encode(array('success' => 1, 'result' => $out));
        exit;
    }


    /* award  Function Start Here */
    public function award()
    {
        $award = AwardList::where('emp_id', \Auth::user()->employee_code)->get();
        return view('employee.award', compact('award'));
    }

    /* leave  Function Start Here */
    public function leave()
    {
        $leave_type = LeaveType::all();
        $total_leave = LeaveType::sum('leave_quota');

        $leave = Leave::where('emp_id', \Auth::user()->id)->get();

//        $leave_count=array();
//
//        foreach($leave as $p){
//
//
//
//            if (count($leave_count) == '0') {
//                array_push($leave_count, array(
//                    'emp_id' => $p->emp_id,
//                ));
//
//            } else {
//
//                $last_index = count($leave_count) - 1;
//                $last_item = $leave_count[$last_index];
//
//                if ($p->employee_info->employee_code == $last_item['emp_code']) {
//
//                } else {
//
//                    array_push($leave_count, array(
//                        'emp_id' => $p->emp_id,
//
//                    ));
//
//                }
//
//            }
//        }

        return view('employee.leave', compact('leave', 'leave_type', 'total_leave'));
    }

    /* postNewLeave  Function Start Here */
    public function postNewLeave(Request $request)
    {
        $v = \Validator::make($request->all(), [
            'leave_type' => 'required', 'leave_from' => 'required', 'leave_to' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('employee/leave')->withErrors($v->errors());
        }

        $leave_from=date('Y-m-d',strtotime($request->leave_from));
        $leave_to=date('Y-m-d',strtotime($request->leave_to));


        $leave = new Leave();
        $leave->emp_id = \Auth::user()->id;
        $leave->leave_from = $leave_from;
        $leave->leave_to = $leave_to;
        $leave->ltype_id = $request->leave_type;
        $leave->applied_on = date('Y-m-d');
        $leave->leave_reason = $request->leave_reason;
        $leave->status = 'pending';
        $leave->save();

        return redirect('employee/leave')->with([
            'message' => language_data('Leave Request Send Successfully')
        ]);

    }

    /* noticeBoard  Function Start Here */
    public function noticeBoard()
    {
        $notice = Notice::where('status', 'Published')->get();
        return view('employee.notice-board', compact('notice'));

    }

    /* expense  Function Start Here */
    public function expense()
    {
        $expense = Expense::where('purchase_by', \Auth::user()->id)->get();
        return view('employee.expense', compact('expense'));

    }

    /* postExpense  Function Start Here */
    public function postExpense(Request $request)
    {

        $v = \Validator::make($request->all(), [
            'item_name' => 'required', 'purchase_from' => 'required', 'amount' => 'required', 'purchase_date' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('employee/expense')->withErrors($v->errors());
        }

        $item_name = Input::get('item_name');
        $purchase_from = Input::get('purchase_from');
        $emp_name = \Auth::user()->id;
        $purchase_date = Input::get('purchase_date');
        $purchase_date=date('Y-m-d',strtotime($purchase_date));
        $amount = Input::get('amount');
        $bill_copy = Input::file('bill_copy');

        if ($bill_copy != '') {
            $destinationPath = public_path() . '/assets/bill_copy/';
            $bill_copy_name = $bill_copy->getClientOriginalName();
            Input::file('bill_copy')->move($destinationPath, $bill_copy_name);
        } else {
            $bill_copy_name = '';
        }

        $expense = new Expense();
        $expense->item_name = $item_name;
        $expense->purchase_from = $purchase_from;
        $expense->purchase_date = $purchase_date;
        $expense->purchase_by = $emp_name;
        $expense->amount = $amount;
        $expense->status = 'Pending';
        $expense->bill_copy = $bill_copy_name;
        $expense->save();

        return redirect('employee/expense')->with([
            'message' => language_data('Expense Added Successfully')
        ]);

    }

    /* allSupportTickets  Function Start Here */
    public function allSupportTickets()
    {
        $st = SupportTickets::where('emp_id', \Auth::user()->id)->get();
        return view('employee.support-tickets', compact('st'));
    }

    /* createNewTicket  Function Start Here */
    public function createNewTicket()
    {
        $sd = SupportDepartments::where('show', 'Yes')->get();
        return view('employee.create-new-ticket', compact('sd'));
    }


    /* postTicket  Function Start Here */
    public function postTicket(Request $request)
    {
        $v = \Validator::make($request->all(), [
            'subject' => 'required', 'message' => 'required', 'did' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('employee/support-tickets/create-new')->withErrors($v->errors());
        }

        $subject = Input::get('subject');
        $st_message = Input::get('message');
        $did = Input::get('did');

        $cl = Employee::find(\Auth::user()->id);
        $cl_name = $cl->fname . ' ' . $cl->lname;
        $cl_email = $cl->email;

        $d = new SupportTickets();
        $d->did = $did;
        $d->emp_id = \Auth::user()->id;
        $d->name = $cl_name;
        $d->email = $cl_email;
        $d->date = date('Y-m-d');
        $d->subject = $subject;
        $d->message = $st_message;
        $d->status = 'Pending';
        $d->admin = '0';
        $d->replyby = '';
        $d->closed_by = '';
        $d->save();
        $cmd = $d->id;


        /*For Email Confirmation*/

        $conf = EmailTemplate::where('tplname', '=', 'Ticket For Admin')->first();

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

                    return redirect('employee/support-tickets/view-ticket/' . $cmd)->with([
                        'message' => language_data('Support Ticket Created Successfully But Email Not Send')
                    ]);
                } else {

                    return redirect('employee/support-tickets/view-ticket/' . $cmd)->with([
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

                    return redirect('employee/support-tickets/view-ticket/' . $cmd)->with([
                        'message' => language_data('Support Ticket Created Successfully But Email Not Send')
                    ]);
                } else {

                    return redirect('employee/support-tickets/view-ticket/' . $cmd)->with([
                        'message' => language_data('Support Ticket Created Successfully')
                    ]);
                }

            }
        }
        return redirect('employee/support-tickets/view-ticket/' . $cmd)->with([
            'message' => language_data('Support Ticket Created Successfully')
        ]);
    }


    /* viewTicket  Function Start Here */
    public function viewTicket($id)
    {
        $st = SupportTickets::find($id);
        $did = $st->did;
        $td = SupportDepartments::find($did);
        $trply = SupportTicketsReplies::where('tid', $id)->orderBy('date', 'desc')->get();
        $department = SupportDepartments::all();
        $ticket_file = SupportTicketFiles::where('ticket_id', $id)->get();

        return view('employee.view-support-ticket', compact('st', 'sd', 'td', 'trply', 'department', 'ticket_file'));
    }

    /* replayTicket  Function Start Here */
    public function replayTicket(Request $request)
    {
        $v = \Validator::make($request->all(), [
            'message' => 'required'
        ]);

        $cmd = Input::get('cmd');

        if ($v->fails()) {
            return redirect('employee/support-tickets/view-ticket/' . $cmd)->withErrors($v->errors());
        }

        $message = Input::get('message');

        $st = SupportTickets::find($cmd);
        $cid = $st->emp_id;
        $did = $st->did;

        $cl = Employee::find($cid);
        $cl_name = $cl->fname . ' ' . $cl->lname;
        $cl_email = $cl->email;

        $employee_name = \Auth::user()->fname;
        $image = \Auth::user()->avatar;

        SupportTicketsReplies::insert([
            'tid' => $cmd,
            'emp_id' => $cid,
            'name' => $cl_name,
            'date' => date('Y-m-d'),
            'message' => $message,
            'admin' => 'employee',
            'image' => $image,
        ]);

        $st->replyby = $employee_name;
        $st->status = 'Customer Reply';
        $st->save();

        /*For Email Confirmation*/

        $conf = EmailTemplate::where('tplname', '=', 'Employee Ticket Reply')->first();
        $estatus = $conf->status;

        if ($estatus == '1') {
            $deprt = SupportDepartments::find($did);

            $sysEmail = $deprt->email;
            $sysDepartment = $deprt->name;
            $sysCompany = app_config('AppName');
            $sysUrl = url('/');

            $template = $conf->message;
            $subject = $conf->subject;

            $data = array('name' => $sysDepartment,
                'business_name' => $sysCompany,
                'ticket_id' => $cmd,
                'ticket_subject' => $subject,
                'message' => $message,
                'reply_by' => $employee_name,
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

                $mail->setFrom($cl_email, $cl_name);
                $mail->addAddress($sysEmail, $sysDepartment);     // Add a recipient
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $mail_subject;
                $mail->Body = $body;
                if (!$mail->send()) {
                    return redirect('employee/support-tickets/view-ticket/' . $cmd)->with([
                        'message' => language_data('Ticket Reply Successfully But Email Not Send')
                    ]);
                } else {
                    return redirect('employee/support-tickets/view-ticket/' . $cmd)->with([
                        'message' => language_data('Ticket Reply Successfully')
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

                $mail->addAddress($sysEmail, $sysCompany);
                $mail->setFrom($cl_email, $cl_name);     // Add a recipient
                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = $mail_subject;
                $mail->Body = $body;

                if (!$mail->send()) {
                    return redirect('employee/support-tickets/view-ticket/' . $cmd)->with([
                        'message' => language_data('Ticket Reply Successfully But Email Not Send')
                    ]);
                } else {
                    return redirect('employee/support-tickets/view-ticket/' . $cmd)->with([
                        'message' => language_data('Ticket Reply Successfully')
                    ]);
                }

            }
        }
        return redirect('employee/support-tickets/view-ticket/' . $cmd)->with([
            'message' => language_data('Ticket Reply Successfully')
        ]);

    }


    /* postTicketFiles  Function Start Here */
    public function postTicketFiles(Request $request)
    {
        $cmd = Input::get('cmd');
        $v = \Validator::make($request->all(), [
            'file_title' => 'required', 'file' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('employee/support-tickets/view-ticket/' . $cmd)->withErrors($v->errors());
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

            return redirect('employee/support-tickets/view-ticket/' . $cmd)->with([
                'message' => language_data('File Uploaded Successfully')
            ]);

        } else {
            return redirect('employee/support-tickets/view-ticket/' . $cmd)->with([
                'message' => language_data('Please Upload a File'),
                'message_important' => true
            ]);
        }

    }

    /* downloadTicketFile  Function Start Here */
    public function downloadTicketFile($id)
    {
        $ticket_file = SupportTicketFiles::find($id)->file;
        return response()->download(public_path('assets/ticket_file/' . $ticket_file));
    }

    /* payroll  Function Start Here */
    public function paySlip()
    {
        $payslip = Payroll::where('emp_id', \Auth::user()->id)->get();
        return view('employee.payslip', compact('payslip'));
    }

    /* viewPaySlip  Function Start Here */
    public function viewPaySlip($id)
    {
        $payslip = Payroll::find($id);

        if ($payslip) {
            return view('employee.view-payslip', compact('payslip'));
        } else {
            return redirect('employee/payslip')->with([
                'message' => language_data('Payment Details Not found'),
                'message_important' => true
            ]);
        }

    }

    /* printPaySlip  Function Start Here */
    public function printPaySlip($id)
    {
        $payslip = Payroll::find($id);

        if ($payslip) {
            return view('employee.print-payslip', compact('payslip'));
        } else {
            return redirect('employee/payslip')->with([
                'message' => language_data('Payment Details Not found'),
                'message_important' => true
            ]);
        }

    }


    /* task  Function Start Here */
    public function task()
    {
        $task_employee = TaskEmployee::where('emp_id', \Auth::user()->id)->select('task_id')->get();
        $task_ids = array();
        foreach ($task_employee as $te) {
            array_push($task_ids, $te->task_id);
        }

        $task = Task::whereIn('id', $task_ids)->get();
        return view('employee.tasks', compact('task'));

    }

    /* viewTask  Function Start Here */
    public function viewTask($id)
    {
        $task = Task::find($id);
        $task_employee = TaskEmployee::where('task_id', $id)->get();
        $task_comment = TaskComments::where('task_id', $id)->get();
        $task_files = TaskFiles::where('task_id', $id)->get();
        return view('employee.view-task', compact('task', 'task_employee', 'task_comment', 'task_files'));
    }


    /* postTaskComments  Function Start Here */
    public function postTaskComments(Request $request)
    {
        $cmd = Input::get('cmd');
        $v = \Validator::make($request->all(), [
            'comment' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('employee/task/view/' . $cmd)->withErrors($v->errors());
        }

        $tc = new TaskComments();
        $tc->task_id = $cmd;
        $tc->emp_id = \Auth::user()->id;
        $tc->comment = $request->comment;
        $tc->save();

        return redirect('employee/task/view/' . $cmd)->with([
            'message' => language_data('Comment Posted Successfully')
        ]);
    }

    /* postTaskFiles  Function Start Here */
    public function postTaskFiles(Request $request)
    {
        $cmd = Input::get('cmd');
        $v = \Validator::make($request->all(), [
            'file_title' => 'required', 'file' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('employee/task/view/' . $cmd)->withErrors($v->errors());
        }

        $file_title = Input::get('file_title');
        $file = Input::file('file');

        if ($file != '') {
            $destinationPath = public_path() . '/assets/task_file/';
            $file_name = $file->getClientOriginalName();
            $file_size = $file->getSize();
            Input::file('file')->move($destinationPath, $file_name);

            $tf = new TaskFiles();
            $tf->task_id = $cmd;
            $tf->emp_id = \Auth::user()->id;
            $tf->file_title = $file_title;
            $tf->file_size = $file_size;
            $tf->file = $file_name;
            $tf->save();

            return redirect('employee/task/view/' . $cmd)->with([
                'message' => language_data('File Uploaded Successfully')
            ]);

        } else {
            return redirect('employee/task/view/' . $cmd)->with([
                'message' => language_data('Please Upload a File'),
                'message_important' => true
            ]);
        }

    }

    /* downloadTaskFIle  Function Start Here */
    public function downloadTaskFIle($id)
    {
        $task_file = TaskFiles::find($id)->file;
        return response()->download(public_path('assets/task_file/' . $task_file));
    }


    /* setClocking  Function Start Here */
    public function setClocking(Request $request)
    {

        $clock_state = Input::get('clock_state');

        if ($clock_state == '') {
            return redirect('employee/dashboard')->with([
                'message' => language_data('Please try again'),
                'message_important' => true
            ]);
        }


        $attendance = Attendance::where('date', date('Y-m-d'))->where('emp_id', \Auth::user()->id)->first();


        if ($attendance) {

            if ($clock_state == 'Clock In') {
                $attendance->clock_status='Clock In';
                $attendance->clock_in_optional=date('g:i A');
                $attendance->save();

                return redirect('employee/dashboard')->with([
                    'message' => language_data('Clock In Successfully')
                ]);

            } else {
                $clock_out = date('g:i A');
                $office_out_time = app_config('OfficeOutTime');
                $office_in_time = app_config('OfficeInTime');

                $office_hour = (strtotime($office_out_time) - strtotime($office_in_time)) / 60;

                if($attendance->clock_in_optional==''){
                    $clock_in = $attendance->clock_in;

                    $late_1 = strtotime($office_in_time);
                    $late_2 = strtotime($clock_in);
                    $late = ($late_2 - $late_1);

                    if ($late < 0) {
                        $late = 0;
                    }
                    $late = $late / 60;


                    $early_leave_1 = strtotime($clock_out);
                    $early_leave_2 = strtotime($office_out_time);
                    $early_leave = ($early_leave_2 - $early_leave_1);

                    if ($early_leave < 0) {
                        $early_leave = 0;
                    }
                    $early_leave = $early_leave / 60;

                    $total = $office_hour - $late - $early_leave;
                    $attendance->late = $late;
                }else{

                    $clock_in=$attendance->clock_in_optional;
                    $early_leave_1 = strtotime($clock_out);
                    $early_leave_2 = strtotime($office_out_time);
                    $early_leave = ($early_leave_2 - $early_leave_1);

                    if ($early_leave < 0) {
                        $early_leave = 0;
                    }

                    $early_leave=$early_leave/60;
                    $total=$office_hour-($attendance->early_leaving+$attendance->late);
                }

                $attendance->clock_out = $clock_out;
                $attendance->early_leaving = $early_leave;
                $attendance->overtime= '0';
                $attendance->total= $total;
                $attendance->clock_status='Clock Out';
                $attendance->save();

                return redirect('employee/dashboard')->with([
                    'message' => language_data('Clock Out Successfully')
                ]);

            }

        } else {
            $entry = new Attendance();
            $entry->emp_id = \Auth::user()->id;
            $entry->designation = \Auth::user()->designation;
            $entry->department = \Auth::user()->department;
            $entry->date = date('Y-m-d');
            $entry->clock_in = date('g:i A');
            $entry->status = 'Present';
            $entry->clock_status = 'Clock In';
            $entry->save();

            return redirect('employee/dashboard')->with([
                'message' => language_data('Clock In Successfully')
            ]);

        }

    }

    /* allLoan  Function Start Here */
    public function allLoan()
    {
        $loan=Loan::where('emp_id',\Auth::user()->id)->get();

        return view('employee.loan',compact('loan'));

    }

    /* postNewLoan  Function Start Here */
    public function postNewLoan(Request $request)
    {
        $v=\Validator::make($request->all(),[
            'title'=>'required','loan_date'=>'required','loan_amount'=>'required','payslip'=>'required','repayment_amount'=>'required','repayment_start_date'=>'required'
        ]);

        if($v->fails()){
            return redirect('employee/loan/all')->withErrors($v->errors());
        }

        $emp_name=\Auth::user()->id;
        $title=Input::get('title');
        $loan_date=Input::get('loan_date');
        $loan_date=date('Y-m-d',strtotime($loan_date));
        $loan_amount=Input::get('loan_amount');
        $payslip=Input::get('payslip');
        $repayment_amount=Input::get('repayment_amount');
        $repayment_start_date=Input::get('repayment_start_date');
        $repayment_start_date=date('Y-m-d',strtotime($repayment_start_date));
        $description=Input::get('description');
        $status='Pending';

        $loan= new Loan();
        $loan->emp_id=$emp_name;
        $loan->title=$title;
        $loan->loan_date=$loan_date;
        $loan->amount=$loan_amount;
        $loan->enable_payslip=$payslip;
        $loan->repayment_amount=$repayment_amount;
        $loan->remaining_amount=$loan_amount;
        $loan->repayment_start_date=$repayment_start_date;
        $loan->description=$description;
        $loan->status=$status;
        $loan->save();

        return redirect('employee/loan/all')->with([
            'message'=>language_data('Loan Added Successfully')
        ]);

    }

    /* viewLoanDetails  Function Start Here */
    public function viewLoanDetails($id)
    {
        $loan=Loan::where('emp_id',\Auth::user()->id)->find($id);
        if($loan){
            return view('employee.manage-loan',compact('loan'));
        }else{
            return redirect('employee/loan/all')->with([
                'message'=> language_data('Loan information not found'),
                'message_important'=>true
            ]);
        }
    }


    /* postEditLoan  Function Start Here */
    public function postEditLoan(Request $request)
    {

        $cmd=Input::get('cmd');
        $v=\Validator::make($request->all(),[
            'title'=>'required','loan_date'=>'required','loan_amount'=>'required','payslip'=>'required','repayment_amount'=>'required','repayment_start_date'=>'required'
        ]);

        if($v->fails()){
            return redirect('employee/loan/view-details/'.$cmd)->withErrors($v->errors());
        }

        $title=Input::get('title');
        $loan_date=Input::get('loan_date');
        $loan_date=date('Y-m-d',strtotime($loan_date));
        $loan_amount=Input::get('loan_amount');
        $payslip=Input::get('payslip');
        $repayment_amount=Input::get('repayment_amount');
        $repayment_start_date=Input::get('repayment_start_date');
        $repayment_start_date=date('Y-m-d',strtotime($repayment_start_date));
        $description=Input::get('description');

        $loan=Loan::find($cmd);
        $loan->title=$title;
        $loan->loan_date=$loan_date;
        $loan->amount=$loan_amount;
        $loan->enable_payslip=$payslip;
        $loan->repayment_amount=$repayment_amount;
        $loan->remaining_amount=$loan_amount;
        $loan->repayment_start_date=$repayment_start_date;
        $loan->description=$description;
        $loan->save();

        return redirect('employee/loan/all')->with([
            'message'=> language_data('Loan information updated Successfully')
        ]);
    }


    /*Version 1.5*/

    /* attendance  Function Start Here */
    public function attendance()
    {

        $attendance=Attendance::where('emp_id',\Auth::user()->id)->get();

        return view('employee.attendance',compact('attendance'));

    }

    /* training  Function Start Here */
    public function training()
    {
        $trainer_emp=TrainingMembers::where('emp_id',\Auth::user()->id)->get(['training_id'])->toArray();
        $emp_training=EmployeeTraining::find($trainer_emp);

        return view('employee.employee-training',compact('emp_training'));

    }

    /* viewTraining  Function Start Here */
    public function viewTraining($id)
    {
        $emp_train=EmployeeTraining::find($id);

        if($emp_train){
            $employee=Employee::where('user_name','!=','admin')->where('status','Active')->get();
            $trainers=Trainers::all();
            $train_members=TrainingMembers::where('training_id',$id)->get(['emp_id'])->toArray();

            return view('employee.view-employee-training',compact('emp_train','train_members','employee','trainers'));

        }else{
            return redirect('employee/training')->with([
                'message'=> language_data('Employee training info not found'),
                'message_important'=>true
            ]);
        }

    }


}
