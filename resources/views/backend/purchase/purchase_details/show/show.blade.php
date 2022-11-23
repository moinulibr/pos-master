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

        <div class="modal-body">


            <div style="margin-top: -80px;">

               
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

                <br/>
                <!-----Start of Products--->
                <div class="row">
                    <div class="col-md-12">
                        <h4>Products: </h4>
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>AS Code</th>
                                        <th style="width:40%;">Product</th>
                                        <th>Quantity</th>
                                        <th><small>Receiving Qty & Status</small></th>
                                        <th>Purchase Price</th>
                                        <th>MRP Price</th>
                                        <th  style="text-align:right;">SubTotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->purchaseProducts ? $data->purchaseProducts : NULL  as $item)
                                    <tr>
                                        @php
                                            $cat = json_decode($item->carts,true);
                                        @endphp
                                        <td> {{$item->custom_code}}</td>
                                        <td>
                                            @if (array_key_exists('productName',$cat))
                                                {{$cat['productName']}}
                                                @else
                                                NULL
                                            @endif
                                        </td>
                                        
                                        <td style="text-align: center">
                                            {{$item->quantity}}
                                        </td>
                                        @foreach ($item->purchaseProductStocks ? $item->purchaseProductStocks : NULL  as $ppsitem)
                                        <td>
                                            {{ number_format(($ppsitem->total_delivered_qty ),2,'.', '')}}
                                            @if ($ppsitem->total_delivered_qty == $ppsitem->total_quantity)
                                                <span class="badge badge-info">Received All</span>
                                                @else 
                                                <span class="badge badge-danger">Partial Received</span>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            {{ number_format(($ppsitem->purchase_price),2,'.', '')}}
                                        </td>
                                        <td style="text-align: center;">
                                            {{ number_format(($ppsitem->mrp_price),2,'.', '')}}
                                        </td>
                                        @endforeach
                                        <td style="text-align: right;">
                                            {{ number_format(($item->total_purchase_price ),2,'.', '')}}   
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-----End of Products--->

                    <br/><br/>

                <!------Start of Payment Info --->
                <div class="row">
                    <div class="col-md-12"> <h4>Payment Info: </h4> </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th><small>Payment Invoice No</small></th>
                                        <th>Amount</th>
                                        <th>Credit/Debit</th>
                                        <th>Payment Method</th>
                                        <th>Payment Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->invoicePayment ?? [] as $payment)
                                    <tr class="@if (getCdfLabelBySingleCdfId_hh($payment->cdf_type_id) == "Credit") text-info @else text-danger @endif">
                                        <td>{{date('d-m-Y',strtotime($payment->payment_date))}}</td>
                                        <td>{{$payment->payment_invoice_no}}</td>
                                        <td>{{number_format($payment->payment_amount,2,'.','')}}</td>
                                            <td>
                                            {{getCdfLabelBySingleCdfId_hh($payment->cdf_type_id)}}
                                        </td>
                                        <td>{{$payment->paymentMethods?$payment->paymentMethods->name:NULL}}</td>
                                        <td>
                                            <small style="font-size:11px;">
                                            {{ $payment->accountPaymentInvoice?$payment->accountPaymentInvoice->payment_note:"--" }}
                                            </small>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <strong>Sub Total</strong>
                                        </td>
                                        <td></td>
                                        <td style="text-align:right;">
                                            <span style="font-size:14px;"> {{$data->subtotal}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" >
                                            <strong>Less Amount</strong>
                                        </td>
                                        <td>(-)</td>
                                        <td style="text-align:right;">
                                            <span style="font-size:14px;"> {{$data->total_discount}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <strong>({{ $data->vat_amount }}%) Vat</strong>
                                        </td>
                                        <td>(+)</td>
                                        <td style="text-align:right;">
                                            {{ $data->total_vat }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <strong>Shipping</strong>
                                        </td>
                                        <td></td>
                                        <td style="text-align:right;">
                                            <span style="font-size:14px;"> {{$data->shipping_cost}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <strong>Other cost</strong>
                                        </td>
                                        <td></td>
                                        <td style="text-align:right;">
                                            <span style="font-size:14px;"> {{$data->others_cost}}</span>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td colspan="2">
                                            <strong>Round off</strong>
                                        </td>
                                        <td>(+/-)</td>
                                        <td style="text-align:right;">
                                            <span style="font-size:14px;"> {{$data->round_amount}}</span>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td colspan="2">
                                            <strong>Total Payable</strong>
                                        </td>
                                        <td></td>
                                        <td style="text-align:right;">
                                            {{$data->total_payable_amount}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <strong>Total Paid</strong>
                                        </td>
                                        <td></td>
                                        <td style="text-align:right;">
                                            {{$data->total_paid_amount}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <strong>Total Due</strong>
                                        </td>
                                        <td></td>
                                        <td style="text-align:right;">
                                            {{$data->due_amount}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!------Start of Payment Info --->

            </div>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-danger" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary print" target="_blank" href="{{route('admin.purchase.regular.normal.print.from.purchase.list',$data->id)}}" style="cursor: pointer">Print</a>
        </div>
    </div>
</div>
