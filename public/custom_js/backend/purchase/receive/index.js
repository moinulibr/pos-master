
   /*
    |--------------------------------------------------------
    | input field protected .. only for numeric
    |--------------------------------------------------------
    */
        jQuery(document).on('keyup keypress','.inputFieldValidatedOnlyNumeric',function(e){
            if (String.fromCharCode(e.keyCode).match(/[^0-9\.]/g)) return false;
        });


//-----------------------------------------------------------------------
    $(document).on('click','.singlePurchaseInvoiceWiseReceiveProduct',function(e){
        e.preventDefault();
        var url = $('.purchaseProductReceiveInvoiceWiseModalRoute').val();
        var id = $(this).data('id');
        $.ajax({
            url:url,
            data:{id:id},
            success:function(response){
                if(response.status == true)
                {
                    $('#purchaseProductReceiveInvoiceWiseModal').html(response.html).modal('show');
                    $('.product_related_response_here').html(response.product);
                }
            }
        });
    });
//-----------------------------------------------------------------------


    $(document).on('keyup','.deliverying_qty',function(){
        var id = $(this).data('id');
        var pressingVal = $(this).val();
        
        var deliveryingQtyNow = checkAndUncheckItemQuantity(id);

        var finalDeliveryQty = 0;
        if(deliveryingQtyNow >= pressingVal)
        {
            finalDeliveryQty = pressingVal;
        }else{
            finalDeliveryQty = deliveryingQtyNow;
        }
        $('.deliverying_qty_'+id).val(finalDeliveryQty);

        if(finalDeliveryQty == 0)
        {
            $('.check_single_class_'+id).prop('checked', false).change();
            $('.check_single_class_'+id).val('').change();
        }else{
            $('.check_single_class_'+id).prop("checked", true).change();
            $('.check_single_class_'+id).val(id).change();
        }

    });


    // checked all order list 
    $(document).on('click','.check_all_class',function()
    {
        if (this.checked == false)
        {   
            $('.check_single_class').prop('checked', false).change();
            $(".check_single_class").each(function ()
            {
                var id = $(this).attr('id');
                $(this).val('').change();
                $('.deliverying_qty_'+id).val(0);
            });
        }
        else
        {
            $('.check_single_class').prop("checked", true).change();

            $(".check_single_class").each(function ()
            {
                var id = $(this).attr('id');
                //$(this).val(id).change();

                var deliveryingQtyNow = checkAndUncheckItemQuantity(id);
                $('.deliverying_qty_'+id).val(deliveryingQtyNow);

                if(deliveryingQtyNow == 0)
                {
                    $(this).prop('checked', false).change();
                    $(this).val('').change();
                }else{
                    $(this).prop("checked", true).change();
                    $(this).val(id).change();
                }

            });

           /*  $(".check_single_class").each(function ()
            {
                var id = $(this).attr('id');
                $(this).val(id).change();
            }); */
        }
    });
    // checked all order list 

    
    //check single order list
        $(document).on('click','.check_single_class',function()
        {
            var $b = $('input[type=checkbox]');
            if($b.filter(':checked').length <= 0)
            {
                $('.check_all_class').prop('checked', false).change();
                $('.deliverying_qty').val(0);
            }

            var id = $(this).attr('id');
            if (this.checked == false)
            {
                $(this).prop('checked', false).change();
                $(this).val('').change();
                $('.deliverying_qty_'+id).val(0);
            }else{
                var deliveryingQtyNow = checkAndUncheckItemQuantity(id);
                $('.deliverying_qty_'+id).val(deliveryingQtyNow);
                
                if(deliveryingQtyNow == 0)
                {
                    $(this).prop('checked', false).change();
                    $(this).val('').change();
                }else{
                    $(this).prop("checked", true).change();
                    $(this).val(id).change();
                }
            }
            
            var ids = [];
            $('input.check_single_class[type=checkbox]').each(function () {
                if(this.checked){
                    var v = $(this).val();
                    ids.push(v);
                }
            });
            if(ids.length <= 0)
            {
                $('.check_all_class').prop('checked', false).change();
            }
        });
    //check single order list

    function checkAndUncheckItemQuantity(id)
    {
        var remainingDeliveryQty = parseFloat($('.total_remaining_delivery_qty_'+id).val());
        var totalStockQtyWRBND = parseFloat($('.total_base_available_stock_WRBND_qty_'+id).val());
        
        var deliveryingQtyNow = 0;
        if((totalStockQtyWRBND > remainingDeliveryQty) 
            && (remainingDeliveryQty > 0) 
        )
        {
            deliveryingQtyNow = remainingDeliveryQty; 
        }
        else if((totalStockQtyWRBND == remainingDeliveryQty) 
            && (remainingDeliveryQty > 0) 
        )
        {
            deliveryingQtyNow = remainingDeliveryQty; 
        }
        else if((totalStockQtyWRBND < remainingDeliveryQty)
            && (remainingDeliveryQty > 0) 
        )
        {
            deliveryingQtyNow = totalStockQtyWRBND; 
        }
        else if(remainingDeliveryQty == 0) 
        {
            deliveryingQtyNow = 0; 
        }else{
            deliveryingQtyNow = 0; 
        }
        return deliveryingQtyNow; 
    }



    jQuery(document).on("submit",'.storeReceivingDataFromPurchaseProductReceiveOption',function(e){
        e.preventDefault();
        $('.alert_success_message_div').hide();
        $('.success_message_text').text('');
        $('.alert_danger_message_div').hide();
        $('.danger_message_text').text('');

        var form = jQuery(this);
        var url = form.attr("action");
        var type = form.attr("method");
        var data = form.serialize();
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
                    $('.product_related_response_here').html(response.product);
                    $('.alert_success_message_div').show();
                    $('.success_message_text').html(response.message+"<br/>"+response.print);
                }else{
                    $('.alert_danger_message_div').show();
                    $('.danger_message_text').text(response.message);
                }
                jQuery.notify(response.message, response.type);
            },
            complete:function(){
                jQuery('.processing').fadeOut();
            },
        });
        //end ajax
    });

