
$(document).on('click','.singleSellInvoiceReceivePaymentModalView',function(e){
    e.preventDefault();
    var url = $('.sellViewSingleInvoiceReceivePaymentModalRoute').val();
    var id = $(this).data('id');
    $.ajax({
        url:url,
        data:{id:id},
        success:function(response){
            if(response.status == true)
            {
                $('#sellViewSingleInvoiceReceivePaymentModal').html(response.html).modal('show');
            }
        }
    });
});