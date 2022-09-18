    
    $(document).ready(function(){
        productGradeList();
    });

    function productGradeList()
    {
        var url = $('.productGradeListUrl').val();
        $.ajax({
            url:url,
            success:function(response){
                if(response.status == true)
                {
                    $('.productGradeListAjaxResponseResult').html(response.html);
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
        var createUrl = $('.productGradeListUrl').val();
        var url =  createUrl+"?page="+pageNumber;
        $.ajax({
            url: url,
            type: "GET",
            datatype:"HTML",
            success: function(response){
                if(response.status == true)
                {
                    $('.productGradeListAjaxResponseResult').html(response.html);
                }
            },
        });
    }
//-----------------------------------------------------------------------




$(document).on('click','.singleDeleteModal',function(e){
    e.preventDefault();
    var id = $(this).data('id');
    var name = $(this).data('name');
    $('.deletingProductGradeId').val(id);
    $('.deletingProductGradeName').text(name);
    $('#deleteConfirmationModal').modal('show');
});

$(document).on('click','.deletingProductGradeButton',function(e){
    e.preventDefault();
    var url = $('.deleteProductGradeModalRoute').val();
    var id = $('.deletingProductGradeId').val();
    $.ajax({
        url:url,
        data:{id:id},
        success:function(response){
            $('.deletingProductGradeId').val('');
            $.notify(response.message, response.type);
            setTimeout(function(){
                productGradeList();
                $('#deleteConfirmationModal').modal('hide');//hide modal
            },1000);
        }
    });
});

