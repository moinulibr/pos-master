<?php
namespace App\Traits\Backend\Pos\Create;

use Illuminate\Support\Facades\Auth;
use App\Models\Backend\Sell\SellInvoice;
use App\Models\Backend\Sell\SellPackage;
use App\Models\Backend\Sell\SellProduct;
use App\Models\Backend\Customer\Customer;
use App\Models\Backend\Sell\SellQuotation;
use App\Models\Backend\Sell\SellProductStock;
use App\Traits\Backend\Stock\Logical\StockChangingTrait;

/**
 * pricing trait
 * 
 */
trait StoreDataFromSellCartTrait
{
    use StockChangingTrait;


    protected $sellCreateFormData;

    protected $cartName;
    protected $product_id;

    protected $totalSellingQuantity;
    protected $otherProductStockQuantityPurchasePrice;
    protected $mainProductStockQuantityPurchasePrice;
    protected $totalPurchasePriceOfAllQuantityOfThisInvoice;



    protected function storeSessionDataFromSellCart()
    {   
        
        $sellCartName = sellCreateCartSessionName_hh();
        $sellCart   = [];
        $sellCart   = session()->has($sellCartName) ? session()->get($sellCartName)  : [];
        
        $sellInvoiceSummeryCartName = sellCreateCartInvoiceSummerySessionName_hh();
        $sellInvoiceSummeryCart = [];
        $sellInvoiceSummeryCart = session()->has($sellInvoiceSummeryCartName) ? session()->get($sellInvoiceSummeryCartName)  : [];
        
        $sellInvoice =  $this->insertDataInTheSellInvoiceTable($sellInvoiceSummeryCart);
       
        $this->totalSellingQuantity = 0;
        $this->otherProductStockQuantityPurchasePrice = 0;
        $this->mainProductStockQuantityPurchasePrice = 0;
        $this->totalPurchasePriceOfAllQuantityOfThisInvoice = 0;
        foreach($sellCart as $cart)
        {
           $sellProduct =  $this->insertDataInTheSellProduct($sellInvoice,$cart);

            if($cart['more_quantity_from_others_product_stock'] == 1)
            {
                foreach($cart['from_others_product_stocks'] as $ostock)
                {
                   foreach($ostock['others_product_stock_ids'] as $key => $stock)
                   {
                        //$ids[] = $stock;
                        $qty = $ostock['others_product_stock_qtys'][$key];
                        $purchase_price = $ostock['others_product_stock_purchase_prices'][$key];
                        $process_duration = $ostock['over_stock_quantity_process_duration'][$key];
                        $this->insertDataInTheSellProductStockTable($cart,$sellInvoice,$sellProduct,$stock,$qty,$purchase_price,$process_duration);
                   }//end foreach
                }//end foreach
            }else{
               $this->insertDataInTheSellProductStockTable($cart,$sellInvoice,$sellProduct,$cart['selling_main_product_stock_id'],$cart['total_qty_of_main_product_stock'],$cart['purchase_price'],1);
            }
        }//end foreach
        
        $sellInvoice->total_purchase_amount = $this->totalPurchasePriceOfAllQuantityOfThisInvoice;
        $sellInvoice->total_invoice_profit = (($sellInvoiceSummeryCart['lineInvoicePayableAmountWithRounding']) - ($this->totalPurchasePriceOfAllQuantityOfThisInvoice) - ($sellInvoiceSummeryCart['totalShippingCost'] + $sellInvoiceSummeryCart['invoiceOtherCostAmount'] ));
        $sellInvoice->save();
        return $sellCart;
    }


    
    private function insertDataInTheSellProductStockTable($cart,$sellInvoice,$sellProduct,$product_stock_id,$qty,$purchase_price,$process_duration)
    {
        $productStock = new SellProductStock();
        $productStock->branch_id = authBranch_hh();
        $productStock->sell_invoice_id = $sellInvoice->id;
        $productStock->sell_product_id = $sellProduct->id;
        $productStock->product_stock_id = $product_stock_id;

        $productStock->product_id = $cart['product_id'];
        
        $productStock->total_quantity = $qty;

        $productStock->mrp_price = $cart['mrp_price'];
        $productStock->regular_sell_price = $cart['sell_price'];
        $productStock->sold_price = $cart['final_sell_price'];
        $productStock->total_sold_price = $cart['selling_final_amount'];
        $productStock->purchase_price = $cart['purchase_price'];
        $productStock->total_purchase_price = $cart['total_purchase_price_of_all_quantity'];
        $productStock->total_profit = $cart['selling_final_amount'] - $cart['total_purchase_price_of_all_quantity'];

        
        $pStock = productStockByProductStockId_hh($product_stock_id);
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

        $sellType = $this->sellCreateFormData['sell_type'];
        //if sell_type==1, then reduce stock from product stocks table 
        if($sellType  == 1 && $instantlyProcessedQty > 0)
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
        $productStock->total_stock_processed_qty = $instantlyProcessedQty;

        $productStock->status =1;
        $productStock->delivery_status =1;
        $productStock->save();
        return $productStock;
    }


