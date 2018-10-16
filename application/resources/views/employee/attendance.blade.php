@extends('employee')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Attendance')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')

            <div class="row">

                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Attendance')}}</h3>
                        </div>
                        <div class="panel-body p-none">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 15%;">{{language_data('Date')}}</th>
                                    <th style="width: 15%;">{{language_data('Clock In')}}</th>
                                    <th style="width: 15%;">{{language_data('Clock Out')}}</th>
                                    <th style="width: 10%;">{{language_data('Late')}}</th>
                                    <th style="width: 10%;">{{language_data('Early Leaving')}}</th>
                                    <th style="width: 10%;">{{language_data('Overtime')}}</th>
                                    <th style="width: 10%;">{{language_data('Total Work')}}</th>
                                    <th style="width: 15%;">{{language_data('Status')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($attendance as $d)
                                <tr>
                                    <td data-label="Date">{{get_date_format($d->date)}}</td>
                                    <td data-label="Clock_In">{{$d->clock_in}}</td>
                                    <td data-label="Clock_out">{{$d->clock_out}}</td>
                                    <td data-label="Late">{{round($d->late/60,2)}} H</td>
                                    <td data-label="Early_leaving">{{round($d->early_leaving/60,2)}} H</td>
                                    <td data-label="Overtime">{{$d->overtime}} H</td>
                                    <td data-label="Total_Work">{{round($d->total/60,2)+$d->overtime}} H</td>
                                    @if($d->status=='Absent')
                                    <td data-label="Status"><p class="btn btn-danger btn-xs">{{language_data('Absent')}}</p></td>
                                    @elseif($d->status=='Holiday')
                                    <td data-label="Status"><p class="btn btn-complete btn-xs">{{language_data('Holiday')}}</p></td>
                                    @else
                                    <td data-label="Status"><p class="btn btn-success btn-xs">{{language_data('Present')}}</p></td>
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
