
            <div class="modal-dialog modal-xl" >
                <form action="" method="POST" class="storeProductData modal-content" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header" style="background-color:#f9f5f4;"> <!---#e2f7f6;-->
                        <h5 class="modal-title">&nbsp;</h5>
                        <button type="button" style="color:red;" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    </div>


              


                    <div class="modal-body " style="background-color:#222121;"><!-- #e2f7f6; modal body-->
                        
                        <div class="form-group">
                            <div class="col-md-12 processing" style="text-align:center;display:none;color:white !important;">
                                <span style="color:white !important;">
                                    <span class="spinner-border spinner-border-sm" role="status" style="color:white !important;"></span>Processing...
                                </span>
                            </div>
                        </div>
                       

                         
                        <div class="row" style="background-color:#fbfbfb;;margin-bottom:10px;text-align:center;">
                            <div class="col-md-12" style="padding:5px;">
                                <strong>
                                    The Product Name    
                                </strong>    
                            </div>              
                        </div>

                        <div class="row">

                            <div class="col-md-7 ">
                                <div class="card mb-4">
                                    {{-- <h6 class="card-header">Product Information <small>(Changeable Data)</small></h6> --}}
                                    <div class="card-body">


                                        <div class="form-group row" style="margin-left:3px;background-color:#f9f9f9;border: 1px solid #ddd9d9;">
                                            <div class="col-sm-5"  style="background-color:#fbfafa;padding:10px 5px;color:#fff;">
                                                <label class="form-label" style="color:#080808">
                                                    Unit
                                                </label>
                                                <select class="form-control addedNewSupplier" name="supplier_id" style="background-color:#d0e7ef;">
                                                    <option value=""  style="background-color:#d0e7ef;color:rgb(15, 15, 15);">Select Unit</option>
                                                    @foreach ($units as $item)
                                                    <option value="{{$item->id}}"  style="background-color:#d0e7ef;color:rgb(15, 15, 15);">{{$item->full_name}}</option>
                                                    @endforeach
                                                </select>
                                                <strong class="supplier_id_err color-red"></strong>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="col-sm-4" style="background-color:#fdfdfd;padding:10px 5px;color:#203a33;">
                                                <div style="background-color:#e9e4e4;padding:3px;height:98%;">
                                                    <table style="width:100%;background-color:#f2f3f5;height:100%;">
                                                        <tr>
                                                            <td style="height:49%;text-align: center;background-color: #ffffff">Self No 2</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="height:49%;text-align: center;">#03 Warehouuse</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-sm-3"  style="background-color:#fdfdfd;padding:10px 5px;color:#fff;">
                                                <div style="background-color:#fff;padding-left:2px;">
                                                    <span style="cursor:pointer;" class="singleShowModal" data-id="" href="javascript:void(0)">
                                                        @if(false)
                                                            {{-- <img src="{{ asset('storage/backend/product/product/'.$item->id.".".$item->photo) }}" alt="" width="40" height="40" style="padding:2px;border:1px solid #c7bbbb;background-color:#fbf8f8;border-radius:4px"> --}}
                                                            @else
                                                            <img src="{{ asset('storage/backend/default/product/5.png') }}" alt="" width="40" height="70" style="width:100%;padding:2px;border:1px solid #c7bbbb;background-color:#fbf8f8;border-radius:4px">
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table">
                                                    <table class="table table-bordered" style="">
                                                        <thead style="background-color:rgb(66, 66, 66); color:#e9ff30">
                                                            <tr>
                                                                <td>Stock Name</td>
                                                                <td>Stock</td>
                                                                <td>
                                                                    <small>
                                                                        Purchase
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    <small>
                                                                        MRP
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    <small>
                                                                        Whole Sell
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    <small>
                                                                        Regular Sell
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    <small>
                                                                        Offer
                                                                    </small>
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Regular Stock</td>
                                                                <td style="background-color: #ededed;color: #0c0101;text-align: center">
                                                                    200
                                                                </td>
                                                                <td>
                                                                    <small>
                                                                        30
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    <small>
                                                                        60
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    <small>
                                                                        35
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    <small>
                                                                        40
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    <small>
                                                                        36
                                                                    </small>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Low Stock</td>
                                                                <td  style="background-color: #ededed;color: #0c0101;text-align: center">100</td>
                                                                <td>
                                                                    <small>
                                                                        25
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    <small>
                                                                        60
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    <small>
                                                                        35
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    <small>
                                                                        40
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    <small>
                                                                        36
                                                                    </small>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>High Stock</td>
                                                                <td  style="background-color: #ededed;color: #0c0101;text-align: center">150</td>
                                                                <td>
                                                                    <small>
                                                                        33
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    <small>
                                                                        60
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    <small>
                                                                        35
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    <small>
                                                                        40
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    <small>
                                                                        36
                                                                    </small>
                                                                </td>
                                                            </tr>
                                                            <tr style="background-color:green;color:white;">
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
                                                            </tr>
                                                            <tr>
                                                                <td>Reseller Stock</td>
                                                                <td  style="background-color: #ededed;color: #0c0101;text-align: center">3</td>
                                                                <td>
                                                                    <small>
                                                                        35
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    <small>
                                                                        60
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    <small>
                                                                        35
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    <small>
                                                                        40
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    <small>
                                                                        36
                                                                    </small>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                     
                                    </div> <!--card-body-->
                                </div>
                            </div> 
            
                            <!----col-5--->
                            <div class="col-md-5">
                                <div class="card mb-4">
                                    {{-- <h6 class="card-header">Others Information <small>(Fixed Data)</small></h6> --}}
                                    <div class="card-body" style="padding-bottom: 7px">
                                       
                                        <div class="row">

                                            <div class=" col-md-7">
                                                <div class="form-group" style="background-color:#252d3c;color:#e9ff30;padding:5px;margin-bottom:8px;margin-top:5px;">
                                                    
                                                    <div style="text-align:center;background-color:#ff4a00;color:white;margin-top:1px;padding:5px;">
                                                        <span for="">Selling</span>
                                                    </div>

                                                    <div style="background-color:#64b764;color:#fbfbfb;margin-top:5px;padding:5px;text-align:center">
                                                        <span for="">Selling from : </span>
                                                        <span>Offer Stock</span>
                                                    </div>


                                                    <div style="padding-top: 6px; margin-top:10px;">

                                                        <label class="switcher" style="background-color:#e2f7f6;padding-right:7px;margin-bottom:8px;width:100%">
                                                            <input type="radio"  name="variant_position_0" class="switcher-input variant_position variant_position_0" data-variant_position="0" value="befor_name" />
                                                            <span class="switcher-indicator" style="cursor: pointer;">
                                                                <span class="switcher-yes"></span>
                                                                <span class="switcher-no"></span>
                                                            </span>
                                                            <span class="switcher-label" style="font-size:14px;cursor:pointer;color:#160c0c;width:75%;">
                                                                MRP Price
                                                            </span>
                                                            <span style="cursor:pointer;margin-left:5px;margin-right:5px;color:#fff;background-color:#ff4a00;border-radius:4px;padding:0px 2px;">
                                                                80
                                                            </span>
                                                        </label>
                                                        <label class="switcher" style="background-color:#e2f7f6;padding-right:7px;margin-bottom:8px;width:100%">
                                                            <input type="radio"  name="variant_position_0" class="switcher-input variant_position variant_position_0" data-variant_position="0" value="befor_name" checked />
                                                            <span class="switcher-indicator" style="cursor: pointer;">
                                                                <span class="switcher-yes"></span>
                                                                <span class="switcher-no"></span>
                                                            </span>
                                                            <span class="switcher-label" style="font-size:14px;cursor:pointer;color:#160c0c;width:75%;">
                                                                Offer Price
                                                            </span>
                                                            <span style="cursor:pointer;margin-left:5px;margin-right:5px;color:#fff;background-color:#ff4a00;border-radius:4px;padding:0px 2px;">
                                                                36
                                                            </span>
                                                        </label>
                                                        <label class="switcher" style="background-color:#e2f7f6;padding-right:7px;margin-bottom:8px;width:100%">
                                                            <input type="radio"  name="variant_position_0" class="switcher-input variant_position variant_position_0" data-variant_position="0" value="befor_name"  />
                                                            <span class="switcher-indicator" style="cursor: pointer;">
                                                                <span class="switcher-yes"></span>
                                                                <span class="switcher-no"></span>
                                                            </span>
                                                            <span class="switcher-label" style="font-size:14px;cursor:pointer;color:#160c0c;width:75%;">
                                                                Regular Price
                                                            </span>
                                                            <span style="cursor:pointer;margin-left:5px;margin-right:5px;color:#fff;background-color:#ff4a00;border-radius:4px;padding:0px 2px;">
                                                                40
                                                            </span>
                                                        </label>
                                                        <label class="switcher" style="background-color:#e2f7f6;padding-right:7px;margin-bottom:8px;width:100%">
                                                            <input type="radio"  name="variant_position_0" class="switcher-input variant_position variant_position_0" data-variant_position="0" value="befor_name" disabled />
                                                            <span class="switcher-indicator" style="cursor: pointer;">
                                                                <span class="switcher-yes"></span>
                                                                <span class="switcher-no"></span>
                                                            </span>
                                                            <span class="switcher-label" style="font-size:14px;cursor:pointer;color:#978f8f;width:75%;">
                                                                Pruchase Price
                                                            </span>
                                                            <span style="cursor:pointer;margin-left:5px;margin-right:5px;color:#fff;background-color:#ff4a00;border-radius:4px;padding:0px 2px;">
                                                                24
                                                            </span>
                                                        </label>
                                                        <label class="switcher" style="background-color:#e2f7f6;padding-right:7px;margin-bottom:8px;width:100%">
                                                            <input type="radio"  name="variant_position_0" class="switcher-input variant_position variant_position_0" data-variant_position="0" value="befor_name"  />
                                                            <span class="switcher-indicator" style="cursor: pointer;">
                                                                <span class="switcher-yes"></span>
                                                                <span class="switcher-no"></span>
                                                            </span>
                                                            <span class="switcher-label" style="font-size:14px;cursor:pointer;color:#160c0c;width:75%;">
                                                                Whole Sell Price
                                                            </span>
                                                            <span style="cursor:pointer;margin-left:5px;margin-right:5px;color:#fff;background-color:#ff4a00;border-radius:4px;padding:0px 2px;">
                                                                35
                                                            </span>
                                                        </label>
                                                        
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <!---col-md-7-->

                                            <div class="col-md-5">
                                                <div  style="background-color:#6a3d2b;color:#e9ff30;padding:5px;margin-bottom:8px;margin-top:5px;">
                                                    <div class="form-group" style="margin-bottom:1px;">
                                                        <label class="form-label" style="color:#fcfcfd !important;">Selling Price</label>
                                                        <input type="text" name="name"  class="form-control product_name" placeholder="Selling Price" style="font-size: 15px;background-color:#d0e7ef;color:#382a25;font-weight:700;" />
                                                        <strong class="name_err color-red"></strong>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom:1px;">
                                                        <label class="form-label"style="color:#e9ff30 !important;">Quantity</label>
                                                        <input type="text" name="name"  class="form-control product_name" placeholder="Quantity" style="font-size: 15px;background-color:rgb(10, 9, 9);color:#e2f7f6;font-weight:700;" />
                                                        <strong class="name_err color-red"></strong>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                    <div style="height:2px; background-color:#f0f0f5;margin-top:5px;margin-bottom:5px;"></div>

                                                    <div class="form-group" style="margin-bottom:1px;margin-top:2px;">
                                                        <div style="background-color:#ff4a00;padding:1px;padding-top:0px;color:white;">
                                                            <strong>Less Amount</strong>
                                                            <div style="background-color:#ededed;color:red;margin-bottom:1.5px;">
                                                                <label class="switcher">
                                                                        <input type="radio"  name="less_amount" class="switcher-input variant_position variant_position_0" data-variant_position="0" value="befor_name" />
                                                                        <small class="switcher-indicator" style="cursor: pointer;backgound-color:#140505 !important">
                                                                            <span class="switcher-yes"></span>
                                                                            <span class="switcher-no"></span>
                                                                        </small>
                                                                        <small class="switcher-label" style="cursor:pointer;font-size:8px;color:#020222;padding-right:1px;">
                                                                            F
                                                                        </small>
                                                                </label>
                                                                <label class="switcher">
                                                                        <input type="radio"  name="less_amount" class="switcher-input variant_position variant_position_0" data-variant_position="0" value="befor_name" />
                                                                        <small class="switcher-indicator" style="cursor: pointer;backgound-color:#140505 !important">
                                                                            <span class="switcher-yes"></span>
                                                                            <span class="switcher-no"></span>
                                                                        </small>
                                                                        <small class="switcher-label" style="cursor:pointer;color:#020222;font-size:8px;">
                                                                            (%)
                                                                        </small>
                                                                    </label>
                                                            </div>
                                                            {{-- <label>
                                                                <small>Less Amount</small>: <br>
                                                                <label style="cursor: pointer;margin-right:5px;">
                                                                    <input name="discountType" value="percentage" type="radio" class="colored-blue cr_discountTypeClass" style="font-size:12px;cursor: pointer">
                                                                    <span class="text" style="font-size:12px;">Percentage (%)</span>
                                                                </label>
                                                                <label style="cursor: pointer">
                                                                    <input name="discountType" checked="" value="fixed" type="radio" class="colored-blue cr_discountTypeClass" style="font-size:12px;cursor: pointer">
                                                                    <span class="text" style="font-size:12px;">Fixed</span>
                                                                </label>
                                                            </label> --}}
                                                            <input type="text" name="name"  class="form-control product_name" placeholder="Less Amount" style="font-size: 15px;background-color:#dddd06;color:#1e0303;font-weight:700;" />
                                                            
                                                            <div style="font-size:14px;margin-top:1px;width:100%;padding:1% 1%;background-color:green;color:white;">
                                                                <div style="width:55%;float:left;border-right:1px solid white;">
                                                                    <strong class="" style="font-size:11px;">(180.00)</strong>
                                                                </div>
                                                                <div style="width:45%;float:right;text-align:right;">
                                                                    <strong class="" style="font-size:11px;">(8.00)</strong>
                                                                </div>
                                                                <div style="float:clear;clear: both;"></div>
                                                            </div>
                                                            <strong class="name_err color-red"></strong>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!---col-md-5-->

                                            <div class="col-md-12" style="margin-top:-4px;background-color: #ff4a00;color:#fff;">
                                                <div class="row">
                                                    <div class="col-md-7" style="text-align: right">
                                                        <strong>Total Amount  </strong>
                                                    </div>
                                                    <div class="col-md-5">
                                                        : 
                                                        <strong style="font-size: 16px">100</strong>
                                                    </div>
                                                </div>
                                            </div>

                                        </div><!---row-->
                                            
                                    </div><!---card-body-->
                                </div><!---card-->

                                <div class="row" style="margin-top:-15px;margin-right:1px;">
                                    <div class="col-md-4">
                                        {{-- <span style="cursor:pointer;" class="singleShowModal" data-id="" href="javascript:void(0)">
                                            @if(false)
                                                <img src="{{ asset('storage/backend/product/product/'.$item->id.".".$item->photo) }}" alt="" width="40" height="40" style="padding:2px;border:1px solid #c7bbbb;background-color:#fbf8f8;border-radius:4px">
                                                @else
                                                <img src="{{ asset('storage/backend/default/product/5.png') }}" alt="" width="40" height="70" style="width:100%;padding:2px;border:1px solid #c7bbbb;background-color:#fbf8f8;border-radius:4px">
                                            @endif
                                        </span> --}}
                                        <div style="background-color:#f7f7ff;color:red;margin-bottom:1.5px;">
                                            <label class="switcher">
                                                <input type="radio"  name="w_g_type" class="switcher-input variant_position variant_position_0" data-variant_position="0" value="befor_name" />
                                                <strong class="switcher-indicator" style="cursor: pointer;backgound-color:#140505 !important">
                                                    <span class="switcher-yes"></span>
                                                    <span class="switcher-no"></span>
                                                </strong>
                                                <strong class="switcher-label" style="cursor:pointer;font-size:12px;color:#020222;padding-right:1px;">
                                                    Warranty
                                                </strong>
                                            </label>
                                            <label class="switcher" style="margin-bottom: 5px;">
                                                <input type="radio"  name="w_g_type" class="switcher-input variant_position variant_position_0" data-variant_position="0" value="befor_name" />
                                                <strong class="switcher-indicator" style="cursor: pointer;backgound-color:#140505 !important">
                                                    <span class="switcher-yes"></span>
                                                    <span class="switcher-no"></span>
                                                </strong>
                                                <strong class="switcher-label" style="cursor:pointer;color:#020222;font-size:12px;">
                                                    Guarantee
                                                </strong>
                                            </label>
                                            <label for="" style="margin-top: 2px;color: #3f4052;margin-bottom: -2px;border-top: 1px solid #d3cdd2cc">Duration <small style="margin-left:3px;">(day only)</small></label>
                                            <input type="text" class="form-control" style="background-color: #6a3d2b;color:#ebebf1;font-size: 14px;font-weight: bold">
                                        </div>
                                    </div>
                                    <div class="col-md-8" style="background-color: #c7bbbb;padding-bottom:5px;">
                                        <label for="">IMEI/Serial/Chassis/Engine Number</label>
                                        <textarea name="" id="" cols="5" rows="2" class="form-control" style="background-color:white;"></textarea>
                                    </div>
                                </div>

                            </div>
                            <!----col-5--->
            
                        </div>

                        
                        

                    </div>
                    <!--modal body-->
                    <div class="modal-footer" style="background-color:#f9f5f4;">
                        <button type="button" style="color:white;" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" role="status" value="Add To Cart">
                    </div>
                </form>
            </div>





