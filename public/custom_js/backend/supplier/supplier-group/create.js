
    $(document).on('click','.addSupplierGroupModal',function(){
        var url = $('.addSupplierGroupModalRoute').val();
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
                $('#addSupplierGroupModal').html(response).modal('show');
                
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

    $(document).on("submit",'.storeSupplierGroupData',function(e){
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
                //console.log(response) 
                if(response.status == 'errors')
                {   
                    printErrorMsg(response.error);
                }
                else if(response.status == true)
                {
                    $.notify(response.message, response.type);
                    form[0].reset();
                    //$('#addSupplierGroupModal').html(response).modal('hide');
                    setTimeout(function(){
                        //for regular process
                        if(response.create_from == "regular")
                        {
                            supplierGroupList();// regular
                        }
                        //for regular process
                        $('#addSupplierGroupModal').modal('hide');//hide modal
                    },1000);

                     //for added from another page or another place
                     if((response.create_from != "regular") && (response.data_created_class_name != ""))
                     {
                        $('.'+response.data_created_class_name).append('<option value='+response.data_id+' selected="selected">'+response.data_name+'</option>');
                     }
                     //for added from another page or another place

                    /* $('.customer_id').append('<option value='+response.data_id+' selected="selected">'+response.data_name+'</option>');
                    $('#add-customer').modal("hide"); */
                    /* //This is also working perfect , 
                        var len = 0;
                        if(response['data'] != null){
                            len = response['data'].length;
                        }

                        if(len > 0){
                            // Read data and create <option >
                            var html = '';
                            for(var i=0; i<len; i++){
                                var id      = response['data'][i].id;
                                var name    = response['data'][i].name;
                                html += "<option value='"+id+"'>"+name+"</option>";
                            }
                            $(".customer_id").html(html);
                            $('#add-customer').modal("hide");
                            form[0].reset();  //this for after completing processed, the all data of form will be clear.. like reset
                        } 
                    */
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