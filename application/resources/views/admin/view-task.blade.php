@extends('master')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Manage Task')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-4">
                    <div class="panel">
                        <div class="panel-body">

                            <div class="panel-heading">
                                <h3 class="panel-title">{{language_data('Task Basic Info')}}</h3>
                            </div>
                            <form class="" role="form" action="{{url('task/task-basic-info-post')}}" method="post">

                                <div class="form-group">
                                    <label>{{language_data('Start Date')}}</label>
                                    <input type="text" class="form-control" readonly value="{{$task->start_date}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Due Date')}}</label>
                                    <input type="text" class="form-control" readonly value="{{$task->due_date}}">
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Estimated Hour')}}</label>
                                    <input type="number" class="form-control" readonly
                                           value="{{$task->estimated_hour}}">
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Progress')}}</label>
                                    <input type="number" class="form-control" name="progress"
                                           value="{{$task->progress}}">
                                </div>


                                <div class="form-group m-none">
                                    <label for="e20">{{language_data('Status')}}</label>
                                    <select name="status" class="form-control selectpicker">
                                        <option value="pending" @if($task->status=='pending') selected @endif>{{language_data('Pending')}}</option>
                                        <option value="started" @if($task->status=='started') selected @endif>{{language_data('Started')}}</option>
                                        <option value="completed"  @if($task->status=='completed') selected @endif>{{language_data('Completed')}}</option>
                                    </select>
                                </div>
                                <br>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" value="{{$task->id}}" name="cmd">
                                <button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-edit"></i> {{language_data('Update')}}</button>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">

                    <div class="panel">

                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Task Management')}}</h3>
                        </div>

                        <div class="p-30 p-t-none p-b-none">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#task_details" aria-controls="home" role="tab" data-toggle="tab">{{language_data('Task Details')}}</a></li>
                                        <li role="presentation"><a href="#task_discussion" aria-controls="profile" role="tab" data-toggle="tab">{{language_data('Task Discussion')}}</a></li>
                                        <li role="presentation"><a href="#task_files" aria-controls="messages" role="tab" data-toggle="tab">{{language_data('Task Files')}}</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content p-20">


                                        {{--Personal Details--}}

                                        <div role="tabpanel" class="tab-pane active" id="task_details">

                                            <div class="form-group">
                                                <label>{{language_data('Task Title')}}</label>
                                                <p> {{$task->task}}</p>
                                            </div>

                                            <div class="form-group">
                                                <label>{{language_data('Task Description')}}</label>
                                                <p>{!!$task->description!!}</p>
                                            </div>


                                            <h3>{{language_data('Task Members')}}:</h3>
                                            <hr>
                                            @foreach($task_employee as $te)
                                                <a href="{{url('employees/view/'.$te->emp_id)}}" class="label label-success">{{$te->emp_name}}</a><br>
                                            @endforeach
                                        </div>


                                        <div role="tabpanel" class="tab-pane" id="task_discussion">
                                            <form role="form" method="post" action="{{url('task/post-task-comments')}}">

                                                <div class="row">
                                                    <div class="form-group">
                                                        <label>{{language_data('Leave Comment')}}</label>
                                                        <textarea class="textarea-wysihtml5 form-control" rows="7" name="comment"></textarea>
                                                    </div>


                                                    <div class="col-md-12">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" value="{{$task->id}}" name="cmd">
                                                        <input type="submit" value="{{language_data('Reply')}}" class="btn btn-success pull-right">

                                                    </div>
                                                </div>

                                            </form>
                                            <br>
                                            <hr>

                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th style="width: 25%;">{{language_data('Member')}}</th>
                                                    <th style="width: 55%;">{{language_data('Comment')}}</th>
                                                    <th style="width: 20%;">{{language_data('Last Update')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($task_comment as $tc)
                                                <tr>
                                                    <td data-label="Member"><p>{{$tc->employee_name->fname}}

                                                            {{--<span class="label label-success"> {{$tc->employee_name->role}}</span>--}}

                                                        </p></td>
                                                    <td data-label="Comment"><p>{{$tc->comment}}</p></td>
                                                    <td data-label="Last Update"><p>{{get_date_format($tc->updated_at)}}</p></td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>

                                        <div role="tabpanel" class="tab-pane" id="task_files">
                                            <form role="form" method="post" action="{{url('task/post-task-files')}}" enctype="multipart/form-data">

                                                <div class="row">
                                                    <div class="form-group">
                                                        <label>{{language_data('File Title')}}</label>
                                                        <input type="text" name="file_title" class="form-control">
                                                    </div>

                                                    <div class="form-group">

                                                        <label>{{language_data('Select File')}}</label>
                                                        <div class="input-group input-group-file">
                                                            <span class="input-group-btn">
                                                                <span class="btn btn-primary btn-file">
                                                                    {{language_data('Browse')}} <input type="file" class="form-control" name="file">
                                                                </span>
                                                            </span>
                                                            <input type="text" class="form-control" readonly="">
                                                        </div>
                                                    </div>


                                                    <div class="col-md-12">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" value="{{$task->id}}" name="cmd">
                                                        <input type="submit" value="{{language_data('Upload')}}" class="btn btn-success pull-right">

                                                    </div>
                                                </div>

                                            </form>
                                            <br>
                                            <hr>

                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th style="width: 20%;">{{language_data('Files')}}</th>
                                                    <th style="width: 20%;">{{language_data('Size')}}</th>
                                                    <th style="width: 20%;">{{language_data('Date')}}</th>
                                                    <th style="width: 20%;">{{language_data('Upload By')}}</th>
                                                    <th style="width: 20%;">{{language_data('Actions')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($task_files as $tf)
                                                    <tr>
                                                        <td data-label="Files"><p>{{$tf->file_title}}</p></td>
                                                        <td data-label="Size"><p>{{round($tf->file_size/1000,2)}} KB</p></td>
                                                        <td data-label="Size"><p>{{get_date_format($tf->updated_at)}}</p></td>
                                                        <td data-label="Member"><p>{{$tf->employee_name->fname}}

                                                                {{--<span class="label label-success"> {{$tf->employee_name->role}}</span>--}}

                                                            </p></td>
                                                        <td data-label="actions">
                                                            <a href="{{url('task/download-file/'.$tf->id)}}" class="btn btn-success btn-xs"><i class="fa fa-download"></i> </a>
                                                            <a href="#" class="btn btn-danger btn-xs tFileDelete" id="{{$tf->id}}"><i class="fa fa-trash"></i></a>
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
                    </div>


                </div>
            </div>
        </div>
    </section>

@endsection

{{--External Style Section--}}
@section('script')
    {!! Html::script("assets/libs/wysihtml5x/wysihtml5x-toolbar.min.js")!!}
    {!! Html::script("assets/libs/handlebars/handlebars.runtime.min.js")!!}
    {!! Html::script("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
    {!! Html::script("assets/js/bootbox.min.js")!!}

    <script>
        $(document).ready(function () {

            /*For Delete Application Info*/
            $(".tFileDelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/task/delete-task-file/" + id;
                    }
                });
            });


        });
    </script>

@endsection
