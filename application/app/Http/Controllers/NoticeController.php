<?php

namespace App\Http\Controllers;

use App\Classes\permission;
use App\Notice;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
date_default_timezone_set(app_config('Timezone'));
class NoticeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /* noticeBoard  Function Start Here */
    public function noticeBoard()
    {
        $self='notice-board';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $notice=Notice::all();
        return view('admin.notice-board',compact('notice'));
    }

    /* postNewNotice  Function Start Here */
    public function postNewNotice(Request $request)
    {
        $self='add-new-notice';
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
            'notice_title'=>'required','status'=>'required'
        ]);

        if($v->fails()){
            return redirect('notice-board')->withErrors($v->errors());
        }

        $notice=new Notice();
        $notice->title=$request->notice_title;
        $notice->status=$request->status;
        $notice->description=$request->description;
        $notice->save();

        return redirect('notice-board')->with([
            'message'=> language_data('Notice Added Successfully')
        ]);

    }

    /* deleteNotice  Function Start Here */
    public function deleteNotice($id)
    {

        $appStage=app_config('AppStage');
        if($appStage=='Demo'){
            return redirect('notice-board')->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important'=>true
            ]);
        }

        $self='notice-board';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $notice=Notice::find($id);
        if($notice){
            $notice->delete();
            return redirect('notice-board')->with([
                'message'=> language_data('Notice Deleted Successfully')
            ]);
        }else{
            return redirect('notice-board')->with([
                'message'=> language_data('Notice not found'),
                'message_important'=>true
            ]);
        }
    }

    /* editNotice  Function Start Here */
    public function editNotice($id)
    {
        $self='notice-board';
        if (\Auth::user()->user_name!=='admin'){
            $get_perm=permission::permitted($self);

            if ($get_perm=='access denied'){
                return redirect('permission-error')->with([
                    'message' => language_data('You do not have permission to view this page'),
                    'message_important'=>true
                ]);
            }
        }

        $notice=Notice::find($id);
        if($notice){
            return view('admin.edit-notice',compact('notice'));
        }else{
            return redirect('notice-board')->with([
                'message'=> language_data('Notice not found'),
                'message_important'=>true
            ]);
        }
    }

    /* postEditNotice  Function Start Here */
    public function postEditNotice(Request $request)
    {
        $self='notice-board';
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

        $appStage=app_config('AppStage');
        if($appStage=='Demo'){
            return redirect('notice-board/edit/'.$cmd)->with([
                'message' => language_data('This Option is Disable In Demo Mode'),
                'message_important'=>true
            ]);
        }


        $v=\Validator::make($request->all(),[
            'notice_title'=>'required','status'=>'required'
        ]);

        if($v->fails()){
            return redirect('notice-board/edit/'.$cmd)->withErrors($v->errors());
        }

        $notice=Notice::find($cmd);
        if($notice){
            $notice->title=$request->notice_title;
            $notice->status=$request->status;
            $notice->description=$request->description;
            $notice->save();

            return redirect('notice-board')->with([
                'message'=> language_data('Notice Updated Successfully')
            ]);
        }else{
            return redirect('notice-board')->with([
                'message'=> language_data('Notice not found'),
                'message_important'=>true
            ]);
        }
    }


}
