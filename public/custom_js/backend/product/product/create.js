
    $(document).on('click','.variant_position',function(){
        var id = $(this).data('variant_position');
        productVariantDisplay(id);
    });

    $(document).on('keyup','.product_variant',function(){
        var id = $(this).data('product_variant');
        productVariantDisplay(id);
    });

    function productVariantDisplay(id)
    {
        var checked = $("input[type='radio'].variant_position_"+id+":checked").val();
        var productName     = $('.product_name').val();
        var productVariant  = $('.product_variant_'+id).val();

        var newProductWithVariant = productName;
        if(checked == "befor_name")
        {
            newProductWithVariant =  productVariant + " " + productName ;
        }else{
            newProductWithVariant =  productName + " " + productVariant ;
        }
        $('.product_name_with_variant_div_'+id).show();
        $('.product_name_with_variant_text_'+id).text(newProductWithVariant);
        /* 
            if($("input[type='radio'].radioBtnClass").is(':checked')) {
                var card_type = $("input[type='radio'].variant_position:checked").val();
                alert(card_type);
            }
            var section = $('input:radio[name="sec_num"]:checked').val();
            var question = $('input:radio[name="qst_num"]:checked').val(); 
        */
    }
//-----------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------

    //input field protected .. only for numeric
    $(document).on('keyup keypress','.inputFieldValidatedOnlyNumeric,.purchase_price ,.mrp_price,.whole_sell_price,.sell_price,.initial_stock',function(e){
        if (String.fromCharCode(e.keyCode).match(/[^0-9\.]/g)) return false;
        /* var charCode = (e.which) ? e.which : event.keyCode    
        if (String.fromCharCode(charCode).match(/[^0-9\.]/g))    
            return false; */ 
        //if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
        //if (String.fromCharCode(e.keyCode).match(/[^1-9\./g)) return false;
    });
    //<input name="number" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
    
    
    
    //get subcategory by category id
    //------------------------------------------------------------------------------
        $(document).on('change','.category',function(){
            var url = $('.subCategoryByCategoryIdRoute').val();
            var cat_id = $(this).val();
            $.ajax({
                url:url,
                data:{cat_id:cat_id},
                success:function(response){
                    if(response.status == true)
                    {
                        $('.subCategory').html(response.html);
                    }
                }
            });
        });
    //------------------------------------------------------------------------------

    //get warehouse rack  by warehouse id
    //------------------------------------------------------------------------------
        $(document).on('change','.warehouse_id',function(){
            var url = $('.warehouseRackByWarehouseIdRoute').val();
            var warehouse_id = $(this).val();
            $.ajax({
                url:url,
                data:{warehouse_id:warehouse_id},
                success:function(response){
                    if(response.status == true)
                    {
                        $('.warehouseRack').html(response.html);
                    }
                }
            });
        });
    //------------------------------------------------------------------------------





