@extends('master')

@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Edit')}} {{language_data('Employee Salary Increment')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-body">
                            <form class="" role="form" action="{{url('payroll/edit-employee-salary-increment-post')}}" method="post">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> {{language_data('Edit')}} {{language_data('Employee Salary Increment')}}</h3>
                                </div>

                                <div class="form-group m-none">
                                    <label for="e20">{{language_data('Salary Type')}}</label>
                                    <select name="payment_type" class="form-control selectpicker paymentType">
                                        <option value="Monthly" @if($employee->payment_type=='Monthly') selected @endif>{{language_data('Monthly')}}</option>
                                        <option value="Hourly"  @if($employee->payment_type=='Hourly') selected @endif>{{language_data('Hourly')}}</option>
                                    </select>
                                </div>

                                <div class="show-monthly">
                                    <div class="form-group">
                                        <label>{{language_data('Basic Salary')}}</label>
                                        <span class="help">e.g. "5000" ({{language_data('Add with basic salary')}})</span>
                                        <input type="text" class="form-control" name="basic_salary" value="{{$employee->basic_salary_increment}}">
                                    </div>

                                    <div class="form-group">
                                        <label>{{language_data('Overtime Salary')}}</label>
                                        <span class="help">{{language_data('Hourly')}} e.g. "4" ({{language_data('Add with basic salary')}})</span>
                                        <input type="text" class="form-control" name="overtime_salary" value="{{$employee->overtime_salary_increment}}">
                                    </div>

                                </div>


                                <div class="show-hourly">
                                    <div class="form-group">
                                        <label>{{language_data('Hourly Working Rate')}}</label>
                                        <span class="help">e.g. "3" ({{language_data('Add with basic salary')}})</span>
                                        <input type="text" class="form-control" name="hourly_working_rate" value="{{$employee->working_hourly_increment_rate}}">
                                    </div>

                                    <div class="form-group">
                                        <label>{{language_data('Hourly Overtime Rate')}}</label>
                                        <span class="help">e.g. "4" ({{language_data('Add with basic salary')}})</span>
                                        <input type="text" class="form-control" name="hourly_overtime_rate" value="{{$employee->overtime_hourly_increment_rate}}">
                                    </div>

                                </div>


                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" value="{{$employee->id}}" name="cmd">
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

    <script>
        $(document).ready(function(){

            var FundType = $('.paymentType');

            if (FundType.val() == 'Monthly') {
                $('.show-hourly').hide();
            }else{
                $('.show-monthly').hide();
            }

            FundType.on('change', function () {
                var value = $(this).val();
                if (value == 'Hourly') {
                    $('.show-hourly').show();
                    $('.show-monthly').hide();
                } else {
                    $('.show-hourly').hide();
                    $('.show-monthly').show();
                }

            });


        });
    </script>
@endsection
