
    jQuery(document).on('click','.addReferenceModal',function(){
        var url = jQuery('.addReferenceModalRoute').val();
        
        /*
        |-----------------------------------------------
        | check create from attribute data and get value
        |----------------------------------------------
        */
            var addCreateFromValue  = "regular";
            var addedCreateFromclassName    = "";
            if (typeof jQuery(this).data('create_from_value') !== 'undefined') 
            {
                addCreateFromValue       = jQuery(this).data('create_from_value');
                addedCreateFromclassName = jQuery(this).data('class_name');
            }
        /*
        |-----------------------------------------------
        | check create from attribute data and get value
        |----------------------------------------------
        */

        jQuery.ajax({
            url:url,
            success:function(response){
                jQuery('#addReferenceModal').html(response).modal('show');
                 
                /*
                |-------------------------------------
                | set create from value in the modal
                |-------------------------------------
                */
                    jQuery('.create_from').val(addCreateFromValue);
                    jQuery('.created_from_class_name').val(addedCreateFromclassName);
                /*
                |-------------------------------------
                | set create from value in the modal
                |-------------------------------------
                */
               
            }
        });
    });

    jQuery(document).on("submit",'.storeReferenceData',function(e){
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
                //console.log(response) 
                if(response.status == 'errors')
                {   
                    printErrorMsg(response.error);
                }
                else if(response.status == true)
                {
                    jQuery.notify(response.message, response.type);
                    form[0].reset();
                    //jQuery('#addReferenceModal').html(response).modal('hide');
                    setTimeout(function(){
                        //for regular process
                        if(response.create_from == "regular")
                        {
                            referenceList();
                        }
                        //for regular process
                        jQuery('#addReferenceModal').modal('hide');//hide modal
                    },1000);

                    //for added from another page or another place
                    if((response.create_from != "regular") && (response.data_created_class_name != ""))
                    {
                        jQuery('.'+response.data_created_class_name).append('<option value='+response.data_id+' selected="selected">'+response.data_name+'</option>');
                    }
                    //for added from another page or another place
                    /* jQuery('.Reference_id').append('<option value='+response.data_id+' selected="selected">'+response.data_name+'</option>');
                    jQuery('#add-Reference').modal("hide"); */
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
                            jQuery(".Reference_id").html(html);
                            jQuery('#add-Reference').modal("hide");
                            form[0].reset();  //this for after completing processed, the all data of form will be clear.. like reset
                        } 
                    */
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