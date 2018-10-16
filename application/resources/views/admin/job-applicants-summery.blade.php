@extends('master')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.css") !!}
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Job Applicants')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')
            <div class="row">

                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Job Applicants')}}</h3>
                        </div>
                        <div class="panel-body p-none">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 5%;">{{language_data('SL')}}#</th>
                                    <th style="width: 15%;">{{language_data('Position')}}</th>
                                    <th style="width: 15%;">{{language_data('Name')}}</th>
                                    <th style="width: 15%;">{{language_data('Email')}}</th>
                                    <th style="width: 10%;">{{language_data('Phone')}}</th>
                                    <th style="width: 10%;">{{language_data('Status')}}</th>
                                    <th style="width: 30%;">{{language_data('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($job_applicants as $d)
                                <tr>
                                    <td data-label="SL">{{$d->id}}</td>
                                    <td data-label="Name"><p>{{\App\Designation::find($d->jobTitle->position)->designation}}</p></td>
                                    <td data-label="Name"><p>{{$d->name}}</p></td>
                                    <td data-label="Username"><p>{{$d->email}}</p></td>
                                    <td data-label="Designation"><p>{{$d->phone}}</p></td>
                                    @if($d->status=='Unread')
                                    <td data-label="Status"><p class="btn btn-warning btn-xs">{{language_data('Unread')}}</p></td>
                                    @elseif($d->status=='Primary Selected')
                                    <td data-label="Status"><p class="btn btn-primary btn-xs">{{language_data('Primary Selected')}}</p></td>
                                    @elseif($d->status=='Call For Interview')
                                    <td data-label="Status"><p class="btn btn-complete btn-xs">{{language_data('Call For Interview')}}</p></td>
                                    @elseif($d->status=='Confirm')
                                    <td data-label="Status"><p class="btn btn-success btn-xs">{{language_data('Confirm')}}</p></td>
                                    @else
                                    <td data-label="Status"><p class="btn btn-danger btn-xs">{{language_data('Rejected')}}</p></td>
                                    @endif
                                    <td data-label="Actions">
                                        <a class="btn btn-complete btn-xs" href="{{url('jobs/download-resume/'.$d->id)}}"><i class="fa fa-download"></i> {{language_data('Resume')}}</a>

                                        <a class="btn btn-success btn-xs" href="#" data-toggle="modal" data-target=".modal_send_sms_{{$d->id}}"><i class="fa fa-mobile-phone"></i> {{language_data('Send SMS')}}</a>
                                        @include('admin.modal-send-sms-applicant')

                                        <a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target=".modal_send_email_{{$d->id}}"><i class="fa fa-envelope"></i> {{language_data('Send Email')}}</a>
                                        @include('admin.modal-send-email-applicant')

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
    {!! Html::script("assets/libs/wysihtml5x/wysihtml5x-toolbar.min.js")!!}
    {!! Html::script("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
    {!! Html::script("assets/libs/data-table/datatables.min.js")!!}
    {!! Html::script("assets/js/bootbox.min.js")!!}

    <script>
        $(document).ready(function () {
            /*For DataTable*/
            $('.data-table').DataTable();

            /*For Delete Application Info*/
            $(".cdelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/jobs/delete-application/" + id;
                    }
                });
            });


        });
    </script>
@endsection
