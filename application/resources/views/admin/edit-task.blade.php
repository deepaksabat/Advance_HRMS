@extends('master')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.css") !!}
    {!! Html::style("assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Edit Task')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-7">
                    <div class="panel">
                        <div class="panel-body">
                            <form class="" role="form" action="{{url('task/task-edit-post')}}" method="post">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> {{language_data('Edit Task')}}</h3>
                                </div>



                                <div class="form-group">
                                    <label>{{language_data('Task Title')}}</label>
                                    <input type="text" class="form-control" required="" name="task_title" value="{{$task->task}}">
                                </div>



                                <div class="form-group">
                                    <label>{{language_data('Task Members')}}</label>
                                    <br>
                                    @foreach($task_employee as $te)
                                        <span class="label label-success">{{$te->emp_name}}</span>
                                    @endforeach
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
                                    <input type="text" class="form-control datePicker" name="start_date" value="{{$task->start_date}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Due Date')}}</label>
                                    <input type="text" class="form-control datePicker" name="due_date"  value="{{$task->due_date}}">
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Estimated Hour')}}</label>
                                    <input type="number" class="form-control" name="estimated_hour"  value="{{$task->estimated_hour}}">
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Progress')}}</label>
                                    <input type="number" class="form-control" name="progress"  value="{{$task->progress}}">
                                </div>



                                <div class="form-group m-none">
                                    <label for="e20">{{language_data('Status')}}</label>
                                    <select name="status" class="form-control selectpicker">
                                        <option value="pending" @if($task->status=='pending') selected @endif>{{language_data('Pending')}}</option>
                                        <option value="started" @if($task->status=='started') selected @endif>{{language_data('Started')}}</option>
                                        <option value="completed"  @if($task->status=='completed') selected @endif>{{language_data('Completed')}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Description')}}</label>
                                    <textarea class="textarea-wysihtml5 form-control" name="description">{{$task->description}}</textarea>
                                </div>




                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" value="{{$task->id}}" name="cmd">
                                <button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-edit"></i> {{language_data('Update')}} </button>
                            </form>
                        </div>
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
@endsection
