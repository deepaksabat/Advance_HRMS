@extends('master')


{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.css") !!}
    {!! Html::style("assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") !!}
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
@endsection



@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('View Profile')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')
            <div class="row">

                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-body p-t-20">
                            <div class="clearfix">
                                <div class="pull-left m-r-30">
                                    <div class="thumbnail m-b-none">

                                        @if($employee->avatar!='')
                                            <img src="<?php echo asset('assets/employee_pic/'.$employee->avatar); ?>" alt="Profile Page" width="200px" height="200px">
                                        @else
                                            <img src="<?php echo asset('assets/employee_pic/user.png');?>" alt="Profile Page" width="200px" height="200px">
                                        @endif
                                    </div>
                                </div>
                                <div class="pull-left">
                                    <h3 class="bold font-color-1">{{$employee->fname}} {{$employee->lname}}</h3>
                                    <ul class="info-list">
                                        @if($employee->email!='')
                                        <li><span class="info-list-title">{{language_data('Email')}}</span><span class="info-list-des">{{$employee->email}}</span></li>
                                        @endif

                                        @if($employee->phone!='')
                                            <li><span class="info-list-title">{{language_data('Phone')}}</span><span class="info-list-des">{{$employee->phone}}</span></li>
                                        @endif

                                        @if($employee->user_name!='')
                                            <li><span class="info-list-title">{{language_data('Username')}}</span><span class="info-list-des">{{$employee->user_name}}</span></li>
                                        @endif

                                        @if($employee->pre_address!='')
                                        <li><span class="info-list-title">{{language_data('Address')}}</span><span class="info-list-des">{{$employee->pre_address}}</span></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="p-30 p-t-none p-b-none">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#personal_details" aria-controls="home" role="tab" data-toggle="tab">{{language_data('Personal Details')}}</a></li>
                        <li role="presentation"><a href="#bank_information" aria-controls="profile" role="tab" data-toggle="tab">{{language_data('Bank Info')}}</a></li>
                        <li role="presentation"><a href="#document" aria-controls="messages" role="tab" data-toggle="tab">{{language_data('Document')}}</a></li>
                        <li role="presentation"><a href="#change-picture" aria-controls="settings" role="tab" data-toggle="tab">{{language_data('Change Picture')}}</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content panel p-20">


                        {{--Personal Details--}}

                        <div role="tabpanel" class="tab-pane active" id="personal_details">
                            <form role="form" method="post" action="{{url('employees/post-employee-personal-info')}}">

                                <div class="row">
                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label>{{language_data('First Name')}}</label>
                                            <input type="text" class="form-control" required="" value="{{$employee->fname}}" name="fname">
                                        </div>

                                        <div class="form-group">
                                            <label>{{language_data('Last Name')}}</label>
                                            <input type="text" class="form-control" value="{{$employee->lname}}" name="lname">
                                        </div>


                                        <div class="form-group">
                                            <label>{{language_data('Employee Code')}}</label>
                                            <span class="help">e.g. "546814" ({{language_data('Unique For every User')}})</span>
                                            <input type="text" class="form-control" required name="employee_code" value="{{$employee->employee_code}}">
                                        </div>

                                        <div class="form-group">
                                            <label>{{language_data('Username')}}</label>
                                            <span class="help">e.g. "employee" ({{language_data('Unique For every User')}})</span>
                                            <input type="text" class="form-control" required name="username" value="{{$employee->user_name}}">
                                        </div>


                                        <div class="form-group">
                                            <label>{{language_data('Email')}}</label>
                                            <span class="help">e.g. "coderpixel@gmail.com" ({{language_data('Unique For every User')}})</span>
                                            <input type="email" class="form-control" required name="email" value="{{$employee->email}}">
                                        </div>

                                        <div class="form-group">
                                            <label>{{language_data('Password')}}</label>
                                            <span class="help">{{language_data('Leave blank if you no need to change password')}}</span>
                                            <input type="password" class="form-control" name="password">
                                        </div>

                                        <div class="form-group">
                                            <label>{{language_data('Confirm Password')}}</label>
                                            <span class="help">{{language_data('Leave blank if you no need to change password')}}</span>
                                            <input type="password" class="form-control" name="rpassword">
                                        </div>


                                <div class="form-group">
                                    <label>{{language_data('Tax Template')}}</label>
                                    <select class="selectpicker form-control" name="tax" data-live-search="true">
                                    @foreach($tax as $t)
                                        <option value="{{$t->id}}" @if($employee->tax_id==$t->id) selected @endif>{{$t->tax_name}}</option>
                                    @endforeach
                                    </select>
                                </div>


                                    </div>




                                    <div class="col-md-4">


                                        <div class="form-group">
                                            <label for="el3">{{language_data('Department')}}</label>
                                            <select class="selectpicker form-control" data-live-search="true" name="department" id="department_id">
                                                <option>{{language_data('Select Department')}}</option>
                                                @foreach($department as $d)
                                                    <option value="{{$d->id}}" @if($employee->department==$d->id) selected @endif>  {{$d->department}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="el3">{{language_data('Designation')}}</label>
                                            <select class="selectpicker form-control" data-live-search="true" name="designation" id="designation">
                                                <option value="{{$employee->designation}}">{{$employee->designation_name->designation}}</option>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label>{{language_data('User Role')}}</label>
                                            <select class="selectpicker form-control" data-live-search="true" name="role">
                                                    <option value="0" @if($employee->role_id=='0') selected @endif>{{language_data('Employee')}}</option>
                                                @foreach($role as $r)
                                                    <option value="{{$r->id}}" @if($employee->role_id==$r->id) selected @endif>{{$r->role_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>



                                        <div class="form-group">
                                            <label>{{language_data('Date Of Join')}}</label>
                                            <input type="text" class="form-control datePicker" required="" name="doj" value="{{get_date_format($employee->doj)}}">
                                        </div>

                                        <div class="form-group">
                                            <label>{{language_data('Date Of Leave')}}</label>
                                            <input type="text" class="form-control datePicker" name="dol"  value="{{get_date_format($employee->dol)}}">
                                        </div>

                                        <div class="form-group">
                                            <label>{{language_data('Phone Number')}}</label>
                                            <input type="text" class="form-control"  value="{{$employee->phone}}" name="phone">
                                        </div>

                                        <div class="form-group">
                                            <label>{{language_data('Alternative Phone')}}</label>
                                            <input type="text" class="form-control"  value="{{$employee->phone2}}" name="phone2">
                                        </div>

                                        <div class="form-group">
                                            <label>{{language_data('Status')}}</label>
                                            <select class="selectpicker form-control" data-live-search="true" name="status">
                                                <option value="active" @if($employee->status=='active') selected @endif>{{language_data('Active')}}</option>
                                                <option value="inactive" @if($employee->status=='inactive') selected @endif>{{language_data('Inactive')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">





                                        <div class="form-group">
                                            <label>{{language_data('Father Name')}}</label>
                                            <input type="text" class="form-control"  value="{{$employee->father_name}}" name="father_name">
                                        </div>



                                        <div class="form-group">
                                            <label>{{language_data('Mother Name')}}</label>
                                            <input type="text" class="form-control"  value="{{$employee->mother_name}}" name="mother_name">
                                        </div>

                                        <div class="form-group">
                                            <label>{{language_data('Date Of Birth')}}</label>
                                            <input type="text" class="form-control datePicker" name="dob" value="{{get_date_format($employee->dob)}}">
                                        </div>


                                <div class="form-group">
                                    <label>{{language_data('Gender')}}</label>
                                    <select class="selectpicker form-control" name="gender">
                                        <option value="Male" @if($employee->gender=='Male') selected @endif>{{language_data('Male')}}</option>
                                        <option value="Female" @if($employee->gender=='Female') selected @endif>{{language_data('Female')}}</option>
                                    </select>
                                </div>


                                        <div class="form-group">
                                            <label>{{language_data('Present Address')}}</label>
                                            <textarea class="form-control" rows="6" name="pre_address">{{$employee->pre_address}}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>{{language_data('Permanent Address')}}</label>
                                            <textarea class="form-control" rows="6" name="per_address">{{$employee->per_address}}</textarea>
                                        </div>

                                    </div>

                                    <div class="col-md-12">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" value="{{$employee->id}}" name="cmd">
                                        <input type="submit" value="{{language_data('Update')}}" class="btn btn-success pull-right">

                                    </div>
                                </div>


                            </form>

                        </div>



                        <div role="tabpanel" class="tab-pane" id="bank_information">
                            <div class="row">

                                <div class="col-lg-3">
                                    <div class="panel">
                                        <div class="panel-body">
                                            <form class="" role="form" method="post" action="{{url('employee/add-bank-account')}}">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title"> {{language_data('Add Bank Account')}}</h3>
                                                </div>

                                                <div class="form-group">
                                                    <label>{{language_data('Bank Name')}}</label>
                                                    <span class="help">e.g. "United State Bank"</span>
                                                    <input type="text" class="form-control" required name="bank_name">
                                                </div>

                                                <div class="form-group">
                                                    <label>{{language_data('Branch Name')}}</label>
                                                    <span class="help">e.g. "Washington Branch"</span>
                                                    <input type="text" class="form-control" required name="branch_name">
                                                </div>

                                                <div class="form-group">
                                                    <label>{{language_data('Account Name')}}</label>
                                                    <span class="help">e.g. "Abul Kashem Shamim"</span>
                                                    <input type="text" class="form-control" required name="account_name">
                                                </div>

                                                <div class="form-group">
                                                    <label>{{language_data('Account Number')}}</label>
                                                    <span class="help">e.g. "1015463115661214"</span>
                                                    <input type="text" class="form-control" required name="account_number">
                                                </div>

                                                <div class="form-group">
                                                    <label>{{language_data('IFSC Code')}}</label>
                                                    <input type="text" class="form-control" name="ifsc_code">
                                                </div>

                                                <div class="form-group">
                                                    <label>{{language_data('PAN Number')}}</label>
                                                    <input type="text" class="form-control" name="pan_number">
                                                </div>

                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" value="{{$employee->id}}" name="cmd">
                                                <button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> {{language_data('Add')}} </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-9">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">{{language_data('All Bank Accounts')}}</h3>
                                        </div>
                                        <div class="panel-body p-none">
                                            <table class="table data-table table-hover table-ultra-responsive">
                                                <thead>
                                                <tr>
                                                    <th style="width: 25%;">{{language_data('Bank Name')}}</th>
                                                    <th style="width: 20%;">{{language_data('Branch')}}</th>
                                                    <th style="width: 20%;">{{language_data('Account Name')}}</th>
                                                    <th style="width: 10%;">{{language_data('Account No')}}</th>
                                                    <th style="width: 10%;">{{language_data('IFSC Code')}}</th>
                                                    <th style="width: 10%;">{{language_data('PAN No')}}</th>
                                                    <th style="width: 5%;" class="text-right"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($bank_accounts as $ba)
                                                    <tr>
                                                        <td data-label="Bank Name">{{$ba->bank_name}}</td>
                                                        <td data-label="Branch Name"><p>{{$ba->branch_name}}</p></td>
                                                        <td data-label="Account Name"><p>{{$ba->account_name}}</p></td>
                                                        <td data-label="Account No"><p>{{$ba->account_number}}</p></td>
                                                        <td data-label="IFSC Code"><p>{{$ba->ifsc_code}}</p></td>
                                                        <td data-label="PAN No"><p>{{$ba->pan_no}}</p></td>
                                                        <td class="text-right">
                                                            <a href="#" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger btn-xs deleteBankAccount" id="{{$ba->id}}"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="document">

                            <div class="row">

                                <div class="col-lg-3">
                                    <div class="panel">
                                        <div class="panel-body">
                                            <form class="" role="form" method="post" action="{{url('employee/add-document')}}" enctype="multipart/form-data">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title"> {{language_data('Add Document')}}</h3>
                                                </div>

                                                <div class="form-group">
                                                    <label>{{language_data('Document Name')}}</label>
                                                    <span class="help">e.g. "Resume, Joining Letter etc"</span>
                                                    <input type="text" class="form-control" required name="document_name">
                                                </div>

                                                <div class="form-group">

                                                    <label>{{language_data('Select Document')}}</label>
                                                    <div class="input-group input-group-file">
                                                            <span class="input-group-btn">
                                                                <span class="btn btn-primary btn-file">
                                                                    {{language_data('Browse')}} <input type="file" class="form-control" name="file">
                                                                </span>
                                                            </span>
                                                        <input type="text" class="form-control" readonly="">
                                                    </div>
                                                </div>

                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" value="{{$employee->id}}" name="cmd">
                                                <button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> {{language_data('Add')}} </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-9">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">{{language_data('All Documents')}}</h3>
                                        </div>
                                        <div class="panel-body p-none">
                                            <table class="table data-table table-hover table-ultra-responsive">
                                                <thead>
                                                <tr>
                                                    <th style="width: 65%;">{{language_data('Document Name')}}</th>
                                                    <th style="width: 35%;" class="text-right">{{language_data('Actions')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($employee_doc as $ed)
                                                    <tr>
                                                        <td data-label="Document Name">{{$ed->file_title}}</td>
                                                        <td class="text-right">
                                                            <a href="{{url('employee/download-employee-document/'.$ed->id)}}" class="btn btn-success btn-xs"><i class="fa fa-download"></i> {{language_data('Download')}}</a>
                                                            <a href="#" class="btn btn-danger btn-xs deleteEmployeeDoc" id="{{$ed->id}}"><i class="fa fa-trash"></i> {{language_data('Delete')}}</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div role="tabpanel" class="tab-pane" id="change-picture">
                            <form role="form" action="{{url('employees/update-employee-avatar')}}" method="post" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-md-4">

                                        <div class="form-group input-group input-group-file">
                                                <span class="input-group-btn">
                                                    <span class="btn btn-primary btn-file">
                                                        {{language_data('Browse')}} <input type="file" class="form-control" name="image">
                                                    </span>
                                                </span>
                                            <input type="text" class="form-control" readonly="">
                                        </div>

                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" value="{{$employee->id}}" name="cmd">
                                        <input type="submit" value="{{language_data('Update')}}" class="btn btn-primary">

                                    </div>

                                </div>

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
    {!! Html::script("assets/libs/moment/moment.min.js")!!}
    {!! Html::script("assets/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js")!!}
    {!! Html::script("assets/libs/wysihtml5x/wysihtml5x-toolbar.min.js")!!}
    {!! Html::script("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.js")!!}
    {!! Html::script("assets/libs/data-table/datatables.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
    {!! Html::script("assets/js/bootbox.min.js")!!}

    <script>
        $(document).ready(function () {

            /*For DataTable*/
            $('.data-table').DataTable();


            /*For Designation Loading*/
            $("#department_id").change(function () {
                var id = $(this).val();
                var _url = $("#_url").val();
                var dataString = 'dep_id=' + id;
                $.ajax
                ({
                    type: "POST",
                    url: _url + '/employee/get-designation',
                    data: dataString,
                    cache: false,
                    success: function ( data ) {
                        $("#designation").html( data).removeAttr('disabled').selectpicker('refresh');
                    }
                });
            });


            /*For Delete Bank Account*/
            $(".deleteBankAccount").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/employee/delete-bank-account/" + id;
                    }
                });
            });

            /*For Delete Employee Doc*/
            $(".deleteEmployeeDoc").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/employee/delete-employee-doc/" + id;
                    }
                });
            });


        });
    </script>

@endsection
