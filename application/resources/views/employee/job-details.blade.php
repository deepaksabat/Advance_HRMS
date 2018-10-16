<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{app_config('AppName')}} - {{$job->position_name->designation}}</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
    {!! Html::style("assets/libs/bootstrap/css/bootstrap.min.css") !!}
    {!! Html::style("assets/libs/bootstrap-toggle/css/bootstrap-toggle.min.css") !!}
    {!! Html::style("assets/libs/font-awesome/css/font-awesome.min.css") !!}
    {!! Html::style("assets/libs/alertify/css/alertify.css") !!}
    {!! Html::style("assets/libs/alertify/css/alertify-bootstrap-3.css") !!}
    {!! Html::style("assets/css/style.css") !!}

</head>
<body class="has-top-bar">

<main id="wrapper" class="wrapper">

    <div class="top-bar">

        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"><i class="fa fa-bars"></i></button>
                <a class="navbar-brand" href="#">
                    <img src="<?php echo asset(app_config('AppLogo')); ?>" alt="logo" class="bar-logo">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{url('/')}}">{{language_data('Home')}}</a></li>
                    <li class="active"><a href="{{url('apply-job')}}">{{language_data('Jobs')}}</a></li>
                </ul>

            </div><!-- /.navbar-collapse -->
        </div>

    </div>

    <section class="wrapper-bottom-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">

                    <h2 class="p-t-30 m-b-30 page-title">{{$job->position_name->designation}}</h2>

                    @include('notification.notify')

                    <!-- Job Card Start -->
                    <div class="panel panel-30">
                        <div class="panel-body p-t-30">
                            <div class="row">

                                <div class="col-md-12">

                                    <div class="article-content">

                                        <div class="content-tight-panel">

                                            <div class="panel p-t-30">
                                                <div class="panel-body">
                                                    <h4 class="m-b-20">{{language_data('Job Summary')}}</h4>
                                                    <ul class="info-list title-space-md">
                                                        <li>
                                                            <span class="info-list-title">{{language_data('Published on')}}</span>
                                                            <span class="info-list-des">{{get_date_format($job->post_date)}}</span>
                                                        </li>
                                                        <li>
                                                            <span class="info-list-title">{{language_data('Number Of Post')}}</span>
                                                            <span class="info-list-des">{{$job->no_position}}</span>
                                                        </li>
                                                        <li>
                                                            <span class="info-list-title">{{language_data('Job Type')}}</span>
                                                            <span class="info-list-des">{{$job->job_type}}</span>
                                                        </li>
                                                        <li>
                                                            <span class="info-list-title">{{language_data('Experience')}}</span>
                                                            <span class="info-list-des">{{$job->experience}}</span>
                                                        </li>
                                                        <li>
                                                            <span class="info-list-title">{{language_data('Age')}}</span>
                                                            <span class="info-list-des">{{$job->age}}</span>
                                                        </li>
                                                        <li>
                                                            <span class="info-list-title">{{language_data('Job Location')}}</span>
                                                            <span class="info-list-des">{{$job->job_location}}</span>
                                                        </li>
                                                        <li>
                                                            <span class="info-list-title">{{language_data('Salary Range')}}</span>
                                                            <span class="info-list-des">{{$job->salary_range}}</span>
                                                        </li>
                                                        <li>
                                                            <span class="info-list-title">{{language_data('Application Deadline')}}</span>
                                                            <span class="info-list-des">{{get_date_format($job->apply_date)}}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>

                                        {!!$job->description!!}


                                        <button class="btn btn-success" data-toggle="modal" data-target="#apply-now">{{language_data('Apply Now')}}</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Job Card End -->


                    <!-- Modal -->
                    <div class="modal fade" id="apply-now" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">{{language_data('Apply For')}} {{$job->position_name->designation}}</h4>
                                </div>
                                <form class="form-some-up" role="form" method="post" action="{{url('apply-job/post-applicant-resume')}}" enctype="multipart/form-data">

                                    <div class="modal-body">


                                        <div class="form-group">
                                            <label>{{language_data('Name')}}</label>
                                            <input type="text" class="form-control" name="name" required="">
                                        </div>

                                        <div class="form-group">
                                            <label>{{language_data('Email')}}</label>
                                            <input type="email" class="form-control" name="email" required="">
                                        </div>

                                        <div class="form-group">
                                            <label>{{language_data('Phone')}}</label>
                                            <input type="text" class="form-control" name="phone" required="">
                                        </div>

                                        <div class="form-group">
                                            <label>{{language_data('Upload Resume')}}</label>
                                            <div class="input-group input-group-file">
                                                <span class="input-group-btn">
                                                    <span class="btn btn-primary btn-file">
                                                        {{language_data('Browse')}} <input type="file" class="form-control" name="resume" required="">
                                                    </span>
                                                </span>
                                                <input type="text" class="form-control" readonly="" >
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type="hidden" value="{{$job->id}}" name="cmd">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">{{language_data('Close')}}</button>
                                        <button type="submit" class="btn btn-primary">{{language_data('Apply')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </section>
</main>

{!! Html::script("assets/libs/jquery-1.10.2.min.js") !!}
{!! Html::script("assets/libs/jquery.slimscroll.min.js") !!}
{!! Html::script("assets/libs/smoothscroll.min.js") !!}
{!! Html::script("assets/libs/bootstrap/js/bootstrap.min.js") !!}
{!! Html::script("assets/libs/bootstrap-toggle/js/bootstrap-toggle.min.js") !!}
{!! Html::script("assets/libs/alertify/js/alertify.js") !!}
{!! Html::script("assets/js/scripts.js") !!}


</body>
</html>
