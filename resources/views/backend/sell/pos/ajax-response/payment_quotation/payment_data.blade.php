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
                            <h5>{{$customer->total_due}}</h5>
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
                            <h5><strong class="total_advance_amount">{{$customer->total_advance}}</strong></h5>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="3" style="text-align: right;background-color:#433d48;color:#ffff;">Current Invoice Payable Amount</th>
                        <th colspan="3" style="text-align: left;background-color:#8938dd;color:#ffff;">
                            <h5><strong class="total_invoice_payble_amount">{{$totalPayableAmount}}</strong></h5>
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
                            <label for="">Invoice Continue With</label>
                            <select name="invoice_continue_with" class="form-control invoice_continue_with">
                                <option value="1">Due</option>
                                <option value="2">Payment</option>
                            </select>
                        </td>
                        <td style="width:50%;background-color:#f7f1f1;">
                            <label for="">Payment Option</label>
                            <select name="payment_option_id" class="form-control payment_option" disabled>
                                <option value="0">Select One</option>
                                <option value="1">Cash Only</option>
                                <option value="2">Advance Only</option>
                                <option value="3">Advance + Cash</option>
                                <option value="4">Banking Only</option>
                                <option value="5">Banking + Cash</option>
                                <option value="6">Banking + Advance</option>
                                <option value="7">Banking + Advance + Cash</option>
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
                        <td style="width:50%;text-align:center;background-color:#efeaea;">--</td>
                        <td style="width:15%;text-align: right;background-color:#f8ebeb;"><small>Paying Amount</small></td>
                        <td style="width:15%">
                            <input type="text" name="cash_payment_value"  class="paying_different_method form-control cash_payment_value cash_payment_making_zero inputFieldValidatedOnlyNumeric" style="background-color:green;color: #ffff;font-weight: bold;">
                        </td>
                    </tr>
                    <tr style="display:none;" class="advance_payment_section">
                        <td style="width:20%;background-color:#efeaea;">Advance</td>
                        <td style="width:50%;text-align:center;background-color:#f8ebeb;">--</td>
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
                                        <option value="1">Mobile Banking</option>
                                        <option value="2">Bank</option>
                                        <option value="3">Card</option>
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


    <br>
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


    <div class="row">
        <div class="col-md-12">
            <label for="">Payment Note</label>
            <textarea name="payment_note" id="" cols="5" rows="2" class="form-control"></textarea>
        </div>
    </div>

   <br/>

