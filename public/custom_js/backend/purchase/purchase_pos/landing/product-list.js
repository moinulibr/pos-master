

    jQuery(document).ready(function(){
        var url = jQuery('.displayProductListUrl').val();
        jQuery.ajax({
            url:url,
            success:function(response){
                if(response.status == true)
                {
                    jQuery('.display-all-product-list').html(response.html);
                }
            }
        });
    });




    //pagination
        jQuery(document).on("click",".pagination li a",function(e){
            e.preventDefault();
            var page = jQuery(this).attr('href');
            var pageNumber = page.split('?page=')[1]; 
            return getPagination(pageNumber);
        });//split == delete some things...
        function getPagination(pageNumber){
            var createUrl = jQuery('.displayProductListUrl').val();
            var url =  createUrl+"?page="+pageNumber;
            var product_id      = jQuery('.product_id').val();
            var category_id     = jQuery('.category_id').val();
            var custom_search   = jQuery('.custom_search').val();
            jQuery.ajax({
                url: url,
                type: "GET",
                datatype:"HTML",
                data:{
                    custom_search:custom_search,product_id:product_id,category_id:category_id
                },
                beforeSend:function(){
                    jQuery('.processing_on').fadeIn();
                },
                success: function(response){
                    if(response.status == true)
                    {
                        jQuery('.display-all-product-list').html(response.html);
                    }
                },
                complete:function(){
                    jQuery('.processing_on').fadeOut();
                },
            });
        }
    //pagination


    var ctrlDown = false,ctrlKey = 17,cmdKey = 91,vKey = 86,cKey = 67; xKey = 88;
    jQuery(document).on('change keyup click','.paginate,.custom_search,.product_id,.category_id',function(e){
        
        var action = 0;
        if(jQuery(e.target).prop("name") == "product_id" && ((e.type)=='change'))
        {
            action = 1;
        }
        else if(jQuery(e.target).prop("name") == "category_id" && ((e.type)=='change'))
        {
            action = 1;
        } 
        else if(jQuery(e.target).prop("class") == "paginate" && ((e.type)=='change'))
        {
            action = 1;
        } 
        else if(jQuery(e.target).prop("name") == "custom_search" && ((e.type)=='keyup'))
        {
            action = 1;
        }
        else if(jQuery(e.target).prop("name") == "custom_search" && ((e.type)=='click'))
        {
            action = 0;
        }
        else{
            action = 0;
        }
        if(action == 0) return;
        if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
        if (ctrlDown && ( e.keyCode == vKey || e.keyCode == cKey || e.keyCode == xKey)) return false;
        var defaultUrl      = jQuery('.displayProductListUrl').val();
        //var pagination      = jQuery('#paginate :selected').val();
        var product_id      = jQuery('.product_id').val();
        var category_id     = jQuery('.category_id').val();
        var custom_search   = jQuery('.custom_search').val();
        jQuery.ajax({
            url: defaultUrl,
            type: "GET",
            datatype:"HTML",
            data:{
                custom_search:custom_search,product_id:product_id,category_id:category_id
            },
            beforeSend:function(){
                jQuery('.processing_on').fadeIn();
            },
            success: function(response){
                jQuery('.display-all-product-list').html(response.html);
            },
            complete:function(){
                jQuery('.processing_on').fadeOut();
            },
        });
    });




 