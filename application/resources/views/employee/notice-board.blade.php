@extends('employee')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Notice Board')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')
            <div class="row">

                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Notice Board')}}</h3>
                        </div>
                        <div class="panel-body p-none">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 5%;">{{language_data('SL')}}#</th>
                                    <th style="width: 50%;">{{language_data('Title')}}</th>
                                    <th style="width: 25%;">{{language_data('Published Date')}}</th>
                                    <th style="width: 20%;">{{language_data('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($notice as $d)
                                    <tr>
                                        <td data-label="SL">{{$d->id}}</td>
                                        <td data-label="Title"><p>{{$d->title}}</p></td>
                                        <td data-label="Date"><p>{{get_date_format($d->updated_at)}}</p></td>
                                        <td data-label="Actions">

                                            <a class="btn btn-success btn-xs" href="#" data-toggle="modal" data-target=".modal_view_notice_{{$d->id}}"><i class="fa fa-eye"></i> {{language_data('View')}}</a>
                                            @include('employee.modal-view-notice')
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
    {!! Html::script("assets/libs/data-table/datatables.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
    <script>
        $(document).ready(function () {
            /*For DataTable*/
            $('.data-table').DataTable();
        });
    </script>
@endsection