//------------------------------------------------------------------------------
    $(document).on('click','.addProductModal',function(){
        var url = $('.addProductModalRoute').val();
        $.ajax({
            url:url,
            success:function(response){
                $('#addProductModal').html(response).modal('show');
            }
        });
    });

    $('#addProductModal').css('overflow-y', 'auto');

    $(document).on("submit",'.storeProductData',function(e){
        e.preventDefault();
        var form = $(this);
        /* var url = form.attr("action");
        var type = form.attr("method");
        var data = form.serialize(); */
        $('.color-red').text('');
        $.ajax({
            /*url: url,
            data: data,
            type: type,
            datatype:"JSON", */
            url: $(this).attr('action'),
            type: 'POST',
            enctype: 'multipart/form-data',
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend:function(){
                $('.processing').fadeIn();
            },
            success: function(response){
                if(response.status == 'errors')
                {   
                    printErrorMsg(response.error);
                }
                else if(response.status == 'exception')
                {
                    $.notify(response.message, response.type);
                }
                else if(response.status == true)
                {
                    form[0].reset();
                    //$('.alert_success_message_div').show();
                    //$('.success_message_text').text(response.message);
                    $.notify(response.message, response.type);
                    //$('#addProductModal').html(response).modal('hide');
                    setTimeout(function(){
                        $('#addProductModal').modal('hide');//hide modal
                        productList();
                        //window.location = redirectUrl;
                    },1000);
                    
                    /*setTimeout(function () {
                        window.location = redirectUrl;
                    }, 1000);*/
                }
            },
            complete:function(){
                $('.processing').fadeOut();
            },
        });
        //end ajax

        function printErrorMsg(msg) {
            $('.color-red').css({'color':'red'});
            $.each(msg, function(key, value ) {
                $('.'+key+'_err').text(value);
            });
        }
    });





    

    //from product create page. prices field
    /*
        // price from create_form_data and index js
        <div class="form-group col-md-3">
            <label class="form-label">Purchase Price</label>
            <input type="text" class="form-control purchase_price purchase_price_0"  data-purchase_price="0" name="purchase_price_0"   placeholder="Purchase Price" style="background-color:#ebd354;color:#161603;font-weight:900;" />
            <div class="clearfix"></div>
        </div>
        <div class="form-group col-md-2">
            <label class="form-label">MRP Price</label>
            <input type="text" class="form-control mrp_price mrp_price_0"  data-mrp_price="0" name="mrp_price_0"  placeholder="MRP Price" style="background-color: black;color:yellow;font-weight:900;" />
            <div class="clearfix"></div>
        </div>
        <div class="form-group col-md-3">
            <label class="form-label">Whole Sell Price</label>
            <input type="text" class="form-control whole_sell_price whole_sell_price_0"  data-whole_sell_price="0" name="whole_sell_price_0"  placeholder="Whole Sell Price" style="background-color: #f17777;color:midnightblue;font-weight:900;" />
            <div class="clearfix"></div>
        </div>
        <div class="form-group col-md-2">
            <label class="form-label">Sell Price</label>
            <input type="text" class="form-control sell_price sell_price_0"  data-sell_price="0" name="sell_price_0"  placeholder="Sell Price" style="background-color: aliceblue;color:blue;font-weight:900;" />
            <div class="clearfix"></div>
        </div>
        <div class="form-group col-md-2">
            <label class="form-label">Offer Price</label>
            <input type="text" class="form-control offer_price offer_price_0"  data-offer_price="0" name="offer_price_0"  placeholder="Offer Price" style="background-color: #044176;color:#f5f5f9;font-weight:900;" />
            <div class="clearfix"></div>
        </div>


        <div class="form-group col-md-3">
        <label class="form-label">Purchase Price</label>
            <input type="text" class="form-control purchase_price purchase_price_${uniqueId}"  data-purchase_price="${uniqueId}" name="purchase_price_${uniqueId}"   placeholder="Purchase Price" style="background-color:#ebd354;color:#161603;font-weight:900;" />
            <div class="clearfix"></div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group col-md-2">
            <label class="form-label">MRP Price</label>
            <input type="text" class="form-control mrp_price mrp_price_${uniqueId}"  data-mrp_price="${uniqueId}" name="mrp_price_${uniqueId}"  placeholder="MRP Price" style="background-color: black;color:yellow;font-weight:900;" />
            <div class="clearfix"></div>
        </div>
        <div class="form-group col-md-3">
            <label class="form-label">Whole Sell Price</label>
            <input type="text" class="form-control whole_sell_price whole_sell_price_${uniqueId}"  data-whole_sell_price="${uniqueId}" name="whole_sell_price_${uniqueId}"  placeholder="Whole Sell Price" style="background-color: #f17777;color:midnightblue;font-weight:900;" />
            <div class="clearfix"></div>
        </div>
        <div class="form-group col-md-2">
            <label class="form-label">Sell Price</label>
            <input type="text" class="form-control sell_price sell_price_${uniqueId}"  data-sell_price="${uniqueId}" name="sell_price_${uniqueId}"  placeholder="Sell Price" style="background-color: aliceblue;color:blue;font-weight:900;" />
            <div class="clearfix"></div>
        </div>
        <div class="form-group col-md-2">
            <label class="form-label">Offer Price</label>
            <input type="text" class="form-control offer_price offer_price_${uniqueId}"  data-offer_price="${uniqueId}" name="offer_price_${uniqueId}"  placeholder="Offer Price" style="background-color: #044176;color:#f5f5f9;font-weight:900;" />
            <div class="clearfix"></div>
        </div>
    */