    private function insertDataInTheSellProduct($sellInvoice,$cart)
    {
        $productStock = new SellProduct();
        $productStock->branch_id = authBranch_hh();
        $productStock->sell_invoice_id = $sellInvoice->id;
        $productStock->product_id = $cart['product_id'];
        $productStock->unit_id = $cart['unit_id'];
        $productStock->supplier_id = $cart['supplier_id'];
        $productStock->main_product_stock_id = $cart['selling_main_product_stock_id'];
        $productStock->product_stock_type = $cart['total_qty_from_others_product_stock'] == 0 ? 1 : 2;
        $productStock->custom_code = $cart['custom_code'];
        $productStock->quantity = $cart['final_sell_quantity'];
        $productStock->sold_price = $cart['final_sell_price'];
        $productStock->discount_amount = $cart['discount_amount'];
        $productStock->discount_type = $cart['discount_type'];
        $productStock->total_discount = $cart['total_discount_amount'];
        $productStock->reference_commission = 0;//$cart[''];
        $productStock->total_sold_price = $cart['selling_final_amount'];
        $productStock->total_purchase_price = $cart['total_purchase_price_of_all_quantity'];
        $productStock->total_profit = $cart['selling_final_amount'] - $cart['total_purchase_price_of_all_quantity'];
        
        $this->totalPurchasePriceOfAllQuantityOfThisInvoice += $cart['total_purchase_price_of_all_quantity'];

        if($cart['w_g_type'])
        {
            $productStock->liability_type = json_encode(["w_g_type" => $cart['w_g_type'], "w_g_type_day" => $cart['w_g_type_day']]);
        }
        $productStock->identity_number = $cart['identityNumber'];
        $productStock->cart = json_encode([
            'productName' => $cart['product_name'],
            "productId" =>$cart['product_id'],
            'mrpPrice' =>$cart['mrp_price'] ,
            'soldPrice' =>$cart['final_sell_price'] ,
            'totalSellQuantity' =>$cart['final_sell_quantity'] ,
            'totalMainProductStockQuantity' =>$cart['total_qty_of_main_product_stock'] ,
            'totalOtherProductStockQuantity' =>$cart['total_qty_from_others_product_stock'] ,
            'unitName' => $cart['unit_name'],
            'unitId' =>$cart['unit_id'],
            'customCode' =>$cart['custom_code'],
            'warehouseId' =>$cart['warehouse_id'],
            'warehouseRackId' =>$cart['warehouse_rack_id'],
        ]);

        $productStock->status =1;
        $productStock->delivery_status =1;
        $productStock->created_by = authId_hh();
        $productStock->save();
        return $productStock;
    }

