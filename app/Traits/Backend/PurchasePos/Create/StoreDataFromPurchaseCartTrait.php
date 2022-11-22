<?php
namespace App\Traits\Backend\PurchasePos\Create;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Backend\Sell\SellInvoice;
use App\Models\Backend\Sell\SellPackage;
use App\Models\Backend\Sell\SellProduct;
use App\Models\Backend\Customer\Customer;
use App\Models\Backend\Supplier\Supplier;
use App\Models\Backend\Price\ProductPrice;
use App\Models\Backend\Sell\SellQuotation;
use App\Models\Backend\Stock\ProductStock;
use App\Models\Backend\Sell\SellProductStock;
use App\Setting\Backend\Product\ProductSetting;
use App\Models\Backend\Purchase\PurchaseInvoice;
use App\Models\Backend\Purchase\PurchaseProduct;
use App\Traits\Backend\FileUpload\FileUploadTrait;
use App\Models\Backend\Purchase\PurchaseProductStock;
use App\Traits\Backend\Stock\Logical\StockChangingTrait;
use App\Traits\Backend\Payment\PaymentProcessTrait;
/**
 * store data trait
 * 
 */
trait StoreDataFromPurchaseCartTrait
{    
    use FileUploadTrait;
    use StockChangingTrait;
    use ProductSetting;
    use PaymentProcessTrait;

    protected $purchaseCreateFormRequestData;
    protected $totalPurchasePriceOfAllQuantityOfThisInvoice;


    //store session data from purchase cart
    protected function storeSessionDataFromPurchaseCart()
    {   
        $purchaseCartName = purchaseCreateCartSessionName_hh();
        $purchaseSessionCarts  = [];
        $purchaseSessionCarts  = session()->has($purchaseCartName) ? session()->get($purchaseCartName)  : [];
        
        $purchaseInvoiceSummeryCartName = purchaseCreateCartInvoiceSummerySessionName_hh();
        $purchaseInvoiceSummeryCart = [];
        $purchaseInvoiceSummeryCart = session()->has($purchaseInvoiceSummeryCartName) ? session()->get($purchaseInvoiceSummeryCartName)  : [];
        
        // purchase invoice table 
        $purchaseInvoice =  $this->insertDataInThePurchaseInvoiceTable($purchaseInvoiceSummeryCart);

        $this->totalPurchasePriceOfAllQuantityOfThisInvoice = 0;
        foreach($purchaseSessionCarts as $purchaseSessionCart)
        {
            //purchase product table 
            $purchaseProduct =  $this->insertDataInThePurchaseProduct($purchaseInvoice,$purchaseSessionCart);
            
            //purchase product stock table
            $this->insertDataInThePurchaseProductStockTable($purchaseSessionCart,$purchaseInvoice,$purchaseProduct,$purchaseSessionCart['stock_id'],$purchaseSessionCart['purchase_qty'],$purchaseSessionCart['purchase_price'],$purchaseSessionCart['mrp_price'],$purchaseSessionCart['instantly_receiving_qty']);
            
            //product price update
            $this->productPriceUpdateInTheProductPriceTable($purchaseSessionCart);
        }//end foreach
        
        $purchaseInvoice->total_purchase_amount = $this->totalPurchasePriceOfAllQuantityOfThisInvoice;
        $purchaseInvoice->save();

        if(($this->purchaseCreateFormRequestData['invoice_total_paying_amount'] ?? 0) > 0)
        {
            //for payment processing 
            $this->mainPaymentModuleId = getModuleIdBySingleModuleLebel_hh('Purchase');
            $this->paymentModuleId = getModuleIdBySingleModuleLebel_hh('Purchase');
            $this->paymentCdfTypeId = getCdfIdBySingleCdfLebel_hh('Debit');
            $moduleRelatedData = [
                'main_module_invoice_no' => $purchaseInvoice->invoice_no,
                'main_module_invoice_id' => $purchaseInvoice->id,
                'module_invoice_no' => $purchaseInvoice->invoice_no,
                'module_invoice_id' => $purchaseInvoice->id,
                'user_id' => $purchaseInvoice->supplier_id,//client[customer,supplier,others staff]
            ];
            $this->paymentProcessingRequiredOfAllRequestOfModuleRelatedData = $moduleRelatedData;
            $this->paymentProcessingRelatedOfAllRequestData = paymentDataProcessingWhenPurchaseingSubmitFromPos_hh($this->purchaseCreateFormRequestData);// $paymentAllData;
            $this->invoiceTotalPayingAmount = $this->purchaseCreateFormRequestData['invoice_total_paying_amount'] ?? 0 ;
            $this->processingPayment();
        }

        return $purchaseSessionCarts;
    }


