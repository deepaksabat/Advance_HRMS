<?php

namespace App\Http\Controllers;

use App\Classes\permission;
use App\Designation;
use App\Http\Requests;
use App\JobApplicants;
use App\Jobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
date_default_timezone_set(app_config('Timezone'));
class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /* jobs  Function Start Here */
    public function jobs()
    {

        $self='job-application';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $jobs = Jobs::all();
        $designation = Designation::all();
        return view('admin.jobs', compact('jobs', 'designation'));
    }

    /* postNewJob  Function Start Here */
    public function postNewJob(Request $request)
    {
        $self='add-new-job';
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
            'position' => 'required', 'no_position' => 'required', 'post_date' => 'required', 'status' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('jobs')->withErrors($v->fails());
        }

        $position = Input::get('position');
        $no_position = Input::get('no_position');
        $post_date = Input::get('post_date');
        $post_date=date('Y-m-d',strtotime($post_date));
        $apply_date = Input::get('apply_date');
        $apply_date=date('Y-m-d',strtotime($apply_date));
        $close_date = Input::get('close_date');
        $close_date=date('Y-m-d',strtotime($close_date));
        $status = Input::get('status');
        $description = Input::get('description');
        $job_type=Input::get('job_type');
        $experience=Input::get('experience');
        $age=Input::get('age');
        $job_location=Input::get('job_location');
        $salary_range=Input::get('salary_range');
        $short_description=Input::get('short_description');

        if ($position != '') {
            $exist = Jobs::where('position', '=', $position)->first();

            if ($exist) {
                return redirect('jobs')->with([
                    'message' => language_data('This Job Post Already Exist'),
                    'message_important' => true
                ]);
            }
        }


        $jobs = new Jobs();
        $jobs->position = $position;
        $jobs->no_position = $no_position;
        $jobs->job_type = $job_type;
        $jobs->experience = $experience;
        $jobs->age = $age;
        $jobs->job_location = $job_location;
        $jobs->salary_range = $salary_range;
        $jobs->post_date = $post_date;
        $jobs->apply_date = $apply_date;
        $jobs->close_date = $close_date;
        $jobs->status = $status;
        $jobs->short_description = $short_description;
        $jobs->description = $description;
        $jobs->save();

        return redirect('jobs')->with([
            'message' => language_data('Job Added Successfully')
        ]);

    }


    /* editJob  Function Start Here */
    public function editJob($id)
    {
        $self='job-application';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $job = Jobs::find($id);
        if ($job) {
            $designation = Designation::all();
            return view('admin.edit-job', compact('job', 'designation'));
        } else {
            return redirect('jobs')->with([
                'message' => language_data('Job not found'),
                'message_important' => true
            ]);
        }
    }


    /* postEditJob  Function Start Here */
    public function postEditJob(Request $request)
    {

        $cmd = Input::get('cmd');

        $appStage=app_config('AppStage');
        if($appStage=='Demo'){
            return redirect('jobs/edit/'.$cmd)->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important'=>true
            ]);
        }

        $self='job-application';
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
            'position' => 'required', 'no_position' => 'required', 'post_date' => 'required', 'status' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('jobs/edit/' . $cmd)->withErrors($v->fails());
        }

        $position = Input::get('position');
        $no_position = Input::get('no_position');
        $post_date = Input::get('post_date');
        $post_date=date('Y-m-d',strtotime($post_date));
        $apply_date = Input::get('apply_date');
        $apply_date=date('Y-m-d',strtotime($apply_date));
        $close_date = Input::get('close_date');
        $close_date=date('Y-m-d',strtotime($close_date));
        $status = Input::get('status');
        $description = Input::get('description');
        $job_type=Input::get('job_type');
        $experience=Input::get('experience');
        $age=Input::get('age');
        $job_location=Input::get('job_location');
        $salary_range=Input::get('salary_range');
        $short_description=Input::get('short_description');

        $jobs = Jobs::find($cmd);
        $exist_pos = $jobs->position;

        if ($position != '') {
            if ($position != $exist_pos) {
                $exist = Jobs::where('position', '=', $position)->first();
                if ($exist) {
                    return redirect('jobs/edit/' . $cmd)->with([
                        'message' => language_data('This Job Post Already Exist'),
                        'message_important' => true
                    ]);
                }
            }
        }


        $jobs->position = $position;
        $jobs->no_position = $no_position;
        $jobs->job_type = $job_type;
        $jobs->experience = $experience;
        $jobs->age = $age;
        $jobs->job_location = $job_location;
        $jobs->salary_range = $salary_range;
        $jobs->short_description = $short_description;
        $jobs->post_date = $post_date;
        $jobs->apply_date = $apply_date;
        $jobs->close_date = $close_date;
        $jobs->status = $status;
        $jobs->description = $description;
        $jobs->save();

        return redirect('jobs')->with([
            'message' => language_data('Job Update Successfully')
        ]);

    }

    /* deleteJob  Function Start Here */
    public function deleteJob($id)
    {
        $appStage=app_config('AppStage');
        if($appStage=='Demo'){
            return redirect('jobs')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important'=>true
            ]);
        }

        $self='job-application';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $job = Jobs::find($id);
        if ($job) {
            JobApplicants::where('job_id','=',$id)->delete();
            $job->delete();
            return redirect('jobs')->with([
                'message' => language_data('Job Deleted Successfully')
            ]);
        } else {
            return redirect('jobs')->with([
                'message' => language_data('Job not found'),
                'message_important' => true
            ]);
        }
    }

    /* viewApplicant  Function Start Here */
    public function viewApplicant($id)
    {
        $self='job-applicants';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $applicants = JobApplicants::where('job_id', '=', $id)->get();
        return view('admin.view-application', compact('applicants'));
    }

    /* downloadResume  Function Start Here */
    public function downloadResume($id)
    {
        $self='job-applicants';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $file = JobApplicants::find($id)->resume;
        return response()->download(storage_path('app/resume/' . $file));
    }

    /* deleteApplication  Function Start Here */
    public function deleteApplication($id)
    {
        $appStage=app_config('AppStage');
        if($appStage=='Demo'){
            return redirect('jobs')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important'=>true
            ]);
        }

        $self='job-applicants';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $delete_app = JobApplicants::find($id);
        if ($delete_app) {
            $job_id = $delete_app->job_id;
            $delete_app->delete();

            return redirect('jobs/view-applicant/' . $job_id)->with([
                'message' => language_data('Applicant Deleted Successfully')
            ]);
        } else {
            return redirect('jobs')->with([
                'message' => language_data('Applicant not found'),
                'message_important' => true
            ]);
        }
    }

    /* setApplicantStatus  Function Start Here */
    public function setApplicantStatus(Request $request)
    {
        $self='job-applicants';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $job_id=Input::get('job_id');
        $cmd=Input::get('cmd');
        $v=\Validator::make($request->all(),[
            'status'=>'required'
        ]);

        if($v->fails()){
            return redirect('jobs/view-applicant/'.$job_id)->withErrors($v->fails());
        }

        $job_applicant=JobApplicants::find($cmd);
        if($job_applicant){
            $job_applicant->status=$request->status;
            $job_applicant->save();

            return redirect('jobs/view-applicant/'.$job_id)->with([
                'message'=> language_data('Status updated successfully'),
            ]);

        }else{
            return redirect('jobs/view-applicant/'.$job_id)->with([
                'message'=> language_data('Applicant not found'),
                'message_important'=>true
            ]);
        }

    }


}
