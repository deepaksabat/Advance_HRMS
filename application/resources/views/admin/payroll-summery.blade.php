@extends('master')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
    {!! Html::style("assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Employee Payroll Summery')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')
            <div class="row">

                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Employee Payroll Summery')}}</h3>
                        </div>
                        <div class="panel-body p-none">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 10%;">{{language_data('Code')}}#</th>
                                    <th style="width: 20%;">{{language_data('Name')}}</th>
                                    <th style="width: 20%;">{{language_data('Username')}}</th>
                                    <th style="width: 20%;">{{language_data('Designation')}}</th>
                                    <th style="width: 30%;">{{language_data('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $d)
                                <tr>
                                    <td data-label="SL">{{$d->employee_code}}</td>
                                    <td data-label="Name"><p>{{$d->fname}} {{$d->lname}}</p></td>
                                    <td data-label="Username"><p>{{$d->user_name}}</p></td>
                                    <td data-label="Designation"><p>{{$d->designation_name->designation}}</p></td>

                                    <td data-label="Actions">

                                        <a class="btn btn-success btn-xs" href="#" data-toggle="modal" data-target=".modal_get_salary_statement_{{$d->id}}"><i class="fa fa-line-chart"></i> {{language_data('Salary Statement')}}</a>
                                        @include('admin.modal-salary-statement')

                                        <a class="btn btn-complete btn-xs" href="{{url('reports/employee-summery/'.$d->id)}}" ><i class="fa fa-bar-chart"></i> {{language_data('Employee Summery')}}</a>
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
    </section>

@endsection

{{--External Style Section--}}
@section('script')
    {!! Html::script("assets/libs/handlebars/handlebars.runtime.min.js")!!}
    {!! Html::script("assets/libs/moment/moment.min.js")!!}
    {!! Html::script("assets/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
    {!! Html::script("assets/libs/data-table/datatables.min.js")!!}
    {!! Html::script("assets/js/bootbox.min.js")!!}

    <script>
        $(document).ready(function(){
            $('.data-table').DataTable();
        });
    </script>
@endsection
