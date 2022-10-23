<div class="col-md-12">
    <div class="table">
        <table class="table table-bordered table striped">

            
            <!---mobile banking section-->
            @if ($banking_option_id == 1)
                <tr class="mobile_banking_section">
                    <td style="width:33%">
                        <select name="" id="" class="form-control">
                            <option value="">01712794033 - Bkash</option>
                            <option value="">01712794033 - Nagad</option>
                            <option value="">01712794033 - Roket</option>
                        </select>
                    </td>
                    <td style="width:33%;background-color:#f8ebeb;">
                        <input type="text" class="form-control" placeholder="Customer Mobile No">
                    </td>
                    <td style="width:33%">
                        <input type="text" class="form-control" placeholder="Transaction  ID">
                    </td>
                </tr>
            @endif
            <!---mobile banking section-->


            <!---banking section-->
            @if ($banking_option_id == 2)
                <tr  class="bank_banking_section">
                    <td style="width:33%">
                        <select name="" id="" class="form-control banking_transaction_type">
                            <option value="1">Direct Deposit</option>
                            <option value="2">Cheque</option>
                            <option value="3">Online Transfer</option>
                        </select>
                    </td>
                    <td style="width:33%;background-color:#f8ebeb;">
                        <select name="" id="" class="form-control">
                            <option value="">Deposit To Bank</option>
                            <option value="">Bank Asia Ltd</option>
                            <option value="">Brac Bank Ltd </option>
                        </select>
                    </td>
                    <td style="width:33%">
                        <select name="" id="" class="form-control">
                            <option value="">Deposit Bank Accont</option>
                            <option value="">
                                acc-name: Amir Hossain - 
                                acc-no: 009847898458
                            </option>
                            <option value="">
                                acc-name: Amir Hossain - 
                                acc-no: 009847898458
                            </option>
                        </select>
                    </td>
                </tr>
            

                <tr style="display:none;" class="bank_banking_cheque_section">
                    <td style="width:33%">
                        <input type="text" class="form-control" placeholder="Customer Cheque No">
                    </td>
                    <td style="width:33%;background-color:#f8ebeb;">
                        <input type="text" class="form-control" placeholder="Customer Bank Name">
                    </td>
                    <td style="width:33%">
                        <input type="text" class="form-control" placeholder="Short Note">
                    </td>
                </tr>
                <tr style="display:none;" class="bank_banking_transfer_section">
                    <td style="width:33%">
                        <input type="text" class="form-control" placeholder="Customer Bank Name">
                    </td>
                    <td style="width:33%;background-color:#f8ebeb;">
                        <input type="text" class="form-control" placeholder="Customer Transaction Note">
                    </td>
                    <td style="width:33%">
                        <input type="text" class="form-control" placeholder="Received Bank Transaction ID">
                    </td>
                </tr>
            @endif
            <!---Bank section-->


            <!---card section-->
            @if ($banking_option_id == 3)
                <tr style="display:;" class="bank_card_banking_transfer_section">
                    <td style="width:33%">
                        <input type="text" id="swipe" class="form-control swipe swipe_input" placeholder="Swipe card here then write security code manually">
                    </td>
                    <td style="width:33%">
                        <input type="text" id="pcc_no" class="form-control" placeholder="Credit Card No">
                    </td>
                    <td style="width:33%">
                        <input type="text" id="pcc_holder" class="form-control kb-text" placeholder="Holder Name">
                    </td>
                </tr>
                <tr style="display:;" class="bank_card_section">
                    <td style="width:33%">
                        <select id="pcc_type" class="form-control pcc_type select2 select2-hidden-accessible" placeholder="Card Type" tabindex="-1" aria-hidden="true">
                            <option value="1">Card Type</option>
                            <option value="1">Credit Card</option>
                            <option value="2">Debit Card</option>
                            <option value="3">Visa Card</option>
                            <option value="4">Master Card</option>
                        </select> 
                    </td>
                    <td style="width:33%">
                        <div style="width: 100%;">
                            <div style="float:left;width:50%;">
                                <select name="" id="" class="form-control">
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
                                <input type="text" id="" class="form-control" placeholder="Year">
                            </div>
                        </div>
                    </td>
                    <td style="width:33%">
                        <input type="text" id="pcc_cvv2" class="form-control" placeholder="CVV2">
                    </td>
                </tr>
            @endif
            <!---card section-->
        </table>
    </div>
</div>