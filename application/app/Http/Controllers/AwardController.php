<?php

namespace App\Http\Controllers;

use App\Award;
use App\AwardList;
use App\Classes\permission;
use App\Employee;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
date_default_timezone_set(app_config('Timezone'));
class AwardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /* award  Function Start Here */
    public function award()
    {

        $self='award-list';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message'=>language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $award = AwardList::all();
        $employee = Employee::where('user_name', '!=', 'admin')->get();
        $award_name = Award::all();
        return view('admin.award', compact('award', 'employee', 'award_name'));
    }

    /* postNewAward  Function Start Here */
    public function postNewAward(Request $request)
    {
        $self='add-new-award';

        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message'=>language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $v = \Validator::make($request->all(), [
            'award_name' => 'required', 'emp_name' => 'required', 'gift_item' => 'required', 'month' => 'required', 'year' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('award')->withErrors($v->errors());
        }

        $award_name = Input::get('award_name');
        $employee_code = Input::get('emp_name');
        $gift_item = Input::get('gift_item');
        $cash_price = Input::get('cash_price');
        $month = Input::get('month');
        $year = Input::get('year');

        $award = new AwardList();
        $award->emp_id = $employee_code;
        $award->award = $award_name;
        $award->gift = $gift_item;
        $award->cash = $cash_price;
        $award->month = $month;
        $award->year = $year;
        $award->save();

        return redirect('award')->with([
            'message' => language_data('Award Added Successfully')
        ]);

    }

    /* deleteAward  Function Start Here */
    public function deleteAward($id)
    {
        $appStage=app_config('AppStage');
        if($appStage=='Demo'){
            return redirect('award')->with([
                'message'=>language_data('This Option is Disable In Demo Mode'),
                'message_important'=>true
            ]);
        }

        $self='award-list';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message'=>language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $award = AwardList::find($id);

        if ($award) {
            $award->delete();

            return redirect('award')->with([
                'message' => language_data('Award Deleted Successfully')
            ]);
        } else {

            return redirect('award')->with([
                'message' => language_data('Award Not Found'),
                'message_important' => true
            ]);
        }
    }

    /* editAward  Function Start Here */
    public function editAward($id)
    {
        $self='award-list';

        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message'=>language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }


        $award=AwardList::find($id);

        if ($award) {
            $employee = Employee::where('user_name', '!=', 'admin')->get();
            $award_name = Award::all();

            return view('admin.award-edit',compact('award','employee','award_name'));
        } else {
            return redirect('award')->with([
                'message' => language_data('Award Not Found'),
                'message_important' => true
            ]);
        }
    }

    /* postEditAward  Function Start Here */
    public function postEditAward(Request $request)
    {
        $cmd=Input::get('cmd');

        $appStage=app_config('AppStage');
        if($appStage=='Demo'){
            return redirect('award/edit/'.$cmd)->with([
                'message'=>language_data('This Option is Disable In Demo Mode'),
                'message_important'=>true
            ]);
        }

        $self='award-list';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message'=>language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }



        $v = \Validator::make($request->all(), [
            'award_name' => 'required', 'emp_name' => 'required', 'gift_item' => 'required', 'month' => 'required', 'year' => 'required'
        ]);

        if ($v->fails()) {
            return redirect('award/edit/'.$cmd)->withErrors($v->errors());
        }

        $award_name = Input::get('award_name');
        $emp_name = Input::get('emp_name');
        $gift_item = Input::get('gift_item');
        $cash_price = Input::get('cash_price');
        $month = Input::get('month');
        $year = Input::get('year');

        $award = AwardList::find($cmd);
        if($award){
            $award->emp_id = $emp_name;
            $award->award = $award_name;
            $award->gift = $gift_item;
            $award->cash = $cash_price;
            $award->month = $month;
            $award->year = $year;
            $award->save();

            return redirect('award')->with([
                'message' => language_data('Award Updated Successfully')
            ]);

        } else {
            return redirect('award')->with([
                'message' => language_data('Award Not Found'),
                'message_important' => true
            ]);
        }

    }


}


