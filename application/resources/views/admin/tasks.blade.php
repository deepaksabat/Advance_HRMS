@extends('master')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
    {!! Html::style("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.css") !!}
    {!! Html::style("assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") !!}
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
                            <button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#add-new-task"><i class="fa fa-plus"></i> {{language_data('Add New Task')}}</button>
                            <br>
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
                                            <a class="btn btn-complete btn-xs" href="{{url('task/view/'.$d->id)}}"><i class="fa fa-eye"></i> {{language_data('View')}}</a>
                                            <a class="btn btn-success btn-xs" href="{{url('task/edit/'.$d->id)}}"><i class="fa fa-edit"></i> {{language_data('Edit')}}</a>
                                            <a href="#" class="btn btn-danger btn-xs cdelete" id="{{$d->id}}"><i class="fa fa-trash"></i> {{language_data('Delete')}}</a>
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
            <div class="modal fade" id="add-new-task" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">{{language_data('Add New Task')}}</h4>
                        </div>
                        <form class="form-some-up" role="form" method="post" action="{{url('task/post-new-task')}}">
                            <div class="modal-body">


                                <div class="form-group">
                                    <label>{{language_data('Task Title')}}</label>
                                    <input type="text" class="form-control" required="" name="task_title">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Assign To')}}</label>
                                    <select class="form-control selectpicker" multiple data-live-search="true" name="employee[]">
                                        @foreach($employee as $e)
                                            <option value="{{$e->id}}">{{$e->fname}} {{$e->lname}} ({{$e->employee_code}})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Start Date')}}</label>
                                    <input type="text" class="form-control datePicker" name="start_date">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Due Date')}}</label>
                                    <input type="text" class="form-control datePicker" name="due_date">
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Estimated Hour')}}</label>
                                    <input type="number" class="form-control" name="estimated_hour">
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Progress')}}</label>
                                    <input type="number" class="form-control" name="progress">
                                </div>



                                <div class="form-group m-none">
                                    <label for="e20">{{language_data('Status')}}</label>
                                    <select name="status" class="form-control selectpicker">
                                        <option value="pending">{{language_data('Pending')}}</option>
                                        <option value="started">{{language_data('Started')}}</option>
                                        <option value="completed">{{language_data('Completed')}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Description')}}</label>
                                    <textarea class="textarea-wysihtml5 form-control" name="description"></textarea>
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
    {!! Html::script("assets/libs/moment/moment.min.js")!!}
    {!! Html::script("assets/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js")!!}
    {!! Html::script("assets/libs/wysihtml5x/wysihtml5x-toolbar.min.js")!!}
    {!! Html::script("assets/libs/handlebars/handlebars.runtime.min.js")!!}
    {!! Html::script("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
    {!! Html::script("assets/libs/data-table/datatables.min.js")!!}
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
                        window.location.href = _url + "/task/delete-task/" + id;
                    }
                });
            });


        });
    </script>
@endsection
