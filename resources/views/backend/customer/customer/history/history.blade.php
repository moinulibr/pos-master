@extends('layouts.backend.app')
@section('page_title') Customer @endsection
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
            <h4 class="font-weight-bold py-3 mb-0">Customers</h4>
            <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#"><i class="feather icon-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Customer</li>
                    <li class="breadcrumb-item active">Customer & History</li>
                </ol>
            </div>
            <div class="">
                <a href="#" class=""></a>
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
        


            {{-- <div class="row" style="margin-bottom: 5px;">
                <div class="col-8"></div>
                <div class="col-4">
                    <input type="text" class="form-control search" style="border:1px solid #d2d4d5;" placeholder="Search" autofocus>
                </div>
            </div> --}}
            
            <!-------responsive table------> 
            <div class="customerListAjaxResponseResult">

                {{-- @include('backend.customer.customer.partial.list') --}}


                <!------------------------------->
              
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center">Basic Information</h4>
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover">
                                        <tbody>
                                            <tr>
                                                <th>Customer ID</th>
                                                <td>1</td>
            
                                                <th>User ID</th>
                                                <td>1001</td>
                                            </tr>
                                            <tr>
                                                <th>Customer Name</th>
                                                <td>Md  Abu Taleb</td>
            
                                                <th>Phone</th>
                                                <td>
                                                    01779325718 <br>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Customer Email</th>
                                                <td></td>
            
                                                <th>Address</th>
                                                <td>Dhaka</td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Next payment date</th>
                                                <td>
                                                    12-12-2022
                                                </td>
                                                <th>
                                                    Account Create Date <br>
                                                </th>
                                                <td>
                                                    16-04-2022
                                                </td>
                                            </tr>                                            
                                            <tr>
                                                <th>Customer Notes 
                                                <td>
                                                    not set
                                                </td>
                                                <th>
                                                    Added By
                                                </th>
                                                <td>
                                                    Admin
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    
                                                    <div class="btn-group btnGroupForMoreAction">
                                                        <button type="button" class="btn btn-sm btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                                        {{-- <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true"> --}}
                                                            <i class="fa fa-gear tiny-icon"></i> <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-left" role="menu" style="">
                                                            <li><a class="btn w-100 btn-info" href="https://test.nanarokom247.com/customer/1/edit"><i class="fa fa-pencil tiny-icon"></i> Edit</a></li>
                                                            <li>
                                                                <button class="btn w-100 btn-danger addLoanBtn" data-id="1">
                                                                    <i class="fa fa-plus tiny-icon"></i> Add Loan
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="btn w-100 btn-warning addAdvanceBtn" data-id="1">
                                                                    <i class="fa fa-plus tiny-icon"></i> Add Advance
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="btn w-100 btn-info getPaymentBtn" data-id="1">
                                                                    <i class="fa fa-plus tiny-icon"></i> Receive Prev due
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="btn w-100 btn-success" data-bs-toggle="modal" data-bs-target="#changeDate" onclick="setChangeDateModalForm(1)">
                                                                    <i class="fa fa-pencil tiny-icon"></i> Next Payment Date
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div> 
                                                    
                                                    {{-- <div class="btn-group btnGroupForMoreAction">
                                                        <button type="button" class="btn btn-sm btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                                            <!--
                                                                <i class="fas fa-ellipsis-v"></i>
                                                                <i class="fas fa-cogs"></i>
                                                            -->
                                                        </button>
                                                        <div class="dropdown-menu " x-placement="top-start" style="position: absolute; will-change: top, left; top: -183px; left: 0px;">
                                                            <a class="dropdown-item singleHistoryModal" data-id="" href="{{route('admin.customer.history')}}">History</a>
                                                            <a class="dropdown-item singleNextPaymentDateModal" data-id="" href="javascript:void(0)">Next Payment Date</a>
                                                            <a class="dropdown-item singleAddLoanModal" data-id="" href="javascript:void(0)">Add Loan</a>
                                                            <a class="dropdown-item singleAddAdvanceModal" data-id="" href="javascript:void(0)">Add Advance</a>
                                                            <a class="dropdown-item singleReceivePreviousDueModal" data-id="" href="javascript:void(0)">Receive Previous Due</a>
                                                            <a class="dropdown-item singleEditModal" data-id="" href="javascript:void(0)">Edit</a>
                                                            <a class="dropdown-item singleDeleteModal" data-id="" data-name="" href="javascript:void(0)">Delete</a>
                                                        </div>
                                                    </div> --}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="renderedTransactionalSummary"></div>
                                <div class="renderedTransactionalStatement"></div>
                                
                            </div>
                        </div>
                    </div>
                </div>

                
                <!------------------------------->
            </div>
            <!-------responsive table------> 


            <!-------add Customer Modal------> 
            <div class="modal fade " id="addCustomerModal"  aria-modal="true"></div>
            <input type="hidden" class="addCustomerModalRoute" value="{{ route('admin.customer.create') }}">
            <!-------add Customer Modal------> 
            

            <!-------delete Customer Modal------> 
            @include('backend.customer.customer.partial.delete_modal')
            <input type="hidden" class="deleteCustomerModalRoute" value="{{ route('admin.customer.delete') }}">
            <!-------delete Customer Modal------> 
            



        
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


    {{--Customer list url --}}
    <input type="hidden" class="customerTransactionalAndStatementUrl" value="{{route('admin.customer.transactional.statement')}}">
    {{--Customer list url --}}

<!--=================js=================-->
@push('js')
<!--=================js=================-->
<script src="{{asset('custom_js/backend')}}/customer/customer/transaction.js?v=1"></script>

<!--=================js=================-->
@endpush
<!--=================js=================-->



<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%^^^^Content^^^^%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
@endsection
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%^^^^Content^^^^%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
