<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Classes\permission;
use App\Department;
use App\Designation;
use App\Employee;
use App\Loan;
use App\Payroll;
use App\ProvidentFund;
use App\TaxRuleDetails;
use App\TaxRules;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\View\View;
use Knp\Snappy\Pdf;

class PayrollController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /* employeeSalaryList  Function Start Here */
    public function employeeSalaryList()
    {
        $self='employee-salary-list';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $employee = Employee::where('user_name', '!=', 'admin')->where('status', 'active')->get();
        return view('admin.employee-salary-list', compact('employee'));
    }

    /* employeeSalaryIncrement  Function Start Here */
    public function employeeSalaryIncrement()
    {
        $self='employee-salary-increment';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $employee = Employee::where('user_name', '!=', 'admin')->where('status', 'active')->get();
        return view('admin.employee-salary-increment', compact('employee'));
    }

    /* editEmployeeSalary  Function Start Here */
    public function editEmployeeSalary($id)
    {
        $self='employee-salary-list';
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
            return view('admin.edit-employee-salary', compact('employee'));
        } else {
            return redirect('payroll/employee-salary-list')->with([
                'message' => language_data('Employee Not Found'),
                'message_important' => true
            ]);
        }

    }

    /* editEmployeeSalaryIncrement  Function Start Here */
    public function editEmployeeSalaryIncrement($id)
    {
        $self='employee-salary-increment';
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
            return view('admin.edit-employee-salary-increment', compact('employee'));
        } else {
            return redirect('payroll/employee-salary-increment')->with([
                'message' => language_data('Employee Not Found'),
                'message_important' => true
            ]);
        }

    }

    /* postEditEmployeeSalary  Function Start Here */
    public function postEditEmployeeSalary(Request $request)
    {
        $self='employee-salary-list';
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
            'payment_type' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('payroll/employee-salary-edit/' . $cmd)->withErrors($v->errors());
        }

        $payment_type=Input::get('payment_type');

        $employee = Employee::find($cmd);
        if ($employee) {

            $employee->payment_type=$payment_type;

            if($payment_type=='Hourly'){
                $employee->working_hourly_rate = $request->hourly_working_rate;
                $employee->overtime_hourly_rate = $request->hourly_overtime_rate;
            }else{
                $employee->basic_salary=$request->basic_salary;
                $employee->overtime_salary=$request->overtime_salary;
            }

            $employee->save();

            return redirect('payroll/employee-salary-list')->with([
                'message' => language_data('Salary Updated Successfully')
            ]);
        } else {
            return redirect('payroll/employee-salary-list')->with([
                'message' => language_data('Employee Not Found'),
                'message_important' => true
            ]);
        }

    }

    /* postEditEmployeeSalaryIncrement  Function Start Here */
    public function postEditEmployeeSalaryIncrement(Request $request)
    {
        $self='employee-salary-increment';
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
            'payment_type' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('payroll/employee-salary-increment-edit/' . $cmd)->withErrors($v->errors());
        }

        $employee = Employee::find($cmd);
        if ($employee) {

            if($request->payment_type=='Monthly'){

                $employee->basic_salary_increment = $request->basic_salary;
                $employee->overtime_salary_increment = $request->overtime_salary;

            }else{
                $employee->working_hourly_increment_rate = $request->hourly_working_rate;
                $employee->overtime_hourly_increment_rate = $request->hourly_overtime_rate;
            }

            $employee->save();

            return redirect('payroll/employee-salary-increment')->with([
                'message' => language_data('Salary Updated Successfully')
            ]);
        } else {
            return redirect('payroll/employee-salary-increment')->with([
                'message' => language_data('Employee Not Found'),
                'message_important' => true
            ]);
        }

    }

    /* makePayment  Function Start Here */
    public function makePayment()
    {
        $self='make-payment';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $date = '';
        $emp_id = '';
        $dep_id = '';
        $des_id = '';
        $search_status = '';

        $department = Department::all();
        $employee = Employee::where('status', 'active')->where('user_name', '!=', 'admin')->get();

        return view('admin.make-payment', compact('department', 'employee', 'date', 'emp_id', 'dep_id', 'des_id', 'search_status'));
    }

    /* getDesignation  Function Start Here */
    public function getDesignation(Request $request)
    {
        $dep_id = $request->dep_id;
        if ($dep_id) {
            echo '<option value="0">Select Designation</option>';
            $designation = Designation::where('did', $dep_id)->get();
            foreach ($designation as $d) {
                echo '<option value="' . $d->id . '">' . $d->designation . '</option>';
            }
        }
    }

    /* postCustomSearch  Function Start Here */
    public function postCustomSearch(Request $request)
    {

        $v = \Validator::make($request->all(), [
            'date' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('payroll/generate')->withErrors($v->errors());
        }

        $date = Input::get('date');
        $date=date('Y-m-d',strtotime($date));
        $emp_id = Input::get('employee');
        $dep_id = Input::get('department');
        $des_id = Input::get('designation');

        $text_date=date('F, Y',strtotime($date));

        $payment_info=Payroll::where('payment_month',$text_date)->get();

        $employee_ids=array();

        foreach($payment_info as $p){
            array_push($employee_ids,$p->emp_id);
        }

        $search_status = 'yes';

        $payroll_query = Employee::where('status','active')->where('user_name','!=','admin');

        if ($emp_id) {
            $payroll_query->Where('id', $emp_id);
        }else{
            $payroll_query->whereNotIn('id',$employee_ids);
        }

        if ($dep_id) {
            $payroll_query->Where('department', $dep_id);
        }

        if ($des_id) {
            $payroll_query->Where('designation', $des_id);
        }

        $payroll = $payroll_query->orderBy('id', 'asc')->get();

        $employee = Employee::where('status', 'active')->where('user_name', '!=', 'admin')->get();
        $department = Department::all();

        return view('admin.make-payment', compact('payroll', 'employee', 'department', 'date', 'emp_id', 'dep_id', 'des_id', 'search_status'));

    }


    /* payPayment  Function Start Here */
    public function payPayment($emp_id,$date)
    {
        $self='make-payment';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $text_date=date('F, Y',strtotime($date));
        $first_day = date('Y-m-01', strtotime($date));
        $last_day = date('Y-m-t', strtotime($date));

        $employee=Employee::find($emp_id);
        $payment_type=$employee->payment_type;

        if($payment_type=='Hourly'){
            $payment = Attendance::whereBetween('date', [$first_day, $last_day])->where('emp_id',$emp_id)->get();

            $net_salary='0';
            $overtime_salary='0';

            foreach($payment as $p){
                $net_salary+=($p->total/60)*$p->employee_info->working_hourly_rate*$p->employee_info->working_hourly_increment_rate;
                $overtime_salary+=$p->overtime*$p->employee_info->overtime_hourly_rate*$p->employee_info->overtime_hourly_increment_rate;
            }

            $net_salary=round($net_salary,2);
            $overtime_salary=round($overtime_salary,2);
        }else{

            $payment = Attendance::whereBetween('date', [$first_day, $last_day])->where('emp_id',$emp_id)->get();
            $overtime_salary='0';

            foreach($payment as $p){
                $overtime_salary+=$p->overtime*$p->employee_info->overtime_salary*$p->employee_info->overtime_salary_increment;
            }
            $overtime_salary=round($overtime_salary,2);
            $net_salary=round(($employee->basic_salary+$employee->basic_salary_increment),2);
        }
        $payment_amount=$net_salary+$overtime_salary;

        $payroll=Payroll::where('emp_id',$emp_id)->get();

        $tax_rules=TaxRuleDetails::where('tax_id',$employee->tax_id)->where('salary_from','<=',$payment_amount)->where('salary_to','>=',$payment_amount)->first();

        if($tax_rules==''){
            $deducted_tax='0';
        }else{
            if($employee->gender==$tax_rules->gender){
                $tax_rules=TaxRuleDetails::where('tax_id',$employee->tax_id)->where('gender',$tax_rules->gender)->where('salary_from','<=',$payment_amount)->where('salary_to','>=',$payment_amount)->first();
            }

            $tax=$tax_rules->tax_percentage;
            $additional_tax_amount=$tax_rules->additional_tax_amount;

            $deducted_tax=($payment_amount*$tax)/100;
            $deducted_tax=$deducted_tax+$additional_tax_amount;
        }



        $provident_fund=ProvidentFund::where('emp_id',$emp_id)->where('status','Unpaid')->first();


        if($provident_fund){
            if($provident_fund->provident_fund_type=='Fixed Amount'){
                $provident_deducted=$provident_fund->employee_share;
            }else{
                $provident_deducted=($payment_amount*$provident_fund->employee_share)/100;
            }
        }else{
            $provident_deducted='';
        }

        $loan=Loan::where('emp_id',$emp_id)->where('enable_payslip','yes')->where('remaining_amount','>','0')->where('repayment_start_date','<=',date('Y-m-d'))->where('status','ongoing')->get();


        $loan_deducted='';
        if(count($loan)>0){
            foreach($loan as $l){
                if($l->remaining_amount>=$l->repayment_amount){
                    $loan_deducted+= $l->repayment_amount;
                }else{
                    $loan_deducted+=$l->remaining_amount;
                }
            }
        }else{
            $loan_deducted='';
        }


        $payment_amount=$payment_amount-$provident_deducted-$loan_deducted-$deducted_tax;
        $payment_amount=round($payment_amount,2);



        return view('admin.pay-payment',compact('text_date','net_salary','overtime_salary','payment_amount','emp_id','date','payroll','provident_deducted','loan_deducted','deducted_tax'));
    }

    /* payPaymentPost  Function Start Here */
    public function payPaymentPost(Request $request)
    {
        $self='make-payment';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $emp_id=Input::get('emp_id');
        $date=Input::get('date');
        $date=date('Y-m-d',strtotime($date));
        $v=\Validator::make($request->all(),[
            'net_salary'=>'required','overtime_salary'=>'required','payment_amount'=>'required','payment_type'=>'required'
        ]);


        if($v->fails()){
            return redirect('payroll/pay-payment/'.$emp_id.'/'.$date)->withErrors($v->errors());
        }

        $employee=Employee::find($emp_id);

        $designation=$employee->designation;
        $department=$employee->department;
        $provident_fund=$request->provident_fund;

        if($provident_fund==''){
            $provident_fund=0;
        }

        $loan=$request->loan;

        if($loan==''){
            $loan='0';
        }
        $organization_share=$request->net_salary+$request->overtime_salary;

        $pf=ProvidentFund::where('emp_id',$emp_id)->where('status','Unpaid')->first();


        if($pf){
            if($pf->provident_fund_type=='Fixed Amount'){
                $provident_deducted=$pf->organization_share;
            }else{
                $provident_deducted=($organization_share*$pf->organization_share)/100;
            }

            $total_provident_fund=$provident_fund+$provident_deducted;
            $pf->total+=$total_provident_fund;
            $pf->save();

        }


        $payroll=Payroll::firstOrCreate([
            'emp_id'=>$request->emp_id,
            'department'=>$department,
            'designation'=>$designation,
            'payment_month'=>$request->text_date,
            'payment_date'=>date('Y-m-d'),
            'net_salary'=>$request->net_salary,
            'tax'=>$request->tax,
            'provident_fund'=>$provident_fund,
            'loan'=>$loan,
            'overtime_salary'=>$request->overtime_salary,
            'total_salary'=>$request->payment_amount,
            'payment_type'=>$request->payment_type
        ]);

        $text_date=date('Y-m',strtotime($payroll->payment_month));
        $first_day = date('Y-m-01', strtotime($text_date));
        $last_day = date('Y-m-t', strtotime($text_date));

        $payment = Attendance::whereBetween('date', [$first_day, $last_day])->where('emp_id',$emp_id)->get();

        foreach($payment as $p){
            $p->pay_status='Paid';
            $p->save();
        }

        $loan_query=Loan::where('emp_id',$emp_id)->where('enable_payslip','yes')->where('repayment_start_date','<=',date('Y-m-d'))->where('status','ongoing')->get();
        if(count($loan_query)>0){
            foreach($loan_query as $l){
                if($l->remaining_amount>=$l->repayment_amount){
                    $l->remaining_amount-= $l->repayment_amount;
                }else{
                    $l->remaining_amount-=$l->remaining_amount;
                }
                $l->save();
            }
        }
        $set_loan_status=Loan::where('emp_id',$emp_id)->where('remaining_amount','0')->get();

        if(count($set_loan_status->toArray())!=0){
            foreach($set_loan_status as $l){
                $l->status='completed';
                $l->save();
            }
        }



        if($payroll->wasRecentlyCreated){
            return redirect('payroll/view-details/'.$payroll->id)->with([
                'message'=> language_data('Amount Paid Successfully')
            ]);

        }else{
            return redirect('payroll/pay-payment/'.$emp_id.'/'.$date)->with([
                'message'=> language_data('Payment Already Paid'),
                'message_important'=>true
            ]);
        }

    }

    /* generatePayslip  Function Start Here */
    public function generatePayslip()
    {
        $self='generate-payslip';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $date = '';
        $emp_id = '';
        $dep_id = '';
        $des_id = '';

        $department = Department::all();
        $employee = Employee::where('status', 'active')->where('user_name', '!=', 'admin')->get();

        $payroll=Payroll::all();

        return view('admin.generate-payslip', compact('payroll','department', 'employee', 'date', 'emp_id', 'dep_id', 'des_id'));
    }


    /* postPayslipCustomSearch  Function Start Here */
    public function postPayslipCustomSearch(Request $request)
    {
        $self='generate-payslip';
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
            'date'=>'required'
        ]);

        if($v->fails()){
            return redirect('payroll/generate')->withErrors($v->errors());
        }


        $date = Input::get('date');
        $date=date('Y-m-d',strtotime($date));
        $emp_id = Input::get('employee');
        $dep_id = Input::get('department');
        $des_id = Input::get('designation');
        $first_day = date('Y-m-01', strtotime($date));
        $last_day = date('Y-m-t', strtotime($date));

        $payroll=Payroll::whereBetween('payment_date', [$first_day, $last_day]);

        if ($emp_id) {
            $payroll->Where('emp_id', $emp_id);
        }

        if ($dep_id) {
            $payroll->Where('department', $dep_id);
        }

        if ($des_id) {
            $payroll->Where('designation', $des_id);
        }

        $payroll = $payroll->get();

        $department = Department::all();
        $employee = Employee::where('status', 'active')->where('user_name', '!=', 'admin')->get();

        return view('admin.generate-payslip', compact('payroll','department', 'employee', 'date', 'emp_id', 'dep_id', 'des_id'));

    }


    /* viewDetails  Function Start Here */
    public function viewDetails($id)
    {
        $self='generate-payslip';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $payslip=Payroll::find($id);

        if($payslip){
            return view('admin.view-payslip',compact('payslip'));
        }else{
            return redirect('payroll/generate')->with([
                'message' => language_data('Payment Details Not found'),
                'message_important' => true
            ]);
        }

    }

    /* printPayslip  Function Start Here */
    public function printPayslip($id)
    {
        $self='generate-payslip';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $payslip=Payroll::find($id);

        if($payslip){
            return view('admin.print-payslip',compact('payslip'));
        }else{
            return redirect('payroll/generate')->with([
                'message' => language_data('Payment Details Not found'),
                'message_important' => true
            ]);
        }

    }

    /* providentFund  Function Start Here */
    public function providentFund()
    {
        $self='provident-fund';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $pfund=ProvidentFund::all();
        $employee=Employee::where('user_name','!=','admin')->get();
        return view('admin.provident-fund',compact('pfund','employee'));
    }

    /* postProvidentFund  Function Start Here */
    public function postProvidentFund(Request $request)
    {
        $self='provident-fund';
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
            'emp_name'=>'required','fund_type'=>'required'
        ]);

        if($v->fails()){
            return redirect('provident-fund/all')->withErrors($v->errors());
        }

        $exist=ProvidentFund::where('emp_id',$request->emp_name)->where('status','Unpaid')->first();

        if($exist){
            return redirect('provident-fund/all')->with([
                'message'=> language_data('Provident Fund already running'),
                'message_important'=>true
            ]);
        }

        $fund_type=Input::get('fund_type');

        if($fund_type=='Fixed Amount'){
            $employee_share=Input::get('emp_share_fixed');
            $organization_share=Input::get('org_share_fixed');
        }else{
            $employee_share=Input::get('emp_share_per');
            $organization_share=Input::get('org_share_per');
        }

        $description=Input::get('description');

        $pfund=new ProvidentFund();
        $pfund->emp_id=$request->emp_name;
        $pfund->provident_fund_type=$fund_type;
        $pfund->employee_share=$employee_share;
        $pfund->organization_share=$organization_share;
        $pfund->description=$description;
        $pfund->status='Unpaid';

        $pfund->save();

        return redirect('provident-fund/all')->with([
            'message'=> language_data('Provident Fund Added Successfully')
        ]);

    }

    /* viewProvidentFund  Function Start Here */
    public function viewProvidentFund($id)
    {
        $self='provident-fund';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $pfund=ProvidentFund::find($id);

        if($pfund){
            $employee=Employee::where('user_name','!=','admin')->get();
            return view('admin.edit-provident-fund',compact('pfund','employee'));
        }else{
            return redirect('provident-fund/all')->with([
                'message'=> language_data('Provident Fund information not found')
            ]);
        }

    }

    /* postEditProvidentFund  Function Start Here */
    public function postEditProvidentFund(Request $request)
    {

        $cmd=Input::get('cmd');

        $appStage=app_config('AppStage');
        if($appStage=='Demo'){
            return redirect('provident-fund/view-details/'.$cmd)->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important'=>true
            ]);
        }

        $self='provident-fund';
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
            'emp_name'=>'required','fund_type'=>'required','status'=>'required'
        ]);

        if($v->fails()){
            return redirect('provident-fund/view-details/'.$cmd)->withErrors($v->errors());
        }

        $fund_type=Input::get('fund_type');

        if($fund_type=='Fixed Amount'){
            $employee_share=Input::get('emp_share_fixed');
            $organization_share=Input::get('org_share_fixed');
        }else{
            $employee_share=Input::get('emp_share_per');
            $organization_share=Input::get('org_share_per');
        }

        $description=Input::get('description');

        $pfund=ProvidentFund::find($cmd);

        $pfund->emp_id=$request->emp_name;
        $pfund->provident_fund_type=$fund_type;
        $pfund->employee_share=$employee_share;
        $pfund->organization_share=$organization_share;
        $pfund->description=$description;
        $pfund->status=$request->status;

        $pfund->save();

        return redirect('provident-fund/all')->with([
            'message'=> language_data('Provident Fund Updated Successfully')
        ]);

    }

    /* makePaymentProvidentFund  Function Start Here */
    public function makePaymentProvidentFund(Request $request)
    {
        $self='provident-fund';
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
            'payment_type'=>'required'
        ]);

        if($v->fails()){
            return redirect('provident-fund/all')->withErrors($v->errors());
        }

        $id=Input::get('cmd');

        $pfund=ProvidentFund::find($id);
        if($pfund){
            $pfund->payment_type=$request->payment_type;
            $pfund->status='Paid';
            $pfund->save();
            return redirect('provident-fund/all')->with([
                'message'=> language_data('Provident Fund paid successfully')
            ]);
        }else{
            return redirect('provident-fund/all')->with([
                'message'=> language_data('Provident Fund information not found'),
                'message_important'=>true
            ]);
        }
    }

    /* payslipProvidentFund  Function Start Here */
    public function payslipProvidentFund($id)
    {
        $self='provident-fund';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $payslip=ProvidentFund::find($id);
        $payroll=Payroll::where('emp_id',$payslip->emp_id)->where('provident_fund','!=','0')->get();
        $employee_share=Payroll::where('emp_id',$payslip->emp_id)->where('provident_fund','!=','0')->sum('provident_fund');
        $organization_share=$payslip->total-$employee_share;



        if($payslip){
            return view('admin.provident-fund-payslip',compact('payslip','payroll','organization_share','employee_share'));
        }else{
            return redirect('provident-fund/all')->with([
                'message'=> language_data('Provident Fund information not found'),
                'message_important'=>true
            ]);
        }
    }

    /* printPayslipProvidentFund  Function Start Here */
    public function printPayslipProvidentFund($id)
    {
        $self='provident-fund';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $payslip=ProvidentFund::find($id);
        $payroll=Payroll::where('emp_id',$payslip->emp_id)->where('provident_fund','!=','0')->get();
        $employee_share=Payroll::where('emp_id',$payslip->emp_id)->where('provident_fund','!=','0')->sum('provident_fund');
        $organization_share=$payslip->total-$employee_share;

        if($payslip){
            return view('admin.provident-fund-print-payslip',compact('payslip','payroll','organization_share','employee_share'));
        }else{
            return redirect('provident-fund/all')->with([
                'message'=> language_data('Provident Fund information not found'),
                'message_important'=>true
            ]);
        }
    }


    /* deleteProvidentFund  Function Start Here */
    public function deleteProvidentFund($id)
    {

        $appStage=app_config('AppStage');
        if($appStage=='Demo'){
            return redirect('provident-fund/all')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important'=>true
            ]);
        }

        $self='provident-fund';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $pfund=ProvidentFund::find($id);
        if($pfund){
            $pfund->delete();
            return redirect('provident-fund/all')->with([
                'message'=> language_data('Provident Fund delete successfully')
            ]);
        }else{
            return redirect('provident-fund/all')->with([
                'message'=> language_data('Provident Fund information not found'),
                'message_important'=>true
            ]);
        }
    }


    /* loan  Function Start Here */
    public function loan()
    {
        $self='loan';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $loan=Loan::all();
        $employee=Employee::where('user_name','!=','admin')->get();

        return view('admin.loan',compact('loan','employee'));
    }

    /* postNewLoan  Function Start Here */
    public function postNewLoan(Request $request)
    {
        $self='loan';
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
            'emp_name'=>'required','title'=>'required','loan_date'=>'required','loan_amount'=>'required','payslip'=>'required','repayment_amount'=>'required','repayment_start_date'=>'required'
        ]);

        if($v->fails()){
            return redirect('loan/all')->withErrors($v->errors());
        }

        $emp_name=Input::get('emp_name');
        $title=Input::get('title');
        $loan_date=Input::get('loan_date');
        $loan_date=date('Y-m-d',strtotime($loan_date));
        $loan_amount=Input::get('loan_amount');
        $payslip=Input::get('payslip');
        $repayment_amount=Input::get('repayment_amount');
        $repayment_start_date=Input::get('repayment_start_date');
        $repayment_start_date=date('Y-m-d',strtotime($repayment_start_date));
        $description=Input::get('description');
        $status=Input::get('status');

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

        return redirect('loan/all')->with([
            'message'=> language_data('Loan Added Successfully')
        ]);

    }

    /* viewDetailsLoan  Function Start Here */
    public function viewDetailsLoan($id)
    {
        $self='loan';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $loan=Loan::find($id);
        if($loan){
            $employee=Employee::where('user_name','!=','admin')->get();
            return view('admin.manage-loan',compact('loan','employee'));
        }else{
            return redirect('loan/all')->with([
                'message'=> language_data('Loan information not found'),
                'message_important'=>true
            ]);
        }

    }

    /* postEditLoan  Function Start Here */
    public function postEditLoan(Request $request)
    {

        $cmd=Input::get('cmd');


        $appStage=app_config('AppStage');
        if($appStage=='Demo'){
            return redirect('loan/view-details/'.$cmd)->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important'=>true
            ]);
        }

        $self='loan';
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
            'emp_name'=>'required','title'=>'required','loan_date'=>'required','loan_amount'=>'required','payslip'=>'required','repayment_amount'=>'required','repayment_start_date'=>'required'
        ]);

        if($v->fails()){
            return redirect('loan/view-details/'.$cmd)->withErrors($v->errors());
        }

        $emp_name=Input::get('emp_name');
        $title=Input::get('title');
        $loan_date=Input::get('loan_date');
        $loan_date=date('Y-m-d',strtotime($loan_date));
        $loan_amount=Input::get('loan_amount');
        $payslip=Input::get('payslip');
        $repayment_amount=Input::get('repayment_amount');
        $repayment_start_date=Input::get('repayment_start_date');
        $repayment_start_date=date('Y-m-d',strtotime($repayment_start_date));
        $description=Input::get('description');
        $status=Input::get('status');

        $loan=Loan::find($cmd);
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

        return redirect('loan/all')->with([
            'message'=> language_data('Loan information updated Successfully')
        ]);
    }

    /* deleteLoan  Function Start Here */
    public function deleteLoan($id)
    {
        $appStage=app_config('AppStage');
        if($appStage=='Demo'){
            return redirect('loan/all')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important'=>true
            ]);
        }

        $self='loan';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $loan=Loan::find($id);

        if($loan){
            $loan->delete();

            return redirect('loan/all')->with([
                'message'=> language_data('Loan information delete Successfully')
            ]);
        }else{
            return redirect('loan/all')->with([
                'message'=> language_data('Loan information not found'),
                'message_important'=>true
            ]);
        }

    }


    /*Version 1.5*/

    /* downloadPdf  Function Start Here */
    public function downloadPdf($id)
    {
        $payslip=Payroll::find($id);

        $data=\View::make('admin.pdf-payslip',compact('payslip'));
        $html=$data->render();
        $pdf=\App::make('snappy.pdf.wrapper');
        $pdf->loadHTML($html);
        return $pdf->inline();


    }



}
