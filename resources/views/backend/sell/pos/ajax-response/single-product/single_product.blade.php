
            <div class="modal-dialog modal-xl" >

                <form action="{{route('admin.sell.regular.pos.store')}}" method="POST" class="addToSaleCart modal-content">
                    @csrf
                    <div class="modal-header" style="background-color:#f9f5f4;"> <!---#e2f7f6;-->
                        <h5 class="modal-title">&nbsp;</h5>
                        <button type="button" style="color:red;" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    </div>


            


                    <div class="modal-body " style="background-color:#ede7e7;"><!-- #e2f7f6; modal body-->
                        
                        <div class="form-group">
                            <div class="col-md-12 processing" style="text-align:center;display:none;color:blue !important;">
                                <!--<span style="color:white !important;">
                                    <span class="spinner-border spinner-border-sm" role="status" style="color:blue !important;"></span>Processing...
                                </span>-->
                                <div style="display: none;" class="processing">
                                    <img src="{{asset('loading-img/loading1.gif')}}" alt="" style="display: block;margin-left: auto;margin-right: auto;width: 5%;height: 50px;">
                                </div>
                            </div>
                        </div>
                    

                        
                        <div class="row" style="background-color:#fbfbfb;;margin-bottom:10px;text-align:center;">
                            <div class="col-md-12" style="padding:5px;">
                                <h4 style="color: forestgreen;">
                                    {{$product->name}}   
                                    <input type="hidden" id="main_product_id" class="product_id" name="product_id" value="{{$product->id}}">
                                    <input type="hidden" name="product_name" value="{{$product->name}}">
                                    <input type="hidden" name="custom_code" value="{{$product->custom_code}}">
                                    <input type="hidden" name="warehouse_id" value="{{$product->warehouse_id}}">
                                    <input type="hidden" name="supplier_id" value="{{$product->supplier_id}}">
                                    <input type="hidden" name="warehouse_rack_id" value="{{$product->warehouse_rack_id}}">
                                </h4>    
                            </div>              
                        </div>

                        <div class="row">

                            <div class="col-md-7 ">
                                <div class="card mb-4">
                                    {{-- <h6 class="card-header">Product Information <small>(Changeable Data)</small></h6> --}}
                                    <div class="card-body">


                                        <div class="form-group row" style="margin-left:3px;background-color:#f9f9f9;border: 1px solid #ddd9d9;">
                                            <div class="col-sm-5"  style="padding:10px 5px;">
                                                <div style="background-color:#e9e4e4;padding:3px;height:98%;">
                                                    <table style="width:100%;background-color:#f2f3f5;height:100%;">
                                                        <tr>
                                                            <td style="height:49%;text-align: center;background-color: #ffffff">
                                                                AS Code : {{$product->custom_code }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="height:49%;text-align: center;">
                                                               Unit : {{$product->units->short_name}}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <input type="hidden" name="unit_id" value="{{$product->unit_id}}" class="form-control">
                                                <input type="hidden" name="unit_name" value="{{$product->units->short_name}}">
                                                
                                                {{-- <label class="form-label" style="color:#080808">
                                                    Unit : {{$product->units->short_name}}
                                                </label>
                                                <input type="text" disabled value="{{$product->units->short_name}}" class="form-control">
                                                <input type="hidden" name="unit_id" value="{{$product->unit_id}}" class="form-control">
                                                <input type="hidden" name="unit_name" value="{{$product->units->short_name}}">
                                                
                                                    <select class="form-control addedNewSupplier" name="unit_id" style="background-color:#d0e7ef;">
                                                        <option value=""  style="background-color:#d0e7ef;color:rgb(15, 15, 15);">Select Unit</option>
                                                        @foreach ($units as $item)
                                                        <option {{$product->unit_id == $item->id ? 'selected' : ''}} value="{{$item->id}}"  style="background-color:#d0e7ef;color:rgb(15, 15, 15);">{{$item->full_name}}</option>
                                                        @endforeach
                                                    </select> 
                                                <strong class="unit_id_err color-red"></strong> --}}
                                                <div class="clearfix"></div>
                                            </div>
                                            <!---Warranty Guarantee part--->

                                            <div class="col-sm-4" style="background-color:#fdfdfd;padding:10px 5px;color:#203a33;">
                                                <div style="background-color:#e9e4e4;padding:3px;height:98%;">
                                                    <table style="width:100%;background-color:#f2f3f5;height:100%;">
                                                        <tr>
                                                            <td style="height:49%;text-align: center;background-color: #ffffff">
                                                                Rack/Sefl : {{$product->warehouseRacks ? $product->warehouseRacks->name : "Default Rack/Self" }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="height:49%;text-align: center;">
                                                                {{$product->warehouses ? $product->warehouses->name : 'Default Warehouse' }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-sm-3"  style="background-color:#fdfdfd;padding:10px 5px;color:#fff;">
                                                <div style="background-color:#fff;padding-left:2px;">
                                                    <span style="cursor:pointer;" class="singleShowModal" data-id="" href="javascript:void(0)">
                                                        @if($product->photo)
                                                            <img src="{{ asset(productImageViewLocation_hh().$product->id.".".$product->photo) }}"  width="40" height="70" style="width:100%;padding:2px;border:1px solid #c7bbbb;background-color:#fbf8f8;border-radius:4px" />
                                                            @else
                                                            <img src="{{ asset(defaultProductImageUrl_hh()) }}" width="100%" height="70;" style="padding:4px;border:1px solid #c7bbbb;background-color:#fbf8f8;border-radius:4px" />
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <!-----product stock with price section--->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table">
                                                    <div class="display-product-stock-with-price-section"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-----product stock with price section--->

                                    
                                    </div> <!--card-body-->
                                </div>
                            </div> 
            
                            <!----col-5--->
                            <div class="col-md-5">
                                <div class="card mb-4">
                                    {{-- <h6 class="card-header">Others Information <small>(Fixed Data)</small></h6> --}}
                                    <div class="card-body" style="padding-bottom: 7px">
                                    
                                        <div class="row">

                                            <!---selling from: stock--->
                                            <div class=" col-md-7">
                                                <div class="form-group" style="background-color:#6a3d2b;color:#e9ff30;padding:5px;margin-bottom:8px;margin-top:5px;">
                                                    
                                                    <div style="text-align:center;background-color:#ff4a00;color:white;margin-top:1px;padding:5px;">
                                                        <span for="">Selling</span>
                                                    </div>

                                                    <input type="hidden" class="defaultSelectedPriceId" id="defaultSelectedPriceId" value="{{defaultSelectedPriceId_hh()}}">
                                                    <input type="hidden" class="selectedPriceId">
                                                    <input type="hidden" class="selectedSellingPrice" >
                                                    <input type="hidden" class="selectingSellingPriceAction" value="0">

                                                    <input type="hidden" class="sellApplicableOrNotWhenSellingPriceIsLessThanPurchasePrice" value="{{sellApplicableOrNotWhensellingPriceIsLessThanPurchasePrice_hh()}}">
                                                    <input type="hidden" class="sellApplicableOrNotWhenStockIsLessThanZero" value="{{sellApplicableOrNotWhenStockIsLessThanZero_hh()}}">
                                                    <input type="hidden" class="sellApplicableOrNotWhenTotalDiscountAmountIsGreaterThanTotalPurchasePrice" value="{{sellApplicableOrNotWhenTotalDiscountAmountIsGreaterThanTotalPurchasePrice_hh()}}">

                                                    <div class="selling_from_stock_name_and_selling_product_stock_price_list">
                                                        @include('backend.sell.pos.ajax-response.single-product.include.product_stock_price')
                                                    </div>
                                                    
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <!---col-md-7-->
                                            <!---selling from: stock--->


                                            <!---selling price custom alert message css--->
                                            <style>
                                                #sellingPriceBaseLayer{
                                                    position: absolute;
                                                    top: 0;
                                                    right: 0;  
                                                    bottom: 0;
                                                    left: 0;
                                                    margin: auto;
                                                    margin-top: 0;
                                                    margin-bottom: 10px;
                                                    /*width: 981px;
                                                    height: 610px;*/
                                                    background : ;
                                                    z-index: 0;
                                                    visibility: hidden;
                                                    color:red;
                                                }
                                    
                                                #sellingPriceErrorMessageLayer {
                                                position: absolute;
                                                top: 0;
                                                right: 0;
                                                bottom: 0;
                                                left: 0;
                                                /* margin: 70px 140px 175px 140px; */
                                                padding : 30px;
                                                margin-left: 40px;
                                                /*width: 700px;
                                                height: 400px;*/
                                                background-color: rgb(244, 244, 85);
                                                visibility: hidden;
                                                border: 1px solid black;
                                                z-index: 99999999999;
                                                }
                                                .sellingPricePermissionLayer{
                                                    margin-top: 20px;
                                                    text-align:center;
                                                    width: 100%;
                                                    height: auto;
                                                }
                                                .sellingPricePermissionLayerYes{
                                                    padding:2px;
                                                    width: 45%;
                                                    float: left;
                                                    background-color: #0c8327;
                                                    cursor:pointer;
                                                    color:#ffff;
                                                }
                                                .sellingPricePermissionLayerNo{
                                                    padding:2px;
                                                    width: 45%;
                                                    float: right;
                                                    background-color: red;
                                                    cursor:pointer;
                                                    color:#ffff;
                                                }
                                            </style>
                                            <!---selling price custom alert message css--->
                                            
                                            <!---Quantity :- selling price custom alert message css--->
                                            <style>
                                                #sellingPriceBaseLayerWhenQuantity{
                                                    position: absolute;
                                                    top: 0;
                                                    right: 0;  
                                                    bottom: 0;
                                                    left: 0;
                                                    margin: auto;
                                                    margin-top: 0;
                                                    margin-bottom: 10px;
                                                    /*width: 981px;
                                                    height: 610px;*/
                                                    background : ;
                                                    z-index: 0;
                                                    visibility: hidden;
                                                    color:#ffff;
                                                }
                                    
                                                #sellingPriceErrorMessageLayerWhenQuantity{
                                                position: absolute;
                                                top: 0;
                                                right: 0;
                                                bottom: 0;
                                                left: 0;
                                                /* margin: 70px 140px 175px 140px; */
                                                padding : 30px;
                                                margin-left: 40px;
                                                /*width: 700px;
                                                height: 400px;*/
                                                background-color: #0808a1;
                                                visibility: hidden;
                                                border: 1px solid #0e021a;
                                                z-index: 99999999999;
                                                }
                                                .sellingPricePermissionLayerWhenQuantity{
                                                    margin-top: 20px;
                                                    text-align:center;
                                                    width: 100%;
                                                    height: auto;
                                                }
                                                .sellingPricePermissionLayerYesWhenQuantity{
                                                    padding:2px;
                                                    width: 45%;
                                                    float: left;
                                                    background-color: #0c8327;
                                                    cursor:pointer;
                                                    color:#ffff;
                                                }
                                                .sellingPricePermissionLayerNoWhenQuantity{
                                                    padding:2px;
                                                    width: 45%;
                                                    float: right;
                                                    background-color: red;
                                                    cursor:pointer;
                                                    color:#ffff;
                                                }
                                            </style>
                                            <!---Quantity :- selling price custom alert message css--->

                                            <!---Discount :- selling price custom alert message css--->
                                            <style>
                                                #sellingPriceBaseLayerWhenDiscount{
                                                    position: absolute;
                                                    top: 0;
                                                    right: 0;  
                                                    bottom: 0;
                                                    left: 0;
                                                    margin: auto;
                                                    margin-top: 0;
                                                    margin-bottom: 10px;
                                                    /*width: 981px;
                                                    height: 610px;*/
                                                    background : ;
                                                    z-index: 0;
                                                    visibility: hidden;
                                                    color:#f7f7ff;
                                                }
                                    
                                                #sellingPriceErrorMessageLayerWhenDiscount{
                                                position: absolute;
                                                top: 0;
                                                right: 0;
                                                bottom: 0;
                                                left: 0;
                                                /* margin: 70px 140px 175px 140px; */
                                                padding : 30px;
                                                margin-left: 40px;
                                                /*width: 700px;
                                                height: 400px;*/
                                                background-color: black;
                                                visibility: hidden;
                                                border: 1px solid black;
                                                z-index: 99999999999;
                                                }
                                                .sellingPricePermissionLayerWhenDiscount{
                                                    margin-top: 20px;
                                                    text-align:center;
                                                    width: 100%;
                                                    height: auto;
                                                }
                                                .sellingPricePermissionLayerYesWhenDiscount{
                                                    padding:2px;
                                                    width: 45%;
                                                    float: left;
                                                    background-color: #0c8327;
                                                    cursor:pointer;
                                                    color:#ffff;
                                                }
                                                .sellingPricePermissionLayerNoWhenDiscount{
                                                    padding:2px;
                                                    width: 45%;
                                                    float: right;
                                                    background-color: red;
                                                    cursor:pointer;
                                                    color:#ffff;
                                                }
                                            </style>
                                            <!---Discount :- selling price custom alert message css--->

                                            <!---selling price-quantity-discount--->
                                            <div class="col-md-5">
                                                <div  style="background-color:#6a3d2b;color:#e9ff30;padding:5px;margin-bottom:8px;margin-top:5px;">
                                                    <div class="form-group" style="margin-bottom:1px;">
                                                        <label class="form-label" style="color:#fcfcfd !important;">Selling Price</label>
                                                        <input type="text" name="final_sell_price"  class="form-control final_sell_price inputFieldValidatedOnlyNumeric" placeholder="Selling Price" style="font-size: 15px;background-color:#d0e7ef;color:#382a25;font-weight:700;" />
                                                        <strong class="final_sell_price_err color-red" style="color:#ffff;"></strong>
                                                        <!---selling price custom alert message--->
                                                        <div id="sellingPriceBaseLayer">
                                                            <div id="sellingPriceErrorMessageLayer">
                                                                Do you want to sell less than purchasae pirce?
                                                                <br />
                                                                <div class="sellingPricePermissionLayer">
                                                                    <div class="sellingPricePermissionLayerYes" >
                                                                        <strong class="sellingPermissionApplicable" data-permission="1">Yes</strong>
                                                                    </div>
                                                                    <div class="sellingPricePermissionLayerNo" >
                                                                        <strong class="sellingPermissionApplicable" data-permission="0">No</strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!---selling price custom alert message css--->
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom:1px;">
                                                        <label class="form-label"style="color:#e9ff30 !important;margin-bottom:-2px">Quantity</label>
                                                        <input type="text" name="final_sell_quantity"  class="form-control final_sell_quantity inputFieldValidatedOnlyNumeric" placeholder="Quantity" style="font-size: 15px;background-color:rgb(10, 9, 9);color:#e2f7f6;font-weight:700;" />
                                                        <input type="hidden" value="1" class="initialDefaultQuantity">
                                                        <strong class="final_sell_quantity_err color-red"></strong>
                                                        <!---selling quantity custom alert message--->
                                                        <div id="sellingPriceBaseLayerWhenQuantity">
                                                            <div id="sellingPriceErrorMessageLayerWhenQuantity">
                                                                Do you want to sell more quantity from others stock?
                                                                <br />
                                                                <div class="sellingPricePermissionLayerWhenQuantity">
                                                                    <div class="sellingPricePermissionLayerYesWhenQuantity" >
                                                                        <strong class="quantityPermissionApplicable" data-permission="1">Yes</strong>
                                                                    </div>
                                                                    <div class="sellingPricePermissionLayerNoWhenQuantity" >
                                                                        <strong class="quantityPermissionApplicable" data-permission="2">No</strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" class="quantityPermissionApplicableSelected" value="0">
                                                        </div>
                                                        <input type="hidden" class="displayQuantityWiseSingleProductByProductId" value="{{route('admin.sell.regular.pos.display.quantity.wise.sigle.product.stock.by.product.id')}}">
                                                        <!---selling quantity custom alert message css--->
                                                        <div class="clearfix"></div>
                                                    </div>

                                                    <div style="height:2px; background-color:#f0f0f5;margin-top:5px;margin-bottom:5px;"></div>

                                                    <div class="form-group" style="margin-bottom:1px;margin-top:2px;">
                                                        <div style="background-color:#ff4a00;padding:1px;padding-top:0px;color:white;">
                                                            <strong>Less Amount</strong>
                                                            <div style="background-color:#ededed;color:red;margin-bottom:1.5px;">
                                                                <label class="switcher" style="padding-right: 7px;padding-left: 3px;">
                                                                        <input type="radio"  name="discount_type" class="switcher-input  discount_type" value="fixed" style="margin-top:5px;cursor: pointer;" />
                                                                        <small class="switcher-indicator" style="cursor: pointer;backgound-color:#140505 !important">
                                                                            <span class="switcher-yes"></span>
                                                                            <span class="switcher-no"></span>
                                                                        </small>
                                                                        <small class="switcher-label" style="cursor:pointer;font-size:10px;color:#020222;padding-right:1px;">
                                                                            Fixed
                                                                        </small>
                                                                </label>
                                                                <label class="switcher" style="padding-right: 7px;padding-left: 3px;">
                                                                    <input type="radio"  name="discount_type" class="switcher-input  discount_type" value="percentage" style="margin-top:5px;cursor: pointer;" />
                                                                    <small class="switcher-indicator" style="cursor: pointer;backgound-color:#140505 !important">
                                                                        <span class="switcher-yes"></span>
                                                                        <span class="switcher-no"></span>
                                                                    </small>
                                                                    <small class="switcher-label" style="cursor:pointer;color:#020222;font-size:8px;">
                                                                        Percentage(%)
                                                                    </small>
                                                                </label>
                                                            </div>
                                                            
                                                            <input type="text" name="discount_amount"  class="form-control discount_amount inputFieldValidatedOnlyNumeric" placeholder="Less Amount" style="font-size: 15px;background-color:#ffff94;color:#1e0303;font-weight:700;" />
                                                            <strong class="discount_amount_err"></strong>

                                                            <div style="font-size:14px;margin-top:1px;width:100%;padding:1% 1%;background-color:green;color:white;">
                                                                <div style="width:52%;float:left;border-right:1px solid white;margin-left:2px;">
                                                                    <strong class="total_amount_before_discount_text" style="font-size:11px;">(180.00)</strong>
                                                                    <input type="hidden" name="total_amount_before_discount" class="total_amount_before_discount_value">
                                                                </div>
                                                                <div style="width:43%;float:right;text-align:right;margin-right:2px;">
                                                                    <strong class="total_discount_amount_text" style="font-size:11px;">(8.00)</strong>
                                                                    <input type="hidden" name="total_discount_amount" class="total_discount_amount_value">
                                                                </div>
                                                                <div style="float:clear;clear: both;"></div>
                                                            </div>
                                                            <strong class="name_err color-red"></strong>
                                                            <div class="clearfix"></div>
                                                                <!---selling discount price custom alert message--->
                                                                <div id="sellingPriceBaseLayerWhenDiscount">
                                                                    <div id="sellingPriceErrorMessageLayerWhenDiscount">
                                                                        Do you want to sell less than purchasae pirce?
                                                                        <br />
                                                                        <div class="sellingPricePermissionLayerWhenDiscount">
                                                                            <div class="sellingPricePermissionLayerYesWhenDiscount" >
                                                                                <strong class="discountPermissionApplicable" data-permission="1">Yes</strong>
                                                                            </div>
                                                                            <div class="sellingPricePermissionLayerNoWhenDiscount" >
                                                                                <strong class="discountPermissionApplicable" data-permission="2">No</strong>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" class="discountPermissionApplicableSelected" value="0">
                                                                </div>
                                                                <!---selling discount price custom alert message css--->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!---col-md-5-->
                                            <!---selling price-quantity-discount--->


                                            <!---total selling amount--->
                                            <div class="col-md-12" style="margin-top:-4px;background-color: #ff4a00;color:#fff;">
                                                <div class="row">
                                                    <div class="col-md-7" style="text-align: right">
                                                        <strong>Total Amount  </strong>
                                                    </div>
                                                    <div class="col-md-5">
                                                        : 
                                                        <strong style="font-size: 16px">
                                                            <strong class="selling_final_amount_text"></strong>
                                                            <input type="hidden" name="selling_final_amount" class="selling_final_amount_value" value="">
                                                        </strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <!---total selling amount--->

                                        </div><!---row-->
                                            
                                    </div><!---card-body-->
                                </div><!---card-->

                                <!---Warranty Guarantee part--->
                                <div class="row" style="margin-top:-15px;margin-right:1px;">
                                    <div class="col-md-4">
                                        {{-- 
                                            <span style="cursor:pointer;" class="singleShowModal" data-id="" href="javascript:void(0)">
                                                @if(false)
                                                    <img src="{{ asset('storage/backend/product/product/'.$item->id.".".$item->photo) }}" alt="" width="40" height="40" style="padding:2px;border:1px solid #c7bbbb;background-color:#fbf8f8;border-radius:4px">
                                                    @else
                                                    <img src="{{ asset('storage/backend/default/product/5.png') }}" alt="" width="40" height="70" style="width:100%;padding:2px;border:1px solid #c7bbbb;background-color:#fbf8f8;border-radius:4px">
                                                @endif
                                            </span> 
                                        --}}
                                        <div style="background-color:#f7f7ff;color:red;margin-bottom:1.5px;">
                                            <label class="switcher" style="padding-left:2px;padding-right:2px;margin-bottom:5px;padding-top:3px;">
                                                <input type="radio"  name="w_g_type" class="switcher-input variant_position variant_position_0" data-variant_position="0" value="warranty" />
                                                <strong class="switcher-indicator" style="cursor: pointer;backgound-color:#140505 !important">
                                                    <span class="switcher-yes"></span>
                                                    <span class="switcher-no"></span>
                                                </strong>
                                                <strong class="switcher-label" style="cursor:pointer;font-size:12px;color:#020222;padding-right:1px;">
                                                    Warranty
                                                </strong>
                                            </label>
                                            <label class="switcher" style="padding-left:2px;padding-right:2px;margin-bottom: 5px;">
                                                <input type="radio"  name="w_g_type" class="switcher-input variant_position variant_position_0" data-variant_position="0" value="guarantee" />
                                                <strong class="switcher-indicator" style="cursor: pointer;backgound-color:#140505 !important">
                                                    <span class="switcher-yes"></span>
                                                    <span class="switcher-no"></span>
                                                </strong>
                                                <strong class="switcher-label" style="cursor:pointer;color:#020222;font-size:12px;">
                                                    Guarantee
                                                </strong>
                                            </label>
                                            <label for="" style="padding-left: 4px;margin-top: 2px;color: #3f4052;margin-bottom: -2px;border-top: 1px solid #d3cdd2cc">Duration <small style="margin-left:3px;">(day only)</small></label>
                                            <input type="text" name="w_g_type_day" class="form-control" style="background-color: #6a3d2b;color:#ebebf1;font-size: 14px;font-weight: bold">
                                        </div>
                                    </div>
                                    <div class="col-md-8" style="background-color: #c7bbbb;padding-bottom:5px;">
                                        <label for="">IMEI/Serial/Chassis/Engine Number</label>
                                        <textarea name="identityNumber"  cols="5" rows="2" class="form-control" style="background-color:white;"></textarea>
                                    </div>
                                </div>
                                <!---Warranty Guarantee part--->

                            </div>
                            <!----col-5--->

                        </div>

                        
                    </div>
                    <!--modal body-->

                    <input type="hidden" class="moreQuantityFromOthersStock" name="more_quantity_from_others_product_stock" value="0">
                    <div class="responseOfMoreQtySellingStockId"></div>
                    <div class="responseOfMoreStockSellingQuantity"></div>
                    <div class="responseOfMoreStockSellingQuantityPurchasePrice"></div>
                    <div class="responseOfMoreStockSellingOverStockQtyProcessDuration"></div>

                    <div class="modal-footer" style="background-color:#f9f5f4;">
                        <button type="button" style="color:white;" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary add_to_cart_button" role="status" value="Add To Cart">
                    </div>
                </form>
            </div>








            <!---selling price custom alert message--->
            {{-- <div id="sellingPriceBaseLayer">
                <div id="sellingPriceErrorMessageLayer">
                    Do you want to sell less than purchasae pirce?
                    <br />
                    <div class="sellingPricePermissionLayer">
                        <div class="sellingPricePermissionLayerYes" >
                            <strong class="sellingPermissionApplicable" data-permission="1" onclick="hideSellingPriceBaseLayer();">Yes</strong>
                        </div>
                        <div class="sellingPricePermissionLayerNo" >
                            <strong class="sellingPermissionApplicable" data-permission="0" onclick="hideSellingPriceBaseLayer();">No</strong>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function showSellingPriceBaseLayer() {  document.getElementById('sellingPriceBaseLayer').style.visibility='visible';
                  document.getElementById('sellingPriceErrorMessageLayer').style.visibility='visible';
                }
                function hideSellingPriceBaseLayer() {
                  document.getElementById('sellingPriceBaseLayer').style.visibility='hidden';
                  document.getElementById('sellingPriceErrorMessageLayer').style.visibility='hidden';
                }
            </script> --}}
            <!---selling price custom alert message css--->

















            {{---
                <label>
                    <small>Less Amount</small>: <br>
                    <label style="cursor: pointer;margin-right:5px;">
                        <input name="discountType" value="percentage" type="radio" class="colored-blue cr_discountTypeClass" style="font-size:12px;cursor: pointer">
                        <span class="text" style="font-size:12px;">Percentage (%)</span>
                    </label>
                    <label style="cursor: pointer">
                        <input name="discountType" checked="" value="fixed" type="radio" class="colored-blue cr_discountTypeClass" style="font-size:12px;cursor: pointer">
                        <span class="text" style="font-size:12px;">Fixed</span>
                    </label>
                </label>
            ---}}




