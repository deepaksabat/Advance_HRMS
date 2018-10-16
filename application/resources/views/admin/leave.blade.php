@extends('master')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") !!}
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Leave Application')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')
            <div class="row">

                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Leave Application')}}</h3>
                            <button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#new-leave"><i class="fa fa-plus"></i> {{language_data('New Leave')}}
                            </button>
                            <br>
                        </div>
                        <div class="panel-body p-none">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 5%;">{{language_data('SL')}}#</th>
                                    <th style="width: 10%;">{{language_data('Employee Code')}}</th>
                                    <th style="width: 20%;">{{language_data('Leave Type')}}</th>
                                    <th style="width: 15%;">{{language_data('Leave From')}}</th>
                                    <th style="width: 15%;">{{language_data('Leave To')}}</th>
                                    <th style="width: 15%;">{{language_data('Status')}}</th>
                                    <th style="width: 20%;">{{language_data('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($leave as $d)
                                    <tr>
                                        <td data-label="SL">{{$d->id}}</td>
                                        <td data-label="emoployeCode"><p><a href="{{url('employees/view/'.$d->employee_id->id)}}"> {{$d->employee_id->employee_code}}</a></p></td>
                                        <td data-label="leaveType"><p>{{$d->leave_type->leave}}</p></td>
                                        <td data-label="LeaveFrom"><p>{{get_date_format($d->leave_from)}}</p></td>
                                        <td data-label="LeaveTo"><p>{{get_date_format($d->leave_to)}}</p></td>
                                        @if($d->status=='approved')
                                            <td data-label="Status"><p class="btn btn-success btn-xs">{{language_data('Approved')}}</p></td>
                                        @elseif($d->status=='pending')
                                            <td data-label="Status"><p class="btn btn-warning btn-xs">{{language_data('Pending')}}</p></td>
                                        @else
                                            <td data-label="Status"><p class="btn btn-danger btn-xs">{{language_data('Rejected')}}</p></td>
                                        @endif

                                        <td data-label="Actions">
                                            <a class="btn btn-success btn-xs" href="{{url('leave/edit/'.$d->id)}}"><i class="fa fa-eye"></i> {{language_data('View')}}</a>
                                            <a href="#" class="btn btn-danger btn-xs cdelete" id="{{$d->id}}"><i class="fa fa-trash"></i> {{language_data('Delete')}}</a>
                                        </td>
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>


                        <!-- Modal -->
                        <div class="modal fade" id="new-leave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">{{language_data('Add')}} {{language_data('New Leave')}}</h4>
                                    </div>
                                    <form class="form-some-up" role="form" method="post" action="{{url('leave/post-new-leave')}}">

                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label>{{language_data('Employee')}}</label>
                                                <select name="employee" class="form-control selectpicker" data-live-search="true">
                                                    @foreach($employee as $e)
                                                        <option value="{{$e->id}}">{{$e->fname}} {{$e->lname}}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label>{{language_data('Leave Type')}}</label>
                                                <select name="leave_type" id="e20" class="form-control selectpicker" data-live-search="true">
                                                    @foreach($leave_type as $lt)
                                                        <option value="{{$lt->id}}">{{$lt->leave}}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label>{{language_data('Leave From')}}</label>
                                                <input type="text" class="form-control datePicker" name="leave_from" required="">
                                            </div>

                                            <div class="form-group">
                                                <label>{{language_data('Leave To')}}</label>
                                                <input type="text" class="form-control datePicker" name="leave_to" required="">
                                            </div>

                                            <div class="form-group">
                                                <label>{{language_data('Status')}}</label>
                                                <select class="selectpicker form-control" name="status">
                                                    <option value="approved">{{language_data('Approved')}}</option>
                                                    <option value="pending">{{language_data('Pending')}}</option>
                                                    <option value="rejected">{{language_data('Rejected')}}</option>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label>{{language_data('Leave Reason')}}</label>
                                                <textarea class="form-control" rows="5" name="leave_reason"></textarea>
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
    {!! Html::script("assets/libs/data-table/datatables.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
    {!! Html::script("assets/js/bootbox.min.js")!!}

    <script>
        $(document).ready(function () {
            /*For DataTable*/
            $('.data-table').DataTable();

            /*For Delete Job Info*/
            $(".cdelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/leave/delete-leave-application/" + id;
                    }
                });
            });


        });
    </script>
@endsection
