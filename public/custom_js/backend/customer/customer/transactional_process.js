
    //add next payment date
    $(document).on('click','.singleNextPaymentDateModal',function(e){
        e.preventDefault();
        var url = $('.renderNextPaymentDateModalRoute').val();
        var id = $(this).data('id');
        $.ajax({
            url:url,
            data:{id:id},
            success:function(response){
                $('#renderNextPaymentDateModal').html(response.view).modal('show');//hide modal
            }
        });
    });

    jQuery(document).on("submit",'.storeNextPaymentDate',function(e){
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
                    jQuery.notify(response.message, response.type);
                    form[0].reset();
                    customerList();
                    setTimeout(function(){
                        jQuery('#renderNextPaymentDateModal').modal('hide');//hide modal
                    },1000);
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


    
    //-------------------------------------------------
    //add loan moal
    $(document).on('click','.singleAddLoanModal',function(e){
        e.preventDefault();
        var url = $('.renderAddLoanModalRoute').val();
        var id = $(this).data('id');
        $.ajax({
            url:url,
            data:{id:id},
            success:function(response){
                $('#renderAddLoanModal').html(response.view).modal('show');//hide modal
            }
        });
    });

    jQuery(document).on("submit",'.storeAddLoanDate',function(e){
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
                    jQuery.notify(response.message, response.type);
                    form[0].reset();
                    customerList();
                    setTimeout(function(){
                        jQuery('#renderAddLoanModal').modal('hide');//hide modal
                    },1000);
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

 
    //-------------------------------------------------
    //add add advance modal
    $(document).on('click','.singleAddAdvanceModal',function(e){
        e.preventDefault();
        var url = $('.renderAddAdvanceModalRoute').val();
        var id = $(this).data('id');
        $.ajax({
            url:url,
            data:{id:id},
            success:function(response){
                $('#renderAddAdvanceModal').html(response.view).modal('show');//hide modal
            }
        });
    });

    jQuery(document).on("submit",'.storeAddAdvanceDate',function(e){
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
                    jQuery.notify(response.message, response.type);
                    form[0].reset();
                    customerList();
                    setTimeout(function(){
                        jQuery('#renderAddAdvanceModal').modal('hide');//hide modal
                    },1000);
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


    //-------------------------------------------------
    //receive previous due modal
    $(document).on('click','.singleReceivePreviousDueModal',function(e){
        e.preventDefault();
        var url = $('.renderReceivePreviousDueModalRoute').val();
        var id = $(this).data('id');
        $.ajax({
            url:url,
            data:{id:id},
            success:function(response){
                $('#renderReceivePreviousDueModal').html(response.view).modal('show');//hide modal
            }
        });
    });

    jQuery(document).on("submit",'.storeReceivePreviousDueDate',function(e){
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
                    jQuery.notify(response.message, response.type);
                    form[0].reset();
                    customerList();
                    setTimeout(function(){
                        jQuery('#renderReceivePreviousDueModal').modal('hide');//hide modal
                    },1000);
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

