<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>{{app_config('AppName')}} - {{language_data('Provident Fund')}}</title>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
{!! Html::style("assets/libs/bootstrap/css/bootstrap.min.css") !!}
{!! Html::style("assets/libs/bootstrap-toggle/css/bootstrap-toggle.min.css") !!}
{!! Html::style("assets/libs/font-awesome/css/font-awesome.min.css") !!}
{!! Html::style("assets/libs/alertify/css/alertify.css") !!}
{!! Html::style("assets/libs/alertify/css/alertify-bootstrap-3.css") !!}
{!! Html::style("assets/css/style.css") !!}

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

            <div class="p-t-30"></div>

            <table width="100%">
                <tbody>
                <tr>
                    <td style="border: 0;  text-align: left" width="62%">
                        <span style="font-size: 18px;"><strong>{{language_data('Provident Fund')}}</strong></span>
                        <br>
                        <span><strong>{{language_data('Date')}}:</strong> {{get_date_format(date('Y-m-d'))}}</span>
                    </td>
                    <td style="border: 0;  text-align: right" width="62%">
                        <div>
                            <img src="<?php echo asset(app_config('AppLogo')); ?>" alt="logo">
                            <div style="height: 15px;"></div>
                            {!!app_config('Address')!!}
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="m-b-20"></div>

            <table width="100%">
                <tbody>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-xs-6">
                                <strong>{{language_data('Employee ID')}}:</strong>
                            </div>
                            <div class="col-xs-6">
                                <span>#{{$payslip->employee_info->employee_code}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <strong>{{language_data('Employee Name')}} :</strong>
                            </div>
                            <div class="col-xs-6">
                                <span>{{$payslip->employee_info->fname}} {{$payslip->employee_info->lname}}</span>
                            </div>
                        </div>

                        @if($payslip->employee_info->phone!='')
                        <div class="row">
                            <div class="col-xs-6">
                                <strong>{{language_data('Phone')}} :</strong>
                            </div>
                            <div class="col-xs-6">
                                <span>{{$payslip->employee_info->phone}}</span>
                            </div>
                        </div>
                        @endif
                    </td>
                    <td class="p-l-100">
                        <table class="table table-condensed table-transparent table-condensed-slim table-bordered">

                            @if($payslip->provident_fund_type=='Fixed Amount')

                            <tr>
                                <td>
                                    <strong>{{language_data('Employee Share')}} :</strong>
                                </td>
                                <td class="text-right">
                                    <span>{{app_config('Currency')}} {{$payslip->employee_share}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>{{language_data('Organization Share')}} :</strong>
                                </td>
                                <td class="text-right">
                                    <span>{{app_config('Currency')}} {{$payslip->organization_share}}</span>
                                </td>
                            </tr>

                            @else

                                <tr>
                                    <td>
                                        <strong>{{language_data('Employee Share')}} :</strong>
                                    </td>
                                    <td class="text-right">
                                        <span>{{$payslip->employee_share}}%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>{{language_data('Organization Share')}} :</strong>
                                    </td>
                                    <td class="text-right">
                                        <span>{{$payslip->organization_share}}%</span>
                                    </td>
                                </tr>

                            @endif



                        </table>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="m-b-20"></div>

            <table class="table table-condensed table-transparent table-condensed-slim table-bordered">

                <tbody>

                <tr>
                    <th width="65%">{{language_data('Item Name')}}</th>
                    <th class="text-right" colspan="3">{{language_data('Total')}}</th>
                </tr>
                @foreach($payroll as $p)
                <tr class="item-row">
                    <td class="description">{{$p->payment_month}}</td>
                    <td align="right" colspan="3">{{app_config('CurrencyCode')}} {{$p->provident_fund}}</td>
                </tr>
                @endforeach


                <tr>
                    <td class="td-b-none"></td>
                    <td align="right" colspan="2" class="td-b-r-none">{{language_data('Total')}} {{language_data('Employee Share')}}</td>
                    <td align="right" class="td-b-l-none">{{app_config('CurrencyCode')}} {{$employee_share}}</td>
                </tr>

                <tr>
                    <td class="td-b-none"></td>
                    <td align="right" colspan="2" class="td-b-r-none"> {{language_data('Organization Share')}}</td>
                    <td align="right" class="td-b-l-none">{{app_config('CurrencyCode')}} {{$organization_share}}</td>
                </tr>

                <tr>
                    <td class="td-b-none"></td>
                    <td align="right" colspan="2" class="td-b-r-none">{{language_data('Grand Total')}}</td>
                    <td align="right" class="td-b-l-none">{{app_config('CurrencyCode')}} {{$payslip->total}}</td>
                </tr>

                </tbody>
            </table>
            <div style="height: 60px"></div>
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