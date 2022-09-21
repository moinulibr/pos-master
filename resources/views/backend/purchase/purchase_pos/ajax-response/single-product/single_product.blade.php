
            <div class="modal-dialog modal-xl" >

                <form action="{{route('admin.purchase.regular.pos.store')}}" method="POST" class="addToPurchaseCart modal-content">
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
                                    <input type="hidden" name="supplier_id" value="{{$product->supplier_id}}">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                </h4>    
                            </div>              
                        </div>

                        <div class="row">

                            <div class="col-md-6 ">
                                <div class="card mb-4">
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
                                    </div> <!--card-body-->
                                </div>
                            </div> 

                            <div class="col-md-6">
                                <!--default calculator text only show until calculator shown-->
                                <div class="card mb-4 default_calculation_part_div">
                                    <div class="card-body">
                                        <div class="form-group row" style="margin-left:3px;background-color:#f9f9f9;border: 1px solid #ddd9d9;">
                                            <div class="col-sm-12"  style="padding:10px 5px;margin-top: 10px;margin-bottom: 9px;">
                                                <div style="background-color:#e9e4e4;padding:3px;height:98%;text-align: center;">
                                                    <h2 style="padding: 5px 0px;">Calculation</h2>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <!---Warranty Guarantee part--->
                                        </div>
                                    </div> <!--card-body-->
                                </div><!--default calculator text only show until calculator shown-->

                                <!--calculation main part-->
                                <div class="modal-body calculation_calculator" style="display: none;">

                                    <div style="text-align:center;">
                                        <h4 style="margin-top:-5px;margin-bottom: -7px;">
                                          <strong style="color:green;" class="currentChangingStockName"></strong>  Change Price (based on MRP Price)
                                            <input type="hidden" class="currentChangingStockId">
                                        </h4>
                                        <hr/>
                                    </div>
                                    <div  style="border: 2px solid #ddcbcb;">
                                        <table  class="table table-bordered table-striped table-hover">
                                            <tr>
                                                <td colspan="3" style="background-color:green;width:75%;">
                                                    <div class="row" >
                                                        <div class="col-md-3" style="text-align:center;">
                                                            <label style="margin-top:6px;color:white;font-weight:600;">MRP Price</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input data-idtype="mrp" type="text" data-id="{{mrpPriceId_hh()}}"  data-name="calculation_by_mrp_price"  class="keyup_change_from_calculator reset_mrp_price form-control makeEmptyField inputFieldValidatedOnlyNumeric" name="calculation_by_mrp_price" style="color:black;font-weight:600">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="width:25%;"> <strong style="color:red;">=</strong> <small>(Price After Calculation)</small></td>
                                            </tr>
                                            @foreach ($product->priceNORWhereStatusIsActive() as $ppric) 
                                            
                                                @if ($ppric->id == wholeSellPriceId_hh() || $ppric->id == retailSellPriceId_hh())
                                                    <tr>
                                                        <td style="width:25%;font-size: 12px;">
                                                            <div class="form-group">
                                                                <label style="color:green;">{{$ppric->label}}</label>
                                                                <input  data-id="{{$ppric->id}}"  type="text"  data-set_price="set_price_{{$ppric->id}}" class="keyup_change_from_calculator set_price_as_{{$ppric->id}} form-control change_price_by_mrp makeEmptyField inputFieldValidatedOnlyNumeric" name="calculation_by_price">
                                                            </div>
                                                        </td>
                                                        
                                                        <td style="width:25%;">
                                                            <div class="form-group">
                                                                <label>Change Type</label>
                                                                <select data-id="{{$ppric->id}}"   class="keyup_change_from_calculator change_type_set_{{$ppric->id}} form-control change_price_by_mrp" data-name="change_type_set_{{$ppric->id}}" name="calculation_by_change_type">
                                                                    <option value="1">Percentage</option>
                                                                    <option value="2">Fixed</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td style="width:25%;">
                                                            <div class="form-group">
                                                                <label>Calculation Type</label>
                                                                <select  data-id="{{$ppric->id}}" class="keyup_change_from_calculator calculation_type_set_{{$ppric->id}} form-control change_price_by_mrp" data-name="calculation_type"  name="calculation_by_calculation_type">
                                                                    <option value="1">(+) Plus</option>
                                                                    <option selected value="2">(-) Minus</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td  style="width:25%;">
                                                            <div class="form-group" style="background-color:green;">
                                                                <label style="color:#ffff;">{{$ppric->label}}</label>
                                                                <input data-id="{{$ppric->id}}"  class="set_price_after_calculation_{{$ppric->id}} set_price_after_calculation form-control makeEmptyField" type="number"  readonly step="any" >
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endif
                                            @endforeach
                                                <tr>
                                                    <td colspan="2">
                                                        <button type="button" class="btn btn-danger reset_all_price_on_calculator" style="width: 100%;">Reset Price (calculator price)</button>
                                                    </td> 
                                                    <td colspan="2">
                                                        <button type="button" class="btn btn-primary set_all_price_after_calculation" style="width: 100%;">Set Price (after calculation)</button>
                                                    </td>
                                                </tr>
                                        </table>
                                    </div>
                                </div><!--calculation main part--->
                            </div>
                        </div>


                        <!-----product stock with price section--->
                          <div class="row">
                            <div class="col-md-12">
                                <div class="table">
                                    @include('backend.purchase.purchase_pos.ajax-response.single-product.include.product_stock')
                                </div>
                            </div>
                        </div>
                        <!-----product stock with price section--->
                        
                    </div>
                    <!--modal body-->


                    <div class="modal-footer" style="background-color:#f9f5f4;">
                        <button type="button" style="color:white;" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary add_to_cart_button" role="status" value="Add To Cart">
                    </div>
                </form>
            </div>





