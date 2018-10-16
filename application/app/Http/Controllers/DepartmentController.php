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

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /* departments  Function Start Here */
    public function departments()
    {
        $self = 'departments';

        if (\Auth::user()->user_name !== 'admin') {
            $get_perm = permission::permitted($self);

            if ($get_perm == 'access denied') {
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important' => true
                ]);
            }
        }


        $departments = Department::all();
        return view('admin.departments', compact('departments'));

    }

    /* addDepartment  Function Start Here */
    public function addDepartment(Request $request)
    {

        $self = 'departments';

        if (\Auth::user()->user_name !== 'admin') {
            $get_perm = permission::permitted($self);

            if ($get_perm == 'access denied') {
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important' => true
                ]);
            }
        }

        $v = \Validator::make($request->all(), [
            'department' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('departments')->withErrors($v->errors());
        }

        $department = Department::firstOrCreate(['department' => $request->department]);

        if ($department->wasRecentlyCreated) {
            return redirect('departments')->with([
                'message' => language_data('Department Added Successfully')
            ]);

        } else {
            return redirect('departments')->with([
                'message' => language_data('Department Already Exist'),
                'message_important' => true
            ]);
        }


    }


    /* updateDepartment  Function Start Here */
    public function updateDepartment(Request $request)
    {
        $appStage = app_config('AppStage');
        if ($appStage == 'Demo') {
            return redirect('departments')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important' => true
            ]);
        }


        $self = 'departments';
        if (\Auth::user()->user_name !== 'admin') {
            $get_perm = permission::permitted($self);

            if ($get_perm == 'access denied') {
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important' => true
                ]);
            }
        }

        $cmd = Input::get('cmd');
        $v = \Validator::make($request->all(), [
            'department' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('departments')->withErrors($v->errors());
        }
        $department = Department::find($cmd);
        $department_name = Input::get('department');

        if ($department_name != $department->department) {

            $exist = Department::where('department', $department_name)->first();
            if ($exist) {
                return redirect('departments')->with([
                    'message' => language_data('Department Already Exist'),
                    'message_important' => true
                ]);
            }
        }


        if ($department) {
            $department->department = $department_name;
            $department->save();

            return redirect('departments')->with([
                'message' => language_data('Department Updated Successfully')
            ]);

        } else {
            return redirect('departments')->with([
                'message' => language_data('Department Not Found'),
                'message_important' => true
            ]);
        }
    }


    /* deleteDepartment  Function Start Here */
    public function deleteDepartment($id)
    {

        $appStage = app_config('AppStage');
        if ($appStage == 'Demo') {
            return redirect('departments')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important' => true
            ]);
        }

        $self = 'departments';
        if (\Auth::user()->user_name !== 'admin') {
            $get_perm = permission::permitted($self);

            if ($get_perm == 'access denied') {
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important' => true
                ]);
            }
        }

        $exist_check = Employee::where('department', $id)->where('user_name','!=','admin')->first();

        if ($exist_check) {
            return redirect('departments')->with([
                'message' => language_data('Employee added on this department. To remove; unassigned employee'),
                'message_important' => true
            ]);
        }

        $department = Department::find($id);
        if ($department) {

            Designation::where('did', $id)->delete();
            $department->delete();

            return redirect('departments')->with([
                'message' => language_data('Department Deleted Successfully')
            ]);
        } else {
            return redirect('departments')->with([
                'message' => language_data('Department Not Found'),
                'message_important' => true
            ]);
        }

    }


}
