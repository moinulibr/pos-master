
    //input field protected .. only for numeric
    $(document).on('keyup keypress','.inputFieldValidateWithNumber',function(e){
        if (String.fromCharCode(e.keyCode).match(/[^0-9\.]/g)) return false;
        /* var charCode = (e.which) ? e.which : event.keyCode    
        if (String.fromCharCode(charCode).match(/[^0-9\.]/g))    
            return false; */ 
        //if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
        //if (String.fromCharCode(e.keyCode).match(/[^1-9\./g)) return false;
    });
    //<input name="number" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
    
//-----------------------------------------------------------------------------------------

    $(document).on('click','.singlePriceEditModal',function(e){
        e.preventDefault();
        var url = $('.editProductPriceModalRoute').val();
        var id = $(this).data('id');
        $.ajax({
            url:url,
            data:{id:id},
            success:function(response){
                if(response.status == true)
                {
                    $('#editProductPriceModal').html(response.data).modal('show');
                }
            }
        });
    });
    $('#editProductPriceModal').css('overflow-y', 'auto');

    $(document).on("submit",'.updateAllProductPrice',function(e){
        e.preventDefault();
        var form = $(this);
        var url = form.attr("action");
        var type = form.attr("method");
        var data = form.serialize();
        $('.color-red').text('');
        $.ajax({
            url: url,
            data: data,
            type: type,
            datatype:"JSON",
            beforeSend:function(){
                $('.processing').fadeIn();
            },
            success: function(response){
                if(response.status == true)
                {
                    $.notify(response.message, response.type);
                    form[0].reset();
                    setTimeout(function(){
                        productList();
                        $('#editProductPriceModal').modal('hide');//hide modal
                    },1000);
                }
            },
            complete:function(){
                $('.processing').fadeOut();
            },
        });
        //end ajax
    });