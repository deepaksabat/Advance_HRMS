@extends('master')


{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Edit Expense')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-body">
                            <form role="form" action="{{url('expense/expense-edit-post')}}" method="post" enctype="multipart/form-data">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> {{language_data('Edit Expense')}}</h3>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Item Name')}}</label>
                                    <input type="text" class="form-control" required="" name="item_name" value="{{$expense->item_name}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Purchase From')}}</label>
                                    <input type="text" class="form-control" required="" name="purchase_from"  value="{{$expense->purchase_from}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Purchase By')}}</label>
                                    <select name="emp_name" class="form-control selectpicker" data-live-search="true">
                                        @foreach($employee as $e)
                                            <option value="{{$e->id}}" @if($expense->purchase_by==$e->id) selected @endif>{{$e->fname}} {{$e->lname}} ({{$e->employee_code}})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Purchase Date')}}</label>
                                    <input type="text" class="form-control datePicker" required="" name="purchase_date" value="{{$expense->purchase_date}}">
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Amount')}}</label>
                                    <input type="text" class="form-control" name="amount"  value="{{$expense->amount}}">
                                </div>

                                <div class="form-group m-none">
                                    <label for="e20">{{language_data('Status')}}</label>
                                    <select name="status" class="form-control selectpicker">
                                        <option value="Pending" @if($expense->status=='Pending') selected @endif>Pending</option>
                                        <option value="Approved"  @if($expense->status=='Approved') selected @endif>Approved</option>
                                        <option value="Cancel"  @if($expense->status=='Cancel') selected @endif>Cancel</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Select Document')}}</label>
                                    <div class="input-group input-group-file">
                                        <span class="input-group-btn">
                                            <span class="btn btn-primary btn-file">
                                                {{language_data('Browse')}} <input type="file" class="form-control" name="bill_copy">
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" readonly="">
                                    </div>
                                </div>

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" value="{{$expense->id}}" name="cmd">
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
    {!! Html::script("assets/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js")!!}
    {!! Html::script("assets/libs/handlebars/handlebars.runtime.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
@endsection
