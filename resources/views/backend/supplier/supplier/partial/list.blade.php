<div class="table-responsive">
    <table class="table table-bordered mb-0">
        <thead>
            <tr>
                <th style="width:5%;">Action</th>
                <th  style="width:3%;">#</th>
                <th  style="width:3%;">C.ID</th>
                <th>Name</th>
                <th>
                    <small>Supplier Type</small>
                </th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $index => $item)
                <tr>
                    <td style="width:3%;">
                        <div class="btn-group btnGroupForMoreAction">
                            <button type="button" class="btn btn-sm" data-toggle="dropdown" aria-expanded="true">
                                <i class="fas fa-ellipsis-v"></i>
                                {{-- <i class="fas fa-cogs"></i> --}}
                            </button>
                            <div class="dropdown-menu " x-placement="top-start" style="position: absolute; will-change: top, left; top: -183px; left: 0px;">
                                {{-- <a class="dropdown-item" href="javascript:void(0)">View</a> --}}
                                <a class="dropdown-item singleEditModal" data-id="{{$item->id}}" href="javascript:void(0)">Edit</a>
                                <a class="dropdown-item singleDeleteModal" data-id="{{$item->id}}" data-name="{{$item->name}}" href="javascript:void(0)">Delete</a>
                            {{-- <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)">Separated link</a>
                            </div> --}}
                        </div>
                    </td>
                    <th scope="row">
                        {{$index + 1}}
                    </th>
                    <th scope="row">
                        {{$item->custom_id}}
                    </th>
                    <td>
                        {{$item->name}}
                    </td> 
                    <td>
                        <small>
                            {{$item->supplierTypies ? $item->supplierTypies->name : ""}}
                        </small>
                    </td> 
                    <td>
                        {{$item->phone}}
                    </td>
                    <td>
                        {{$item->email ?? "No Email"}}
                    </td> 
                    <td>
                        <small>
                            {{$item->address}}
                        </small>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$datas->links()}}
</div>





<br/><br/><br/>


