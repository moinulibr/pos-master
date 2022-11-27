    /*
    |--------------------------------------------------------
    | input field protected .. only for numeric
    |--------------------------------------------------------
    */
        jQuery(document).on('keyup keypress','.inputFieldValidatedOnlyNumeric',function(e){
            if (String.fromCharCode(e.keyCode).match(/[^0-9\.]/g)) return false;
        });


    /*
    |----------------------------------------------------------------
    | display single product details for showing and adding to cart
    |----------------------------------------------------------------
    */
        jQuery(document).on('click','.productDetails',function(e){
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
        });
    /*
    |----------------------------------------------------------------
    | display single product details for showing and adding to cart
    |----------------------------------------------------------------
    */






    /*
    |----------------------------------------------------------------
    | hover mouseover effect
    |----------------------------------------------------------------
    */
        //hover : display sotck list with price 
        jQuery(document).on('mouseover','.productStockHover,.selectedProductStockRow',function(e){
            e.preventDefault();
            var id = jQuery(this).data('id');
            jQuery(this).css({
                'cursor' : 'pointer'
            });
            jQuery('.productStockHover').css({
                'color':'black',
                'background-colo':'none'
            });
            jQuery('.selectedProductStockRow').css({
                'color':'black',
                'background-colo':'#ffffff'
            });

            var selectedId = jQuery('.selectedProductStockId').val();
            if(selectedId != id){
                jQuery('.selectedProductStockRow_'+id).css({
                    'color':'white',
                    'background-color':'#b0d5b0'
                });
            }
        });

        //hover end- mouseout 
        //hover : display sotck list with price 
        jQuery(document).on('mouseout','.productStockHover,.selectedProductStockRow',function(e){
            e.preventDefault();
            var id = jQuery(this).data('id');
            jQuery('.productStockHovereffect_'+id).css({
                'color':'black',
                'background-color':'none'
            });
        
            var selectedId = jQuery('.selectedProductStockId').val();
            if(selectedId != id){
                jQuery('.selectedProductStockRow_'+id).css({
                    'color':'black',
                    'background-color':'#ffffff'
                });
            }
        });
    /*
    |----------------------------------------------------------------
    | hover mouseover effect : END
    |----------------------------------------------------------------
    */
    
   //selected effect
   jQuery(document).on('click','.selectedProductStock ,.selectedProductStockRow',function(e){
        e.preventDefault();
        var id = jQuery(this).data('id');
        makingSelectedProductStockByProuductStockId(id);
        visiblePermissionBasedOnSellingQuantity();
        discountAmountLessThemPurchaseAmount();
        return true;
    });


    function makingSelectedProductStockByProuductStockId(productStockId)
    {   
        jQuery('.selectedProductStockId').val('');
            jQuery('.productStockHover').css({
                'color':'black',
                'background-colo':'#ffffff'
            });

            jQuery('.selectedProductStock').css({
                'background-color':'#ffffff !important'
            });
            
            jQuery('.selectedProductStockRow').css({
                'color':'black',
                'background-color':'#ffffff'
            });
        
            jQuery('.selectedProductStockRow_'+productStockId).css({
                'color':'#ffffff !important',
                'background-color':'#64b764'
            });
            
        jQuery('.selectedProductStockId').val(productStockId);

        makingSelecedSellingPriceByProductStockId(productStockId);
        return true;
    }



    function gettingSelectedPriceIdAccordingToDefaultPriceId()
    {
        var defaultPriceId          = jQuery(".defaultSelectedPriceId").val();
        var selectedValuePriceId    = jQuery('.selectedPriceId').val();
        if(
            (selectedValuePriceId === 'undefined' || selectedValuePriceId === null || selectedValuePriceId.length === 0)
        )
        {
            jQuery('.selectedPriceId').val(defaultPriceId);     
            selectedValuePriceId = defaultPriceId;
        }
        return selectedValuePriceId;
    }


    //making:- selected selling price by product stock id by ajax
    function makingSelecedSellingPriceByProductStockId(productStockId)
    {   
        //selected price id
        var selectedValuePriceId = gettingSelectedPriceIdAccordingToDefaultPriceId();

        var url = jQuery('.displaySinglePriceListByProductStockId').val();
        var product_stock_id    = productStockId;
        var product_id          = jQuery('#main_product_id').val();
        jQuery.ajax({
            url:url,
            data:{product_stock_id:product_stock_id,product_id:product_id},
            beforeSend:function(){
                jQuery('.processing_on').fadeIn();
            },
            success:function(response){
                if(response.status == true)
                {
                    jQuery('.selling_from_stock_name_and_selling_product_stock_price_list').html(response.stock);
                    makingSelectedSellingPriceByPriceId(selectedValuePriceId);
                }
            },
             complete:function(){
                jQuery('.processing_on').fadeOut();
            },
        });
    }


    function makingSelectedSellingPriceByPriceId(priceId)
    {
       //selected price id
       var selectedPriceId = gettingSelectedPriceIdAccordingToDefaultPriceId();
       priceId = selectedPriceId;
       
        jQuery('.selling_from_price_label').css({
            "cursor": "pointer",
            "padding-left": "4px",
            "background-color":" #e2f7f6",
            "padding-right": "0px",
            "margin-bottom": "8px",
            "width": "100%"
        });

        jQuery('.selling_from_price_label_css').css({
            "color" : "black"
        });
        
        
        jQuery('.check_when_selected').hide();
        jQuery('.uncheck_when_not_selected').show();
        jQuery('.check_when_selected_'+priceId).show();  
        jQuery('.uncheck_when_not_selected_'+priceId).hide();
 

        jQuery('.selling_from_price_label_css_'+priceId).css({
            "color" : "#ffff"
        });

        jQuery('.selling_from_price_label_'+priceId).css({
            "cursor" : "pointer",
            "padding-left" : "4px",
            "background-color" : "rgb(62,141,61,1)",  //#64b764
            "color" : "#e2f7f6",
            "padding-right" : "0px",
            "margin-bottom" : "8px",
            "width" : "100%"
        }).trigger('change');

        finalCalculationAccordingToSelectedPriceAndFinalSellPrice();
        return true;
        /*
            selling_from_purchase_price
            selling_from_sell_price
            selling_from_mrp_price
            //jQuery(".selling_from_price_id_"+priceId).prop("checked",true);//good working
            //jQuery('input[type="radio"][name="selling_price"][id="selling_from_price_id_'+priceId+'"]').prop('checked', true);//good working
            //jQuery('input[type="radio"][name="selling_price"][id="selling_from_price_id_'+priceId+'"]').attr('checked', 'checked');//good working
            
            //jQuery(".selling_from_price_id_"+priceId).attr('checked', 'checked');
            //jQuery('input[type="radio"][name="selling_price"][id="selling_from_price_id_'+priceId+'"]').prop('checked', true);
        */ 
    }


    jQuery(document).on('click','.selling_from_price',function(e){
        e.preventDefault();
        var priceId         = jQuery(this).data('selling_from_price_id');
        var productPriceId  = jQuery(this).data('selling_from_product_price_id');
        var price           = jQuery(this).data('price_'+priceId);

        jQuery('.selectedPriceId').val(priceId);
        jQuery('.selectedSellingPrice').val(priceId);
        jQuery('.selectingSellingPriceAction').val(1);
        makingSelectedSellingPriceByPriceId(priceId);
        finalCalculationAccordingToSelectedPriceAndFinalSellPrice();
    });

    


    var ctrlDown = false,ctrlKey = 17,cmdKey = 91,vKey = 86,cKey = 67; xKey = 88;
    jQuery(document).on('keyup change','.final_sell_price,.final_sell_quantity,.discount_type,.discount_amount',function(e){
        e.preventDefault();
        jQuery('.final_sell_price_err').text('');
        jQuery('.discount_amount_err').text('');
        var action = 0;
        if(jQuery(e.target).prop("name") == "final_sell_price" && ((e.type)=='keyup'))
        {
            jQuery('.selectingSellingPriceAction').val(0);
            action = 1;
        } 
        else if(jQuery(e.target).prop("name") == "final_sell_quantity" && ((e.type)=='keyup'))
        {
            action = 1;
        } 
        else if(jQuery(e.target).prop("name") == "discount_amount" && ((e.type)=='keyup'))
        {
            action = 1;
        } 
        else if(jQuery(e.target).prop("name") == "discount_type" && ((e.type)=='change'))
        {
            action = 1;
        }
        else{
            action = 0;
        }
        if(action == 0) return;
        if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
        if (ctrlDown && ( e.keyCode == vKey || e.keyCode == cKey || e.keyCode == xKey)) return false;
        finalCalculationAccordingToSelectedPriceAndFinalSellPrice();
    });


    //default selected:- product stock, selling price, Quantity
    function defaultSelectedProductStockSellingPriceAndQuantityCalculation()
    {
        var productStockId = jQuery('.defaultProductStockId').val();
        makingSelectedProductStockByProuductStockId(productStockId);

        var priceId = jQuery(".defaultSelectedPriceId").val();
        jQuery('.selectedPriceId').val(priceId);
        jQuery('.selectedSellingPrice').val(priceId);
        jQuery('.selectingSellingPriceAction').val(1);
        makingSelectedSellingPriceByPriceId(priceId);
        return true;
    }




    //final calculation according to selected price and final selling price
    //selling quantity, discount, 
    function finalCalculationAccordingToSelectedPriceAndFinalSellPrice()
    {
        //setting selling price according to selected price
        settingSellingPriceAccordingToSelectedSellingPrice();

        //getting selling price from selected selling price
        gettingSellingPriceFromSelectedSellingPrice();

        //making selling price
        makingSellingPrice();

        //making selling quantity
        makingSellingQuantity();

        //for discount validation
        discountAmountLessThemPurchaseAmount();
        
        //making selling amount without discount
        makingSellingAmountWithoutDiscount();

        //making selling discount
        makingSellingDiscount();

        //enable disabled add to cart button
        enabledDisabledAddToCartButton();

        //percentage of selling price aginst of the purchase price
        getAndSetPercentageOfSellingPriceAginstOfPurchasePrice();
    }



    //selling price according to selected selling price
    function settingSellingPriceAccordingToSelectedSellingPrice()
    {
        var selectedPriceId = gettingSelectedPriceIdAccordingToDefaultPriceId();
        var price = jQuery('.selling_from_price_id_'+selectedPriceId).data('price_'+selectedPriceId);
        jQuery('.selectedSellingPrice').val(price);
    }

    //
    function gettingSellingPriceFromSelectedSellingPrice()
    {
        var selectedPriceId = gettingSelectedPriceIdAccordingToDefaultPriceId();
        var price = jQuery('.selling_from_price_id_'+selectedPriceId).data('price_'+selectedPriceId);
        return price;
    }
   
    function makingSellingPrice()
    {
        var selectedSellingPrice        = nanCheck(jQuery('.selectedSellingPrice').val());
        var selectingSellingPriceAction = jQuery('.selectingSellingPriceAction').val();
        var finalSellingPrice           = nanCheck(jQuery('.final_sell_price').val());
        var makingFinalPrice            = selectedSellingPrice;
        if(
            (finalSellingPrice === 'undefined' || finalSellingPrice === null || finalSellingPrice.length === 0)
        )
        {      
            makingFinalPrice = selectedSellingPrice;
        }else{
            if(selectingSellingPriceAction == 1)
            {
                makingFinalPrice = selectedSellingPrice;
            }else{
                makingFinalPrice = finalSellingPrice;
            }
        }
        jQuery('.final_sell_price').val(makingFinalPrice);
        return makingFinalPrice;
    }

    
    jQuery(document).on('blur','.final_sell_price',function(e){
        e.preventDefault();
        finallySellingPrice();
        jQuery('.discountPermissionApplicableSelected').val(0);
    });

    function finallySellingPrice()
    {
        var purchasePrice           = nanCheck(parseFloat(jQuery('.selling_from_purchase_price').val()));
        var selectedSellingPrice    = nanCheck(parseFloat(jQuery('.selectedSellingPrice').val()));
        var finalSellingPrice       = nanCheck(parseFloat(jQuery('.final_sell_price').val()));
        var makingFinalPrice        = selectedSellingPrice;
        if(
            (finalSellingPrice === 'undefined' || finalSellingPrice === null || finalSellingPrice.length === 0)
        )
        {   
            makingFinalPrice = selectedSellingPrice;
        }else{
            makingFinalPrice = finalSellingPrice;
        }
        
        var sellApplicableOrNot = jQuery('.sellApplicableOrNotWhenSellingPriceIsLessThanPurchasePrice').val();
        if(makingFinalPrice < purchasePrice && sellApplicableOrNot == 1)
        {
            //visible alert message
            visiblePermissionSellingPriceAlertMessage();
        }
        else if(makingFinalPrice >= purchasePrice )
        {
            makingFinalPrice = finalSellingPrice;
        }
        else{
            makingFinalPrice = purchasePrice;
        }
        jQuery('.final_sell_price').val(makingFinalPrice);
        //finalCalculationAccordingToSelectedPriceAndFinalSellPrice();
        return makingFinalPrice;
    }
  

    /*
    |-----------------------------------------------------------------------
    | Selling permission applicable and alert message
    |-----------------------------------------------------------------------
    */
        //not using this yet now
        function defaultSellingPricePermission()
        {
            var permission  = 0;
            selectingFinalSellingPriceBySellingPermission(permission);
            hiddenPermissionSellingPriceAlertMessage();
            finalCalculationAccordingToSelectedPriceAndFinalSellPrice();
        }
        //not using this yet now
        function selectedSellingPricePermission()
        {
            var permission  = 1;
            selectingFinalSellingPriceBySellingPermission(permission);
            hiddenPermissionSellingPriceAlertMessage();
            finalCalculationAccordingToSelectedPriceAndFinalSellPrice();
        }
        
        //using this properly
        jQuery(document).on('click','.sellingPermissionApplicable',function(){
            var permission  = jQuery(this).data('permission');
            selectingFinalSellingPriceBySellingPermission(permission);
            hiddenPermissionSellingPriceAlertMessage();
            //finallySellingPrice();
            finalCalculationAccordingToSelectedPriceAndFinalSellPrice();
        });
        
        function selectingFinalSellingPriceBySellingPermission(permission)
        {
            var purchasePrice           = nanCheck(parseFloat(jQuery('.selling_from_purchase_price').val()));
            var selectedSellingPrice    = nanCheck(parseFloat(jQuery('.selectedSellingPrice').val()));
            var finalSellingPrice       = nanCheck(parseFloat(jQuery('.final_sell_price').val()));
            var makingFinalPrice        = selectedSellingPrice;
            if(
                (finalSellingPrice === 'undefined' || finalSellingPrice === null || finalSellingPrice.length === 0)
            )
            {   
                makingFinalPrice = selectedSellingPrice;
            }else{
                makingFinalPrice = finalSellingPrice;
            }
            if(permission == 1)
            {
                //yes, want to sell less than purchase price
                jQuery('.final_sell_price').val(makingFinalPrice)
            }else{
                //no, don't want to sell less than purchase price
                jQuery('.final_sell_price').val(purchasePrice)
            }
        }
        function visiblePermissionSellingPriceAlertMessage()
        {
            disabledToCartButton();
            jQuery('#sellingPriceBaseLayer').css({'visibility':'visible'});
            jQuery('#sellingPriceErrorMessageLayer').css({'visibility':'visible'});
        } 
        function hiddenPermissionSellingPriceAlertMessage()
        {
            jQuery('#sellingPriceBaseLayer').css({'visibility':'hidden'});
            jQuery('#sellingPriceErrorMessageLayer').css({'visibility':'hidden'});
        }
    /*
    |-----------------------------------------------------------------------
    | Selling permission applicable : END
    |-----------------------------------------------------------------------
    */



    

    /*
    |-----------------------------------------------------------------------
    | Selling Discount
    |-----------------------------------------------------------------------
    */
        var ctrlDown = false,ctrlKey = 17,cmdKey = 91,vKey = 86,cKey = 67; xKey = 88;
        jQuery(document).on('keyup blur change','.discount_amount , .discount_type',function(e){
            
            var action = 0;
            if(jQuery(e.target).prop("name") == "discount_amount" && ((e.type)=='keyup'))
            {
                action = 1;
            } 
            else if(jQuery(e.target).prop("name") == "discount_amount" && ((e.type)=='blur' || (e.type)=='focusout'))
            {
                action = 1;
            } 
            else if(jQuery(e.target).prop("name") == "discount_type" && ((e.type)=='change'))
            {
                action = 1;
            }
            else{
                action = 0;
            }
            //if(action == 0) return;
            if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
            if (ctrlDown && ( e.keyCode == vKey || e.keyCode == cKey || e.keyCode == xKey)) return false;
            if(action == 1) {
                jQuery('.discountPermissionApplicableSelected').val(0);
                discountAmountLessThemPurchaseAmount();
            }
        });
        function makingSellingAmountWithoutDiscount()
        {
            var finalSellingPrice       = nanCheck(jQuery('.final_sell_price').val());
            var finalSellingQuantity    = nanCheck(jQuery('.final_sell_quantity').val());
            var totalAmountWithDiscount = ((finalSellingPrice * finalSellingQuantity).toFixed(2));
            return totalAmountWithDiscount;
        }

        function makingSellingDiscount()
        {
            var discountType        = jQuery('input[name="discount_type"]:checked').val();
            var discountAmount      = nanCheck(jQuery('.discount_amount').val());

            //discount amount always less them purchaseAmount
            var totalDiscout = makingDiscountAmountAccordingToDiscountType(discountType,discountAmount);

            jQuery('.total_discount_amount_text').text(totalDiscout);
            jQuery('.total_discount_amount_value').val(totalDiscout);

            var totalAmountWithoutDiscount  = nanCheck(makingSellingAmountWithoutDiscount());
            jQuery('.total_amount_before_discount_text').text(totalAmountWithoutDiscount);
            jQuery('.total_amount_before_discount_value').val(totalAmountWithoutDiscount);

            var finalSellingAmount          = nanCheck((totalAmountWithoutDiscount - totalDiscout).toFixed(2));
            jQuery('.selling_final_amount_text').text(finalSellingAmount);
            jQuery('.selling_final_amount_value').val(finalSellingAmount);
        }

        function makingDiscountAmountAccordingToDiscountType(discountType,discountAmount)
        {
            var totalAmountWithoutDiscount = makingSellingAmountWithoutDiscount();
            var discount = 0;
            if(discountType == 'fixed')
            {
                discount = discountAmount;
            }
            else if(discountType == 'percentage') {
                discount = (((totalAmountWithoutDiscount * discountAmount) / 100).toFixed(2));
            }
            return discount;
        }

        function discountAmountLessThemPurchaseAmount()
        {
            var purchasePrice           = nanCheck(jQuery('.selling_from_purchase_price').val());
            var finalSellingQuantity    = nanCheck(jQuery('.final_sell_quantity').val());
            var finalSellingPrice       = nanCheck(jQuery('.final_sell_price').val());
            var totalSellingAmount      = ((finalSellingPrice * finalSellingQuantity).toFixed(2));

            var totalAmountByPurchasePrice = purchasePrice * finalSellingQuantity;

            var discountType        = jQuery('input[name="discount_type"]:checked').val();
            var discountAmount      = nanCheck(jQuery('.discount_amount').val());
            
            var discountAppliable   = 0;
            if((discountType == 'fixed' || discountType == 'percentage')
                && (discountAmount > 0)
            )
            {
                discountAppliable   = 1;
            }else{
                discountAppliable   = 0;
            }
            
            //discount amount always less them purchaseAmount
            var totalDiscout    = makingDiscountAmountAccordingToDiscountType(discountType,discountAmount);
           
            var selectedPermission = jQuery('.discountPermissionApplicableSelected').val();

            //sell applicable or not when total discount amount is greater than total purchase amount
            var sellApplicableOrNot = jQuery('.sellApplicableOrNotWhenTotalDiscountAmountIsGreaterThanTotalPurchasePrice').val();
            if(sellApplicableOrNot == 1)
            {
                if((finalSellingPrice < purchasePrice) && (selectedPermission == 0 && discountAppliable == 1))
                {
                    visiblePermissionDiscountSellingPriceAlertMessage();
                } 
                else if((totalSellingAmount < totalAmountByPurchasePrice) && (selectedPermission == 0 && discountAppliable == 1))
                {
                    visiblePermissionDiscountSellingPriceAlertMessage();
                } 
                else if(finalSellingPrice > purchasePrice && (selectedPermission == 0 && discountAppliable == 1) &&
                    (totalSellingAmount < totalDiscout)
                )
                {
                    visiblePermissionDiscountSellingPriceAlertMessage();
                }
                else if(finalSellingPrice < purchasePrice && (selectedPermission == 0 && discountAppliable == 1) &&
                    (totalSellingAmount < totalDiscout)
                )
                {
                    visiblePermissionDiscountSellingPriceAlertMessage();
                }
                 else if(finalSellingPrice > purchasePrice && (selectedPermission == 0 && discountAppliable == 1) &&
                    ((totalSellingAmount > totalDiscout) && (totalAmountByPurchasePrice < totalDiscout))
                )
                {
                    visiblePermissionDiscountSellingPriceAlertMessage();
                }
                else{
                    hiddenPermissionDiscountSellingPriceAlertMessage(); 
                }
            }
            //when sellapplicable is 0 == not want to selling price is grater than total discount amount
            else{
                if(((totalAmountByPurchasePrice < totalDiscout) || (totalSellingAmount < totalAmountByPurchasePrice))
                )
                {
                    jQuery('.discount_amount').val(0);
                }
                else{
                    jQuery('.discount_amount').val(discountAmount);
                }
                jQuery('.discountPermissionApplicableSelected').val(1);
            }
            //from setting : if discount amount is greater than total purchase price is 1
            //if selling price is less than purchase price
            //if selling price greatar than purchase price, and check total
                //purchase price * quantity is greater than total discount amount
        }
    /*
    |-----------------------------------------------------------------------
    | Selling Discount
    |-----------------------------------------------------------------------
    */

    
    /*
    |-----------------------------------------------------------------------
    | get Percentage of Selling price aginst of purchase price
    |-----------------------------------------------------------------------
    */
        function getAndSetPercentageOfSellingPriceAginstOfPurchasePrice()
        {
            var purchasePrice           = nanCheck(jQuery('.selling_from_purchase_price').val());
            var finalSellingPrice       = nanCheck(jQuery('.final_sell_price').val());
            var sellProfitOfASingleProduct =  finalSellingPrice - purchasePrice;
            var percentageOfPurchasePrice = 0;
            percentageOfPurchasePrice = (((sellProfitOfASingleProduct * 100) / purchasePrice).toFixed(2));
            jQuery('.percentage_of_sell_price_against_of_the_purchase_price_text').text(percentageOfPurchasePrice);
            jQuery('.percentage_of_sell_price_against_of_the_purchase_price_value').val(percentageOfPurchasePrice);
            
            var mrpPrice  = nanCheck(jQuery('.selling_from_mrp_price').val());
            var sellProfitOfASingleProductAginstOfMRP =  mrpPrice - finalSellingPrice;
            
            var totalQty = nanCheck(jQuery('.final_sell_quantity').val());
            jQuery('.discount_amount').val((sellProfitOfASingleProductAginstOfMRP).toFixed(2));
            jQuery('.total_discount_amount_text').text((sellProfitOfASingleProductAginstOfMRP *  totalQty).toFixed(2));
            jQuery('.total_discount_amount_value').val((sellProfitOfASingleProductAginstOfMRP *  totalQty).toFixed(2));
            
            var percentageOfMRPPrice = 0;
            percentageOfMRPPrice = (((sellProfitOfASingleProductAginstOfMRP * 100) / mrpPrice).toFixed(2));
            jQuery('.percentage_of_sell_price_against_of_the_mrp_price_text').text(percentageOfMRPPrice);
            jQuery('.percentage_of_sell_price_against_of_the_mrp_price_value').val(percentageOfMRPPrice);
           return 1;
        }
    /*
    |-----------------------------------------------------------------------
    | get Percentage of Selling price aginst of purchase price
    |-----------------------------------------------------------------------
    */
        
    
        
    /*
    |-----------------------------------------------------------------------
    | Selling discount permission applicable and alert message
    |-----------------------------------------------------------------------
    */
        //not using this yet now
        function defaultSellingPriceDiscountPermission()
        {
            var permission  = 0;
            selectingFinalSellingPriceBySellingDiscountPermission(permission);
            hiddenPermissionDiscountSellingPriceAlertMessage();
            finalCalculationAccordingToSelectedPriceAndFinalSellPrice();
        }
        //not using this yet now
        function selectedSellingPricePermission()
        {
            var permission  = 1;
            selectingFinalSellingPriceBySellingDiscountPermission(permission);
            hiddenPermissionDiscountSellingPriceAlertMessage();
            finalCalculationAccordingToSelectedPriceAndFinalSellPrice();
        }
        
        //using this properly
        jQuery(document).on('click','.discountPermissionApplicable',function(){
            var permission  = jQuery(this).data('permission');
            jQuery('.discountPermissionApplicableSelected').val(permission);
            selectingFinalSellingPriceBySellingDiscountPermission(permission);
            finalCalculationAccordingToSelectedPriceAndFinalSellPrice();
        });
        function selectingFinalSellingPriceBySellingDiscountPermission(permission)
        {
            var discountAmount      = nanCheck(jQuery('.discount_amount').val());
            if(permission == 1)
            {
                //yes, want to sell less than purchase price
                jQuery('.discount_amount').val(discountAmount)
            }else{
                //no, don't want to sell less than purchase price
                jQuery('.discount_amount').val(0)
            }
            hiddenPermissionDiscountSellingPriceAlertMessage();
        }
        function visiblePermissionDiscountSellingPriceAlertMessage()
        {
            disabledToCartButton();
            jQuery('#sellingPriceBaseLayerWhenDiscount').css({'visibility':'visible'});
            jQuery('#sellingPriceErrorMessageLayerWhenDiscount').css({'visibility':'visible'});
        } 
        function hiddenPermissionDiscountSellingPriceAlertMessage()
        {
            jQuery('#sellingPriceBaseLayerWhenDiscount').css({'visibility':'hidden'});
            jQuery('#sellingPriceErrorMessageLayerWhenDiscount').css({'visibility':'hidden'});
        }
    /*
    |-----------------------------------------------------------------------
    | Selling discount permission applicable : END
    |-----------------------------------------------------------------------
    */




    /*
    |-----------------------------------------------------------------------
    | Selling Quantity start
    |-----------------------------------------------------------------------
    */
        function makingSellingQuantity()
        {
            var finalSellingQuantity    = jQuery('.final_sell_quantity').val();
            if(jQuery('.initialDefaultQuantity').val() == 1)
            {
                if(
                    (finalSellingQuantity === 'undefined' || finalSellingQuantity === null || finalSellingQuantity.length === 0)
                )
                {   
                    jQuery('.final_sell_quantity').val(1);
                    finalSellingQuantity = 1;
                }
            }
            return  finalSellingQuantity;
        } 
    /*
    |-----------------------------------------------------------------------
    | Selling Quantity
    |-----------------------------------------------------------------------
    */

        /*
        |-----------------------------------------------------------------------
        | when Quantity change
        |-----------------------------------------------------------------------
        */
        var ctrlDown = false,ctrlKey = 17,cmdKey = 91,vKey = 86,cKey = 67; xKey = 88;
        jQuery(document).on('keyup blur','.final_sell_quantity',function(e){
            e.preventDefault();
            //jQuery('.initialDefaultQuantity').val(0);//initial quantity 0

            var action = 0;
            var delay  = 0;
            var moreQuantityFromOthersStock = jQuery('.moreQuantityFromOthersStock').val();
            if(((e.type)=='keyup'))
            {
                hideOrDisabledOnlyAddMoreQuantityFromOthersStockRelatedPart();
                jQuery('.initialDefaultQuantity').val(0);
                jQuery('.moreQuantityFromOthersStock').val(0);
                moreQuantityFromOthersStock = 0;
                action = 1;
                delay  = 1;
            } 
            else if(((e.type) == 'blur') || ((e.type) == 'focusout'))
            {
                action = 1;
                delay  = 0;
                moreQuantityFromOthersStock = moreQuantityFromOthersStock;
            } 
            else{
                action = 0;
                moreQuantityFromOthersStock = moreQuantityFromOthersStock;
            }
        
            //if(action == 0) return;
            if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
            if (ctrlDown && ( e.keyCode == vKey || e.keyCode == cKey || e.keyCode == xKey)) return false;
            
            
            if(delay == 1)
            {
                setTimeout(
                    function() 
                    {
                        if(moreQuantityFromOthersStock == 0)
                        {
                            visiblePermissionBasedOnSellingQuantity();
                        }
                    }, 1000);
            }else{
                if(moreQuantityFromOthersStock == 0)
                {
                    visiblePermissionBasedOnSellingQuantity();
                }
            }
        });

        function visiblePermissionBasedOnSellingQuantity()
        {
            var sellApplicableOrNotWhenStockIsLessThanZero = jQuery('.sellApplicableOrNotWhenStockIsLessThanZero').val();
            var sellingQuantity = jQuery('.final_sell_quantity').val();

            var currentStock    = jQuery('.available_base_stock_for_this_selling_stock').val();
        
            if(currentStock < sellingQuantity )
            {
                visiblePermissionSellingQuantityAlertMessage();         
            }else{
                //jQuery('.final_sell_quantity').val(currentStock);
            }
        }

        jQuery(document).on('click','.quantityPermissionApplicable',function(){
            var permission  = jQuery(this).data('permission');
            jQuery('.quantityPermissionApplicableSelected').val(permission);
            selectingFinalSellingQuantityBySelectedQuantityPermission(permission);
            finalCalculationAccordingToSelectedPriceAndFinalSellPrice();
        });
        function selectingFinalSellingQuantityBySelectedQuantityPermission(permission)
        {
            var sellingQuantity             = jQuery('.final_sell_quantity').val();
            var sellingPrice                = jQuery('.final_sell_price').val();
            var primarySellingStock         = jQuery('.selectedProductStockId').val();
            var moreQuantityFromOthersStock = jQuery('.moreQuantityFromOthersStock').val();
            if(permission == 1 && moreQuantityFromOthersStock == 0)
            {
                quantitySelectedFromOthersStock(sellingQuantity,sellingPrice,primarySellingStock);
            }else{
                jQuery('.final_sell_quantity').val(sellingQuantity);
                hideOrDisabledOnlyAddMoreQuantityFromOthersStockRelatedPart();
            }
            hiddenPermissionSellingQuantityAlertMessage();
        }
        function visiblePermissionSellingQuantityAlertMessage()
        {
            disabledToCartButton();
            jQuery('#sellingPriceBaseLayerWhenQuantity').css({'visibility':'visible'});
            jQuery('#sellingPriceErrorMessageLayerWhenQuantity').css({'visibility':'visible'});
        } 
        function hiddenPermissionSellingQuantityAlertMessage()
        {
            jQuery('#sellingPriceBaseLayerWhenQuantity').css({'visibility':'hidden'});
            jQuery('#sellingPriceErrorMessageLayerWhenQuantity').css({'visibility':'hidden'});
        }


        
        /*
        |------------------------------------------------------------------------------------------
        | Selling Quantity
        |------------------------------------------------------------------------------------------ 
        */
        //quantity selected from others stock
        jQuery('#showProductDetailModal').css('overflow-y', 'auto');
        function quantitySelectedFromOthersStock(sellingQuantity,sellingPrice,primarySellingStock)
        {
            var url         = jQuery('.displayQuantityWiseSingleProductByProductId').val();
            var product_id  = jQuery('#main_product_id').val();
            jQuery.ajax({
                url:url,
                data:{product_id:product_id,sellingQuantity:sellingQuantity,sellingPrice:sellingPrice,primarySellingStock:primarySellingStock},
                beforeSend:function(){
                    jQuery('.processing_on').fadeIn();
                },
                success:function(response){
                    if(response.status == true)
                    {
                        jQuery('#showQuantityWiseProductStockModal').html(response.stock).modal('show');
                        pressingCurrentSellingQuantityForMoreQuantity(primarySellingStock);
                        setTotalCurrentSellingQuantity();
                    }
                },
                complete:function(){
                    jQuery('.processing_on').fadeOut();
                },
            });
        }

        //pressing current selling quantity
        jQuery(document).on('keyup','.pressingCurrentSellingQuantity',function(){
            pressingCurrentSellingQuantityForMoreQuantity(jQuery(this).data('id'));
        });
        
        //Pressing Current selling quantity for more quantity
        function pressingCurrentSellingQuantityForMoreQuantity(sellingStockId)
        {
            var primarySellingProductStockId    = jQuery('.primarySellingProductStockId').val();
            var primarySellingProductStockQty   = nanCheck(parseFloat(jQuery('.pressingCurrentSellingQuantity_'+primarySellingProductStockId).val()));
            var pressing_qty                    = nanCheck(parseFloat(jQuery('.pressingCurrentSellingQuantity_'+sellingStockId).val()));
            var currentStockQty                 = nanCheck(parseFloat(jQuery('.totalQuantityOfThisStockValue_'+sellingStockId).val()));
            
            var totalQty = totalSellingQuantityFromQuantityWiseMoreStock();

            if(primarySellingProductStockQty == 0)
            {
                disabledAddAllQuantityToTheMainQuanityt();
            } 
            else if(totalQty == 0)
            {
                disabledAddAllQuantityToTheMainQuanityt();
            }
            else
            {
                enableAddAllQuantityToTheMainQuanityt();
            }

            if(pressing_qty > 0) 
            {
                if(currentStockQty < pressing_qty)
                {
                    jQuery('.overStockErrorMessage_'+sellingStockId).text("Over Stock");
                    overStockProcessingDuration(sellingStockId);
                }else{
                    jQuery('.overStockErrorMessage_'+sellingStockId).text("");
                    regularStockProcessingDuration(sellingStockId);
                }
                jQuery('.checkedCurrentSellingQuantity_'+sellingStockId).prop('checked',true);
            }

            setTotalCurrentSellingQuantity();
            finalCalculationAccordingToSelectedPriceAndFinalSellPrice();
        }

        jQuery(document).on('change','.checkedCurrentSellingQuantity',function(){
            var id   = jQuery(this).data('id');
            if(jQuery(this).is(':checked')) {
                //jQuery('.pressingCurrentSellingQuantity_'+id).val();
            }else{
                jQuery('.overStockErrorMessage_'+id).text("");
                jQuery('.pressingCurrentSellingQuantity_'+id).val(0);

                regularStockProcessingDuration(id);
                //overStockProcessingDuration(id);
            }

            var primarySellingProductStockId    = jQuery('.primarySellingProductStockId').val();
            var primarySellingProductStockQty   = nanCheck(parseFloat(jQuery('.pressingCurrentSellingQuantity_'+primarySellingProductStockId).val()));
            var totalQty = totalSellingQuantityFromQuantityWiseMoreStock();

            if((primarySellingProductStockQty > 0) && (totalQty > 0))
            {
                enableAddAllQuantityToTheMainQuanityt();
            } 
            else if(totalQty < 1)
            {
                disabledAddAllQuantityToTheMainQuanityt();
            }
            else if(primarySellingProductStockQty < 1)
            {
                disabledAddAllQuantityToTheMainQuanityt();
            }
            else
            {
                disabledAddAllQuantityToTheMainQuanityt();
            }
            setTotalCurrentSellingQuantity();
        });

        //over stock processing duration
        function overStockProcessingDuration(sellingStockId)
        {
            jQuery('.regularStockProcessDuration_'+sellingStockId).hide();
            jQuery('.overStockProcessingDiv_'+sellingStockId).show();  
        }
        //regular stock processing duration
        function regularStockProcessingDuration(sellingStockId)
        {
            jQuery('.regularStockProcessDuration_'+sellingStockId).show();
            jQuery('.overStockProcessingDiv_'+sellingStockId).hide();  
        }
        //desabled regular stock processing duration: all fields
        function desibledRegularStockProcessingDuration()
        {
            jQuery('.regularStockProcessDuration').show();
            jQuery('.overStockProcessingDiv').hide();  
        }

        //set total current selling quantity
        function setTotalCurrentSellingQuantity()
        {
            var qty = totalSellingQuantityFromQuantityWiseMoreStock();
            jQuery('.now_current_selling_quantity').text(qty);
            jQuery('.final_sell_quantity').val(qty);
        }

        //total selling quantity from quantity wise more stock
        function totalSellingQuantityFromQuantityWiseMoreStock()
        {
            var total = 0;
            jQuery(".pressingCurrentSellingQuantity").each(function() {
                total += nanCheck(parseFloat(jQuery(this).val()));
            });
            return total;
        }

        function disabledAddAllQuantityToTheMainQuanityt(){
            jQuery('.addThisQuantityToMainQuantity').removeClass('addThisInMainSellingQuantityOfMoreQuantityFromOthersStock btn-dark');
            jQuery('.addThisQuantityToMainQuantity').addClass('btn-danger');
        } 
        function enableAddAllQuantityToTheMainQuanityt(){
            var totalQty = totalSellingQuantityFromQuantityWiseMoreStock();
            if(totalQty > 0)
            {
                jQuery('.addThisQuantityToMainQuantity').addClass('addThisInMainSellingQuantityOfMoreQuantityFromOthersStock btn-dark');
            }else{
                jQuery('.addThisQuantityToMainQuantity').removeClass('addThisInMainSellingQuantityOfMoreQuantityFromOthersStock btn-dark');
                jQuery('.addThisQuantityToMainQuantity').addClass('btn-danger');
            }
        }


        /*
        |-----------------------------------------------------------------------
        | set up more quantity from others stock
        |-----------------------------------------------------------------------
        */
            jQuery(document).on('click','.addThisInMainSellingQuantityOfMoreQuantityFromOthersStock',function(e){
                e.preventDefault();
                var stockIdAndQuantity              = [];
                stockIdAndQuantity['stock_id']      = [];
                stockIdAndQuantity['qty']           = [];
                stockIdAndQuantity['purchasePrice'] = [];
                stockIdAndQuantity['overStockQtyProcessDuration'] = [];
                jQuery('input.checkedCurrentSellingQuantity[type=checkbox]').each(function () {
                    if(this.checked){
                        var id              = jQuery(this).data('id');
                        var purchaseamount  = jQuery(this).data('purchase-price');
                        var quantity        = nanCheck(parseFloat(jQuery('.pressingCurrentSellingQuantity_'+id).val()));
                        var overStockQty    = jQuery('.overStockProcessDuration_'+id+' option:selected').val();
                        if(jQuery(this).data('id') && quantity > 0)
                        {
                            stockIdAndQuantity['stock_id'].push('<input type="hidden" name="product_stock_id[]" value="'+id+'">');
                            stockIdAndQuantity['qty'].push('<input type="hidden" name="product_stock_quantity_'+id+'" value="'+quantity+'">');
                            stockIdAndQuantity['purchasePrice'].push('<input type="hidden" name="product_stock_quantity_purchase_price_'+id+'" value="'+purchaseamount+'">');
                            stockIdAndQuantity['overStockQtyProcessDuration'].push('<input type="hidden" name="over_stock_quantity_process_duration_'+id+'" value="'+overStockQty+'">');
                        }
                    }
                });
                jQuery('.responseOfMoreQtySellingStockId').html(stockIdAndQuantity['stock_id']);
                jQuery('.responseOfMoreStockSellingQuantity').html(stockIdAndQuantity['qty']);
                jQuery('.responseOfMoreStockSellingQuantityPurchasePrice').html(stockIdAndQuantity['purchasePrice']);
                jQuery('.responseOfMoreStockSellingOverStockQtyProcessDuration').html(stockIdAndQuantity['overStockQtyProcessDuration']);
                jQuery('.moreQuantityFromOthersStock').val(1);
                setTotalCurrentSellingQuantity();
                finalCalculationAccordingToSelectedPriceAndFinalSellPrice();
                jQuery('#showQuantityWiseProductStockModal').modal('hide');
            })

            jQuery(document).on('click','.removeMoreQuantityFromOthersStock',function(e){
                e.preventDefault();
                cancelAddMoreQuantityFromOthersStock();
            })

            //cancel all option when cancel/remove quantity
            function cancelAddMoreQuantityFromOthersStock()
            {
                //this part is from more stock quantity popup
                desibledRegularStockProcessingDuration();
                jQuery('.overStockErrorMessage').text("");
                jQuery('.pressingCurrentSellingQuantity').val(0);
                disabledAddAllQuantityToTheMainQuanityt();
                setTotalCurrentSellingQuantity();
                //this part is from more stock quantity popup

                jQuery('.responseOfMoreStockSellingQuantity').html('');
                jQuery('.responseOfMoreStockSellingQuantityPurchasePrice').html('');
                jQuery('.responseOfMoreStockSellingOverStockQtyProcessDuration').html('');
                jQuery('.responseOfMoreQtySellingStockId').html('');
                jQuery('.moreQuantityFromOthersStock').val(0);

                jQuery('.checkedCurrentSellingQuantity').prop('checked',false);
                var previousQty = jQuery('.previous_selling_quantity_value').val();
                jQuery('.final_sell_quantity').val(previousQty);
                finalCalculationAccordingToSelectedPriceAndFinalSellPrice();
            }

            //hide or disabled only add more quantity from others stock related part
            function hideOrDisabledOnlyAddMoreQuantityFromOthersStockRelatedPart()
            {
                jQuery('.responseOfMoreStockSellingQuantity').html('');
                jQuery('.responseOfMoreStockSellingQuantityPurchasePrice').html('');
                jQuery('.responseOfMoreStockSellingOverStockQtyProcessDuration').html('');
                jQuery('.responseOfMoreQtySellingStockId').html('');
                jQuery('.moreQuantityFromOthersStock').val(0);
            }
        /*
        |-----------------------------------------------------------------------
        | set up more quantity from others stock
        |-----------------------------------------------------------------------
        */

    /*
    |-----------------------------------------------------------------------
    | Selling Quantity
    |-----------------------------------------------------------------------
    */

    function nanCheck(value)
    {
        if(isNaN(value))
        {
            return 0;
        }
        else{
            return value;
        }
    }


    /*
    |-----------------------------------------------------------------------
    | enabled disabled addToCart Button
    |-----------------------------------------------------------------------
    */
        function enabledDisabledAddToCartButton()
        {        
            var finalSellingAmount = nanCheck(jQuery('.selling_final_amount_value').val());
            if(finalSellingAmount > 0)
            {
                jQuery('.add_to_cart_button').removeAttr('disabled');
            }else{
                jQuery('.add_to_cart_button').attr('disabled','disabled');
            }
        }
        
        function enabledToCartButton()
        {        
            jQuery('.add_to_cart_button').removeAttr('disabled');
        }
        
        function disabledToCartButton()
        {        
            jQuery('.add_to_cart_button').attr('disabled','disabled');
        }
    /*
    |-----------------------------------------------------------------------
    | enabled disabled addToCart Button
    |-----------------------------------------------------------------------
    */










    /*
        swal({
                title: "Are you sure?",
                text: "Selling price is less then purchase price",
                type: "error",
                showCancelButton: true,
                dangerMode: true,
                cancelButtonClass: '#DD6B55',
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Yes!',
            });
        swal({
            title: "Are you sure?",
            text: "You entered invlid discount amount",
            type: "error",
            showCancelButton: true,
            dangerMode: true,
            cancelButtonClass: '#DD6B55',
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Yes!',
        },function (result) {
            if (result) {
                var action = current_object.attr('data-action');
                var token = jQuery('meta[name="csrf-token"]').attr('content');
                var id = current_object.attr('data-id');

                $('body').html("<form class='form-inline remove-form' method='post' action='"+action+"'></form>");
                $('body').find('.remove-form').append('<input name="_method" type="hidden" value="delete">');
                $('body').find('.remove-form').append('<input name="_token" type="hidden" value="'+token+'">');
                $('body').find('.remove-form').append('<input name="id" type="hidden" value="'+id+'">');
                $('body').find('.remove-form').submit();
            } 
        }); 
    */