@extends('layouts.backend.app')
@section('page_title') Home Page @endsection
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
                    <li class="breadcrumb-item">Products</li>
                    <li class="breadcrumb-item active">All Products</li>
                </ol>
            </div>
            <div class="products">
                <a href="{{route('admin.product.index')}}">Product List</a>
            </div>
            <div class="form-group">
                <div class="col-md-12 processing" style="text-align:center;display:none;">
                    <span style="color:saddlebrown;">
                        <span class="spinner-border spinner-border-sm" role="status"></span>Processing...
                    </span>
                </div>
            </div>
            @include('layouts.backend.partial.success_error_status_message_custom')
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
        

           
            
        <form action="{{route('admin.product.store')}}" method="POST" class="storeProductData" enctype="multipart/form-data">
            @csrf
            @include('backend.product.product.partial.create_form_data')
         
        </form>

        
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

    <!----redirect location after added product---->
        <input type="hidden" class="redirectRouteAfterAddedProduct" value="{{route('admin.product.index')}}">
    <!----redirect location after added product---->



    <!---------product attributes all modal linked there---------->
    @include('backend.product.product.partial.attributes_all_modal')
    <!---------product attributes all modal linked there---------->



<!--=================js=================-->
@push('js')
<!--=================js=================-->
<script src="{{asset('custom_js/backend')}}/product/product/create.js?v=2"></script>

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
                                    <div style="background-color:#252d3c;color:#e9ff30;padding:5px;margin-bottom:5px;margin-top:5px;">
                                        <div class="form-row" >
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Product Variant</label>
                                                <input type="text" name="product_variant_${uniqueId}" class="form-control product_variant product_variant_${uniqueId}" data-product_variant="${uniqueId}" placeholder="Product Variant"  style="border:1px solid #e2f7f6;background-color:whitesmoke;color:#150436;font-weight: 400;"/>
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
                                                <strong style="color:red;">Product</strong> : <span class="product_name_with_variant_text product_name_with_variant_text_${uniqueId}" data-product_name_with_variant_text="${uniqueId}" style="color:yellow;font-size:12px;"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Product Variant--->

                                    <!--color and initial stock--->
                                    <div style="background-color:brown;padding:5px;color:#fff;margin-bottom:5px;margin-top:5px;">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label">
                                                    Product Color  
                                                    <span class="addColorModal" data-create_from_value="product" data-class_name="addedNewColor_${uniqueId}" style="cursor: pointer;color:white;background-color:#ff4a00;border:1px solid #d34105;">
                                                        <i class="fa fa-plus" style="padding: 1px 3px; border-radius: 3px;font-size:10px;"></i>
                                                    </span>
                                                </label>
                                                <select class="form-control addedNewColor_${uniqueId} color_id color_id_${uniqueId}" data-color_id="${uniqueId}" name="color_id_${uniqueId}" style="color:yellow;background-color:#201c1c;">
                                                    <option value="" style="background-color:#fff;color:#1c1803;">Select Color</option>
                                                    @foreach ($colors as $item)
                                                    <option value="{{$item->id}}" style="background-color:#fff;color:#1c1803;">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Initial Stock</label>
                                                <input type="text" class="form-control initial_stock initial_stock_${uniqueId}" data-initial_stock="${uniqueId}" name="initial_stock_${uniqueId}"  style="background-color:rgb(232, 240, 254);color:#030312;" placeholder="Initial Stock" />
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--color and initial stock--->

                                    <!--price--->
                                    <div style="background-color:#54a52a;color:white;padding:5px;">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label class="form-label">Purchase Price</label>
                                                <input type="text" class="form-control purchase_price purchase_price_${uniqueId}"  data-purchase_price="${uniqueId}" name="purchase_price_${uniqueId}"   placeholder="Purchase Price" style="background-color:#ebd354;color:#161603;font-weight:900;" />
                                                <div class="clearfix"></div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="form-label">MRP Price</label>
                                                <input type="text" class="form-control mrp_price mrp_price_${uniqueId}"  data-mrp_price="${uniqueId}" name="mrp_price_${uniqueId}"  placeholder="MRP Price" style="background-color: black;color:yellow;font-weight:900;" />
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="form-label">Whole Sell Price</label>
                                                <input type="text" class="form-control whole_sell_price whole_sell_price_${uniqueId}"  data-whole_sell_price="${uniqueId}" name="whole_sell_price_${uniqueId}"  placeholder="Whole Sell Price" style="background-color: #f17777;color:midnightblue;font-weight:900;" />
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="form-label">Sell Price</label>
                                                <input type="text" class="form-control sell_price sell_price_${uniqueId}"  data-sell_price="${uniqueId}" name="sell_price_${uniqueId}"  placeholder="Sell Price" style="background-color: aliceblue;color:blue;font-weight:900;" />
                                                <div class="clearfix"></div>
                                            </div>

                                        </div>
                                    </div>
                                    <!--price--->

                                    <!--AS code and Company code--->
                                    <div style="background-color:rgb(12 143 143);padding: 5px;color:yellow;margin-bottom:5px;margin-top:5px;">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label">AS Code</label>
                                                <input type="text" class="form-control custom_code custom_code_${uniqueId}" data-custom_code="${uniqueId}" name="custom_code_${uniqueId}"  placeholder="AS Code" style="background-color:rgb(232, 240, 254);color:#030312;" />
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Company Code</label>
                                                <input type="text" class="form-control company_code company_code_${uniqueId}" data-company_code="${uniqueId}" name="company_code_${uniqueId}"  placeholder="Company Code" style="background-color:rgb(232, 240, 254);color:#030312;" />
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--AS code and Company code--->

                                    <!--Image and Description--->
                                    <div style="background-color:#706a6a;padding: 5px;color:aliceblue;margin-bottom:5px;margin-top:5px;">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Photo</label>
                                                <input type="file" class="form-control photo photo_${uniqueId}" data-photo="${uniqueId}" name="photo_${uniqueId}" style="background-color:#deb887;color:#0000bf;" />
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Description</label>
                                                <textarea cols="4" rows="1" class="form-control description description_${uniqueId}" data-description="${uniqueId}" name="description_${uniqueId}"  placeholder="Description" style="background-color:#deb887;color:#0000bf;" ></textarea>
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

    
    <script>
        /* $(document).on('click', '.add', function(){
            let count = 1;
            count = count + $('#item_table >tbody >tr').length;
            if(count <= 100)
            {
                let html = '';
                html += '<tr>';
                html += '<td>'+"#"+count  +'</td>';
                html += '<td><input autocomplete="off"  type="text" name="expense_title[]" class="form-control" /></td>';
                html += '<td><input autocomplete="off"  type="text" name="description[]" class="form-control" /></td>';
                html += '<td><input autocomplete="off"  type="text" name="final_total[]" value="0"  class="form-control finalTotal" /></td>';
                html += '<td><input autocomplete="off"  type="text" name="expense_created_date[]" placeholder="dd/mm/yy" style="width:80%;" class=" air-datepicker" data-position="bottom right"></td>';
                //html += '<td><select name="item_unit[]" class="form-control item_unit"><option value="">Select Unit</option>@foreach($categories as $cat)<option value="{{ $cat->id }}">{{ $cat->name }}</option> @endforeach</select></td>';
                html += '<td><button type="button" name="add" class="btn btn-success btn-sm add" style="margin-right:1%;"><i class="fas fa-plus text-orange-green"></i></button><button type="button"  name="remove" class="btn btn-danger btn-sm remove"><i style="color:yellow;" class="fas fa-times text-orange-red"></i></button></td></tr>';
                $('#item_table').append(html);
            }
        }); */


        /* $(document).on('click', '.remove', function(){
            $(this).closest('tr').remove();
            
            let total = 0;
            $('.finalTotal').each(function() 
            {
                total += parseFloat($(this).val());
            })
            $('#showTotal').text(total);
            $('#showTotalVal').val(total);
        }); */
        

    </script>
    
<!--=================js=================-->
@endpush
<!--=================js=================-->



<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%^^^^Content^^^^%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
@endsection
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%^^^^Content^^^^%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->

{{-- <div class="row">
    <div class="form-group col-md-12" style="text-align: right;">
        <button type="button" name="add" class="btn btn-success btn-sm add add_${count}" data-add="${count}">
            <i class='fas fa-plus text-orange-green'></i>
        </button>
        <button type="button" name="add" class="btn btn-danger btn-sm remove remove_${count}" data-remove="${count}">
            <i style="color:yellow;" class="fas fa-times text-orange-red"></i>
        </button>
    </div>
</div> --}}
