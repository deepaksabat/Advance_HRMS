@extends('master')

@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('View Application')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-body">
                            <form class="" role="form" action="{{url('leave/post-job-status')}}" method="post">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> {{language_data('View Application')}}</h3>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Employee Name')}}</label>
                                    <input type="text" class="form-control" readonly value="{{$leave->employee_id->fname}} {{$leave->employee_id->lname}} ({{$leave->employee_id->employee_code}}) ">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Leave Type')}}</label>
                                    <input type="text" class="form-control" readonly value="{{$leave->leave_type->leave}}">
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{language_data('Leave From')}}</label>
                                            <input type="text" class="form-control" readonly value="{{$leave->leave_from}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{language_data('Leave To')}}</label>
                                            <input type="text" class="form-control" readonly value="{{$leave->leave_to}}">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Applied On')}}</label>
                                    <input type="text" class="form-control" value="{{$leave->applied_on}}" readonly>
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Leave Reason')}}</label>
                                    <textarea class="form-control" readonly rows="4">{{$leave->leave_reason}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Current Status')}}</label>
                                    <input type="text" class="form-control" value="{{$leave->status}}" readonly>
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Change Status')}}</label>
                                    <select class="selectpicker form-control" name="status">
                                        <option value="approved" @if($leave->status=='approved') selected @endif>{{language_data('Approved')}}</option>
                                        <option value="pending"  @if($leave->status=='pending') selected @endif>{{language_data('Pending')}}</option>
                                        <option value="rejected" @if($leave->status=='rejected') selected @endif>{{language_data('Rejected')}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Remark')}}</label>
                                    <textarea class="form-control" name="remark" rows="4">{{$leave->remark}}</textarea>
                                </div>


                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" value="{{$leave->id}}" name="cmd">
                                <button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-save"></i> {{language_data('Update')}} </button>
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
    {!! Html::script("assets/libs/handlebars/handlebars.runtime.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
@endsection
