<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{app_config('AppName')}} - {{language_data('Login')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
    {!! Html::style("assets/libs/bootstrap/css/bootstrap.min.css") !!}
    {!! Html::style("assets/libs/bootstrap-toggle/css/bootstrap-toggle.min.css") !!}
    {!! Html::style("assets/libs/font-awesome/css/font-awesome.min.css") !!}
    {!! Html::style("assets/libs/alertify/css/alertify.css") !!}
    {!! Html::style("assets/libs/alertify/css/alertify-bootstrap-3.css") !!}
    {!! Html::style("assets/css/style.css") !!}
    {!! Html::style("assets/css/admin.css") !!}
    {!! Html::style("assets/css/responsive.css") !!}

</head>
<body>

<main id="wrapper" class="wrapper">

    <a href="{{url('apply-job')}}" class="btn btn-success pull-right m-30">Apply Job</a>
    <div class="container jumbo-container">

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="app-logo-inner text-center">
                    <img src="<?php echo asset(app_config('AppLogo')); ?>" alt="logo" class="bar-logo">
                </div>
                <div class="panel panel-30">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">{{language_data('Sign to your account')}}</h3>
                    </div>
                    <div class="panel-body">
                        <form class="" role="form" method="post" action="{{url('user/get-login')}}">

                            <div class="form-group form-group-default required">
                                <label for="el1">{{language_data('User Name')}}</label>
                                <input type="text" id="el1" class="form-control" required name="user_name">
                            </div>

                            <div class="form-group form-group-default required">
                                <label for="el4">{{language_data('Password')}}</label>
                                <input type="password" id="el4" class="form-control" required name="password">
                            </div>

                            <div class="form-group m-t-20 m-b-20">
                                <div class="coder-checkbox">
                                    <input type="checkbox" checked name="remember">
                                    <span class="co-check-ui"></span>
                                    <label>{{language_data('Remember Me')}}</label>
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-primary btn-block btn-lg" value="{{language_data('Login')}}">

                        </form>
                        <br>
                        @include('notification.notify')

                    </div>
                </div>
                <div class="panel-other-acction">
                    <div class="text-sm text-center">
                        <a href="{{url('forgot-password')}}">{{language_data('Forget Password')}}?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

{!! Html::script("assets/libs/jquery-1.10.2.min.js") !!}
{!! Html::script("assets/libs/jquery.slimscroll.min.js") !!}
{!! Html::script("assets/libs/bootstrap/js/bootstrap.min.js") !!}
{!! Html::script("assets/libs/bootstrap-toggle/js/bootstrap-toggle.min.js") !!}
{!! Html::script("assets/libs/alertify/js/alertify.js") !!}
{!! Html::script("assets/js/scripts.js") !!}


</body>
</html>
