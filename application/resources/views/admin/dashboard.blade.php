@extends('master')

@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30"></div>
        <div class="p-15 p-t-none p-b-none m-l-10 m-r-10">
        @include('notification.notify')
        </div>
        <div class="row">

            <div class="col-lg-12">
                <div class="panel-body">
                    <div class="row text-center">

                        <div class="col-sm-3 m-b-15">
                            <div class="z-shad-1">
                                <div class="bg-success text-white p-15 clearfix">
                                    <span class="pull-left font-45 m-l-10"><i class="fa fa-users"></i></span>

                                    <div class="pull-right text-right m-t-15">
                                        <span class="small m-b-5 font-15">{{$employee}} {{language_data('Employees')}}</span>
                                        <br>
                                        <a href="{{url('employees/add')}}" class="btn btn-complete btn-xs text-uppercase">{{language_data('Add New')}}</a>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-sm-3 m-b-15">
                            <div class="z-shad-1">
                                <div class="bg-complete text-white p-15 clearfix">
                                    <span class="pull-left font-45 m-l-10"><i class="fa fa-bed"></i></span>

                                    <div class="pull-right text-right m-t-15">
                                        <span class="small m-b-5 font-15">{{$leave}} {{language_data('Leave Application')}}</span>
                                        <br>
                                        <a href="{{url('leave')}}" class="btn btn-success btn-xs text-uppercase">{{language_data('View All')}}</a>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-sm-3 m-b-15">
                            <div class="z-shad-1">
                                <div class="bg-primary text-white p-15 clearfix">
                                    <span class="pull-left font-45 m-l-10"><i class="fa fa-bar-chart"></i></span>

                                    <div class="pull-right text-right m-t-15">
                                        <span class="small m-b-5 font-15">{{$expense}} {{language_data('Expense Request')}}</span>
                                        <br>
                                        <a href="{{url('expense')}}" class="btn btn-complete btn-xs text-uppercase">{{language_data('View All')}}</a>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-sm-3 m-b-15">
                            <div class="z-shad-1">
                                <div class="bg-complete-darker text-white p-15 clearfix">
                                    <span class="pull-left font-45 m-l-10"><i class="fa fa-envelope"></i></span>

                                    <div class="pull-right text-right m-t-15">
                                        <span class="small m-b-5 font-15">{{$tickets}} {{language_data('Support Tickets')}}</span>
                                        <br>
                                        <a href="{{url('support-tickets/all')}}"
                                           class="btn btn-success btn-xs text-uppercase">{{language_data('View All')}}</a>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>




        <div class="p-15 p-t-none p-b-none">
            <div class="row">

                <div class="col-lg-6">
                    <div class="panel-body">
                        <div class="row">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">{{language_data('Support Tickets')}}</h3>
                                </div>
                                <div class="panel-body p-none">
                                    <div id="supportTickets" style="width:100%; height:400px;"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="panel-body">
                        <div class="row">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">{{language_data('Expense')}}</h3>
                                </div>
                                <div class="panel-body p-none">
                                    <div id="expense" style="width:100%; height:400px;"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="p-15 p-t-none p-b-none">
            <div class="row">

                <div class="col-lg-6">
                    <div class="panel-body">
                        <div class="row">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">{{language_data('Recent')}} {{language_data('Leave Application')}}</h3>
                                </div>
                                <div class="panel-body p-none">
                                    <table class="table table-hover table-ultra-responsive">
                                        <thead>
                                        <tr>
                                            <th style="width: 10px;">{{language_data('SL')}}#</th>
                                            <th style="width: 30px;">{{language_data('Employee')}}</th>
                                            <th style="width: 30px;">{{language_data('Leave Type')}}</th>
                                            <th style="width: 15px;">{{language_data('Leave From')}}</th>
                                            <th style="width: 15px;">{{language_data('Leave To')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($leave_application as $la)
                                            <tr>
                                                <td data-label="SL">
                                                    <p><a href="{{url('leave/edit/'.$la->id)}}">{{$la->id}}</a></p>
                                                </td>
                                                <td data-label="employee">
                                                    <p>
                                                        <a href="{{url('employees/view/'.$la->employee_id->id)}}"> {{$la->employee_id->fname}} {{$la->employee_id->lname}}</a>
                                                    </p>
                                                </td>
                                                <td data-label="leave type">
                                                    <p>{{$la->leave_type->leave}}</p>
                                                </td>
                                                <td data-label="leave from">
                                                    <p>{{get_date_format($la->leave_from)}}</p>
                                                </td>
                                                <td data-label="leave to">
                                                    <p>{{get_date_format($la->leave_to)}}</p>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="panel-body">
                        <div class="row">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">{{language_data('Recent')}} {{language_data('Expense Request')}}</h3>
                                </div>
                                <div class="panel-body p-none">
                                    <table class="table table-hover table-ultra-responsive">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px;">{{language_data('Item Name')}}</th>
                                            <th style="width: 30px;">{{language_data('Purchase By')}}</th>
                                            <th style="width: 20px;">{{language_data('Purchase Date')}}</th>
                                            <th style="width: 20px;">{{language_data('Amount')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($recent_expense as $re)
                                            <tr>
                                                <td data-label="item name">
                                                    <p>
                                                        <a href="{{url('expense/edit/'.$re->id)}}"> {{$re->item_name}}</a>
                                                    </p>
                                                </td>
                                                <td data-label="purchase by">
                                                    <p>
                                                        <a href="{{url('employees/view/'.$re->employee_info->id)}}"> {{$re->employee_info->fname}} {{$re->employee_info->lname}}</a>
                                                    </p>
                                                </td>
                                                <td data-label="purchase date">
                                                    <p>{{get_date_format($re->purchase_date)}}</p>
                                                </td>
                                                <td data-label="amount">
                                                    <p>{{app_config('Currency')}} {{$re->amount}}</p>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="p-15 p-t-none p-b-none">
            <div class="row">

                <div class="col-lg-6">
                    <div class="panel-body">
                        <div class="row">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">{{language_data('Recent')}} {{language_data('Tasks')}}</h3>
                                </div>
                                <div class="panel-body p-none">
                                    <table class="table table-hover table-ultra-responsive">
                                        <thead>
                                        <tr>
                                            <th style="width: 45px;">{{language_data('Task')}}</th>
                                            <th style="width: 20px;">{{language_data('Created Date')}}</th>
                                            <th style="width: 20px;">{{language_data('Due Date')}}</th>
                                            <th style="width: 15px;">{{language_data('Status')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($recent_task as $rt)
                                            <tr>
                                                <td data-label="task">
                                                    <p><a href="{{url('task/view/'.$rt->id)}}"> {{$rt->task}} </a></p>
                                                </td>
                                                <td data-label="CreatedDate"><p>{{get_date_format($rt->start_date)}}</p>
                                                </td>
                                                <td data-label="DueDate"><p>{{get_date_format($rt->due_date)}}</p></td>
                                                @if($rt->status=='completed')
                                                    <td data-label="Status"><p class="btn btn-complete btn-xs">{{language_data('Completed')}}</p>
                                                    </td>
                                                @elseif($rt->status=='pending')
                                                    <td data-label="Status"><p class="btn btn-warning btn-xs">{{language_data('Pending')}}</p>
                                                    </td>
                                                @else
                                                    <td data-label="Status"><p class="btn btn-success btn-xs">{{language_data('Started')}}</p>
                                                    </td>
                                                @endif

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="panel-body">
                        <div class="row">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">{{language_data('Recent')}} {{language_data('Support Tickets')}}</h3>
                                </div>
                                <div class="panel-body p-none">
                                    <table class="table table-hover table-ultra-responsive">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px;">{{language_data('Email')}}</th>
                                            <th style="width: 50px;">{{language_data('Subject')}}</th>
                                            <th style="width: 20px;">{{language_data('Date')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($recent_tickets as $rtic)
                                            <tr>
                                                <td data-label="email">
                                                    <p><a href="{{url('employees/view/'.$rtic->emp_id)}}"> {{$rtic->email}}</a></p>
                                                </td>
                                                <td data-label="subject">
                                                    <p><a href="{{url('support-tickets/view-ticket/'.$rtic->id)}}">{{$rtic->subject}}</a></p>
                                                </td>
                                                <td data-label="date">
                                                    <p>{{get_date_format($rtic->date)}}</p>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>


    </section>

@endsection


{{--External Style Section--}}
@section('script')

    {!! Html::script("assets/js/highcharts.js")!!}

    <script>
        $(document).ready(function () {

            var get_expense = <?php echo $get_expense; ?>;

            var get_expense_data = [
                { month: 'Jan', val: [] },
                { month: 'Feb', val: [] },
                { month: 'Mar', val: [] },
                { month: 'Apr', val: [] },
                { month: 'May', val: [] },
                { month: 'Jun', val: [] },
                { month: 'Jul', val: [] },
                { month: 'Aug', val: [] },
                { month: 'Sep', val: [] },
                { month: 'Oct', val: [] },
                { month: 'Nov', val: [] },
                { month: 'Dec', val: [] }
            ];

            get_expense.forEach( function( item ) {
                get_expense_data[new Date(item.purchase_date).getMonth()].val.push( Number(item.amount) );
            });


            get_expense_data = get_expense_data.map( function( item ) {
                if ( item.val.length > 0 ) {
                    item.val = item.val.reduce(function(a, b) {
                        return a+b;
                    });
                } else {
                    item.val = 0;
                }

                return item;
            });

            var get_expense_months = get_expense_data.map(function(item){
                return item.month;
            });

            var get_expense_amounts = get_expense_data.map(function(item){
                return item.val;
            });


            Highcharts.chart('supportTickets', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: ''
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y}</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y}',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: 'SupportTickets',
                    colorByPoint: true,
                    data: [{
                        name: 'Pending',
                        y: <?php echo $st_pending;?>
                    }, {
                        name: 'Closed',
                        y: <?php echo $st_closed;?>
                    }, {
                        name: 'Customer Reply',
                        y: <?php echo $st_replied; ?>
                    }, {
                        name: 'Answered',
                        y: <?php echo $st_answered; ?>
                    }]
                }]
            });


            Highcharts.chart('expense', {

                title: {
                    text: ''
                },

                credits: {
                    enabled: false
                },

                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },

                yAxis: {
                    title: {
                        text: 'Expense Amount'
                    }
                },
                plotOptions: {
                    series: {
                        dataLabels: {
                            enabled: false,
                            borderRadius: 5,
                            backgroundColor: 'rgba(252, 255, 197, 0.7)',
                            borderWidth: 1,
                            borderColor: '#AAA',
                            y: -6
                        }
                    }
                },

                series: [{
                    name: 'Expense',
                    data: get_expense_amounts
                }]

            });

        });
    </script>
@endsection