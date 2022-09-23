
<div style="padding-top: 6px; margin-top:10px; border: 2px solid #ddcbcb;">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <th  style="font-size:15px;background-color:black;color: floralwhite;border-bottom-color:#f1e7e7;">
                    Stock
                </th>
                <th style="font-size:14px;background-color:green;color:#ffff;border-bottom-color:#f1e7e7;">
                  Current Quantity
                </th>
                @foreach ($product->priceNORWhereStatusIsActive() as $ppric) 
                    <td style="font-size: 12px;">{{$ppric->label}}</td>
                    <input type="hidden" name="prices[]" value="{{$ppric->id}}">
                @endforeach
                <td>Purchase Qty</td>
                <td style="width: 5%;"><small>Purchase Checked</small></td>
                <td  style="width: 5%;"><small style="font-size: 8px;">Calcuation</small></td>
                <td>Subtotal</td>
                <td><small>Instant Receive</small></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($product->productStockNORWhereStatusIsActive() as $productStock)    
                <tr>
                    <th style="font-size:15px;background-color:black;color: floralwhite;border-bottom-color:#f1e7e7;">
                        {{$productStock->label}}
                        <input type="hidden" name="stocks[]" value="{{$productStock->sId}}">
                    </th>
                    <th style="font-size:14px;background-color:green;color:#ffff;border-bottom-color:#f1e7e7;">
                        {{$productStock->available_base_stock}}
                    </th>
                    @foreach ($productStock->productStockWiseProductPrices() as $pSPPrice) 
                        <td>
                            <input type="text" data-price_id="{{$pSPPrice->pId}}" data-stock_id="{{$productStock->sId}}"  data-previous_price="{{$pSPPrice->price}}"  class="stock_price_id_{{$productStock->sId}}_{{$pSPPrice->pId}} stock_price_id mrp_price_id_{{$pSPPrice->pId}} price_set_common_class form-control inputFieldValidateWithNumber" name="price_sid_{{$productStock->sId}}_pid_{{$pSPPrice->pId}}">
                        </td>
                    @endforeach
                    <td>
                        <input type="text" class="form-control purchasing_qty purchasing_qty_{{$productStock->sId}} inputFieldValidateWithNumber" data-stock_id="{{$productStock->sId}}" name="purchase_quantity_sid_{{$productStock->sId}}">
                    </td>
                    <td>
                        <input type="checkbox" class="form-control purchase_qty_check purchase_qty_check_{{$productStock->sId}}" data-stock_id="{{$productStock->sId}}" data-stock_name="{{$productStock->label}}">
                    </td>
                    <td>
                        <input type="checkbox" class="form-control calculation_price calculation_price_{{$productStock->sId}}" data-stock_id="{{$productStock->sId}}" data-stock_name="{{$productStock->label}}">
                    </td> 
                    <td>
                        <input type="text" disabled class="form-control calculation_line_subtotal_price calculation_line_subtotal_price_{{$productStock->sId}}" data-stock_id="{{$productStock->sId}}">
                        <input type="hidden" class="form-control calculation_line_subtotal_price calculation_line_subtotal_price_{{$productStock->sId}}" data-stock_id="{{$productStock->sId}}" name="subtotal_sid_{{$productStock->sId}}">
                    </td>
                    <td>
                        <input type="text" class="form-control instant_receiving_qty instant_receiving_qty_{{$productStock->sId}}" data-stock_id="{{$productStock->sId}}" name="instant_receive_sid_{{$productStock->sId}}">
                        <input type="hidden" class="form-control remaining_qty remaining_qty_{{$productStock->sId}}" data-stock_id="{{$productStock->sId}}" name="remaining_qty_sid_{{$productStock->sId}}">
                    </td>
                </tr>
            @endforeach
        </tbody>       
        <input type="hidden" name="" class="mrp_purchase_sell_id" value="{{mrpPriceId_hh()}}">
        <input type="hidden" name="" class="purchase_price_id" value="{{purchasePriceId_hh()}}">
        <input type="hidden" name="" class="offer_purchase_price_id" value="{{offerPurchasePriceId_hh()}}">
        <input type="hidden" name="" class="purchaseLineTotalSubtotalWhenCartCreateAndShowCartList" value="{{purchaseLineTotalSubtotalWhenCartCreateAndShowCartList_hh()}}">

    </table>
</div>
















