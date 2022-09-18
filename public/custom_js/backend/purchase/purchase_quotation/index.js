    
    $(document).ready(function(){
        sellQuotationList();
    });

    function sellQuotationList()
    {
        var url = $('.sellQuotationListUrl').val();
        $.ajax({
            url:url,
            success:function(response){
                if(response.status == true)
                {
                    $('.sellQuotationListAjaxResponseResult').html(response.html);
                }
            }
        });
    }


    $(document).on("click",".pagination li a",function(e){
        e.preventDefault();
        var page = $(this).attr('href');
        var pageNumber = page.split('?page=')[1]; 
        return getPagination(pageNumber);
    });

    function getPagination(pageNumber){
        var createUrl = $('.sellQuotationListUrl').val();
        var url =  createUrl+"?page="+pageNumber;
        $.ajax({
            url: url,
            type: "GET",
            datatype:"HTML",
            success: function(response){
                if(response.status == true)
                {
                    $('.sellQuotationListAjaxResponseResult').html(response.html);
                }
            },
        });
    }
//-----------------------------------------------------------------------




//-----------------------------------------------------------------------
    //search 
    var ctrlDown = false,
    ctrlKey = 17,
    cmdKey = 91,
    vKey = 86,
    cKey = 67;
    xKey = 88;
    $(document).on('keypress keyup','.search',function(e){
        if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
        if (ctrlDown && (e.keyCode == vKey || e.keyCode == cKey || e.keyCode == xKey)) return false;
        var search = $(this).val();
        var url = $('.sellQuotationListUrl').val();
        $.ajax({
            url: url,
            data:{search:search},
            type: "GET",
            datatype:"HTML",
            success: function(response){
                if(response.status == true)
                {
                    $('.sellQuotationListAjaxResponseResult').html(response.html);
                }
            },
        });
    });
//-----------------------------------------------------------------------


//-----------------------------------------------------------------------
    $(document).on('click','.singleSellQuotationView',function(e){
        e.preventDefault();
        var url = $('.singleQuotationViewModalRoute').val();
        var id = $(this).data('id');
        $.ajax({
            url:url,
            data:{id:id},
            success:function(response){
                if(response.status == true)
                {
                    $('#singleQuotationModalView').html(response.html).modal('show');
                }
            }
        });
    });
//-----------------------------------------------------------------------

//-----------------------------------------------------------------------
    $(document).on('click','.singleSellQuotationInvoiceProfitLossView',function(e){
        e.preventDefault();
        var url = $('.singleSellInvoiceProftLossModalRoute').val();
        var id = $(this).data('id');
        $.ajax({
            url:url,
            data:{id:id},
            success:function(response){
                if(response.status == true)
                {
                    $('#singleSellInvoiceProftLossModalView').html(response.html).modal('show');
                }
            }
        });
    });
//-----------------------------------------------------------------------




/* $(document).on('click','.singleDeleteModal',function(e){
    e.preventDefault();
    var id = $(this).data('id');
    var name = $(this).data('name');
    $('.deletingCustomerId').val(id);
    $('.deletingCustomerName').text(name);
    $('#deleteConfirmationModal').modal('show');
});

$(document).on('click','.deletingCustomerButton',function(e){
    e.preventDefault();
    var url = $('.deleteCustomerModalRoute').val();
    var id = $('.deletingCustomerId').val();
    $.ajax({
        url:url,
        data:{id:id},
        success:function(response){
            $('.deletingCustomerId').val('');
            $.notify(response.message, response.type);
            setTimeout(function(){
                sellQuotationList();
                $('#deleteConfirmationModal').modal('hide');//hide modal
            },1000);
        }
    });
}); */

