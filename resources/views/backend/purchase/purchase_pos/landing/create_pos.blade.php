<!DOCTYPE html>
<!--
Template Name: Kundol Admin - Bootstrap 4 HTML Admin Dashboard Theme
Author: Themescoder
Website: http://www.themescoder.net/
Contact: support@themescoder.net
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
    <!--begin::Head-->

    <head>
        <meta charset="utf-8" />
        <title> {{ config('app.name') }}  @yield('page_title') | Purchase</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Updates and statistics" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!--begin::Fonts-->
        <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" /> -->
        <!--end::Fonts-->

        <!--begin::Global Theme Styles(used by all pages)-->
        <link href="{{asset('backend/pos')}}/assets/css/stylec619.css?v=1.0" rel="stylesheet" type="text/css" />
        <!--end::Global Theme Styles-->

        <link href="{{asset('backend/pos')}}/assets/api/pace/pace-theme-flat-top.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('backend/pos')}}/assets/api/mcustomscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />

        <link href="{{asset('backend/pos')}}/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('backend/pos')}}/assets/css/multiple-select.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="{{asset('backend/pos')}}/assets/css/daterangepicker.css" />



        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>



        <link rel="shortcut icon" href="{{asset('backend/pos/')}}/assets/media/logos/favicon.html" />
        <style>
            .h-90{
                height: 90% !important;
            }
            @media screen and (min-width: 760px) {
                .table-contentpos .table-datapos {
                    height: 180px !important;
                }
            }
            @media screen and (min-width: 820px) {
                .table-contentpos .table-datapos {
                    height: 200px !important;
                }
            }
            @media screen and (min-width: 1120px) {
                .table-contentpos .table-datapos {
                    height: 210px !important;
                }
            }
            @media screen and (min-width: 1800px) {
                .table-contentpos .table-datapos {
                    height: 360px !important;
                }
            }
            .contentPOS{
                padding-top: 20px !important;
                padding-bottom: 0px !important;
            }
            .card-custom.gutter-b {
                height: calc(100% - 20px) !important;
            }
        </style>
    </head>
    <!--end::Head-->
    <!--begin::Body-->

    <body id="tc_body" class="header-fixed header-mobile-fixed subheader-enabled aside-enabled aside-fixed" >
        <!-- Paste this code after body tag -->
        {{-- <div class="se-pre-con">
            <div class="pre-loader">
                <img class="img-fluid" src="{{asset('backend/pos')}}/assets/images/loadergif.gif" alt="loading" />
            </div>
        </div> --}}
        <!-- pos header -->

        <header class="pos-header bg-white" style="background-color:#100d0d !important">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <!--welcome-->
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="greeting-text">
                            <h3 class="card-label mb-0 font-weight-bold text-primary">
                                <a href="{{route('home')}}" style="text-decoration: none;color:#ffff;">{{ config('app.name') }}</a>
                            </h3>
                            <h3 class="card-label mb-0">
                                <a href="{{route('home')}}" style="text-decoration: none; color:#ffff;">
                                    Purchase
                                </a>
                            </h3>
                        </div>
                    </div>
                    <!--welcome-->

                    <!--clock, hour , minute, second-->
                    <div class="col-xl-4 col-lg-5 col-md-6 clock-main">
                        <div class="clock">
                            <div class="datetime-content">
                                <ul>
                                    <li id="hours"></li>
                                    <li id="point1">:</li>
                                    <li id="min"></li>
                                    <li id="point">:</li>
                                    <li id="sec"></li>
                                </ul>
                            </div>
                            <div class="datetime-content">
                                <div id="Date" class=""></div>
                            </div>
                        </div>
                    </div>
                    <!--clock, hour , minute, second-->

                    <div class="col-xl-4 col-lg-3 col-md-12 order-lg-last order-second">
                        <div class="topbar justify-content-end"  style="background-color:#100d0d !important">
                            <!--calculator-->
                            <div class="dropdown mega-dropdown">
                                <div id="id2" class="topbar-item" data-toggle="dropdown" data-display="static">
                                    <div class="btn btn-icon w-auto h-auto btn-clean d-flex align-items-center py-0 mr-3">
                                        <span class="symbol symbol-35 symbol-light-success">
                                            <span class="symbol-label bg-primary font-size-h5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="#fff" class="bi bi-calculator-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2 .5v2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0-.5.5zm0 4v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zM4.5 9a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM4 12.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zM7.5 6a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM7 9.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm.5 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM10 6.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm.5 2.5a.5.5 0 0 0-.5.5v4a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-.5-.5h-1z"
                                                    />
                                                </svg>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="dropdown-menu dropdown-menu-right calu" style="min-width: 248px;">
                                    <div class="calculator">
                                        <div class="input" id="input"></div>
                                        <div class="buttons">
                                            <div class="operators">
                                                <div>+</div>
                                                <div>-</div>
                                                <div>&times;</div>
                                                <div>&divide;</div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="leftPanel">
                                                    <div class="numbers">
                                                        <div>7</div>
                                                        <div>8</div>
                                                        <div>9</div>
                                                    </div>
                                                    <div class="numbers">
                                                        <div>4</div>
                                                        <div>5</div>
                                                        <div>6</div>
                                                    </div>
                                                    <div class="numbers">
                                                        <div>1</div>
                                                        <div>2</div>
                                                        <div>3</div>
                                                    </div>
                                                    <div class="numbers">
                                                        <div>0</div>
                                                        <div>.</div>
                                                        <div id="clear">C</div>
                                                    </div>
                                                </div>
                                                <div class="equal" id="result">=</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--calculator-->

                            <!--session-->
                            {{-- <div class="topbar-item folder-data">
                                <div class="btn btn-icon w-auto h-auto btn-clean d-flex align-items-center py-0 mr-3" data-toggle="modal" data-target="#folderpop">
                                    <span class="badge badge-pill badge-primary">
                                        @php
                                            $mastersessionname = masterSellingSession_hh();
                                            $mastersession    = [];
                                            $mastersession    = session()->has($mastersessionname) ? session()->get($mastersessionname)  : [];
                                        @endphp
                                        {{count($mastersession)}}
                                    </span>
                                    <span class="symbol symbol-35 symbol-light-success">
                                        <span class="symbol-label bg-warning font-size-h5">
                                            <svg width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" fill="#ffff" viewBox="0 0 16 16">
                                                <path
                                                    d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"
                                                ></path>
                                            </svg>
                                        </span>
                                    </span>
                                </div>
                            </div> --}}
                            <!--session-->

                            <!--logout-->
                            <div class="dropdown">
                                <div class="topbar-item" data-toggle="dropdown" data-display="static">
                                    <div class="btn btn-icon w-auto h-auto btn-clean d-flex align-items-center py-0">
                                        <span class="symbol symbol-35 symbol-light-success">
                                            <span class="symbol-label font-size-h5">
                                                <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
                                                </svg>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="dropdown-menu dropdown-menu-right" style="min-width: 150px;">
                                    <a  class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                        <span class="svg-icon svg-icon-xl svg-icon-primary mr-2">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="20px"
                                                height="20px"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="feather feather-power"
                                            >
                                                <path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path>
                                                <line x1="12" y1="2" x2="12" y2="12"></line>
                                            </svg> Logout
                                        </span>
                                       {{--  <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        <i class="feather icon-power text-danger"></i>
                                        &nbsp; Log Out
                                    </a> --}}
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    </a>
                                </div>
                            </div>
                            <!--logout-->
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="contentPOS h-90" style="background-color: #2297eb !important">
            <div class="container-fluid h-100">
                <!-----row------>
                <div class="row h-100">
                    <!-----col-8------>
					<div class="col-xl-8 col-lg-8 col-md-12 h-100">
                        <div class="card card-custom gutter-b bg-white border-0 table-contentpos">
                            <div class="card-body h-25">
                                <div class="d-flex justify-content-between colorfull-select">
                                    <!----------Supplier---------->
                                    <div class="selectmain" style="width: 100%;">
                                        <label class="text-dark d-flex">
                                            Choose a Supplier
                                            <!-- <span class="badge badge-secondary white rounded-circle" data-toggle="modal" data-target="#choosecustomer" style="cursor: pointer">
                                                <i class="fa fa-plus"></i>
                                            </span> 
                                            <span class="addCustomerModal badge badge-secondary white rounded-circle" data-create_from_value="customer" data-class_name="addedNewCustomer" style="cursor: pointer">
                                                <i class="fa fa-plus"></i>
                                            </span>--> 

                                            <!-- <span style="padding-left:2%;">
                                                <span class="badge badge-secondary white rounded-circle ml-2" data-toggle="modal" data-target="#shippingpop" style="cursor: pointer">
                                                    <i class="fa fa-plus"></i>
                                                </span>
                                            </span>
                                            <span style="padding-left:1px;">Shipping Address</span> -->
                                        </label>
                                        <select class="addedNewCustomer supplier_id arabic-select" style="width: 100%;"> <!--arabic-select--->
                                            <option value="">Select Supplier</option>
                                            @foreach ($suppliers as $item)
                                            <option value="{{$item->id}}">{{$item->name}} ({{$item->phone}})</option>
                                            @endforeach
                                        </select>
                                    </div><!----------Supplier---------->
                                </div>
                            </div>
                            
                            <!---------added to cart product list----------->
                            <div class="display_added_to_cart_list">
                                @include('backend.purchase.purchase_pos.ajax-response.landing.added-to-cart.list')
                            </div>
                            <!---------added to cart product list----------->

                            <div style="padding: 4px 0px;background: #e6e6e6;"></div>

                            <!---------summery of added to cart product list----------->
                            <div class="card-body h-75">
                                
                                <div class="resulttable-pos">
                                    <div class="row">
                                        <style>
                                            .btnFullWidth{
                                                width: 100%;padding: 2%;                                            
                                            }
                                        </style>
                                        <div class="col-3" style="border-right: 1px solid #e9ecef;">
                                            <a href="#" class="btn btn-danger btnFullWidth white removeOrEmptyAllItemFromCreatePurchaseCartList" style="margin-top: 1%;">
                                                Cancel
                                            </a>

                                            <a href="#" class="paymentQuotationButtonWhenCartItemMoreThenZero btn btn-dark btnFullWidth white" style="margin-top: 1%; display:; cursor: pointer;"><!--- data-toggle="modal" data-target="#quotation-popup"-->
                                                Quotation
                                            </a>

                                            <a href="#" class="paymentModalOpen paymentQuotationButtonWhenCartItemMoreThenZero btn btn-success btnFullWidth white" style="margin-top: 1%; display:; cursor: pointer;"> <!--- data-toggle="modal" data-target="#payment-popup"-->
                                                Payment <img class="payment_processing_gif" src="{{asset('loading-img/loading1.gif')}}" alt="" style="margin-left:auto;margin-right:auto;height:20px;display:none;background-color:#ffff;border-radius: 50%;">
                                            </a>
                                            <input type="hidden" class="paymentModalOpenUrl" value="{{route('admin.purchase.regular.pos.purchase.payment.modal.open')}}">
                                            <input type="hidden" class="paymentBankingOptionUrl" value="{{route('admin.payment.common.banking.option.data')}}">

                                            <a href="{{ route('admin.purchase.regular.purchase.pos.print.from.direct.purchase.cart') }}" class="print normal_print_direct_from_purchase_cart btn btn-info btnFullWidth white" data-href="#" style="margin-top: 1%;" target="_blank">
                                                POS Print
                                            </a>

                                            <a class="pos_print_direct_from_purchase_cart btn btn-primary btnFullWidth white" style="margin-top:1%;cursor: not-allowed;" data-href="{{ route('admin.purchase.regular.purchase.normal.print.from.direct.purchase.cart') }}">
                                                Print
                                            </a>
                                        </div>

                                        <div class="col-8">
                                            @include('backend.purchase.purchase_pos.landing.include.invoice_final_calculation_summery')
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <!---------summery of added to cart product list----------->
                        </div>
                        
                    </div><!-----col-8------>


                    <!-----col-4------>
                    <div class="col-xl-4 col-lg-4 col-md-12 h-100">
                        <div class="card-custom gutter-b bg-white border-0">
                            <div class="card-body mb-4">
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-12">
                                        <div class="selectmain">
                                            <select  name="category_id"  class="category_id arabic-select select2 bag-primary" style="width:100%">
                                                <option value="">All Categories</option>
                                                @foreach ($categories as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-12">
                                        <div class="selectmain">
                                            <select  name="product_id" class="product_id arabic-select select2 bag-primary" style="width:100%">
                                                <option value="">All Product</option>
                                                @foreach ($allproducts as $item)
                                                <option value="{{$item->id}}">
                                                    @php
                                                        $product = $item->name;
                                                        if(strlen($item->name) > 70)
                                                        {
                                                            $len = substr($item->name,0,70);
                                                            if(str_word_count($len) > 1)
                                                            {
                                                                $product = implode(" ",(explode(' ',$len,-1)));
                                                            }else{
                                                                $product = $len;
                                                            }
                                                            $product = $product ."...";
                                                        }
                                                    @endphp
                                                    {{$product}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mt-3 mb-0" style="padding-bottom: 15px;">
                                    <div class="col-md-12" style="padding-bottom:5px;">
                                        <fieldset class="form-group mb-0 d-flex barcodeselection">
                                            <input name="custom_search" type="text" class="custom_search form-control border-dark" id="basicInput1" autofocus placeholder="product name / as code / company code / sku"/>
                                        </fieldset>
                                    </div>
                                </div> 
                                
                            </div>

                            
                            <div class="card-body product-items" style="background-color: #efefef;">
                                <!----display all product list--->
                                <div class="display-all-product-list">
                                    @include('backend.purchase.purchase_pos.ajax-response.landing.product-list.product_list')
                                </div>
                                <!----display all product list--->
                            </div>

                        </div>
                    </div><!-----col-4------>
                </div><!-----row------>
            </div>
        </div>

    <!-- Button trigger modal -->


        @include('backend.purchase.purchase_pos.landing.modal.payment_modal')
        @include('backend.purchase.purchase_pos.landing.modal.quotation_modal')
        @include('backend.purchase.purchase_pos.landing.modal.shipping_modal')
        @include('backend.purchase.purchase_pos.landing.modal.shipping_cost_modal')
        @include('backend.purchase.purchase_pos.landing.modal.choose_customer_modal')
        @include('backend.purchase.purchase_pos.landing.modal.folder_modal')

       

  

        <!-------show single Product details  Modal------> 
        <div class="modal fade" id="showProductDetailModal"  aria-modal="true"></div>
        <input type="hidden" class="showProductDetailsModalRoute" value="{{ route('admin.purchase.regular.pos.show.single.product.details') }}">
        <!-------show single Product details  Modal------> 


        
        <!-------show Product quantity Modal------> 
        <div class="modal fade" id="showQuantityWiseProductStockModal"  aria-modal="true"></div>
        <!-------show Product quantity Modal------> 

        <!-------display product list------> 
        <input type="hidden" class="displayProductListUrl" value="{{ route('admin.purchase.regular.pos.display.product.list') }}">
        <!-------display product list------> 
        
        <!-------display added to product list------> 
        <input type="hidden" class="displayPurchaseCreateAddedToCartProductListUrl" value="{{ route('admin.purchase.regular.pos.display.purchase.created.added.to.cart.product.list') }}">
        <!-------display added to product list------> 
        
        <!------- invoice final calculation summery------> 
        <input type="hidden" class="invoiceFinalPurchaseCalculationSummeryUrl" value="{{ route('admin.purchase.regular.pos.purchase.final.invoice.calculation.summery') }}">
        <!------- invoice final calculation summery------> 

        <!-------remove single item from added to purchase cart list------> 
        <div class="modal fade" id="removeSingleItemFromPurchaseAddedToCartModal"  aria-modal="true"></div>
        <input type="hidden" class="removeConfirmationRequiredSingleItemFromPurchaseAddedToCartListUrl" value="{{ route('admin.purchase.regular.pos.remove.confirmation.required.single.item.from.purchase.added.to.cart.list') }}">
        <input type="hidden" class="removeSingleItemFromPurchaseAddedToCartListUrl" value="{{ route('admin.purchase.regular.pos.remove.single.item.from.purchase.added.to.cart.list') }}">
        <!-------remove single item from added to purchase cart list------> 

        <!-------remove all item from added to purchase cart list------> 
        <div class="modal fade" id="removeAllItemFromPurchaseAddedToCartModal"  aria-modal="true"></div>
        <input type="hidden" class="removeConfirmationRequiredAllItemFromPurchaseAddedToCartListUrl" value="{{ route('admin.purchase.regular.pos.remove.confirmation.required.all.item.from.purchase.added.to.cart.list') }}">
        <input type="hidden" class="removeAllItemFromPurchaseAddedToCartListUrl" value="{{ route('admin.purchase.regular.pos.remove.all.item.from.purchase.added.to.cart.list') }}">
        <!-------remove all item from added to purchase cart list------> 

        <!-------change quantity from added to purchase cart list------> 
        <input type="hidden" class="changeQuantityFromPurchaseAddedToCartListUrl" value="{{ route('admin.purchase.regular.pos.change.quantity.from.purchase.added.to.cart.list') }}">
        <!-------change quantity from added to purchase cart list------> 


        <script src="{{asset('backend/pos')}}/assets/js/plugin.bundle.min.js"></script>
        <script src="{{asset('backend/pos')}}/assets/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('backend/pos')}}/assets/js/jquery.dataTables.min.js"></script>
        <script src="{{asset('backend/pos')}}/assets/js/multiple-select.min.js"></script>
        <script src="{{asset('backend/pos')}}/assets/js/sweetalert.js"></script>
        <script src="{{asset('backend/pos')}}/assets/js/sweetalert1.js"></script>

        <!--notify js-->
        <script src="{{asset('backend/links/assets')}}/js/notify.js"></script>

        <!--not using this script.bundle.js file js-->
        {{-- <script src="{{asset('backend/pos')}}/assets/js/script.bundle.js"></script> --}}
        <!--not using this script.bundle.js file js-->
        <script src="{{asset('backend/pos')}}/assets/js/time-calculator.js"></script>

        <script>
            jQuery(function () {
                jQuery(".arabic-select").multipleSelect({
                    filter: true,
                    filterAcceptOnEnter: true,
                });
            });
            jQuery(function () {
                jQuery(".js-example-basic-single").multipleSelect({
                    filter: true,
                    filterAcceptOnEnter: true,
                });
            });
            jQuery(document).ready(function () {
                jQuery("#orderTable").DataTable({
                    info: false,
                    paging: false,
                    searching: false,

                    columnDefs: [
                        {
                            targets: "no-sort",
                            orderable: false,
                        },
                    ],
                });
            });
        </script>

                        

        <!-- AJAX Js-->
        <script>
                jQuery.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
        </script>
        
        @stack('pos-js')

        <script src="{{asset('custom_js/backend')}}/purchase/purchase_pos/landing/product-list.js"></script>
        <script src="{{asset('custom_js/backend')}}/purchase/purchase_pos/single-product/stock-with-price.js"></script>
        <script src="{{asset('custom_js/backend')}}/purchase/purchase_pos/add-to-cart/add_to_cart.js"></script>
        
        <script src="{{asset('custom_js/backend')}}/purchase/session/setting.js"></script>

        
        <!---Reference related js file--->
         <!-------add Reference Modal------> 
         <div class="modal fade " id="addReferenceModal"  aria-modal="true"></div>
         <input type="hidden" class="addReferenceModalRoute" value="{{ route('admin.reference.create') }}">
         <!-------add Reference Modal------> 
         <script src="{{asset('custom_js/backend')}}/reference/reference/create.js?v=2"></script>
        <!---Reference related js file--->

    </body>
    <!--end::Body-->
</html>










{{-- <script type="text/javascript">
    swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "error",
            showCancelButton: true,
            dangerMode: true,
            cancelButtonClass: '#DD6B55',
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Delete!',
        },function (result) {
            if (result) {
                var action = current_object.attr('data-action');
                var token = jQuery('meta[name="csrf-token"]').attr('content');
                var id = current_object.attr('data-id');

                $('body').html("<form class='form-inline remove-form' method='post' action='"+action+"'></form>");
                $('body').find('.remove-form').append('<input name="_method" type="hidden" value="delete">');
                $('body').find('.remove-form').append('<input name="_token" type="hidden" value="'+token+'">');
                $('body').find('.remove-form').append('<input name="id" type="hidden" value="'+id+'">');
                $('body').find('.remove-form').submit();
            }
        });
    $("body").on("click",".remove-user",function(){
        var current_object = $(this);
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "error",
            showCancelButton: true,
            dangerMode: true,
            cancelButtonClass: '#DD6B55',
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Delete!',
        },function (result) {
            if (result) {
                var action = current_object.attr('data-action');
                var token = jQuery('meta[name="csrf-token"]').attr('content');
                var id = current_object.attr('data-id');

                $('body').html("<form class='form-inline remove-form' method='post' action='"+action+"'></form>");
                $('body').find('.remove-form').append('<input name="_method" type="hidden" value="delete">');
                $('body').find('.remove-form').append('<input name="_token" type="hidden" value="'+token+'">');
                $('body').find('.remove-form').append('<input name="id" type="hidden" value="'+id+'">');
                $('body').find('.remove-form').submit();
            }
        });
    });
</script> --}}

 <!--not using this part-->
 {{-- <div style="display: none;" class="d-flex .justify-content-bottom align-items-center flex-column">
    <div style="display: none;">
        <button type="submit" class="btn btn-outline-secondary mr-2" title="Delete">
            <i class="fas fa-trash-alt"></i>
        </button>
        <button type="submit" class="btn btn-danger mr-2 confirm-delete" title="Save">
            <i class="fas fa-save"></i>
        </button>
        <button type="submit" class="btn btn-secondary white">
            <i class="fas fa-folder"></i>
            <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-folder-fill svg-sm mr-2" viewBox="0 0 16 16">
                <path
                    d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"
                />
            </svg> -->
        </button>
        <a href="#" class="btn btn-primary white" data-toggle="modal" data-target="#payment-popup">
            POS Print
        </a> 
        <a href="#" class="btn btn-info white" data-toggle="modal" data-target="#payment-popup">
            Print
        </a>
        <!-- <a href="#" class="btn btn-outline-secondary">
            Pay With Card
        </a> -->
    </div>
</div> --}}