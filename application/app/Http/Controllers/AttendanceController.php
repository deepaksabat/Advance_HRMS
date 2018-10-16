<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Classes\permission;
use App\Department;
use App\Designation;
use App\Employee;
use Illuminate\Http\Request;
use WkPdf;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

date_default_timezone_set(app_config('Timezone'));

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /* report  Function Start Here */
    public function report()
    {

        $self='attendance-report';

        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message'=>language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $date_from = '';
        $date_to = '';
        $emp_id = '';
        $dep_id = '';
        $des_id = '';

        $attendance = Attendance::all();
        $employee = Employee::where('status', 'active')->where('user_name','!=','admin')->get();
        $department = Department::all();
        return view('admin.attendance', compact('attendance', 'employee', 'department', 'date_from','date_to', 'emp_id', 'dep_id', 'des_id'));
    }

    /* getAllPdfReport  Function Start Here */
    public function getAllPdfReport()
    {

        $self='attendance-report';

        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message'=>language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $attendance = Attendance::all();



        $pdf=WkPdf::loadView('admin.all-pdf-attendance-report', compact('attendance'));

        return $pdf->download('attendance.pdf');
    }


    /* postSetOvertime  Function Start Here */
    public function postSetOvertime(Request $request)
    {
        $attend_id=$request->attend_id;
        $overTimeValue=$request->overTimeValue;

        if($attend_id!='' AND $overTimeValue!=''){
            Attendance::where('id', $attend_id)->update(['overtime' => $overTimeValue]);
            return 'success';
        }else{
            return 'failed';
        }
    }


    /* update  Function Start Here */
    public function update()
    {

        $self='update-attendance';

        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message'=>language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $employee = Employee::where('status', 'active')->where('user_name','!=','admin')->get();
        return view('admin.update-attendance', compact('employee'));

    }

    /* postUpdateAttendance  Function Start Here */
    public function postUpdateAttendance(Request $request)
    {

        $v = \Validator::make($request->all(), [
            'employee' => 'required', 'date' => 'required', 'clock_in' => 'required', 'clock_out' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('attendance/update')->withErrors($v->errors());
        }

        $employee = Input::get('employee');
        $date = Input::get('date');
        $date=date('Y-m-d',strtotime($date));
        $clock_in = Input::get('clock_in');
        $clock_out = Input::get('clock_out');
        $entry_time=strtotime($clock_in);
        $out_time=strtotime($clock_out);

        $get_attendance_data=$out_time-$entry_time;

        $check_clock=($get_attendance_data > 0 ) ? 1 : ( ( $get_attendance_data < 0 ) ? -1 : 0);

        if ($check_clock==-1){
            return redirect('attendance/update')->with([
                'message'=>language_data('Insert your time perfectly'),
                'message_important'=>true
            ]);
        }


        $office_in_time = app_config('OfficeInTime');
        $office_out_time = app_config('OfficeOutTime');

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

        $office_hour = (strtotime($office_out_time) - strtotime($office_in_time)) / 60;
        $total = $office_hour - $late - $early_leave;


        $emp_info = Employee::find($employee);
        $designation = $emp_info->designation;
        $department = $emp_info->department;


        $attendance = Attendance::where('emp_id', $employee)->where('date', $date)->first();

        if ($attendance) {
            $attendance->clock_in = $clock_in;
            $attendance->clock_out = $clock_out;
            $attendance->late = $late;
            $attendance->early_leaving = $early_leave;
            $attendance->overtime= '0';
            $attendance->total= $total;
            $attendance->status = 'Present';
            $attendance->save();

        } else {
            $adance = new Attendance();
            $adance->emp_id = $employee;
            $adance->designation = $designation;
            $adance->department = $department;
            $adance->date = $date;
            $adance->clock_in = $clock_in;
            $adance->clock_out = $clock_out;
            $adance->late = $late;
            $adance->early_leaving = $early_leave;
            $adance->overtime= '0';
            $adance->total = $total;
            $adance->status = 'Present';
            $adance->save();

        }

        return redirect('attendance/report')->with([
            'message' => language_data('Attendance Updated Successfully')
        ]);

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
            'date_from' => 'required','date_to' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('attendance/report')->withErrors($v->errors());
        }

        $date_from = Input::get('date_from');
        $date_to = Input::get('date_to');
        $date_from=date('Y-m-d',strtotime($date_from));
        $date_to=date('Y-m-d',strtotime($date_to));


        $emp_id = Input::get('employee');
        $dep_id = Input::get('department');
        $des_id = Input::get('designation');

        $designation = Designation::where('did',$dep_id)->get();


        $attendance_query = Attendance::whereBetween('date', [$date_from,$date_to]);

        if ($emp_id) {
            $attendance_query->Where('emp_id', $emp_id);
        }

        if ($dep_id) {
            $attendance_query->Where('department', $dep_id);
        }

        if ($des_id) {
            $attendance_query->Where('designation', $des_id);
        }

        $attendance = $attendance_query->get();


        $employee = Employee::where('status', 'active')->get();
        $department = Department::all();
        return view('admin.attendance', compact('attendance', 'employee', 'department', 'date_to','date_from', 'emp_id', 'dep_id', 'des_id','designation'));

    }
    /* getPdfReport  Function Start Here */
    public function getPdfReport($date,$emp_id=0,$dep_id=0,$des_id=0)
    {

        $date=explode('_',$date);

        if (is_array($date)){
            $date_from=$date['0'];
            $date_to=$date['1'];
        }else{
            return redirect('attendance/report')->with([
                'message' => 'Invalid Date',
                'message_important' => true
            ]);
        }

        $date_from=date('Y-m-d',strtotime($date_from));
        $date_to=date('Y-m-d',strtotime($date_to));
        $attendance_query = Attendance::whereBetween('date', [$date_from,$date_to]);

        if ($emp_id) {
            $attendance_query->Where('emp_id', $emp_id);
        }

        if ($dep_id) {
            $attendance_query->Where('department', $dep_id);
        }

        if ($des_id) {
            $attendance_query->Where('designation', $des_id);
        }

        $attendance = $attendance_query->get();

        $pdf=\WkPdf::loadView('admin.all-pdf-attendance-report', compact('attendance'));

        return $pdf->download('attendance.pdf');

    }

    /* editAttendance  Function Start Here */
    public function editAttendance($id)
    {

        $self='attendance-report';

        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message'=>language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $attendance = Attendance::find($id);
        if ($attendance) {
            return view('admin.edit-attendance', compact('attendance'));
        } else {
            return redirect('attendance/report')->with([
                'message' => language_data('Attendance Info Not Found'),
                'message_important' => true
            ]);
        }
    }

    /* postEditAttendance  Function Start Here */
    public function postEditAttendance(Request $request)
    {
        $cmd = Input::get('cmd');
        $v = \Validator::make($request->all(), [
            'clock_in' => 'required', 'clock_out' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('attendance/edit/' . $cmd)->withErrors($v->errors());
        }

        $clock_in = Input::get('clock_in');
        $clock_out = Input::get('clock_out');

        $entry_time=strtotime($clock_in);
        $out_time=strtotime($clock_out);

        $get_attendance_data=$out_time-$entry_time;

        $check_clock=($get_attendance_data > 0 ) ? 1 : ( ( $get_attendance_data < 0 ) ? -1 : 0);

        if ($check_clock==-1){
            return redirect('attendance/edit/' . $cmd)->with([
                'message'=>language_data('Insert your time perfectly'),
                'message_important'=>true
            ]);
        }


        $office_in_time = app_config('OfficeInTime');
        $office_out_time = app_config('OfficeOutTime');

        $check_out_entry=strtotime($office_in_time);
        $check_out_data=$out_time-$check_out_entry;


        $check_clock=($check_out_data > 0 ) ? 1 : ( ( $check_out_data < 0 ) ? -1 : 0);

        if ($check_clock==-1){
            return redirect('attendance/edit/' . $cmd)->with([
                'message'=>language_data('Office time: In Time').$office_in_time.' '.language_data('and Out Time').' '.$office_out_time,
                'message_important'=>true
            ]);
        }


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

        $office_hour = (strtotime($office_out_time) - strtotime($office_in_time)) / 60;
        $total = $office_hour - $late - $early_leave;


        $attendance = Attendance::find($cmd);

        if ($attendance) {
            $attendance->clock_in = $clock_in;
            $attendance->clock_out = $clock_out;
            $attendance->late = $late;
            $attendance->early_leaving = $early_leave;
            $attendance->total = $total;
            $attendance->status = 'Present';
            $attendance->save();

            return redirect('attendance/report')->with([
                'message' => language_data('Attendance Update Successfully')
            ]);

        } else {
            return redirect('attendance/report')->with([
                'message' => language_data('Attendance Info Not Found'),
                'message_important' => true
            ]);
        }


    }

    /* deleteAttendance  Function Start Here */
    public function deleteAttendance($id)
    {
        $appStage=app_config('AppStage');
        if($appStage=='Demo'){
            return redirect('attendance/report')->with([
                'message'=>language_data('This Option is Disable In Demo Mode'),
                'message_important'=>true
            ]);
        }

        $self='attendance-report';

        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message'=>language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $attendance=Attendance::find($id);
        if($attendance){
            $attendance->delete();
            return redirect('attendance/report')->with([
                'message' => language_data('Attendance Deleted Successfully')
            ]);
        }else{
            return redirect('attendance/report')->with([
                'message' => language_data('Attendance Info Not Found'),
                'message_important' => true
            ]);
        }
    }


}