{{-- 
<div style="padding-top: 6px; margin-top:10px; border: 2px solid #ddcbcb;">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <th  style="font-size:15px;background-color:black;color: floralwhite;border-bottom-color:#f1e7e7;">
                    Stock
                </th>
                <th style="font-size:14px;background-color:green;color:#ffff;border-bottom-color:#f1e7e7;">
                  Current Quantity
                </th>
                @foreach ($product->priceNORWhereStatusIsActive() as $ppric) 
                    <td style="font-size: 12px;">{{$ppric->label}} {{$ppric->id}}</td>
                    <input type="hidden" name="prices[]" value="{{$ppric->id}}">
                @endforeach
                <td>Purchase Qty</td>
                <td><small>Changing Qty+Price</small></td>
                <td><small>Same price to all stock</small></td>
                <td>Subtotal</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($product->productStockNORWhereStatusIsActive() as $productStock)    
                <tr>
                    <th style="font-size:15px;background-color:black;color: floralwhite;border-bottom-color:#f1e7e7;">
                        {{$productStock->label}}
                        <input type="hidden" name="stocks[]" value="{{$productStock->sId}}">
                    </th>
                    <th style="font-size:14px;background-color:green;color:#ffff;border-bottom-color:#f1e7e7;">
                        {{$productStock->available_base_stock}}
                    </th>
                    @foreach ($productStock->productStockWiseProductPrices() as $pSPPrice) 
                        <td>
                            <input type="text" data-price_id="{{$pSPPrice->pId}}" data-stock_id="{{$productStock->sId}}" value="{{$pSPPrice->price}}" class="stock_price_id_{{$productStock->sId}}{{$pSPPrice->pId}} stock_price_id form-control inputFieldValidateWithNumber" name="p_{{$pSPPrice->pId}}_s_{{$productStock->sId}}">
                        </td>
                    @endforeach
                    
                    @foreach ($product->priceNORWhenThidPriceIsNotStoreInPreviousTime() as $notStoredPrice)
                    <td> 
                        <input type="text" data-price_id="{{$notStoredPrice->id}}" data-stock_id="{{$productStock->sId}}" value="0" class="nspt_stock_price_id_{{$productStock->sId}}{{$notStoredPrice->id}} nspt_stock_price_id form-control inputFieldValidateWithNumber" name="p_{{$notStoredPrice->id}}_s_{{$productStock->sId}}">
                    </td>                  
                    @endforeach 
                   
                    <td>
                        <input type="text" class="form-control inputFieldValidateWithNumber">
                    </td>
                    <td>
                        <input type="checkbox" class="form-control">
                    </td> 
                    <td>
                        <input type="checkbox" class="form-control">
                    </td>
                    <td>
                        <input type="text" class="form-control inputFieldValidateWithNumber">
                    </td>
                </tr>
            @endforeach
            
            @foreach ($product->stockNORWhenThidStockIsNotStoreInPreviousTime() as $item)
                <tr>
                    <td style="font-size:15px;background-color:black;color:floralwhite;border-bottom-color:#f1e7e7;">
                        {{$item->label}}
                        <input type="hidden" name="stocks[]" value="{{$item->id}}">
                    </td>
                    <td style="font-size:14px;background-color:green;color:#ffff;border-bottom-color:#f1e7e7;">
                        0.00
                    </td>
                    @foreach ($product->priceNORWhereStatusIsActive() as $ppric) 
                    <td style="font-size: 12px;">
                        <input type="text" name="p_{{$ppric->id}}_s_{{$item->id}}"  value="0" class="form-control inputFieldValidateWithNumber">
                    </td>
                    @endforeach
                    <td>
                        <input type="text" class="form-control inputFieldValidateWithNumber">
                    </td>
                    <td>
                        <input type="checkbox" class="form-control">
                    </td> 
                    <td>
                        <input type="checkbox" class="form-control">
                    </td>
                    <td>
                        <input type="text" class="form-control inputFieldValidateWithNumber">
                    </td>
                </tr>
            @endforeach 
           
        </tbody>
        
    </table>
</div> 
--}}

















        
        
        {{-- <tr style="background-color:green;color:white;">
            <td  style="cursor: pointer">
                <span style="cursor: pointer">
                    Offer Stock
                </span>
            </td>
            <td  style="cursor: pointer;text-align:center;background-color: #979797">
                <span style="cursor: pointer;">
                    80
                </span>
            </td>
            <td  style="cursor: pointer">
                <span style="cursor: pointer">
                <small>
                    24
                </small>
                </span>
            </td>
            <td  style="cursor: pointer">
                <span style="cursor: pointer">
                <small>
                    60
                </small>
                </span>
            </td>
            <td  style="cursor: pointer">
                <span style="cursor: pointer">
                <small>
                    35
                </small>
                </span>
            </td>
            <td  style="cursor: pointer">
                <span style="cursor: pointer">
                <small>
                    40
                </small>
                </span>
            </td>
            <td  style="cursor: pointer">
                <span style="cursor: pointer">
                <small>
                    36
                </small>
                </span>
            </td>
        </tr> --}}