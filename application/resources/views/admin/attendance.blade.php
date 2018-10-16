@extends('master')

{{--External Style Section--}}
@section('style')
    {!! Html::style("assets/libs/data-table/datatables.min.css") !!}
    {!! Html::style("assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css") !!}
@endsection


@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Attendance')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">
            @include('notification.notify')
            <div class="row">

                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Search Condition')}}</h3>
                        </div>
                        <div class="panel-body">
                            <form class="" role="form" method="post" action="{{url('attendance/post-custom-search')}}">

                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="el2">{{language_data('Date From')}}</label>
                                            <input type="text" id="date_from" class="form-control datePicker" required="" name="date_from" value="{{get_date_format($date_from)}}">
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="el2">{{language_data('Date To')}}</label>
                                            <input type="text" id="date_to" class="form-control datePicker" required="" name="date_to" value="{{get_date_format($date_to)}}">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="el3">{{language_data('Employee')}}</label>
                                            <select class="selectpicker form-control" data-live-search="true" name="employee">
                                                <option value="0">{{language_data('Select Employee')}}</option>
                                                @foreach($employee as $d)
                                                    <option value="{{$d->id}}" @if($d->id==$emp_id) selected @endif>{{$d->fname}} {{$d->lname}} ({{$d->employee_code}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="el3">{{language_data('Department')}}</label>
                                            <select class="selectpicker form-control" data-live-search="true" name="department" id="department_id">
                                                <option value="0">{{language_data('Select Department')}}</option>
                                                @foreach($department as $d)
                                                <option value="{{$d->id}}" @if($dep_id==$d->id) selected @endif> {{$d->department}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="el3">{{language_data('Designation')}}</label>
                                            <select class="selectpicker form-control" data-live-search="true" @if( $des_id == '' ) disabled @endif name="designation" id="designation">
                                                <option value="0">{{language_data('Select Designation')}}</option>
                                                @if($des_id!=0)
                                                @foreach($designation as $des)
                                                    <option value="{{$des->id}}" @if($des_id==$des->id) selected @endif> {{$des->designation}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-search"></i> {{language_data('Search')}}</button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{language_data('Attendance')}}</h3>
                            @if($date_from=='' && $date_to=='')
                                <a href="{{url('attendance/get-all-pdf-report')}}" class="btn btn-success btn-xs pull-right"><i class="fa fa-file-pdf-o"></i> {{language_data('Generate PDF')}}</a><br>
                            @else
                                <a href="{{url('attendance/get-pdf-report/'.$date_from.'_'.$date_to.'/'.$emp_id.'/'.$dep_id.'/'.$des_id)}}" class="btn btn-success btn-xs pull-right"><i class="fa fa-file-pdf-o"></i> {{language_data('Generate PDF')}}</a><br>
                            @endif


                        </div>
                        <div class="panel-body p-none">
                            <table class="table data-table table-hover table-ultra-responsive">
                                <thead>
                                <tr>
                                    <th style="width: 17%;">{{language_data('Employee Name')}}</th>
{{--                                    <th style="width: 13%;">{{language_data('Designation')}}</th>--}}
                                    <th style="width: 10%;">{{language_data('Date')}}</th>
                                    <th style="width: 10%;">{{language_data('Clock In')}}</th>
                                    <th style="width: 10%;">{{language_data('Clock Out')}}</th>
                                    <th style="width: 5%;">{{language_data('Late')}}</th>
                                    <th style="width: 5%;">{{language_data('Early Leaving')}}</th>
                                    <th style="width: 5%;">{{language_data('Overtime')}}</th>
                                    <th style="width: 10%;">{{language_data('Total Work')}}</th>
                                    <th style="width: 10%;">{{language_data('Status')}}</th>
                                    <th style="width: 5%;">{{language_data('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($attendance as $d)
                                <tr>
                                    <td data-label="employee_name"><a href="{{url('employees/view/'.$d->emp_id)}}">{{$d->employee_info->fname}} {{$d->employee_info->lname}}</a></td>
        {{--                            <td data-label="Designation">{{$d->designation_name->designation}}</td>--}}
                                    <td data-label="Date">{{get_date_format($d->date)}}</td>
                                    <td data-label="Clock_In">{{$d->clock_in}}</td>
                                    <td data-label="Clock_out">{{$d->clock_out}}</td>
                                    <td data-label="Late">{{round($d->late/60,2)}} H</td>
                                    <td data-label="Early_leaving">{{round($d->early_leaving/60,2)}} H</td>
                                    <td data-label="Overtime">{{$d->overtime}} H</td>
                                    <td data-label="Total_Work">{{round($d->total/60,2)+$d->overtime}} H</td>
                                    @if($d->status=='Absent')
                                    <td data-label="Status"><p class="btn btn-danger btn-xs">{{language_data('Absent')}}</p></td>
                                    @elseif($d->status=='Holiday')
                                    <td data-label="Status"><p class="btn btn-complete btn-xs">{{language_data('Holiday')}}</p></td>
                                    @else
                                    <td data-label="Status"><p class="btn btn-success btn-xs">{{language_data('Present')}}</p></td>
                                    @endif
                                    <td data-label="Actions">


                                        <div class="btn-group btn-mini-group dropdown-default">
                                            <a class="btn btn-success btn-sm dropdown-toggle btn-animated from-top fa fa-caret-down" data-toggle="dropdown" href="#" aria-expanded="false"><span><i class="fa fa-bars"></i></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#" class="text-complete setOvertime" id="{{$d->id}}" data-overtime-val="{{$d->overtime}}"  data-toggle="tooltip" data-placement="right" title="{{language_data('Set Overtime')}}"><i class="fa fa-clock-o"></i></a></li>
                                                <li><a href="{{url('attendance/edit/'.$d->id)}}" data-toggle="tooltip" data-placement="right" title="{{language_data('Edit')}}" class="text-success"><i class="fa fa-edit"></i></a></li>
                                                <li><a href="#" class="text-danger cdelete" data-toggle="tooltip" data-placement="right" title="{{language_data('Delete')}}" id="{{$d->id}}"><i class="fa fa-trash"></i></a></li>
                                            </ul>
                                        </div>

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
    {!! Html::script("assets/libs/data-table/datatables.min.js")!!}
    {!! Html::script("assets/libs/handlebars/handlebars.runtime.min.js")!!}
    {!! Html::script("assets/libs/moment/moment.min.js")!!}
    {!! Html::script("assets/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
    {!! Html::script("assets/js/bootbox.min.js")!!}
    <script>
        $(document).ready(function () {

            /*For DataTable*/
            $('.data-table').DataTable();


            /*Linked Date*/

            $("#date_from").on("dp.change", function (e) {
                $('#date_to').data("DateTimePicker").minDate(e.date);
            });

            $("#date_to").on("dp.change", function (e) {
                $('#date_from').data("DateTimePicker").maxDate(e.date);
            });


            /*For Designation Loading*/
            $("#department_id").change(function () {
                var id = $(this).val();
                var _url = $("#_url").val();
                var dataString = 'dep_id=' + id;
                $.ajax
                ({
                    type: "POST",
                    url: _url + '/attendance/get-designation',
                    data: dataString,
                    cache: false,
                    success: function ( data ) {
                        $("#designation").html( data).removeAttr('disabled').selectpicker('refresh');
                    }
                });
            });


            /*For Delete Attendance*/

            $(".cdelete").click(function (e) {
                e.preventDefault();
                var id = this.id;
                bootbox.confirm("Are you sure?", function (result) {
                    if (result) {
                        var _url = $("#_url").val();
                        window.location.href = _url + "/attendance/delete-attendance/" + id;
                    }
                });
            });



            /*Set Overtime*/
            $(".setOvertime").click(function (e) {
                e.preventDefault();

                var id = this.id;
                var _url = $("#_url").val();
                var  overTimeVal= $(this).data('overtime-val');
                var redirectURL=window.location.href;

                bootbox.prompt({
                    title: "Set Overtime (In Hour)?",
                    value: overTimeVal,
                    callback: function(result) {
                        var dataString = 'attend_id=' + id+'&overTimeValue='+result;
                        $.ajax
                        ({
                            type: "POST",
                            url: _url + '/attendance/set-overtime',
                            data: dataString,
                            cache: false,
                            success: function ( data ) {
                                if(data=='success'){
                                    window.location=redirectURL;
                                }else{
                                    alert('Please Try Again');
                                }

                            }
                        });
                    }
                });
            });





        });
    </script>


@endsection
