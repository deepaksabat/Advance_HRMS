<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>{{app_config('AppName')}} - {{language_data('Attendance')}}</title>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<head>
    <style>
        .help-split {
            display: inline-block;
            width: 30%;
        }
    </style>
</head>
<body class="printable-page">

<main id="wrapper" class="wrapper">
    <div class="container container-printable">
        <div class="p-30 p-t-none p-b-none">


            <table class="table data-table table-hover table-ultra-responsive">
                <thead>
                <tr>
                    <th style="width: 17%;">{{language_data('Employee Name')}}</th>
                    <th style="width: 12%;">{{language_data('Date')}}</th>
                    <th style="width: 10%;">{{language_data('Clock In')}}</th>
                    <th style="width: 13%;">{{language_data('Clock Out')}}</th>
                    <th style="width: 7%;">{{language_data('Late')}}</th>
                    <th style="width: 15%;">{{language_data('Early Leaving')}}</th>
                    <th style="width: 5%;">{{language_data('Overtime')}}</th>
                    <th style="width: 10%;">{{language_data('Total Work')}}</th>
                    <th style="width: 10%;">{{language_data('Status')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($attendance as $d)
                    <tr>
                        <td data-label="employee_name">{{$d->employee_info->fname}} {{$d->employee_info->lname}}</td>
                        <td data-label="Date">{{get_date_format($d->date)}}</td>
                        <td data-label="Clock_In">{{$d->clock_in}}</td>
                        <td data-label="Clock_out">{{$d->clock_out}}</td>
                        <td data-label="Late">{{round($d->late/60,2)}} H</td>
                        <td data-label="Early_leaving">{{round($d->early_leaving/60,2)}} H</td>
                        <td data-label="Overtime">{{$d->overtime}} H</td>
                        <td data-label="Total_Work">{{round($d->total/60,2)+$d->overtime}} H</td>
                        @if($d->status=='Absent')
                            <td data-label="Status"><p>{{language_data('Absent')}}</p></td>
                        @elseif($d->status=='Holiday')
                            <td data-label="Status"><p>{{language_data('Holiday')}}</p></td>
                        @else
                            <td data-label="Status"><p>{{language_data('Present')}}</p></td>
                        @endif
                    </tr>

                @endforeach

                </tbody>
            </table>

            <div class="m-b-20"></div>

        </div>
    </div>
</main>


</body>
</html>