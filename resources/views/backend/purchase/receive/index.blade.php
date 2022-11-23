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
                <strong style="mergin-right:20px;">Purchase Details (Invoice No.: {{$data->invoice_no}})</strong>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </h4>
        </div>
        <form method="POST" action="{{route('admin.purchase.product.receive.invoice.wise.quantity.store')}}" class="storeReceivingDataFromPurchaseProductReceiveOption">
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
                            <div class="mb-2">
                                <label>
                                    <strong>Reference No: </strong> <span style="font-size:14px;"> {{$data->reference_no}}</span>
                                </label>
                                <br/>
                                <label>
                                    <strong>Payment Status: </strong>
                                    {{paymentStatus_hh($data->total_payable_amount,$data->total_paid_amount)}}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-2">
                                <label>
                                    <strong>Supplier Name : </strong> <span style="font-size:14px;"> {{$data->supplier ? $data->supplier->name  :NULL}}</span>
                                </label>
                            </div>
                            <div class="mb-2">
                                <label>
                                    <strong>Address : </strong>
                                    {{$data->supplier ? $data->supplier->address  :NULL}}
                                </label>
                                <br/>
                                <label>
                                    <strong>Mobile : </strong>
                                    {{$data->supplier ? $data->supplier->phone  :NULL}}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-2">
                                <label>
                                    <strong>Shipping Note:</strong>
                                    {{$data->shipping_note}}
                                </label>
                            </div>
                            <div class="mb-2">
                                <label>
                                    <strong>Purchase Note: </strong>
                                    {{$data->purchase_note}}
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
                                    Purchase Product Receive
                                    </strong>
                                </h3>
                        </div>
                        <div class="col-md-4">
                            <label for="">Received From</label>
                            <input type="text" class="form-control" name="received_from">
                        </div>
                        <div class="col-md-4">
                            <label for="">Received Invoice/Chalan/Reference No</label>
                            <input type="text" class="form-control" name="received_invo_cln_ref_no">
                        </div>
                        <div class="col-md-4">
                            <label for="">Received Note</label>
                            <textarea name="receive_note"  class="form-control" cols="10" rows="1"></textarea>
                        </div>
                    </div>
                    <!-----Receive From and Received related information--->
                    <br/>
                    <input type="hidden" name="purchase_invoice_no" value=" {{$data->invoice_no}}">
                    <input type="hidden" name="purchase_chalan_no" value=" {{$data->chalan_no}}">
                    <input type="hidden" name="purchase_reference_no" value=" {{$data->reference_no}}">
                    <input type="hidden" name="supplier_id" value=" {{$data->supplier_id}}">
                    <!-----Start of Products--->
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Products: </h4>
                            <div class="product_related_response_here">
                            
                            </div>
                        </div>
                    </div>
                    <!-----End of Products--->

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-danger" data-dismiss="modal">Cancel</button>
                <input type="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
