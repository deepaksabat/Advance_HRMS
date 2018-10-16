@extends('master')

@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Manage')}} {{language_data('Disable Menu/Module')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-7">
                    <div class="panel">
                        <div class="panel-body">
                            <form class="" role="form" action="{{url('settings/disable-menus-post')}}" method="post">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> {{language_data('Manage')}} {{language_data('Disable Menu/Module')}}</h3>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Menu Name')}}</label>
                                    <input type="text" class="form-control" disabled value="{{$menus->menu}}">
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Disable Menu/Module')}} {{language_data('Employee')}}</label>
                                    <br>
                                    @if(count($disable_employee)!=0)
                                        @foreach($disable_employee as $te)
                                            <a href="{{url('employees/view/'.$te->id)}}" class="label label-success label-link"> {{$te->fname}} {{$te->lname}}</a>
                                        @endforeach
                                    @else
                                        <span class="label label-info">{{language_data('Disable Menu/Module')}} no one</span>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Disable Menu/Module')}} {{language_data('To')}}</label>
                                    <select class="form-control selectpicker" multiple data-live-search="true" name="employee[]">
                                        @foreach($employee as $e)
                                            <option value="{{$e->id}}">{{$e->fname}} {{$e->lname}} ({{$e->employee_code}})</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group m-none">
                                    <label for="e20">{{language_data('Status')}}</label>
                                    <select name="status" class="form-control selectpicker">
                                        <option value="active" @if($menus->status=='active') selected @endif>{{language_data('Active')}}</option>
                                        <option value="inactive" @if($menus->status=='inactive') selected @endif>{{language_data('Inactive')}}</option>
                                    </select>
                                </div>

                                <br>

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" value="{{$menus->id}}" name="cmd">
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
    {!! Html::script("assets/js/form-elements-page.js")!!}
@endsection
