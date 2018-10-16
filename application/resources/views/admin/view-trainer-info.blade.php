@extends('master')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.css") !!}
    {!! Html::style("assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('View Trainer Info')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-7">
                    <div class="panel">
                        <div class="panel-body">
                            <form class="" role="form" action="{{url('training/post-trainer-update-info')}}" method="post">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> {{language_data('View Trainer Info')}}</h3>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('First Name')}}</label>
                                    <input type="text" class="form-control" required="" name="first_name" value="{{$trainer->first_name}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Last Name')}}</label>
                                    <input type="text" class="form-control" name="last_name"  value="{{$trainer->last_name}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Designation')}}</label>
                                    <input type="text" class="form-control" required="" name="designation"  value="{{$trainer->designation}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Organization')}}</label>
                                    <input type="text" class="form-control" required="" name="organization"  value="{{$trainer->organization}}">
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Address')}}</label>
                                    <input type="text" class="form-control" name="address"  value="{{$trainer->address}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('City')}}</label>
                                    <input type="text" class="form-control" name="city"  value="{{$trainer->city}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('State')}}</label>
                                    <input type="text" class="form-control" name="state"  value="{{$trainer->state}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Zip Code')}}</label>
                                    <input type="text" class="form-control" name="zip_code"  value="{{$trainer->zip}}">
                                </div>


                                <div class="form-group">
                                    <label for="Country">{{language_data('Country')}}</label>
                                    <select name="country" class="form-control selectpicker" data-live-search="true">
                                        {!!countries( $trainer->country)!!}
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Email')}}</label>
                                    <input type="email" class="form-control" required="" name="email"  value="{{$trainer->email_address}}">
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Phone')}}</label>
                                    <input type="text" class="form-control" required="" name="phone"  value="{{$trainer->phone}}">
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Trainer Expertise')}}</label>
                                    <textarea class="textarea-wysihtml5 form-control" name="trainer_expertise">{{$trainer->expertise}}</textarea>
                                </div>


                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" value="{{$trainer->id}}" name="cmd">
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
    {!! Html::script("assets/libs/wysihtml5x/wysihtml5x-toolbar.min.js")!!}
    {!! Html::script("assets/libs/handlebars/handlebars.runtime.min.js")!!}
    {!! Html::script("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
@endsection
