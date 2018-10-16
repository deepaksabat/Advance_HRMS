@extends('master')

@section('content')

    <section class="wrapper-bottom-sec">
        <div class="p-30">
            <h2 class="page-title">{{language_data('Set Rules')}}</h2>
        </div>
        <div class="p-30 p-t-none p-b-none">

            @include('notification.notify')


            <div class="row">

                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-body">
                            <form class="" role="form" action="{{url('tax-rules/post-set-rules')}}" method="post">
                                <div class="panel-heading">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" value="{{$tid}}" name="cmd">
                                    <button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-save"></i> {{language_data('Save Values')}}</button>
                                </div>

                                <table class="table task-items">

                                    <thead>
                                    <tr>
                                        <th width="20%">{{language_data('Salary From')}}</th>
                                        <th width="20%">{{language_data('Salary To')}}</th>
                                        <th width="15">{{language_data('Tax Percentage')}} (%)</th>
                                        <th width="15">{{language_data('Additional Tax Amount')}}</th>
                                        <th width="15%">{{language_data('Gender')}}</th>
                                        <th width="15%"></th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @if(count($tax_rule)>0)

                                        @foreach($tax_rule as $tr)

                                            <tr class="item-row">
                                                <td><input type="text" name="salary_from[]" class="form-control description salary_from" value="{{$tr->salary_from}}"></td>
                                                <td><input type="text" name="salary_to[]" class="form-control description" value="{{$tr->salary_to}}"></td>
                                                <td><input type="text" name="tax_percentage[]" class="form-control description" value="{{$tr->tax_percentage}}"></td>
                                                <td><input type="text" name="additional_tax_amount[]" class="form-control description" value="{{$tr->additional_tax_amount}}"></td>
                                                <td><select name="gender[]" class="form-control selectpicker" data-live-search="true">
                                                        <option value="Both" @if($tr->gender=='Both') selected @endif>{{language_data('Both')}}</option>
                                                        <option value="Male" @if($tr->gender=='Male') selected @endif>{{language_data('Male')}}</option>
                                                        <option value="Female"  @if($tr->gender=='Female') selected @endif>{{language_data('Female')}}</option>
                                                    </select></td>
                                                <td><button class="btn btn-danger btn-sm ExitRemoveITEM" type="button"><i class="fa fa-trash-o"></i> {{language_data('Remove')}}</button></td>
                                            </tr>
                                        @endforeach
                                        <tr class="item-row">

                                            <td><input type="text" name="salary_from[]" class="form-control description"></td>
                                            <td><input type="text" name="salary_to[]" class="form-control description"></td>
                                            <td><input type="text" name="tax_percentage[]" class="form-control description"></td>
                                            <td><input type="text" name="additional_tax_amount[]" class="form-control description"></td>
                                            <td><select name="gender[]" class="form-control selectpicker" data-live-search="true">
                                                    <option value="Both">{{language_data('Both')}}</option>
                                                    <option value="Male">{{language_data('Male')}}</option>
                                                    <option value="Female">{{language_data('Female')}}</option>
                                                </select></td>
                                            <td><button class="btn btn-success btn-sm item-add"><i class="fa fa-plus"></i> {{language_data('Add More')}}</button></td>
                                        </tr>
                                    @else
                                        <tr class="item-row">

                                            <td><input type="text" name="salary_from[]" class="form-control description"></td>
                                            <td><input type="text" name="salary_to[]" class="form-control description"></td>
                                            <td><input type="text" name="tax_percentage[]" class="form-control description"></td>
                                            <td><input type="text" name="additional_tax_amount[]" class="form-control description"></td>
                                            <td><select name="gender[]" class="form-control selectpicker" data-live-search="true">
                                                    <option value="Both">{{language_data('Both')}}</option>
                                                    <option value="Male">{{language_data('Male')}}</option>
                                                    <option value="Female">{{language_data('Female')}}</option>
                                                </select></td>
                                            <td><button class="btn btn-success btn-sm item-add"><i class="fa fa-plus"></i> {{language_data('Add More')}}</button>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>

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
    {!! Html::script("assets/js/tax-rules.js")!!}

    <script>
        $('.ExitRemoveITEM').on("click", function () {
            $(this).parents(".item-row").remove();
        });
    </script>

@endsection
