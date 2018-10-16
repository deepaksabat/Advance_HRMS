<div class="modal fade modal_edit_training_evaluations_{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{language_data('Edit')}} {{language_data('Training Evaluations')}}</h4>
            </div>
            <form class="form-some-up form-block" role="form" action="{{url('training/update-training-evaluations')}}" method="post">

                <div class="modal-body">

                    <div class="form-group">
                        <label>{{language_data('Training')}} {{language_data('Title')}}: </label>
                        <select class="selectpicker form-control" data-live-search="true" name="training_title">
                            @foreach($training as $t)
                                <option value="{{$t->id}}" @if($d->training_id==$t->id) selected @endif >{{$t->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <br>

                    <div class="form-group">
                        <label>{{language_data('Training Evaluations')}} {{language_data('Description')}} :</label>
                        <textarea rows="5" class="textarea-wysihtml5 form-control" name="description">{{$d->description}}</textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="cmd" value="{{$d->id}}">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{language_data('Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{language_data('Update')}}</button>
                </div>

            </form>
        </div>
    </div>

</div>

