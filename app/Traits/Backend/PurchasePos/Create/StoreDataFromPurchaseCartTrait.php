<?php
namespace App\Traits\Backend\PurchasePos\Create;

use App\Models\Backend\Purchase\PurchaseInvoice;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\Sell\SellInvoice;
use App\Models\Backend\Sell\SellPackage;
use App\Models\Backend\Sell\SellProduct;
use App\Models\Backend\Customer\Customer;
use App\Models\Backend\Purchase\PurchaseProduct;
use App\Models\Backend\Purchase\PurchaseProductStock;
use App\Models\Backend\Sell\SellQuotation;
use App\Models\Backend\Sell\SellProductStock;
use App\Models\Backend\Stock\ProductStock;
use App\Models\Backend\Supplier\Supplier;
use App\Traits\Backend\Stock\Logical\StockChangingTrait;
use App\Traits\Backend\FileUpload\FileUploadTrait;
use App\Setting\Backend\Product\ProductSetting;
/**
 * pricing trait
 * 
 */
trait StoreDataFromPurchaseCartTrait
{    
    use FileUploadTrait;
    use StockChangingTrait;
    use ProductSetting;


    protected $purchaseCreateFormRequestData;

    protected $cartName;
    protected $product_id;

    protected $totalSellingQuantity;
    protected $otherProductStockQuantityPurchasePrice;
    protected $mainProductStockQuantityPurchasePrice;
    protected $totalPurchasePriceOfAllQuantityOfThisInvoice;



    protected function storeSessionDataFromPurchaseCart()
    {   
        $purchaseCartName = purchaseCreateCartSessionName_hh();
        $purchaseSessionCarts  = [];
        $purchaseSessionCarts  = session()->has($purchaseCartName) ? session()->get($purchaseCartName)  : [];
        
        $purchaseInvoiceSummeryCartName = purchaseCreateCartInvoiceSummerySessionName_hh();
        $purchaseInvoiceSummeryCart = [];
        $purchaseInvoiceSummeryCart = session()->has($purchaseInvoiceSummeryCartName) ? session()->get($purchaseInvoiceSummeryCartName)  : [];
        
       /*  echo "<pre>";
        print_r($purchaseSessionCarts);
        echo "</pre>";
        //return 0; */
        $purchaseInvoice =  $this->insertDataInThePurchaseInvoiceTable($purchaseInvoiceSummeryCart);
       
        $this->totalSellingQuantity = 0;
        $this->otherProductStockQuantityPurchasePrice = 0;
        $this->mainProductStockQuantityPurchasePrice = 0;
        $this->totalPurchasePriceOfAllQuantityOfThisInvoice = 0;
        foreach($purchaseSessionCarts as $purchaseSessionCart)
        {
            $purchaseProduct =  $this->insertDataInThePurchaseProduct($purchaseInvoice,$purchaseSessionCart);
            
            $this->insertDataInThePurchaseProductStockTable($purchaseSessionCart,$purchaseInvoice,$purchaseProduct,$purchaseSessionCart['stock_id'],$purchaseSessionCart['purchase_qty'],$purchaseSessionCart['purchase_price'],$purchaseSessionCart['mrp_price'],$purchaseSessionCart['instantly_receiving_qty']);
        }//end foreach
        
        $purchaseInvoice->total_purchase_amount = $this->totalPurchasePriceOfAllQuantityOfThisInvoice;
        $purchaseInvoice->save();
        return $purchaseSessionCarts;
    }


