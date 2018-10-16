@extends('master')


{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Update Attendance')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-body">
                            <form class="" role="form" action="{{url('attendance/post-edit-attendance')}}" method="post">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> {{language_data('Update Attendance')}}</h3>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Clock In')}}</label>
                                    <input type="text" class="form-control timePicker" required name="clock_in" value="{{$attendance->clock_in}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Clock Out')}}</label>
                                    <input type="text" class="form-control timePicker" required name="clock_out"  value="{{$attendance->clock_out}}">
                                </div>


                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" value="{{$attendance->id}}" name="cmd">
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
    {!! Html::script("assets/libs/moment/moment.min.js")!!}
    {!! Html::script("assets/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
@endsection
