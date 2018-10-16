<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{app_config('AppTitle')}}</title>
    <link rel="icon" type="image/x-icon"  href="<?php echo asset(app_config('AppFav')); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{--Global StyleSheet Start--}}
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
    {!! Html::style("assets/libs/bootstrap/css/bootstrap.min.css") !!}
    {!! Html::style("assets/libs/bootstrap-toggle/css/bootstrap-toggle.min.css") !!}
    {!! Html::style("assets/libs/font-awesome/css/font-awesome.min.css") !!}
    {!! Html::style("assets/libs/alertify/css/alertify.css") !!}
    {!! Html::style("assets/libs/alertify/css/alertify-bootstrap-3.css") !!}
    {!! Html::style("assets/libs/bootstrap-select/css/bootstrap-select.min.css") !!}

    {{--Custom StyleSheet Start--}}

    @yield('style')

    {{--Global StyleSheet End--}}

    {!! Html::style("assets/css/style.css") !!}
    {!! Html::style("assets/css/admin.css") !!}
    {!! Html::style("assets/css/responsive.css") !!}


</head>



<body class="has-left-bar has-top-bar">

<nav id="left-nav" class="left-nav-bar">
    <div class="nav-top-sec">
        <div class="app-logo">
            <img src="<?php echo asset(app_config('AppLogo')); ?>" alt="logo" class="bar-logo">
        </div>

        <a href="#" id="bar-setting" class="bar-setting"><i class="fa fa-bars"></i></a>
    </div>
    <div class="nav-bottom-sec">
        <ul class="left-navigation" id="left-navigation">

            {{--Dashboard--}}
            <li @if(Request::path()== 'employee/dashboard') class="active" @endif><a href="{{url('employee/dashboard')}}"><span class="menu-text">{{language_data('Dashboard')}}</span> <span class="menu-thumb"><i class="fa fa-dashboard"></i></span></a></li>

            @if(menu_access('Attendance'))
            {{--Attendance--}}
            <li @if(Request::path()== 'employee/attendance') class="active" @endif><a href="{{url('employee/attendance')}}"><span class="menu-text">{{language_data('Attendance')}}</span> <span class="menu-thumb"><i class="fa fa-calendar"></i></span></a></li>
            @endif

            @if(menu_access('Leave'))
            {{--Leave--}}
            <li @if(Request::path()== 'employee/leave') class="active" @endif><a href="{{url('employee/leave')}}"><span class="menu-text">{{language_data('Leave')}}</span> <span class="menu-thumb"><i class="fa fa-bed"></i></span></a></li>
            @endif

            @if(menu_access('Holiday'))
            {{--Holiday--}}
            <li @if(Request::path()== 'employee/holiday') class="active" @endif><a href="{{url('employee/holiday')}}"><span class="menu-text">{{language_data('Holiday')}}</span> <span class="menu-thumb"><i class="fa fa-plane"></i></span></a></li>
            @endif

            @if(menu_access('Award'))
            {{--Award--}}
            <li @if(Request::path()== 'employee/award') class="active" @endif><a href="{{url('employee/award')}}"><span class="menu-text">{{language_data('Award')}}</span> <span class="menu-thumb"><i class="fa fa-trophy"></i></span></a></li>
            @endif

            @if(menu_access('Notice Board'))
            {{--Notice Board--}}
            <li @if(Request::path()== 'employee/notice-board') class="active" @endif><a href="{{url('employee/notice-board')}}"><span class="menu-text">{{language_data('Notice Board')}}</span> <span class="menu-thumb"><i class="fa fa-sticky-note"></i></span></a></li>
            @endif

            @if(menu_access('Expense'))
            {{--Expense--}}
            <li @if(Request::path()== 'employee/expense'  OR Request::path()=='employee/expense/edit/'.view_id()) class="active" @endif><a href="{{url('employee/expense')}}"><span class="menu-text">{{language_data('Expense')}}</span> <span class="menu-thumb"><i class="fa fa-bar-chart"></i></span></a></li>
            @endif


            @if(menu_access('Payroll'))
            {{--Loan--}}
            <li @if(Request::path()== 'employee/loan/all'OR Request::path()=='employee/loan/view-details/'.view_id()) class="active" @endif><a href="{{url('employee/loan/all')}}"><span class="menu-text">{{language_data('Loan')}}</span> <span class="menu-thumb"><i class="fa fa-cube"></i></span></a></li>

            {{--Payroll--}}
            <li @if(Request::path()== 'employee/payslip'  OR Request::path()=='employee/payslip/view/'.view_id()) class="active" @endif><a href="{{url('employee/payslip')}}"><span class="menu-text">{{language_data('Payslip')}}</span> <span class="menu-thumb"><i class="fa fa-dollar"></i></span></a></li>
            @endif

            @if(menu_access('Training'))
            {{--Training--}}
            <li @if(Request::path()== 'employee/training' OR Request::path()=='employee/training/view/'.view_id()) class="active" @endif><a href="{{url('employee/training')}}"><span class="menu-text">{{language_data('Training')}}</span> <span class="menu-thumb"><i class="fa fa-graduation-cap"></i></span></a></li>
            @endif

            @if(menu_access('Task'))
            {{--Task--}}
            <li @if(Request::path()== 'employee/task' OR Request::path()=='employee/task/view/'.view_id()) class="active" @endif><a href="{{url('employee/task')}}"><span class="menu-text">{{language_data('Task')}}</span> <span class="menu-thumb"><i class="fa fa-list"></i></span></a></li>
            @endif

            @if(menu_access('Support Tickets'))
            {{--Support Ticket--}}
            <li class="has-sub @if(Request::path()== 'employee/support-tickets/all' OR Request::path()=='employee/support-tickets/create-new' OR Request::path()=='employee/support-tickets/view-ticket/'.view_id()) sub-open init-sub-open @endif">
                <a href="#"><span class="menu-text">{{language_data('Support Tickets')}}</span> <span class="arrow"></span><span class="menu-thumb"><i class="fa fa-envelope"></i></span></a>
                <ul class="sub">
                    <li @if(Request::path()== 'employee/support-tickets/all'  OR Request::path()=='employee/support-tickets/view-ticket/'.view_id()) class="active" @endif><a href={{url('employee/support-tickets/all')}}><span class="menu-text">{{language_data('All Support Tickets')}}</span> <span class="menu-thumb"><i class="fa fa-list"></i></span></a></li>

                    <li @if(Request::path()== 'employee/support-tickets/create-new') class="active" @endif><a href={{url('employee/support-tickets/create-new')}}><span class="menu-text">{{language_data('Create New Ticket')}}</span> <span class="menu-thumb"><i class="fa fa-plus"></i></span></a></li>

                </ul>
            </li>
            @endif
        </ul>
    </div>
