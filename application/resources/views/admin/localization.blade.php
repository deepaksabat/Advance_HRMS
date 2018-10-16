@extends('master')

@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Localization')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-body">
                            <form class="" role="form" action="{{url('settings/localization-post')}}" method="post">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> {{language_data('Localization')}}</h3>
                                </div>


                                <div class="form-group">
                                    <label for="Country">{{language_data('Default Country')}}</label>
                                    <select name="country" class="form-control selectpicker" data-live-search="true">
                                        {!!countries(app_config('Country'))!!}
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Date Format')}}</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="date_format">
                                        <option value="d/m/Y" @if(app_config('DateFormat') == 'd/m/Y') selected="selected" @endif>15/05/2016</option>
                                        <option value="d.m.Y" @if(app_config('DateFormat') == 'd.m.Y') selected="selected" @endif>15.05.2016</option>
                                        <option value="d-m-Y" @if(app_config('DateFormat') == 'd-m-Y') selected="selected" @endif>15-05-2016</option>
                                        <option value="m/d/Y" @if(app_config('DateFormat') == 'm/d/Y') selected="selected" @endif>05/15/2016</option>
                                        <option value="Y/m/d" @if(app_config('DateFormat') == 'Y/m/d') selected="selected" @endif>2016/05/15</option>
                                        <option value="Y-m-d" @if(app_config('DateFormat') == 'Y-m-d') selected="selected" @endif>2016-05-15</option>
                                        <option value="M d Y" @if(app_config('DateFormat') == 'M d Y') selected="selected" @endif>May 15 2016</option>
                                        <option value="d M Y" @if(app_config('DateFormat') == 'd M Y') selected="selected" @endif>15 May 2016</option>
                                        <option value="jS M y" @if(app_config('DateFormat') == 'jS M y') selected="selected" @endif>15th May 16</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="tzone">{{language_data('Timezone')}}</label>
                                    <select name="timezone" class="form-control selectpicker" data-live-search="true">
                                        @foreach (timezoneList() as $value => $label)
                                        <option value="{{$value}}" @if(app_config('Timezone')==$value) selected @endif>{{$label}}</option>
                                       @endforeach

                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Default Language')}}</label>
                                    <select class="form-control selectpicker" name="language">

                                    @foreach($language as $l)
                                        <option value="{{$l->id}}" @if(app_config('Language')==$l->id) selected @endif>{{$l->language}}</option>
                                    @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Current Code')}}</label>
                                    <input type="text" class="form-control" required name="currency_code" value="{{app_config('Currency')}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Current Symbol')}}</label>
                                    <input type="text" class="form-control" required name="currency_symbol" value="{{app_config('CurrencyCode')}}">
                                </div>


                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
    {!! Html::script("assets/js/form-elements-page.js")!!}
@endsection
