@extends('master')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.css") !!}
@endsection


@section('content')

<section class="wrapper-bottom-sec">
			<div class="p-30">
				<div class="row">
					<div class="col-sm-8">
						<h2 class="page-title p-b-15">{{language_data('Salary Statement')}}</h2>
					</div>
					<div class="col-sm-4 text-right">
						<a href="{{url('reports/print-salary-statement/'.$cmd.'/'.$date_from.'/'.$date_to)}}" target="_blank" class="btn btn-success btn-animated from-left fa fa-print"><span>{{language_data('Print Payslip')}}</span></a>

						<a href="{{url('reports/pdf-salary-statement/'.$cmd.'/'.$date_from.'/'.$date_to)}}" target="_blank" class="btn btn-info btn-animated from-left fa fa-file-pdf-o"><span>{{language_data('Generate PDF')}}</span></a>

						<button  data-toggle="modal" data-target="#send_sms" class="btn btn-complete btn-animated from-left fa fa-mobile-phone"><span>{{language_data('Send SMS')}}</span></button>

						<button  data-toggle="modal" data-target="#send_email" class="btn btn-primary btn-animated from-left fa fa-envelope"><span>{{language_data('Send Email')}}</span></button>


					</div>
				</div>
			</div>
			<div class="p-30 p-t-none p-b-none">

				<div class="panel">
					<div class="panel-heading p-b-none">
						<h3>{{language_data('Salary Statement')}}<br><small>{{language_data('Salary Statement')}} {{language_data('For')}}: {{$payslip->employee_info->fname}} {{$payslip->employee_info->lname}}</small></h3>
					</div>
					<div class="panel-body p-none m-b-10">
						<table class="table table-no-border table-condensed">
							<tbody>
								<tr>
									<td><strong class="help-split">{{language_data('Employee ID')}}:</strong>#{{$payslip->employee_info->employee_code}}</td>
									<td><strong class="help-split">{{language_data('Employee Name')}}:</strong>{{$payslip->employee_info->fname}} {{$payslip->employee_info->lname}}</td>
									<td><strong class="help-split">{{language_data('Date From')}}:</strong>{{get_date_format($date_from)}}</td>
								</tr>
								<tr>
									<td><strong class="help-split">{{language_data('Phone')}}:</strong>{{$payslip->employee_info->phone}}</td>
									<td><strong class="help-split">{{language_data('Joining Date')}}:</strong>{{get_date_format($payslip->employee_info->doj)}}</td>
									<td><strong class="help-split">{{language_data('Date To')}}:</strong>{{get_date_format($date_to)}}</td>
								</tr>
								<tr>
									<td><strong class="help-split">{{language_data('Department')}}:</strong>{{$payslip->department_name->department}}</td>
									<td><strong class="help-split">{{language_data('Designation')}}:</strong>{{$payslip->designation_name->designation}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>


			<div class="row">
				<div class="col-sm-6">
					<div class="panel">
						<div class="panel-heading p-b-none">
							<h4 class="m-b-10"><strong>{{language_data('Payment Details')}}</strong></h4>
						</div>
						<div class="panel-body p-none">
							<table class="table table-condensed">
								<tbody>
                                @foreach($payroll as $p)
                                    <tr>
										<td>
                                            <strong>{{$p->payment_month}}:</strong> <span class="pull-right">{{app_config('Currency')}} {{$p->total_salary}}</span>
                                        </td>
									</tr>
                                @endforeach

								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="panel">
						<div class="panel-heading p-b-none">
							<h4 class="m-b-10"><strong>{{language_data('Earning')}}</strong></h4>
						</div>
						<div class="panel-body p-none">
							<table class="table table-condensed">
								<tbody>
									<tr>
										<td><strong>{{language_data('Net Salary')}}:</strong> <span class="pull-right">{{app_config('Currency')}} {{$net_salary}}</span></td>
									</tr>
									<tr>
										<td><strong>{{language_data('Overtime Amount')}}:</strong> <span class="pull-right">{{app_config('Currency')}} {{$over_time}}</span></td>
									</tr>
									<tr>
										<td><strong>{{language_data('TAX')}}:</strong> <span class="pull-right">{{app_config('Currency')}} {{$tax}}</span></td>
									</tr>
									<tr>
										<td><strong>{{language_data('Provident Fund')}}:</strong> <span class="pull-right">{{app_config('Currency')}} {{$provident_fund}}</span></td>
									</tr>
									<tr>
										<td><strong>{{language_data('Loan')}}:</strong> <span class="pull-right">{{app_config('Currency')}} {{str_replace('.00','',$loan)}}</span></td>
									</tr>
									<tr>
										<td class="td-highlighted"><strong>{{language_data('Grand Total')}}:</strong> <span class="pull-right"><strong>{{app_config('Currency')}} {{$total_salary}}</strong></span></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>



            <!-- Modal -->
            <div class="modal fade" id="send_sms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">{{language_data('Send SMS')}}</h4>
                        </div>
                        <form class="form-some-up" role="form" method="post" action="{{url('reports/send-sms-salary-statement')}}">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>{{language_data('Phone')}}</label>
                                    <input type="text" class="form-control" readonly required="" name="phone" value="{{$payslip->employee_info->phone}}">
                                </div>
                                <div class="form-group">
                                    <label>{{language_data('Message')}}</label>
                                    <textarea name="message" class="form-control" rows="8">
                                    {{language_data('Date')}}: {{get_date_format($date_from)}} - {{get_date_format($date_to)}}
                                    {{language_data('Net Salary')}}:{{app_config('CurrencyCode')}} {{$net_salary}}
                                    {{language_data('Overtime Amount')}} : {{app_config('CurrencyCode')}} {{$over_time}}
                                    {{language_data('Tax')}} : {{app_config('CurrencyCode')}} {{$tax}}
                                    {{language_data('Provident Fund')}} : {{app_config('CurrencyCode')}} {{$provident_fund}}
                                    {{language_data('Loan')}} : {{app_config('CurrencyCode')}} {{str_replace('.00','',$loan)}}
                                    {{language_data('Grand Total')}} : {{app_config('CurrencyCode')}} {{$total_salary}}
                                    </textarea>
                                </div>
                            </div>


                            <div class="modal-footer">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button type="button" class="btn btn-default" data-dismiss="modal">{{language_data('Close')}}</button>
                                <button type="submit" class="btn btn-primary">{{language_data('Send')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="send_email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">{{language_data('Send Email')}}</h4>
                        </div>
                        <form class="form-some-up" role="form" method="post" action="{{url('reports/send-email-salary-statement')}}">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>{{language_data('Email')}}</label>
                                    <input type="text" class="form-control" readonly required="" name="email" value="{{$payslip->employee_info->email}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Subject')}}</label>
                                    <input type="text" class="form-control" required="" name="subject" value="{{language_data('Salary Statement')}}">
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Message')}}</label>
                                    <textarea name="message" class="textarea-wysihtml5 form-control" rows="8">
                                    {{language_data('Date')}}: {{get_date_format($date_from)}} - {{get_date_format($date_to)}}
                                    <br>
                                    {{language_data('Net Salary')}}:{{app_config('CurrencyCode')}} {{$net_salary}}
                                    <br>
                                    {{language_data('Overtime Amount')}} : {{app_config('CurrencyCode')}} {{$over_time}}
                                    <br>
                                    {{language_data('Tax')}} : {{app_config('CurrencyCode')}} {{$tax}}
                                    <br>
                                    {{language_data('Provident Fund')}} : {{app_config('CurrencyCode')}} {{$provident_fund}}
                                    <br>
                                    {{language_data('Loan')}} : {{app_config('CurrencyCode')}} {{str_replace('.00','',$loan)}}
                                    <br>
                                    {{language_data('Grand Total')}} : {{app_config('CurrencyCode')}} {{$total_salary}}
                                    </textarea>
                                </div>
                            </div>


                            <div class="modal-footer">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="cmd" value="{{$payslip->employee_info->id}}">
                                <button type="button" class="btn btn-default" data-dismiss="modal">{{language_data('Close')}}</button>
                                <button type="submit" class="btn btn-primary">{{language_data('Send')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>





                </div>
		</section>


@endsection


{{--External Style Section--}}
@section('script')
    {!! Html::script("assets/libs/handlebars/handlebars.runtime.min.js")!!}
    {!! Html::script("assets/libs/wysihtml5x/wysihtml5x-toolbar.min.js")!!}
    {!! Html::script("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
@endsection
