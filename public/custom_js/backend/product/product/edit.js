

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

    $(document).on('click','.singleEditModal',function(e){
        e.preventDefault();
        var url = $('.editProductModalRoute').val();
        var id = $(this).data('id');
        $.ajax({
            url:url,
            data:{id:id},
            success:function(response){
                $('#editProductModal').html(response).modal('show');
            }
        });
    });
    $('#editProductModal').css('overflow-y', 'auto');
    $(document).on("submit",'.updateProductData',function(e){
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
                //console.log(response) 
                if(response.status == 'errors')
                {   
                    printErrorMsg(response.error);
                }
                else if(response.status == true)
                {
                    $.notify(response.message, response.type);
                    form[0].reset();
                    //$('#addProductModal').html(response).modal('hide');
                    setTimeout(function(){
                        productList();
                        $('#editProductModal').modal('hide');//hide modal
                    },1000);
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