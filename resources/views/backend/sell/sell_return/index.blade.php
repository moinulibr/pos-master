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

                    <!------Start of Payment Info --->
                    {{-- <div class="row">
                        <div class="col-md-12"> <h4>Payment Info: </h4> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Reference No</th>
                                            <th>Amount</th>
                                            <th>Credit/Debit</th>
                                            <th>Payment Method</th>
                                            <th>Payment Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div> --}}
                    <!------Start of Payment Info --->

                   
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-danger" data-dismiss="modal">Cancel</button>
                <input type="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
