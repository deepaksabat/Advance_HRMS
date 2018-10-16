<div class="modal fade modal_edit_employee_roles_{{$er->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{language_data('Edit')}} {{language_data('Employee Roles')}}</h4>
            </div>
            <form class="form-some-up form-block" role="form" action="{{url('employees/update-role')}}" method="post">

                <div class="modal-body">

                    <div class="form-group">
                        <label>{{language_data('Role Name')}} :</label>
                        <input type="text" class="form-control" required="" name="role_name" value="{{$er->role_name}}">
                    </div>

                    <br>
                    <br>
                    <div class="form-group">
                        <label>{{language_data('Status')}} : </label>
                        <select class="selectpicker form-control" name="status">
                            <option value="Active" @if($er->status=='Active') selected @endif >{{language_data('Active')}}</option>
                            <option value="Inactive" @if($er->status=='Inactive') selected @endif >{{language_data('Inactive')}}</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="cmd" value="{{$er->id}}">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{language_data('Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{language_data('Update')}}</button>
                </div>

            </form>
        </div>
    </div>

</div>

