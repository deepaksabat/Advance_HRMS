<div class="modal fade modal_edit_expense_type_{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{language_data('Edit')}} {{language_data('Expense Title')}}</h4>
            </div>
            <form class="form-some-up form-block" role="form" action="{{url('settings/update-expense-title')}}" method="post">

                <div class="modal-body">

                    <div class="form-group">
                        <label>{{language_data('Expense Title')}} :</label>
                        <input type="text" class="form-control" required="" name="expense" value="{{$d->expense}}">
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

