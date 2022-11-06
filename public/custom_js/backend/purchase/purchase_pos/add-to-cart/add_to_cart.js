
    jQuery(document).ready(function(){
        displayPurchaseCreateAddedToCartProductList();
    });

    //display sale cart added to cart product list
   function displayPurchaseCreateAddedToCartProductList()
   {
       var url = jQuery('.displayPurchaseCreateAddedToCartProductListUrl').val();
       jQuery.ajax({
           url:url,
           //data:{},
           beforeSend:function(){
               jQuery('.processing').fadeIn();
           },
           success:function(response){
               if(response.status == true)
               {
                   jQuery('.display_added_to_cart_list').html(response.list);
                   finalCalculationForThisInvoice();
               }
           },
           complete:function(){
               jQuery('.processing').fadeOut();
           },
       });
   }


    // add to sale cart [submit]
    jQuery(document).on("submit",'.addToPurchaseCart',function(e){
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
                if(response.status == 'errors')
                {   
                    printErrorMsg(response.error);
                }
                else if(response.status == true)
                {
                    form[0].reset();
                    jQuery('.display_added_to_cart_list').html(response.list);

                    jQuery('#showProductDetailModal').modal('hide');
                    jQuery.notify(response.message, response.type);
                    finalCalculationForThisInvoice();
                }
            },
            complete:function(){
                jQuery('.processing').fadeOut();
            },
        });
        //end ajax

        function printErrorMsg(msg) {
            jQuery('.color-red').css({'color':'red'});
            jQuery.each(msg, function(key, value ) {
                jQuery('.'+key+'_err').text(value);
            });
        }
    });


    
    //remove/delete single item from Purchase cart product list
    jQuery(document).on('click','.remove_this_item_from_purchase_cart_list',function(e){
        e.preventDefault();
        var product_id = jQuery(this).data('product_id');
        var url = jQuery('.removeConfirmationRequiredSingleItemFromPurchaseAddedToCartListUrl').val();
        jQuery.ajax({
            url:url,
            data:{product_id:product_id},
            beforeSend:function(){
                jQuery('.processing').fadeIn();
            },
            success:function(response){
                if(response.status == true)
                {
                    jQuery('#removeSingleItemFromPurchaseAddedToCartModal').html(response.html).modal('show');
                }
            },
            complete:function(){
                jQuery('.processing').fadeOut();
            },
        });
    });  
    jQuery(document).on('click','.removeSingleItemFromPurchaseCartProductList',function(){
        
        var totalCartItem = nanCheck(parseFloat(jQuery('.totalItemFromPurchaseCartList').text()));
    
        var product_id = jQuery('.remove_product_id').val();
        var url = jQuery('.removeSingleItemFromPurchaseAddedToCartListUrl').val();
        jQuery.ajax({
            url:url,
            data:{product_id:product_id},
            beforeSend:function(){
                jQuery('.processing').fadeIn();
            },
            success:function(response){
                if(response.status == true)
                {
                    jQuery('.display_added_to_cart_list').html(response.list);
                    jQuery('#removeSingleItemFromPurchaseAddedToCartModal').modal('hide');
                    jQuery.notify(response.message, response.type);

                    if(totalCartItem == 1)
                    {
                        makingZeroInShippingCostOtherCostDiscountAndVat();
                    }
                    finalCalculationForThisInvoice();
                }
            },
            complete:function(){
                jQuery('.processing').fadeOut();
            },
        });
    });  
    //remove/delete single item from Purchase cart product list

    //remove/delete all item from Purchase cart product list
    jQuery(document).on('click','.removeOrEmptyAllItemFromCreatePurchaseCartList',function(e){
        e.preventDefault();
        var url = jQuery('.removeConfirmationRequiredAllItemFromPurchaseAddedToCartListUrl').val();
        jQuery.ajax({
            url:url,
            //data:{},
            beforeSend:function(){
                jQuery('.processing').fadeIn();
            },
            success:function(response){
                if(response.status == true)
                {
                    jQuery('#removeAllItemFromPurchaseAddedToCartModal').html(response.html).modal('show');
                }
            },
            complete:function(){
                jQuery('.processing').fadeOut();
            },
        });
    });
    jQuery(document).on('click','.removeOrEmptyAllItemFromPurchaseCartProductList',function(){
        var url = jQuery('.removeAllItemFromPurchaseAddedToCartListUrl').val();
        jQuery.ajax({
            url:url,
            //data:{},
            beforeSend:function(){
                jQuery('.processing').fadeIn();
            },
            success:function(response){
                jQuery('#removeAllItemFromPurchaseAddedToCartModal').modal('hide');
                jQuery('.display_added_to_cart_list').html(response.list);
                jQuery.notify(response.message, response.type);

                makingZeroInShippingCostOtherCostDiscountAndVat();

                finalCalculationForThisInvoice();
            },
            complete:function(){
                jQuery('#removeAllItemFromPurchaseAddedToCartModal').modal('hide');
                jQuery('.processing').fadeOut();
            },
        });
    });
    jQuery(document).on('click','.cancelRemoveAllItemFromSaleCart',function(){
        jQuery('#removeAllItemFromPurchaseAddedToCartModal').modal('hide');
    });
    //remove/delete all item from Purchase cart product list



    //change quantity from added to cart list [plus or minus]
    jQuery(document).on('click','.quantityChange',function(e){
        e.preventDefault();
        var product_id  = jQuery(this).data('product_id');
        var change_type = jQuery(this).data('change_type');
        var quantity    = jQuery(this).data('quantity');
        var url = jQuery('.changeQuantityFromPurchaseAddedToCartListUrl').val();
        jQuery.ajax({
            url:url,
            data:{product_id:product_id,change_type:change_type,quantity:quantity},
            beforeSend:function(){
                jQuery('.processing').fadeIn();
            },
            success:function(response){
                if(response.status == true)
                {
                    jQuery('.display_added_to_cart_list').html(response.list);
                    jQuery('#removeAllItemFromPurchaseAddedToCartModal').modal('hide');
                    jQuery.notify(response.message, response.type);
                }
                finalCalculationForThisInvoice();
            },
            complete:function(){
                jQuery('.processing').fadeOut();
            },
        });
    });
    //change quantity from added to cart list [plus or minus]



    //final calculation for this invoice
    function finalCalculationForThisInvoice()
    {
        totalItemFromCartList();
        var subtotal = subtotalFromCartList();
        totalPurchasePriceForThisInvoiceFromCartList();
        makingDiscountVatShippingCostOtherCost();
        var totalInvoiceDiscount                = (nanCheck(parseFloat(jQuery('.invoiceFinalTotalDiscountAmount').text())));
        var invoiceFinalTotalVatAmount          = (nanCheck(parseFloat(jQuery('.invoiceFinalTotalVatAmount').text())));
        var invoiceFinalTotalOtherCostAmount    = (nanCheck(parseFloat(jQuery('.invoiceFinalTotalOtherCostAmount').text())));
        var invoiceFinalShippingCostAmount      = (nanCheck(parseFloat(jQuery('.invoiceFinalShippingCostAmount').text())));
          
        var netInvoiceTotalAmount               = (((subtotal - totalInvoiceDiscount)+invoiceFinalTotalVatAmount+invoiceFinalTotalOtherCostAmount+invoiceFinalShippingCostAmount).toFixed(2));
        jQuery('.netPayableInvoiceTotal').text(netInvoiceTotalAmount);
    }

    //subtotal from cart list
    function subtotalFromCartList()
    {
        var subtotalFromCartList = 0;
        jQuery(".purchase_final_subtotal_amount_from_cartlist").each(function() {
            subtotalFromCartList += nanCheck(parseFloat(jQuery(this).val()));
        });
        subtotalFromCartList = ((subtotalFromCartList).toFixed(2));
        jQuery('.subtotalFromPurchaseCartList').text(subtotalFromCartList);
        jQuery('.subtotalFromPurchaseCartListValue').val(subtotalFromCartList);
        return subtotalFromCartList;
    } 

    //total purchase price for this invoice from cart list
    function totalPurchasePriceForThisInvoiceFromCartList()
    {
        var totalPurchasePriceFromCartList = 0;
        jQuery(".total_purchase_price_of_all_quantity_from_cartlist").each(function() {
            totalPurchasePriceFromCartList += nanCheck(parseFloat(jQuery(this).val()));
        });
        jQuery('.totalPurchasePriceForThisInvoiceFromPurchaseCartList').val(totalPurchasePriceFromCartList);
        return totalPurchasePriceFromCartList;
    } 

    //total item from cart list
    function totalItemFromCartList()
    {
       var totalItme = (nanCheck(parseFloat(jQuery(".total_item_from_cartlist").val())).toFixed(2));
       jQuery('.totalItemFromPurchaseCartList').text(totalItme);
       return totalItme;
    }

    //total quantity from cart list
    function totalQuantityFromCartList()
    {
        var totalQuantityFromCartList = 0;
        jQuery(".total_cart_quantity").each(function() {
            totalQuantityFromCartList += nanCheck(parseFloat(jQuery(this).text()));
        });
        totalQuantityFromCartList = ((totalQuantityFromCartList).toFixed(2));

        
        /* if(totalQuantityFromCartList > 0)
        {
            jQuery('.paymentQuotationButtonWhenCartItemZero').hide();
            jQuery('.paymentQuotationButtonWhenCartItemMoreThenZero').show();
        }else{
            jQuery('.paymentQuotationButtonWhenCartItemZero').show();
            jQuery('.paymentQuotationButtonWhenCartItemMoreThenZero').hide();   
        } */
        return totalQuantityFromCartList;
    }


    //invoice discount related part
    var ctrlDown = false,ctrlKey = 17,cmdKey = 91,vKey = 86,cKey = 67; xKey = 88;
    jQuery(document).on('keyup blur change','.invoice_discount_amount ,.invoice_discount_type',function(e){
        e.preventDefault();
        var action = 0;
        if(jQuery(e.target).prop("name") == "invoice_discount_amount" && ((e.type)=='keyup'))
        {
            action = 1;
        } 
        else if(jQuery(e.target).prop("name") == "invoice_discount_amount" && ((e.type)=='blur' || (e.type)=='focusout'))
        {
            action = 1;
        } 
        else if(jQuery(e.target).prop("name") == "invoice_discount_type" && ((e.type)=='change'))
        {
            action = 1;
        }
        else{
            action = 0;
        }
        if(action == 0) return;
        if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
        if (ctrlDown && ( e.keyCode == vKey || e.keyCode == cKey || e.keyCode == xKey)) return false;

        makingDiscountVatShippingCostOtherCost();
        finalCalculationForThisInvoice();
    });
    jQuery(document).on('click','.invoiceDiscountApplyModal',function(){
        makingDiscountVatShippingCostOtherCost();
    });  
    jQuery(document).on('click','.invoice_discount_apply',function(){
        makingDiscountVatShippingCostOtherCost();
        finalCalculationForThisInvoice();
        jQuery('#discountPopUpModal').modal('hide');
    });
    //end invoice discount related part


    //vat section start
    var ctrlDown = false,ctrlKey = 17,cmdKey = 91,vKey = 86,cKey = 67; xKey = 88;
    jQuery(document).on('keyup blur','.invoice_vat_amount',function(e){
        e.preventDefault();
        var action = 0;
        if(jQuery(e.target).prop("name") == "invoice_vat_amount" && ((e.type)=='keyup'))
        {
            action = 1;
        } 
        else if(jQuery(e.target).prop("name") == "invoice_vat_amount" && ((e.type)=='blur' || (e.type)=='focusout'))
        {
            action = 1;
        } 
        else{
            action = 0;
        }
        if(action == 0) return;
        if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
        if (ctrlDown && ( e.keyCode == vKey || e.keyCode == cKey || e.keyCode == xKey)) return false;
        makingDiscountVatShippingCostOtherCost();
        finalCalculationForThisInvoice();
    });
    jQuery(document).on('click','.invoiceVatApplyModal',function(){
        makingDiscountVatShippingCostOtherCost();
    });  
    jQuery(document).on('click','.invoice_vat_apply',function(){
        makingDiscountVatShippingCostOtherCost();
        finalCalculationForThisInvoice();
        jQuery('#vatPopUpModal').modal('hide');
    });
    //End vat section

    //other cost section start
    var ctrlDown = false,ctrlKey = 17,cmdKey = 91,vKey = 86,cKey = 67; xKey = 88;
    jQuery(document).on('keyup blur','.invoice_other_cost_amount',function(e){
        e.preventDefault();
        var action = 0;
        if(jQuery(e.target).prop("name") == "invoice_other_cost_amount" && ((e.type)=='keyup'))
        {
            action = 1;
        } 
        else if(jQuery(e.target).prop("name") == "invoice_other_cost_amount" && ((e.type)=='blur' || (e.type)=='focusout'))
        {
            action = 1;
        } 
        else{
            action = 0;
        }
        if(action == 0) return;
        if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
        if (ctrlDown && ( e.keyCode == vKey || e.keyCode == cKey || e.keyCode == xKey)) return false;
        makingDiscountVatShippingCostOtherCost();
        finalCalculationForThisInvoice();
    });
    jQuery(document).on('click','.invoiceOtherCostApplyModal',function(){
        makingDiscountVatShippingCostOtherCost();
    });  
    jQuery(document).on('click','.invoice_other_cost_apply',function(){
        makingDiscountVatShippingCostOtherCost();
        finalCalculationForThisInvoice();
        jQuery('#otherCostPopUpModal').modal('hide');
    });
    //End other cost section


    //other cost section start
    var ctrlDown = false,ctrlKey = 17,cmdKey = 91,vKey = 86,cKey = 67; xKey = 88;
    jQuery(document).on('keyup blur','.invoice_shipping_cost',function(e){
        e.preventDefault();
        var action = 0;
        if(jQuery(e.target).prop("name") == "invoice_shipping_cost" && ((e.type)=='keyup'))
        {
            action = 1;
        } 
        else if(jQuery(e.target).prop("name") == "invoice_shipping_cost" && ((e.type)=='blur' || (e.type)=='focusout'))
        {
            action = 1;
        } 
        else{
            action = 0;
        }
        if(action == 0) return;
        if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
        if (ctrlDown && ( e.keyCode == vKey || e.keyCode == cKey || e.keyCode == xKey)) return false;
        makingDiscountVatShippingCostOtherCost();
        finalCalculationForThisInvoice();
    });
    jQuery(document).on('click','.invoiceShippingCostApplyModal',function(){
        makingDiscountVatShippingCostOtherCost();
    });  
    jQuery(document).on('click','.invoice_shipping_cost_apply',function(){
        makingDiscountVatShippingCostOtherCost();
        finalCalculationForThisInvoice();
        jQuery('#otherCostPopUpModal').modal('hide');
    });
    //End other cost section



    //making invoice discount, vat, shipping cost, other cost..
    function makingDiscountVatShippingCostOtherCost()
    {
       //--------------discount making-----------------//
        var invoiceDiscountAmount               = jQuery('.invoice_discount_amount').val();
        var invoiceDiscountType                 = jQuery('.invoice_discount_type option:selected').val();
        var subtotalFromPurchaseCartList            = nanCheck(parseFloat(jQuery('.subtotalFromPurchaseCartListValue').val())); 
        var totalPurchasePriceForThisInvoice    = nanCheck(parseFloat(jQuery('.totalPurchasePriceForThisInvoiceFromPurchaseCartList').val())); 
        var totalInvoiceDiscountAmount  = 0; 
        if(invoiceDiscountType == 'fixed'){
            totalInvoiceDiscountAmount  = invoiceDiscountAmount;
        }
        else if(invoiceDiscountType == 'percentage'){
            totalInvoiceDiscountAmount = ((((invoiceDiscountAmount * subtotalFromPurchaseCartList) / 100)).toFixed(2));
        }else{
            totalInvoiceDiscountAmount  = 0; 
        }
        jQuery('.invoice_total_discount_amount').css({'color':'black','background-color':'white','padding':'0px 30%'});
        jQuery('.invoice_discount_amount_error_message').text('');
        if((subtotalFromPurchaseCartList - totalInvoiceDiscountAmount) < totalPurchasePriceForThisInvoice)
        {
            jQuery('.invoice_discount_amount_error_message').text('-Not Allowed');
            jQuery('.invoice_total_discount_amount').css({'color':'white','background-color':'red','padding':'0px 30%'});
            totalInvoiceDiscountAmount  = 0; 
        }else{
            totalInvoiceDiscountAmount  = totalInvoiceDiscountAmount; 
            jQuery('.invoice_discount_amount_error_message').text('');
            jQuery('.invoice_total_discount_amount').css({'color':'black','background-color':'white','padding':'0px 30%'});
        }
        totalInvoiceDiscountAmount  = (nanCheck(parseFloat(totalInvoiceDiscountAmount)).toFixed(2)); 
        var invoiceSubtotalAfterDiscount = (nanCheck(parseFloat((subtotalFromPurchaseCartList - totalInvoiceDiscountAmount))).toFixed(2));
        var totalInvoiceProfit           = (nanCheck(parseFloat((invoiceSubtotalAfterDiscount - totalPurchasePriceForThisInvoice))).toFixed(2));
        jQuery('.invoice_total_discount_amount').text(totalInvoiceDiscountAmount);
        //jQuery('.totalInvoiceProfit').text(totalInvoiceProfit);
        jQuery('.invoice_subtotal_after_discount').text(invoiceSubtotalAfterDiscount);

        //..........set invoice discount .........//
        var setInvoiceDiscountType   = ""; 
        var setInvoiceDiscountAmount = 0; 
        if(invoiceDiscountType == 'fixed'){
            setInvoiceDiscountType      = "";
            setInvoiceDiscountAmount    = invoiceDiscountAmount; 
        }
        else if(invoiceDiscountType == 'percentage'){
            setInvoiceDiscountType      = "%";
            setInvoiceDiscountAmount    = invoiceDiscountAmount; 
        }else{
            setInvoiceDiscountType      = ""; 
            setInvoiceDiscountAmount    = 0; 
        }
        jQuery('.invoiceDiscountAmount').text(setInvoiceDiscountAmount);
        jQuery('.invoiceDiscountType').text(setInvoiceDiscountType);
        jQuery('.invoiceFinalTotalDiscountAmount').text(totalInvoiceDiscountAmount); 
        //..........set invoice discount .........// 
        //--------------end discount making-----------------//


        //-------------- Vat making-----------------//
        jQuery('.subtotalAfterDiscountBasedOnPurchaseCartList').text(invoiceSubtotalAfterDiscount);
        var invoiceVatAmount   = jQuery('.invoice_vat_amount').val();
        var totalVatAmountCalculation =  ((((invoiceVatAmount * invoiceSubtotalAfterDiscount) / 100)).toFixed(2));
        //jQuery('.invoice_total_vat_amount').css({'color':'black','background-color':'white','padding':'0px 30%'});
        jQuery('.invoice_total_vat_amount').css({'color':'white','background-color':'red','padding':'0px 30%'});
        jQuery('.invoice_total_vat_amount').text(totalVatAmountCalculation);
        var totalInvoiceSubtotalAfterVat = (nanCheck(parseFloat((invoiceSubtotalAfterDiscount + totalVatAmountCalculation))).toFixed(2));
        jQuery('.invoice_subtotal_after_vat').text(totalInvoiceSubtotalAfterVat);

        //.............vat set...........//
        setInvoiceVatType      = "%";
        jQuery('.invoiceVatAmount').text(invoiceVatAmount);
        jQuery('.invoiceVatType').text(setInvoiceVatType);
        jQuery('.invoiceFinalTotalVatAmount').text(totalVatAmountCalculation);
        //--------------End Vat making-----------------//


        //-------------- shipping cost making-----------------//
        var totalShippingCost = (nanCheck(parseFloat(jQuery('.invoice_shipping_cost').val())));
        //.............shipping cost set...........//
        jQuery('.invoiceFinalShippingCostAmount').text(totalShippingCost);
        //--------------End shipping cost making-----------------//

        

        //-------------- other cost making-----------------//
        var totalInvoiceAmountAfterDiscountAndVat = totalInvoiceSubtotalAfterVat;
        var totalInvoiceAmountAfterDiscountVatAndShippingCost = (((parseFloat(totalInvoiceAmountAfterDiscountAndVat) + (totalShippingCost))).toFixed(2));
        jQuery('.subtotalBasedOnPurchaseCartDiscountVatAndShippingCost').text(totalInvoiceAmountAfterDiscountVatAndShippingCost);
        var invoiceOtherCostAmount   = (nanCheck(parseFloat(jQuery('.invoice_other_cost_amount').val())));
        
        var totalInvoiceAmountAfterDiscountVatAndShippingCostAndOtherCost =  (parseFloat( (parseFloat(totalInvoiceAmountAfterDiscountAndVat) + (totalShippingCost)) + (invoiceOtherCostAmount) ).toFixed(2));
       
        jQuery('.invoice_total_other_cost_amount').css({'color':'black','background-color':'white','padding':'0px 30%'});
        jQuery('.invoice_total_other_cost_amount').text(invoiceOtherCostAmount);

        jQuery('.invoice_subtotal_after_other_cost').text(totalInvoiceAmountAfterDiscountVatAndShippingCostAndOtherCost);

        //.............other cost set...........//
        jQuery('.invoiceFinalTotalOtherCostAmount').text(invoiceOtherCostAmount);
        //--------------End other cost making-----------------//

        setTimeout(function() 
        {   
            invoiceFinalPurchaseCalculationSummeryProcessingInTheSession();
        },2000);

    }

    //making invoice zero in  discount, vat, shipping cost, other cost..
    function makingZeroInShippingCostOtherCostDiscountAndVat()
    {
        nanCheck(parseFloat(jQuery('.invoice_shipping_cost').val(0.00)));
        nanCheck(parseFloat(jQuery('.invoice_other_cost_amount').val(0.00)));

        nanCheck(parseFloat(jQuery('.invoice_discount_amount').val(0.00)));                
        nanCheck(parseFloat(jQuery('.invoice_vat_amount').val(0.00)));                
    }


    //invoice final Purchase calculation summery processing in the session.
    function invoiceFinalPurchaseCalculationSummeryProcessingInTheSession()
    {
        var supplier_id = jQuery('.supplier_id option:selected').val();
       
        var invoiceDiscountAmount        = nanCheck(parseFloat(jQuery('.invoice_discount_amount').val()));
        var invoiceDiscountType          = jQuery('.invoice_discount_type option:selected').val();
        var subtotalFromPurchaseCartList = nanCheck(parseFloat(jQuery('.subtotalFromPurchaseCartListValue').val()));
        
        var invoiceVatAmount = nanCheck(parseFloat(jQuery('.invoiceVatAmount').text()));
        //jQuery('.invoiceVatType').text();
        var totalVatAmountCalculation = nanCheck(parseFloat(jQuery('.invoiceFinalTotalVatAmount').text()));

        var totalInvoiceDiscountAmount = nanCheck(parseFloat(jQuery('.invoiceFinalTotalDiscountAmount').text())); 

        var totalShippingCost = nanCheck(parseFloat(jQuery('.invoice_shipping_cost').val()));
        //.............shipping cost set...........//
        //jQuery('.invoiceFinalShippingCostAmount').text(totalShippingCost);
        var invoiceOtherCostAmount   = nanCheck(parseFloat(jQuery('.invoice_other_cost_amount').val()));
        //jQuery('.invoiceFinalTotalOtherCostAmount').text(invoiceOtherCostAmount);

        var totalItem = nanCheck(parseFloat(jQuery('.totalItemFromPurchaseCartList').text()));
        var totalQuantity = totalQuantityFromCartList();
        var totalInvoicePayableAmount = nanCheck(parseFloat(jQuery('.netPayableInvoiceTotal').text()));

        var url = jQuery('.invoiceFinalPurchaseCalculationSummeryUrl').val();
        jQuery.ajax({
            url:url,
            data:{subtotalFromPurchaseCartList:subtotalFromPurchaseCartList,totalItem:totalItem,totalQuantity:totalQuantity,
                invoiceDiscountAmount:invoiceDiscountAmount,invoiceDiscountType:invoiceDiscountType,
                totalInvoiceDiscountAmount:totalInvoiceDiscountAmount,invoiceVatAmount:invoiceVatAmount,
                totalVatAmountCalculation:totalVatAmountCalculation,totalShippingCost:totalShippingCost,
                invoiceOtherCostAmount:invoiceOtherCostAmount,totalInvoicePayableAmount:totalInvoicePayableAmount,
                supplier_id:supplier_id
            },
            beforeSend:function(){
                jQuery('.processing').fadeIn();
            },
            success:function(response){
                if(response.status == true)
                {
                    finalCalculationForThisInvoice();
                }
            },
            complete:function(){
                jQuery('.processing').fadeOut();
            },
        });
    }




    /* jQuery(document).on('click','.pos_print_direct_from_purchase_cart',function(){
        //var url = jQuery('.pos_print_direct_from_purchase_cart').data('href');
        console.log('yes pos');
    }); 
    jQuery(document).on('click','.normal_print_direct_from_purchase_cart',function(){
        //var url = jQuery('.normal_print_direct_from_purchase_cart').data('href');
        console.log('yes normal');
    }); */


    

    /*
    |-----------------------------------------------
    |shipping address and add new shipping address
    |----------------------------------------------
    */
        jQuery(document).on("submit",'.submitShippingCostAndOtherInformation',function(e){
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
                        jQuery('#shippingCostPopUpModal').modal('hide');
                    }
                },
                complete:function(){
                    jQuery('.processing').fadeOut();
                },
            });
            //end ajax
        });
        //empty all shipping related information
        function makingEmptyshippingRelatedInformation()
        {
            jQuery(':input','#submitShippingCostAndOtherInformation')
            .not(':button, :submit, :reset')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected');
            //jQuery('#myform')[0].reset();
            //document.getElementById("myform").reset();
        }
    /*
    |-----------------------------------------------
    |shipping address and add new shipping address
    |----------------------------------------------
    */
    

    /*
    |-----------------------------------------------
    |payment modal 
    |----------------------------------------------
    */
    jQuery('#payment-popup').css('overflow-y', 'auto');
    jQuery(document).on('click','.paymentModalOpen',function(){
        jQuery('.payment_processing_gif').fadeIn();
        setTimeout(function()
        {
            jQuery('.payment_processing_gif').fadeOut();

            var supplier_id = jQuery('.supplier_id option:selected').val();
            if(!supplier_id){
                jQuery('#payment-popup').modal('hide');
                jQuery.notify("Please select one supplier", 'error');
                return 0;
            }else{
                jQuery('.payment_processing_gif').fadeOut();
                jQuery('#payment-popup').modal('show');
            }
            var url = jQuery('.paymentModalOpenUrl').val();
            jQuery.ajax({
                url:url,
                data:{supplier_id:supplier_id},
                beforeSend:function(){
                    jQuery('.payment_processing_gif').fadeIn();
                },
                success:function(response){
                    if(response.status == true)
                    {
                        jQuery('.payment_data_response').html(response.list);
                        paymentProcessingWithDueFullAmountAndPayingAmountZero();
                    }
                },
                complete:function(){
                    jQuery('.payment_processing_gif').fadeOut();
                },
            });
        },500);
    });
    /*
    |-----------------------------------------------
    |payment modal 
    |----------------------------------------------
    */




    /*
    |-------------------------------------------------------------------------------
    |-----------------------------------------------
    |payment processing all options, functions
    |----------------------------------------------
    */
        //change payment options
        jQuery(document).on('change','.payment_option',function(){
            var payment_id = jQuery('.payment_option option:selected').val();
            if(payment_id)
            {
                //
            }else{
                paymentProcessingWithDueFullAmountAndPayingAmountDisabledAndZero();
                emptyAndHideBankingOptionAllData();

                cashPaymentRemoveAttributeNameAndRequired();
                advancePaymentRemoveAttributeNameAndRequired();
                bankingPaymentRemoveAttributeNameAndRequired();
            }
            if(payment_id == 1) //only cash
            {
                advancePaymentMakingZeroWithHide();
                bankingPaymentMakingZeroWithHide();
                jQuery('.cash_payment_section').show(300);

                emptyAndHideBankingOptionAllData();

                cashPaymentAddAttributeNameAndRequired();//add
                advancePaymentRemoveAttributeNameAndRequired();//remove
                bankingPaymentRemoveAttributeNameAndRequired();//remove
            }
            else if(payment_id == 2) //Only Advance
            {
                cashPaymentMakingZeroWithHide();
                bankingPaymentMakingZeroWithHide();
                jQuery('.advance_payment_section').show(300);
                advanceDifferentPayingAmountOptionMakingDisabledWhenAdvancedZero();
                emptyAndHideBankingOptionAllData();

                advancePaymentAddAttributeNameAndRequired();//add
                cashPaymentRemoveAttributeNameAndRequired();//remove
                bankingPaymentRemoveAttributeNameAndRequired();//remove
            }
            else if(payment_id == 3) //Advance + Cash
            {
                bankingPaymentMakingZeroWithHide();
                jQuery('.cash_payment_section').show(300);
                jQuery('.advance_payment_section').show(300);
                advanceDifferentPayingAmountOptionMakingDisabledWhenAdvancedZero();
                emptyAndHideBankingOptionAllData();

                cashPaymentAddAttributeNameAndRequired();//add
                advancePaymentAddAttributeNameAndRequired();//add
                bankingPaymentRemoveAttributeNameAndRequired();//remove

            }
            else if(payment_id == 4) //Only Banking
            {
                cashPaymentMakingZeroWithHide();
                advancePaymentMakingZeroWithHide();
                jQuery('.banking_payment_section').show(300);

                bankingPaymentAddAttributeNameAndRequired();//add
                cashPaymentRemoveAttributeNameAndRequired();//add
                advancePaymentRemoveAttributeNameAndRequired();//remove
            }
            else if(payment_id == 5) //Banking + Cash
            {
                advancePaymentMakingZeroWithHide();
                jQuery('.banking_payment_section').show(300);
                jQuery('.cash_payment_section').show(300);

                cashPaymentAddAttributeNameAndRequired();//add
                bankingPaymentAddAttributeNameAndRequired();//add
                advancePaymentRemoveAttributeNameAndRequired();//remove
            }
            else if(payment_id == 6) //Banking + Advance
            {
                cashPaymentMakingZeroWithHide();
                jQuery('.banking_payment_section').show(300);
                jQuery('.advance_payment_section').show(300);
                advanceDifferentPayingAmountOptionMakingDisabledWhenAdvancedZero();

                bankingPaymentAddAttributeNameAndRequired();//add
                advancePaymentAddAttributeNameAndRequired();//add
                cashPaymentRemoveAttributeNameAndRequired();//remove
            }
            else if(payment_id == 7) //Banking + Advance + Cash
            {
                jQuery('.cash_payment_section').show(300);
                jQuery('.advance_payment_section').show(300);
                jQuery('.banking_payment_section').show(300);
                advanceDifferentPayingAmountOptionMakingDisabledWhenAdvancedZero();

                cashPaymentAddAttributeNameAndRequired();//add
                advancePaymentAddAttributeNameAndRequired();//add
                bankingPaymentAddAttributeNameAndRequired();//add
            }
            else{
                jQuery('.cash_payment_section').hide();
                jQuery('.advance_payment_section').hide();
                jQuery('.banking_payment_section').hide();

                jQuery('.cash_payment_making_zero').val(0);
                jQuery('.advance_payment_making_zero').val(0);
                jQuery('.banking_payment_making_zero').val(0);

                emptyAndHideBankingOptionAllData();

                cashPaymentRemoveAttributeNameAndRequired();
                advancePaymentRemoveAttributeNameAndRequired();
                bankingPaymentRemoveAttributeNameAndRequired();
            }
            setTotalPayingAmountIsNotMoreThenInvoicePayableAmount();
            setTotalCurrentInvoiceDueAmount();
            submitButtonEnableDisabledAsRequirementByCalculation();
        });

        //cash payment making zero with hide options 
        function cashPaymentMakingZeroWithHide()
        {
            jQuery('.cash_payment_section').hide();
            jQuery('.cash_payment_making_zero').val(0);
        }
        //cash payment add attribute name and required 
        function cashPaymentAddAttributeNameAndRequired()
        {
            jQuery('.account_id_1').attr('name','account_id_1');
            jQuery('.account_id_1').attr('required',true);
        }
        //cash payment remove attribute name and required 
        function cashPaymentRemoveAttributeNameAndRequired()
        {
            jQuery('.account_id_1').removeAttr('required');
            jQuery('.account_id_1').removeAttr('name');
        }

        //advance payment making zero with hide options
        function advancePaymentMakingZeroWithHide()
        {
            jQuery('.advance_payment_section').hide();
            jQuery('.advance_payment_making_zero').val(0);
        }
        //advance payment  add attribute name and required
        function advancePaymentAddAttributeNameAndRequired()
        {
            jQuery('.account_id_2').attr('name','account_id_2');
            jQuery('.account_id_2').attr('required',true);
        }
        //advance payment  remove attribute name and required
        function advancePaymentRemoveAttributeNameAndRequired()
        {
            jQuery('.account_id_2').removeAttr('required');
            jQuery('.account_id_2').removeAttr('name');
        }

        //banking payment makeing zero with hide optoins
        function bankingPaymentMakingZeroWithHide()
        {
            jQuery('.banking_payment_section').hide();
            jQuery('.banking_payment_making_zero').val(0);
        }
        //banking payment  add attribute name and required
        function bankingPaymentAddAttributeNameAndRequired()
        {
            jQuery('.account_id_3').attr('name','account_id_3');
            jQuery('.account_id_3').attr('required',true);
        }
        //banking payment  remove attribute name and required
        function bankingPaymentRemoveAttributeNameAndRequired()
        {
            jQuery('.account_id_3').removeAttr('required');
            jQuery('.account_id_3').removeAttr('name');
        }

        //advance different paying amount option making disabled when advance zero
        function advanceDifferentPayingAmountOptionMakingDisabledWhenAdvancedZero()
        {
            var advanceAmount = nanCheck(parseFloat(jQuery('.total_advance_amount').val()));
            if(advanceAmount == 0)
            {
                jQuery('.advance_payment_value').val(0);
                jQuery('.advance_payment_value').attr('disabled',true);
                jQuery('.advance_payment_value').css({
                    'background-color':'red','color':'#ffff'
                });
            }else{
                jQuery('.advance_payment_value').removeAttr('disabled');
                jQuery('.advance_payment_value').css({
                    'background-color':'green','color':'#ffff'
                });
            }
        }



        //when change invoice continue with
        jQuery(document).on('change','.invoice_continue_with',function()
        {
            var invoice_continue_type = jQuery('.invoice_continue_with option:selected').val();
            if(invoice_continue_type == 1) //due
            {
                jQuery('.payment_option option[value=0]').prop('selected',true);
                jQuery('.payment_option').attr('disabled',true);
                paymentProcessingWithDueFullAmountAndPayingAmountDisabledAndZero();
                cashPaymentMakingZeroWithHide();
                advancePaymentMakingZeroWithHide();
                bankingPaymentMakingZeroWithHide();

                emptyAndHideBankingOptionAllData();
            }else{
                jQuery('.payment_option').removeAttr('disabled');

                //first time cash is open
                jQuery('.payment_option option[value=1]').prop('selected',true);
                jQuery('.cash_payment_section').show(300);
                jQuery('.cash_payment_value').focus();
            }
            submitButtonEnableDisabledAsRequirementByCalculation();
        });
        //payment Processing With Due Full Amount And Paying Amount Zero
        function paymentProcessingWithDueFullAmountAndPayingAmountZero()
        {
            var totalInvoicePayableAmount = nanCheck(parseFloat(jQuery('.total_invoice_payble_amount').text()));
            jQuery('.invoice_paying_amount').val(0);
            jQuery('.invoice_due_amount').val(totalInvoicePayableAmount);
        }
        //payment Processing With Due Full Amount And Paying Amount Disabled And Zero
        function paymentProcessingWithDueFullAmountAndPayingAmountDisabledAndZero()
        {
            var totalInvoicePayableAmount = nanCheck(parseFloat(jQuery('.total_invoice_payble_amount').text()));
            jQuery('.invoice_paying_amount').val(0);
            jQuery('.invoice_due_amount').val(totalInvoicePayableAmount);
            jQuery('.invoice_paying_amount').attr('readonly',true);

            //paying different method
            jQuery('.cash_payment_value').val(0);
            jQuery('.advance_payment_value').val(0);
            jQuery('.banking_payment_value').val(0);
        }


        //when pressing paying different method : keyup method
        jQuery(document).on('keyup','.paying_different_method',function()
        {
            var pressingAmount = nanCheck(parseFloat(jQuery(this).val()));
            var currentPressableAmount = setCurrentPressingDifferentAmountAfterAllCalculation(pressingAmount);
            jQuery(this).val(currentPressableAmount);

            calculationTotalPayingDifferentAllMethodsAmount();
            setTotalPayingAmountIsNotMoreThenInvoicePayableAmount();
            setTotalCurrentInvoiceDueAmount();

            submitButtonEnableDisabledAsRequirementByCalculation();
        });

        //set current pressing different amount after all calculation
        function setCurrentPressingDifferentAmountAfterAllCalculation(pressingAmount)
        { 
            var totalInvoicePayableAmount = nanCheck(parseFloat(jQuery('.total_invoice_payble_amount').text()));
            var totalDifferentAmountExceptCurrentType = getTotalPayingDifferentAmountExceptCurrentPressingAmount(pressingAmount);
            var currentRemainingAmount = totalInvoicePayableAmount - totalDifferentAmountExceptCurrentType ;
            var currentPressableAmount = 0;
            if(pressingAmount <= currentRemainingAmount)
            {
                currentPressableAmount = pressingAmount;
            }else{
                currentPressableAmount = currentRemainingAmount;
            }
            return currentPressableAmount;
        }

        //get total different methods amount except current pressing amount
        function getTotalPayingDifferentAmountExceptCurrentPressingAmount(pressingAmount)
        {
            var total = calculationTotalPayingDifferentAllMethodsAmount();
            return total - pressingAmount;
        }

        //set total paying amount not more then invoice payable amount
        function setTotalPayingAmountIsNotMoreThenInvoicePayableAmount()
        {
            var totalInvoicePayableAmount = nanCheck(parseFloat(jQuery('.total_invoice_payble_amount').text()));
            var allMethodAmount =  calculationTotalPayingDifferentAllMethodsAmount();
        
            if(totalInvoicePayableAmount >= allMethodAmount)
            {
                jQuery('.invoice_paying_amount').val(allMethodAmount)
            }else{
                jQuery('.invoice_paying_amount').val(totalInvoicePayableAmount)
            }
        }

        //total paying from all different methods
        function calculationTotalPayingDifferentAllMethodsAmount()
        {
            var total = 0;
            jQuery(".paying_different_method").each(function() {
                total += nanCheck(parseFloat(jQuery(this).val()));
            });
            return total = ((total).toFixed(2));
        }

        //current invoice due amount
        function setTotalCurrentInvoiceDueAmount()
        {
            var totalInvoicePayableAmount = nanCheck(parseFloat(jQuery('.total_invoice_payble_amount').text()));
            //var currentInvoiceBeforePressingAmont = nanCheck(parseFloat(jQuery('.invoice_due_amount').val()));
            var currentPayingAmount = calculationTotalPayingDifferentAllMethodsAmount(); 
            var currentDue =  (totalInvoicePayableAmount - currentPayingAmount);
            jQuery('.invoice_due_amount').val(currentDue);
        }


        //banking option all data
        function emptyAndHideBankingOptionAllData()
        {
            jQuery('.rendering_payment_banking_option_data').html('');
            jQuery('.banking_option_data option[value=0]').prop('selected',true);
        }
        //change banking option data
        jQuery(document).on('change','.banking_option_data',function(){
            var banking_option_id = jQuery('.banking_option_data option:selected').val();
            submitButtonEnableDisabledAsRequirementByCalculation();
            var url = jQuery('.paymentBankingOptionUrl').val();
            jQuery.ajax({
                url:url,
                data:{banking_option_id:banking_option_id},
                beforeSend:function(){
                    jQuery('.processing').fadeIn();
                },
                success:function(response){
                    if(response.status == true)
                    {
                        jQuery('.rendering_payment_banking_option_data').html(response.list);
                    }
                },
                complete:function(){
                    jQuery('.processing').fadeOut();
                },
            });
        });
        //banking option all data
        
        //change banking transaction type
        jQuery(document).on('change','.banking_transaction_type',function()
        {
            var banking_type = jQuery('.banking_transaction_type option:selected').val();
            if(banking_type == 1) //direct deposit
            {
                jQuery('.bank_banking_transfer_section').hide();
                jQuery('.bank_banking_cheque_section').hide(100);
            }
            else if(banking_type == 2) //cheque
            {
                jQuery('.bank_banking_transfer_section').hide();
                jQuery('.bank_banking_cheque_section').show(300);
            }
            else if(banking_type == 3) //online transfer
            {
                jQuery('.bank_banking_cheque_section').hide();
                jQuery('.bank_banking_transfer_section').show(300);
            }
        });
        //change banking transaction type



        //enable disabled submit button
        function submitButtonEnableDisabledAsRequirementByCalculation()
        {
            var invoice_continue_type = jQuery('.invoice_continue_with option:selected').val();
            //if(invoice_continue_type == 1)//due
            if(invoice_continue_type == 2)//payment
            {
                var totalPayingAmount = calculationTotalPayingDifferentAllMethodsAmount();
                
                var payment_option = jQuery('.payment_option option:selected').val();
            
                
                if(totalPayingAmount > 0 && payment_option > 0 &&  payment_option <= 3)
                {
                    submitButtonEnable();
                } 
                else if(totalPayingAmount > 0 && payment_option >= 4 &&  payment_option <= 7)
                {
                    var banking_option_id = jQuery('.banking_option_data option:selected').val();
                    if(banking_option_id > 0)
                    {
                        submitButtonEnable();
                    }else{
                        submitButtonDisabled();
                    }
                }
                else{
                    submitButtonDisabled();
                }
            }else{
                submitButtonEnable();
            }
            exchangeGivenAmountAfterCalculator();
        }
        //submit button disabled
        function submitButtonDisabled()
        {
            jQuery('.submitButton').attr('disabled',true); 
        }
        //submit button enabled
        function submitButtonEnable()
        {
            jQuery('.submitButton').removeAttr('disabled'); 
        }
        //enable disabled submit button


        //calculator
        jQuery(document).on('click','.customer_calculator_button',function(){
            jQuery('.customer_calculator').show(300);
            jQuery('.customer_calculator_button').hide(300);
        });
        jQuery(document).on('click','.customer_calculator_close',function(){
            jQuery('.customer_calculator').hide(300);
            jQuery('.customer_calculator_button').show(300);
        });
        jQuery(document).on('keyup','.given_amount_for_calculator',function()
        {
            exchangeGivenAmountAfterCalculator();
        });
        function exchangeGivenAmountAfterCalculator()
        {
            var invoice_amount = nanCheck(parseFloat(jQuery('.total_invoice_amount_for_calculator').val()));
            var paing_amount_cal = nanCheck(parseFloat(jQuery('.total_paying_amount_for_calculator').val()));
            var given_amount = nanCheck(parseFloat(jQuery('.given_amount_for_calculator').val()));
            
            if(paing_amount_cal > 0 && given_amount > 0 && given_amount > paing_amount_cal)
            {
                var totalReturnAmount = paing_amount_cal - given_amount;
                totalReturnAmount = totalReturnAmount.toFixed(2);
                jQuery('.return_amount_for_calculator').val(totalReturnAmount);
            }else{
                jQuery('.return_amount_for_calculator').val(0.0);
            }
        }
        //calculator
    /*
    |-------------------------------------------------------------------------------
    |-----------------------------------------------
    |payment processing all options, functions
    |----------------------------------------------
    */
      



    




    
    /*
    |-----------------------------------------------
    | finally submit Purchase (final Purchase and quotation)
    |----------------------------------------------
    */ 
    $(document).on("submit",'.storeDataFromPurchaseCart',function(e){
        e.preventDefault();
        $('.color-red').text('');
            $.ajax({
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
                    if(response.status == true)
                    {
                        jQuery('.display_added_to_cart_list').html(response.list);
                        jQuery('#payment-popup').modal('hide');
                        jQuery('#quotation-popup').modal('hide');

                        makingEmptyshippingRelatedInformation();
                        makingZeroInShippingCostOtherCostDiscountAndVat();
                        finalCalculationForThisInvoice();
                        jQuery.notify(response.message, response.type);
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


        /* jQuery(document).on("submit",'.storeDataFromPurchaseCart',function(e){
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
                        jQuery('.display_added_to_cart_list').html(response.list);
                        jQuery('#payment-popup').modal('hide');
                        jQuery('#quotation-popup').modal('hide');

                        makingEmptyshippingRelatedInformation();
                        makingZeroInShippingCostOtherCostDiscountAndVat();
                        finalCalculationForThisInvoice();
                        jQuery.notify(response.message, response.type);
                    }
                },
                complete:function(){
                    jQuery('.processing').fadeOut();
                },
            });
            //end ajax
        }); */
    /*
    |-----------------------------------------------
    | finally submit Purchase 
    |----------------------------------------------
    */
    
