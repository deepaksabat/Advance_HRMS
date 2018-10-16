<?php

namespace App\Http\Controllers;

use App\Classes\permission;
use App\Employee;
use App\Leave;
use App\LeaveType;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
date_default_timezone_set(app_config('Timezone'));
class LeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /* leave  Function Start Here */
    public function leave()
    {
        $self='leave-application';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $employee=Employee::where('status','active')->where('user_name','!=','admin')->get();
        $leave_type=LeaveType::all();
        $leave=Leave::all();
        return view('admin.leave',compact('leave','leave_type','employee'));
    }

    /* viewLeave  Function Start Here */
    public function viewLeave($id)
    {
        $self='leave-application';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $leave=Leave::find($id);

        return view('admin.view-leave-application',compact('leave'));

    }



    //======================================================================
    // postNewLeave Function Start Here
    //======================================================================
    public function postNewLeave(Request $request){
        $v=\Validator::make($request->all(),[
            'employee'=>'required','leave_type'=>'required','leave_from'=>'required','leave_to' => 'required','status'=>'required'
        ]);


        if ($v->fails()) {
            return redirect('leave')->withErrors($v->errors());
        }

        $leave_from=date('Y-m-d',strtotime($request->leave_from));
        $leave_to=date('Y-m-d',strtotime($request->leave_to));


        $leave = new Leave();
        $leave->emp_id = $request->employee;
        $leave->leave_from = $leave_from;
        $leave->leave_to = $leave_to;
        $leave->ltype_id = $request->leave_type;
        $leave->applied_on = date('Y-m-d');
        $leave->leave_reason = $request->leave_reason;
        $leave->status = $request->status;
        $leave->save();

        return redirect('leave')->with([
            'message' => language_data('Leave added Successfully')
        ]);

    }


    /* postJobStatus  Function Start Here */
    public function postJobStatus(Request $request)
    {
        $self='leave-application';
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
            'status'=>'required'
        ]);

        if($v->fails()){
            return redirect('leave/edit/'.$cmd)->withErrors($v->errors());
        }

        $leave=Leave::find($cmd);
        if($leave){
            $leave->status=$request->status;
            $leave->remark=$request->remark;
            $leave->save();

            return redirect('leave')->with([
                'message'=>language_data('Status updated successfully')
            ]);
        }else{
            return redirect('leave')->with([
                'message'=> language_data('Leave Application not found'),
                'message_important'=>true
            ]);
        }
    }

    /* deleteLeaveApplication  Function Start Here */
    public function deleteLeaveApplication($id)
    {
        $appStage=app_config('AppStage');
        if($appStage=='Demo'){
            return redirect('leave')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important'=>true
            ]);
        }

        $self='leave-application';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $leave=Leave::find($id);
        if($leave){
            $leave->delete();
            return redirect('leave')->with([
                'message'=> language_data('Leave Application Deleted Successfully')
            ]);
        }else{
            return redirect('leave')->with([
                'message'=>'Leave Application not found',
                'message_important'=>true
            ]);
        }
    }


}
