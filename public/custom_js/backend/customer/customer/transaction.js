
$(document).ready(function(){
    var url =  $('.customerTransactionalAndStatementUrl').val();
    $.ajax({
        url: url,
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
});


