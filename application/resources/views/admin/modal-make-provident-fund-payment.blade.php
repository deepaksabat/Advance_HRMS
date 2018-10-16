<div class="modal fade modal_make_payment_pf_{{$pf->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{language_data('Pay Payment')}}</h4>
            </div>
            <form class="form-some-up form-block" role="form" action="{{url('provident-fund/make-payment')}}" method="post">

                <div class="modal-body">

                    <div class="form-group">
                        <label>{{language_data('Amount')}} :</label>
                        <input type="text" disabled class="form-control" value="{{$pf->total}}">
                    </div>

                    <br>
                    <br>
                    <div class="form-group">
                        <label>{{language_data('Payment Type')}}</label>
                        <select class="selectpicker form-control" name="payment_type">
                            <option value="Cash Payment">{{language_data('Cash Payment')}}</option>
                            <option value="Bank Payment">{{language_data('Bank Payment')}}</option>
                            <option value="Cheque Payment">{{language_data('Cheque Payment')}}</option>
                        </select>
                    </div>


                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="cmd" value="{{$pf->id}}">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{language_data('Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{language_data('Pay')}}</button>
                </div>

            </form>
        </div>
    </div>

</div>

