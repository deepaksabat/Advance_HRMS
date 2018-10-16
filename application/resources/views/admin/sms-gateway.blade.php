@extends('master')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('SMS Gateways')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')
            <div class="row">

                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('SMS Gateways')}}</h3>
                        </div>
                        <div class="panel-body p-none">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 15%;">{{language_data('SL')}}#</th>
                                    <th style="width: 40%;">{{language_data('Gateway Name')}}</th>
                                    <th style="width: 20%;">{{language_data('Status')}}</th>
                                    <th style="width: 25%;">{{language_data('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sms_gateway as $sg)
                                    <tr>
                                        <td data-label="SL">{{$sg->id}}</td>
                                        <td data-label="Gateway Name"><p><a href="{{url('settings/sms-gateways-manage/'.$sg->id)}}"> {{$sg->name}}</a></p></td>
                                        @if($sg->status=='Active')
                                            <td data-label="Status"><p class="btn btn-success btn-xs">{{language_data('Active')}}</p></td>
                                        @else
                                            <td data-label="Status"><p class="btn btn-warning btn-xs">{{language_data('Inactive')}}</p></td>
                                        @endif
                                        <td data-label="Actions">
                                            <a class="btn btn-success btn-xs"
                                               href="{{url('settings/sms-gateways-manage/'.$sg->id)}}"><i class="fa fa-edit"></i> {{language_data('Manage')}}</a>
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
            $('.data-table').DataTable();
        });
    </script>
@endsection
