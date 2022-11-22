
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
       
            <div class="modal-body">

                <input type="hidden" name="sell_invoice_id" value="{{$data->id}}">

                <div class="row">
                    <div class="col-sm-4 invoice-col">
                        Customer:
                        <address>
                            <strong> : Mahafuj</strong>
                            : Dhaka
                            <br>
                            Mobile: : 01723019475
                        </address>
                    </div>
                    <div class="col-md-4 invoice-col">
                        Business:
                        <address style="text-align:center;">
                            <strong style="font-size:22px;">TEST MOOD</strong>
                            <br>
                            Janata Bank More,Hafej Building Under Graound,FaridPur <br>
                            Mobile: 01711111192 <br>
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <b>Invoice No.:</b> #0013
                        <br>
                        <b>Date:</b> 25-04-2022 12:30:24 pm<br>
                        <b> Invoice Amount :</b> 440.00<br>
                        <b> Paid Amount : </b> 440.00 <br>
                        <b> Due Amount : </b>0 <br>
                        <b>Payment Status:</b>
                        <span>
                            <span class="badge badge-primary"> Paid </span>
                        </span>
                        <br>
                    </div>
                </div>

                <!--customer info-->
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
                                    <td style="width:50%">{{$data->customer ? $data->customer->name : NULL}}</td>
            
                                    <td style="width:17%">Phone</td>
                                    <td style="width:1%">:</td>
                                    <td style="width:18%">{{$data->customer ? $data->customer->phone : NULL}}</td>
                                </tr>
                                <tr>
                                    <td style="width:17%">Customer Type</td>
                                    <td style="width:1%">:</td>
                                    <td style="width:50%">{{$data->customer ? $data->customer->customer_type_id == 1 ? 'Permanent' : 'Walking' : NULL}}</td>
            
                                    <td style="width:17%;background-color:#f15454;color:#ffff;">
                                        Previous Due
                                    </td>
                                    <td style="width:1%">:</td>
                                    <td style="width:18%;background-color:#f15454;color:#ffff;">
                                        {{$data->customer ? $data->customer->total_due : NULL}}
                                    </td>
                                <tr>
                                    <td style="width:17%">Address</td>
                                    <td style="width:1%">:</td>
                                    <td style="width:50%">{{$data->customer ? $data->customer->address ?? "NILL" : NULL}}</td>
            
                                    <td style="width:17%;background-color:#35b935;color:#ffff;">
                                        Current Advance
                                    </td>
                                    <td style="width:1%;">:</td>
                                    <td style="width:18%;background-color:#35b935;color:#ffff;">
                                        <strong class="total_advance_amount">{{$data->customer ? $data->customer->total_advance : NULL}}</strong>
                                    </td>
                                </tr>
            
                                <tr>
                                    <th colspan="3" style="text-align: right;background-color:#433d48;color:#ffff;">Current Invoice Payable Amount</th>
                                    <th colspan="3" style="text-align: left;background-color:#8938dd;color:#ffff;">
                                        {{$data->total_payable_amount }}
                                    </th>
                                </tr>
                            </table>
                        </div>
                        <div class="table">
                            <table class="table table-bordered table striped">
                                <tr>
                                    <td style="width:30%;background-color:#8fd38f;color:#ffff;">Invoice Total Paid Amount</td>
                                    <td style="width:0.25%;background-color:#8fd38f;color:#ffff;">:</td>
                                    <td style="width:18%;background-color:#35b935;color:#ffff;">{{ $data->total_paid_amount }}</td>
                                    
                                    <td style="width:2.50%"></td>

                                    <td style="width:30%;background-color:#e67373;color:#ffff;text-align:right">Invoice Total Due Amount</td>
                                    <td style="width:0.25%;background-color:#e67373;color:#ffff;">:</td>
                                    <td style="width:18%;background-color:#f15454;color:#ffff;"><strong class="total_invoice_payble_amount">{{ $data->due_amount }}</strong></td>
                                </tr>
            
                            </table>
                        </div>
                    </div>
                </div>
                <!--customer info-->
                <br>
            
                <!-----Invoice Payment--->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr><th>Date</th>
                                    <th>Reference No</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Payment Account</th>
                                    <th>Payment Note</th>
                                    <th>Credit/Debit</th>
                                    <th class="no-print">Actions</th>
                                </tr></thead>
                                <tbody>
                                    <tr class="text-danger">
                                        <td style="font-size:11px">
                                            25-04-2022
                                        </td>
                                        <td style="font-size:12px">
                                            SI2022/0025
                                        </td>
                                        <td style="font-size:12px">
                                            1260.00
                                        </td>
                                        <td style="font-size:12px">
                                            
                                            Cash
                                            <small>(Cash)</small>
                                        </td>
                                        <td style="font-size:12px">
                                            <br>
                                            <small>(Cash)</small>
                                        </td>
                                        <td style="font-size:12px">
                                            <small style="font-size:11px;">
                                                
                                            </small>
                                        </td>
                                        <td style="font-size:11px">
                                            Debit
                                        </td>
                                        <td class="no-print" style="display: flex;font-size:11px;">
                                            
                                            <a href="#" data-id="25" data-sale_final_id="13" data-payment_invoice_no="SI2022/0025" class="btn btn-danger btn-xs delete_payment" data-href=""><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            &nbsp;
                                            
                                        </td>
                                    </tr>
                                    <tr class="text-danger">
                                        <td style="font-size:11px">
                                            25-04-2022
                                        </td>
                                        <td style="font-size:12px">
                                            SI2022/0023
                                        </td>
                                        <td style="font-size:12px">
                                            500.00
                                        </td>
                                        <td style="font-size:12px">
                                            
                                            Cash
                                            <small>(Cash)</small>
                                        </td>
                                        <td style="font-size:12px">
                                            <br>
                                            <small>(Cash)</small>
                                        </td>
                                        <td style="font-size:12px">
                                            <small style="font-size:11px;">
                                                
                                            </small>
                                        </td>
                                        <td style="font-size:11px">
                                            Debit
                                        </td>
                                        <td class="no-print" style="display: flex;font-size:11px;">
                                            
                                            <a href="#" data-id="23" data-sale_final_id="13" data-payment_invoice_no="SI2022/0023" class="btn btn-danger btn-xs delete_payment" data-href=""><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            &nbsp;
                                            
                                        </td>
                                    </tr>
                                    <tr class="text-success">
                                        <td style="font-size:11px">
                                            25-04-2022
                                        </td>
                                        <td style="font-size:12px">
                                            SI2022/0021
                                        </td>
                                        <td style="font-size:12px">
                                            2200.00
                                        </td>
                                        <td style="font-size:12px">
                                            
                                            Cash
                                            <small>(Cash)</small>
                                        </td>
                                        <td style="font-size:12px">
                                            <br>
                                            <small>(Cash)</small>
                                        </td>
                                        <td style="font-size:12px">
                                            <small style="font-size:11px;">
                                                
                                            </small>
                                        </td>
                                        <td style="font-size:11px">
                                            Credit
                                        </td>
                                        <td class="no-print" style="display: flex;font-size:11px;">
                                            
                                            <a href="#" data-id="21" data-sale_final_id="13" data-payment_invoice_no="SI2022/0021" class="btn btn-danger btn-xs delete_payment" data-href=""><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            &nbsp;
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-----Invoice Payment--->
            
            </div>
        
    </div>
</div>
