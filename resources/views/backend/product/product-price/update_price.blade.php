
<div class="modal-dialog modal-lg">
    <div  class=" modal-content">
        <form action="{{route('admin.product.price.store')}}" method="POST" class="updateAllProductPrice">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">
                    Product  
                    <span class="font-weight-light">Information</span>
                    <br />
                    {{-- <small class="text-muted">Add New Reference</small> --}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            </div>
            <div class="modal-body">

                    <div class="card" style="margin-top:0px;margin-bottom:0px;padding: 10px;">
                        <div class="container-fliud">
                            <div class="wrapper row">
                                <div class="preview col-md-6"> 
                                    <div class="" style="margin-bottom:20px;">
                                    <div class="tab-pane active" id="pic-1">
                                            {{-- @if(Storage::disk('public')->exists("storage/backend/product/product/{$item->id}.",$item->photo)) --}}
                                            @if($product->photo)
                                            <img src="{{ asset(productImageViewLocation_hh().$product->id.".".$product->photo) }}" width="100%" height="195;" style="padding:4px;border:1px solid #c7bbbb;background-color:#fbf8f8;border-radius:4px" />
                                                @else
                                                <img src="{{ asset(defaultProductImageUrl_hh()) }}" width="100%" height="195;" style="padding:4px;border:1px solid #c7bbbb;background-color:#fbf8f8;border-radius:4px" />
                                            @endif
                                        </div>
                                    </div>
                                </div><!---col-6-->
                                <div class="details col-md-6">
                                    <h5 class="product-title">{{$product->name}}</h5>
                                    
                                    <div style="border-bottom:1px solid rgba(24,28,33,.06);padding:5px;margin-bottom:10px;"></div>
                                    
                                    <h6 class="price"><span style="color:orange">  AS Code </span> : <span style="background-color:#e3e3f3;padding:2px;">{{ $product->custom_code }}</span></h6>
                                    <h6 class="price"><span style="color:blue"> Company Code </span> : <span style="background-color:#e3e3f3;padding:2px;">{{$product->company_code}}</span></h6>
                                    <h6 class="price"><span style="color:green"> SKU </span> : <span style="background-color:#e3e3f3;padding:2px;">{{$product->sku}}</span></h6>
                                    <h6 class="price"><span style="color:blue"> Barcode </span> : <span style="background-color:#e3e3f3;padding:2px;">{{$product->bacode}}</span></h6>
                                    <h6 class="price"><span style="color:#286e2d"> Status </span> : 
                                        <span style="background-color:#e3e3f3;padding:2px;">
                                            @if (!$product->deleted_at)
                                                <span class="badge badge-success">Active</span>
                                                @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif    
                                        </span>
                                    </h6>
                                </div><!---col-6-->
                            </div><!---wrapper row--->
                            


                            <div style="border-bottom:1px solid rgba(24,28,33,.06);padding:5px;margin-bottom:10px;"></div>
                                
                            <div class="form-group">
                                <div class="col-md-12 processing" style="text-align:center;display:none;">
                                    <span style="color:saddlebrown;">
                                        <span class="spinner-border spinner-border-sm" role="status"></span>Processing...
                                    </span>
                                </div>
                            </div>

                            <div class="wrapper row">
                                {{-- 
                                    <div class="col-md-12">
                                        <div>
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                                        <th  style="font-size:16px;background-color: darkgray;color: floralwhite;border-bottom-color:#f1e7e7;">
                                                            Stock
                                                        </th>
                                                        <th style="font-size:16px;background-color: #c1b8b8;color:yellow;border-bottom-color:#f1e7e7;">
                                                            Quantity
                                                        </th>
                                                        @foreach ($product->priceNORWhereStatusIsActive() as $ppric) 
                                                            <td style="font-size: 12px;">{{$ppric->label}}</td>
                                                            <input type="hidden" name="prices[]" value="{{$ppric->id}}">
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($product->productStockNORWhereStatusIsActive() as $productStock)    
                                                        <tr>
                                                            <th style="font-size:16px;background-color: darkgray;color: floralwhite;border-bottom-color:#f1e7e7;">
                                                                {{$productStock->label}}
                                                            </th>
                                                            <th style="font-size:16px;background-color: #c1b8b8;color:yellow;border-bottom-color:#f1e7e7;">
                                                                {{$productStock->available_base_stock}}
                                                            </th>
                                                            @foreach ($productStock->productStockWiseProductPrices() as $pSPPrice) 
                                                                <td>
                                                                    {{$pSPPrice->price}}
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>  
                                --}}

                                <br/><br/><br/>

                                <div class="col-md-12">
                                    <div>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                    <th  style="font-size:16px;background-color: darkgray;color: floralwhite;border-bottom-color:#f1e7e7;">
                                                        Stock
                                                    </th>
                                                    <th style="font-size:16px;background-color: #c1b8b8;color:yellow;border-bottom-color:#f1e7e7;">
                                                        Quantity
                                                    </th>
                                                    @foreach ($product->priceNORWhereStatusIsActive() as $ppric) 
                                                        <td style="font-size: 12px;">{{$ppric->label}}</td>
                                                        <input type="hidden" name="prices[]" value="{{$ppric->id}}">
                                                    @endforeach
                                                    {{-- <th>Action</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($product->productStockNORWhereStatusIsActive() as $productStock)    
                                                    <tr>
                                                        <th style="font-size:16px;background-color: darkgray;color: floralwhite;border-bottom-color:#f1e7e7;">
                                                            {{$productStock->label}}
                                                            <input type="hidden" name="stocks[]" value="{{$productStock->sId}}">
                                                        </th>
                                                        <th style="font-size:16px;background-color: #c1b8b8;color:yellow;border-bottom-color:#f1e7e7;">
                                                            {{$productStock->available_base_stock}}
                                                        </th>
                                                        @foreach ($productStock->productStockWiseProductPrices() as $pSPPrice) 
                                                            <td>
                                                                <input type="text" name="p_{{$pSPPrice->pId}}_s_{{$productStock->sId}}"  value="{{$pSPPrice->price}}" class="form-control inputFieldValidateWithNumber">
                                                            </td>
                                                        @endforeach
                                                        
                                                        @foreach ($product->priceNORWhenThidPriceIsNotStoreInPreviousTime() as $notStoredPrice)
                                                        <td>
                                                            <input type="text" name="p_{{$notStoredPrice->id}}_s_{{$productStock->sId}}"  value="0" class="form-control inputFieldValidateWithNumber"> 
                                                        </td>                  
                                                        @endforeach
                                                        {{-- 
                                                            <th style="font-size: 12px;">
                                                                <span class="btn btn-sm btn-primary">Update</span>
                                                            {{$productStock->id}}-{{$productStock->sId}}
                                                            </th> 
                                                        --}}
                                                    </tr>
                                                @endforeach
                                                @foreach ($product->stockNORWhenThidStockIsNotStoreInPreviousTime() as $item)
                                                    <tr>
                                                        <td style="font-size:16px;background-color:darkgray;color:floralwhite;border-bottom-color:#f1e7e7;">
                                                            {{$item->label}}
                                                            <input type="hidden" name="stocks[]" value="{{$item->id}}">
                                                        </td>
                                                        <td style="font-size:16px;background-color:#c1b8b8;color:yellow;border-bottom-color:#f1e7e7;">
                                                            0.00
                                                        </td>
                                                        @foreach ($product->priceNORWhereStatusIsActive() as $ppric) 
                                                        <td style="font-size: 12px;">
                                                            <input type="text" name="p_{{$ppric->id}}_s_{{$item->id}}"  value="0" class="form-control inputFieldValidateWithNumber">
                                                        </td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            {{-- 
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="{{count($product->priceNORWhereStatusIsActive()) + 2}}"></td>
                                                        <td > 
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Update</button>
                                                        </td>
                                                    </tr>
                                                </tfoot> 
                                            --}}
                                        </table>
                                    </div>
                                    
                                </div>
                            </div><!---wrapper row--->


                        </div><!---container-fliud---->
                    </div>
                    <!---card---->

            </div>
            
        
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Update">
            </div>
        </form>
    </div>
</div>