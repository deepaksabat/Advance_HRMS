@extends('master')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('View Holiday')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')
            <div class="row">

                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-body">
                            <form class="" role="form" method="post" action="{{url('holiday/post-edit-holiday')}}">
                                <div class="panel-heading">

                                    <h3 class="panel-title">{{language_data('View Holiday')}}</h3>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Date')}}</label>
                                    <input type="text" class="form-control datePicker" required name="date" value="{{get_date_format($holiday->holiday)}}">
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Occasion')}}</label>
                                    <input type="text" class="form-control" required name="occasion" value="{{$holiday->occasion}}">
                                </div>


                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" value="{{$holiday->id}}" name="cmd">
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> {{language_data('Update')}} </button>
                                <a href="#" class="btn btn-danger btn-sm cdelete" id="{{$holiday->id}}"><i class="fa fa-trash"></i> {{language_data('Delete')}}</a>
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
    {!! Html::script("assets/libs/handlebars/handlebars.runtime.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
    {!! Html::script("assets/js/bootbox.min.js")!!}

    <script>
        $(document).ready(function () {
            $(".cdelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/holiday/delete-holiday/" + id;
                    }
                });
            });
        });
    </script>
@endsection
