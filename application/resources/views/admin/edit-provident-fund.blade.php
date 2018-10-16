@extends('master')


{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Edit')}} {{language_data('Provident Fund')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-body">
                            <form class="" role="form" action="{{url('provident-fund/edit-post')}}" method="post">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> {{language_data('Edit')}} {{language_data('Provident Fund')}}</h3>
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Employee Name')}}</label>
                                    <select name="emp_name" class="form-control selectpicker" data-live-search="true">
                                        @foreach($employee as $e)
                                            <option value="{{$e->id}}" @if($e->id==$pfund->emp_id) selected @endif>{{$e->fname}} {{$e->lname}} ({{$e->employee_code}})</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group m-none">
                                    <label for="e20">{{language_data('Provident Fund Type')}}</label>
                                    <select name="fund_type" class="form-control selectpicker fundType">
                                        <option value="Fixed Amount" @if($pfund->provident_fund_type=='Fixed Amount') selected @endif>Fixed Amount</option>
                                        <option value="Percentage of Basic Salary"  @if($pfund->provident_fund_type=='Percentage of Basic Salary') selected @endif>Percentage of Basic Salary</option>
                                    </select>
                                </div>

                                <div class="show-fixed-amount">

                                    <div class="form-group">
                                        <label for="Employee Share">{{language_data('Employee Share')}}</label>
                                        <span class="help">({{language_data('Amount')}})</span>
                                        <input type="text" class="form-control" name="emp_share_fixed" value="{{$pfund->employee_share}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="Organization Share">{{language_data('Organization Share')}}</label>
                                        <span class="help">({{language_data('Amount')}})</span>
                                        <input type="text" class="form-control" name="org_share_fixed"  value="{{$pfund->organization_share}}">
                                    </div>

                                </div>


                                <div class="show-basic-salary">

                                    <div class="form-group">
                                        <label for="fname">{{language_data('Employee Share')}}</label>
                                        <span class="help">(%)</span>
                                        <input type="text" class="form-control" name="emp_share_per" value="{{$pfund->employee_share}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="fname">{{language_data('Organization Share')}}</label>
                                        <span class="help">(%)</span>
                                        <input type="text" class="form-control" name="org_share_per"  value="{{$pfund->organization_share}}">
                                    </div>

                                </div>


                                <div class="form-group m-none">
                                    <label for="e20">{{language_data('Status')}}</label>
                                    <select name="status" class="form-control selectpicker">
                                        <option value="Paid" @if($pfund->status=='Paid') selected @endif>{{language_data('Paid')}}</option>
                                        <option value="Unpaid"  @if($pfund->status=='Unpaid') selected @endif>{{language_data('Unpaid')}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Description')}}</label>
                                    <textarea class="form-control textarea-wysihtml5" name="description">{!!$pfund->description!!}</textarea>
                                </div>



                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" value="{{$pfund->id}}" name="cmd">
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
    {!! Html::script("assets/libs/wysihtml5x/wysihtml5x-toolbar.min.js")!!}
    {!! Html::script("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}


    <script>
        $(document).ready(function(){

            var FundType = $('.fundType');

            if (FundType.val() == 'Fixed Amount') {
                $('.show-basic-salary').hide();
            }else{
                $('.show-fixed-amount').hide();
            }

            FundType.on('change', function () {
                var value = $(this).val();
                if (value == 'Percentage of Basic Salary') {
                    $('.show-basic-salary').show();
                    $('.show-fixed-amount').hide();
                } else {
                    $('.show-basic-salary').hide();
                    $('.show-fixed-amount').show();
                }

            });


        });
    </script>

@endsection
