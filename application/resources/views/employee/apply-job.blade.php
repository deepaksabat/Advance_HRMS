<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{app_config('AppName')}} - {{language_data('All Jobs')}}</title>
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
                <div class="col-md-8 col-md-offset-2">

                    <h2 class="p-t-30 m-b-30 page-title">{{language_data('All Jobs')}}</h2>
                    @foreach($jobs as $j)
                    <!-- Job Card Start -->
                    <div class="panel cp-clickable cp-linkable panel-hoverd panel-30">

                        <!-- Link the whole area -->
                        <a href="{{url('apply-job/details/'.$j->id)}}" class="cp-area-link">{{$j->position_name->designation}}</a>

                        <div class="panel-heading">
                            <h3 class="panel-title panel-title-15"><a href="{{url('apply-job/details/'.$j->id)}}">{{$j->position_name->designation}}</a></h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <!-- Job Meta Information -->
                                <div class="col-lg-5 col-md-12">
                                    <ul class="info-list title-space-md">
                                        <li><span class="info-list-title">{{language_data('Number Of Post')}}</span><span class="info-list-des">{{$j->no_position}}</span></li>
                                        <li><span class="info-list-title">{{language_data('Experience')}}</span><span class="info-list-des">{{$j->experience}}</span></li>
                                        <li><span class="info-list-title">{{language_data('Deadline')}}</span><span class="info-list-des">{{get_date_format($j->apply_date)}}</span></li>
                                    </ul>
                                </div>

                                <!-- Extra Space on the small screens -->
                                <div class="col-md-12 m-b-10 hidden-lg"></div>

                                <!-- Job Short Descrition -->
                                <div class="col-lg-7 col-md-12">
                                    <div class="last-child-m-b-n">
                                        <p>{{$j->short_description}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Job Card End -->
                    @endforeach

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
