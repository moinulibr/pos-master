<style>
    .modal-full {
            min-width: 90%;
            margin: 0;
            margin-left:5%;
        }

        .modal-full .modal-content {
            min-height: 100vh;
        }
</style>
<div class="modal-dialog modal-lg modal-full" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">
                <strong style="mergin-right:20px;">Sell Details (Invoice No.: {{$data->invoice_no}})</strong>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </h4>
        </div>
        <form method="POST" action="{{route('admin.sell.product.return.invoice.wise.quantity.store')}}" class="storeReturnDataFromReturnOption">
            @csrf
            <div class="modal-body">


                <div style="margin-top: -60px;">
                    <div>
                        <div class="mb-2 text-right my-5">
                            <label>
                                <strong>Date : </strong>  <span style="font-size:14px;"> {{date('d-m-Y h:i:s a',strtotime($data->created_at))}}</span>
                            </label>
                        </div>
                    </div>
                    <div class="row" style="border-bottom: 1px solid #cdc7c7;">
                        <div class="col-md-4">
                            <div class="mb-2">
                                <label>
                                    <strong>Invoice No: </strong> <span style="font-size:14px;"> {{$data->invoice_no}}</span>
                                </label>
                            </div>
                            {{--  <div class="mb-2">
                                <label>
                                    <strong>Status: </strong>  <span style="font-size:14px;"> {{$data->order_no}}</span>
                                </label>
                            </div>  --}}
                            <div class="mb-2">
                                <label>
                                    <strong>Payment Status: </strong>
                                        {{-- @if($data->totalPaidAmount() > 0)
                                            <span>
                                                @if($data->totalSaleAmount() == $data->totalPaidAmount())
                                                    <span class="badge badge-primary"> Paid </span>

                                                @elseif($data->totalSaleAmount() > 0 && $data->totalSaleAmount()  < $data->totalPaidAmount())
                                                    <small class="badge badge-warning"> Over</small><span class="badge badge-primary"> Paid </span>

                                                @elseif($data->totalSaleAmount() > 0 && $data->totalSaleAmount()  > $data->totalPaidAmount())
                                                    <span class="badge badge-danger">Due</span>

                                                @elseif($data->totalSaleAmount() < 0)
                                                    <span class="badge badge-defalut" style="backgrounc-color:#06061f;color:red;">Invalid </span>
                                                @endif
                                                </span>
                                            @else
                                            <span class="badge badge-danger">Due</span>
                                        @endif --}}
                                        <span class="badge badge-danger">Due</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-2">
                                <label>
                                    <strong>Customer Name : </strong> <span style="font-size:14px;"> {{$data->customer ? $data->customer->name  :NULL}}</span>
                                </label>
                            </div>
                            <div class="mb-2">
                                <label>
                                    <strong>Address : </strong>
                                    {{$data->customer ? $data->customer->address  :NULL}}
                                </label>
                                <br/>
                                <label>
                                    <strong>Mobile : </strong>
                                    {{$data->customer ? $data->customer->phone  :NULL}}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-2">
                                <label>
                                    <strong>Shipping :</strong>
                                    {{ $data->shipping_id ? $data->shipping? $data->shipping->address : NUll : NULL }}
                                    {{ $data->shipping_id ? $data->shipping ? " (". $data->shipping->phone .")" : NUll : NULL }}
                                </label>
                            </div>
                            <div class="mb-2">
                                <label>
                                    <strong>Reference By: </strong>
                                    {{$data->referenceBy ? $data->referenceBy->name:NULL}}
                                    {{$data->referenceBy ? " (". $data->referenceBy->phone .")" :NULL}}
                                </label>
                            </div>
                            <div class="mb-2">
                                <label>
                                    <strong>Receiver Details: </strong>
                                    {{$data->receiver_details}}
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="alert alert-success alert_success_message_div" role="alert" style="display:none;z-index:99999999;padding: 5px;"> 
                                <p class="success_message_text"  style="text-align: center"></p>
                            </div>
                            <div class="alert alert-danger alert_danger_message_div" role="alert" style="display:none;z-index:99999999;padding: 5px;"> 
                                <p class="danger_message_text" style="text-align: center"></p>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <br/>
                    <!-----Receive From and Received related information--->
                    <div class="row" style="margin-top:5px;padding-bottom:20px;">
                        <div class="col-md-12" style="padding-bottom:20px;">
                            <h3 style="text-align: center;">
                                <strong style="border-bottom: 1px solid gray;padding-bottom: 3px;">    
                                Sell Return 
                                </strong>
                            </h3>
                        </div>
                        <div class="col-md-6">
                            <label for="">Receive Note</label>
                            <textarea name="receive_note"  class="form-control" cols="10" rows="1"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="">Return Note</label>
                            <textarea name="return_note"  class="form-control" cols="10" rows="1"></textarea>
                        </div>
                    </div>
                    <!-----Receive From and Received related information--->
                    <!-----Start of Products--->
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Products: </h4>
                            <div class="product_related_response_here">
                            
                            </div>
                        </div>
                    </div>
                    <!-----End of Products--->
                   
                    <div class="table-responsive">
                        <table id="example1" class="table">
                            <tr>
                                <td style="width: 86%;text-align:right;border: none;">Subtotal</td>
                                <th style="width: 10%;text-align: center;background-color:#f3f3f3;color:#666565;">
                                    <strong class="subtotal_before_discount_for_return">00.00</strong>
                                    <input type="hidden" name="return_invoice_subtotal_before_discount" class="subtotal_before_discount_for_return_val">
                                </th>
                                <td style="width:4%;border:none;background-color:#f3f3f3;color:#666565;"></td>
                            </tr>
                        </table>
                    </div>

                    <!---discount section-->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Discount Type</label>
                                    <select class="form-control return_invoice_discount_type" name="return_invoice_discount_type">
                                        <option value="">None</option>
                                        <option value="percentage">Percentage</option>
                                        <option value="fixed">Fixed</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Discount Value</label>
                                    <input type="text" class="form-control return_invoice_discount_amount" name="return_invoice_discount_amount">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Discount Amount</label>
                                    <input type="text" disabled class="form-control return_invoice_total_discount_amount">
                                    <input type="hidden" name="return_invoice_total_discount_amount" class="return_invoice_total_discount_amount_val">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="table-responsive">
                                <table id="example1" class="table">
                                    <tr>
                                        <td style="width:30%;text-align:right;border: none;">Total Amount</td>
                                        <th colspan="2" style="text-align: center;background-color:#f3f3f3;color:#666565;border: none;">
                                            <strong style="padding-left:40px;font-size:18px;" class="total_return_amount_after_discount">00.00</strong>
                                            <input type="hidden" name="return_invoice_total_amount_after_discount" class="total_return_amount_after_discount_val">
                                        </th>
                                    </tr>
                                    <tr>
                                        <td  colspan="3" style="text-align: right;border: none;">
                                            <small><i>(Total return amount after discount/less amount)</i></small>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                     <!---discount section-->

                    <!------Start of Payment Info --->
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <!-----Invoice Payment--->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table">
                                        <table class="table table-bordered table striped">
                                            <tr>
                                                <th colspan="3" style="text-align:right;background-color:#666565;color:#fff;">Payment Return Amount</>
                                                <th  style="text-align:left;background-color:#666565;color:#fff;">
                                                    <strong style="margin-right:5px;">:</strong>
                                                    <strong class="total_sell_return_invoice_payable_amount" style="font-size:16px;">00</strong>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td style="width:20%">
                                                    <label for="">Invoice Continue With</label>
                                                    <select name="invoice_continue_with" class="form-control invoice_continue_with_for_sell_return">
                                                        @foreach (invoiceContinueWith_hh() as $index => $item)
                                                        <option value="{{$index}}">{{$item}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td style="width:50%;background-color:#f7f1f1;">
                                                    <label for="">Payment Option</label>
                                                    <select name="payment_option_id" class="form-control payment_option_for_sell_return" disabled>
                                                        <option value="0">Select One</option>
                                                        @foreach (paymentMethodAndPaymentOptionBothAreSame_hh() as $index => $item)
                                                        <option value="{{$index}}">{{$item}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td style="width:15%">
                                                    <label for="">Paying Amount</label>
                                                    <input name="invoice_total_paying_amount" type="text" class="form-control invoice_paying_amount_for_sell_return" readonly value="0"  style="background-color:#4f6e4f;color: #ffff;;font-size:14px;font-weight:800;">
                                                </td>
                                                <td style="width:15%">
                                                    <label for="">Due Amount</label>
                                                    <input name="invoice_total_due_amount" type="text" class="form-control invoice_due_amount_for_sell_return" readonly style="background-color:#f15454;color:#ffff;font-size:14px;font-weight:800;">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="table">
                                        <table class="table table-bordered table striped">
                                            <tr style="display:none;" class="cash_payment_section_for_sell_return">
                                                <td style="width:20%;background-color:#f8ebeb;">Cash</td>
                                                <td style="width:50%;text-align:center;background-color:#efeaea;">
                                                    <select name="account_id_1" class="form-control account_id_for_sell_return_1">
                                                        @foreach ($cashAccounts as $item)
                                                        <option value="{{$item->id}}">{{$item->account_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td style="width:15%;text-align: right;background-color:#f8ebeb;"><small>Paying Amount</small></td>
                                                <td style="width:15%">
                                                    <input type="text" name="cash_payment_value"  class="paying_different_method_for_sell_return form-control cash_payment_value_for_sell_return cash_payment_making_zero_for_sell_return inputFieldValidatedOnlyNumeric" style="background-color:green;color: #ffff;font-weight: bold;">
                                                </td>
                                            </tr>
                                            <tr style="display:none;" class="advance_payment_section_for_sell_return">
                                                <td style="width:20%;background-color:#efeaea;">Advance</td>
                                                <td style="width:50%;text-align:center;background-color:#f8ebeb;">
                                                    <select name="account_id_2" class="form-control account_id_for_sell_return_2">
                                                        @foreach ($advanceAccounts as $item)
                                                        <option value="{{$item->id}}">{{$item->account_name}}</option>
                                                        @endforeach 
                                                    </select>
                                                </td>
                                                <td style="width:15%;text-align:right;background-color:#efeaea;"><small>Paying Amount</small></td>
                                                <td style="width:15%">
                                                    <input type="text" name="advance_payment_value" class="paying_different_method_for_sell_return form-control advance_payment_value_for_sell_return advance_payment_making_zero_for_sell_return inputFieldValidatedOnlyNumeric" style="background-color:green;color: #ffff;font-weight: bold;">
                                                </td>
                                            </tr>
                                            <tr style="display:none;" class="banking_payment_section_for_sell_return">
                                                <td style="width:20%;background-color:#f8ebeb;">Banking</td>
                                                <td style="width:50%">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <label style="padding-top: 5px;">Banking Option : </label>
                                                        </div>
                                                        <div class="col-8">
                                                            <select name="banking_option_id" class="form-control banking_option_data_for_sell_return">
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
                                                    <input type="text" name="banking_payment_value" class="paying_different_method_for_sell_return form-control banking_payment_value_for_sell_return banking_payment_making_zero_for_sell_return inputFieldValidatedOnlyNumeric" style="background-color:green;color: #ffff;font-weight: bold;">
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
                        
                                <div class="rendering_payment_banking_option_data_for_sell_return"  style="width:100%"></div>
                                
                                <!---calculator for customer change money-->
                                <div style="margin-left: 90%;">
                                    <span class="customer_calculator_button_for_sell_return" style="color:green;padding-right:10px;cursor: pointer;">Calculator</span>
                                </div>
                                <div class="col-md-12 customer_calculator_for_sell_return" style="padding-right:20px;display:none;">
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
                                                            <input disabled type="text" style="color:yellow!important;" class="form-control total_invoice_amount_for_calculator_for_sell_return"  value=""  placeholder="Invoice Amount">
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
                                                            <input type="text" style="color:yellow!important;" class="total_paying_amount_for_calculator_for_sell_return form-control invoice_paying_amount_for_sell_return" disabled placeholder=" Paying Amount">
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
                                                        <input type="text" class="form-control given_amount_for_calculator_for_sell_return form-control inputFieldValidatedOnlyNumeric"  placeholder="Given Amount" style="background-color:green;color:#ffff;">
                                                    </div> 
                                                </td>
                                                <td style="width:24.5%">
                                                    <div style="float:left;width:30%;">
                                                        <label style="padding-top: 0.375rem;">
                                                        Return
                                                        </label> 
                                                    </div>
                                                    <div style="float:right;width:70%;">
                                                        <input type="text"  class="form-control return_amount_for_calculator_for_sell_return" disabled placeholder="Return Amount"  style="background-color:red;color:#ffff !important;">
                                                    </div> 
                                                </td>
                                                <td style="width:2%">
                                                    <span style="color:red;background-color:#fff;cursor: pointer;" class="customer_calculator_close_for_sell_return">
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
                        
                            </div>
                            <!-----Invoice Payment--->
                            <br>
                            <!------end of Payment Info --->
                        </div>
                    </div>
                    
                   

                   
                </div><!------margin-top: -60px; --->
               

            </div><!-----modal-body--->

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-danger" data-dismiss="modal">Cancel</button>
                <input type="submit" value="Submit" disabled class="btn btn-success submitButton_for_sell_return">
            </div>
        </form>
    </div>
</div>
