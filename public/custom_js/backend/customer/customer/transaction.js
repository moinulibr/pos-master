
$(document).ready(function(){
    var url =  $('.customerTransactionalAndStatementUrl').val();
    $.ajax({
        url: url,
        type: "GET",
        datatype:"HTML",
        success: function(response){
            if(response.status == true)
            {
                $('.renderedTransactionalSummary').html(response.transactionalSummary);
                $('.renderedTransactionalStatement').html(response.transactionalStatement);
            }
        },
    });
});