    //purchase product stock
    private function insertDataInThePurchaseProductStockTable($cart,$purchaseInvoice,$purchaseProduct,$stock_id,$qty,$purchase_price,$mrp_price,$receiving_qty)
    {
        $productStock = new PurchaseProductStock();
        $productStock->branch_id = authBranch_hh();
        $productStock->purchase_invoice_id = $purchaseInvoice->id;
        $productStock->purchase_product_id = $purchaseProduct->id;

        $pstock =    ProductStock::select('id','product_id','stock_id','available_base_stock')->where('product_id',$cart['product_id'])->where('stock_id',$stock_id)->first();
        $product_stock_id = $pstock ? $pstock ->id : NULL;
        $productStock->product_stock_id = $product_stock_id;

        $productStock->product_id = $cart['product_id'];
        $productStock->stock_id = $stock_id;
        
        $productStock->total_quantity = $qty;

        $productStock->mrp_price = $mrp_price;
        //$productStock->regular_sell_price = $cart['sell_price'];
        //$productStock->whole_sell_price = $cart['sell_price'];
        $productStock->purchase_price = $purchase_price;
        $productStock->total_purchase_price = 0;
        
        if($purchaseInvoice->purchase_type == 1)
        {
            $productStock->ict_total_delivered_qty = $receiving_qty;
            $productStock->ict_remaining_delivery_qty = $qty - $receiving_qty;
            $productStock->total_delivered_qty = $receiving_qty;
            $productStock->remaining_delivery_qty = $qty - $receiving_qty;;
        }
        //purchase_price_carts
        
        /* $pStock = productStockByProductStockId_hh($product_stock_id);
        $stockId = regularStockId_hh();
        if($pStock)
        {
            $availableBaseStock = $pStock->available_base_stock;
            $stockId = $pStock->stock_id;
        }else{
            $availableBaseStock = 0;
        }
        //stock id 
        $productStock->stock_id = $stockId;

        if($availableBaseStock > $qty)
        {
            //instantly processed all qty
            $instantlyProcessedQty = $qty;
            $stockProcessLaterDate = ""; 
            $stockProcessLaterQty  = 0;
        }
        else if($availableBaseStock == $qty)
        {
            //instantly processed all qty
            $instantlyProcessedQty = $qty;
            $stockProcessLaterDate = ""; 
            $stockProcessLaterQty  = 0;
        }
        else 
        {   
            //instantly processed qty
           $overStock = $qty - $availableBaseStock;
           $instantlyProcessedQty = $qty - $overStock;
           $stockProcessLaterDate = date('Y-m-d',strtotime('+'.$process_duration.' day')); 
           $stockProcessLaterQty   = $overStock;
        }

        $purchaseType = $this->purchaseCreateFormRequestData['purchase_type'];
        //if purchase_type==1, then reduce stock from product stocks table 
        if($purchaseType  == 1 && $instantlyProcessedQty > 0)
        {
            $this->stock_id_FSCT = $stockId;
            $this->product_id_FSCT = $cart['product_id'];
            $this->stock_quantity_FSCT = $instantlyProcessedQty;
            $this->unit_id_FSCT = $cart['unit_id'];
            $this->sellingFromPossStockTypeDecrement();

            if($pStock)
            {
                $pStock->reduced_base_stock_remaining_delivery = $instantlyProcessedQty;
                $pStock->save();
            }
        }
        //delivery quantity
        $totalDeliverdQty = 0;
        $productStock->total_delivered_qty = $totalDeliverdQty;
        $productStock->remaining_delivery_qty = $qty - $totalDeliverdQty;

        $productStock->stock_process_instantly_qty = $instantlyProcessedQty;
        $productStock->stock_process_later_qty = $stockProcessLaterQty;
        $productStock->stock_process_later_date = $stockProcessLaterDate;
        $productStock->total_stock_remaining_process_qty = $stockProcessLaterQty;
        $productStock->total_stock_processed_qty = $instantlyProcessedQty; */

        $productStock->status =1;
        $productStock->delivery_status =1;
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
        
        $productStock->discount_amount = 0;//$cart['discount_amount'];
        $productStock->discount_type = 'fixed';//$cart['discount_type'];
        $productStock->total_discount = 0;//$cart['total_discount_amount'];
       
       
        $productStock->total_purchase_price = $cart['purchase_line_subtotal'];
        //$productStock->stock_id = $cart['stock_id'];

        $this->totalPurchasePriceOfAllQuantityOfThisInvoice += $cart['purchase_line_subtotal'];

        $productStock->carts  = json_encode([
            'productName' => $cart['product_name'],
            "productId" =>$cart['product_id'],
            'mrpPrice' =>$cart['mrp_price'] ,
            'purchasePrice' =>$cart['purchase_price'] ,
            'totalPurchaseQuantity' =>$cart['purchase_qty'] ,
            'stockId' =>$cart['stock_id'] ,
            'instantlyReceivingQty' =>$cart['instantly_receiving_qty'] ,
            'remainingQty' =>$cart['remaining_qty'],
            'unitName' => $cart['unit_name'],
            'unitId' =>$cart['unit_id'],
            'customCode' =>$cart['custom_code'],

            'stocks' =>$cart['stocks'],
            'prices' =>$cart['prices'],
        ]);

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
        $purchaseInvoice->chalan_no = $this->purchaseCreateFormRequestData['chalan_no'];
        $purchaseInvoice->reference_no = $this->purchaseCreateFormRequestData['reference_no'];

        $purchaseInvoice->shipping_note = $shippingCart['shipping_note'];
        $purchaseInvoice->receiver_details = $shippingCart['receiver_details'];
        $purchaseInvoice->purchase_note = $shippingCart['purchase_note'];
        
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
        $purchaseInvoice->total_payable_amount = $purchaseInvoiceSummeryCart['lineInvoicePayableAmountWithRounding'];
        
        $purchaseInvoice->purchase_type = $this->purchaseCreateFormRequestData['purchase_type'];

        $supplierId = $purchaseInvoiceSummeryCart['invoice_supplier_id'];
        $supplier = Supplier::select('supplier_type_id')->where('id',$supplierId)->first();
        if($supplier)
        {
            $purchaseInvoice->supplier_type_id = $supplier->supplier_type_id;  
        }else{
            $purchaseInvoice->supplier_type_id = 2;  //reseller 
        }
        if( $this->purchaseCreateFormRequestData['purchase_type'] == 1) 
        {
            $purchaseInvoice->purchase_date = date('Y-m-d',strtotime($this->purchaseCreateFormRequestData['purchase_date']));
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
                   $imgsave =  $this->purchaseCreateFormRequestData['attach_file']->move($destinationPath,"{$insertedId}.{$ext1}");
                    if($imgsave)
                    {
                        $purchaseInvoice->attach_file = $ext1;
                        $purchaseInvoice->save();
                    }
                }
            }
             
