@extends('master')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.css") !!}
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Provident Fund')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')
            <div class="row">

                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Provident Fund')}}</h3>
                            <button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#add-provident-fund"><i class="fa fa-plus"></i> {{language_data('Add')}} {{language_data('Provident Fund')}}</button>
                            <br>
                        </div>
                        <div class="panel-body p-none">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 15%;">{{language_data('Employee Name')}}</th>
                                    <th style="width: 20%;">{{language_data('Provident Fund Type')}}</th>
                                    <th style="width: 15%;">{{language_data('Employee Share')}}</th>
                                    <th style="width: 15%;">{{language_data('Organization Share')}}</th>
                                    <th style="width: 10%;">{{language_data('Status')}}</th>
                                    <th style="width: 25%;" >{{language_data('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pfund as $pf)
                                <tr>
                                    <td data-label="Employee Name"><a href="{{url('employees/view/'.$pf->emp_id)}}">{{$pf->employee_info->fname}} {{$pf->employee_info->lname}}</a> </td>
                                    <td data-label="Fund Type"><p>{{$pf->provident_fund_type}}</p></td>
                                    <td data-label="Employee Share">
                                        <p>
                                            @if($pf->provident_fund_type=='Fixed Amount')
                                           {{app_config('CurrencyCode')}} {{$pf->employee_share}}
                                            @else
                                             {{$pf->employee_share}} %
                                            @endif
                                        </p>
                                    </td>
                                    <td data-label="Organization Share">
                                        <p>
                                            @if($pf->provident_fund_type=='Fixed Amount')
                                                {{app_config('CurrencyCode')}} {{$pf->organization_share}}
                                            @else
                                                {{$pf->organization_share}} %
                                            @endif
                                        </p>
                                    </td>
                                    @if($pf->status=='Paid')
                                    <td data-label="Status"><p class="btn btn-success btn-xs">{{language_data('Paid')}}</p></td>
                                    @else
                                    <td data-label="Status"><p class="btn btn-warning btn-xs">{{language_data('Unpaid')}}</p></td>
                                    @endif
                                    <td data-label="Actions">
                                    @if($pf->status=='Paid')
                                        <a href="{{url('provident-fund/view-payslip/'.$pf->id)}}" class="btn btn-complete btn-xs"><i class="fa fa-print"></i> {{language_data('Payslip')}}</a>
                                    @else
                                        @if($pf->total!=0)
                                            <a class="btn btn-complete btn-xs" href="#" data-toggle="modal" data-target=".modal_make_payment_pf_{{$pf->id}}"><i class="fa fa-edit"></i> {{language_data('Make Payment')}}</a>
                                            @include('admin.modal-make-provident-fund-payment')
                                        @endif
                                    @endif

                                        <a class="btn btn-success btn-xs" href="{{url('provident-fund/view-details/'.$pf->id)}}" ><i class="fa fa-edit"></i> {{language_data('Edit')}}</a>


                                        <a href="#" class="btn btn-danger btn-xs cdelete" id="{{$pf->id}}"><i class="fa fa-trash"></i> {{language_data('Delete')}}</a>
                                    </td>
                                </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>



            <!-- Modal -->
            <div class="modal fade" id="add-provident-fund" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">{{language_data('Add')}} {{language_data('Provident Fund')}}</h4>
                        </div>
                        <form class="form-some-up" role="form" method="post" action="{{url('provident-fund/post-new-provident-fund')}}">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label>{{language_data('Employee Name')}}</label>
                                    <select name="emp_name" class="form-control selectpicker" data-live-search="true">
                                        @foreach($employee as $e)
                                            <option value="{{$e->id}}">{{$e->fname}} {{$e->lname}} ({{$e->employee_code}})</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group m-none">
                                    <label for="e20">{{language_data('Provident Fund Type')}}</label>
                                    <select name="fund_type" class="form-control selectpicker fundType">
                                        <option value="Fixed Amount" selected>Fixed Amount</option>
                                        <option value="Percentage of Basic Salary">Percentage of Basic Salary</option>
                                    </select>
                                </div>

                                <div class="show-fixed-amount">

                                    <div class="form-group">
                                        <label for="fname">{{language_data('Employee Share')}}</label>
                                        <span class="help">({{language_data('Amount')}})</span>
                                        <input type="text" class="form-control" name="emp_share_fixed">
                                    </div>

                                    <div class="form-group">
                                        <label for="fname">{{language_data('Organization Share')}}</label>
                                        <span class="help">({{language_data('Amount')}})</span>
                                        <input type="text" class="form-control" name="org_share_fixed">
                                    </div>

                                </div>


                                <div class="show-basic-salary">

                                    <div class="form-group">
                                        <label for="fname">{{language_data('Employee Share')}}</label>
                                        <span class="help">(%)</span>
                                        <input type="text" class="form-control" name="emp_share_per">
                                    </div>

                                    <div class="form-group">
                                        <label for="fname">{{language_data('Organization Share')}}</label>
                                        <span class="help">(%)</span>
                                        <input type="text" class="form-control" name="org_share_per">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Description')}}</label>
                                    <textarea class="form-control textarea-wysihtml5" name="description"></textarea>
                                </div>



                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button type="button" class="btn btn-default" data-dismiss="modal">{{language_data('Close')}}</button>
                                <button type="submit" class="btn btn-primary">{{language_data('Add')}}</button>
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
    {!! Html::script("assets/libs/data-table/datatables.min.js")!!}
    {!! Html::script("assets/js/bootbox.min.js")!!}

    <script>
        $(document).ready(function(){
            $('.data-table').DataTable();

            var FundType = $('.fundType');
            if (FundType.val() == 'Fixed Amount') {
                $('.show-basic-salary').hide();
            }

            FundType.on('change', function () {
                var value = $(this).val();
                if (value == 'Percentage of Basic Salary') {
                    $('.show-basic-salary').show();
                    $('.show-fixed-amount').hide();
                } else {
                    $('.show-basic-salary').hide();
                    $('.show-fixed-amount').show();
                }

            });


            /*For Delete Designation*/
            $(".cdelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/provident-fund/delete/" + id;
                    }
                });
            });


        });
    </script>
@endsection
