

    <div style="background-color:#64b764;color:#fbfbfb;margin-top:5px;padding:5px;text-align:center">
        <span for="" style="color:yellow;">Selling from : </span>
        <strong style="font-size: 16px;">{{$productStock->label}}</strong>
        <br/>
        <span style="text-align: center;background-color:rgb(8, 13, 48); padding:0px 3px;"class="">
            <span style="font-size:12px;">Available Stock : </span>
            {{$productStock->available_base_stock}}
        </span>
        <input type="hidden" class="available_base_stock_for_this_selling_stock" value="{{$productStock->available_base_stock}}">
    </div>

    <div style="padding-top: 6px; margin-top:10px;">

        {{-- <input type="hidden" class="defaultSelectedPriceId" id="defaultSelectedPriceId" value="{{$defaultPriceId}}">
        <input type="hidden" class="selectedPriceId" id="selectedPriceId"> --}}

        @foreach ($productStock->productStockWiseProductPrices() as $productPrice)
                
            <span data-price_{{$productPrice->pId}}="{{$productPrice->price}}" id="selling_from_price_id_{{$productPrice->pId}}" name="selling_price" class="switcher-input selling_from_price_id selling_from_price_id_{{$productPrice->pId}} selling_from_price selling_from_price_{{$productPrice->id}}" data-selling_from_price_id="{{$productPrice->pId}}"  data-selling_from_product_price_id="{{$productPrice->id}}" style="margin-top:5px;" >
                   
                    {{-- <input type="hidden" class="selectedPriceId selectedPriceId_{{$productPrice->pId}}" id="selectedPriceId_{{$productPrice->pId}}"> --}}
                    
                    <label class="switcher selling_from_price_label selling_from_price_label_{{$productPrice->pId}}"  data-selling_from_price_id="{{$productPrice->pId}}"  data-selling_from_product_price_id="{{$productPrice->id}}"  style="cursor: pointer;padding-left:4px;background-color:#e2f7f6;margin-bottom:8px;width:100%">
                        {{-- <input type="radio"  id="selling_from_price_id_{{$productPrice->pId}}" name="selling_price" class="switcher-input selling_from_price_id selling_from_price_id_{{$productPrice->pId}} selling_from_price selling_from_price_{{$productPrice->id}}" data-selling_from_price_id="{{$productPrice->pId}}"  data-selling_from_product_price_id="{{$productPrice->id}}" value="{{$productPrice->price}}" style="margin-top:5px;" /> --}}
                    
                        <span class="check_when_selected check_when_selected_{{$productPrice->pId}}" style="display:none;background-color:green;color:white;padding: 3px 1px 3px 1px;margin-left: -3px;margin-right: 0px;padding-right: 0px;padding-top:2px;">
                            <i style="font-size:18px;" class="fa fa-check-square"></i>
                        </span>
                        <span class="uncheck_when_not_selected uncheck_when_not_selected_{{$productPrice->pId}}" style="background-color:#938a8a;padding: 3px;margin-left: -3px;margin-right: 1px;padding-right: 0px">
                            <i class="fas fa-circle-notch"></i>
                        </span>
                        
                        <span class="switcher-label selling_from_price_label_css selling_from_price_label_css_{{$productPrice->pId}}" style="font-size:14px;cursor:pointer;color:#160c0c;width:75%;">
                            {{$productPrice->label}}
                        </span>
                        <span  class="float-right" style="cursor:pointer;margin-left:2px;margin-right:1px;color:#fff;background-color:#ff4a00;border-radius:4px;padding:0px 2px;margin-top: 2px;margin-bottom:2px;">
                            {{$productPrice->price}}
                        </span>
                    </label>
                </span>
            
            <input type="hidden" class="price_id_{{$productPrice->pId}} price_id product_price_id product_price_id_{{$productPrice->id}}" data-price_id="{{$productPrice->pId}}" data-price_name_{{$productPrice->pId}} ="{{$productPrice->pName}}" value="{{$productPrice->price}}">
            @if ($productPrice->pName == 'purchase_price')
                <input type="hidden" class="selling_from_purchase_price" name="purchase_price" value="{{$productPrice->price}}">
            @endif
            @if ($productPrice->pName == 'sell_price')
                <input type="hidden" class="selling_from_sell_price" name="sell_price" value="{{$productPrice->price}}">
            @endif
            @if ($productPrice->pName == 'mrp_price')
                <input type="hidden" class="selling_from_mrp_price" name="mrp_price" value="{{$productPrice->price}}">
            @endif
        @endforeach
    </div>











    {{-- <div style="background-color:#64b764;color:#fbfbfb;margin-top:5px;padding:5px;text-align:center">
        <span for="">Selling from : </span>
        <span>Offer Stock</span>
    </div>

    <div style="padding-top: 6px; margin-top:10px;">

        <label class="switcher" style="cursor: pointer;padding-left:7px;background-color:#e2f7f6;padding-right:7px;margin-bottom:8px;width:100%">
            <input type="radio"  name="variant_position_0" class="switcher-input variant_position variant_position_0" data-variant_position="0" value="befor_name" style="margin-top:5px;" />
            <span class="switcher-indicator" style="cursor: pointer;">
                <span class="switcher-yes"></span>
                <span class="switcher-no"></span>
            </span>
            <span class="switcher-label" style="font-size:14px;cursor:pointer;color:#160c0c;width:75%;">
                MRP Price
            </span>
            <span  class="float-right" style="cursor:pointer;margin-left:5px;margin-right:5px;color:#fff;background-color:#ff4a00;border-radius:4px;padding:0px 2px;margin-top: 2px;">
                80
            </span>
        </label>
    </div> --}}
        {{-- <label class="switcher" style="cursor: pointer;background-color:#e2f7f6;padding-right:7px;margin-bottom:8px;width:100%">
            <input type="radio"  name="variant_position_0" class="switcher-input variant_position variant_position_0" data-variant_position="0" value="befor_name" checked />
            <span class="switcher-indicator" style="cursor: pointer;">
                <span class="switcher-yes"></span>
                <span class="switcher-no"></span>
            </span>
            <span class="switcher-label" style="font-size:14px;cursor:pointer;color:#160c0c;width:75%;">
                Offer Price
            </span>
            <span class="float-right"  style="cursor:pointer;margin-left:5px;margin-right:5px;color:#fff;background-color:#ff4a00;border-radius:4px;padding:0px 2px;">
                36
            </span>
        </label>
        <label class="switcher" style="cursor: pointer;background-color:#e2f7f6;padding-right:7px;margin-bottom:8px;width:100%">
            <input type="radio"  name="variant_position_0" class="switcher-input variant_position variant_position_0" data-variant_position="0" value="befor_name"  />
            <span class="switcher-indicator" style="cursor: pointer;">
                <span class="switcher-yes"></span>
                <span class="switcher-no"></span>
            </span>
            <span class="switcher-label" style="font-size:14px;cursor:pointer;color:#160c0c;width:75%;">
                Regular Price
            </span>
            <span class="float-right"  style="cursor:pointer;margin-left:5px;margin-right:5px;color:#fff;background-color:#ff4a00;border-radius:4px;padding:0px 2px;">
                40
            </span>
        </label>
        <label class="switcher" style="cursor: pointer;background-color:#e2f7f6;padding-right:7px;margin-bottom:8px;width:100%">
            <input type="radio"  name="variant_position_0" class="switcher-input variant_position variant_position_0" data-variant_position="0" value="befor_name" disabled />
            <span class="switcher-indicator" style="cursor: pointer;">
                <span class="switcher-yes"></span>
                <span class="switcher-no"></span>
            </span>
            <span class="switcher-label" style="font-size:14px;cursor:pointer;color:#978f8f;width:75%;">
                Pruchase Price
            </span>
            <span class="float-right"  style="cursor:pointer;margin-left:5px;margin-right:5px;color:#fff;background-color:#ff4a00;border-radius:4px;padding:0px 2px;">
                24
            </span>
        </label>
        <label class="switcher" style="cursor: pointer;background-color:#e2f7f6;padding-right:7px;margin-bottom:8px;width:100%">
            <input type="radio"  name="variant_position_0" class="switcher-input variant_position variant_position_0" data-variant_position="0" value="befor_name"  />
            <span class="switcher-indicator" style="cursor: pointer;">
                <span class="switcher-yes"></span>
                <span class="switcher-no"></span>
            </span>
            <span class="switcher-label" style="font-size:14px;cursor:pointer;color:#160c0c;width:75%;">
                Whole Sell Price
            </span>
            <span class="float-right" style="cursor:pointer;margin-left:5px;margin-right:5px;color:#fff;background-color:#ff4a00;border-radius:4px;padding:0px 2px;">
                35
            </span>
        </label>
        
    </div> --}}





    {{-- <div style="padding-top: 6px; margin-top:10px;">
        @foreach ($productStock->productStockWiseProductPrices() as $productPrice)
            
            <label class="switcher selling_from_price_label selling_from_price_label_{{$productPrice->pId}}"  data-selling_from_price_id="{{$productPrice->pId}}"  data-selling_from_product_price_id="{{$productPrice->id}}"  style="cursor: pointer;padding-left:7px;background-color:#e2f7f6;padding-right:7px;margin-bottom:8px;width:100%">
                <input type="radio"  id="selling_from_price_id_{{$productPrice->pId}}" name="selling_price" class="switcher-input selling_from_price_id selling_from_price_id_{{$productPrice->pId}} selling_from_price selling_from_price_{{$productPrice->id}}" data-selling_from_price_id="{{$productPrice->pId}}"  data-selling_from_product_price_id="{{$productPrice->id}}" value="{{$productPrice->price}}" style="margin-top:5px;" />
            
                <span style="background-color: green;color: white;padding: 3px;margin-left: -5px;"><i class="fa fa-check-square"></i></span>
                <span style="background-color:black;display:;"><i class="fas fa-circle-notch"></i></span>
                @if($productPrice->pId == $defaultPriceId) checked @endif
                <span class="switcher-indicator" style="cursor: pointer;"> 
                    <span class="switcher-yes"></span>
                    <span class="switcher-no"></span>
                </span>
                <span class="switcher-label selling_from_price_label_css selling_from_price_label_css_{{$productPrice->pId}}" style="font-size:14px;cursor:pointer;color:#160c0c;width:75%;">
                    {{$productPrice->label}}
                </span>
                <span  class="float-right" style="cursor:pointer;margin-left:5px;margin-right:5px;color:#fff;background-color:#ff4a00;border-radius:4px;padding:0px 2px;margin-top: 2px;">
                    {{$productPrice->price}}
                </span>
            </label>
            
            <input type="hidden" class="price_id_{{$productPrice->pId}} price_id product_price_id product_price_id_{{$productPrice->id}}" data-price_id="{{$productPrice->pId}}" data-price_name_{{$productPrice->pId}} ="{{$productPrice->pName}}" value="{{$productPrice->price}}">
            @if ($productPrice->pName == 'purchase_price')
                <input type="hidden" class="selling_from_purchase_price" name="purchase_price" value="{{$productPrice->price}}">
            @endif
            @if ($productPrice->pName == 'sell_price')
                <input type="hidden" class="selling_from_sell_price" name="sell_price" value="{{$productPrice->price}}">
            @endif
            @if ($productPrice->pName == 'mrp_price')
                <input type="hidden" class="selling_from_mrp_price" name="mrp_price" value="{{$productPrice->price}}">
            @endif
        @endforeach
    </div> --}}
