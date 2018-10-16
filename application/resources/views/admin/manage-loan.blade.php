@extends('master')


{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.css") !!}
    {!! Html::style("assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Edit')}} {{language_data('Loan')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-body">
                            <form class="" role="form" action="{{url('loan/edit-post')}}" method="post">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> {{language_data('Edit')}} {{language_data('Loan')}}</h3>
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Employee Name')}}</label>
                                    <select name="emp_name" class="form-control selectpicker" data-live-search="true">
                                        @foreach($employee as $e)
                                            <option value="{{$e->id}}" @if($e->id==$loan->emp_id) selected @endif>{{$e->fname}} {{$e->lname}} ({{$e->employee_code}})</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="fname">{{language_data('Title')}}</label>
                                    <input type="text" class="form-control" name="title" required="" value="{{$loan->title}}">
                                </div>


                                <div class="form-group">
                                    <label for="fname">{{language_data('Loan')}} {{language_data('Date')}}</label>
                                    <input type="text" class="form-control datePicker" name="loan_date" required="" value="{{$loan->loan_date}}">
                                </div>

                                <div class="form-group">
                                    <label for="fname">{{language_data('Loan')}} {{language_data('Amount')}}</label>
                                    <input type="number" class="form-control" name="loan_amount" required="" value="{{$loan->amount}}">
                                </div>



                                <div class="form-group">
                                    <label>{{language_data('Include Loan Amount in Payslip')}}</label>
                                    <div class="form-group">
                                        <div class="coder-radiobox radio-inline">
                                            <input type="radio" name="payslip" value="yes" @if($loan->enable_payslip=='yes') checked @endif><span class="co-radio-ui"></span><label>{{language_data('Yes')}}</label>
                                        </div>

                                        <div class="coder-radiobox radio-inline">
                                            <input type="radio" name="payslip" value="no"  @if($loan->enable_payslip=='no') checked @endif><span class="co-radio-ui"></span><label>{{language_data('No')}}</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="fname">{{language_data('Monthly Repayment Amount')}}</label>
                                    <input type="number" class="form-control" name="repayment_amount" required="" value="{{$loan->repayment_amount}}">
                                </div>


                                <div class="form-group">
                                    <label for="fname">{{language_data('Repayment Start Date')}}</label>
                                    <input type="text" class="form-control datePicker" name="repayment_start_date" required="" value="{{$loan->repayment_start_date}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Status')}}</label>
                                    <select name="status" class="form-control selectpicker">
                                        <option value="pending" @if($loan->status=='pending') selected @endif>{{language_data('Pending')}}</option>
                                        <option value="ongoing" @if($loan->status=='ongoing') selected @endif>{{language_data('Ongoing')}}</option>
                                        <option value="completed" @if($loan->status=='completed') selected @endif>{{language_data('Completed')}}</option>
                                        <option value="rejected" @if($loan->status=='rejected') selected @endif>{{language_data('Rejected')}}</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Description')}}</label>
                                    <textarea class="form-control textarea-wysihtml5" name="description">{!!$loan->description!!}</textarea>
                                </div>



                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" value="{{$loan->id}}" name="cmd">
                                <button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-edit"></i> {{language_data('Update')}} </button>
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
    {!! Html::script("assets/libs/moment/moment.min.js")!!}
    {!! Html::script("assets/libs/handlebars/handlebars.runtime.min.js")!!}
    {!! Html::script("assets/libs/wysihtml5x/wysihtml5x-toolbar.min.js")!!}
    {!! Html::script("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.js")!!}
    {!! Html::script("assets/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
@endsection
