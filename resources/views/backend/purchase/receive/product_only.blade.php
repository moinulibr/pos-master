<div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th style="width:5%;">AS Code</th>
                <th style="width:35%;">Product</th>
                <th style="width:5%;">Quantity</th>
                <th style="width:55%;">
                    <div class="table-responsive"  style="padding-bottom: 0px;margin-bottom: -7px !important;">
                        <table id="example1" class="table table-bordered table-striped table-hover" style="padding-bottom: 0px;margin-bottom: 0px;">
                            <tr>
                                <td  style="width:25%;">Stock Name</td>
                                <td  style="width:5%;">
                                    <small>Purchase Qty</small>
                                </td>
                                <td  style="width:15%;">
                                    <small>Received Qty</small>
                                </td>
                                <td  style="width:15%;">
                                    <small>Remaining Rec. Qty</small>
                                </td>
                                <td  style="width:25%;">
                                    <small>Receiving Qty</small>
                                </td>
                                <td  style="width:10%;text-align: center">
                                    <input class="check_all_class form-control" type="checkbox" value="all" name="check_all" style="box-shadow:none;">
                                </td>
                            </tr>
                        </table>
                    </div> 
                </th>
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
                <td>
                    <div class="table-responsive" style="padding-bottom: 0px;margin-bottom: -7px !important;">
                        <table id="example1" class="table table-bordered table-striped table-hover"  style="padding-bottom: 0px;margin-bottom: 0px;">
                            @foreach ($item->purchaseProductStocks as $pstock)
                            <tr>
                                <td style="width:21%;">
                                    <small>
                                        {{ $pstock->stock ? $pstock->stock->label : NULL}}
                                    </small>
                                </td>
                              
                                <td style="width:5%;text-align: center">{{$pstock->total_quantity}}</td>
                                <td style="width:15%;text-align: center">{{$pstock->total_delivered_qty}}</td>
                                <td style="width:15%;text-align: center">{{$pstock->remaining_delivery_qty}}</td>
                                <td style="width:25%;text-align: center">
                                    @php
                                        $totalAvailableStockWithReducedStockButNotDelivered = ($pstock->productStock ? $pstock->productStock->available_base_stock : 0) + ($pstock->productStock ? $pstock->productStock->reduced_base_stock_remaining_delivery : 0);
                                        $totalAvailableStock = ($pstock->productStock ? $pstock->productStock->available_base_stock : 0);
                                        $totalRemainingDeliveryQty = $pstock->remaining_delivery_qty;
                                        $deliveryingQtyNow = 0;
                                        if(($totalAvailableStockWithReducedStockButNotDelivered > $totalRemainingDeliveryQty) 
                                                && ($totalRemainingDeliveryQty > 0) 
                                        )
                                        {
                                            $deliveryingQtyNow = $totalRemainingDeliveryQty; 
                                          
                                        }
                                        else if(($totalAvailableStockWithReducedStockButNotDelivered == $totalRemainingDeliveryQty) 
                                        && ($totalRemainingDeliveryQty > 0) 
                                        )
                                        {
                                            $deliveryingQtyNow = $totalRemainingDeliveryQty; 
                                        }
                                        else if(($totalAvailableStockWithReducedStockButNotDelivered < $totalRemainingDeliveryQty)
                                            && ($totalRemainingDeliveryQty > 0) 
                                        )
                                        {
                                            $deliveryingQtyNow = $totalAvailableStockWithReducedStockButNotDelivered; 
                                        }
                                        else if($totalRemainingDeliveryQty == 0) 
                                        {
                                            $deliveryingQtyNow = 0; 
                                        }else{
                                            $deliveryingQtyNow = 0; 
                                        }
                                    @endphp
                                    @if ($deliveryingQtyNow > 0 && $totalRemainingDeliveryQty > 0)
                                     <input type="text" name="deliverying_qty_{{$pstock->id}}" value="{{$deliveryingQtyNow}}" class="form-control deliverying_qty deliverying_qty_{{$pstock->id}} inputFieldValidatedOnlyNumeric" data-id="{{$pstock->id}}">
                                        @elseif ($deliveryingQtyNow == 0 && $totalRemainingDeliveryQty == 0)
                                        <input type="text" disabled value="{{$deliveryingQtyNow}}" class="form-control" style="background-color: green;color:#ffff;">
                                        @elseif ($deliveryingQtyNow == 0 && $totalRemainingDeliveryQty > 0)
                                        <input type="text" disabled value="{{$deliveryingQtyNow}}" class="form-control" style="background-color: red;color:#ffff;">
                                     @endif
                                </td>
                                <td style="width:10%;text-align: center">
                                    <input type="hidden" class="total_remaining_delivery_qty total_remaining_delivery_qty_{{$pstock->id}}" value="{{$pstock->remaining_delivery_qty}}">
                                    <input type="hidden" class="total_base_available_stock_WRBND_qty total_base_available_stock_WRBND_qty_{{$pstock->id}}" value="{{$totalAvailableStockWithReducedStockButNotDelivered}}">
                                    @if ($deliveryingQtyNow > 0)
                                    <input type="hidden" value="{{$data->id}}" name="purchase_invoice_id">
                                    <input class="check_single_class form-control check_single_class_{{$pstock->id}}" type="checkbox"  name="checked_id[]" value="{{ $pstock->id }}" id="{{$pstock->id}}" style="box-shadow:none;">
                                        @else
                                        <input class="form-control" type="checkbox" disabled style="box-shadow:none;" >
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div> 
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>