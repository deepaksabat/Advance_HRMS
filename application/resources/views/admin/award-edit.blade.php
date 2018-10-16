@extends('master')

@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Edit Award')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-body">
                            <form class="" role="form" action="{{url('award/award-edit-post')}}" method="post">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> {{language_data('Edit Award')}}</h3>
                                </div>
                                <div class="form-group">
                                    <label>{{language_data('Award Name')}}</label>
                                    <select name="award_name" id="e20" class="form-control selectpicker" data-live-search="true">
                                        @foreach($award_name as $an)
                                            <option value="{{$an->id}}" @if($an->id == $award->award) selected @endif >{{$an->award}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Employee Name')}}</label>
                                    <select name="emp_name" class="form-control selectpicker" data-live-search="true">
                                        @foreach($employee as $e)
                                            <option value="{{$e->employee_code}}" @if($e->employee_code == $award->emp_id) selected @endif>{{$e->fname}} {{$e->lname}} ({{$e->employee_code}})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Gift Item')}}</label>
                                    <input type="text" class="form-control" required="" name="gift_item" value="{{$award->gift}}">
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Cash Price')}}</label>
                                    <input type="text" class="form-control" name="cash_price" value="{{$award->cash}}">
                                </div>

                                <div class="form-group m-none">
                                    <label for="e20">Month</label>
                                    <select name="month" class="form-control selectpicker" data-live-search="true">
                                        <option value="January" @if($award->month=='January') selected @endif>{{language_data('January')}}</option>
                                        <option value="February"  @if($award->month=='February') selected @endif>{{language_data('February')}}</option>
                                        <option value="March"  @if($award->month=='March') selected @endif>{{language_data('March')}}</option>
                                        <option value="April"  @if($award->month=='April') selected @endif>{{language_data('April')}}</option>
                                        <option value="May"  @if($award->month=='May') selected @endif>{{language_data('May')}}</option>
                                        <option value="June"  @if($award->month=='June') selected @endif>{{language_data('June')}}</option>
                                        <option value="July"  @if($award->month=='July') selected @endif>{{language_data('July')}}</option>
                                        <option value="August"  @if($award->month=='August') selected @endif>{{language_data('August')}}</option>
                                        <option value="September"  @if($award->month=='September') selected @endif>{{language_data('September')}}</option>
                                        <option value="October"  @if($award->month=='October') selected @endif>{{language_data('October')}}</option>
                                        <option value="November"  @if($award->month=='November') selected @endif>{{language_data('November')}}</option>
                                        <option value="December"  @if($award->month=='December') selected @endif>{{language_data('December')}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Year')}}</label>
                                    {{yearDropdown(1900,date('Y'),'year',$award->year)}}
                                </div>

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" value="{{$award->id}}" name="cmd">
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
    {!! Html::script("assets/libs/handlebars/handlebars.runtime.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
@endsection
