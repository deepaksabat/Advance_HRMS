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
            <h2 class="page-title">{{language_data('Loan')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')
            <div class="row">

                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Loan')}}</h3>
                            <button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#add-load"><i class="fa fa-plus"></i> {{language_data('Add')}} {{language_data('Loan')}}</button>
                            <br>
                        </div>
                        <div class="panel-body p-none">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 15%;">{{language_data('Title')}}</th>
                                    <th style="width: 15%;">{{language_data('Employee Name')}}</th>
                                    <th style="width: 10%;">{{language_data('Loan')}} {{language_data('Date')}}</th>
                                    <th style="width: 10%;">{{language_data('Repayment Start Date')}}</th>
                                    <th style="width: 10%;">{{language_data('Amount')}}</th>
                                    <th style="width: 10%;">{{language_data('Remaining Amount')}}</th>
                                    <th style="width: 10%;">{{language_data('Status')}}</th>
                                    <th style="width: 20%;">{{language_data('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($loan as $l)
                                <tr>
                                    <td data-label=Title">{{$l->title}}</td>
                                    <td data-label="Employee Name"><a href="{{url('employees/view/'.$l->emp_id)}}">{{$l->employee_info->fname}} {{$l->employee_info->lname}}</a> </td>
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
                                    <td data-label="Actions">
                                        <a class="btn btn-success btn-xs" href="{{url('loan/view-details/'.$l->id)}}" ><i class="fa fa-edit"></i> {{language_data('Edit')}}</a>
                                        <a href="#" class="btn btn-danger btn-xs cdelete" id="{{$l->id}}"><i class="fa fa-trash"></i> {{language_data('Delete')}}</a>
                                    </td>
                                </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>



            <!-- Modal -->
            <div class="modal fade" id="add-load" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">{{language_data('Add')}} {{language_data('Loan')}}</h4>
                        </div>
                        <form class="form-some-up" role="form" method="post" action="{{url('loan/post-new-loan')}}">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label>{{language_data('Employee Name')}}</label>
                                    <select name="emp_name" class="form-control selectpicker" data-live-search="true">
                                        @foreach($employee as $e)
                                            <option value="{{$e->id}}">{{$e->fname}} {{$e->lname}} ({{$e->employee_code}})</option>
                                        @endforeach
                                    </select>
                                </div>



                                <div class="form-group">
                                    <label for="fname">{{language_data('Title')}}</label>
                                    <input type="text" class="form-control" name="title" required="">
                                </div>

                                <div class="form-group">
                                    <label for="fname">{{language_data('Loan')}} {{language_data('Date')}}</label>
                                    <input type="text" class="form-control datePicker" name="loan_date" required="">
                                </div>

                                <div class="form-group">
                                    <label for="fname">{{language_data('Loan')}} {{language_data('Amount')}}</label>
                                    <input type="number" class="form-control" name="loan_amount" required="">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Include Loan Amount in Payslip')}}</label>
                                    <div class="form-group">
                                        <div class="coder-radiobox radio-inline">
                                            <input type="radio" name="payslip" value="yes" checked><span class="co-radio-ui"></span><label>Yes</label>
                                        </div>

                                        <div class="coder-radiobox radio-inline">
                                            <input type="radio" name="payslip" value="no"><span class="co-radio-ui"></span><label>No</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="fname">{{language_data('Monthly Repayment Amount')}}</label>
                                    <input type="number" class="form-control" name="repayment_amount" required="">
                                </div>


                                <div class="form-group">
                                    <label for="fname">{{language_data('Repayment Start Date')}}</label>
                                    <input type="text" class="form-control datePicker" name="repayment_start_date" required="">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Status')}}</label>
                                    <select name="status" class="form-control selectpicker">
                                        <option value="pending">{{language_data('Pending')}}</option>
                                        <option value="ongoing">{{language_data('Ongoing')}}</option>
                                        <option value="completed">{{language_data('Completed')}}</option>
                                        <option value="rejected">{{language_data('Rejected')}}</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Description')}}</label>
                                    <textarea class="form-control textarea-wysihtml5" name="description"></textarea>
                                </div>



                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button type="button" class="btn btn-default" data-dismiss="modal">{{language_data('Close')}}</button>
                                <button type="submit" class="btn btn-primary">{{language_data('Add')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </section>

@endsection

{{--External Style Section--}}
@section('script')
    {!! Html::script("assets/libs/moment/moment.min.js")!!}
    {!! Html::script("assets/libs/handlebars/handlebars.runtime.min.js")!!}
    {!! Html::script("assets/libs/wysihtml5x/wysihtml5x-toolbar.min.js")!!}
    {!! Html::script("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.js")!!}
    {!! Html::script("assets/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
    {!! Html::script("assets/libs/data-table/datatables.min.js")!!}
    {!! Html::script("assets/js/bootbox.min.js")!!}

    <script>
        $(document).ready(function(){
            $('.data-table').DataTable();

            /*For Delete Designation*/
            $(".cdelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/loan/delete/" + id;
                    }
                });
            });

        });
    </script>
@endsection
