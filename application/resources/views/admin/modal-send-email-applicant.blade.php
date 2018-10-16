<div class="modal fade modal_send_email_{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{language_data('Send SMS')}}</h4>
            </div>
            <form class="form-some-up form-block" role="form" action="{{url('reports/send-email-to-applicants')}}" method="post">

                <div class="modal-body">

                    <div class="form-group">
                        <label>{{language_data('Email')}} :</label>
                        <input type="text" readonly class="form-control" required="" name="email" value="{{$d->email}}">
                    </div>
                    <br>
                    <div class="form-group">
                        <label>{{language_data('Subject')}} :</label>
                        <input type="text" class="form-control" required="" name="subject">
                    </div>
                    <br>
                    <div class="form-group">
                        <label>{{language_data('Description')}}</label>
                        <textarea class="textarea-wysihtml5 form-control" name="message"></textarea>
                    </div>


                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="cmd" value="{{$d->id}}">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{language_data('Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{language_data('Send')}}</button>
                </div>

            </form>
        </div>
    </div>

</div>

