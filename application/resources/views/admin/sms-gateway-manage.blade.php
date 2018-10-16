@extends('master')


{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Manage')}} {{language_data('SMS Gateways')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-7">
                    <div class="panel">
                        <div class="panel-body">
                            <form method="POST" action="{{ url('settings/sms-gateway-update') }}">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> {{language_data('Manage')}} {{language_data('SMS Gateways')}}</h3>
                                </div>


                                <div class="form-group">
                                    <label for="name">{{language_data('Gateway Name')}}</label>
                                    <input type="text" class="form-control" name="name" disabled value="{{$sg->name}}">
                                </div>
                                @if($sg->name!='Twilio')
                                <div class="form-group">
                                    <label for="username">{{language_data('API Link')}}</label>
                                    <input type="text" class="form-control" name="api_link" value="{{$sg->api_link}}">
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="username">{{language_data('User name')}}</label>
                                    <input type="text" class="form-control" name="user_name" value="{{$sg->user_name}}">
                                </div>

                                <div class="form-group">
                                    <label for="password">{{language_data('Password')}}</label>
                                    <input type="text" class="form-control" name="password" value="{{$sg->password}}">
                                </div>

                                <div class="form-group">
                                    <label for="Status">{{language_data('Status')}}</label>
                                    <select name="status" class="selectpicker form-control">
                                        <option value="Active" @if($sg->status=='Active') selected @endif>{{language_data('Active')}}</option>
                                        <option value="Inactive" @if($sg->status=='Inactive') selected @endif>{{language_data('Inactive')}}</option>
                                    </select>
                                </div>


                                <input type="hidden" value="{{$sg->id}}" name="cmd">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" name="update" class="btn btn-success"><i class="fa fa-edit"></i> {{language_data('Update')}}</button>
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
@endsection
