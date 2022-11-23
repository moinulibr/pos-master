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
        <form method="POST" action="{{route('admin.sell.product.delivery.invoice.wise.quantity.store')}}" class="storeDeliveryDataFromDeliveryOption">
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
                    <div class="row">
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
                                    {{paymentStatus_hh($data->total_payable_amount,$data->total_paid_amount)}}
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
