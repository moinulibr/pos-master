<style>
    .select-product th {
        border: 1px solid #ddd;
    }
    .sticky-head {
        position: sticky;
        top: 0;
        background: white;
        padding: 10px 0;
    }
</style>
<!---------added to cart product list----------->
<div class="card-body h-100">
    <div class="table-responsive table-datapos col-md-12" id="printableTable">
        <table id="orderTable" class="display" style="width: 100%; font-family: Open Sans, Roboto, -apple-system, BlinkMacSystemFont,
        Segoe UI, Oxygen, Ubuntu, Cantarell, Fira Sans, Droid Sans, Helvetica Neue, sans-serif;">
            <thead class="thead-dark">
                <tr>
                    <th class="sticky-head" style="width: 3%;background-color: #f7f7f7;">Sl</th>
                    <th class="sticky-head" style="width: 35%;text-align:center;background-color: #f7f7f7;">Name</th>
                    <th class="sticky-head" style="width: 10%;text-align:center;background-color: #f7f7f7;">Selling <br/> Price</th>
                    <th class="sticky-head" style="width: 11%;text-align:center;background-color: #f7f7f7;">Unit</th>
                    <th class="sticky-head" style="width: 11%;text-align:center;background-color: #f7f7f7;">Unit <br/> Price</th>
                    <th class="sticky-head" style="width: 11%;text-align:center;background-color: #f7f7f7;">Quantity</th>
                    <th class="sticky-head" style="width: 5%;text-align:center;background-color: #f7f7f7;">Less <br/>Amount</th>
                    <th class="sticky-head" style="width: 11%;text-align:center;background-color: #f7f7f7;">Subtotal</th>
                    <th class="sticky-head" style="width: 3%;background-color: #f7f7f7;"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $cartName = [];
                    $cartName     = session()->has(sellCreateCartSessionName_hh()) ? session()->get(sellCreateCartSessionName_hh())  : [];
                    $totalProduct = 1;
                @endphp
                @forelse ($cartName as $item)
                <tr style="border-bottom: 0.05px dashed #dddfe0;">
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;background-color: #f5f5f5">
                        {{$totalProduct}}.
                    </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">
                        {{$item['product_name']}}
                    </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">
                        {{$item['final_sell_price']}}
                    </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">
                        {{$item['unit_name']}}<br/>
                    </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">
                        {{ displayMrpOrRegularSellPriceInTheCustomerInvoice_hh() == 1 ? $item['mrp_price'] : $item['sell_price'] }}
                    </td>

                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">
                        <span class="quantityChange" data-change_type="minus" data-product_id="{{$item['product_id']}}" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-minus-circle"></i>
                        </span>
            
                        <span id="set-1" class="total_cart_quantity">{{$item['final_sell_quantity']}}</span>
            
                        <span class="quantityChange" data-change_type="plus" data-product_id="{{$item['product_id']}}" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                        
                        <br>
                        <strong id="not_available_message_1" style="font-size:11px; color:red;"></strong>
                    </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">
                        {{$item['total_discount_amount'] ?? 00.00 }}
                    </td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">
                        {{$item['selling_final_amount'] ?? 00.00 }}
                        <input type="hidden" class="selling_final_subtotal_amount_from_cartlist" value=" {{$item['selling_final_amount'] ?? 00.00 }}">
                        <input type="hidden" class="total_purchase_price_of_all_quantity_from_cartlist" value=" {{$item['total_purchase_price_of_all_quantity'] ?? 00.00 }}">
                    </td>
                    <td style="padding-top:1%;padding-bottom:1%;">
                        <div class="card-toolbar text-right">
                            <a href="#" data-product_id="{{$item['product_id']}}" class="remove_this_item_from_sell_cart_list remove_this_item_from_sell_cart_list_{{$item['product_id']}}" title="Delete"><i style="color: red" class="fas fa-trash-alt"></i></a>
                        </div>
                    </td>
                </tr>
                @php
                    $totalProduct++;
                @endphp

                @empty
                <tr>
                    <th colspan="9" style="text-align: center;border-bottom: 1px solid ##f7f7f7;">No data found</th>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<!---------added to cart product list----------->
<input type="hidden" class="total_item_from_cartlist" value="{{ $totalProduct -1 }}">

















