        <!-----left side bar top section - with logo---->
        <div class="app-brand demo">
            <span class="app-brand-logo demo">
            <img src="{{asset('backend/links/assets')}}/img/logo.png" alt="Brand Logo" class="img-fluid">
            </span>
            <a href="{{route('home')}}" class="app-brand-text demo sidenav-text font-weight-normal ml-2">Empire</a>
            <a href="javascript:" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
            <i class="ion ion-md-menu align-middle"></i>
            </a>
        </div>
        <div class="sidenav-divider mt-0"></div>
        <!-----left side bar top section - with logo---->

         <!---left-sidenav-bottom-->
        <ul class="sidenav-inner py-1">

            <!---sales--->
            <li class="sidenav-item "> {{---<li class="sidenav-item open active">---}}
                <a href="javascript:" class="sidenav-link sidenav-toggle">
                    <i class="sidenav-icon feather icon-home"></i>
                    <div>Sales</div>
                    <div class="pl-1 ml-auto">
                        <!-- <div class="badge badge-danger">Hot</div> -->
                    </div>
                </a>
                <ul class="sidenav-menu">
                    <li class="sidenav-item ">{{-- <li class="sidenav-item active"> active--}}
                        <a href="{{route('admin.sell.regular.sell.index')}}" class="sidenav-link">
                            <div>Sale List</div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="{{route('admin.sell.regular.pos.create')}}" class="sidenav-link">
                        <div>Sale Create</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="{{route('admin.sell.regular.quotation.index')}}" class="sidenav-link">
                        <div>Quotation List</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    {{-- <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Sale Return</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li> --}}
                </ul>
            </li>
            <!---sales--->

            <!---purchase--->
            <li class="sidenav-item">
                <a href="javascript:" class="sidenav-link sidenav-toggle">
                    <i class="sidenav-icon feather icon-home"></i>
                    <div>Purchase</div>
                    <div class="pl-1 ml-auto">
                        <!-- <div class="badge badge-danger">New</div> -->
                    </div>
                </a>
                <ul class="sidenav-menu">
                    <li class="sidenav-item">
                        <a href="{{route('admin.purchase.regular.purchase.index')}}" class="sidenav-link">
                            <div>Purchase List</div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="{{route('admin.purchase.regular.pos.create')}}" class="sidenav-link">
                        <div>Purchase Create</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    {{-- <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Purchase Return</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Quotation List</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Quotation Create</div>
                        <div class="pl-1 ml-auto">
                            <div class="badge badge-danger">New</div>
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Bypass Purchase</div>
                        <div class="pl-1 ml-auto">
                            <div class="badge badge-danger">New</div>
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Pending Receive</div>
                        <div class="pl-1 ml-auto">
                            <div class="badge badge-danger">New</div>
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Low Alert Product</div>
                        <div class="pl-1 ml-auto">
                            <div class="badge badge-danger">New</div>
                        </div>
                        </a>
                    </li> --}}
                </ul>
            </li>
            <!---purchase--->

            <!---Supplier--->
            <li class="sidenav-item @if(request()->is('admin/supplier/*')) active @endif ">
                <a href="{{route('admin.supplier.index')}}" class="sidenav-link">
                <i class="sidenav-icon feather icon-type"></i>
                <div>Supplier</div>
                </a>
            </li>
            <!---Supplier--->

            <!---Customers--->
            <li class="sidenav-item   @if(request()->is('admin/customer/*')) open active @endif ">
                <a href="javascript:" class="sidenav-link sidenav-toggle">
                    <i class="sidenav-icon feather icon-home"></i>
                    <div>Customers</div>
                    <div class="pl-1 ml-auto">
                        <!-- <div class="badge badge-danger">Hot</div> -->
                    </div>
                </a>
                <ul class="sidenav-menu">
                    <li class="sidenav-item   @if(request()->is('admin/customer/*')) active @endif ">
                        <a href="{{route('admin.customer.index')}}" class="sidenav-link">
                            <div>Customer List</div>
                        </a>
                    </li> 
                    {{-- <li class="sidenav-item ">
                        <a href="index.html" class="sidenav-link">
                            <div>Walking Customer List</div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Customer Create</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Customer Bill Receive</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Customer Advance</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Customer Loan</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>SMS</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>SMS Group</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li> --}}
                </ul>
            </li>
            <!---Customer--->

            <!---products--->
            <li class="sidenav-item @if(request()->is('admin/product/index')
                || request()->is('admin/product/list')
                || request()->is('admin/product/create')
                || request()->is('admin/product/view')
                )active @endif">
                <a href="{{route('admin.product.index')}}" class="sidenav-link">
                <i class="sidenav-icon feather icon-type"></i>
                <div>Products</div>
                </a>
            </li>
            <!---products--->

            
            <!---Reference--->
            <li class="sidenav-item   @if(request()->is('admin/reference/*')) open active @endif ">
                <a href="javascript:" class="sidenav-link sidenav-toggle">
                    <i class="sidenav-icon feather icon-home"></i>
                    <div>Reference</div>
                    <div class="pl-1 ml-auto">
                        <!-- <div class="badge badge-danger">Hot</div> -->
                    </div>
                </a>
                <ul class="sidenav-menu">
                    <li class="sidenav-item   @if(request()->is('admin/reference/*')) active @endif ">
                        <a href="{{route('admin.reference.index')}}" class="sidenav-link">
                            <div>Reference List</div>
                        </a>
                    </li> 
                </ul>
            </li>
            <!---Reference--->
 

            <!---Attendance--->
            {{-- <li class="sidenav-item  ">
                <a href="javascript:" class="sidenav-link sidenav-toggle">
                    <i class="sidenav-icon feather icon-home"></i>
                    <div>Attendance</div>
                    <div class="pl-1 ml-auto">
                        <!-- <div class="badge badge-danger">New</div> -->
                    </div>
                </a>
                <ul class="sidenav-menu">
                    <li class="sidenav-item ">
                        <a href="index.html" class="sidenav-link">
                            <div>Add Attendance </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Attendance List</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Report</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                </ul>
            </li> --}}
            <!---Attendance--->

            <!---Expense--->
            {{-- <li class="sidenav-item  ">
                <a href="javascript:" class="sidenav-link sidenav-toggle">
                    <i class="sidenav-icon feather icon-home"></i>
                    <div>Expense</div>
                    <div class="pl-1 ml-auto">
                        <!-- <div class="badge badge-danger">Hot</div> -->
                    </div>
                </a>
                <ul class="sidenav-menu">
                    <li class="sidenav-item ">
                        <a href="index.html" class="sidenav-link">
                            <div>All Expense</div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Categories</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Plumber</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                </ul>
            </li> --}}
            <!---Expense--->

            <!---Stock--->
            <li class="sidenav-item">
                <a href="{{route('admin.product.stock.index')}}" class="sidenav-link">
                <i class="sidenav-icon feather icon-type"></i>
                <div>Stock</div>
                </a>
            </li>
            <!---Stock--->

            <!---Account--->
            {{-- <li class="sidenav-item  ">
                <a href="javascript:" class="sidenav-link sidenav-toggle">
                    <i class="sidenav-icon feather icon-home"></i>
                    <div>Account</div>
                    <div class="pl-1 ml-auto">
                        <!-- <div class="badge badge-danger">Hot</div> -->
                    </div>
                </a>
                <ul class="sidenav-menu">
                    <li class="sidenav-item ">
                        <a href="index.html" class="sidenav-link">
                            <div>Dino</div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Deposit</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Withdraw</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Transfer</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Accounts</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>ACC Closing</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Banks</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Loan Manager</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Payment Method</div>
                        <div class="pl-1 ml-auto">
                           <!--  <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Initial Assets</div>
                        <div class="pl-1 ml-auto">
                           <!--  <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Initial Assets</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Assets</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Blance Sheet</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                </ul>
            </li> --}}
            <!---Account--->

            <!---Prouct Attribute--->
            <li class="sidenav-item @if(request()->is('admin/unit/*')
                || request()->is('admin/brand/*') || request()->is('admin/product/grade/*') 
                || request()->is('admin/category/*') || request()->is('admin/sub/category/*') 
                || request()->is('admin/color/*') || request()->is('admin/supplier/group/*') 
                ) open active @endif
             ">
                <a href="javascript:" class="sidenav-link sidenav-toggle">
                    <i class="sidenav-icon feather icon-home"></i>
                    <div>Prouct Attribute</div>
                    <div class="pl-1 ml-auto">
                       {{--  <div class="badge badge-danger">Hot</div> --}}
                    </div>
                </a>
                <ul class="sidenav-menu">
                    <li class="sidenav-item @if(request()->is('admin/product/grade/*')) active @endif">
                        <a href="{{route('admin.product.grade.index')}}" class="sidenav-link">
                            <div>Product Grade </div>
                        </a>
                    </li>
                    <li class="sidenav-item @if(request()->is('admin/brand/*')) active @endif ">
                        <a href="{{route('admin.brand.index')}}" class="sidenav-link">
                        <div>Brands</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item @if(request()->is('admin/category/*')) active @endif ">
                        <a href="{{route('admin.category.index')}}" class="sidenav-link">
                        <div>Categories</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li> 
                    <li class="sidenav-item @if(request()->is('admin/sub/category/*')) active @endif">
                        <a href="{{route('admin.subcategory.index')}}" class="sidenav-link">
                        <div>Sub-categories</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item  @if(request()->is('admin/unit/*')) active @endif ">
                        <a href="{{route('admin.unit.index')}}" class="sidenav-link">
                        <div>Units</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item   @if(request()->is('admin/color/*')) active @endif ">
                        <a href="{{route('admin.color.index')}}" class="sidenav-link">
                        <div>Color</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item    @if(request()->is('admin/supplier/group/*')) active @endif ">
                        <a href="{{route('admin.supplier.group.index')}}" class="sidenav-link">
                            <div>Group (Supplier Group) </div>
                        </a>
                    </li>
                </ul>
            </li>
            <!---Prouct Attribute--->

            
            <!---Warehouse--->
            <li class="sidenav-item   @if(request()->is('admin/warehouse/*')) open active @endif ">
                <a href="javascript:" class="sidenav-link sidenav-toggle">
                    <i class="sidenav-icon feather icon-home"></i>
                    <div>Warehouse</div>
                    <div class="pl-1 ml-auto">
                        <!-- <div class="badge badge-danger">Hot</div> -->
                    </div>
                </a>
                <ul class="sidenav-menu">
                    <li class="sidenav-item   @if(request()->is('admin/warehouse/list')) active @endif ">
                        <a href="{{route('admin.warehouse.index')}}" class="sidenav-link">
                            <div>Warehouse List</div>
                        </a>
                    </li> 
                    <li class="sidenav-item   @if(request()->is('admin/warehouse/rack/*')) active @endif ">
                        <a href="{{route('admin.warehouse.rack.index')}}" class="sidenav-link">
                            <div>Warehouse Rack List</div>
                        </a>
                    </li> 
                </ul>
            </li>
            <!---Warehouse--->



            <!---HRM--->
            {{-- <li class="sidenav-item ">
                <a href="javascript:" class="sidenav-link sidenav-toggle">
                    <i class="sidenav-icon feather icon-home"></i>
                    <div>HRM</div>
                    <div class="pl-1 ml-auto">
                        <!-- <div class="badge badge-danger">Hot</div> -->
                    </div>
                </a>
                <ul class="sidenav-menu">
                    <li class="sidenav-item ">
                        <a href="index.html" class="sidenav-link">
                            <div>Manage User </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>User Salry</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Manage Role</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                </ul>
            </li> --}}
            <!---HRM--->

            <!---Reports--->
            {{-- <li class="sidenav-item  ">
                <a href="javascript:" class="sidenav-link sidenav-toggle">
                    <i class="sidenav-icon feather icon-home"></i>
                    <div>Reports</div>
                    <div class="pl-1 ml-auto">
                        <!-- <div class="badge badge-danger">Hot</div> -->
                    </div>
                </a>
                <ul class="sidenav-menu">
                    <li class="sidenav-item ">
                        <a href="index.html" class="sidenav-link">
                            <div>Sales (Today)</div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Daily Report</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Damange</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Invoice Sale</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Profit Loss Report</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Supplier Ledger</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                </ul>
            </li> --}}
            <!---Reports--->

            <!---Delete--->
            {{-- <li class="sidenav-item">
                <a href="javascript:" class="sidenav-link sidenav-toggle">
                    <i class="sidenav-icon feather icon-home"></i>
                    <div>Delete</div>
                    <div class="pl-1 ml-auto">
                        <!-- <div class="badge badge-danger">Hot</div> -->
                    </div>
                </a>
                <ul class="sidenav-menu">
                    <li class="sidenav-item ">
                        <a href="index.html" class="sidenav-link">
                            <div>User</div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Customer</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Supplier</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Cash Flow</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Sales</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="dashboards_corona.html" class="sidenav-link">
                        <div>Purchase</div>
                        <div class="pl-1 ml-auto">
                            <!-- <div class="badge badge-danger">New</div> -->
                        </div>
                        </a>
                    </li>
                </ul>
            </li> --}}
            <!---Delete--->
            
            <!---Setting--->
            {{-- <li class="sidenav-item  ">
                <a href="javascript:" class="sidenav-link sidenav-toggle">
                    <i class="sidenav-icon feather icon-home"></i>
                    <div>Setting</div>
                    <div class="pl-1 ml-auto">
                        <div class="badge badge-danger"></div>
                    </div>
                </a>
                <ul class="sidenav-menu">
                    <li class="sidenav-item ">
                        <a href="index.html" class="sidenav-link">
                            <div>User</div>
                        </a>
                    </li>
                </ul>
            </li> --}}
            <!---Setting--->
        </ul> 
         <!---left-sidenav-bottom-->










         
        
        {{-- <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <i class="sidenav-icon feather icon-layers"></i>
        <div>Widgets</div>
        <div class="pl-1 ml-auto">
        <div class="badge badge-primary">100+</div>
        </div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item">
        <a href="w-simple.html" class="sidenav-link">
        <div>Simple</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="w-data.html" class="sidenav-link">
        <div>Data</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="w-social.html" class="sidenav-link">
        <div>Social</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="w-chart.html" class="sidenav-link">
        <div>Chart</div>
        </a>
        </li>
        </ul>
        </li>
        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <i class="sidenav-icon feather icon-layout"></i>
        <div>Layouts</div>
        <div class="pl-1 ml-auto">
        <div class="badge badge-success">new</div>
        </div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item">
        <a href="layouts_sidenav_dark.html" class="sidenav-link" target="_blank">
        <div>Navbar dark</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="layouts_header_dark.html" class="sidenav-link" target="_blank">
        <div>Header dark</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="layouts_light.html" class="sidenav-link" target="_blank">
        <div>Light layout</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="layouts_horizontal.html" class="sidenav-link" target="_blank">
        <div>Horizontal</div>
        </a>
        </li>
        </ul>
        </li>

        <li class="sidenav-divider mb-1"></li>
        <li class="sidenav-header small font-weight-semibold">Admin Panels</li>
        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <i class="sidenav-icon feather icon-activity"></i>
        <div>Hospital</div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item"><a href="hospital-dashboard.html" class="sidenav-link">
        <div>Dashboard</div>
        </a></li>
        <li class="sidenav-item"><a href="hospital-department.html" class="sidenav-link">
        <div>Department</div>
        </a></li>
        <li class="sidenav-item"><a href="hospital-doctor.html" class="sidenav-link">
        <div>Doctor</div>
        </a></li>
        <li class="sidenav-item"><a href="hospital-patient.html" class="sidenav-link">
        <div>Patient</div>
        </a></li>
        <li class="sidenav-item"><a href="hospital-nurse.html" class="sidenav-link">
        <div>Nurse</div>
        </a></li>
        <li class="sidenav-item"><a href="hospital-pharmacist.html" class="sidenav-link">
        <div>Pharmacist</div>
        </a></li>
        <li class="sidenav-item"><a href="hospital-laboratorie.html" class="sidenav-link">
        <div>Laboratory</div>
        </a></li>
        </ul>
        </li>
        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <i class="sidenav-icon feather icon-user-check"></i>
        <div>Membership</div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item"><a href="member-dashboard.html" class="sidenav-link">
        <div>Dashboard</div>
        </a></li>
        <li class="sidenav-item"><a href="member-mail-template.html" class="sidenav-link">
        <div>Email templates</div>
        </a></li>
        <li class="sidenav-item"><a href="member-countries.html" class="sidenav-link">
        <div>Country</div>
        </a></li>
        <li class="sidenav-item"><a href="member-coupons.html" class="sidenav-link">
        <div>Coupons</div>
        </a></li>
        <li class="sidenav-item"><a href="member-newsletter.html" class="sidenav-link">
        <div>Newsletter</div>
        </a></li>
        <li class="sidenav-item"><a href="member-user.html" class="sidenav-link">
        <div>User</div>
        </a></li>
        <li class="sidenav-item"><a href="member-membership.html" class="sidenav-link">
        <div>Membership</div>
        </a></li>
        </ul>
        </li>
        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <i class="sidenav-icon feather icon-life-buoy"></i>
        <div>Helpdesk</div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item"><a href="help-dashboard.html" class="sidenav-link">
        <div>Helpdesk dashboard</div>
        </a></li>
        <li class="sidenav-item"><a href="help-create-ticket.html" class="sidenav-link">
        <div>Create ticket</div>
        </a></li>
        <li class="sidenav-item"><a href="help-ticket.html" class="sidenav-link">
        <div>ticket list</div>
        </a></li>
        <li class="sidenav-item"><a href="help-ticket-details.html" class="sidenav-link">
        <div>ticket Details</div>
        </a></li>
        <li class="sidenav-item"><a href="help-customer.html" class="sidenav-link">
        <div>Customer</div>
        </a></li>
        </ul>
        </li>
        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <i class="sidenav-icon feather icon-book"></i>
        <div>School</div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item"><a href="school-dashboard.html" class="sidenav-link">
        <div>Dashboard</div>
        </a></li>
        <li class="sidenav-item"><a href="school-student.html" class="sidenav-link">
        <div>Student</div>
        </a></li>
        <li class="sidenav-item"><a href="school-parents.html" class="sidenav-link">
        <div>Parents</div>
        </a></li>
        <li class="sidenav-item"><a href="school-teacher.html" class="sidenav-link">
        <div>Teacher</div>
        </a></li>
        </ul>
        </li>
        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle" data-toggle="tooltip" title="Student Information System">
        <i class="sidenav-icon feather icon-book"></i>
        <div>SIS</div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item"><a href="sis-dashboard.html" class="sidenav-link">
        <div>Dashboard</div>
        </a></li>
        <li class="sidenav-item"><a href="sis-leave.html" class="sidenav-link">
        <div>Leave</div>
        </a></li>
        <li class="sidenav-item"><a href="sis-evaluation.html" class="sidenav-link">
        <div>Evaluation</div>
        </a></li>
        <li class="sidenav-item"><a href="sis-event.html" class="sidenav-link">
        <div>Event</div>
        </a></li>
        <li class="sidenav-item"><a href="sis-circular.html" class="sidenav-link">
        <div>Circular</div>
        </a></li>
        <li class="sidenav-item"><a href="sis-course.html" class="sidenav-link">
        <div>Course</div>
        </a></li>
        </ul>
        </li>
        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <i class="sidenav-icon feather icon-target"></i>
        <div>Crypto</div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item"><a href="crypto-dashboard.html" class="sidenav-link">
        <div>Dashboard</div>
        </a></li>
        <li class="sidenav-item"><a href="crypto-exchange.html" class="sidenav-link">
        <div>Exchange</div>
        </a></li>
        <li class="sidenav-item"><a href="crypto-wallet.html" class="sidenav-link">
        <div>Wallet</div>
        </a></li>
        <li class="sidenav-item"><a href="crypto-transactions.html" class="sidenav-link">
        <div>Transactions</div>
        </a></li>
        <li class="sidenav-item"><a href="crypto-history.html" class="sidenav-link">
        <div>History</div>
        </a></li>
        <li class="sidenav-item"><a href="crypto-trading.html" class="sidenav-link">
        <div>Trading</div>
        </a></li>
        <li class="sidenav-item"><a href="crypto-initial-coin.html" class="sidenav-link">
        <div>Initial coin</div>
        </a></li>
        <li class="sidenav-item"><a href="crypto-ico-listing.html" class="sidenav-link">
        <div>Ico listing</div>
        </a></li>
        </ul>
        </li>
        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <i class="sidenav-icon feather icon-shopping-cart"></i>
        <div>E-Commerce</div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item"><a href="ecom-product.html" class="sidenav-link">
        <div>Product</div>
        </a></li>
        <li class="sidenav-item"><a href="ecom-product-details.html" class="sidenav-link">
        <div>Product details</div>
        </a></li>
        <li class="sidenav-item"><a href="ecom-order.html" class="sidenav-link">
        <div>Order</div>
        </a></li>
        <li class="sidenav-item"><a href="ecom-checkout.html" class="sidenav-link">
        <div>Checkout</div>
        </a></li>
        <li class="sidenav-item"><a href="ecom-cart.html" class="sidenav-link">
        <div>Shopping Cart</div>
        </a></li>
        <li class="sidenav-item"><a href="ecom-customers.html" class="sidenav-link">
        <div>Customers</div>
        </a></li>
        <li class="sidenav-item"><a href="ecom-sellers.html" class="sidenav-link">
        <div>Sellers</div>
        </a></li>
        </ul>
        </li>

        <li class="sidenav-divider mb-1"></li>
        <li class="sidenav-header small font-weight-semibold">UI Components</li>
        <li class="sidenav-item">
        <a href="typography.html" class="sidenav-link">
        <i class="sidenav-icon feather icon-type"></i>
        <div>Typography</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <i class="sidenav-icon feather icon-box"></i>
        <div>Basic UI</div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item">
        <a href="bui_alert.html" class="sidenav-link">
        <div>Alerts</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="bui_accordion.html" class="sidenav-link">
        <div>Accordion</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="bui_badges.html" class="sidenav-link">
        <div>Badges</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="bui_button.html" class="sidenav-link">
        <div>Buttons</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="bui_button-groups.html" class="sidenav-link">
        <div>Button groups</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="bui_cards.html" class="sidenav-link">
        <div>Cards</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="bui_dropdowns.html" class="sidenav-link">
        <div>Dropdowns</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="bui_modals.html" class="sidenav-link">
        <div>Modals</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="bui_navs.html" class="sidenav-link">
        <div>Navs [ Tabs ]</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="bui_pagination.html" class="sidenav-link">
        <div>Pagination and breadcrumbs</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="bui_progress.html" class="sidenav-link">
        <div>Progress bars</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="bui_tooltips.html" class="sidenav-link">
        <div>Tooltips and popovers</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="bui_thumbnails.html" class="sidenav-link">
        <div>Thumbnails</div>
        </a>
        </li>
        </ul>
        </li>

        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <i class="sidenav-icon feather icon-award"></i>
        <div>Advanced UI</div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item">
        <a href="aui_carousel.html" class="sidenav-link">
        <div>Carousel</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="aui_cropper.html" class="sidenav-link">
        <div>Cropper.js</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="aui_drag-and-drop.html" class="sidenav-link">
        <div>Drag&amp;Drop</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="aui_fullcalendar.html" class="sidenav-link">
        <div>Fullcalendar</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="aui_kanban-board.html" class="sidenav-link">
        <div>Kanban board</div>
        <div class="pl-1 ml-auto">
        <div class="badge badge-success">New</div>
        </div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="aui_ladda.html" class="sidenav-link">
        <div>Ladda</div>
        <div class="pl-1 ml-auto">
        <div class="badge badge-danger">Hot</div>
        </div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="aui_lightbox.html" class="sidenav-link">
        <div>Lightbox</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="aui_media-player.html" class="sidenav-link">
        <div>Media player</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="aui_notifications.html" class="sidenav-link">
        <div>Notifications</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="aui_todo-list.html" class="sidenav-link">
        <div>Todo list</div>
        </a>
        </li>
        </ul>
        </li>

        <li class="sidenav-divider mb-1"></li>
        <li class="sidenav-header small font-weight-semibold">Forms & Tables</li>
        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <i class="sidenav-icon feather icon-clipboard"></i>
        <div>Forms</div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item">
        <a href="forms_layouts.html" class="sidenav-link">
        <div>Layouts and elements</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="forms_controls.html" class="sidenav-link">
        <div>Controls</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="forms_custom-controls.html" class="sidenav-link">
        <div>Custom controls</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="forms_input-groups.html" class="sidenav-link">
        <div>Input groups</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="forms_switchers.html" class="sidenav-link">
        <div>Switchers</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="forms_sliders.html" class="sidenav-link">
        <div>Sliders</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="forms_selects.html" class="sidenav-link">
        <div>Selects and tags</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="forms_pickers.html" class="sidenav-link">
        <div>Pickers</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="forms_editors.html" class="sidenav-link">
        <div>Editors</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="forms_file-upload.html" class="sidenav-link">
        <div>File upload</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="forms_validation.html" class="sidenav-link">
        <div>jQuery Validation</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="forms_wizard.html" class="sidenav-link">
        <div>SmartWizard</div>
        <div class="pl-1 ml-auto">
        <div class="badge badge-danger">Hot</div>
        </div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="forms_typeahead.html" class="sidenav-link">
        <div>Typeahead</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="forms_dual-listbox.html" class="sidenav-link">
        <div>Bootstrap Dual Listbox</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="forms_extras.html" class="sidenav-link">
        <div>Extras</div>
        </a>
        </li>
        </ul>
        </li>
        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <i class="sidenav-icon feather icon-grid"></i>
        <div>Tables</div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item">
        <a href="tables_bootstrap.html" class="sidenav-link">
        <div>Bootstrap</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="tables_datatables.html" class="sidenav-link">
        <div>DataTables</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="tables_footables.html" class="sidenav-link">
        <div>fooTables</div>
        <div class="pl-1 ml-auto">
        <div class="badge badge-danger">NEW</div>
        </div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="tables_bootstrap-table.html" class="sidenav-link">
        <div>Bootstrap table</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="tables_bootstrap-sortable.html" class="sidenav-link">
        <div>Bootstrap Sortable</div>
        </a>
        </li>
        </ul>
        </li>

        <li class="sidenav-divider mb-1"></li>
        <li class="sidenav-header small font-weight-semibold">Chrt & Maps</li>
        <li class="sidenav-item">
        <a href="charts_gmaps.html" class="sidenav-link">
        <i class="sidenav-icon feather icon-map-pin"></i>
        <div>GMaps</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <i class="sidenav-icon feather icon-pie-chart"></i>
        <div>Charts</div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item">
        <a href="charts_am.html" class="sidenav-link">
        <div>AM</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="charts_flot.html" class="sidenav-link">
        <div>Flot.js</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="charts_chartist.html" class="sidenav-link">
        <div>Chartist</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="charts_chartjs.html" class="sidenav-link">
        <div>Chart.js</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="charts_morrisjs.html" class="sidenav-link">
        <div>Morris.js</div>
        </a>
        </li>
        </ul>
        </li>

        <li class="sidenav-divider mb-1"></li>
        <li class="sidenav-header small font-weight-semibold">Icons</li>
        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <i class="sidenav-icon feather icon-feather"></i>
        <div>Icons</div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item">
        <a href="icons_feather.html" class="sidenav-link">
        <div>Feather</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="icons_font-awesome.html" class="sidenav-link">
        <div>Font Awesome 5</div>
        <div class="pl-1 ml-auto">
        <div class="badge badge-primary">New</div>
        </div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="icons_ionicons.html" class="sidenav-link">
        <div>Ionicons</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="icons_linearicons.html" class="sidenav-link">
        <div>Linearicons</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="icons_openiconic.html" class="sidenav-link">
        <div>Open Iconic</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="icons_stroke7.html" class="sidenav-link">
        <div>Stroke Icons 7</div>
        </a>
        </li>
        </ul>
        </li>

        <li class="sidenav-divider mb-1"></li>
        <li class="sidenav-header small font-weight-semibold">Pages</li>
        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <i class="sidenav-icon feather icon-lock"></i>
        <div>Authentication</div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <div>Login</div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item">
        <a href="pages_authentication_login-v1.html" class="sidenav-link">
        <div>Login v1</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_authentication_login-v2.html" class="sidenav-link">
        <div>Login v2</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_authentication_login-v3.html" class="sidenav-link">
        <div>Login v3</div>
        </a>
        </li>
        </ul>
        </li>
        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <div>Signup</div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item">
        <a href="pages_authentication_register-v1.html" class="sidenav-link">
        <div>Register v1</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_authentication_register-v2.html" class="sidenav-link">
        <div>Register v2</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_authentication_register-v3.html" class="sidenav-link">
        <div>Register v3</div>
        </a>
        </li>
        </ul>
        </li>
        <li class="sidenav-item">
        <a href="pages_authentication_login-and-register.html" class="sidenav-link">
        <div>Login + Register</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_authentication_lock-screen-v1.html" class="sidenav-link">
        <div>Lock screen v1</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_authentication_lock-screen-v2.html" class="sidenav-link">
        <div>Lock screen v2</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_authentication_password-reset.html" class="sidenav-link">
        <div>Password reset</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_authentication_email-confirm.html" class="sidenav-link">
        <div>Email confirm</div>
        </a>
        </li>
        </ul>
        </li>
        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <i class="sidenav-icon feather icon-book"></i>
        <div>Education</div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item">
        <a href="pages_education_courses-v1.html" class="sidenav-link">
        <div>Courses v1</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_education_courses-v2.html" class="sidenav-link">
        <div>Courses v2</div>
        </a>
        </li>
        </ul>
        </li>
        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <i class="sidenav-icon feather icon-shopping-cart"></i>
        <div>E-commerce</div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item">
        <a href="pages_e-commerce_product-list.html" class="sidenav-link">
        <div>Product list</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_e-commerce_product-item.html" class="sidenav-link">
        <div>Product item</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_e-commerce_product-edit.html" class="sidenav-link">
        <div>Product edit</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_e-commerce_order-list.html" class="sidenav-link">
        <div>Order list</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_e-commerce_order-detail.html" class="sidenav-link">
        <div>Order detail</div>
        </a>
        </li>
        </ul>
        </li>
        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <i class="sidenav-icon feather icon-mail"></i>
        <div>Email</div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item">
        <a href="pages_messages_v3_list.html" class="sidenav-link">
        <div>List</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_messages_v3_item.html" class="sidenav-link">
        <div>Item</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_messages_v3_compose.html" class="sidenav-link">
        <div>Compose</div>
        </a>
        </li>
        </ul>
        </li>
        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <i class="sidenav-icon feather icon-codepen"></i>
        <div>Projects</div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item">
        <a href="pages_projects_list.html" class="sidenav-link">
        <div>List</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_projects_item.html" class="sidenav-link">
        <div>Item</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_teams.html" class="sidenav-link">
        <div>Teams</div>
        </a>
        </li>
        </ul>
        </li>
        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <i class="sidenav-icon feather icon-shield"></i>
        <div>Tickets</div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item">
        <a href="pages_tickets_list.html" class="sidenav-link">
        <div>List</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_tickets_edit.html" class="sidenav-link">
        <div>Edit</div>
        </a>
        </li>
        </ul>
        </li>
        <li class="sidenav-item">
        <a href="javascript:" class="sidenav-link sidenav-toggle">
        <i class="sidenav-icon feather icon-users"></i>
        <div>Users</div>
        </a>
        <ul class="sidenav-menu">
        <li class="sidenav-item">
        <a href="pages_users_list.html" class="sidenav-link">
        <div>List</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_users_view.html" class="sidenav-link">
        <div>View</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_profile-v1.html" class="sidenav-link">
        <div>Profile v1</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_profile-v2.html" class="sidenav-link">
        <div>Profile v2</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_users_edit.html" class="sidenav-link">
        <div>Edit</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_account-settings.html" class="sidenav-link">
        <div>Account settings</div>
        </a>
        </li>
        </ul>
        </li>
        <li class="sidenav-item">
        <a href="pages_chat.html" class="sidenav-link">
        <i class="sidenav-icon feather icon-message-square"></i>
        <div>Chat</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_faq.html" class="sidenav-link">
        <i class="sidenav-icon feather icon-anchor"></i>
        <div>FAQ</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_gallery.html" class="sidenav-link">
        <i class="sidenav-icon feather icon-image"></i>
        <div>Gallery</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_help-center.html" class="sidenav-link">
        <i class="sidenav-icon feather icon-help-circle"></i>
        <div>Help center</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_invoice.html" class="sidenav-link">
        <i class="sidenav-icon feather icon-printer"></i>
        <div>Invoice</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_search-results.html" class="sidenav-link">
        <i class="sidenav-icon feather feather icon-filter"></i>
        <div>Search results</div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_voting.html" class="sidenav-link">
        <i class="sidenav-icon feather icon-thumbs-up"></i>
        <div>Voting</div>
        <div class="pl-1 ml-auto"><div class="badge badge-success">new</div></div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_pricing.html" class="sidenav-link">
        <i class="sidenav-icon feather icon-tag"></i>
        <div>Pricing</div>
        <div class="pl-1 ml-auto"><div class="badge badge-success">new</div></div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_file-manger.html" class="sidenav-link">
        <i class="sidenav-icon feather icon-folder"></i>
        <div>file manager</div>
        <div class="pl-1 ml-auto"><div class="badge badge-success">new</div></div>
        </a>
        </li>
        <li class="sidenav-item">
        <a href="pages_clients.html" class="sidenav-link">
        <i class="sidenav-icon feather icon-users"></i>
        <div>Clients</div>
        <div class="pl-1 ml-auto"><div class="badge badge-success">new</div></div>
        </a>
        </li>
    </ul> 
</div>--}}