<div class="table-responsive">
    <table class="table table-bordered mb-0">
    <thead>
        <tr>
            <th>Action</th>
            <th style="width:3%">SN</th>
            <th style="width:3%">S.ID</th>
            <th>Supplier Name</th>
            
            
            <th>Supplier Mobile</th>
            <th>Opening Due</th>
            <th>Total Due</th>
            <th>Advance</th>
            <th>AS Code Serial </th>
            <th>Avail. Stock</th>
            <th>Used</th>

        </tr>
    </thead>
    <tbody>
            <tr>

                <td>

                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            <i class="fa fa-gear tiny-icon"></i> <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu" aria-labelledby="triggerId">
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/1"><i class="fa fa-eye tiny-icon"></i> Show</a>
                            </li>

                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/low-stock-products?supplier_id=1"><i class="fa fa-shopping-cart tiny-icon"></i> Low Stock
                                    Products</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/low-stock-products?supplier_id=1&amp;low_stock=1"><i class="fa fa-shopping-cart tiny-icon"></i> Low Alert Stock
                                    Products</a>
                            </li>


                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/damage/1"> <i class="fa fa-ban tiny-icon"></i>
                                    <span class="menu-text">Damage</span>
                                </a>
                            </li>

                            <li class="dropdown-item">
                                <a href="#" class="paymentBtn" data-id="1"><i class="fa fa-money tiny-icon"></i> Make Payment
                                </a>
                            </li>

                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/paymenthistory/1"><i class="fa fa-money tiny-icon"></i>
                                    <span class="menu-text">Payment Histroy</span>
                                </a>
                            </li>
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/1/edit"><i class="fa fa-pencil tiny-icon"></i> Supplier Edit</a>
                            </li>

                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/purchase/index/1"><i class="fa fa-list tiny-icon"></i> Purchase History</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/purchase/1/product-receive-history"><i class="fa fa-list tiny-icon"></i> Purchase Detail History</a>
                            </li>


                            <li class="dropdown-item">
                                <a class="delete" href="https://test.nanarokom247.com/supplier/1"><i class="fa fa-trash tiny-icon"></i> Delete</a>
                            </li>
                            
                        </div>



                </div></td>
                <td>1</td>
                <td></td>
                <td>Supplier 1</td>
                
                <td>12345678900</td>
                <td>0.00</td>
                <td>0</td>
                <td>0</td>
                <td></td>
                <td> 4669 </td>
                <td> 3 </td>

            </tr>
                                        <tr>

                <td>

                    <div class="btn-group">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-gear tiny-icon"></i> <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu" aria-labelledby="triggerId">
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/4"><i class="fa fa-eye tiny-icon"></i> Show</a>
                            </li>

                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/low-stock-products?supplier_id=4"><i class="fa fa-shopping-cart tiny-icon"></i> Low Stock
                                    Products</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/low-stock-products?supplier_id=4&amp;low_stock=1"><i class="fa fa-shopping-cart tiny-icon"></i> Low Alert Stock
                                    Products</a>
                            </li>


                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/damage/4"> <i class="fa fa-ban tiny-icon"></i>
                                    <span class="menu-text">Damage</span>
                                </a>
                            </li>

                            <li class="dropdown-item">
                                <a href="#" class="paymentBtn" data-id="4"><i class="fa fa-money tiny-icon"></i> Make Payment
                                </a>
                            </li>

                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/paymenthistory/4"><i class="fa fa-money tiny-icon"></i>
                                    <span class="menu-text">Payment Histroy</span>
                                </a>
                            </li>
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/4/edit"><i class="fa fa-pencil tiny-icon"></i> Supplier Edit</a>
                            </li>

                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/purchase/index/4"><i class="fa fa-list tiny-icon"></i> Purchase History</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/purchase/4/product-receive-history"><i class="fa fa-list tiny-icon"></i> Purchase Detail History</a>
                            </li>


                            <li class="dropdown-item">
                                <a class="delete" href="https://test.nanarokom247.com/supplier/4"><i class="fa fa-trash tiny-icon"></i> Delete</a>
                            </li>
                            
                        </div>



                </div></td>
                <td>2</td>
                <td></td>
                <td>KARNAFULLY GALVANIZING MILLS LTD</td>
                
                <td>01708810661</td>
                <td>442430.00</td>
                <td>442430</td>
                <td>0</td>
                <td></td>
                <td> 1500 </td>
                <td> 54 </td>

            </tr>
                                        <tr>

                <td>

                    <div class="btn-group">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-gear tiny-icon"></i> <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu" aria-labelledby="triggerId">
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/5"><i class="fa fa-eye tiny-icon"></i> Show</a>
                            </li>

                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/low-stock-products?supplier_id=5"><i class="fa fa-shopping-cart tiny-icon"></i> Low Stock
                                    Products</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/low-stock-products?supplier_id=5&amp;low_stock=1"><i class="fa fa-shopping-cart tiny-icon"></i> Low Alert Stock
                                    Products</a>
                            </li>


                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/damage/5"> <i class="fa fa-ban tiny-icon"></i>
                                    <span class="menu-text">Damage</span>
                                </a>
                            </li>

                            <li class="dropdown-item">
                                <a href="#" class="paymentBtn" data-id="5"><i class="fa fa-money tiny-icon"></i> Make Payment
                                </a>
                            </li>

                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/paymenthistory/5"><i class="fa fa-money tiny-icon"></i>
                                    <span class="menu-text">Payment Histroy</span>
                                </a>
                            </li>
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/5/edit"><i class="fa fa-pencil tiny-icon"></i> Supplier Edit</a>
                            </li>

                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/purchase/index/5"><i class="fa fa-list tiny-icon"></i> Purchase History</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/purchase/5/product-receive-history"><i class="fa fa-list tiny-icon"></i> Purchase Detail History</a>
                            </li>


                            <li class="dropdown-item">
                                <a class="delete" href="https://test.nanarokom247.com/supplier/5"><i class="fa fa-trash tiny-icon"></i> Delete</a>
                            </li>
                            
                        </div>



                </div></td>
                <td>3</td>
                <td></td>
                <td>PHP GROUP</td>
                
                <td></td>
                <td>0.00</td>
                <td>0</td>
                <td>0</td>
                <td></td>
                <td> 0 </td>
                <td> 0 </td>

            </tr>
                                        <tr>

                <td>

                    <div class="btn-group">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-gear tiny-icon"></i> <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu" aria-labelledby="triggerId">
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/6"><i class="fa fa-eye tiny-icon"></i> Show</a>
                            </li>

                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/low-stock-products?supplier_id=6"><i class="fa fa-shopping-cart tiny-icon"></i> Low Stock
                                    Products</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/low-stock-products?supplier_id=6&amp;low_stock=1"><i class="fa fa-shopping-cart tiny-icon"></i> Low Alert Stock
                                    Products</a>
                            </li>


                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/damage/6"> <i class="fa fa-ban tiny-icon"></i>
                                    <span class="menu-text">Damage</span>
                                </a>
                            </li>

                            <li class="dropdown-item">
                                <a href="#" class="paymentBtn" data-id="6"><i class="fa fa-money tiny-icon"></i> Make Payment
                                </a>
                            </li>

                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/paymenthistory/6"><i class="fa fa-money tiny-icon"></i>
                                    <span class="menu-text">Payment Histroy</span>
                                </a>
                            </li>
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/6/edit"><i class="fa fa-pencil tiny-icon"></i> Supplier Edit</a>
                            </li>

                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/purchase/index/6"><i class="fa fa-list tiny-icon"></i> Purchase History</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/purchase/6/product-receive-history"><i class="fa fa-list tiny-icon"></i> Purchase Detail History</a>
                            </li>


                            <li class="dropdown-item">
                                <a class="delete" href="https://test.nanarokom247.com/supplier/6"><i class="fa fa-trash tiny-icon"></i> Delete</a>
                            </li>
                            
                        </div>



                </div></td>
                <td>4</td>
                <td></td>
                <td>P.H.P GROUP</td>
                
                <td></td>
                <td>0.00</td>
                <td>0</td>
                <td>0</td>
                <td></td>
                <td> 1267 </td>
                <td> 48 </td>

            </tr>
                                        <tr>

                <td>

                    <div class="btn-group">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-gear tiny-icon"></i> <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu" aria-labelledby="triggerId">
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/7"><i class="fa fa-eye tiny-icon"></i> Show</a>
                            </li>

                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/low-stock-products?supplier_id=7"><i class="fa fa-shopping-cart tiny-icon"></i> Low Stock
                                    Products</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/low-stock-products?supplier_id=7&amp;low_stock=1"><i class="fa fa-shopping-cart tiny-icon"></i> Low Alert Stock
                                    Products</a>
                            </li>


                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/damage/7"> <i class="fa fa-ban tiny-icon"></i>
                                    <span class="menu-text">Damage</span>
                                </a>
                            </li>

                            <li class="dropdown-item">
                                <a href="#" class="paymentBtn" data-id="7"><i class="fa fa-money tiny-icon"></i> Make Payment
                                </a>
                            </li>

                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/paymenthistory/7"><i class="fa fa-money tiny-icon"></i>
                                    <span class="menu-text">Payment Histroy</span>
                                </a>
                            </li>
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/7/edit"><i class="fa fa-pencil tiny-icon"></i> Supplier Edit</a>
                            </li>

                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/purchase/index/7"><i class="fa fa-list tiny-icon"></i> Purchase History</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/purchase/7/product-receive-history"><i class="fa fa-list tiny-icon"></i> Purchase Detail History</a>
                            </li>


                            <li class="dropdown-item">
                                <a class="delete" href="https://test.nanarokom247.com/supplier/7"><i class="fa fa-trash tiny-icon"></i> Delete</a>
                            </li>
                            
                        </div>



                </div></td>
                <td>5</td>
                <td></td>
                <td>ALIF STEEL</td>
                
                <td></td>
                <td>0.00</td>
                <td>0</td>
                <td>0</td>
                <td></td>
                <td> 0 </td>
                <td> 1 </td>

            </tr>
                                        <tr>

                <td>

                    <div class="btn-group">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-gear tiny-icon"></i> <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu" aria-labelledby="triggerId">
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/2"><i class="fa fa-eye tiny-icon"></i> Show</a>
                            </li>

                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/low-stock-products?supplier_id=2"><i class="fa fa-shopping-cart tiny-icon"></i> Low Stock
                                    Products</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/low-stock-products?supplier_id=2&amp;low_stock=1"><i class="fa fa-shopping-cart tiny-icon"></i> Low Alert Stock
                                    Products</a>
                            </li>


                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/damage/2"> <i class="fa fa-ban tiny-icon"></i>
                                    <span class="menu-text">Damage</span>
                                </a>
                            </li>

                            <li class="dropdown-item">
                                <a href="#" class="paymentBtn" data-id="2"><i class="fa fa-money tiny-icon"></i> Make Payment
                                </a>
                            </li>

                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/paymenthistory/2"><i class="fa fa-money tiny-icon"></i>
                                    <span class="menu-text">Payment Histroy</span>
                                </a>
                            </li>
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/2/edit"><i class="fa fa-pencil tiny-icon"></i> Supplier Edit</a>
                            </li>

                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/purchase/index/2"><i class="fa fa-list tiny-icon"></i> Purchase History</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/purchase/2/product-receive-history"><i class="fa fa-list tiny-icon"></i> Purchase Detail History</a>
                            </li>


                            <li class="dropdown-item">
                                <a class="delete" href="https://test.nanarokom247.com/supplier/2"><i class="fa fa-trash tiny-icon"></i> Delete</a>
                            </li>
                            
                        </div>



                </div></td>
                <td>6</td>
                <td>2</td>
                <td>Supplier 02</td>
                
                <td>01723019475</td>
                <td>0.00</td>
                <td>0</td>
                <td>0</td>
                <td>1-100</td>
                <td> 0 </td>
                <td> 0 </td>

            </tr>
                                        <tr>

                <td>

                    <div class="btn-group">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-gear tiny-icon"></i> <span class="caret"></span>
                        </button>

                        <div class="dropdown-menu" aria-labelledby="triggerId">
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/3"><i class="fa fa-eye tiny-icon"></i> Show</a>
                            </li>

                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/low-stock-products?supplier_id=3"><i class="fa fa-shopping-cart tiny-icon"></i> Low Stock
                                    Products</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/low-stock-products?supplier_id=3&amp;low_stock=1"><i class="fa fa-shopping-cart tiny-icon"></i> Low Alert Stock
                                    Products</a>
                            </li>


                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/damage/3"> <i class="fa fa-ban tiny-icon"></i>
                                    <span class="menu-text">Damage</span>
                                </a>
                            </li>

                            <li class="dropdown-item">
                                <a href="#" class="paymentBtn" data-id="3"><i class="fa fa-money tiny-icon"></i> Make Payment
                                </a>
                            </li>

                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/paymenthistory/3"><i class="fa fa-money tiny-icon"></i>
                                    <span class="menu-text">Payment Histroy</span>
                                </a>
                            </li>
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/3/edit"><i class="fa fa-pencil tiny-icon"></i> Supplier Edit</a>
                            </li>

                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/purchase/index/3"><i class="fa fa-list tiny-icon"></i> Purchase History</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="https://test.nanarokom247.com/supplier/purchase/3/product-receive-history"><i class="fa fa-list tiny-icon"></i> Purchase Detail History</a>
                            </li>


                            <li class="dropdown-item">
                                <a class="delete" href="https://test.nanarokom247.com/supplier/3"><i class="fa fa-trash tiny-icon"></i> Delete</a>
                            </li>
                            
                        </div>



                </div></td>
                <td>7</td>
                <td>3</td>
                <td>Supplier 03</td>
                
                <td>01779325718</td>
                <td>0.00</td>
                <td>0</td>
                <td>0</td>
                <td>101-200</td>
                <td> 0 </td>
                <td> 0 </td>

            </tr>
        
    </tbody>

    </table>
</div>