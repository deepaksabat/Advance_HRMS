@extends('master')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.css") !!}
    {!! Html::style("assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('View')}} {{language_data('Training Needs Assessment')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-7">
                    <div class="panel">
                        <div class="panel-body">
                            <form class="" role="form" action="{{url('training/post-training-needs-assessment-update')}}" method="post">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> {{language_data('View')}} {{language_data('Training Needs Assessment')}}</h3>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Department')}}</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="department">
                                        @foreach($department as $e)
                                            <option value="{{$e->id}}" @if($tnassessment->department==$e->id) selected @endif>{{$e->department}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Training Type')}}</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="training_type">
                                        <option value="Online Training" @if($tnassessment->training_type=='Online Training') selected @endif>{{language_data('Online Training')}}</option>
                                        <option value="Seminar"  @if($tnassessment->training_type=='Seminar') selected @endif>{{language_data('Seminar')}}</option>
                                        <option value="Lecture"  @if($tnassessment->training_type=='Lecture') selected @endif>{{language_data('Lecture')}}</option>
                                        <option value="Workshop"  @if($tnassessment->training_type=='Workshop') selected @endif>{{language_data('Workshop')}}</option>
                                        <option value="Hands On Training"  @if($tnassessment->training_type=='Hands On Training') selected @endif>{{language_data('Hands On Training')}}</option>
                                        <option value="Webinar"  @if($tnassessment->training_type=='Webinar') selected @endif>{{language_data('Webinar')}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Training')}} {{language_data('Subject')}}</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="training_subject">
                                        <option value="HR Training" @if($tnassessment->training_subject=='HR Training') selected @endif>{{language_data('HR Training')}}</option>
                                        <option value="Employees Development" @if($tnassessment->training_subject=='Employees Development') selected @endif>{{language_data('Employees Development')}}</option>
                                        <option value="IT Training" @if($tnassessment->training_subject=='IT Training') selected @endif>{{language_data('IT Training')}}</option>
                                        <option value="Finance Training" @if($tnassessment->training_subject=='Finance Training') selected @endif>{{language_data('Finance Training')}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Nature Of Training')}}</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="training_nature">
                                        <option value="Internal" @if($tnassessment->training_nature=='Internal') selected @endif>{{language_data('Internal')}}</option>
                                        <option value="External" @if($tnassessment->training_nature=='External') selected @endif>{{language_data('External')}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Training')}} {{language_data('Title')}}</label>
                                    <input type="text" class="form-control" name="training_title" required="" value="{{$tnassessment->title}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Training')}} {{language_data('Employee')}}</label>
                                    <select class="form-control selectpicker" multiple data-live-search="true" name="employee[]">
                                        @foreach($employee as $e)
                                            <option value="{{$e->id}}" @if(in_array_r($e->id,$train_members)) selected @endif>{{$e->fname}} {{$e->lname}} ({{$e->employee_code}})</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Training')}} {{language_data('Reason')}}</label>
                                    <textarea class="textarea-wysihtml5 form-control" name="training_reason">{{$tnassessment->training_reason}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Preferred')}} {{language_data('Trainer')}}</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="trainer">
                                        @foreach($trainers as $t)
                                            <option value="{{$t->id}}" @if($tnassessment->trainer==$t->id) selected @endif>{{$t->first_name}} {{$t->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Preferred')}}  {{language_data('Training Location')}}</label>
                                    <input type="text" class="form-control" name="training_location" value="{{$tnassessment->training_location}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Preferred')}}  {{language_data('Start Date')}}</label>
                                    <input type="text" class="form-control datePicker" name="training_from" value="{{$tnassessment->training_from}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Preferred')}} {{language_data('End Date')}}</label>
                                    <input type="text" class="form-control datePicker" name="training_to" value="{{$tnassessment->training_to}}">
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Preferred')}}  {{language_data('Training Cost')}}</label>
                                    <input type="text" class="form-control" name="training_cost" value="{{$tnassessment->training_cost}}">
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Preferred')}}  {{language_data('Travel Cost')}}</label>
                                    <input type="text" class="form-control" name="travel_cost" value="{{$tnassessment->travel_cost}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Status')}}</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="status">
                                        <option value="pending" @if($tnassessment->status=='pending') selected @endif>{{language_data('Pending')}}</option>
                                        <option value="approved"  @if($tnassessment->status=='approved') selected @endif>{{language_data('Approved')}}</option>
                                        <option value="rejected"  @if($tnassessment->status=='rejected') selected @endif>{{language_data('Rejected')}}</option>
                                        <option value="completed"  @if($tnassessment->status=='completed') selected @endif>{{language_data('Completed')}}</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Training')}} {{language_data('Description')}}</label>
                                    <textarea class="textarea-wysihtml5 form-control" name="description">{{$tnassessment->description}}</textarea>
                                </div>


                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" value="{{$tnassessment->id}}" name="cmd">
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