</nav>

<main id="wrapper" class="wrapper">

    <div class="top-bar clearfix">
        <ul class="top-info-bar">
            <li class="dropdown bar-notification @if(count(latest_five_employee_leave_application())>0) active @endif">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-bed"></i></a>
                <ul class="dropdown-menu user-dropdown arrow" role="menu">
                    <li class="title">{{language_data('Recent 5 Leave Applications')}}</li>

                    @foreach(latest_five_employee_leave_application() as $l)
                    <li>
                        <a href="{{url('leave/edit/'.$l->id)}}">
                            @if($l->employee_id->avatar!='')
                                <img class="user-thumb" src="<?php echo asset('assets/employee_pic/'.$l->employee_id->avatar); ?>" alt="{{$l->employee_id->fname}} {{$l->employee_id->lname}}">
                            @else
                                <img class="user-thumb" src="<?php echo asset('assets/employee_pic/user.png'); ?>" alt="{{$l->employee_id->fname}} {{$l->employee_id->lname}}">
                            @endif

                            <div class="user-name">{{$l->employee_id->fname}} {{$l->employee_id->lname}}</div>
                        </a>
                    </li>

                    @endforeach

                    <li class="footer"><a href="{{url('employee/leave')}}">{{language_data('See All Applications')}}</a></li>
                </ul>
            </li>

            <li class="dropdown bar-notification @if(count(latest_five_employee_tickets())>0) active @endif">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-envelope"></i></a>
                <ul class="dropdown-menu arrow message-dropdown" role="menu">
                    <li class="title">{{language_data('Recent 5 Pending Tickets')}}</li>
                    @foreach(latest_five_employee_tickets() as $st)
                    <li>
                        <a href="{{url('employee/support-tickets/view-ticket/'.$st->id)}}">
                            <div class="name">{{$st->name}} <span>{{$st->date}}</span></div>
                            <div class="message">{{$st->subject}}</div>
                        </a>
                    </li>

                    @endforeach

                    <li class="footer"><a href="{{url('employee/support-tickets/all')}}">{{language_data('See All Tickets')}}</a></li>
                </ul>
            </li>
        </ul>

        <div class="navbar-right">
            <div class="dropdown user-profile">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <span class="user-info">{{Auth::user()->fname}} {{Auth::user()->lname}}</span>

                    @if(Auth::user()->avatar!='')
                        <img class="user-image" src="<?php echo asset('assets/employee_pic/'.Auth::user()->avatar); ?>" alt="{{Auth::user()->fname}} {{Auth::user()->lname}}">
                    @else
                        <img class="user-image" src="<?php echo asset('assets/employee_pic/user.png'); ?>" alt="{{Auth::user()->fname}} {{Auth::user()->lname}}">
                    @endif

                </a>
                <ul class="dropdown-menu arrow right-arrow" role="menu">
                    <li><a href="{{url('employee/edit-profile')}}"><i class="fa fa-edit"></i>{{language_data('Update Profile')}}</a></li>
                    <li><a href="{{url('employee/change-password')}}"><i class="fa fa-lock"></i>{{language_data('Change Password')}}</a></li>
                    <li class="bg-dark">
                        <a href="{{url('employee/logout')}}" class="clearfix">
                            <span class="pull-left">{{language_data('Logout')}}</span>
                            <span class="pull-right"><i class="fa fa-power-off"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{--Content File Start Here--}}

    @yield('content')

    {{--Content File End Here--}}

    <input type="hidden" id="_url" value="{{url('/')}}">
    <input type="hidden" id="_DatePicker" value="{{app_config('DateFormat')}}">
</main>

{{--Global JavaScript Start--}}
{!! Html::script("assets/libs/jquery-1.10.2.min.js") !!}
{!! Html::script("assets/libs/jquery.slimscroll.min.js") !!}
{!! Html::script("assets/libs/bootstrap/js/bootstrap.min.js") !!}
{!! Html::script("assets/libs/bootstrap-toggle/js/bootstrap-toggle.min.js") !!}
{!! Html::script("assets/libs/alertify/js/alertify.js") !!}
{!! Html::script("assets/libs/bootstrap-select/js/bootstrap-select.min.js") !!}
{!! Html::script("assets/js/scripts.js") !!}
{{--Global JavaScript End--}}

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
        }
    });
</script>

{{--Custom JavaScript Start--}}

@yield('script')

{{--Custom JavaScript End Here--}}
</body>

</html>
