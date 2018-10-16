<?php

namespace App\Http\Controllers;

use App\Classes\permission;
use App\Employee;
use App\Task;
use App\TaskComments;
use App\TaskEmployee;
use App\TaskFiles;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
date_default_timezone_set(app_config('Timezone'));
class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /* task  Function Start Here */
    public function task()
    {

        $self='task';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $task = Task::all();
        $employee = Employee::all();
        return view('admin.tasks', compact('task', 'employee'));
    }

    /* postNewTask  Function Start Here */
    public function postNewTask(Request $request)
    {
        $self='add-new-task';
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
            'task_title' => 'required', 'status' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('task')->withErrors($v->errors());
        }

        $employee = Input::get('employee');
        if (count($employee) == 0) {
            return redirect('task')->with([
                'message' => language_data('Employee not assigned'),
                'message_important' => true
            ]);
        }

        $start_date=date('Y-m-d',strtotime($request->start_date));
        $due_date=date('Y-m-d',strtotime($request->due_date));

        $task = new Task();
        $task->task = $request->task_title;
        $task->start_date = $start_date;
        $task->due_date = $due_date;
        $task->estimated_hour = $request->estimated_hour;
        $task->progress = $request->progress;
        $task->status = $request->status;
        $task->description = $request->description;
        $task->save();

        $task_id = $task->id;

        foreach ($employee as $e) {
            $emp = Employee::find($e);

            $assign = new TaskEmployee();
            $assign->task_id = $task_id;
            $assign->emp_id = $e;
            $assign->emp_name = $emp->fname . ' ' . $emp->lname;
            $assign->save();
        }

        return redirect('task')->with([
            'message' => language_data('Task Created Successfully')
        ]);


    }

    /* editTask  Function Start Here */
    public function editTask($id)
    {
        $self='task';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $task = Task::find($id);

        if ($task) {
            $task_employee=TaskEmployee::where('task_id',$id)->get();
            $employee = Employee::all();
            return view('admin.edit-task', compact('task', 'employee','task_employee'));
        } else {
            return redirect('task')->with([
                'message' => language_data('Task not found'),
                'message_important' => true
            ]);
        }
    }

    /* postEditTask  Function Start Here */
    public function postEditTask(Request $request)
    {

        $cmd = Input::get('cmd');
        $appStage=app_config('AppStage');
        if($appStage=='Demo'){
            return redirect('task/edit/' . $cmd)->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important'=>true
            ]);
        }

        $self='task';
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
            'task_title' => 'required', 'status' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('task/edit/' . $cmd)->withErrors($v->errors());
        }

        $employee = Input::get('employee');


        $start_date=date('Y-m-d',strtotime($request->start_date));
        $due_date=date('Y-m-d',strtotime($request->due_date));

        $task = Task::find($cmd);
        $task->task = $request->task_title;
        $task->start_date = $start_date;
        $task->due_date = $due_date;
        $task->estimated_hour = $request->estimated_hour;
        $task->progress = $request->progress;
        $task->status = $request->status;
        $task->description = $request->description;
        $task->save();


        if ($employee != '') {
            TaskEmployee::where('task_id', '=', $cmd)->delete();

            foreach ($employee as $e) {
                $emp = Employee::find($e);

                $assign = new TaskEmployee();
                $assign->task_id = $cmd;
                $assign->emp_id = $e;
                $assign->emp_name = $emp->fname . ' ' . $emp->lname;
                $assign->save();
            }
        }


        return redirect('task')->with([
            'message' => language_data('Task Updated Successfully')
        ]);


    }


    /* viewTask  Function Start Here */
    public function viewTask($id)
    {
        $self='task';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $task = Task::find($id);
        $task_employee = TaskEmployee::where('task_id', $id)->get();
        $task_comment=TaskComments::where('task_id', $id)->get();
        $task_files=TaskFiles::where('task_id', $id)->get();
        return view('admin.view-task', compact('task', 'task_employee','task_comment','task_files'));
    }

    /* postBasicTaskInfo  Function Start Here */
    public function postBasicTaskInfo(Request $request)
    {
        $cmd = Input::get('cmd');
        $appStage=app_config('AppStage');
        if($appStage=='Demo'){
            return redirect('task/view/' . $cmd)->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important'=>true
            ]);
        }

        $self='task';
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
            'progress' => 'required', 'status' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('task/view/' . $cmd)->withErrors($v->errors());
        }

        $task = Task::find($cmd);

        if ($task) {
            $task->progress = $request->progress;
            $task->status = $request->status;
            $task->save();

            return redirect('task/view/' . $cmd)->with([
                'message'=> language_data('Task Updated Successfully')
            ]);
        }else{
            return redirect('task')->with([
                'message'=> language_data('Task not found'),
                'message_important'=>true
            ]);

        }

    }


    /* postTaskComments  Function Start Here */
    public function postTaskComments(Request $request)
    {
        $self='task';
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
            'comment'=>'required'
        ]);

        if($v->fails()){
            return redirect('task/view/'.$cmd)->withErrors($v->errors());
        }

        $tc=new TaskComments();
        $tc->task_id=$cmd;
        $tc->emp_id=\Auth::user()->id;
        $tc->comment=$request->comment;
        $tc->save();

        return redirect('task/view/'.$cmd)->with([
            'message'=> language_data('Comment Posted Successfully')
        ]);


    }

    /* postTaskFiles  Function Start Here */
    public function postTaskFiles(Request $request)
    {
        $self='task';
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
        $v = \Validator::make($request->all(), [
            'file_title' => 'required', 'file' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('task/view/'.$cmd)->withErrors($v->errors());
        }

        $file_title = Input::get('file_title');
        $file = Input::file('file');

        if ($file != '') {
            $destinationPath = public_path() . '/assets/task_file/';
            $file_name = $file->getClientOriginalName();
            $file_size=$file->getSize();
            Input::file('file')->move($destinationPath, $file_name);

            $tf=new TaskFiles();
            $tf->task_id=$cmd;
            $tf->emp_id=\Auth::user()->id;
            $tf->file_title=$file_title;
            $tf->file_size=$file_size;
            $tf->file=$file_name;
            $tf->save();

            return redirect('task/view/'.$cmd)->with([
                'message'=> language_data('File Uploaded Successfully')
            ]);

        } else {
            return redirect('task/view/'.$cmd)->with([
                'message'=> language_data('Please Upload a File'),
                'message_important'=>true
            ]);
        }

    }

    /* downloadTaskFIle  Function Start Here */
    public function downloadTaskFIle($id)
    {
        $self='task';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $task_file=TaskFiles::find($id)->file;
        return response()->download(public_path('assets/task_file/' . $task_file));
    }

    /* deleteTaskFIle  Function Start Here */
    public function deleteTaskFIle($id)
    {
        $self='task';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $task_file=TaskFiles::find($id);

        if ($task_file) {
            $task_id=$task_file->task_id;
            $file = $task_file->file;
            \File::delete(public_path('assets/task_file/' . $file));
            $task_file->delete();

            return redirect('task/view/'.$task_id)->with([
                'message' => language_data('File Deleted Successfully')
            ]);
        } else {
            return redirect('task')->with([
                'message' => language_data('Task File not found'),
                'message_important' => true
            ]);
        }


    }

    /* deleteTask  Function Start Here */
    public function deleteTask($id)
    {
        $appStage=app_config('AppStage');
        if($appStage=='Demo'){
            return redirect('task')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important'=>true
            ]);
        }

        $self='task';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $task=Task::find($id);
        if ($task) {
            TaskEmployee::where('task_id',$id)->delete();
            TaskComments::where('task_id',$id)->delete();
            $task_file=TaskFiles::where('task_id',$id)->get();

            foreach($task_file as $tf){
                $file = $tf->file;
                \File::delete(public_path('assets/task_file/' . $file));
                $tf->delete();
            }

            $task->delete();

            return redirect('task')->with([
                'message' => language_data('Task Deleted Successfully')
            ]);
        } else {
            return redirect('task')->with([
                'message' => language_data('Task not found'),
                'message_important' => true
            ]);
        }
    }


}
