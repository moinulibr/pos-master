
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
           
            <div class="modal-header" style="background-color:#0ba0cd;"> <!---#e2f7f6;-->
                <h5 class="modal-title">&nbsp;</h5>
                <button type="button" style="color:red;" class="close" data-dismiss="modal" aria-label="Close">×</button>
            </div>


            <div class="modal-body " style="border:6px solid;border-color:#0ba0cd;"><!-- #e2f7f6; modal body-->
                
                <div class="form-group">
                    <div class="col-md-12 processing" style="text-align:center;display:none;color:white !important;">
                        <span style="color:white !important;">
                            <span class="spinner-border spinner-border-sm" role="status" style="color:white !important;"></span>Processing...
                        </span>
                    </div>
                </div>
            
                <div class="row" style="margin-bottom:15px;text-align:center;margin-top: -15px">
                    <div class="col-md-7" style=""></div>
                    <div class="col-md-5" >
                        <table>
                            
                                <tr>
                                    <th style="width: 30%"></th>
                                    <th style="text-align:right;width: 50%;font-size:11px">
                                        Previous Selected Quantity
                                    </th>
                                    <th  style="width: 2%">:</th>
                                    <th style="text-align:left;">
                                        <strong style="padding:3px;font-size:15px;">
                                            <span class="previous_selling_quantity"> {{$sellingQuantity}}</span>
                                        </strong>
                                        <input type="hidden" class="previous_selling_quantity_value" value="{{$sellingQuantity}}">
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 30%"></th>
                                    <th style="text-align:right;width: 50%;font-size:11px">
                                        Now Selecting Quantity
                                    </th>
                                    <th  style="width: 2%">:</th>
                                    <th style="text-align:left;">
                                        <strong style="padding:3px;font-size:15px;">
                                            <span class="now_current_selling_quantity">0</span>
                                        </strong>
                                    </th>
                                </tr>
                            
                        </table>
                    </div>
                </div>
                
                <div class="row" style="margin-top:-10px;text-align:center;">
                    <div class="col-md-12" style="">
                        
                        <table class="table table-bordered" style="font-size: 14px;margin-bottom: -10px">
                            <thead style="background-color:rgb(66, 66, 66); color:#e9ff30">
                                <tr>
                                    <td  style="width:15% ;padding: 0.85rem;">Stock Name</td>
                                    <td  style="width:15% ;padding: 0.85rem;">Stock</td>
                                    <td  style="width:10% ;padding: 0.85rem;">Selling Price</td>
                                    <td  style="width:10% ;padding: 0.85rem;">
                                        Quantity
                                    </td>
                                    <td  style="width:5% ;padding: 0.85rem;">
                                        #
                                    </td>
                                    <td  style="width:45% ;padding: 0.85rem;">
                                        Over stock Process
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->productStocksNORWhereStatusIsActiveWhenCreateSale() as $productStock)    
                                <tr class="old_selectedProductStockRow_{{$productStock->id}}" data-id="{{$productStock->id}}" style="@if($primarySellingStock == $productStock->id) background-color: #3b7e3b;color: #ffff; @else background-color:#ffffff; @endif ;padding: 0px 10px; font-size:13px; ">
                                    <input type="hidden" class="selectedProductStockId selectedProductStockId_{{$productStock->id}}">
                                    <td style="padding: 0.25rem;">
                                        <span class="old_selectedProductStock old_selectedProductStock_{{$productStock->id}} " data-id="{{$productStock->id}}">
                                            {{ $productStock->label }}
                                        </span>
                                    </td>
                                    <td style="padding: 0.25rem;background-color: #d1cfcf;color: #0c0101;text-align: center">
                                        <span class="totalQuantityOfThisStockText totalQuantityOfThisStockText_{{$productStock->id}} " data-id="{{$productStock->id}}">
                                            {{-- {{ unitIdWiseUnitView_hh(
                                                $productStock->available_stock,$productStock->available_base_stock,
                                                $product->unit_id,$product->unit_id //$changing_unit_id = 8
                                            ) }} --}}
                                            {{ $productStock->available_base_stock }}
                                        </span>
                                        <input type="hidden" class="totalQuantityOfThisStockValue totalQuantityOfThisStockValue_{{$productStock->id}}" value="{{ $productStock->available_base_stock }}">
                                    </td>
                                    <td style="width:15%;padding: 0.25rem;">{{$sellingPrice}}</td>
                                    <td style="width:15%;padding: 0.25rem;">
                                        <input type="text" name="" data-id="{{ $productStock->id }}" class="pressingCurrentSellingQuantity pressingCurrentSellingQuantity_{{ $productStock->id }} form-control inputFieldValidatedOnlyNumeric" value="@if($primarySellingStock == $productStock->id) {{ $sellingQuantity > $productStock->available_base_stock ? $productStock->available_base_stock : $sellingQuantity }}@endif" >
                                        <span class="overStockErrorMessage overStockErrorMessage_{{ $productStock->id }}" style="color:red;"></span>
                                    </td>
                                    <td style="width:10%;padding: 0.25rem;">
                                        <input type="checkbox" name="" data-purchase-price="{{ getProductPriceByProductStockIdProductIdStockIdPriceId_hh($product->id,$productStock->id,$productStock->stock_id,purchasePriceId_hh()) }}" data-id="{{ $productStock->id }}" class="checkedCurrentSellingQuantity checkedCurrentSellingQuantity_{{ $productStock->id }} form-control" @if($primarySellingStock == $productStock->id) checked @endif style="font-size: 8px;">    
                                    </td>
                                    <td>
                                        <span class="regularStockProcessDuration regularStockProcessDuration_{{ $productStock->id }}" style="@if($primarySellingStock == $productStock->id) color:white; @else color:black; @endif">Regular Process</span>
                                        <div class="row overStockProcessingDiv overStockProcessingDiv_{{ $productStock->id }}"  style="@if($primarySellingStock == $productStock->id) color:white; @else color:red; @endif display: none">
                                            <div class="col-3 col-md-3" style="padding: 0px;padding-top:3px;">
                                                Process
                                            </div>
                                            <div class="col-9 col-md-9" style="padding: 0px;padding-right:10px;color:red;">
                                                <select name="" class="form-control overStockProcessDuration overStockProcessDuration_{{ $productStock->id }}"  style="color:red !important">
                                                    <option value="1">Tomorrow</option>
                                                    <option value="2">Day after tomorrow</option>
                                                    <option value="0">Today</option>
                                                    <option value="3">After 3 days</option>
                                                    <option value="4">After 4 days</option>
                                                    <option value="5">After 5 days</option>
                                                    <option value="6">After 6 days</option>
                                                    <option value="7">After 7 days</option>
                                                    <option value="8">After 8 days</option>
                                                    <option value="9">After 9 days</option>
                                                    <option value="10">After 10 days</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                <input type="hidden" class="primarySellingProductStockId" value="{{$primarySellingStock}}">
                            </tbody>
                        </table>    

                    </div>              
                </div>

            </div>
            <!--modal body-->

            <div class="modal-footer" style="background-color:#0ba0cd;padding: 0px;">
                <button type="button" style="color:white;padding:6px" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <strong style="padding:6px;background:darkred;color:#ffff;" class="btn btn-primay removeMoreQuantityFromOthersStock btn-sm" role="status">
                    Remove Quantity
                </strong>
                <strong style="padding:6px;"  class="btn btn-dark addThisInMainSellingQuantityOfMoreQuantityFromOthersStock addThisQuantityToMainQuantity btn-sm" role="status">
                    Add  Quantity
                </strong>
            </div>
        </div>
    </div>
