<div class="modal fade modal_set_job_applicant_status_{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{language_data('Change Status')}}</h4>
            </div>
            <form class="form-some-up form-block" role="form" action="{{url('jobs/set-applicant-status')}}" method="post">

                <div class="modal-body">

                    <div class="form-group">
                        <label>{{language_data('Status')}} : </label>
                        <select class="selectpicker form-control" data-live-search="true" name="status">
                            <option value="Unread" @if($d->status=='Unread') selected @endif >{{language_data('Unread')}}</option>
                            <option value="Primary Selected" @if($d->status=='Primary Selected') selected @endif >{{language_data('Primary Selected')}}</option>
                            <option value="Call For Interview" @if($d->status=='Call For Interview') selected @endif >{{language_data('Call For Interview')}}</option>
                            <option value="Confirm" @if($d->status=='Confirm') selected @endif >{{language_data('Confirm')}}</option>
                            <option value="Rejected" @if($d->status=='Rejected') selected @endif >{{language_data('Rejected')}}</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="cmd" value="{{$d->id}}">
                    <input type="hidden" name="job_id" value="{{$d->job_id}}">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{language_data('Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{language_data('Update')}}</button>
                </div>

            </form>
        </div>
    </div>

</div>

