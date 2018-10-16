<div class="modal fade modal_edit_tax_rules_{{$tx->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{language_data('Edit')}} {{language_data('Tax Rules')}}</h4>
            </div>
            <form class="form-some-up form-block" role="form" action="{{url('tax-rules/post-update-tax-rules')}}" method="post">

                <div class="modal-body">

                    <div class="form-group">
                        <label>{{language_data('Tax Rule Name')}} :</label>
                        <input type="text" class="form-control" required="" name="tax_rule_name" value="{{$tx->tax_name}}">
                    </div>

                    <br>
                    <br>
                    <div class="form-group">
                        <label>{{language_data('Status')}} : </label>
                        <select class="selectpicker form-control" data-live-search="true" name="status">
                            <option value="active" @if($tx->status=='active') selected @endif>{{language_data('Active')}}</option>
                            <option value="inactive"  @if($tx->status=='inactive') selected @endif>{{language_data('Inactive')}}</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="cmd" value="{{$tx->id}}">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{language_data('Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{language_data('Update')}}</button>
                </div>

            </form>
        </div>
    </div>

</div>