    private function insertDataInTheSellInvoiceTable($sellInvoiceSummeryCart)
    {  
        $shippingCart = [];
        $shippingCart = session()->has(sellCreateCartShippingAddressSessionName_hh()) ? session()->get(sellCreateCartShippingAddressSessionName_hh())  : [];

        //return $sellInvoiceSummeryCart;
        $sellInvoice = new SellInvoice();
        $sellInvoice->branch_id = authBranch_hh();
        $rand = rand(01,99);
        $makeInvoice = date("iHsymd").$rand;
        $sellInvoice->invoice_no = $makeInvoice;
        $sellInvoice->total_item = $sellInvoiceSummeryCart['totalItem'];
        $sellInvoice->total_quantity = $sellInvoiceSummeryCart['totalQuantity'];
        $sellInvoice->subtotal = $sellInvoiceSummeryCart['lineInvoiceSubTotal'];
        $sellInvoice->discount_amount = $sellInvoiceSummeryCart['invoiceDiscountAmount'];
        $sellInvoice->discount_type = $sellInvoiceSummeryCart['invoiceDiscountType'];
        $sellInvoice->total_discount = $sellInvoiceSummeryCart['totalInvoiceDiscountAmount'];
        $sellInvoice->vat_amount = $sellInvoiceSummeryCart['invoiceVatAmount'];
        $sellInvoice->total_vat = $sellInvoiceSummeryCart['totalVatAmountCalculation'];
        $sellInvoice->shipping_cost = $sellInvoiceSummeryCart['totalShippingCost'];
        $sellInvoice->others_cost = $sellInvoiceSummeryCart['invoiceOtherCostAmount'];
        $sellInvoice->round_amount = $sellInvoiceSummeryCart['lineInvoiceRoundingAmount'];
        $sign = "";
        if($sellInvoiceSummeryCart['lineInvoicePayableAmountWithRounding'] >=  $sellInvoiceSummeryCart['lineAfterOtherCostShippingCostDiscountAndVatWithInvoiceSubTotal'])
        {
            $sign = "+";
        }
        else if($sellInvoiceSummeryCart['lineInvoicePayableAmountWithRounding'] <  $sellInvoiceSummeryCart['lineAfterOtherCostShippingCostDiscountAndVatWithInvoiceSubTotal'])
        {
            $sign = "-";
        }else{
            $sign = "";
        }
        $sellInvoice->round_type = $sign;
        $sellInvoice->total_payable_amount = $sellInvoiceSummeryCart['lineInvoicePayableAmountWithRounding'];
        
        $sellInvoice->sell_type = $this->sellCreateFormData['sell_type'];

        $customerId = $sellInvoiceSummeryCart['invoice_customer_id'];
        if(count($shippingCart) > 0)
        {
            $sellInvoice->customer_id = $shippingCart['customer_id'];
            $customerId = $shippingCart['customer_id'];
            $sellInvoice->reference_id = $shippingCart['reference_id'];
            $sellInvoice->shipping_id = $shippingCart['customer_shipping_address_id'];
            $sellInvoice->shipping_note = $shippingCart['shipping_note'];
            $sellInvoice->sell_note = $shippingCart['sell_note'];
            $sellInvoice->receiver_details = $shippingCart['receiver_details'];
        }else{
            $sellInvoice->customer_id = $sellInvoiceSummeryCart['invoice_customer_id'];
            $sellInvoice->reference_id = $sellInvoiceSummeryCart['invoice_reference_id'];
        }

        $customer = Customer::select('customer_type_id')->where('id',$customerId)->first();
        if($customer)
        {
            $sellInvoice->customer_type_id = $customer->customer_type_id;  
        }else{
            $sellInvoice->customer_type_id = 2;  //temporary
        }
        if( $this->sellCreateFormData['sell_type'] == 1) 
        {
            $sellInvoice->sell_date = date('Y-m-d h:i:s');
        }
        $sellInvoice->status = 1;
        $sellInvoice->delivery_status = 1;
        $sellInvoice->created_by = authId_hh();

        $sellInvoice->save();

        if( $this->sellCreateFormData['sell_type'] == 2) 
        {
            $quotation =  new SellQuotation();
            $quotation->sell_invoice_id  = $sellInvoice->id;
            $quotation->invoice_no       = $sellInvoice->invoice_no;
            $quotation->customer_name    = $this->sellCreateFormData['customer_name'];
            $quotation->phone            = $this->sellCreateFormData['phone'];
            $quotation->quotation_no     = $this->sellCreateFormData['quotation_no'];
            $quotation->validate_date    = $this->sellCreateFormData['validate_date'];
            $quotation->quotation_note   = $this->sellCreateFormData['quotation_note'];
            $quotation->sell_date        = $this->sellCreateFormData['sale_date'];
            $quotation->created_by       = authId_hh();
            $quotation->save(); 
        }

        return $sellInvoice;
        return $sellInvoiceSummeryCart;
    }





 
}