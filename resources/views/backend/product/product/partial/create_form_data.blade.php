
                        <div class="row">

                            <div class="col-md-8 ">
                                <div class="card mb-4">
                                    {{-- <h6 class="card-header">Product Information <small>(Changeable Data)</small></h6> --}}
                                    <div class="card-body">
                                     
                                        <div class="form-group">
                                            <label class="form-label">Product Name</label>
                                            <input type="text" name="name"  class="form-control product_name" placeholder="Product Name"/>
                                            <strong class="name_err color-red"></strong>
                                            <div class="clearfix"></div>
                                        </div>
            
                                        <!--all option # add more-->
                                        <div class="existing_data existing_data_0" data-existing="0">
                                            
                                            <!--background-->
                                            <div>
            
                                                <!--Product Variant--->
                                                <div style="padding:5px;margin-bottom:5px;margin-top:5px;">
                                                    <div class="form-row" >
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label">Product Variant</label>
                                                            <input type="text" name="product_variant_0" class="form-control product_variant product_variant_0" data-product_variant="0" placeholder="Product Variant"  style="border:1px solid #e2f7f6;background-color:whitesmoke;color:#150436;font-weight: 400;"/>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label">Set/Use Product Variant</label>
                                                            <div style="padding-top: 6px;" >
                                                                <label class="switcher" style="background-color: #e2f7f6;">
                                                                    <input type="radio"  name="variant_position_0" class="switcher-input variant_position variant_position_0" data-variant_position="0" value="befor_name" checked />
                                                                    <span class="switcher-indicator">
                                                                        <span class="switcher-yes"></span>
                                                                        <span class="switcher-no"></span>
                                                                    </span>
                                                                    <small class="switcher-label" style="color:#160c0c;">Before Name</small>
                                                                </label>
                                                                <label class="switcher" style="background-color: #e2f7f6;">
                                                                    <input type="radio"  name="variant_position_0" class="switcher-input variant_position variant_position_0" data-variant_position="0" value="after_name" />
                                                                    <span class="switcher-indicator">
                                                                        <span class="switcher-yes"></span>
                                                                        <span class="switcher-no"></span>
                                                                    </span>
                                                                    <small class="switcher-label" style="color:#160c0c;">After Name</small>
                                                                </label>
                                                            </div>
                                                            {{-- <div class="row" style="padding-top:5px;">
                                                                <div class="col-md-6">
                                                                    <label class="custom-control custom-radio">
                                                                        <input name="custom-radio-3" type="radio" class="custom-control-input" checked="" />
                                                                        <span class="custom-control-label"  style="margin-left: -10px;">
                                                                            Before Name
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="custom-control custom-radio">
                                                                        <input name="custom-radio-3" type="radio" class="custom-control-input" />
                                                                        <span class="custom-control-label" style="margin-left: -10px;">
                                                                            After Name
                                                                        </span>
                                                                    </label> 
                                                                </div>
                                                            </div> --}}
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="form-group col-md-12 product_name_with_variant_div product_name_with_variant_div_0" data-product_name_with_variant_div="0" style="display:none;margin-bottom:-2px;margin-top:-8px;">
                                                            <strong style="color:red;">Product</strong> : <span class="product_name_with_variant_text product_name_with_variant_text_0" data-product_name_with_variant_text="0" style="font-size:13px;font-weight: bold;"></span>
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
                                                                <span class="addColorModal" data-create_from_value="product" data-class_name="addedNewColor_0" style="cursor: pointer;border:1px solid black;">
                                                                    <i class="fa fa-plus" style="padding: 1px 3px; border-radius: 3px;font-size:10px;"></i>
                                                                </span>
                                                            </label>
                                                            <select class="form-control addedNewColor_0 color_id color_id_0" data-color_id="0" name="color_id_0" style="">
                                                                <option value="" style="">Select Color</option>
                                                                @foreach ($colors as $item)
                                                                <option value="{{$item->id}}" style="">{{$item->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label class="form-label">Initial Stock</label>
                                                            <input type="text" class="form-control initial_stock initial_stock_0" data-initial_stock="0" name="initial_stock_0"  style="" placeholder="Initial Stock" />
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label class="form-label">Alert Quantity</label>
                                                            <input type="text" class="form-control alert_stock alert_stock_0" data-alert_stock="0" name="alert_stock_0"  style="" placeholder="Alert Quantity" />
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
                                                                <input type="text" name="{{$price->id}}_0"  class="form-control inputFieldValidatedOnlyNumeric {{$price->id}} {{$price->id}}_0" required data-{{$price->id}}="0"  placeholder="{{$price->label}}" style="{{$price->css_style}}" />
                                                                <div class="clearfix"></div>
                                                            </div> 
                                                            <input type="hidden" value="{{$price->id}}" name="0_price[]" class="0_price" data-price="0">
                                                        @endforeach

                                                    </div><!--form-row--->
                                                </div>
                                                <!--price--->
            
                                                <!--AS code and Company code--->
                                                <div style="padding: 5px;margin-bottom:5px;margin-top:5px;">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label">AS Code</label>
                                                            <input type="text" class="form-control custom_code custom_code_0" data-custom_code="0" name="custom_code_0"  placeholder="AS Code" style="" />
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="form-label">Company Code</label>
                                                            <input type="text" class="form-control company_code company_code_0" data-company_code="0" name="company_code_0"  placeholder="Company Code" style="" />
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--AS code and Company code--->
            
                                                <input type="hidden" value="0" name="form_data[]" class="form_data_0" data-form_data="0">
                                            </div>
                                            <!--background-->
            
                                            <!--Image and Description--->
                                            <div style="padding: 5px;margin-bottom:5px;margin-top:5px;">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label">Photo</label>
                                                        <input type="file" class="form-control photo photo_0" data-photo="0" name="photo_0" style="" />
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="form-label">Description</label>
                                                        <textarea cols="4" rows="1" class="form-control description description_0" data-description="0" name="description_0"  placeholder="Description" style="" ></textarea>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Image and Description--->
            
                                            <!-- add more button-->
                                            <div class="row">
                                                <div class="form-group col-md-12" style="text-align: right;">
                                                    <button type="button" name="add" class="btn btn-success btn-sm add add_0" data-add="0">
                                                        <i class='fas fa-plus text-orange-green'></i>
                                                    </button>
                                                    <button type="button" name="add" disabled class="btn btn-danger btn-sm">
                                                        <i style="color:yellow;" class="fas fa-times text-orange-red"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- add more button-->
                                        </div>
                                        <!--all option # add more-->
            
            
                                        <!--all new option add here # add more-->
                                        <div class="new_option"></div>
                                        <!--all new option add here # add more-->
            
                                    </div> <!--card-body-->
                                </div>
                            </div> 
            
                            <!----col-4--->
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    {{-- <h6 class="card-header">Others Information <small>(Fixed Data)</small></h6> --}}
                                    <div class="card-body">
                                        
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Supplier
                                                    <span class="addSupplierModal" data-create_from_value="product" data-class_name="addedNewSupplier" style="cursor: pointer;color:white;background-color:#ff4a00;border:1px solid #d34105;">
                                                        <i class="fa fa-plus" style="padding: 1px 3px; border-radius: 3px;font-size:10px;"></i>
                                                    </span>
                                                </label>
                                                <select class="form-control addedNewSupplier" name="supplier_id">
                                                    <option value="">Select Supplier</option>
                                                    @foreach ($suppliers as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                <strong class="supplier_id_err color-red"></strong>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Category
                                                    <span class="addCategoryModal" data-create_from_value="product" data-class_name="addedNewCategory" style="cursor: pointer;color:white;background-color:#ff4a00;border:1px solid #d34105;">
                                                        <i class="fa fa-plus" style="padding: 1px 3px; border-radius: 3px;font-size:10px;"></i>
                                                    </span>
                                                </label>
                                                <select class="form-control category addedNewCategory"  name="category_id">
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                <strong class="category_id_err color-red"></strong>
                                                <div class="clearfix"></div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Sub-category
                                                    <span class="addSubCategoryModal" data-create_from_value="product" data-class_name="addedNewSubCategory" style="cursor: pointer;color:white;background-color:#ff4a00;border:1px solid #d34105;">
                                                        <i class="fa fa-plus" style="padding: 1px 3px; border-radius: 3px;font-size:10px;"></i>
                                                    </span>
                                                </label>
                                                <select class="form-control subCategory addedNewSubCategory"  name="sub_category_id">
                                                    <option value="">Select Category first</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">
                                                    Brand
                                                    <span class="addBrandModal" data-create_from_value="product"  data-class_name="addedNewBrand"  style="cursor: pointer;color:white;background-color:#ff4a00;border:1px solid #d34105;">
                                                        <i class="fa fa-plus" style="padding: 1px 3px; border-radius: 3px;font-size:10px;"></i>
                                                    </span>
                                                </label>
                                                <select class="form-control addedNewBrand"  name="brand_id">
                                                    <option value="">Select Brand</option>
                                                    @foreach ($brands as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                <strong class="brand_id_err color-red"></strong>
                                                <div class="clearfix"></div>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Grade
                                                    <span class="addProductGradeModal" data-create_from_value="product"  data-class_name="addedNewGrade"  style="cursor: pointer;color:white;background-color:#ff4a00;border:1px solid #d34105;">
                                                        <i class="fa fa-plus" style="padding: 1px 3px; border-radius: 3px;font-size:10px;"></i>
                                                    </span>
                                                </label>
                                                <select class="form-control addedNewGrade"  name="product_grade_id">
                                                    <option value="">Select Grade</option>
                                                    @foreach ($productGrades as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                <strong class="product_grade_id_err color-red"></strong>
                                                <div class="clearfix"></div>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Purchase Unit
                                                    <span class="addUnitModal" data-create_from_value="product"   data-class_name="addedNewUnit" style="cursor: pointer;color:white;background-color:#ff4a00;border:1px solid #d34105;">
                                                        <i class="fa fa-plus" style="padding: 1px 3px; border-radius: 3px;font-size:10px;"></i>
                                                    </span>
                                                </label>
                                                <select class="form-control addedNewUnit"  name="unit_id">
                                                    <option value="">Select Unit</option>
                                                    @foreach ($units as $item)
                                                        <option value="{{$item->id}}">{{$item->short_name}}</option>
                                                    @endforeach
                                                </select>
                                                <strong class="unit_id_err color-red"></strong>
                                                <div class="clearfix"></div>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Group Name
                                                    <span class="addSupplierGroupModal" data-create_from_value="product"   data-class_name="addedNewGroup"  style="cursor: pointer;color:white;background-color:#ff4a00;border:1px solid #d34105;">
                                                        <i class="fa fa-plus" style="padding: 1px 3px; border-radius: 3px;font-size:10px;"></i>
                                                    </span>
                                                </label>
                                                <select class="form-control addedNewGroup"  name="supplier_group_id">
                                                    <option value="">Select Group</option>
                                                    @foreach ($supplierGroups as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                <strong class="supplier_group_id_err color-red"></strong>
                                                <div class="clearfix"></div>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Warehouse
                                                    <span class="addWarehouseModal" data-create_from_value="product"   data-class_name="addedNewWarehouse"  style="cursor: pointer;color:white;background-color:#ff4a00;border:1px solid #d34105;">
                                                        <i class="fa fa-plus" style="padding: 1px 3px; border-radius: 3px;font-size:10px;"></i>
                                                    </span>
                                                </label>
                                                <select class="form-control addedNewWarehouse warehouse_id"  name="warehouse_id">
                                                    <option value="">Select Warehouse</option>
                                                    @foreach ($warehouses as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                <strong class="warehouse_id_err color-red"></strong>
                                                <div class="clearfix"></div>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Warehouse Rack
                                                    <span class="addWarehouseRackModal" data-create_from_value="product" data-class_name="addedNewWarehouseRack" style="cursor: pointer;color:white;background-color:#ff4a00;border:1px solid #d34105;">
                                                        <i class="fa fa-plus" style="padding: 1px 3px; border-radius: 3px;font-size:10px;"></i>
                                                    </span>
                                                </label>
                                                <select class="form-control warehouseRack addedNewWarehouseRack"  name="warehouse_rack_id">
                                                    <option value="">Select Warehouse first</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>

                                            {{-- <div class="form-group">
                                                <label class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" />
                                                    <span class="custom-control-label">Check this custom checkbox</span>
                                                </label>
                                            </div> --}}
                                            <input type="submit" class="btn btn-primary" value="Submit">
                                            
                                            {{-- <div class="form-group">
                                                <div class="col-md-12 processing" style="text-align: left;display: none;">
                                                    <span style="color:saddlebrown;">
                                                        <span class="spinner-border spinner-border-sm" role="status"></span>Processing...
                                                    </span>
                                                </div>
                                            </div> --}}
                                            
                                    </div>
                                </div>
                            </div>
                            <!----col-4--->
            
                        </div>
                        
