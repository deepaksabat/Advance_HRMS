@extends('employee')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
    {!! Html::style("assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Support Tickets')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')

            <div class="row">

                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Support Tickets')}}</h3>
                        </div>
                        <div class="panel-body p-none">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{language_data('Email')}}</th>
                                    <th>{{language_data('Subject')}}</th>
                                    <th>{{language_data('Date')}}</th>
                                    <th>{{language_data('Status')}}</th>
                                    <th class="text-right">{{language_data('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($st as $in)
                                    <tr>
                                        <td><a href="{{url('employee/support-tickets/view-ticket/'.$in->id)}}">{{$in->id}}</a> </td>
                                        <td>{{$in->email}}</td>
                                        <td>{{$in->subject}}</td>
                                        <td>{{get_date_format($in->date)}}</td>
                                        <td>
                                            @if($in->status=='Pending')
                                                <span class="label label-danger">{{language_data('Pending')}}</span>
                                            @elseif($in->status=='Answered')
                                                <span class="label label-success">{{language_data('Answered')}}</span>
                                            @elseif($in->status=='Customer Reply')
                                                <span class="label label-info">{{language_data('Customer Reply')}}</span>
                                            @else
                                                <span class="label label-primary">{{language_data('Closed')}}</span>
                                            @endif
                                        </td>

                                        <td class="text-right">
                                            <a href="{{url('employee/support-tickets/view-ticket/'.$in->id)}}" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> {{language_data('View')}}</a>
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
        $(document).ready(function () {

            /*For DataTable*/
            $('.data-table').DataTable();
        });
    </script>


@endsection
