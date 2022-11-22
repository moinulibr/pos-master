
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
                        <b>Customer</b>
                        <address>
                            Name<strong>: {{$data->customer ? $data->customer->name : NULL}}</strong>
                            <br/>
                            Address : {{$data->customer ? $data->customer->address ?? "NILL" : NULL}}
                            <br/>
                            Mobile: {{$data->customer ? $data->customer->phone : NULL}}
                        </address>
                    </div>
                    <div class="col-md-4 invoice-col">
                        <b>Company</b>
                        <address >
                            <strong style="font-size:15px;">{{companyName_hh()}}</strong>
                            <br>
                            {{companyFullAddress()}} <br>
                            Mobile: {{companyPhone_hh()}} <br>
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <b>Invoice No.:</b> #{{$data->invoice_no}}
                        <br>
                        <b>Date:</b> {{date(invoiceDateTimeFormat_hh(),strtotime($data->created_at))}}<br>
                        <b> Invoice Amount :</b> {{number_format($data->total_payable_amount,2,".","")}}{{currencySymbol_hh()}}<br>
                        <b> Paid Amount : </b> {{ number_format($data->total_paid_amount,2,".","") }}{{currencySymbol_hh()}} <br>
                        <b> Due Amount : </b>{{ number_format($data->due_amount,2,".","") }}{{currencySymbol_hh()}} <br>
                        <b>Payment Status:</b>
                        <span>
                            {{paymentStatus_hh($data->total_payable_amount,$data->total_paid_amount)}}
                        </span>
                        <br>
                    </div>
                </div>

                <br>
                <!--customer info-->
                <div class="row">
                    <div class="col-md-12">
                        {{-- <div class="table">
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
                        </div> --}}
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
                                    <tr>
                                        <th>Date</th>
                                        <th> 
                                            <small>Payment Invoice No</small>
                                        </th>
                                        <th>Amount</th>
                                        <th>Payment Method</th>
                                        <th>Payment Account</th>
                                        <th>Reference No</th>
                                        <th>Credit/Debit</th>
                                        <th>Payment Note</th>
                                        <th class="no-print">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->invoicePayment as $item)
                                    <tr class="@if (getCdfLabelBySingleCdfId_hh($item->cdf_type_id) == "Credit") text-info @else text-danger @endif">
                                        <td style="font-size:11px">
                                            {{date('d-m-Y',strtotime($item->created_at))}}
                                        </td>
                                        <td style="font-size:12px">
                                            {{ $item->payment_invoice_no }}
                                        </td>
                                        <td style="font-size:12px">
                                            {{ number_format($item->payment_amount,2,".","") }}
                                        </td>
                                        <td style="font-size:12px">
                                            {{ $item->paymentMethods ? $item->paymentMethods->name : NULL }}
                                        </td>
                                        <td style="font-size:12px">
                                            {{ $item->paymentAccount ? $item->paymentAccount->account_name : NULL }}<br/>
                                            {{ $item->paymentAccount ? $item->paymentAccount->account_no : NULL }}
                                        </td>
                                        <td>
                                            {{ $item->payment_reference_no }}
                                        </td>
                                        <td style="font-size:11px">
                                            {{getCdfLabelBySingleCdfId_hh($item->cdf_type_id)}}
                                        </td>
                                        <td style="font-size:12px">
                                            <small style="font-size:11px;">
                                                {{ $item->accountPaymentInvoice ? $item->accountPaymentInvoice->payment_note : NULL }}
                                            </small>
                                        </td>
                                        <td class="no-print" style="display:flex;font-size:11px;">
                                            <a href="#" data-id="25"  data-sale_final_id="13" data-payment_invoice_no="SI2022/0025" class="btn btn-danger btn-xs delete_payment" data-href="" style="cursor:no-drop;"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-----Invoice Payment--->
            
            </div>
        
    </div>
</div>