    //purchase product stock
    private function insertDataInThePurchaseProductStockTable($cart,$purchaseInvoice,$purchaseProduct,$stock_id,$qty,$purchase_price,$mrp_price,$receiving_qty)
    {
        $productStock = new PurchaseProductStock();
        $productStock->branch_id = authBranch_hh();
        $productStock->purchase_invoice_id = $purchaseInvoice->id;
        $productStock->purchase_product_id = $purchaseProduct->id;

        $productStock->product_id = $cart['product_id'];
        $productStock->stock_id = $stock_id;
        
        $productStock->total_quantity = $qty;

        $productStock->mrp_price = $mrp_price;
        $productStock->regular_sell_price = $cart['product_prices'][$stock_id][retailSellPriceId_hh()];
        $productStock->purchase_price = $purchase_price;
        $productStock->total_purchase_price = $cart['purchase_line_subtotal'];
        
        // purchase_price_carts product all price of a single product when purchase (price change or not)
        $prices = [];
        foreach($cart['prices'] as $price_id)
        {
            $prices[$price_id] = $cart['product_prices'][$stock_id][$price_id];
        }
        $productStock->purchase_price_carts = json_encode([$prices]);
        // purchase_price_carts product all price of a single product when purchase (price change or not)

        //product stock
        $pstock =    ProductStock::select('id','product_id','stock_id','available_base_stock')->where('product_id',$cart['product_id'])->where('stock_id',$stock_id)->first();
        $productStock->product_stock_id = $pstock ? $pstock->id : NULL;
        //product stock


        if($purchaseInvoice->purchase_type == 1)
        {
            $productStock->ict_total_delivered_qty = $receiving_qty;
            $productStock->ict_remaining_delivery_qty = $qty - $receiving_qty;
            $productStock->total_delivered_qty = $receiving_qty;
            $productStock->remaining_delivery_qty = $qty - $receiving_qty;
        }

        //stock changes
        if($purchaseInvoice->purchase_type == 1 && $receiving_qty > 0)
        {
            $this->stock_id_FSCT = $stock_id;
            $this->product_id_FSCT = $cart['product_id'];
            $this->stock_quantity_FSCT = $receiving_qty;
            $this->unit_id_FSCT = $cart['unit_id'];
            $this->purchaseRegularStockTypeIncrement();
        }
        //stock changes

        $productStock->status = 1;
        $productStock->delivery_status = 1;
        $productStock->created_by = authId_hh();
        $productStock->save();
        return $productStock;
    }


    //insert purchase product data
    private function insertDataInThePurchaseProduct($purchaseInvoice,$cart)
    {
        $productStock = new PurchaseProduct();
        $productStock->branch_id = authBranch_hh();
        $productStock->purchase_invoice_id = $purchaseInvoice->id;
        $productStock->product_id = $cart['product_id'];
        $productStock->unit_id = $cart['unit_id'];
        $productStock->supplier_id = $cart['supplier_id'];
        $productStock->product_stock_type = 1;//1=single, 2=multiple
        $productStock->custom_code = $cart['custom_code'];
        $productStock->quantity = $cart['purchase_qty'];
        
        $productStock->discount_amount = NULL;//$cart['discount_amount'];
        $productStock->discount_type = NULL;//'fixed';//$cart['discount_type'];
        $productStock->total_discount = 0;//$cart['total_discount_amount'];
       
        $productStock->total_purchase_price = $cart['purchase_line_subtotal'];

        $this->totalPurchasePriceOfAllQuantityOfThisInvoice += $cart['purchase_line_subtotal'];

        $productStock->carts  = json_encode([
            'productName' => $cart['product_name'],
            "productId" => $cart['product_id'],
            'mrpPrice' => $cart['mrp_price'] ,
            'purchasePrice' => $cart['purchase_price'] ,
            'totalPurchaseQuantity' => $cart['purchase_qty'] ,
            'stockId' => $cart['stock_id'] ,
            'instantlyReceivingQty' => $cart['instantly_receiving_qty'] ,
            'remainingQty' => $cart['remaining_qty'],
            'unitName' => $cart['unit_name'],
            'unitId' => $cart['unit_id'],
            'customCode' => $cart['custom_code'],

            'stocks' => $cart['stocks'],
            'prices' => $cart['prices'],
        ]);
        $productStock->stock_id_carts = json_encode($cart['stocks']);
        $productStock->price_id_carts = json_encode($cart['prices']);

        $productStock->product_purchase_prices_carts = json_encode($cart['product_prices']);

        $productStock->status =1;
        $productStock->delivery_status =1;
        $productStock->created_by = authId_hh();
        $productStock->save();
        return $productStock;
    }

