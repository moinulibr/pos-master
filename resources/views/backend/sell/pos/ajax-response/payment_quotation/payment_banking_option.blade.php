<div class="col-md-12">
    <div class="table">
        <table class="table table-bordered table striped">

            
            <!---mobile banking section-->
            @if ($banking_option_id == 1)
                <tr class="mobile_banking_section">
                    <td style="width:33%">
                        <select name="account_id_3" class="form-control">
                            @foreach ($moibleBankingAccounts as $item)     
                            <option value="{{$item->id}}">{{$item->account_no}} - {{$item->account_name}} - ({{ $item->bank ? $item->bank->short_name : NULL }})</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="banking_option_id" value="1">
                        <input type="hidden" name="banking_option_name" value="mobile_banking">
                    </td>
                    <td style="width:33%;background-color:#f8ebeb;">
                        <input type="text" name="mobile_banking_customer_mobile_no" class="form-control" placeholder="Customer Mobile No">
                    </td>
                    <td style="width:33%">
                        <input type="text" name="mobile_banking_transaction_id" class="form-control" placeholder="Transaction  ID">
                    </td>
                </tr>
            @endif
            <!---mobile banking section-->


            <!---banking section-->
            @if ($banking_option_id == 2)
                <tr class="bank_banking_section">
                    <td style="width:33%">
                        <select name="banking_transaction_type" class="form-control banking_transaction_type">
                            @foreach (bankingTransactionType_hh() as $index => $item)
                                <option value="{{$index}}">{{$item}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="width:67%;" colspan="2">
                        <select name="account_id_3" class="form-control">
                            @foreach ($bankingAccounts as $item)     
                            <option value="{{$item->id}}">
                                {{$item->account_no}} - {{$item->account_name}} - ({{ $item->bank ? $item->bank->short_name : NULL }})
                            </option>
                            @endforeach
                        </select>
                        <input type="hidden" name="banking_option_id" value="2">
                        <input type="hidden" name="banking_option_name" value="banking">
                    </td>
                </tr>
            

                <tr style="display:none;" class="bank_banking_cheque_section">
                    <td style="width:33%">
                        <input type="text" name="cheque_no" class="form-control" placeholder="Customer Cheque No">
                    </td>
                    <td style="width:33%;background-color:#f8ebeb;">
                        <input type="text" name="cheque_customer_bank_name" class="form-control" placeholder="Customer Bank Name">
                    </td>
                    <td style="width:33%">
                        <input type="text" name="cheque_banking_short_note" class="form-control" placeholder="Short Note">
                    </td>
                </tr>
                <tr style="display:none;" class="bank_banking_transfer_section">
                    <td style="width:33%">
                        <input type="text" name="banking_online_transfer_transation_customer_bank_name" class="form-control" placeholder="Customer Bank Name">
                    </td>
                    <td style="width:33%;background-color:#f8ebeb;">
                        <input type="text" name="banking_online_transfer_customer_transaction_note" class="form-control" placeholder="Customer Transaction Note">
                    </td>
                    <td style="width:33%">
                        <input type="text" name="banking_online_transfer_received_bank_transaction_id" class="form-control" placeholder="Received Bank Transaction ID">
                    </td>
                </tr>
            @endif
            <!---Bank section-->


            <!---card section-->
            @if ($banking_option_id == 3)
                <tr style="display:;" class="bank_card_banking_transfer_section">
                    <td style="width:33%">
                        <input type="text" name="bank_card_swipe_code" class="form-control" placeholder="Swipe card here (write security code)">
                    </td>
                    <td style="width:33%">
                        <input type="text" name="bank_card_credit_card_no" class="form-control" placeholder="Credit Card No">
                    </td>
                    <td style="width:33%">
                        <input type="text" name="bank_card_holder_name" class="form-control" placeholder="Holder Name">
                    </td>
                </tr>
                <tr class="bank_card_section">
                    <td style="width:33%">
                        <select name="bank_card_type" class="form-control" placeholder="Card Type">
                            @foreach (bankingCardType_hh() as $index => $item)
                                <option value="{{$index}}">{{$item}}</option>
                            @endforeach
                        </select> 
                    </td>
                    <td style="width:33%">
                        <div style="width: 100%;">
                            <div style="float:left;width:50%;">
                                <select name="bank_card_expire_month" class="form-control">
                                    <option value="">Month</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div style="float:right;width:48%;">
                                <input type="text" name="bank_card_expire_year" class="form-control" placeholder="Year">
                            </div>
                        </div>
                    </td>
                    <td style="width:33%">
                        <input type="text" name="bank_card_cvv2" class="form-control" placeholder="CVV2">
                    </td>
                </tr>
            @endif
            <!---card section-->
        </table>
    </div>
</div>