            /* $this->destination  = 'backend/purchase';  //its mandatory;
            $this->imageWidth   = 400;  //its mandatory
            $this->imageHeight  = 400;  //its nullable
            $this->requestFile  = $this->purchaseCreateFormRequestData['attach_file'];  //its mandatory
            $this->id   = $purchaseInvoice->id;
            $purchaseInvoice->attach_file = $this->storeImage();
            $purchaseInvoice->save(); */
        }

        /* if( $this->purchaseCreateFormRequestData['purchase_type'] == 2) 
        {
            $quotation =  new SellQuotation();
            $quotation->sell_invoice_id  = $purchaseInvoice->id;
            $quotation->invoice_no       = $purchaseInvoice->invoice_no;
            $quotation->customer_name    = $this->purchaseCreateFormRequestData['customer_name'];
            $quotation->phone            = $this->purchaseCreateFormRequestData['phone'];
            $quotation->quotation_no     = $this->purchaseCreateFormRequestData['quotation_no'];
            $quotation->validate_date    = $this->purchaseCreateFormRequestData['validate_date'];
            $quotation->quotation_note   = $this->purchaseCreateFormRequestData['quotation_note'];
            $quotation->sell_date        = $this->purchaseCreateFormRequestData['sale_date'];
            $quotation->created_by       = authId_hh();
            $quotation->save(); 
        } */

        return $purchaseInvoice;
        return $purchaseInvoiceSummeryCart;
    }





 
}