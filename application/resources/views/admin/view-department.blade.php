@extends('master')

@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('View Department')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-body">



                            <form method="POST" action="{{ url('support-tickets/update-department') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group">
                                    <label for="dname">{{language_data('Department Name')}}</label>
                                    <input type="text" class="form-control" id="dname" name="dname" value="{{$d->name}}">
                                </div>

                                <div class="form-group">
                                    <label for="email">{{language_data('Department Email')}}</label>
                                    <input type="email" class="form-control" id="email" name="email"  value="{{$d->email}}">
                                </div>

                                <div class="form-group">
                                    <label for="show">{{language_data('Show in Client')}}</label>
                                    <select name="show" class="selectpicker form-control">
                                        <option value="Yes" @if($d->show=='Yes') selected @endif>{{language_data('Yes')}}</option>
                                        <option value="No" @if($d->show=='No') selected @endif>{{language_data('No')}}</option>
                                    </select>
                                </div>


                                <div class="hr-line-dashed"></div>
                                <input type="hidden" name="cmd" value="{{$d->id}}">
                                <button type="submit" name="add" class="btn btn-success"><i class="fa fa-edit"></i> {{language_data('Update')}}</button>
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
