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
                            <h5>111111</h5>
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
                            <h5>111111</h5>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="3" style="text-align: right;background-color:#433d48;color:#ffff;">Current Invoice Payable Amount</th>
                        <th colspan="3" style="text-align: left;background-color:#8938dd;color:#ffff;">
                            <h5>{{$totalPayableAmount}}</h5>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="table">
                <table class="table table-bordered table striped">
                    <tr>
                        <td colspan="4" style="text-align: center">Invoice Payment</td>
                    </tr>
                    <tr>
                        <td style="width:20%">
                            <label for="">Continue with</label>
                            <select name="" id="" class="form-control">
                                <option value="">Due Invoice</option>
                                <option value="">Payment Invoice</option>
                            </select>
                        </td>
                        <td style="width:50%">
                            <label for="">Payment By</label>
                            <select name="" id="" class="form-control paymentBy">
                                <option value="">Select One</option>
                                <option value="1">Only Cash</option>
                                <option value="2">Only Advance</option>
                                <option value="3">Advance + Cash</option>
                                <option value="4">Only Banking</option>
                                <option value="5">Banking + Cash</option>
                                <option value="6">Banking + Advance</option>
                                <option value="7">Banking + Advance + Cash</option>
                            </select>
                        </td>
                        <td style="width:15%">
                            <label for="">Paying Amount</label>
                            <input type="text" class="form-control" readonly value="0"  style="background-color:green;color: #ffff;font-weight: bold;">
                        </td>
                        <td style="width:15%">
                            <label for="">Due Amount</label>
                            <input type="text" class="form-control" readonly value="">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="table">
                <table class="table table-bordered table striped">
                    <tr style="display:none;" class="cash_payment_section">
                        <td style="width:20%">Cash</td>
                        <td style="width:50%">--</td>
                        <td style="width:15%;text-align: right;"><small>Paying Amount</small></td>
                        <td style="width:15%">
                            <input type="text" name="cash_payment_value" class="form-control cash_payment_value cash_payment_making_zero" style="background-color:green;color: #ffff;font-weight: bold;">
                        </td>
                    </tr>
                    <tr style="display:none;" class="advance_payment_section">
                        <td style="width:20%">Advance</td>
                        <td style="width:50%">--</td>
                        <td style="width:15%;text-align: right;"><small>Paying Amount</small></td>
                        <td style="width:15%">
                            <input type="text" name="advance_payment_value" class="form-control advance_payment_value advance_payment_making_zero" style="background-color:green;color: #ffff;font-weight: bold;">
                        </td>
                    </tr>
                    <tr style="display:none;" class="banking_payment_section">
                        <td style="width:20%">Banking</td>
                        <td style="width:50%">
                            <div class="row">
                                <div class="col-4">
                                    <label style="padding-top: 5px;">Banking Option : </label>
                                </div>
                                <div class="col-8">
                                    <select name="" id="" class="form-control">
                                        <option value="">Select One</option>
                                        <option value="">Mobile Banking</option>
                                        <option value="">Bank</option>
                                        <option value="">Bank Transfer</option>
                                        <option value="">Card</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td style="width:15%;text-align: right;"><small>Paying Amount</small></td>
                        <td style="width:15%">
                            <input type="text" name="banking_payment_value" class="form-control banking_payment_value banking_payment_making_zero" style="background-color:green;color: #ffff;font-weight: bold;">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="table">
                <table class="table table-bordered table striped">

                    <tr style="display:;" class="mobile_banking_section">
                        <td style="width:33%">
                            <select name="" id="" class="form-control">
                                <option value="">Mobile Banking</option>
                                <option value="">01712794033 - Bkash</option>
                                <option value="">01712794033 - Nagad</option>
                                <option value="">01712794033 - Roket</option>
                            </select>
                        </td>
                        <td style="width:33%">
                            <input type="text" class="form-control" step="Customer Mobile No">
                        </td>
                        <td style="width:33%">
                            <input type="text" class="form-control" placeholder="Transaction  ID">
                        </td>
                    </tr>

                    <tr style="display:;" class="bank_banking_section">
                        <td style="width:33%">
                            <select name="" id="" class="form-control">
                                <option value="">Deposit To Bank</option>
                                <option value="">
                                    Bank Asia Ltd <br/>
                                    acc-name: Amir Hossain <br/>
                                    acc-no: 009847898458
                                </option>
                                <option value="">Brac Bank Ltd <br/>
                                    acc-name: Amir Hossain <br/>
                                    acc-no: 009847898458
                                </option>
                            </select>
                        </td>
                        <td style="width:33%">
                            <input type="text" class="form-control" placeholder="Customer Bank Name">
                        </td>
                        <td style="width:33%">
                            <input type="text" class="form-control" placeholder="Customer Cheque No">
                        </td>
                    </tr>

                    <tr style="display:;" class="bank_banking_transfer_section">
                        <td style="width:33%">
                            <select name="" id="" class="form-control">
                                <option value="">Deposit To Bank</option>
                                <option value="">
                                    Bank Asia Ltd <br/>
                                    acc-name: Amir Hossain <br/>
                                    acc-no: 009847898458
                                </option>
                                <option value="">Brac Bank Ltd <br/>
                                    acc-name: Amir Hossain <br/>
                                    acc-no: 009847898458
                                </option>
                            </select>
                        </td>
                        <td style="width:33%">
                            <input type="text" class="form-control" placeholder="Customer Bank Name (Transaction Note)">
                        </td>
                        <td style="width:33%">
                            <input type="text" class="form-control" placeholder="Received Bank Transaction ID">
                        </td>
                    </tr>


                    <tr style="display:;" class="bank_banking_transfer_section">
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

                </table>
            </div>
        </div>

    </div>


    <br>

    <div class="row">
        <div class="col-md-12">
            <label for="">Payment Note</label>
            <textarea name="" id="" cols="5" rows="2" class="form-control"></textarea>
        </div>
    </div>

   {{--  <div class="row">
        <div class="col-md-3">
            <label for="">Continue with</label>
            <select name="" id="" class="form-control">
                <option value="">Due Invoice</option>
                <option value="">Payment Invoice</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="">Payment By</label>
            <select name="" id="" class="form-control">
                <option value="">Select One</option>
                <option value="">Only Cash</option>
                <option value="">Only Advance</option>
                <option value="">Advance + Cash</option>
                <option value="">Only Banking</option>
                <option value="">Banking + Cash</option>
                <option value="">Banking + Advance</option>
                <option value="">Banking + Advance + Cash</option>
                <option value="">Advance + Cash + Banking + Others</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="">Invoice Paying Amount</label>
            <input type="text" class="form-control">
        </div>
        <div class="col-md-3">
            <label for="">Invoice Due Amount</label>
            <input type="text" class="form-control">
        </div>
    </div>

 <br>
 <br>
 <br>
 <br>
 <br> --}}
 <br>

