@extends('master')

@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Change Password')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-body">
                            <form class="" role="form" action="{{url('user/update-user-password')}}" method="post">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> {{language_data('Change Password')}}</h3>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Current Password')}}</label>
                                    <input type="password" class="form-control" required name="current_password">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('New Password')}}</label>
                                    <input type="password" class="form-control" required name="new_password">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Confirm Password')}}</label>
                                    <input type="password" class="form-control" required name="confirm_password">
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
