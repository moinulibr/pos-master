
$(document).ready(function(){
    customerList();
});

function customerList()
{
    var url =  $('.customerTransactionalAndStatementUrl').val();
    var id =  $('.customer_id').val();
    $.ajax({
        url: url,
        data:{id:id},
        type: "GET",
        datatype:"HTML",
        beforeSend:function(){
            $('.processing').fadeIn();
        },
        success: function(response){
            if(response.status == true)
            {
                $('.renderedTransactionalSummary').html(response.transactionalSummary);
                $('.renderedTransactionalStatement').html(response.transactionalStatement);
            }
        },
        complete:function(){
            $('.processing').fadeOut();
        },
    });
}




