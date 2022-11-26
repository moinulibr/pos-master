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
            <h4 class="font-weight-bold py-3 mb-0">Customers  </h4>
            <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#"><i class="feather icon-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Customer</li>
                    <li class="breadcrumb-item active">All Customer</li>
                </ol>
            </div>
            <div class="products">
                <a href="#" class="addCustomerModal">Add Customer</a>
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
                            <div class="card-header">
                                <span class="card-title" style="font-size: 20px">Customers Payment History </span>
                            </div>
    
                            <div class="card-body">
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
                                                <th>Customer Notes <br>
                                                    Next payment date</th>
                                                <td>
                                                    <br>
                                                    not set
                                                </td>
                                                <th>
                                                    Account Create Date <br>
                                                    Added By
                                                </th>
                                                <td>
                                                    16-04-2022<br>
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

                                <h3 class="text-center">Transaction Summery </h3>
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Module</th>
                                                <th>Total (Return)</th>
                                                <th>Paid (Less)</th>
                                                <th>Due</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Openning Due Balance</td>
                                                <td> 10000</td>
                                                <td> 10000.00</td>
                                                <td> 0</td>
                                                
                                            </tr>
                                            <tr>
                                                <td>Sales Balance</td>
                                                <td>52980
                                                    (4400)</td>
                                                <td> 7400.00</td>
                                                <td> 45580</td>
                                                
                                            </tr>
                                            <tr>
                                                <td>Loan Balance</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                                
                                            </tr>
                                            <tr>
                                                <td>Advance Balance</td>
                                                <td>-</td>
                                                <td>0</td>
                                                <td>(-)0</td>
                                                
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="bg-whitesmoke">
                                                <td>
                                                    <b>Total</b>
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    <b>17400</b>
                                                </td>
                                                <td>
                                                    <b>45580</b>
                                                </td>
                                                
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
    
                                
                                <div class="action-buttons">
    
                                    <form action="" method="post">
                                        <input type="hidden" name="_token" value="QaOkYpfsX1kvv3IacPHgd0omq43HUrTR7yHJ4M2R">                                    <div class="table-toolbar mb-2 text-end">
                                            <button class="btn btn-primary pull-left" name="pdf"> <i class="fa fa-download"></i>
                                                PDF
                                            </button>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="table-responsive">
                                            <table id="example1" class="table table-bordered table-striped table-hover">
                                                    
                                                <thead>
                                                    
                                                    <tr>
                                                    <th>Date</th>
                                                    <th>Invoice</th>
                                                    <th>Media &amp; Comments</th>
                                                    <th>Quotation</th>
                                                    <th>Sales</th>
                                                    <th>Paid</th>
                                                    <th>Due</th>
                                                    <th>Loan &amp; Debt</th>
                                                    <th>Advance &amp; Receive</th>
                                                    <th>Product Return</th>
                                                    <th>Balance</th>
                                                    <th>Payment Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td>Opening Due</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>10000</td>
                                                        <td></td>
                                                    </tr>
        
                                                                                                    <tr>
                                                            
                                                            <td>18-04-2022</td>
                                                            <td>001</td>
                                                            <td></td>
                                                            <td>
                                                                                                                    </td>
                                                            <td>
                                                                                                                            67000.00
                                                                                                                    </td>
                                                            <td></td>
                                                            <td>67000.00</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>77000</td>
                                                            <td></td>
                                                        </tr>
                                                                                                    <tr>
                                                            
                                                            <td>18-04-2022</td>
                                                            <td>002</td>
                                                            <td></td>
                                                            <td>
                                                                                                                    </td>
                                                            <td>
                                                                                                                            25200.00
                                                                                                                    </td>
                                                            <td></td>
                                                            <td>25200.00</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>102200</td>
                                                            <td></td>
                                                        </tr>
                                                                                                    <tr>
                                                            
                                                            <td>18-04-2022</td>
                                                            <td></td>
                                                            <td>Receive</td>
                                                            <td>
                                                                                                                    </td>
                                                            <td>
                                                                                                                            
                                                                                                                    </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>100000</td>
                                                            <td></td>
                                                            <td>2200</td>
                                                            <td></td>
                                                        </tr>
                                                                                                    <tr>
                                                            
                                                            <td>18-04-2022</td>
                                                            <td>002</td>
                                                            <td>sale return</td>
                                                            <td>
                                                                                                                    </td>
                                                            <td>
                                                                                                                            22360.00
                                                                                                                    </td>
                                                            <td>22360.00</td>
                                                            <td>0</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>640</td>
                                                            <td>0</td>
                                                            <td></td>
                                                        </tr>
                                                                                                    <tr>
                                                            
                                                            <td>18-04-2022</td>
                                                            <td>003</td>
                                                            <td></td>
                                                            <td>
                                                                                                                    </td>
                                                            <td>
                                                                                                                            54000.00
                                                                                                                    </td>
                                                            <td></td>
                                                            <td>54000.00</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>54000</td>
                                                            <td></td>
                                                        </tr>
                                                                                                    <tr>
                                                            
                                                            <td>19-04-2022</td>
                                                            <td>004</td>
                                                            <td></td>
                                                            <td>
                                                                                                                    </td>
                                                            <td>
                                                                                                                            6500.00
                                                                                                                    </td>
                                                            <td></td>
                                                            <td>6500.00</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>60500</td>
                                                            <td></td>
                                                        </tr>
                                                                                                    <tr>
                                                            
                                                            <td>19-04-2022</td>
                                                            <td></td>
                                                            <td>Receive</td>
                                                            <td>
                                                                                                                    </td>
                                                            <td>
                                                                                                                            
                                                                                                                    </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>60500</td>
                                                            <td></td>
                                                            <td>0</td>
                                                            <td></td>
                                                        </tr>
                                                                                                    <tr>
                                                            
                                                            <td>22-04-2022</td>
                                                            <td>005</td>
                                                            <td></td>
                                                            <td>
                                                                                                                    </td>
                                                            <td>
                                                                                                                            54000.00
                                                                                                                    </td>
                                                            <td></td>
                                                            <td>54000.00</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>54000</td>
                                                            <td></td>
                                                        </tr>
                                                                                                    <tr>
                                                            
                                                            <td>22-04-2022</td>
                                                            <td>005</td>
                                                            <td></td>
                                                            <td>
                                                                                                                    </td>
                                                            <td>
                                                                                                                            22000.00
                                                                                                                    </td>
                                                            <td>0.00</td>
                                                            <td>22000</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>22000</td>
                                                            <td></td>
                                                        </tr>
                                                                                                    <tr>
                                                            
                                                            <td>22-04-2022</td>
                                                            <td>005</td>
                                                            <td></td>
                                                            <td>
                                                                                                                    </td>
                                                            <td>
                                                                                                                            11000.00
                                                                                                                    </td>
                                                            <td>0.00</td>
                                                            <td>11000</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>11000</td>
                                                            <td></td>
                                                        </tr>
                                                                                                    <tr>
                                                            
                                                            <td>22-04-2022</td>
                                                            <td></td>
                                                            <td>Receive</td>
                                                            <td>
                                                                                                                    </td>
                                                            <td>
                                                                                                                            
                                                                                                                    </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>11000</td>
                                                            <td></td>
                                                            <td>0</td>
                                                            <td></td>
                                                        </tr>
                                                                                                    <tr>
                                                            
                                                            <td>22-04-2022</td>
                                                            <td>005</td>
                                                            <td>sale return</td>
                                                            <td>
                                                                                                                    </td>
                                                            <td>
                                                                                                                            6600.00
                                                                                                                    </td>
                                                            <td>6600.00</td>
                                                            <td>0</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>4400</td>
                                                            <td>0</td>
                                                            <td></td>
                                                        </tr>
                                                                                                    <tr>
                                                            
                                                            <td>24-04-2022</td>
                                                            <td>006</td>
                                                            <td></td>
                                                            <td>
                                                                                                                    </td>
                                                            <td>
                                                                                                                            1080.00
                                                                                                                    </td>
                                                            <td></td>
                                                            <td>1080.00</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>1080</td>
                                                            <td></td>
                                                        </tr>
                                                                                                    <tr>
                                                            
                                                            <td>24-04-2022</td>
                                                            <td>007</td>
                                                            <td></td>
                                                            <td>
                                                                                                                    </td>
                                                            <td>
                                                                                                                            1080.00
                                                                                                                    </td>
                                                            <td></td>
                                                            <td>1080.00</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>2160</td>
                                                            <td></td>
                                                        </tr>
                                                                                                    <tr>
                                                            
                                                            <td>24-04-2022</td>
                                                            <td>008</td>
                                                            <td></td>
                                                            <td>
                                                                                                                    </td>
                                                            <td>
                                                                                                                            2200.00
                                                                                                                    </td>
                                                            <td></td>
                                                            <td>2200.00</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>4360</td>
                                                            <td></td>
                                                        </tr>
                                                                                                    <tr>
                                                            
                                                            <td>24-04-2022</td>
                                                            <td>009</td>
                                                            <td></td>
                                                            <td>
                                                                                                                    </td>
                                                            <td>
                                                                                                                            8800.00
                                                                                                                    </td>
                                                            <td></td>
                                                            <td>8800.00</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>13160</td>
                                                            <td></td>
                                                        </tr>
                                                                                                    <tr>
                                                            
                                                            <td>24-04-2022</td>
                                                            <td>0010</td>
                                                            <td></td>
                                                            <td>
                                                                                                                    </td>
                                                            <td>
                                                                                                                            11000.00
                                                                                                                    </td>
                                                            <td></td>
                                                            <td>11000.00</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>24160</td>
                                                            <td></td>
                                                        </tr>
                                                                                                    <tr>
                                                            
                                                            <td>24-04-2022</td>
                                                            <td>0011</td>
                                                            <td></td>
                                                            <td>
                                                                                                                    </td>
                                                            <td>
                                                                                                                            22000.00
                                                                                                                    </td>
                                                            <td></td>
                                                            <td>22000.00</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>46160</td>
                                                            <td></td>
                                                        </tr>
                                                                                                    <tr>
                                                            
                                                            <td>25-04-2022</td>
                                                            <td>006</td>
                                                            <td></td>
                                                            <td>
                                                                                                                    </td>
                                                            <td>
                                                                                                                            1080.00
                                                                                                                    </td>
                                                            <td>1080.00</td>
                                                            <td>0</td>
                                                            <td></td>
                                                            <td>1080</td>
                                                            <td></td>
                                                            <td>45080</td>
                                                            <td></td>
                                                        </tr>
                                                                                                    <tr>
                                                            
                                                            <td>28-04-2022</td>
                                                            <td>14</td>
                                                            <td></td>
                                                            <td>
                                                                                                                    </td>
                                                            <td>
                                                                                                                            220.00
                                                                                                                    </td>
                                                            <td>0.00</td>
                                                            <td>220</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>45800</td>
                                                            <td></td>
                                                        </tr>
                                                                                                    <tr>
                                                            
                                                            <td>28-04-2022</td>
                                                            <td>0014</td>
                                                            <td></td>
                                                            <td>
                                                                                                                    </td>
                                                            <td>
                                                                                                                            220.00
                                                                                                                    </td>
                                                            <td>220.00</td>
                                                            <td>0</td>
                                                            <td></td>
                                                            <td>220</td>
                                                            <td></td>
                                                            <td>45580</td>
                                                            <td></td>
                                                        </tr>
                                                                                                    <tr>
                                                            
                                                            <td>08-05-2022</td>
                                                            <td>0015</td>
                                                            <td></td>
                                                            <td>
                                                                                                                            220.00
                                                                                                                    </td>
                                                            <td>
                                                                                                                    </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>45580</td>
                                                            <td></td>
                                                        </tr>
                                                                                                <tr class="bg-gray">
                                                        <td></td>
                                                        <td></td>
                                                        <td><b>Total</b></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <b>45580</b>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
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
    {{-- <input type="hidden" class="customerListUrl" value="{{route('admin.customer.list.ajaxresponse')}}"> --}}
    {{--Customer list url --}}

<!--=================js=================-->
@push('js')
<!--=================js=================-->
{{-- <script src="{{asset('custom_js/backend')}}/customer/customer/index.js?v=1"></script> --}}

<!--=================js=================-->
@endpush
<!--=================js=================-->



<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%^^^^Content^^^^%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
@endsection
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%^^^^Content^^^^%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
<!--%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%-->
