@extends('master')

@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Add Employee')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-body">
                            <form class="" role="form" action="{{url('employees/add-employee-post')}}" method="post">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> {{language_data('Add Employee')}}</h3>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('First Name')}}</label>
                                    <span class="help">e.g. "Jhon"</span>
                                    <input type="text" class="form-control" required name="fname">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Last Name')}}</label>
                                    <span class="help">e.g. "Doe"</span>
                                    <input type="text" class="form-control" name="lname">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Employee Code')}}</label>
                                    <span class="help">e.g. "546814" ({{language_data('Unique For every User')}})</span>
                                    <input type="text" class="form-control" required name="employee_code">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Username')}}</label>
                                    <span class="help">e.g. "employee" ({{language_data('Unique For every User')}})</span>
                                    <input type="text" class="form-control" required name="username">
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Email')}}</label>
                                    <span class="help">e.g. "coderpixel@gmail.com" ({{language_data('Unique For every User')}})</span>
                                    <input type="email" class="form-control" required name="email">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Password')}}</label>
                                    <input type="password" class="form-control" required name="password">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Confirm Password')}}</label>
                                    <input type="password" class="form-control" required name="rpassword">
                                </div>

                                <div class="form-group">
                                    <label for="el3">{{language_data('Department')}}</label>
                                    <select class="selectpicker form-control" data-live-search="true" name="department" id="department_id">
                                        <option>{{language_data('Select Department')}}</option>
                                        @foreach($department as $d)
                                            <option value="{{$d->id}}"> {{$d->department}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="el3">{{language_data('Designation')}}</label>
                                    <select class="selectpicker form-control" data-live-search="true" disabled name="designation" id="designation">
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Gender')}}</label>
                                    <select class="selectpicker form-control" name="gender">
                                        <option value="Male">{{language_data('Male')}}</option>
                                        <option value="Female">{{language_data('Female')}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Tax Template')}}</label>
                                    <select class="selectpicker form-control" name="tax" data-live-search="true">
                                    @foreach($tax as $t)
                                        <option value="{{$t->id}}">{{$t->tax_name}}</option>
                                    @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('User Role')}}</label>
                                    <select class="selectpicker form-control" data-live-search="true" name="role">
                                        <option value="0" selected>{{language_data('Employee')}}</option>
                                        @foreach($role as $r)
                                        <option value="{{$r->id}}">{{$r->role_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> {{language_data('Add')}} </button>
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

    <script>
        $(document).ready(function () {

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

        });
    </script>

@endsection
