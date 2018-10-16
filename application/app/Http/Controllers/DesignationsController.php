<?php

namespace App\Http\Controllers;

use App\Classes\permission;
use App\Department;
use App\Designation;
use App\Employee;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

date_default_timezone_set(app_config('Timezone'));

class DesignationsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /* designations  Function Start Here */
    public function designations()
    {
        $self='designations';

        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $departments = Department::all();
        $designations = Designation::all();
        return view('admin.designations', compact('departments', 'designations'));
    }

    /* addDesignation  Function Start Here */
    public function addDesignation(Request $request)
    {
        $self='designations';

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
            'designation' => 'required', 'department' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('designations')->withErrors($v->errors());
        }

        $designations = Designation::firstOrCreate(['did' => $request->department, 'designation' => $request->designation]);

        if ($designations->wasRecentlyCreated) {
            return redirect('designations')->with([
                'message' => language_data('Designation Added Successfully')
            ]);

        } else {
            return redirect('designations')->with([
                'message' => language_data('Designation Already Exist'),
                'message_important' => true
            ]);
        }

    }

    /* deleteDesignation  Function Start Here */
    public function deleteDesignation($id)
    {

        $appStage = app_config('AppStage');
        if ($appStage == 'Demo') {
            return redirect('designations')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important' => true
            ]);
        }


        $self='designations';

        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $exist_check=Employee::where('designation',$id)->where('user_name','!=','admin')->first();

        if ($exist_check){
            return redirect('designations')->with([
                'message'=>language_data('Employee added on this designation. To remove; unassigned employee'),
                'message_important'=>true
            ]);
        }

        $designation = Designation::find($id);
        if ($designation) {
            $designation->delete();

            return redirect('designations')->with([
                'message' => language_data('Designation Deleted Successfully'),
            ]);
        } else {
            return redirect('designations')->with([
                'message' => language_data('Designation Not Found'),
                'message_important' => true
            ]);
        }
    }

    /* updateDesignation  Function Start Here */
    public function updateDesignation(Request $request)
    {
        $appStage = app_config('AppStage');
        if ($appStage == 'Demo') {
            return redirect('designations')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important' => true
            ]);
        }


        $self='designations';

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
            'designation' => 'required', 'department' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('designations')->withErrors($v->errors());
        }

        $designation = trim(Input::get('designation'));
        $department = Input::get('department');

        $des = Designation::find($cmd);

        $exist = Designation::where('did', $department)->where('designation', $designation)->first();

        if ($designation != $des->designation AND $department != $des->did) {

            if ($exist) {
                return redirect('designations')->with([
                    'message' => language_data('Designation Already Exist'),
                    'message_important' => true
                ]);
            }
        }

        $des->did = $department;
        $des->designation = $designation;
        $des->save();

        return redirect('designations')->with([
            'message' => language_data('Designation Update Successfully')
        ]);

    }


}
