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
                                        <th>Delivery Status</th>
                                        <th>Quantity</th>
                                        <th>Sell Price</th>
                                        <th>Qty Price</th>
                                        <th>Less Amount</th>
                                        <th  style="text-align:right;">SubTotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->sellProducts ? $data->sellProducts : NULL  as $item)
                                    <tr>
                                        @php
                                            $cats = json_decode($item->cart,true);
                                        @endphp
                                        <td> {{$item->custom_code}}</td>
                                        <td>
                                            @if (array_key_exists('productName',$cats))
                                                {{$cats['productName']}}
                                                @else
                                                NULL
                                            @endif
                                        </td>
                                        <td>

                                        </td>
                                        <td style="text-align: center">
                                            {{$item->quantity}}
                                            {{-- @if (array_key_exists('unitName',$cats))
                                                <small>{{$cats['unitName']}}</small>
                                                @else
                                                NULL
                                            @endif --}}
                                        </td>
                                        <td style="text-align: center;">
                                            {{$item->sold_price}}
                                        </td>
                                        <td style="text-align: center;">
                                            {{ number_format(($item->sold_price * $item->quantity),2,'.', '')}}
                                        </td>
                                        <td style="text-align: center;">
                                            {{$item->total_discount}}
                                        </td>
                                        <td style="text-align: right;">
                                            {{$item->total_sold_price}}   
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
                                        <th>Reference No</th>
                                        <th>Amount</th>
                                        <th>Credit/Debit</th>
                                        <th>Payment Method</th>
                                        <th>Payment Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach($data->payments??NULL as $payment)
                                    <tr>
                                        <td>{{date('d-m-Y',strtotime($payment->payment_date))}}</td>
                                        <td>{{$payment->payment_reference_no}}</td>
                                        <td>{{number_format($payment->payment_amount,2,'.','')}}</td>
                                            <td>
                                            {{getCDFName_HH($payment->cdf_type_id)}}
                                        </td>
                                        <td>{{$payment->paymentMethods?$payment->paymentMethods->method:NULL}}</td>
                                        <td>
                                            <small style="font-size:11px;">
                                            {{ $payment->paymentNotes?$payment->paymentNotes->payment_note:"--" }}
                                            </small>
                                        </td>
                                    </tr>
                                    @endforeach --}}
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
            <a class="btn btn-primary print" target="_blank" href="{{route('admin.sell.regular.normal.print.from.sell.list',$data->id)}}" style="cursor: pointer">Print</a>
            <button type="button" class="btn btn-secondary btn-danger" data-dismiss="modal">Cancel</button>
        </div>
    </div>
</div>
