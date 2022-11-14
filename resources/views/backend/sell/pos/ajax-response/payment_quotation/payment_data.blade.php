    <div class="row">
        <div class="col-md-12">
            <div class="table">
                <table class="table table-bordered table striped">
                    <tr>
                        <td colspan="6" style="text-align: center">Customer Information</td>
                    </tr>
                    <tr>
                        <td style="width:17%">Customer Name</td>
                        <td style="width:1%">:</td>
                        <td style="width:50%">{{$customer->name}}</td>

                        <td style="width:17%">Phone</td>
                        <td style="width:1%">:</td>
                        <td style="width:18%">{{$customer->phone}}</td>
                    </tr>
                    <tr>
                        <td style="width:17%">Customer Type</td>
                        <td style="width:1%">:</td>
                        <td style="width:50%">{{$customer->customer_type_id == 1 ? 'Permanent' : 'Walking'}}</td>

                        <td style="width:17%;background-color:#b72323;color:#ffff;">
                            Previous Due
                        </td>
                        <td style="width:1%">:</td>
                        <td style="width:18%;background-color:#b72323;color:#ffff;">
                            {{$customer->total_due}}
                        </td>
                    <tr>
                        <td style="width:17%">Address</td>
                        <td style="width:1%">:</td>
                        <td style="width:50%">{{$customer->address ?? "NILL"}}</td>

                        <td style="width:17%;background-color:green;color:#ffff;">
                            Current Advance
                        </td>
                        <td style="width:1%;">:</td>
                        <td style="width:18%;background-color:green;color:#ffff;">
                           <strong class="total_advance_amount">{{$customer->total_advance}}</strong>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="3" style="text-align: right;background-color:#433d48;color:#ffff;">Current Invoice Payable Amount</th>
                        <th colspan="3" style="text-align: left;background-color:#8938dd;color:#ffff;">
                            <strong class="total_invoice_payble_amount">{{$totalPayableAmount}}</strong>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <br>

    <!-----Invoice Payment--->
    <div class="row">
        <div class="col-md-12">
            <div class="table">
                <table class="table table-bordered table striped">
                    <tr>
                        <td colspan="4" style="text-align: center">Invoice Payment</td>
                    </tr>
                    <tr>
                        <td style="width:20%">
                            <label for="">Invoice Continue With</label>
                            <select name="invoice_continue_with" class="form-control invoice_continue_with">
                                @foreach (invoiceContinueWith_hh() as $index => $item)
                                <option value="{{$index}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td style="width:50%;background-color:#f7f1f1;">
                            <label for="">Payment Option</label>
                            <select name="payment_option_id" class="form-control payment_option" disabled>
                                <option value="0">Select One</option>
                                @foreach (paymentMethodAndPaymentOptionBothAreSame_hh() as $index => $item)
                                <option value="{{$index}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td style="width:15%">
                            <label for="">Paying Amount</label>
                            <input name="invoice_total_paying_amount" type="text" class="form-control invoice_paying_amount" readonly value="0"  style="background-color:#4f6e4f;color: #ffff;;font-size:14px;font-weight:800;">
                        </td>
                        <td style="width:15%">
                            <label for="">Due Amount</label>
                            <input name="invoice_total_due_amount" type="text" class="form-control invoice_due_amount" readonly style="background-color:#f15454;color:#ffff;font-size:14px;font-weight:800;">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="table">
                <table class="table table-bordered table striped">
                    <tr style="display:none;" class="cash_payment_section">
                        <td style="width:20%;background-color:#f8ebeb;">Cash</td>
                        <td style="width:50%;text-align:center;background-color:#efeaea;">
                            <select name="account_id_1" class="form-control account_id_1">
                                @foreach ($cashAccounts as $item)
                                <option value="{{$item->id}}">{{$item->account_name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td style="width:15%;text-align: right;background-color:#f8ebeb;"><small>Paying Amount</small></td>
                        <td style="width:15%">
                            <input type="text" name="cash_payment_value"  class="paying_different_method form-control cash_payment_value cash_payment_making_zero inputFieldValidatedOnlyNumeric" style="background-color:green;color: #ffff;font-weight: bold;">
                        </td>
                    </tr>
                    <tr style="display:none;" class="advance_payment_section">
                        <td style="width:20%;background-color:#efeaea;">Advance</td>
                        <td style="width:50%;text-align:center;background-color:#f8ebeb;">
                            <select name="account_id_2" class="form-control account_id_2">
                                @foreach ($advanceAccounts as $item)
                                <option value="{{$item->id}}">{{$item->account_name}}</option>
                                @endforeach 
                            </select>
                        </td>
                        <td style="width:15%;text-align:right;background-color:#efeaea;"><small>Paying Amount</small></td>
                        <td style="width:15%">
                            <input type="text" name="advance_payment_value" class="paying_different_method form-control advance_payment_value advance_payment_making_zero inputFieldValidatedOnlyNumeric" style="background-color:green;color: #ffff;font-weight: bold;">
                        </td>
                    </tr>
                    <tr style="display:none;" class="banking_payment_section">
                        <td style="width:20%;background-color:#f8ebeb;">Banking</td>
                        <td style="width:50%">
                            <div class="row">
                                <div class="col-4">
                                    <label style="padding-top: 5px;">Banking Option : </label>
                                </div>
                                <div class="col-8">
                                    <select name="banking_option_id" class="form-control banking_option_data">
                                        <option value="0">Select One</option>
                                        @foreach (bankingOptions_hh() as $index => $item)
                                        <option value="{{$index}}">{{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td style="width:15%;text-align:right;background-color:#f8ebeb;"><small>Paying Amount</small></td>
                        <td style="width:15%">
                            <input type="text" name="banking_payment_value" class="paying_different_method form-control banking_payment_value banking_payment_making_zero inputFieldValidatedOnlyNumeric" style="background-color:green;color: #ffff;font-weight: bold;">
                        </td>
                    </tr>
                </table>
            </div>
        </div>


        <div class="col-md-12" style="display:none;" class="processing">
            <div class="table">
                <table class="table" style="border: none;">
                    <tr>
                        <td style="width:40%"></td>
                        <td style="width:20%">
                            <img src="{{asset('loading-img/loading1.gif')}}" alt="" style="display: block;margin-left: auto;margin-right:auto;height:40px;">
                        </td>
                        <td style="width:40%"></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="rendering_payment_banking_option_data"  style="width:100%"></div>

    </div>
    <!-----Invoice Payment--->

    <!---calculator for customer change money-->
    <div style="text-align:right;">
        <span class="customer_calculator_button" style="color:green;padding-right:10px;cursor: pointer;">Calculator</span>
    </div>
    <div class="col-md-12 customer_calculator" style="padding: 0;margin:0px;display:none;">
        <div class="table" style="border-radius: 5%;">
            <table class="table table-bordered table striped" style="background-color:#bcb9bf;color:#ffff;">
                <tr>
                    <td style="width:24.5%">
                        <div style="width: 100%;">
                            <div style="float:left;width:30%;">
                                <label style="padding-top: 0.375rem;">
                                    Invoice    
                                </label> 
                            </div>
                            <div style="float:right;width:70%;">
                                <input disabled type="text"  style="color:yellow!important;" class="form-control total_invoice_amount_for_calculator"  value="{{$totalPayableAmount}}"  placeholder="Invoice Amount">
                            </div> 
                        </div> 
                    </td>
                    <td style="width:24.5%">
                        <div style="width: 100%;">
                            <div style="float:left;width:30%;">
                                <label style="padding-top: 0.375rem;">
                                Paying
                                </label> 
                            </div>
                            <div style="float:right;width:70%;">
                                <input type="text"  style="color:yellow!important;" class="total_paying_amount_for_calculator form-control invoice_paying_amount" disabled placeholder=" Paying Amount">
                            </div> 
                        </div> 
                    </td>
                    <td style="width:24.5%">
                        <div style="float:left;width:30%;">
                            <label style="padding-top: 0.375rem;">
                            Given
                            </label> 
                        </div>
                        <div style="float:right;width:70%;">
                            <input type="text" class="form-control given_amount_for_calculator form-control inputFieldValidatedOnlyNumeric"  placeholder="Given Amount" style="background-color:green;color:#ffff;">
                        </div> 
                    </td>
                    <td style="width:24.5%">
                        <div style="float:left;width:30%;">
                            <label style="padding-top: 0.375rem;">
                            Return
                            </label> 
                        </div>
                        <div style="float:right;width:70%;">
                            <input type="text"  class="form-control return_amount_for_calculator" disabled placeholder="Return Amount"  style="background-color:red;color:#ffff !important;">
                        </div> 
                    </td>
                    <td style="width:2%">
                        <span style="color:red;background-color:#fff;cursor: pointer;" class="customer_calculator_close">
                            <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                            </svg>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <!---calculator for customer change money-->

    <br>

    <!---sending mail,sms-->
    <div class="row mt-10">
        <div class="col-sm-4 col-md-4"></div>
        <div class="col-sm-4 col-md-4">
            <div class="checkbox">
                <label>
                    <input name="send_sms" value="1" type="checkbox" class="colored-blue">
                    <span class="text">Send Invoice Via SMS</span>
                </label>
            </div>
        </div>
        <div class="col-sm-4 col-md-4 text-end">
            <div class="checkbox">
                <label>
                    <input name="send_email" value="1" type="checkbox" class="colored-blue">
                    <span class="text">Send Invoice Via Email</span>
                </label>
            </div>
        </div>
    </div>
    <!---sending mail,sms-->

    <!---payment note-->
    <div class="row">
        <div class="col-md-12">
            <label for="">Payment Note</label>
            <textarea name="payment_note" id="" cols="5" rows="2" class="form-control"></textarea>
        </div>
    </div>
    <!---payment note-->
   <br/>

