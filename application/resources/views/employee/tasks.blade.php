@extends('employee')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Task List')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')
            <div class="row">

                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Task List')}}</h3>
                        </div>
                        <div class="panel-body p-none">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 5%;">{{language_data('SL')}}#</th>
                                    <th style="width: 25%;">{{language_data('Task')}}</th>
                                    <th style="width: 15%;">{{language_data('Created Date')}}</th>
                                    <th style="width: 15%;">{{language_data('Due Date')}}</th>
                                    <th style="width: 15%;">{{language_data('Status')}}</th>
                                    <th style="width: 25%;" class="text-right">{{language_data('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($task as $d)
                                    <tr>
                                        <td data-label="SL">{{$d->id}}</td>
                                        <td data-label="task"><p>{{$d->task}}</p></td>
                                        <td data-label="CreatedDate"><p>{{get_date_format($d->start_date)}}</p></td>
                                        <td data-label="DueDate"><p>{{get_date_format($d->due_date)}}</p></td>
                                        @if($d->status=='completed')
                                            <td data-label="Status"><p class="btn btn-complete btn-xs">{{language_data('Completed')}}</p></td>
                                        @elseif($d->status=='pending')
                                            <td data-label="Status"><p class="btn btn-warning btn-xs">{{language_data('Pending')}}</p></td>
                                        @else
                                            <td data-label="Status"><p class="btn btn-success btn-xs">{{language_data('Started')}}</p></td>
                                        @endif

                                        <td data-label="Actions" class="text-right">
                                            <a class="btn btn-complete btn-xs" href="{{url('employee/task/view/'.$d->id)}}"><i class="fa fa-eye"></i> {{language_data('View')}}</a>
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
    {!! Html::script("assets/js/form-elements-page.js")!!}
    {!! Html::script("assets/libs/data-table/datatables.min.js")!!}

    <script>
        $(document).ready(function () {
            /*For DataTable*/
            $('.data-table').DataTable();
        });
    </script>
@endsection
