@extends('employee')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Employee Training')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')
            <div class="row">

                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Employee Training')}}</h3>
                        </div>
                        <div class="panel-body p-none">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 20%;">{{language_data('Training Type')}}</th>
                                    <th style="width: 20%;">{{language_data('Training')}} {{language_data('Subject')}}</th>
                                    <th style="width: 25%;">{{language_data('Title')}}</th>
                                    <th style="width: 10%;">{{language_data('Training From')}}</th>
                                    <th style="width: 10%;">{{language_data('Training To')}}</th>
                                    <th style="width: 15%;" class="text-right">{{language_data('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($emp_training as $et)
                                    <tr>
                                        <td data-label="Training Type"><p>{{$et->training_type}}</p></td>
                                        <td data-label="Training Subject"><p>{{$et->training_subject}}</p></td>
                                        <td data-label="Title"><p>{{$et->title}}</p></td>
                                        <td data-label="Training From"><p>{{get_date_format($et->training_from)}}</p></td>
                                        <td data-label="Training To"><p>{{get_date_format($et->training_to)}}</p></td>
                                        <td data-label="Actions" class="text-right">
                                            <a class="btn btn-success btn-xs" href="{{url('employee/training/view/'.$et->id)}}"><i class="fa fa-eye"></i> {{language_data('View')}}</a>
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
    {!! Html::script("assets/js/form-elements-page.js")!!}
    {!! Html::script("assets/libs/data-table/datatables.min.js")!!}

    <script>
        $(document).ready(function () {
            /*For DataTable*/
            $('.data-table').DataTable();
        });
    </script>
@endsection
