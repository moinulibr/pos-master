@extends('layouts.backend.app')
@section('page_title') Purchase @endsection
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
            <h4 class="font-weight-bold py-3 mb-0">Purchase  </h4>
            <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#"><i class="feather icon-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Purchase</li>
                    <li class="breadcrumb-item active">All Purchase</li>
                </ol>
            </div>
            <div class="products">
                <a href="{{route('admin.purchase.regular.pos.create')}}" target="_blank" class="addPurchaseModal">Add Purchase</a>
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
            <div class="purchaseListAjaxResponseResult">

                @include('backend.purchase.purchase_details.partial.list')

            </div>
            <!-------responsive table------> 

            

            <!-------single purchase view Modal------> 
            <div class="modal fade " id="singleModalView"  aria-modal="true"></div>
            <input type="hidden" class="singleViewModalRoute" value="{{ route('admin.purchase.regular.purchase.single.view') }}">
            <!-------single purchase view Modal------> 
           
            

            <!-------purchase product receive Modal------> 
            <div class="modal fade " id="purchaseProductReceiveInvoiceWiseModal"  aria-modal="true"></div>
            <input type="hidden" class="purchaseProductReceiveInvoiceWiseModalRoute" value="{{route('admin.purchase.product.receive.invoice.wise.list.index')}}">
            <!-------purchase product receive Modal------> 


            <!-------purchase receive payment Modal------> 
            <div class="modal fade " id="purchaseViewSingleInvoiceMakePaymentModal"  aria-modal="true"></div>
            <input type="hidden" class="purchaseViewSingleInvoiceMakePaymentModalRoute" value="{{route('admin.purchase.regular.purchase.view.single.invoice.make.payment.modal')}}">
            <input type="hidden" class="paymentBankingOptionUrl" value="{{route('admin.payment.common.banking.option.data')}}">
            <!-------purchase receive payment Modal------> 

            <!-------purchase receive payment Modal------> 
            <div class="modal fade " id="purchaseViewSingleInvoiceWisePaymentModal"  aria-modal="true"></div>
            <input type="hidden" class="purchaseViewSingleInvoiceWisePaymentModalRoute" value="{{route('admin.purchase.regular.purchase.view.single.invoice.wise.payment.details.modal')}}">
            <!-------purchase receive payment Modal------> 

           {{--  <!-------delete Customer Modal------> 
            @include('backend.customer.customer.partial.delete_modal')
            <input type="hidden" class="deleteCustomerModalRoute" value="{{ route('admin.customer.delete') }}">
            <!-------delete Customer Modal------> --}} 
            



        
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


    {{--purchase list url --}}
    <input type="hidden" class="purchaseListUrl" value="{{route('admin.purchase.regular.purchase.list.ajaxresponse')}}">
    {{--purchase list url --}}
    


<!--=================js=================-->
@push('js')
<!--=================js=================-->
<script src="{{asset('custom_js/backend')}}/purchase/purchase_details/index.js?v=1"></script>
<script src="{{asset('custom_js/backend')}}/purchase/receive/index.js?v=1"></script>
<script src="{{asset('custom_js/backend')}}/purchase/purchase_payment/payment.js?v=1"></script>



    
<!--=================js=================-->
@endpush
<!--=================js=================-->



<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%^^^^Content^^^^%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
@endsection
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%^^^^Content^^^^%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
