@extends('master')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Employee Summery')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-4">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{$employee->fname}} {{$employee->lname}} </h3>
                        </div>
                        <div class="panel-body">
                            <div class="thumbnail-user m-b-5">
                                @if($employee->avatar!='')
                                    <img class="p-2 bg-complete"
                                         src="<?php echo asset('assets/employee_pic/' . $employee->avatar); ?>"
                                         alt="Profile Page" width="200px" height="200px">
                                @else
                                    <img class="p-2 bg-complete"
                                         src="<?php echo asset('assets/employee_pic/user.png');?>" alt="Profile Page"
                                         width="200px" height="200px">
                                @endif
                            </div>
                            <div class="form-block">

                                <div class="form-group">
                                    <label>{{language_data('First Name')}}:</label>
                                    <span>{{$employee->fname}}</span>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Last Name')}}:</label>
                                    <span>{{$employee->lname}}</span>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Employee Code')}}:</label>
                                    <span>{{$employee->employee_code}}</span>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('User name')}}:</label>
                                    <span>{{$employee->user_name}}</span>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Department')}}:</label>
                                    <span>{{$employee->department_name->department}}</span>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Designation')}}:</label>
                                    <span>{{$employee->designation_name->designation}}</span>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Email')}}:</label>
                                    <span>{{$employee->email}}</span>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Father Name')}}:</label>
                                    <span>{{$employee->father_name}}</span>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Mother Name')}}:</label>
                                    <span>{{$employee->mother_name}}</span>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Date of Birth')}}:</label>
                                    <span>{{$employee->dob}}</span>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Date of Join')}}:</label>
                                    <span>{{$employee->doj}}</span>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Phone')}}:</label>
                                    <span>{{$employee->phone}}</span>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Alternative Phone')}}:</label>
                                    <span>{{$employee->phone2}}</span>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Present Address')}}:</label>
                                    <span>{{$employee->pre_address}}</span>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Permanent Address')}}:</label>
                                    <span>{{$employee->per_address}}</span>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Status')}}:</label>
                                    @if($employee->status=='active')
                                        <span class="label label-success">{{$employee->status}}</span>
                                    @else
                                        <span class="label label-danger">{{$employee->status}}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Gender')}}:</label>
                                    <span>{{$employee->gender}}</span>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Payment Type')}}:</label>
                                    <span>{{$employee->payment_type}}</span>
                                </div>


                                @if($employee->payment_type=='Monthly')

                                    <div class="form-group">
                                        <label>{{language_data('Basic Salary')}}:</label>
                                        <span>{{app_config('Currency')}} {{$employee->basic_salary+$employee->basic_salary_increment}}</span>
                                    </div>

                                    <div class="form-group">
                                        <label>{{language_data('Overtime Salary')}}:</label>
                                        <span>{{app_config('Currency')}} {{$employee->overtime_salary+$employee->overtime_salary_increment}}</span>
                                        <span class="help">{{language_data('Hourly')}}</span>
                                    </div>

                                @else

                                    <div class="form-group">
                                        <label>{{language_data('Working Hourly Rate')}}:</label>
                                        <span>{{app_config('Currency')}} {{$employee->working_hourly_rate+$employee->working_hourly_increment_rate}}</span>
                                    </div>

                                    <div class="form-group">
                                        <label>{{language_data('Overtime Hourly Rate')}}:</label>
                                        <span>{{app_config('Currency')}} {{$employee->overtime_hourly_rate+$employee->overtime_hourly_increment_rate}}</span>
                                    </div>

                                @endif


                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Leave')}}</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 10%;">{{language_data('SL')}}#</th>
                                    <th style="width: 30%;">{{language_data('Leave Type')}}</th>
                                    <th style="width: 20%;">{{language_data('Leave From')}}</th>
                                    <th style="width: 20%;">{{language_data('Leave To')}}</th>
                                    <th style="width: 20%;">{{language_data('Status')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($leave as $d)
                                    <tr>
                                        <td data-label="SL">{{$d->id}}</td>
                                        <td data-label="leaveType"><p>{{$d->leave_type->leave}}</p></td>
                                        <td data-label="LeaveFrom"><p>{{get_date_format($d->leave_from)}}</p></td>
                                        <td data-label="LeaveTo"><p>{{get_date_format($d->leave_to)}}</p></td>
                                        @if($d->status=='approved')
                                            <td data-label="Status"><p class="btn btn-success btn-xs">{{language_data('Approved')}}</p></td>
                                        @elseif($d->status=='pending')
                                            <td data-label="Status"><p class="btn btn-warning btn-xs">{{language_data('Pending')}}</p></td>
                                        @else
                                            <td data-label="Status"><p class="btn btn-danger btn-xs">{{language_data('Rejected')}}</p></td>
                                        @endif
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Provident Fund')}}</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 40%;">{{language_data('Provident Fund Type')}}</th>
                                    <th style="width: 20%;">{{language_data('Employee Share')}}</th>
                                    <th style="width: 20%;">{{language_data('Organization Share')}}</th>
                                    <th style="width: 20%;">{{language_data('Status')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($provident_fund as $pf)
                                    <tr>

                                        <td data-label="Fund Type"><p>{{$pf->provident_fund_type}}</p></td>
                                        <td data-label="Employee Share">
                                            <p>
                                                @if($pf->provident_fund_type=='Fixed Amount')
                                                    {{app_config('CurrencyCode')}} {{$pf->employee_share}}
                                                @else
                                                    {{$pf->employee_share}} %
                                                @endif
                                            </p>
                                        </td>
                                        <td data-label="Organization Share">
                                            <p>
                                                @if($pf->provident_fund_type=='Fixed Amount')
                                                    {{app_config('CurrencyCode')}} {{$pf->organization_share}}
                                                @else
                                                    {{$pf->organization_share}} %
                                                @endif
                                            </p>
                                        </td>
                                        @if($pf->status=='Paid')
                                            <td data-label="Status"><p class="btn btn-success btn-xs">{{language_data('Paid')}}</p></td>
                                        @else
                                            <td data-label="Status"><p class="btn btn-warning btn-xs">{{language_data('Unpaid')}}</p></td>
                                        @endif
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Loan')}}</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 25%;">{{language_data('Title')}}</th>
                                    <th style="width: 15%;">{{language_data('Loan')}} {{language_data('Date')}}</th>
                                    <th style="width: 15%;">{{language_data('Repayment Start Date')}}</th>
                                    <th style="width: 15%;">{{language_data('Amount')}}</th>
                                    <th style="width: 15%;">{{language_data('Remaining Amount')}}</th>
                                    <th style="width: 15%;">{{language_data('Status')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($loan as $l)
                                    <tr>
                                        <td data-label=Title">{{$l->title}}</td>
                                        <td data-label="Loan Date"><p>{{get_date_format($l->loan_date)}}</p></td>
                                        <td data-label="Repayment Start Date">{{get_date_format($l->repayment_start_date)}}</td>
                                        <td data-label="Amount">{{app_config('CurrencyCode')}} {{$l->amount}}</td>
                                        <td data-label="Remaining Amount">{{app_config('CurrencyCode')}} {{$l->remaining_amount}}</td>
                                        @if($l->status=='ongoing')
                                            <td data-label="Status"><p class="btn btn-success btn-xs">{{language_data('Ongoing')}}</p></td>
                                        @elseif($l->status=='pending')
                                            <td data-label="Status"><p class="btn btn-warning btn-xs">{{language_data('Pending')}}</p></td>
                                        @elseif($l->status=='rejected')
                                            <td data-label="Status"><p class="btn btn-danger btn-xs">{{language_data('Rejected')}}</p></td>
                                        @else
                                            <td data-label="Status"><p class="btn btn-complete btn-xs">{{language_data('Completed')}}</p></td>
                                        @endif
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Award')}}</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 15%;">{{language_data('SL')}}#</th>
                                    <th style="width: 30%;">{{language_data('Award Name')}}</th>
                                    <th style="width: 30%;">{{language_data('Gift')}}</th>
                                    <th style="width: 25%;">{{language_data('Month')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($award as $d)
                                    <tr>
                                        <td data-label="SL">{{$d->id}}</td>
                                        <td data-label="Award"><p>{{$d->award_name->award}}</p></td>
                                        <td data-label="gift"><p>{{$d->gift}}</p></td>
                                        <td data-label="month"><p>{{$d->month}} {{$d->year}} </p></td>
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
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
    {!! Html::script("assets/libs/data-table/datatables.min.js")!!}
    {!! Html::script("assets/js/bootbox.min.js")!!}
    <script>
        $(document).ready(function () {
            $('.data-table').DataTable();
        });
    </script>
@endsection
