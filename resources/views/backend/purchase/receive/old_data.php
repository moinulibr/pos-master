
            <div class="invoice__metaInfo" style="margin-top:-10px;">
                <div class="col-lg-3" style="margin-top:-10px;">
                    <div class="invoice__orderDetails" style="margin-top:1px;">
                        <strong  style="font-size: 15px">{{ __('Order Details') }} </strong><br>
                        <span><strong>{{ __('Invoice Number') }} :</strong> {{ $data->invoice_no }}</span><br>
                        <span>{{ __('Order Date') }} : <span> </span> {{ date('d-m-Y',strtotime($data->created_at)) }}</span><br>
                        <span>{{  __('Order ID')}} : <span> </span> {{ sprintf("%'.08d", $data->id) }}</span>
                    </div>
                </div>
                <div class="col-lg-5"  style="margin-top:-10px;">
                    <div class="invoice__orderDetails" style="margin-top:1px;">
                        <strong  style="font-size: 15px">{{ __('Customer Details') }}</strong><br>
                        <span>{{ __('Customer Name') }}</span>:  <span> {{ $data->customer ? $data->customer->name : "N/L" }} </span><br>
                        <span>{{ __('Customer Phone') }}</span>:  <span> {{ $data->customer ? $data->customer->phone : "N/L" }}</span><br>
                        <span>{{ __('Address') }}</span>: <span>{{ $data->customer ? $data->customer->address : "N/L" }}</span>
                    </div>
                </div>
                
                <div class="col-lg-4" style="margin-top:-10px;">
                    <div class="invoice__orderDetails" style="margin-top:1px;">
                        <strong  style="font-size: 15px">{{ __('Shipping Details') }}</strong><br>
                        <span>{{ __('Shipping Phone') }}</span>: <span>{{ $data->shipping ? $data->shipping->phone : "N/L" }} </span><br>
                        <span>{{ __('Shipping Address') }}</span>: <span> {{ $data->shipping ? $data->shipping->address : "N/L" }}</span><br/>
                        <span>{{ __('Receiver Details') }}</span>: <span> {{$data->receiver_details ?? NULL}} </span><br>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-12">
                    <div class="invoice_table">
                        <div class="mr-table">
                            <div class="table-responsive">
                                <table id="example2" class="table table-hover dt-responsive" cellspacing="0"
                                    width="100%">
                                    <thead style="border-top:1px solid rgba(0, 0, 0, 0.1) !important;">
                                        <tr>
                                            <th>{{ __('Sl.') }}</th>
                                            <th>{{ __('AS Code') }}</th>
                                            <th style="width:50%">{{ __('Product') }}</th>
                                            <th  style="text-align: center;">{{ __('Qty') }}</th>
                                            <th  style="text-align: center;">{{ __('Sale Price') }}</th>
                                            <th  style="text-align: right;">{{ __('Subtotal') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 0;
                                        @endphp
                                        @foreach ($data->sellProducts ? $data->sellProducts : NULL  as $item)
                                        <tr>
                                            @php
                                                $cats = json_decode($item->cart,true);
                                                $i++;
                                            @endphp
                                            <td>{{ $i }}</th>
                                            <td>{{$item->custom_code}} </th>
                                            <td style="width:50%">
                                                @if (array_key_exists('productName',$cats))
                                                    {{$cats['productName']}}
                                                    @else
                                                    NULL
                                                @endif    
                                            </th>
                                            <td style="text-align: center;">
                                                {{$item->quantity}}
                                                {{-- @if (array_key_exists('unitName',$cats))
                                                    <small>{{$cats['unitName']}}</small>
                                                    @else
                                                    NULL
                                                @endif --}}    
                                            </th>
                                            <td style="text-align: center;">{{$item->sold_price}}</th>
                                            <td style="text-align: right;"> 
                                                {{$item->total_sold_price}}
                                                @if ($item->total_discount > 0)
                                                    <br/>
                                                    (Less : {{ $item->total_discount }})
                                                @endif 
                                            </th>
                                        </tr> 
                                        @endforeach
                                        <tr>
                                            <th colspan="2">Less : 
                                                <span style="margin-left:5px;">
                                                    {{$data->total_discount}} 
                                                </span> 
                                            </th>
                                            <th style="text-align: center;">
                                                <span style="margin-right:5px;">
                                                    Shipping :  {{$data->shipping_cost}},     
                                                </span>    
                                                <span style="margin-left:5px;margin-right:5px;">
                                                    Other :  {{$data->others_cost}},     
                                                </span>  
                                                <span style="margin-left:8px;margin-right:2px;">
                                                    Total :  {{$data->total_payable_amount}}     
                                                </span> 
                                            </th>
                                            <th colspan="2" style="text-align: right;">
                                                Subtotal
                                            </th>
                                            <th style="text-align: right;">{{$data->subtotal}}</th>
                                        </tr>
                                        <tr>
                                            <th colspan="2">
                                                Paid  : 
                                                <span style="margin-left:5px;">
                                                    {{ $data->total_paid_amount ?? 0.00 }} 
                                                </span> 
                                            </th>
                                            <th style="text-align: center;">
                                                <span style="margin-right:5px;">
                                                    Current Due :  {{ $data->due_amount ?? 0.00 }},     
                                                </span>    
                                                <span style="margin-left:5px;margin-right:5px;">
                                                    Previous Due :  {{$data->others_cost}},     
                                                </span>  
                                            </th>
                                            <th colspan="2" style="text-align: right;">
                                                Total Due Amount
                                            </th>
                                            <th style="text-align: right;">{{$data->subtotal}}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

              
            </div>
            