    //insert purchase invoice table 
    private function insertDataInThePurchaseInvoiceTable($purchaseInvoiceSummeryCart)
    {  
        $shippingCart = [];
        $shippingCart = session()->has(purchaseCreateCartShippingCostSessionName_hh()) ? session()->get(purchaseCreateCartShippingCostSessionName_hh())  : [];

        $purchaseInvoice = new PurchaseInvoice();
        $purchaseInvoice->branch_id = authBranch_hh();
        $rand = rand(01,99);
        $makeInvoice = date("iHsymd").$rand;
        $purchaseInvoice->invoice_no = $makeInvoice;
        $purchaseInvoice->supplier_id = $this->purchaseCreateFormRequestData['supplier_id'];
        $purchaseInvoice->chalan_no = $this->purchaseCreateFormRequestData['chalan_no'];
        $purchaseInvoice->reference_no = $this->purchaseCreateFormRequestData['reference_no'];

        $purchaseInvoice->shipping_note = $this->purchaseCreateFormRequestData['shipping_note'];
        $purchaseInvoice->receiver_details = $this->purchaseCreateFormRequestData['receiver_details'];
        $purchaseInvoice->purchase_note = $this->purchaseCreateFormRequestData['purchase_note'];
        
        $purchaseInvoice->total_item = $purchaseInvoiceSummeryCart['totalItem'];
        $purchaseInvoice->total_quantity = $purchaseInvoiceSummeryCart['totalQuantity'];
        $purchaseInvoice->subtotal = $purchaseInvoiceSummeryCart['lineInvoiceSubTotal'];
        $purchaseInvoice->discount_amount = $purchaseInvoiceSummeryCart['invoiceDiscountAmount'];
        $purchaseInvoice->discount_type = $purchaseInvoiceSummeryCart['invoiceDiscountType'];
        $purchaseInvoice->total_discount = $purchaseInvoiceSummeryCart['totalInvoiceDiscountAmount'];
        $purchaseInvoice->vat_amount = $purchaseInvoiceSummeryCart['invoiceVatAmount'];
        $purchaseInvoice->total_vat = $purchaseInvoiceSummeryCart['totalVatAmountCalculation'];
        $purchaseInvoice->shipping_cost = $purchaseInvoiceSummeryCart['totalShippingCost'];
        $purchaseInvoice->others_cost = $purchaseInvoiceSummeryCart['invoiceOtherCostAmount'];
        $purchaseInvoice->round_amount = $purchaseInvoiceSummeryCart['lineInvoiceRoundingAmount'];
        $sign = "";
        if($purchaseInvoiceSummeryCart['lineInvoicePayableAmountWithRounding'] >=  $purchaseInvoiceSummeryCart['lineAfterOtherCostShippingCostDiscountAndVatWithInvoiceSubTotal'])
        {
            $sign = "+";
        }
        else if($purchaseInvoiceSummeryCart['lineInvoicePayableAmountWithRounding'] <  $purchaseInvoiceSummeryCart['lineAfterOtherCostShippingCostDiscountAndVatWithInvoiceSubTotal'])
        {
            $sign = "-";
        }else{
            $sign = "";
        }
        $purchaseInvoice->round_type = $sign;
        $totalPayableAmount = $purchaseInvoiceSummeryCart['lineInvoicePayableAmountWithRounding'];
        $purchaseInvoice->total_payable_amount = $totalPayableAmount;

        //payment related section
        $totalPaidAmount = ($this->purchaseCreateFormRequestData['cash_payment_value'] ?? 0) + ($this->purchaseCreateFormRequestData['advance_payment_value'] ?? 0) + ($this->purchaseCreateFormRequestData['banking_payment_value'] ?? 0);
        $purchaseInvoice->paid_amount = $totalPaidAmount;
        $purchaseInvoice->total_paid_amount	 = $totalPaidAmount;
        $purchaseInvoice->due_amount = $totalPayableAmount - $totalPaidAmount;

        $paymentStatus = "";
        $payment_type = "";
        if($totalPayableAmount == $totalPaidAmount)
        {
            $paymentStatus = "Paid";
            $payment_type = "Full Payment";
        }
        else if($totalPayableAmount > $totalPaidAmount &&  $totalPaidAmount > 0){
            $paymentStatus = "Parital Payment";
            $payment_type = "Partial Payment";
        }
        else if($totalPayableAmount > $totalPaidAmount &&  $totalPaidAmount == 0){
            $paymentStatus = "Not Paid";
            $payment_type = "Not Paid";
        }
        $purchaseInvoice->payment_status = $paymentStatus;
        $purchaseInvoice->payment_type	 = $payment_type;
        //payment related section

        $purchaseInvoice->purchase_type = $this->purchaseCreateFormRequestData['purchase_type'];

        $supplierId = $this->purchaseCreateFormRequestData['supplier_id'];
        $supplier = Supplier::select('supplier_type_id')->where('id',$supplierId)->first();
        if($supplier)
        {
            $purchaseInvoice->supplier_type_id = $supplier->supplier_type_id;  
        }else{
            $purchaseInvoice->supplier_type_id = 2;  //reseller 
        }
        if( $this->purchaseCreateFormRequestData['purchase_type'] == 1) 
        {
            $purchaseInvoice->purchase_date = $this->purchaseCreateFormRequestData['purchase_date'] ? date('Y-m-d',strtotime($this->purchaseCreateFormRequestData['purchase_date'])) : date('Y-m-d');
        }
        $purchaseInvoice->status = 1;
        $purchaseInvoice->delivery_status = 1;
        $purchaseInvoice->created_by = authId_hh();

        $purchaseInvoice->save();
        
        if(isset($this->purchaseCreateFormRequestData['attach_file']))
        {
            if ($this->purchaseCreateFormRequestData['attach_file']) {
                $ext1 = strtolower($this->purchaseCreateFormRequestData['attach_file']->getClientOriginalExtension());
               if ($ext1 != "jpg" && $ext1 != "jpeg" && $ext1 != "png" && $ext1 != "gif"  && $ext1 != "pdf") {
                    $ext1 = "";
                } else {
                    $insertedId = $purchaseInvoice->id;
                    $destinationPath = "backend/purchase"; 
                  
                    $fileName = $insertedId .".". $ext1;
                 
                   $path = Storage::disk('public')->put($destinationPath.'/'.$fileName, file_get_contents($this->purchaseCreateFormRequestData['attach_file']));
                    //$path = Storage::disk('public')->url($path);
                    if($path)
                    {
                        $purchaseInvoice->attach_file = $ext1;
                        $purchaseInvoice->save();
                    }
                }
            }
        }

        return $purchaseInvoice;
        return $purchaseInvoiceSummeryCart;
    }


