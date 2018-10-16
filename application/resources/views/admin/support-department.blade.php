@extends('master')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Department')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')
            <div class="row">

                <div class="col-lg-4">
                    <div class="panel">
                        <div class="panel-body">
                            <form method="POST" action="{{ url('support-tickets/post-department') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group">
                                    <label for="dname">{{language_data('Department Name')}}</label>
                                    <input type="text" class="form-control" id="dname" name="dname">
                                </div>

                                <div class="form-group">
                                    <label for="email">{{language_data('Department Email')}}</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>

                                <div class="form-group">
                                    <label for="show">{{language_data('Show in Client')}}</label>
                                    <select name="show" class="selectpicker form-control">
                                        <option value="Yes">{{language_data('Yes')}}</option>
                                        <option value="No">{{language_data('No')}}</option>
                                    </select>
                                </div>

                                <button type="submit" name="add" class="btn btn-success"><i class="fa fa-plus"></i> {{language_data('Add New')}}</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Support Department')}}</h3>
                        </div>
                        <div class="panel-body p-none">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{language_data('Department Name')}}</th>
                                    <th>{{language_data('Email')}}</th>
                                    <th>{{language_data('Show in Client')}}</th>
                                    <th class="text-right" width="25%">{{language_data('Manage')}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($sd as $in)
                                    <tr>
                                        <td><a href="{{url('support-tickets/view-department/'.$in->id)}}">{{$in->id}}</a> </td>
                                        <td><a href="{{url('support-tickets/view-department/'.$in->id)}}">{{$in->name}}</a> </td>
                                        <td>{{$in->email}}</td>
                                        <td>
                                            @if($in->show=='No')
                                                <span class="label label-danger">{{language_data('No')}}</span>
                                            @else
                                                <span class="label label-success">{{language_data('Yes')}}</span>
                                            @endif

                                        </td>

                                        <td class="text-right">
                                            <a href="{{url('support-tickets/view-department/'.$in->id)}}" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> {{language_data('View')}}</a>
                                            <a href="#" class="btn btn-danger btn-xs cdelete" id="{{$in->id}}"><i class="fa fa-trash"></i> {{language_data('Delete')}}</a>
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
    </section>

@endsection

{{--External Style Section--}}
@section('script')
    {!! Html::script("assets/libs/handlebars/handlebars.runtime.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
    {!! Html::script("assets/libs/data-table/datatables.min.js")!!}
    {!! Html::script("assets/js/bootbox.min.js")!!}

    <script>
        $(document).ready(function(){
            $('.data-table').DataTable();
        });

        $(".cdelete").click(function (e) {
            e.preventDefault();
            var id = this.id;
            bootbox.confirm("Are you sure?", function(result) {
                if(result){
                    var _url = $("#_url").val();
                    window.location.href = _url + "/support-tickets/delete-department/" + id;
                }
            });
        });

    </script>
@endsection
