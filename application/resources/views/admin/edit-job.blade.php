@extends('master')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.css") !!}
    {!! Html::style("assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Edit Job')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-7">
                    <div class="panel">
                        <div class="panel-body">
                            <form class="" role="form" action="{{url('jobs/job-edit-post')}}" method="post">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> {{language_data('Edit Job')}}</h3>
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Position')}}</label>
                                    <span class="help">e.g. "Software Engineer"</span>
                                    <select name="position" id="e20" class="form-control selectpicker"
                                            data-live-search="true">
                                        @foreach($designation as $des)
                                            <option value="{{$des->id}}" @if($job->position == $des->id) selected @endif>{{$des->designation}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Number Of Post')}}</label>
                                    <span class="help">e.g. "2"</span>
                                    <input type="number" class="form-control" required="" name="no_position" value="{{$job->no_position}}">
                                </div>



                                <div class="form-group">
                                    <label>{{language_data('Job Type')}}</label>
                                    <select name="job_type" class="form-control selectpicker">
                                        <option value="Contractual" @if($job->job_type=='Contractual') selected @endif>{{language_data('Contractual')}}</option>
                                        <option value="Part Time" @if($job->job_type=='Part Time') selected @endif>{{language_data('Part Time')}}</option>
                                        <option value="Full Time" @if($job->job_type=='Full Time') selected @endif>{{language_data('Full Time')}}</option>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Experience')}}</label>
                                    <input type="text" class="form-control" name="experience" value="{{$job->experience}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Age')}}</label>
                                    <input type="text" class="form-control" name="age" value="{{$job->age}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Job Location')}}</label>
                                    <input type="text" class="form-control" name="job_location" value="{{$job->job_location}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Salary Range')}}</label>
                                    <input type="text" class="form-control" name="salary_range" value="{{$job->salary_range}}">
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Post Date')}}</label>
                                    <input type="text" class="form-control datePicker" name="post_date" required="" value="{{$job->post_date}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Last Date To Apply')}}</label>
                                    <input type="text" class="form-control datePicker" name="apply_date" value="{{$job->apply_date}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Close Date')}}</label>
                                    <input type="text" class="form-control datePicker" name="close_date" value="{{$job->close_date}}">
                                </div>

                                <div class="form-group m-none">
                                    <label for="e20">{{language_data('Status')}}</label>
                                    <select name="status" class="form-control selectpicker">
                                        <option value="opening" @if($job->status == 'opening') selected @endif>Open</option>
                                        <option value="closed" @if($job->status == 'closed') selected @endif>Closed</option>
                                        <option value="drafted" @if($job->status == 'drafted') selected @endif>Draft</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Short Description')}}</label>
                                    <textarea class="form-control" rows="5" name="short_description">{{$job->short_description}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Description')}}</label>
                                    <textarea class="textarea-wysihtml5 form-control" name="description">{{$job->description}}</textarea>
                                </div>



                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" value="{{$job->id}}" name="cmd">
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
