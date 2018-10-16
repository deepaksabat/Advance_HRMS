@extends('master')


{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Manage Email Template')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-7">
                    <div class="panel">
                        <div class="panel-body">
                            <form method="POST" action="{{ url('settings/email-templates-update') }}">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> {{language_data('Manage Email Template')}}</h3>
                                </div>


                                <div class="form-group">
                                    <label for="tplname">{{language_data('Template Name')}}</label>
                                    <input type="text" class="form-control" id="name" name="name" disabled value="{{$d->tplname}}">
                                </div>

                                <div class="form-group">
                                    <label for="subject">{{language_data('Subject')}}</label>
                                    <input type="text" class="form-control" id="subject" name="subject" value="{{$d->subject}}">
                                </div>

                                <div class="form-group">
                                    <label for="Status">{{language_data('Status')}}</label>
                                    <select name="status" class="selectpicker form-control">
                                        <option value="1" @if($d->status=='1') selected @endif>{{language_data('Active')}}</option>
                                        <option value="0" @if($d->status=='0') selected @endif>{{language_data('Inactive')}}</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="message">{{language_data('Message')}}</label>
                                    <textarea class="textarea-wysihtml5 form-control" name="message">{!! $d->message !!}</textarea>
                                </div>



                                <input type="hidden" value="{{$d->id}}" name="cmd">
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
