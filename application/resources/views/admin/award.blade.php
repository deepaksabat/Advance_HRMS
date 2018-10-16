@extends('master')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Award List')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')
            <div class="row">

                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Award List')}}</h3>
                            <button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#add-new-award"><i class="fa fa-plus"></i> {{language_data('Add New Award')}}</button>
                            <br>
                        </div>
                        <div class="panel-body p-none">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 5%;">{{language_data('SL')}}#</th>
                                    <th style="width: 10%;">{{language_data('Employee Code')}}</th>
                                    <th style="width: 25%;">{{language_data('Award Name')}}</th>
                                    <th style="width: 25%;">{{language_data('Gift')}}</th>
                                    <th style="width: 15%;">{{language_data('Month')}}</th>
                                    <th style="width: 20%;">{{language_data('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($award as $d)
                                    <tr>
                                        <td data-label="SL">{{$d->id}}</td>
                                        <td data-label="emoployeCode"><p>{{$d->emp_id}}</p></td>
                                        <td data-label="Award"><p>{{$d->award_name->award}}</p></td>
                                        <td data-label="gift"><p>{{$d->gift}}</p></td>
                                        <td data-label="month"><p>{{$d->month}} {{$d->year}} </p></td>
                                        <td data-label="Actions">
                                            <a class="btn btn-success btn-xs" href="{{url('award/edit/'.$d->id)}}"><i class="fa fa-edit"></i> {{language_data('Edit')}}</a>
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
            <div class="modal fade" id="add-new-award" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">{{language_data('Add New Award')}}</h4>
                        </div>
                        <form class="form-some-up" role="form" method="post" action="{{url('award/post-new-award')}}">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label>{{language_data('Award Name')}}</label>
                                    <select name="award_name" id="e20" class="form-control selectpicker" data-live-search="true">
                                        @foreach($award_name as $an)
                                            <option value="{{$an->id}}">{{$an->award}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Employee Name')}}</label>
                                    <select name="emp_name" class="form-control selectpicker" data-live-search="true">
                                        @foreach($employee as $e)
                                            <option value="{{$e->employee_code}}">{{$e->fname}} {{$e->lname}} ({{$e->employee_code}})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Gift Item')}}</label>
                                    <input type="text" class="form-control" required="" name="gift_item">
                                </div>


                                <div class="form-group">
                                    <label>{{language_data('Cash Price')}}</label>
                                    <input type="text" class="form-control" name="cash_price">
                                </div>

                                <div class="form-group m-none">
                                    <label for="e20">{{language_data('Month')}}</label>
                                    <select name="month" class="form-control selectpicker" data-live-search="true">
                                        <option value="January">{{language_data('January')}}</option>
                                        <option value="February">{{language_data('February')}}</option>
                                        <option value="March">{{language_data('March')}}</option>
                                        <option value="April">{{language_data('April')}}</option>
                                        <option value="May">{{language_data('May')}}</option>
                                        <option value="June">{{language_data('June')}}</option>
                                        <option value="July">{{language_data('July')}}</option>
                                        <option value="August">{{language_data('August')}}</option>
                                        <option value="September">{{language_data('September')}}</option>
                                        <option value="October">{{language_data('October')}}</option>
                                        <option value="November">{{language_data('November')}}</option>
                                        <option value="December">{{language_data('December')}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{language_data('Year')}}</label>
                                    {{yearDropdown(1900,date('Y'),'year',date('Y'))}}
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
    {!! Html::script("assets/libs/handlebars/handlebars.runtime.min.js")!!}
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
                        window.location.href = _url + "/award/delete-award/" + id;
                    }
                });
            });


        });
    </script>
@endsection
