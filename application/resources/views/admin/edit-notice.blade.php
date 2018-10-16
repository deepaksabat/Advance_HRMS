@extends('master')


{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.css") !!}
@endsection

@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Edit Notice')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-7">
                    <div class="panel">
                        <div class="panel-body">
                            <form class="" role="form" action="{{url('notice-board/edit-notice-post')}}" method="post">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> {{language_data('Edit Notice')}}</h3>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Notice Title')}}</label>
                                    <input type="text" class="form-control" required="" name="notice_title" value="{{$notice->title}}">
                                </div>

                                <div class="form-group m-none">
                                    <label for="e20">{{language_data('Notice Status')}}</label>
                                    <select name="status" class="form-control selectpicker">
                                        <option value="Published" @if($notice->status=='Published') selected @endif>{{language_data('Published')}}</option>
                                        <option value="Unpublished" @if($notice->status=='Unpublished') selected @endif>{{language_data('Unpublished')}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Description')}}</label>
                                    <textarea class="textarea-wysihtml5 form-control" name="description">{{$notice->description}}</textarea>
                                </div>




                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" value="{{$notice->id}}" name="cmd">
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
    {!! Html::script("assets/libs/wysihtml5x/wysihtml5x-toolbar.min.js")!!}
    {!! Html::script("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.js")!!}
@endsection
