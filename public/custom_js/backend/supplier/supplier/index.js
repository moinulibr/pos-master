    
    $(document).ready(function(){
        supplierList();
    });

    function supplierList()
    {
        var url = $('.supplierListUrl').val();
        $.ajax({
            url:url,
            success:function(response){
                if(response.status == true)
                {
                    $('.supplierListAjaxResponseResult').html(response.html);
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
        var createUrl = $('.supplierListUrl').val();
        var url =  createUrl+"?page="+pageNumber;
        $.ajax({
            url: url,
            type: "GET",
            datatype:"HTML",
            success: function(response){
                if(response.status == true)
                {
                    $('.supplierListAjaxResponseResult').html(response.html);
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
$(document).on('keyup change','.search,.filter_supplier_type_id',function(e){
    if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
    if (ctrlDown && (e.keyCode == vKey || e.keyCode == cKey || e.keyCode == xKey)) return false;
    var search = $('.search').val();
    var url = $('.supplierListUrl').val();
    var supplier_type_id = $('.filter_supplier_type_id :selected').val();
    $.ajax({
        url: url,
        data:{search:search,supplier_type_id:supplier_type_id},
        type: "GET",
        datatype:"HTML",
        success: function(response){
            if(response.status == true)
            {
                $('.supplierListAjaxResponseResult').html(response.html);
            }
        },
    });
});
//-----------------------------------------------------------------------

 

$(document).on('click','.singleDeleteModal',function(e){
    e.preventDefault();
    var id = $(this).data('id');
    var name = $(this).data('name');
    $('.deletingSupplierId').val(id);
    $('.deletingSupplierName').text(name);
    $('#deleteConfirmationModal').modal('show');
});

$(document).on('click','.deletingSupplierButton',function(e){
    e.preventDefault();
    var url = $('.deleteSupplierModalRoute').val();
    var id = $('.deletingSupplierId').val();
    $.ajax({
        url:url,
        data:{id:id},
        success:function(response){
            $('.deletingSupplierId').val('');
            $.notify(response.message, response.type);
            setTimeout(function(){
                supplierList();
                $('#deleteConfirmationModal').modal('hide');//hide modal
            },1000);
        }
    });
});

