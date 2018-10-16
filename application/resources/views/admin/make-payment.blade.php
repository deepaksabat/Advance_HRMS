@extends('master')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
    {!! Html::style("assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Make Payment')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')
            <div class="row">

                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Search Condition')}}</h3>
                        </div>
                        <div class="panel-body">
                            <form class="" role="form" method="post" action="{{url('payroll/make-payment/post-custom-search')}}">

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="el2">{{language_data('Date')}}</label>
                                            <input type="text" id="el2" class="form-control monthPicker" required="" name="date" value="{{$date}}">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="el3">{{language_data('Employee')}}</label>
                                            <select class="selectpicker form-control" data-live-search="true" name="employee">
                                                <option value="0">Select Employee</option>
                                                @foreach($employee as $d)
                                                    <option value="{{$d->id}}" @if($d->id==$emp_id) selected @endif>{{$d->fname}} {{$d->lname}} ({{$d->employee_code}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="el3">{{language_data('Department')}}</label>
                                            <select class="selectpicker form-control" data-live-search="true" name="department" id="department_id">
                                                <option value="0">{{language_data('Select Department')}}</option>
                                                @foreach($department as $d)
                                                <option value="{{$d->id}}" @if($dep_id==$d->id) selected @endif> {{$d->department}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="el3">{{language_data('Designation')}}</label>
                                            <select class="selectpicker form-control" data-live-search="true" disabled name="designation" id="designation">
                                                <option value="0">{{language_data('Select Designation')}}</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-search"></i> {{language_data('Search')}}</button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>

            @if($search_status!='')
                <div class="row">

                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Make Payment')}}</h3>
                        </div>
                        <div class="panel-body p-none">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 10%;">{{language_data('Code')}}</th>
                                    <th style="width: 25%;">{{language_data('Name')}}</th>
                                    <th style="width: 15%;">{{language_data('Department')}}</th>
                                    <th style="width: 15%;">{{language_data('Designation')}}</th>
                                    <th style="width: 20%;">{{language_data('Payment Type')}}</th>
                                    <th style="width: 15%;">{{language_data('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($payroll as $d)
                                    <tr>
                                        <td><a href="{{url('employees/view/'.$d->id)}}">{{$d->employee_code}}</a></td>
                                        <td>{{$d->fname}} {{$d->lname}}</td>
                                        <td>{{$d->department_name->department}}</td>
                                        <td>{{$d->designation_name->designation}}</td>
                                        <td>{{$d->payment_type}}</td>
                                        <td>
                                            @if($d->payment_type=='Hourly' AND $d->working_hourly_rate=='0')
                                                <p>{{language_data('Set Working Rate')}}</p>
                                            @elseif($d->payment_type=='Monthly' AND $d->basic_salary=='0.00')
                                                <p>{{language_data('Set Working Rate')}}</p>
                                            @elseif(\App\Attendance::where('emp_id',$d->id)->first())
                                            <a href="#" id="{{$d->id}}" class="btn btn-success btn-xs makePayment"><i class="fa fa-credit-card"></i> {{language_data('Make Payment')}}</a>
                                            @else
                                                <p>{{language_data('No working hour')}}</p>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            @endif

        </div>
    </section>
    <input type="hidden" id="payment_date" value="{{$date}}">
@endsection

{{--External Style Section--}}
@section('script')
    {!! Html::script("assets/libs/handlebars/handlebars.runtime.min.js")!!}
    {!! Html::script("assets/libs/moment/moment.min.js")!!}
    {!! Html::script("assets/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
    {!! Html::script("assets/libs/data-table/datatables.min.js")!!}
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
                    url: _url + '/payroll/get-designation',
                    data: dataString,
                    cache: false,
                    success: function ( data ) {
                        $("#designation").html( data).removeAttr('disabled').selectpicker('refresh');
                    }
                });
            });


            /*For Delete Payslip*/

            /*For Delete Job Info*/
            $(".makePayment").click(function (e) {
                e.preventDefault();
                var id = this.id;
                var paymentDate=$('#payment_date').val();
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/payroll/pay-payment/" + id +"/"+paymentDate;
                    }
                });
            });

        });
    </script>


@endsection
