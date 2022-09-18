/*
|--------------------------------------------------------
| input field protected .. only for numeric
|--------------------------------------------------------
*/
    jQuery(document).on('keyup keypress','.inputFieldValidatedOnlyNumeric',function(e){
        if (String.fromCharCode(e.keyCode).match(/[^0-9\.]/g)) return false;
    });


//-----------------------------------------------------------------------------------------
    jQuery(document).on('click','.productDetails',function(e){
        e.preventDefault();
        var url = jQuery('.showProductDetailsModalRoute').val();
        var id = jQuery(this).data('id');
        jQuery.ajax({
            url:url,
            data:{id:id},
            success:function(response){
                if(response.status == true)
                {
                    jQuery('#showProductDetailModal').html(response.data).modal('show');
                    setPreviousAllPrice();
                }
            }
        });
    });

    function setPreviousAllPrice(){
        jQuery('.price_set_common_class').each(function() {
            var price_id = jQuery(this).data('price_id');
            var stock_id = jQuery(this).data('stock_id');
            jQuery('.purchasing_qty').val(0);
            jQuery('.instant_receiving_qty').val(0);
            jQuery('.calculation_line_subtotal_price').val(0);
            jQuery('.stock_price_id_'+stock_id+"_"+price_id).val(jQuery(this).data('previous_price'));
        });
    }

    jQuery('#showProductDetailModal').css('overflow-y', 'auto');

    jQuery(document).on("submit",'.updateAllProductPrice',function(e){
        e.preventDefault();
        var form = jQuery(this);
        var url = form.attr("action");
        var type = form.attr("method");
        var data = form.serialize();
        jQuery('.color-red').text('');
        jQuery.ajax({
            url: url,
            data: data,
            type: type,
            datatype:"JSON",
            beforeSend:function(){
                jQuery('.processing').fadeIn();
            },
            success: function(response){
                if(response.status == true)
                {
                    jQuery.notify(response.message, response.type);
                    form[0].reset();
                    setTimeout(function(){
                        productList();
                        jQuery('#editProductPriceModal').modal('hide');//hide modal
                    },1000);
                }
            },
            complete:function(){
                jQuery('.processing').fadeOut();
            },
        });
        //end ajax
    });
  //-----------------------------------------------------------------------------------------
  
   

  

    /*
    |------------------------------------------------------------------------------------------
    | Update mrp, whole sale, online price modal and set price Current Value of Pruchase Cart
    |-----------------------------------------------------------------------------------
    */
    


    jQuery(document).on('click','.calculation_price',function(){
        var stock_id = jQuery(this).data('stock_id');
        var price_id = jQuery(this).data('price_id');
        var stock_name = jQuery(this).data('stock_name');
        var purchasing_qty = jQuery('.purchasing_qty_'+stock_id).val();

        //var purchase_id = jQuery('.purchase_price_id').val();
        //var offer_purchase_id = jQuery('.offer_purchase_price_id').val();

        var mrp_price_id = jQuery('.mrp_purchase_sell_id').val();
        var mrp_price = nanCheck(parseFloat(jQuery('.stock_price_id_'+stock_id+"_"+mrp_price_id).val()));

        var previousAction = 0;
        //default all is unchecked and stop calculation
        jQuery(".calculation_price").each(function ()
        {
            var previousStockId  = jQuery(this).data('stock_id');
            if(previousStockId != stock_id)
            {
                allFieldEmptyWhenCloseCalculationByCalculator();
                previousAction = 1;
                jQuery('.calculation_price_'+previousStockId).prop('checked', false).change();
            }
        });
        jQuery('.currentChangingStockId').val('');
        jQuery('.currentChangingStockName').text('');
        if(previousAction == 0){
            jQuery('.calculation_calculator').hide(300);
            jQuery('.default_calculation_part_div').show(300);
        }

        if (this.checked == false)
        {
            allFieldEmptyWhenCloseCalculationByCalculator();
            jQuery('.currentChangingStockId').val('');
            jQuery('.currentChangingStockName').text('');
            jQuery('.calculation_calculator').hide(300);
            jQuery('.default_calculation_part_div').show(300);
            jQuery('.reset_mrp_price').val('');
        }
        else
        {
            jQuery('.reset_mrp_price').val(mrp_price);
            jQuery('.currentChangingStockId').val(stock_id);
            jQuery('.currentChangingStockName').text(stock_name);
            jQuery('.calculation_calculator').show(300);
            jQuery('.default_calculation_part_div').hide(300);
        }
    });
   

    function seperateAmountByCalculationType(changeType,mrp,priceType,amount)
    {
        var cal_amount    = 0;
        var finalResult   = 0;
        if(priceType == 'reset') // set , reset
        {
            cal_amount = mrp - amount;
        }else{
            cal_amount = amount;
        }
        if(changeType == 1)//percent
        {
            if(priceType == 'reset') // set , reset
            {
                finalResult = ((cal_amount / mrp) * 100).toFixed(2) ;
            }else{
                finalResult = ((cal_amount * mrp ) / 100).toFixed(2) ;
            }
        }else{
            finalResult = cal_amount;
        }
        return finalResult;
    }

     /**calculation when keyup or change press */
    jQuery(document).on('change keyup','.keyup_change_from_calculator',function(e){
        e.preventDefault();
        var action = 0;
        if(jQuery(e.target).prop("name") == "calculation_by_mrp_price" && ((e.type)=='keyup'))
        {
            action = 1;
        }
        else if(jQuery(e.target).prop("name") == "calculation_by_price" && ((e.type)=='keyup'))
        {
            action = 1;
        } 
        else if(jQuery(e.target).prop("name") == "calculation_by_change_type" && ((e.type)=='change'))
        {
            action = 1;
        } 
        else if(jQuery(e.target).prop("name") == "calculation_by_calculation_type" && ((e.type)=='change'))
        {
            action = 1;
        }  
        else{
            action = 0;
        }
        if(jQuery(e.target).prop("name") == "calculation_by_mrp_price" && ((e.type)=='keyup'))
        {
            jQuery('.change_price_by_mrp').each(function() {
                setAndResetAllPriceAfterKeyupChanges(jQuery(this).data('id'));
            });
        }
        else{
            if(action == 0) return;
        }
        var data_id    = jQuery(this).data('id');
        setAndResetAllPriceAfterKeyupChanges(data_id);
    });

    function setAndResetAllPriceAfterKeyupChanges(data_id)
    {
        var mrp_price  = nanCheck(parseFloat(jQuery('.reset_mrp_price').val()));
        var changeType  =  jQuery("option:selected", jQuery(".change_type_set_"+data_id)).val();
        var calType     =  jQuery("option:selected", jQuery(".calculation_type_set_"+data_id)).val();
        var setAmount   =  nanCheck(parseFloat(jQuery(".set_price_as_"+data_id).val()));

        var priceType = 'set';

        var resetAmount = nanCheck(parseFloat(seperateAmountByCalculationType(changeType,mrp_price,priceType,setAmount)));
        var final_result = 0;
        if(calType == 1)
        {
            final_result = mrp_price + resetAmount;
        }else{
            final_result = mrp_price - resetAmount;
        }
        jQuery(".set_price_after_calculation_"+data_id).val(final_result.toFixed(2));
    }

    jQuery(document).on('click','.reset_all_price_on_calculator',function(){
        allFieldEmptyWhenCloseCalculationByCalculator();
    });
    function allFieldEmptyWhenCloseCalculationByCalculator()
    {
        jQuery('.makeEmptyField').val('');
        jQuery('.currentChangingStockId').val('');
        jQuery('.currentChangingStockName').text('');
        jQuery('.reset_mrp_price').val('');
    }


    //calculation when keyup or change press//
    jQuery(document).on('click','.set_all_price_after_calculation',function(){
        var mrp_price  = nanCheck(parseFloat(jQuery('.reset_mrp_price').val()));
        jQuery(".set_price_after_calculation").each(function ()
        {
            //var purchase_id = jQuery('.purchase_price_id').val();
            //var offer_purchase_id = jQuery('.offer_purchase_price_id').val();
            var mrp_price_id = jQuery('.mrp_purchase_sell_id').val();
            var price  = jQuery(this).val();
            var price_id  = jQuery(this).data('id');
            var stock_id  = jQuery('.currentChangingStockId').val();
            jQuery('.stock_price_id_'+stock_id+"_"+price_id).val(price);
            jQuery('.stock_price_id_'+stock_id+"_"+mrp_price_id).val(mrp_price);
        });
    });
    

    jQuery(document).on('click','.purchase_qty_check',function(){
        var stock_id = jQuery(this).data('stock_id');
        var purchasing_qty = nanCheck(parseFloat(jQuery('.purchasing_qty_'+stock_id).val()));

        var previousAction = 0;
        //default all is unchecked and stop calculation
        jQuery(".purchase_qty_check").each(function ()
        {
            var previousStockId  = jQuery(this).data('stock_id');
            if(previousStockId != stock_id)
            {
                jQuery('.calculation_line_subtotal_price_'+previousStockId).val(0);
                jQuery('.purchasing_qty_'+previousStockId).val(0);
                jQuery('.instant_receiving_qty_'+previousStockId).val(0);
                previousAction = 1;
                jQuery('.purchase_qty_check_'+previousStockId).prop('checked', false).change();
            }
        });

        if (this.checked == false)
        {
            jQuery('.purchase_qty_check_'+stock_id).prop('checked', false).change();
            jQuery('.purchasing_qty_'+stock_id).val(0);
            jQuery('.instant_receiving_qty_'+stock_id).val(0);
            jQuery('.calculation_line_subtotal_price_'+stock_id).val(0);
        }
        else
        {
            if(purchasing_qty > 0)
            {
                jQuery('.purchase_qty_check_'+stock_id).prop('checked', true).change();
            }else{
                jQuery('.purchase_qty_check_'+stock_id).prop('checked', false).change(); 
                jQuery('.calculation_line_subtotal_price_'+stock_id).val(0);
                jQuery('.instant_receiving_qty_'+stock_id).val(0);
            }
        }
    });

    jQuery(document).on('keyup','.purchasing_qty,.stock_price_id',function(){
        var stock_id = jQuery(this).data('stock_id');
        var purchasing_qty = nanCheck(parseFloat(jQuery('.purchasing_qty_'+stock_id).val()));
        
        jQuery(".purchase_qty_check").each(function ()
        {
            var previousStockId  = jQuery(this).data('stock_id');
            if(previousStockId != stock_id)
            {
                jQuery('.calculation_line_subtotal_price_'+previousStockId).val(0);
                jQuery('.instant_receiving_qty_'+previousStockId).val(0);
                jQuery('.purchasing_qty_'+previousStockId).val(0);
                jQuery('.purchase_qty_check_'+previousStockId).prop('checked', false).change();
            }
        });

        if(purchasing_qty > 0)
        {
            jQuery('.purchase_qty_check_'+stock_id).prop("checked", true).change();
        }else{
            jQuery('.purchase_qty_check_'+stock_id).prop('checked', false).change(); 
            jQuery('.calculation_line_subtotal_price_'+stock_id).val(0);
        }

        //var purchase_id = jQuery('.purchase_price_id').val();
        //var mrp_price_id = jQuery('.mrp_purchase_sell_id').val();
        //var offer_purchase_price_id = jQuery('.offer_purchase_price_id').val();

        var purchase_or_offer_purchase_price_id = jQuery('.purchaseLineTotalSubtotalWhenCartCreateAndShowCartList').val();
         
        var offer_purchase_price = nanCheck(parseFloat(jQuery('.stock_price_id_'+stock_id+"_"+purchase_or_offer_purchase_price_id).val()));
        var line_subtotal_price = offer_purchase_price * purchasing_qty;
        jQuery('.calculation_line_subtotal_price_'+stock_id).val(line_subtotal_price);
    });

    jQuery(document).on('keyup','.purchasing_qty,.instant_receiving_qty',function(){
        var stock_id = jQuery(this).data('stock_id');
        var purchasing_qty = nanCheck(parseFloat(jQuery('.purchasing_qty_'+stock_id).val()));
        var receiving_qty = nanCheck(parseFloat(jQuery('.instant_receiving_qty_'+stock_id).val()));
        var instantlyQty = 0;
        if(purchasing_qty > 0)
        {   
            if(purchasing_qty > receiving_qty)
            {
                instantlyQty = receiving_qty;
            }
            else if(purchasing_qty == receiving_qty)
            {
                instantlyQty = receiving_qty;
            }
            else if(purchasing_qty < receiving_qty)
            {
                instantlyQty = purchasing_qty;
            }
            else{
                instantlyQty = 0;
            }
        }else{
            instantlyQty = 0; 
        }
        jQuery('.instant_receiving_qty_'+stock_id).val(instantlyQty)
    });


    /**update value in  the cart */
   /*  jQuery(document).on('click','.updateResultCalculationModel',function(){
        var id                  = jQuery('.product_id').val();

        var mrp_price           = jQuery('.reset_mrp_price').val();
        var regular_price       = jQuery('.reset_regular_sale_price').val();
        var whole_sale_price    = jQuery('.reset_whole_sale_price').val();
        var online_sale_price   = jQuery('.reset_online_sale_price').val();


        var purchaePrice    = jQuery('#purchase_unit_price_before_tax_id_'+id).val();
        var profit          = regular_price - purchaePrice ;
        var profitMargin    = ((profit / purchaePrice) * 100).toFixed(2) ;

        jQuery('#unit_selling_price_inc_tax_id_'+id).val(regular_price);
        jQuery('#profit_margin_parcent_id_'+id).val(profitMargin);
        jQuery('#whole_sale_price_'+id).val(whole_sale_price);
        jQuery('#mrp_price_'+id).val(mrp_price);
        jQuery('#online_sale_price_'+id).val(online_sale_price);

        updateCurrentValueOfCart(id);

        allFieldEmptyWhenCloseCalculationByCalculator();
        jQuery('#baseOnMrpPriceModal').modal('hide');
    }); */
    /**update value in  the cart */
