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
                                    <strong>Reference No: </strong> <span style="font-size:14px;"> {{$data->reference_no}}</span>
                                </label>
                                <br/>
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
                    <!-----Start of Products--->
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Products: </h4>
                            <div class="product_related_response_here">
                            
                            </div>
                            <div class="table-responsive">
                                <table id="example1" class="table">
                                    <tr>
                                        <th colspan="4"></th>
                                        <th style="text-align: right">
                                            <input type="submit" value="Submit" class="btn btn-success">
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-----End of Products--->

                        <br/><br/>

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
            </div>
        </form>
    </div>
</div>
