    
    $(document).ready(function(){
        brandList();
    });

    function brandList()
    {
        var url = $('.brandListUrl').val();
        $.ajax({
            url:url,
            success:function(response){
                if(response.status == true)
                {
                    $('.brandListAjaxResponseResult').html(response.html);
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
        var createUrl = $('.brandListUrl').val();
        var url =  createUrl+"?page="+pageNumber;
        $.ajax({
            url: url,
            type: "GET",
            datatype:"HTML",
            success: function(response){
                if(response.status == true)
                {
                    $('.brandListAjaxResponseResult').html(response.html);
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
$(document).on('keyup','.search',function(e){
    if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
    if (ctrlDown && (e.keyCode == vKey || e.keyCode == cKey || e.keyCode == xKey)) return false;
    var search = $(this).val();
    var url = $('.brandListUrl').val();
    $.ajax({
        url: url,
        data:{search:search},
        type: "GET",
        datatype:"HTML",
        success: function(response){
            if(response.status == true)
            {
                $('.brandListAjaxResponseResult').html(response.html);
            }
        },
    });
});
//-----------------------------------------------------------------------




$(document).on('click','.singleDeleteModal',function(e){
    e.preventDefault();
    var id = $(this).data('id');
    var name = $(this).data('name');
    $('.deletingBrandId').val(id);
    $('.deletingBrandName').text(name);
    $('#deleteConfirmationModal').modal('show');
});

$(document).on('click','.deletingBrandButton',function(e){
    e.preventDefault();
    var url = $('.deleteBrandModalRoute').val();
    var id = $('.deletingBrandId').val();
    $.ajax({
        url:url,
        data:{id:id},
        success:function(response){
            $('.deletingBrandId').val('');
            $.notify(response.message, response.type);
            setTimeout(function(){
                brandList();
                $('#deleteConfirmationModal').modal('hide');//hide modal
            },1000);
        }
    });
});

