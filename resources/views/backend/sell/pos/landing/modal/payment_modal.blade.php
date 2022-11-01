<div class="modal fade text-left" id="payment-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel11" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document" >
        <div class="modal-content" style="overflow-y: auto !important">
            <form action="{{route('admin.sell.regular.pos.store.data.from.sell.cart')}}" method="POST"  class="storeDataFromSellCart">
                @csrf
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel11">Payment</h3>
                    <button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0" data-dismiss="modal" aria-label="Close">
                        <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path
                                fill-rule="evenodd"
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"
                            ></path>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="payment_data_response"></div>
                    
                    
                    

                    <input type="hidden" name="sell_type" value="1">
                    <div class="form-group row justify-content-end mb-0">
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" style="padding:7px 20px;">Close</button>
                            <input type="submit" class="submitButton btn btn-primary" value="Payment" style="padding:7px 20px;">
                        </div>
                    </div>
                   
                </div>
            </form>
        </div>
    </div>
</div>





{{-- <div class="modal fade text-left" id="payment-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel11" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Finalize Sale
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </h4>

        </div>
        <form action="https://test.nanarokom247.com/sales/store/from/add/to/cart/with/payment" method="POST" class="submitStoreFromAddToCartWithPayment">

            <div class="modal-body">
                <div class="row" style="margin-top:-5%;">
                    <div class="col-sm-12">
                                                                            <label>
                                <input type="hidden" name="price_cat_id[]" value="3">
                                <input type="hidden" name="product_id[]" value="23">
                                <input type="hidden" name="purchase_price[]" value="558.50">
                                <input type="hidden" name="sale_price[]" value="587.50">
                                <input type="hidden" name="quantity[]" value="1">
                                <input type="hidden" name="due_qty[]" value="">
                                <input type="hidden" name="discount_value[]" value="0">
                                <input type="hidden" name="discount_type[]" value="fixed">
                                <input type="hidden" name="product_sub_Total_sale_amount[]" value="587.50">
                                <input type="hidden" name="identity_number[]" value="">

                                <input type="hidden" name="sale_type_id[]" value="1">
                                <input type="hidden" name="sale_from_stock_id[]" value="2">
                                <input type="hidden" name="sale_unit_id[]" value="1">
                                <input type="hidden" class="advance_amount" id="advance_amount" name="previous_advance_amount" value="0">
                            </label>
                            <br>
                                                <br>
                        <input type="hidden" name="media_name" value="">
                        <input type="hidden" name="customer_mobile" value="">

                        <input type="hidden" name="customer_id" value="1">
                        <input type="hidden" name="reference_id" value="">
                        <input type="hidden" name="fianl_total_item" value="1">
                        <input type="hidden" name="final_sub_total_amount" value="587.50">
                        <input type="hidden" name="final_discount_type" value="fixedValue">
                        <input type="hidden" name="final_discount_value" value="0.00">
                        <input type="hidden" name="final_discount_amount" value="">
                        <input type="hidden" name="fianl_other_cost" value="0.00">
                        <input type="hidden" class="cr_fianl_payable_amount_get" id="fianl_payable_amount_get" name="fianl_payable_amount" value="587.50">

                        <input type="hidden" name="invoice_status" value="1">
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-6 bg-danger" style="padding: 10px">Customer Current Due:
                        <b>41180 tk</b>
                    </div>
                    <div class="col-md-6 bg-success" style="padding: 10px">Customer Current Advance:
                        <b>0 tk</b>
                    </div>
                    <div class="col-sm-12">
                        <h4 class="bg-warning" style="padding: 10px">Total Payable: 587.50 tk</h4>
                    </div>
                </div>
                <hr>
                <div class="row" style="margin-bottom:2%;">
                    <div class="col-sm-4">
                        <label>Pay By</label>
                        <select name="pay_by" id="pay_by" class="form-control">
                            <option value="due">Due</option>
                            <option value="cash">Cash</option>
                            <option value="advance">Advance</option>
                            <option value="both">Cash with Advance</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label>Paying Amount</label>
                        <input value="0" type="number" step="any" id="final_payable_amount" name="paid_amount" placeholder="Paid Amount" class="cr_final_payable_amount form-control" disabled="disabled">
                    </div>
                    
                    <div class="col-sm-4">
                        <label>Due Amount</label>
                        <input type="number" step="any" id="show_due_amount" disabled="" placeholder="Due Amount" class="cr_final_due_amount form-control" value="587.50">
                    </div>
                </div>


                <div style="border:1px dashed red; cursor: pointer;" onclick="$('#moneyChangeCalculator').slideToggle()">
                    <p class="text-center mt-10">
                        <strong>Money Change Calculator</strong>
                    </p>
                    <div id="moneyChangeCalculator" class="row mt-10" style="margin-bottom:2%;padding:0 2% 0 2%; display: none">
                        <div class="col-sm-4">
                            <label>Given Amount</label>
                            <input type="number" step="any" id="" placeholder="Given Amount" class="cr_given_amount_for_take_and_change form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>Change Amount</label>
                            <input type="number" step="any" disabled="" id="" placeholder="Change Amount" class="cr_change_amount_after_calculation form-control">
                        </div>
                    </div>
                </div>

                <div class="row mt-10" style="margin-top: 10px; display: none;" id="accountSection">
                    <div class="col-sm-12" style="text-align:center">
                        <label>Account</label>
                        <hr style="margin-top: 0px;margin-bottom: 0px;">
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-2">
                            <label for="method">Receving Method:*</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fas fa-money-bill-alt"></i>
                                </span>
                                <select name="payment_method_id" id="" class="payment_method_id_class form-control">
                                    <option value="">Select Method</option>
                                                                            <option value="2">Cash</option>
                                                                            <option value="3">Bank</option>
                                                                            <option value="4">Mobile Banking</option>
                                                                            <option value="5">Cheque</option>
                                                                            <option value="6">Card</option>
                                                                            <option value="7">Bank Transfer</option>
                                                                            <option value="8">Others</option>
                                                                    </select>
                            </div>
                        </div>
                        <input type="hidden" value="https://test.nanarokom247.com/get/account/by/payment/method" class="getAccountByPaymentMethod">
                    </div>
                    <div class="col-sm-4">

                    </div>


                    <!---Bank Account options---->
                    <div class="col-md-4 payment_account_div" style="display: none;">
                        <div class="mb-2">
                            <label for=""> Receive Payment To Account </label>
                            <select name="account_id" id="bank_id" class="bank_id_class form-control"></select>
                            <div style="color:red; padding: 0 5px;">
                                
                            </div>
                        </div>
                    </div>
                    <!---Bank Account options---->

                    <!---card payment options---->
                    <div class="col-sm-12 col-md-12 card_div" style="display:none;">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-2">
                                    <label for="">Card Number</label>
                                    <input name="card_number" value="0" id="card_number_id" type="text" class="form-control">
                                    <div style="color:red; padding: 0 5px;">
                                        </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-2">
                                    <label for="">Card holder name* <small></small></label>
                                    <input name="card_holder_name" id="card_holder_name_id" type="text" class="form-control" value="">
                                    <div style="color:red; padding: 0 5px;">
                                        </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-2">
                                    <label for="">Card Transaction No</label>
                                    <input name="card_transaction_no" id="card_transaction_no_id" type="text" class="form-control" value="">
                                    <div style="color:red; padding: 0 5px;">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="mb-2">
                                    <label for="">Card Type </label>
                                    <select name="card_type" id="card_type_id" class="form-control">
                                        <option value="">Select Card Type</option>
                                                                                    <option value="1">Credit Card</option>
                                                                                    <option value="2">Debit Card</option>
                                                                                    <option value="3">Visa Card</option>
                                                                                    <option value="4">Master Card</option>
                                                                            </select>
                                    <div style="color:red; padding: 0 5px;">
                                        </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-2">
                                    <label for=""><small>Card Expire Month</small></label>
                                    <select name="expire_month" class="form-control" id="">
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
                                    <div style="color:red; padding: 0 5px;">
                                        </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-2">
                                    <label for="">Card Expire Year</label>
                                    <select name="expire_year" class="form-control">
                                                                                    <option value="2021">2021</option>
                                                                                    <option value="2022">2022</option>
                                                                                    <option value="2023">2023</option>
                                                                                    <option value="2024">2024</option>
                                                                                    <option value="2025">2025</option>
                                                                                    <option value="2026">2026</option>
                                                                                    <option value="2027">2027</option>
                                                                                    <option value="2028">2028</option>
                                                                                    <option value="2029">2029</option>
                                                                                    <option value="2030">2030</option>
                                                                                    <option value="2031">2031</option>
                                                                                    <option value="2032">2032</option>
                                                                                    <option value="2033">2033</option>
                                                                                    <option value="2034">2034</option>
                                                                                    <option value="2035">2035</option>
                                                                                    <option value="2036">2036</option>
                                                                                    <option value="2037">2037</option>
                                                                                    <option value="2038">2038</option>
                                                                                    <option value="2039">2039</option>
                                                                                    <option value="2040">2040</option>
                                                                                    <option value="2041">2041</option>
                                                                                    <option value="2042">2042</option>
                                                                                    <option value="2043">2043</option>
                                                                                    <option value="2044">2044</option>
                                                                                    <option value="2045">2045</option>
                                                                                    <option value="2046">2046</option>
                                                                                    <option value="2047">2047</option>
                                                                                    <option value="2048">2048</option>
                                                                                    <option value="2049">2049</option>
                                                                                    <option value="2050">2050</option>
                                                                            </select>
                                    <div style="color:red; padding: 0 5px;">
                                        </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-2">
                                    <label for="">Security Code</label>
                                    <input name="card_security_code" type="text" class="form-control" value="">
                                    <div style="color:red; padding: 0 5px;">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!---card payment options end---->

                    <!---From Mobile Banking Account---->
                    <div class="col-sm-12 col-md-12 from_mobile_banking_account_div" id="" style="display: none;">
                        <div class="mb-2">
                            <label for="">From Mobile Banking Account</label>
                            <input name="from_mobile_banking_account" value="" type="text" class="form-control">
                            <div style="color:red; padding: 0 5px;">
                                
                            </div>
                        </div>
                    </div>
                    <!---From Mobile Banking Account end---->
                    <!---Cheque No---->
                    <div class="col-sm-12 col-md-12 cheque_div" id="" style="display:none;">
                        <div class="mb-2">
                            <label for="">Cheque No <small>(Customer Cheque No)</small> </label>
                            <input name="cheque_no" value="" type="text" class="form-control">
                            <div style="color:red; padding: 0 5px;">
                                </div>
                        </div>
                    </div>
                    <!---Cheque No end---->

                    <!---Bank Transfer No---->
                    <div class="col-sm-12 col-md-12 bank_transfer_div" style="display:none;">
                        <div class="mb-2">
                            <label for="">Bank Account No </label>
                            <input name="transfer_bank_account_no" value="" type="text" class="form-control">
                            <div style="color:red; padding: 0 5px;">
                                
                            </div>
                        </div>
                    </div>
                    <!---Bank Transfer No---->

                    <!---Others Transaction---->
                    <div class="col-sm-12 col-md-12 custom_payment_div" id="" style="display:none;">
                        <div class="mb-2">
                            <label for="">Transaction No. </label>
                            <input name="transaction_no" value="" type="text" class="form-control">
                            <div style="color:red; padding: 0 5px;">
                                </div>
                        </div>
                    </div>
                    <!---Others Transaction---->
                    <!--------Payment part End--------->

                    <!--------Due part---->
                    
                    <!--------Due part End---->
                </div>
                <hr>
                <div class="row mt-10">
                    <div class="col-sm-4">
                        <div class="checkbox">
                            <label>
                                <input name="send_sms" value="1" type="checkbox" class="colored-blue">
                                <span class="text">Send Invoice Via SMS</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-4 text-end">
                        <div class="checkbox">
                            <label>
                                <input name="send_email" value="1" type="checkbox" class="colored-blue">
                                <span class="text">Send Invoice Via Email</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label>Account Note</label>
                        <textarea name="payment_note" rows="3" class="form-control" placeholder="Enter..."></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" id="hidden" class="btn btn-info">Submit</button>
            </div>
        </form>
    </div>
</div>
</div>
 --}}