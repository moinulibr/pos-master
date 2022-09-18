
    $(document).on('click','.singleEditModal',function(e){
        e.preventDefault();
        var url = $('.editBrandModalRoute').val();
        var id = $(this).data('id');
        $.ajax({
            url:url,
            data:{id:id},
            success:function(response){
                $('#editBrandModal').html(response).modal('show');
            }
        });
    });

    $(document).on("submit",'.updateBrandData',function(e){
        e.preventDefault();
        //spinner-border spinner-border-sm
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
                    //$('#addBrandModal').html(response).modal('hide');
                    setTimeout(function(){
                        brandList();
                        $('#editBrandModal').modal('hide');//hide modal
                    },1000);

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