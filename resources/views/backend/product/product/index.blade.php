@extends('layouts.backend.app')
@section('page_title') Product @endsection
@push('css')
<style>

</style>
@endpush



<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%^^^^Content^^^^%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
@section('content')
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%^^^^Content^^^^%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->


    <!--**************************************-->
    <!--*********^page title content^*********-->
    <!---page_title_of_content-->    
    @push('page_title_of_content')
        <div class="breadcrumbs layout-navbar-fixed">
            <h4 class="font-weight-bold py-3 mb-0">Products  </h4>
            <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#"><i class="feather icon-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item active">All Product</li>
                </ol>
            </div>
            <div class="products">
                <a href="#" class="addProductModal">Add Product</a>
                {{-- <a href="{{ route('admin.product.create') }}" >Add Product</a> --}}
            </div>
        </div>
    @endpush
    <!--*********^page title content^*********-->
    <!--**************************************-->



    <!--#################################################################################-->
    <!--######################^^total content space for this page^^######################-->    
    <div  class="content_space_for_page">
    <!--######################^^total content space for this page^^######################--> 
    <!--#################################################################################-->


        <!-------status message content space for this page------> 
        <div class="status_message_in_content_space">
            @include('layouts.backend.partial.success_error_status_message')
        </div>
        <!-------status message content space for this page------> 


        

        <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
        <!--@@@@@@@@@@@@@@@@@@@@@@@^^^real space in content^^^@@@@@@@@@@@@@@@@@@@@@@@--> 
        <div class="real_space_in_content">
        <!-------real space in content------> 
        <!--@@@@@@@@@@@@@@@@@@@@@@@^^^real space in content^^^@@@@@@@@@@@@@@@@@@@@@@@-->     
        <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->   
        

            <div class="row" style="margin-bottom: 5px;background-color:#ffff;padding:5px 0px 10px 0px;">
                <div class="col-12">
                    <div>
                        <table  style="width: 100%;">
                            <tr>
                                <td style="width:7%">
                                    <label for="">&nbsp;</label>
                                    <select class="form-control paginate" id="paginate" name="paginate" style="font-size: 12px;width:100%;">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                        <option value="50" selected>50</option>
                                        <option value="100">100</option>
                                        <option value="200">200</option>
                                        <option value="300">300</option>
                                        <option value="500">500</option>
                                        <option value="1000">1000</option>
                                    </select>
                                </td>
                                <td style="width:1%"></td>
                                <td style="width: 20%">
                                    <label for="">Supplier</label>
                                    <select name="supplier_id" id="supplier_filter_id" class="supplier_filter_id form-control">
                                        <option value="">Select Supllier</option>
                                        @foreach ($suppliers as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option> 
                                        @endforeach
                                    </select>
                                </td>
                                <td style="width:1%"></td>
                                <td style="width:14%">
                                    <label for="">Group</label>
                                    <select name="ground" id="ground_filter_id" class="ground_filter_id form-control">
                                        <option value="">Select Group</option>
                                        @foreach ($groups as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option> 
                                        @endforeach
                                    </select>
                                </td>
                                <td style="width:1%"></td>
                                <td style="width: 15%">
                                    <label for="">Brand</label>
                                    <select name="brand" id="brand_filter_id" class="brand_filter_id form-control">
                                        <option value="">Select Brand</option>
                                        @foreach ($brands as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option> 
                                        @endforeach
                                    </select>
                                </td>
                                <td style="width:1%"></td>
                                <td style="width:19%">
                                    <label for="">Category</label>
                                    <select name="category" id="category_filter_id" class="category_filter_id form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option> 
                                        @endforeach
                                    </select>
                                </td>
                                <td style="width:1%"></td>
                                <td style="width: 20%">
                                    <label for="">Search</label>
                                    <input type="text" class="search form-control" name="search" autofocus autocomplete="off">
                                </td>
                            </tr>
                        </table>
                    </div>

                    {{-- <div class="on_processing" style="text-align: center;padding-bottom:20px;display:none;">
                        <strong style="color:#0c0c0c;z-index:99999;background-color:#f9f9f9;padding:3px 5px;border-radious:3px solidg gray;">
                            Processing...
                        </strong>
                    </div> --}}
                </div>
            </div>
            <br>
            <!-------responsive table------> 
            <div class="productListAjaxResponseResult">

                @include('backend.product.product.partial.list')

            </div>
            <!-------responsive table------> 

            

            <!-------add Product Modal------> 
            <div class="modal fade " id="addProductModal"  aria-modal="true"></div>
            <input type="hidden" class="addProductModalRoute" value="{{ route('admin.product.create') }}">
            <!-------add Product Modal------> 
            

            <!-------edit Product Modal------> 
            <div class="modal fade " id="editProductModal"  aria-modal="true"></div>
            <input type="hidden" class="editProductModalRoute" value="{{ route('admin.product.edit') }}">
            <!-------edit Product Modal------> 

            <!-------show Product Modal------> 
            <div class="modal fade " id="showProductModal"  aria-modal="true"></div>
            <input type="hidden" class="showProductModalRoute" value="{{ route('admin.product.show') }}">
            <!-------show Product Modal------> 


            <!-------delete Product Modal------> 
            @include('backend.product.product.partial.delete_modal')
            <input type="hidden" class="deleteProductModalRoute" value="{{ route('admin.product.delete') }}">
            <!-------delete Product Modal------> 
            

            <!-------edit Product Price Modal------> 
            <div class="modal fade " id="editProductPriceModal"  aria-modal="true"></div>
            <input type="hidden" class="editProductPriceModalRoute" value="{{ route('admin.product.price.index') }}">
            <!-------edit Product Price Modal------> 



        
        <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
        <!--@@@@@@@@@@@@@@@@@@@@@@@^^^real space in content^^^@@@@@@@@@@@@@@@@@@@@@@@-->     
        </div>
        <!--real space in content--> 
        <!--@@@@@@@@@@@@@@@@@@@@@@@^^^real space in content^^^@@@@@@@@@@@@@@@@@@@@@@@--> 
        <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->

    


    <!--#################################################################################-->
    <!--######################^^total content space for this page^^######################-->  
    </div>
    <!--######################^^total content space for this page^^######################--> 
    <!--#################################################################################-->


    {{--Product list url --}}
    <input type="hidden" class="productListUrl" value="{{route('admin.product.list.ajaxresponse')}}">
    {{--Product list url --}}


    

    <!---------product attributes all modal linked there---------->
    @include('backend.product.product.partial.attributes_all_modal')
    <!---------product attributes all modal linked there---------->



<!--=================js=================-->
@push('js')
<!--=================js=================-->
<script src="{{asset('custom_js/backend')}}/product/product/index.js?v=1"></script>
<script src="{{asset('custom_js/backend')}}/product/product/create.js?v=2"></script>
<script src="{{asset('custom_js/backend')}}/product/product/edit.js?v=3"></script>
<script src="{{asset('custom_js/backend')}}/product/product/price-edit.js?v=4"></script>


    <!---------product attributes all modal linked there---------->
    @include('backend.product.product.partial.attributes_all_js_link')
    <!---------product attributes all modal linked there---------->


    <!----add more product option here---->
    <script>
        $(document).on('click','.add',function(){
                let uniqueId = 1 + ($(this).data('add'));
        
                var newAllOptions =  ` 
                        <!--all option # add more-->
                            <div class="existing_data existing_data_${uniqueId}" data-existing="${uniqueId}">
                                
                                <!--background-->
                                <div>

                                    <!--Product Variant--->
                                    <div style="padding:5px;margin-bottom:5px;margin-top:5px;">
                                        <div class="form-row" >
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Product Variant</label>
                                                <input type="text" name="product_variant_${uniqueId}" class="form-control product_variant product_variant_${uniqueId}" data-product_variant="${uniqueId}" placeholder="Product Variant"  style="border:1px solid #e2f7f6;font-weight: 400;"/>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Set/Use Product Variant</label>
                                                <div style="padding-top: 6px;" >
                                                    <label class="switcher" style="background-color: #e2f7f6;">
                                                        <input type="radio"  name="variant_position_${uniqueId}" class="switcher-input variant_position variant_position_${uniqueId}" data-variant_position="${uniqueId}" value="befor_name" checked />
                                                        <span class="switcher-indicator">
                                                            <span class="switcher-yes"></span>
                                                            <span class="switcher-no"></span>
                                                        </span>
                                                        <small class="switcher-label" style="color:#160c0c;">Before Name</small>
                                                    </label>
                                                    <label class="switcher" style="background-color: #e2f7f6;">
                                                        <input type="radio"  name="variant_position_${uniqueId}" class="switcher-input variant_position variant_position_${uniqueId}" data-variant_position="${uniqueId}" value="after_name" />
                                                        <span class="switcher-indicator">
                                                            <span class="switcher-yes"></span>
                                                            <span class="switcher-no"></span>
                                                        </span>
                                                        <small class="switcher-label" style="color:#160c0c;">After Name</small>
                                                    </label>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group col-md-12 product_name_with_variant_div product_name_with_variant_div_${uniqueId}" data-product_name_with_variant_div="${uniqueId}" style="display:none;margin-bottom:-2px;margin-top:-8px;">
                                                <strong style="color:red;">Product</strong> : <span class="product_name_with_variant_text product_name_with_variant_text_${uniqueId}" data-product_name_with_variant_text="${uniqueId}" style="font-weight: bold;color:#262625;font-size:12px;"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Product Variant--->

                                    <!--color and initial stock--->
                                    <div style="padding:5px;margin-bottom:5px;margin-top:5px;">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label">
                                                    Product Color  
                                                    <span class="addColorModal" data-create_from_value="product" data-class_name="addedNewColor_${uniqueId}" style="cursor: pointer;border:1px solid black;">
                                                        <i class="fa fa-plus" style="padding: 1px 3px; border-radius: 3px;font-size:10px;"></i>
                                                    </span>
                                                </label>
                                                <select class="form-control addedNewColor_${uniqueId} color_id color_id_${uniqueId}" data-color_id="${uniqueId}" name="color_id_${uniqueId}" style="">
                                                    <option value="" style="">Select Color</option>
                                                    @foreach ($colors as $item)
                                                    <option value="{{$item->id}}" style="">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="form-label">Initial Stock</label>
                                                <input type="text" class="form-control initial_stock initial_stock_${uniqueId}" data-initial_stock="${uniqueId}" name="initial_stock_${uniqueId}"  style="" placeholder="Initial Stock" />
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="form-label">Alert Quantity</label>
                                                <input type="text" class="form-control alert_stock alert_stock_${uniqueId}" data-alert_stock="${uniqueId}" name="alert_stock_${uniqueId}"  style="" placeholder="Alert Quantity" />
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--color and initial stock--->

                                    <!--price--->
                                    <div style="padding:5px;">
                                        <div class="form-row">
                                            @foreach ($prices as $price)
                                                <div class="{{$price->class}}">
                                                    <label class="form-label">{{$price->label}}</label>
                                                    <input type="text" value="0"  name="{{$price->id}}_${uniqueId}"  class="form-control {{$price->id}} inputFieldValidatedOnlyNumeric {{$price->id}}_${uniqueId}"  data-{{$price->id}}="${uniqueId}"  placeholder="{{$price->label}}" style="{{$price->css_style}}" required />
                                                    <div class="clearfix"></div>
                                                </div> 
                                                <input type="hidden" value="{{$price->id}}" name="${uniqueId}_price[]" class="${uniqueId}_price" data-price="${uniqueId}">
                                            @endforeach
                                            
                                        </div>
                                    </div>
                                    <!--price--->

                                    <!--AS code and Company code--->
                                    <div style="padding: 5px;margin-bottom:5px;margin-top:5px;">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label">AS Code</label>
                                                <input type="text" class="form-control custom_code custom_code_${uniqueId}" data-custom_code="${uniqueId}" name="custom_code_${uniqueId}"  placeholder="AS Code" style="" />
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Company Code</label>
                                                <input type="text" class="form-control company_code company_code_${uniqueId}" data-company_code="${uniqueId}" name="company_code_${uniqueId}"  placeholder="Company Code" style="" />
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--AS code and Company code--->

                                    <!--Image and Description--->
                                    <div style="padding: 5px;margin-bottom:5px;margin-top:5px;">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Photo</label>
                                                <input type="file" class="form-control photo photo_${uniqueId}" data-photo="${uniqueId}" name="photo_${uniqueId}" style="" />
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Description</label>
                                                <textarea cols="4" rows="1" class="form-control description description_${uniqueId}" data-description="${uniqueId}" name="description_${uniqueId}"  placeholder="Description" style="" ></textarea>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Image and Description--->

                                    <input type="hidden" value="${uniqueId}" name="form_data[]" class="form_data_${uniqueId}" data-form_data="${uniqueId}">
                                </div>
                                <!--background-->

                                <!-- add more button-->
                                <div class="row">
                                    <div class="form-group col-md-12" style="text-align: right;">
                                        <button type="button" name="add" class="btn btn-success btn-sm add add_${uniqueId}" data-add="${uniqueId}">
                                            <i class='fas fa-plus text-orange-green'></i>
                                        </button>
                                        <button type="button" name="add" class="btn btn-danger btn-sm remove remove_${uniqueId}" data-remove="${uniqueId}">
                                            <i style="color:yellow;" class="fas fa-times text-orange-red"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- add more button-->


                            </div>
                        <!--all option # add more-->
                        `;

            $('.new_option').append(newAllOptions);

        });

        $(document).on('click','.remove',function(){
            var currentRow = $(this).data('remove');
            $('.existing_data_'+currentRow).remove();
        });
    </script>
    <!----add more product option here---->


    
<!--=================js=================-->
@endpush
<!--=================js=================-->



<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%^^^^Content^^^^%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
@endsection
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%^^^^Content^^^^%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
