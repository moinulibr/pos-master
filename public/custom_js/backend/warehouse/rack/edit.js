
    $(document).on('click','.singleEditModal',function(e){
        e.preventDefault();
        var url = $('.editWarehouseRackModalRoute').val();
        var id = $(this).data('id');
        $.ajax({
            url:url,
            data:{id:id},
            success:function(response){
                $('#editWarehouseRackModal').html(response).modal('show');
            }
        });
    });

    $(document).on("submit",'.updateWarehouseRackData',function(e){
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
                    //$('#addWarehouseRackModal').html(response).modal('hide');
                    setTimeout(function(){
                        warehouseRackList();
                        $('#editWarehouseRackModal').modal('hide');//hide modal
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