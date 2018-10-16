@extends('employee')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.min.css") !!}
    {!! Html::style("assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('View Employee Training')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-7">
                    <div class="panel">
                        <div class="panel-body">
                            <form class="" role="form">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> {{language_data('View Employee Training')}}</h3>
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Employee')}}</label>
                                    <select class="form-control selectpicker" multiple disabled>
                                        @foreach($employee as $e)
                                            <option @if(in_array_r($e->id,$train_members)) selected @endif>{{$e->fname}} {{$e->lname}} ({{$e->employee_code}})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Training Type')}}</label>
                                    <select class="form-control selectpicker" disabled>
                                        <option value="Online Training" @if($emp_train->training_type=='Online Training') selected @endif>{{language_data('Online Training')}}</option>
                                        <option value="Seminar"  @if($emp_train->training_type=='Seminar') selected @endif>{{language_data('Seminar')}}</option>
                                        <option value="Lecture"  @if($emp_train->training_type=='Lecture') selected @endif>{{language_data('Lecture')}}</option>
                                        <option value="Workshop"  @if($emp_train->training_type=='Workshop') selected @endif>{{language_data('Workshop')}}</option>
                                        <option value="Hands On Training"  @if($emp_train->training_type=='Hands On Training') selected @endif>{{language_data('Hands On Training')}}</option>
                                        <option value="Webinar"  @if($emp_train->training_type=='Webinar') selected @endif>{{language_data('Webinar')}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Training')}} {{language_data('Subject')}}</label>
                                    <select class="form-control selectpicker" disabled>
                                        <option value="HR Training" @if($emp_train->training_subject=='HR Training') selected @endif>{{language_data('HR Training')}}</option>
                                        <option value="Employees Development" @if($emp_train->training_subject=='Employees Development') selected @endif>{{language_data('Employees Development')}}</option>
                                        <option value="IT Training" @if($emp_train->training_subject=='IT Training') selected @endif>{{language_data('IT Training')}}</option>
                                        <option value="Finance Training" @if($emp_train->training_subject=='Finance Training') selected @endif>{{language_data('Finance Training')}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Nature Of Training')}}</label>
                                    <select class="form-control selectpicker" disabled>
                                        <option value="Internal" @if($emp_train->training_nature=='Internal') selected @endif>{{language_data('Internal')}}</option>
                                        <option value="External" @if($emp_train->training_nature=='External') selected @endif>{{language_data('External')}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Training')}} {{language_data('Title')}}</label>
                                    <input type="text" class="form-control" readonly value="{{$emp_train->title}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Trainer')}}</label>
                                    <select class="form-control selectpicker" disabled>
                                        @foreach($trainers as $t)
                                            <option value="{{$t->id}}" @if($emp_train->trainer==$t->id) selected @endif>{{$t->first_name}} {{$t->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Training Location')}}</label>
                                    <input type="text" class="form-control" readonly value="{{$emp_train->training_location}}">
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Sponsored By')}}</label>
                                    <input type="text" class="form-control" readonly value="{{$emp_train->sponsored_by}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Organized By')}}</label>
                                    <input type="text" class="form-control" readonly value="{{$emp_train->organized_by}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Training From')}}</label>
                                    <input type="text" class="form-control datePicker" readonly value="{{$emp_train->training_from}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Training To')}}</label>
                                    <input type="text" class="form-control datePicker" readonly value="{{$emp_train->training_to}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Training')}} {{language_data('Description')}}</label>
                                    <textarea class="textarea-wysihtml5 form-control" readonly>{{$emp_train->description}}</textarea>
                                </div>

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