/*
|------------------------------------------------------------------------------------------
| Update mrp, whole sale, online price modal and set price Current Value of Pruchase Cart
|-----------------------------------------------------------------------------------
*/



    /*
    |-----------------------------------------------------------------
    | Nan Check
    |-------------------------------------------------------------
    */
        function nanCheck(val)
        {
            var nanResult = 0;
            if(isNaN(val)) {
                nanResult = 0;
            }
            else{
                nanResult = val;
            }
            return nanResult;
        }
    /*
    |-----------------------------------------------------------------
    | Nan Check
    |-------------------------------------------------------------
    */

    /*
    |----------------------------------------------------------------
    | display single product details for showing and adding to cart
    |----------------------------------------------------------------
    */
        /* jQuery(document).on('click','.productDetails',function(e){
            e.preventDefault();
            var url = jQuery('.showProductDetailsModalRoute').val();
            var id  = jQuery(this).data('id');
            jQuery.ajax({
                url:url,
                data:{id:id},
                beforeSend:function(){
                    jQuery('.processing_on').fadeIn();
                },
                success:function(response){
                    if(response.status == true)
                    {
                        jQuery('#showProductDetailModal').html(response.html).modal('show');
                        jQuery('.display-product-stock-with-price-section').html(response.stock);
                        defaultSelectedProductStockSellingPriceAndQuantityCalculation();
                    }
                },
                complete:function(){
                    jQuery('.processing_on').fadeOut();
                },
            });
        }); */
    /*
    |----------------------------------------------------------------
    | display single product details for showing and adding to cart
    |----------------------------------------------------------------
    */





