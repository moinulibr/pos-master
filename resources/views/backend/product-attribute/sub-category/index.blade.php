@extends('layouts.backend.app')
@section('page_title') Sub-category @endsection
@push('css')
<style>

</style>
@endpush



<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%^^^^Content^^^^%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
@section('content')
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%^^^^Content^^^^%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->


    <!--**************************************-->
    <!--*********^page title content^*********-->
    <!---page_title_of_content-->    
    @push('page_title_of_content')
        <div class="breadcrumbs layout-navbar-fixed">
            <h4 class="font-weight-bold py-3 mb-0">Sub-category  </h4>
            <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#"><i class="feather icon-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Sub-category</li>
                    <li class="breadcrumb-item active">All Sub-category</li>
                </ol>
            </div>
            <div class="products">
                <a href="#" class="addSubCategoryModal">Add Sub-category</a>
            </div>
        </div>
    @endpush
    <!--*********^page title content^*********-->
    <!--**************************************-->



    <!--#################################################################################-->
    <!--######################^^total content space for this page^^######################-->    
    <div  class="content_space_for_page">
    <!--######################^^total content space for this page^^######################--> 
    <!--#################################################################################-->


        <!-------status message content space for this page------> 
        <div class="status_message_in_content_space">
            @include('layouts.backend.partial.success_error_status_message')
        </div>
        <!-------status message content space for this page------> 


        

        <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
        <!--@@@@@@@@@@@@@@@@@@@@@@@^^^real space in content^^^@@@@@@@@@@@@@@@@@@@@@@@--> 
        <div class="real_space_in_content">
        <!-------real space in content------> 
        <!--@@@@@@@@@@@@@@@@@@@@@@@^^^real space in content^^^@@@@@@@@@@@@@@@@@@@@@@@-->     
        <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->   
        


            <div class="row" style="margin-bottom: 5px;">
                <div class="col-8"></div>
                <div class="col-4">
                    <input type="text" class="form-control search" style="border:1px solid #d2d4d5;" placeholder="Search" autofocus>
                </div>
            </div>
            <!-------responsive table------> 
            <div class="subCategoryListAjaxResponseResult">

                @include('backend.product-attribute.sub-category.partial.list')

            </div>
            <!-------responsive table------> 

            

            <!-------add SubCategory Modal------> 
            <div class="modal fade " id="addSubCategoryModal"  aria-modal="true"></div>
            <input type="hidden" class="addSubCategoryModalRoute" value="{{ route('admin.subcategory.create') }}">
            <!-------add SubCategory Modal------> 
            

            <!-------edit SubCategory Modal------> 
            <div class="modal fade " id="editSubCategoryModal"  aria-modal="true"></div>
            <input type="hidden" class="editSubCategoryModalRoute" value="{{ route('admin.subcategory.edit') }}">
            <!-------edit SubCategory Modal------> 


            <!-------delete SubCategory Modal------> 
            @include('backend.product-attribute.sub-category.partial.delete_modal')
            <input type="hidden" class="deleteSubCategoryModalRoute" value="{{ route('admin.subcategory.delete') }}">
            <!-------delete SubCategory Modal------> 
            



        
        <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
        <!--@@@@@@@@@@@@@@@@@@@@@@@^^^real space in content^^^@@@@@@@@@@@@@@@@@@@@@@@-->     
        </div>
        <!--real space in content--> 
        <!--@@@@@@@@@@@@@@@@@@@@@@@^^^real space in content^^^@@@@@@@@@@@@@@@@@@@@@@@--> 
        <!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->

    


    <!--#################################################################################-->
    <!--######################^^total content space for this page^^######################-->  
    </div>
    <!--######################^^total content space for this page^^######################--> 
    <!--#################################################################################-->


    {{--SubCategory list url --}}
    <input type="hidden" class="subCategoryListUrl" value="{{route('admin.subcategory.list.ajaxresponse')}}">
    {{--SubCategory list url --}}

<!--=================js=================-->
@push('js')
<!--=================js=================-->
<script src="{{asset('custom_js/backend')}}/product-attribute/sub-category/index.js?v=1"></script>
<script src="{{asset('custom_js/backend')}}/product-attribute/sub-category/create.js?v=2"></script>
<script src="{{asset('custom_js/backend')}}/product-attribute/sub-category/edit.js?v=3"></script>



    
<!--=================js=================-->
@endpush
<!--=================js=================-->



<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%^^^^Content^^^^%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
@endsection
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%^^^^Content^^^^%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