    //product price udate when complete purchase... new purchase price is enable in the product list and others
    private function productPriceUpdateInTheProductPriceTable($purchaseSessionCart)
    {
        foreach($purchaseSessionCart['product_prices'] as $stockId => $pricesByStock)
        {
            foreach($pricesByStock as $priceId => $price)
            {
                //check product stock is exist or not,
                    //if not exist, then add in the product stock table 
                $podctStock = ProductStock::where('stock_id',$stockId)   
                    ->where('product_id',$purchaseSessionCart['product_id'])
                    ->where('branch_id',authBranch_hh()) 
                    ->where('status',1)
                    ->first();

                $exitProuctStockId = NULL;
                if($podctStock)
                {
                    $exitProuctStockId = $podctStock->id;
                }
                $newProductStockId = NULL;
                if(!$podctStock)
                {
                    $nps = new ProductStock();
                    $nps->product_id        = $purchaseSessionCart['product_id'];
                    $nps->branch_id         = authBranch_hh();
                    $nps->stock_id          = $stockId;
                    $nps->status            = 1;
                    $nps->available_base_stock = 0;
                    $nps->used_stock        = 0;
                    $nps->used_base_stock   = 0;
                    $nps->used_base_stock   = 0;
                    $nps->save();
                    $newProductStockId = $nps->id;
                } 

                $podctPrice = ProductPrice::where('stock_id',$stockId)   
                    ->where('product_id',$purchaseSessionCart['product_id'])
                    ->where('price_id',$priceId)
                    ->where('branch_id',authBranch_hh()) 
                    ->where('status',1)
                    ->first();
                if($podctPrice)
                {   
                    //updatePriceHistory( $previousPrice = $podctPrice->price, $newPrice = $price)
                    //if we track price update history, then make a function, and call the function from here
                    $podctPrice->price = $price;
                    $podctPrice->save();
                }
                else{
                    $npp = new ProductPrice();
                    $npp->product_id    = $purchaseSessionCart['product_id'];
                    $npp->branch_id     = authBranch_hh();
                    $npp->price_id      = $priceId;
                    $npp->stock_id      = $stockId;
                    $npp->product_stock_id = $exitProuctStockId ? $exitProuctStockId : $newProductStockId;
                    $npp->price         = $price;
                    $npp->status        = 1;
                    $npp->save();
                }
                
            }//end foreach
        }//end foreach
    }
 

}