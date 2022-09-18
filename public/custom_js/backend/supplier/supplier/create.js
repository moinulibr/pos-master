
    $(document).on('click','.addSupplierModal',function(){
        var url = $('.addSupplierModalRoute').val();

        /*
        |-----------------------------------------------
        | check create from attribute data and get value
        |----------------------------------------------
        */
            var addCreateFromValue  = "regular";
            var addedCreateFromclassName    = "";
            if (typeof $(this).data('create_from_value') !== 'undefined') 
            {
                addCreateFromValue       = $(this).data('create_from_value');
                addedCreateFromclassName = $(this).data('class_name');
            }
        /*
        |-----------------------------------------------
        | check create from attribute data and get value
        |----------------------------------------------
        */

        $.ajax({
            url:url,
            success:function(response){
                $('#addSupplierModal').html(response).modal('show');
               
                /*
                |-------------------------------------
                | set create from value in the modal
                |-------------------------------------
                */
                    $('.create_from').val(addCreateFromValue);
                    $('.created_from_class_name').val(addedCreateFromclassName);
                /*
                |-------------------------------------
                | set create from value in the modal
                |-------------------------------------
                */
            }
        });
    });

    $(document).on("submit",'.storeSupplierData',function(e){
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
                if(response.status == 'errors')
                {   
                    printErrorMsg(response.error);
                }
                else if(response.status == true)
                {
                    $.notify(response.message, response.type);
                    form[0].reset();
                    setTimeout(function(){
                        //for regular process
                        if(response.create_from == "regular")
                        {
                            supplierList();
                        }
                        //for regular process
                        $('#addSupplierModal').modal('hide');//hide modal
                    },1000);

                    //for added from another page or another place
                    if((response.create_from != "regular") && (response.data_created_class_name != ""))
                    {
                        $('.'+response.data_created_class_name).append('<option value='+response.data_id+' selected="selected">'+response.data_name+'</option>');
                    }
                    //for added from another page or another place
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