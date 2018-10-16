@extends('master')

@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{$emp_roles->role_name}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-body">
                            <form class="" role="form" action="{{url('employees/update-employee-set-roles')}}" method="post">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> {{language_data('Set Roles')}}</h3>
                                </div>


                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox" @if(permission($emp_roles->id,1)) checked @endif name="perms[]" value="1">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Dashboard')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,2)) checked @endif name="perms[]" value="2">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Departments')}}</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,3)) checked @endif name="perms[]" value="3">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Designations')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,4)) checked @endif name="perms[]" value="4">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Employees')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,5)) checked @endif name="perms[]" value="5">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Add Employee')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,6)) checked @endif name="perms[]" value="6">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Update')}} {{language_data('Employee')}}</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,7)) checked @endif name="perms[]" value="7">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Delete')}} {{language_data('Employee')}}</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,8)) checked @endif name="perms[]" value="8">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Employee Roles')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,9)) checked @endif name="perms[]" value="9">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Add')}} {{language_data('Employee Roles')}}</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,10)) checked @endif name="perms[]" value="10">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Delete')}} {{language_data('Employee Roles')}}</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,11)) checked @endif name="perms[]" value="11">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Job Application')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,12)) checked @endif name="perms[]" value="12">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Add New Job')}}</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,13)) checked @endif name="perms[]" value="13">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Job Applicants')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,14)) checked @endif name="perms[]" value="14">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Attendance Report')}}</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,15)) checked @endif name="perms[]" value="15">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Update Attendance')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,16)) checked @endif name="perms[]" value="16">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Leave Application')}}</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,17)) checked @endif name="perms[]" value="17">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Holiday')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,18)) checked @endif name="perms[]" value="18">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Add New Holiday')}}</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,19)) checked @endif name="perms[]" value="19">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Award List')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,20)) checked @endif name="perms[]" value="20">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Add New Award')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,21)) checked @endif name="perms[]" value="21">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Notice Board')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,22)) checked @endif name="perms[]" value="22">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Add New Notice')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,23)) checked @endif name="perms[]" value="23">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Expense')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,24)) checked @endif name="perms[]" value="24">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Add New Expense')}}</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,25)) checked @endif name="perms[]" value="25">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Employee Salary List')}}</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,26)) checked @endif name="perms[]" value="26">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Employee Salary Increment')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,27)) checked @endif name="perms[]" value="27">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Make Payment')}}</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,28)) checked @endif name="perms[]" value="28">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Generate Payslip')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,29)) checked @endif name="perms[]" value="29">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Provident Fund')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,30)) checked @endif name="perms[]" value="30">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Loan')}}</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,31)) checked @endif name="perms[]" value="31">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Employee Training')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,32)) checked @endif name="perms[]" value="32">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Add')}} {{language_data('Employee Training')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,33)) checked @endif name="perms[]" value="33">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Training Needs Assessment')}}</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,34)) checked @endif name="perms[]" value="34">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Add')}} {{language_data('Training Needs Assessment')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,35)) checked @endif name="perms[]" value="35">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Training Events')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,36)) checked @endif name="perms[]" value="36">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Add')}} {{language_data('Training Events')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,37)) checked @endif name="perms[]" value="37">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Trainers')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,38)) checked @endif name="perms[]" value="38">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Add New Trainer')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,39)) checked @endif name="perms[]" value="39">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Training Evaluations')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,40)) checked @endif name="perms[]" value="40">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Task')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,41)) checked @endif name="perms[]" value="41">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Add New Task')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,42)) checked @endif name="perms[]" value="42">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Support Tickets')}}</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,43)) checked @endif name="perms[]" value="43">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Create New Ticket')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,44)) checked @endif name="perms[]" value="44">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Manage Support Ticket')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,45)) checked @endif name="perms[]" value="45">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Support Department')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,46)) checked @endif name="perms[]" value="46">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Add')}} {{language_data('Support Department')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,47)) checked @endif name="perms[]" value="47">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Employee Payroll Summery')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,48)) checked @endif name="perms[]" value="48">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('System Settings')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,49)) checked @endif name="perms[]" value="49">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Localization')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,50)) checked @endif name="perms[]" value="50">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Email Templates')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,51)) checked @endif name="perms[]" value="51">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Tax Rules')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,52)) checked @endif name="perms[]" value="52">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Add Tax Rule')}}</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,53)) checked @endif name="perms[]" value="53">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Language')}}</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,54)) checked @endif name="perms[]" value="54">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Add')}} {{language_data('Language')}}</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="coder-checkbox">
                                        <input type="checkbox"  @if(permission($emp_roles->id,55)) checked @endif name="perms[]" value="55">
                                        <span class="co-check-ui"></span>
                                        <label>{{language_data('Sms Gateways')}}</label>
                                    </div>
                                </div>



                                <input type="hidden" value="{{$emp_roles->id}}" name="role_id">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-save"></i> {{language_data('Update')}} </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection

{{--External Style Section--}}
@section('script')
    {!! Html::script("assets/libs/handlebars/handlebars.runtime.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
@endsection