{{-- 
<div class="card-body h-100">
    <div class="table-responsive table-datapos col-md-12" id="printableTable">
        <table id="orderTable" class="display" style="width: 100%; font-family: Open Sans, Roboto, -apple-system, BlinkMacSystemFont,
        Segoe UI, Oxygen, Ubuntu, Cantarell, Fira Sans, Droid Sans, Helvetica Neue, sans-serif;">
            <thead class="thead-dark">
                <tr>
                    <th class="sticky-head" style="width: 3%;background-color: #f7f7f7;">Sl</th>
                    <th class="sticky-head" style="width: 35%;text-align:center;background-color: #f7f7f7;">Name</th>
                    <th class="sticky-head" style="width: 15%;text-align:center;background-color: #f7f7f7;">Unit</th>
                    <th class="sticky-head" style="width: 11%;text-align:center;background-color: #f7f7f7;">Unit <br/> Price</th>
                    <th class="sticky-head" style="width: 11%;text-align:center;background-color: #f7f7f7;">Quantity</th>
                    <th class="sticky-head" style="width: 11%;text-align:center;background-color: #f7f7f7;">Less <br/>Amount</th>
                    <th class="sticky-head" style="width: 11%;text-align:center;background-color: #f7f7f7;">Subtotal</th>
                    <th class="sticky-head" style="width: 3%;background-color: #f7f7f7;"></th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 0.05px dashed #dddfe0;">
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;background-color: #f5f5f5">20.</td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">Tiger Nixon Tiger Nixon Tiger Nixon Tiger Nixon Tiger Nixon </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">Unit Name</td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">1000.00</td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">
                        <span class="quantityChange" data-change_type="minus" data-product_id="1" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-minus-circle"></i>
                        </span>
            
                        <span id="set-1">100</span>
            
                        <span class="quantityChange" data-change_type="plus" data-product_id="1" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                        
                        <br>
                        <strong id="not_available_message_1" style="font-size:11px; color:red;"></strong>
                    </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">000</td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">000</td>
                    <td style="padding-top:1%;padding-bottom:1%;">
                        <div class="card-toolbar text-right">
                            <a href="#" class="confirm-delete" title="Delete"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </td>
                </tr>
                <tr style="border-bottom: 0.05px dashed #dddfe0;">
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;background-color: #f5f5f5">20.</td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">Tiger Nixon Tiger Nixon Tiger Nixon Tiger Nixon Tiger Nixon </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">Unit Name</td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">1000.00</td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">
                        <span class="quantityChange" data-change_type="minus" data-product_id="1" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-minus-circle"></i>
                        </span>
            
                        <span id="set-1">100</span>
            
                        <span class="quantityChange" data-change_type="plus" data-product_id="1" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                        
                        <br>
                        <strong id="not_available_message_1" style="font-size:11px; color:red;"></strong>
                    </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">000</td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">000</td>
                    <td style="padding-top:1%;padding-bottom:1%;">
                        <div class="card-toolbar text-right">
                            <a href="#" class="confirm-delete" title="Delete"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </td>
                </tr>
                <tr style="border-bottom: 0.05px dashed #dddfe0;">
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;background-color: #f5f5f5">20.</td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">Tiger Nixon Tiger Nixon Tiger Nixon Tiger Nixon Tiger Nixon </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">Unit Name</td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">1000.00</td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">
                        <span class="quantityChange" data-change_type="minus" data-product_id="1" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-minus-circle"></i>
                        </span>
            
                        <span id="set-1">100</span>
            
                        <span class="quantityChange" data-change_type="plus" data-product_id="1" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                        
                        <br>
                        <strong id="not_available_message_1" style="font-size:11px; color:red;"></strong>
                    </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">000</td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">000</td>
                    <td style="padding-top:1%;padding-bottom:1%;">
                        <div class="card-toolbar text-right">
                            <a href="#" class="confirm-delete" title="Delete"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </td>
                </tr>
                <tr style="border-bottom: 0.05px dashed #dddfe0;">
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;background-color: #f5f5f5">20.</td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">Tiger Nixon Tiger Nixon Tiger Nixon Tiger Nixon Tiger Nixon </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">Unit Name</td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">1000.00</td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">
                        <span class="quantityChange" data-change_type="minus" data-product_id="1" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-minus-circle"></i>
                        </span>
            
                        <span id="set-1">100</span>
            
                        <span class="quantityChange" data-change_type="plus" data-product_id="1" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                        
                        <br>
                        <strong id="not_available_message_1" style="font-size:11px; color:red;"></strong>
                    </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">000</td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">000</td>
                    <td style="padding-top:1%;padding-bottom:1%;">
                        <div class="card-toolbar text-right">
                            <a href="#" class="confirm-delete" title="Delete"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </td>
                </tr>
                <tr style="border-bottom: 0.05px dashed #dddfe0;">
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;background-color: #f5f5f5">20.</td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">Tiger Nixon Tiger Nixon Tiger Nixon Tiger Nixon Tiger Nixon </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">Unit Name</td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">1000.00</td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">
                        <span class="quantityChange" data-change_type="minus" data-product_id="1" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-minus-circle"></i>
                        </span>
            
                        <span id="set-1">100</span>
            
                        <span class="quantityChange" data-change_type="plus" data-product_id="1" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                        
                        <br>
                        <strong id="not_available_message_1" style="font-size:11px; color:red;"></strong>
                    </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">000</td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">000</td>
                    <td style="padding-top:1%;padding-bottom:1%;">
                        <div class="card-toolbar text-right">
                            <a href="#" class="confirm-delete" title="Delete"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </td>
                </tr>
                <tr style="border-bottom: 0.05px dashed #dddfe0;">
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;background-color: #f5f5f5">20.</td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">Tiger Nixon Tiger Nixon Tiger Nixon Tiger Nixon Tiger Nixon </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">Unit Name</td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">1000.00</td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">
                        <span class="quantityChange" data-change_type="minus" data-product_id="1" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-minus-circle"></i>
                        </span>
            
                        <span id="set-1">100</span>
            
                        <span class="quantityChange" data-change_type="plus" data-product_id="1" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                        
                        <br>
                        <strong id="not_available_message_1" style="font-size:11px; color:red;"></strong>
                    </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">000</td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">000</td>
                    <td style="padding-top:1%;padding-bottom:1%;">
                        <div class="card-toolbar text-right">
                            <a href="#" class="confirm-delete" title="Delete"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </td>
                </tr>
                <tr style="border-bottom: 0.05px dashed #dddfe0;">
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;background-color: #f5f5f5">20.</td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">Tiger Nixon Tiger Nixon Tiger Nixon Tiger Nixon Tiger Nixon </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">Unit Name</td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">1000.00</td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">
                        <span class="quantityChange" data-change_type="minus" data-product_id="1" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-minus-circle"></i>
                        </span>
            
                        <span id="set-1">100</span>
            
                        <span class="quantityChange" data-change_type="plus" data-product_id="1" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                        
                        <br>
                        <strong id="not_available_message_1" style="font-size:11px; color:red;"></strong>
                    </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">000</td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">000</td>
                    <td style="padding-top:1%;padding-bottom:1%;">
                        <div class="card-toolbar text-right">
                            <a href="#" class="confirm-delete" title="Delete"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </td>
                </tr>
                <tr style="border-bottom: 0.05px dashed #dddfe0;">
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;background-color: #f5f5f5">20.</td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">Tiger Nixon Tiger Nixon Tiger Nixon Tiger Nixon Tiger Nixon </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">Unit Name</td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">1000.00</td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">
                        <span class="quantityChange" data-change_type="minus" data-product_id="1" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-minus-circle"></i>
                        </span>
            
                        <span id="set-1">100</span>
            
                        <span class="quantityChange" data-change_type="plus" data-product_id="1" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                        
                        <br>
                        <strong id="not_available_message_1" style="font-size:11px; color:red;"></strong>
                    </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">000</td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">000</td>
                    <td style="padding-top:1%;padding-bottom:1%;">
                        <div class="card-toolbar text-right">
                            <a href="#" class="confirm-delete" title="Delete"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </td>
                </tr>
                <tr style="border-bottom: 0.05px dashed #dddfe0;">
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;background-color: #f5f5f5">20.</td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">Tiger Nixon Tiger Nixon Tiger Nixon Tiger Nixon Tiger Nixon </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">Unit Name</td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">1000.00</td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">
                        <span class="quantityChange" data-change_type="minus" data-product_id="1" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-minus-circle"></i>
                        </span>
            
                        <span id="set-1">100</span>
            
                        <span class="quantityChange" data-change_type="plus" data-product_id="1" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                        
                        <br>
                        <strong id="not_available_message_1" style="font-size:11px; color:red;"></strong>
                    </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">000</td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">000</td>
                    <td style="padding-top:1%;padding-bottom:1%;">
                        <div class="card-toolbar text-right">
                            <a href="#" class="confirm-delete" title="Delete"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </td>
                </tr>
                <tr style="border-bottom: 0.05px dashed #dddfe0;">
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;background-color: #f5f5f5">20.</td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">Tiger Nixon Tiger Nixon Tiger Nixon Tiger Nixon Tiger Nixon </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">Unit Name</td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">1000.00</td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">
                        <span class="quantityChange" data-change_type="minus" data-product_id="1" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-minus-circle"></i>
                        </span>
            
                        <span id="set-1">100</span>
            
                        <span class="quantityChange" data-change_type="plus" data-product_id="1" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                        
                        <br>
                        <strong id="not_available_message_1" style="font-size:11px; color:red;"></strong>
                    </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">000</td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">000</td>
                    <td style="padding-top:1%;padding-bottom:1%;">
                        <div class="card-toolbar text-right">
                            <a href="#" class="confirm-delete" title="Delete"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </td>
                </tr>
                <tr style="border-bottom: 0.05px dashed #dddfe0;">
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;background-color: #f5f5f5">20.</td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">Tiger Nixon Tiger Nixon Tiger Nixon Tiger Nixon Tiger Nixon </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">Unit Name</td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">1000.00</td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">
                        <span class="quantityChange" data-change_type="minus" data-product_id="1" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-minus-circle"></i>
                        </span>
            
                        <span id="set-1">100</span>
            
                        <span class="quantityChange" data-change_type="plus" data-product_id="1" data-quantity="1" style="cursor:pointer">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                        
                        <br>
                        <strong id="not_available_message_1" style="font-size:11px; color:red;"></strong>
                    </td>
                    <td style="text-align:center;padding-top:1%;padding-bottom:1%;">000</td>
                    <td style="text-align:center;background-color: #f5f5f5;padding-top:1%;padding-bottom:1%;">000</td>
                    <td style="padding-top:1%;padding-bottom:1%;">
                        <div class="card-toolbar text-right">
                            <a href="#" class="confirm-delete" title="Delete"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>
</div> --}}