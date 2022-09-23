<?php
namespace App\Traits\Backend\PurchasePos\Create;

use App\Traits\Backend\Customer\Shipping\ShippingAddressTrait;

/**
 *  trait
 * 
 */
trait PurchaseCreateAddToCart
{
    use ShippingAddressTrait;

    protected $requestAllCartData;
    protected $cartName;
    protected $product_id;
    protected $product_name;
    protected $custom_code;
    protected $totalPurchaseQuantity;
    protected $purchase_price;

    protected $changeType;
    protected $discountType;
    protected $discountValue;
    protected $discountAmount;
    protected $changingQuantity;
    protected $quantity;


    //sell cart invoice summery [session:purchaseCartInvoiceSummery]
    protected function purchaseCartInvoiceSummery()
    {
        //return $this->requestAllCartData;
        //$this->cartName     = "purchaseCartInvoiceSummery";
        $cartName           = [];
        $cartName           = session()->has($this->cartName) ? session()->get($this->cartName)  : [];

        $subtotalFromPurchaseCartList   = $this->requestAllCartData['subtotalFromPurchaseCartList'];
        $totalItem   = $this->requestAllCartData['totalItem'];
        $totalQuantity   = $this->requestAllCartData['totalQuantity'];
        $invoiceDiscountAmount   = $this->requestAllCartData['invoiceDiscountAmount'];
        $invoiceDiscountType   = $this->requestAllCartData['invoiceDiscountType'];
        $totalInvoiceDiscountAmount   = $this->requestAllCartData['totalInvoiceDiscountAmount'];
        $invoiceVatAmount   = $this->requestAllCartData['invoiceVatAmount'];
        $totalVatAmountCalculation   = $this->requestAllCartData['totalVatAmountCalculation'];
        $totalShippingCost   = $this->requestAllCartData['totalShippingCost'];
        $invoiceOtherCostAmount   = $this->requestAllCartData['invoiceOtherCostAmount'];
        $totalInvoicePayableAmount   = $this->requestAllCartData['totalInvoicePayableAmount'];

        //line total calculation
        $lineInvoiceSubTotal   = number_format($this->requestAllCartData['subtotalFromPurchaseCartList'],2,'.', '');
        $lineAfterDiscountWithInvoiceSubTotal   = number_format(($this->requestAllCartData['subtotalFromPurchaseCartList'] - $this->requestAllCartData['totalInvoiceDiscountAmount']),2,'.', '');
        $lineAfterDiscountAndVatWithInvoiceSubTotal   = number_format((($this->requestAllCartData['subtotalFromPurchaseCartList'] - $this->requestAllCartData['totalInvoiceDiscountAmount'])+ $this->requestAllCartData['totalVatAmountCalculation']),2,'.', '');
        $lineAfterShippingCostDiscountAndVatWithInvoiceSubTotal   = number_format((($this->requestAllCartData['subtotalFromPurchaseCartList'] - $this->requestAllCartData['totalInvoiceDiscountAmount']) +  $this->requestAllCartData['totalVatAmountCalculation'] + $this->requestAllCartData['totalShippingCost']),2,'.', '');
        $lineAfterOtherCostShippingCostDiscountAndVatWithInvoiceSubTotal   = number_format((($this->requestAllCartData['subtotalFromPurchaseCartList'] - $this->requestAllCartData['totalInvoiceDiscountAmount']) +  $this->requestAllCartData['totalVatAmountCalculation'] + $this->requestAllCartData['totalShippingCost'] + $this->requestAllCartData['invoiceOtherCostAmount']),2,'.', '');
        $lineInvoiceRoundingAmount   = number_format((round($lineAfterOtherCostShippingCostDiscountAndVatWithInvoiceSubTotal) - $lineAfterOtherCostShippingCostDiscountAndVatWithInvoiceSubTotal),2,'.', '');
        $lineInvoicePayableAmountWithRounding   = number_format(round($lineAfterOtherCostShippingCostDiscountAndVatWithInvoiceSubTotal),2,'.', '');

        $cartName = [
            'invoice_supplier_id'=> $this->requestAllCartData['supplier_id'],

            'subtotalFromPurchaseCartList'=> $subtotalFromPurchaseCartList,
            'totalItem'=> $totalItem,
            'totalQuantity'=> $totalQuantity,
            'invoiceDiscountAmount'=> $invoiceDiscountAmount,
            'invoiceDiscountType'=> $invoiceDiscountType,
            'totalInvoiceDiscountAmount'=> $totalInvoiceDiscountAmount,
            'invoiceVatAmount'=> $invoiceVatAmount,
            'totalVatAmountCalculation'=> $totalVatAmountCalculation,
            'totalShippingCost'=> $totalShippingCost,
            'invoiceOtherCostAmount'=> $invoiceOtherCostAmount,
            'totalInvoicePayableAmount'=> $totalInvoicePayableAmount,

            //line total calculation store in session
            'lineInvoiceSubTotal'=> $lineInvoiceSubTotal,
            'lineAfterDiscountWithInvoiceSubTotal'=> $lineAfterDiscountWithInvoiceSubTotal,
            'lineAfterDiscountAndVatWithInvoiceSubTotal'=> $lineAfterDiscountAndVatWithInvoiceSubTotal,
            'lineAfterShippingCostDiscountAndVatWithInvoiceSubTotal'=> $lineAfterShippingCostDiscountAndVatWithInvoiceSubTotal,
            'lineAfterOtherCostShippingCostDiscountAndVatWithInvoiceSubTotal'=> $lineAfterOtherCostShippingCostDiscountAndVatWithInvoiceSubTotal,
            'lineInvoiceRoundingAmount'=> $lineInvoiceRoundingAmount,
            'lineInvoicePayableAmountWithRounding'=> $lineInvoicePayableAmountWithRounding,
        ];
        session([$this->cartName => $cartName]);
        return $this->cartName;
    }

    //adding to sell cart [session:SellCreateAddToCart]
    protected function addingToCartWhenPurchaseCreate()
    {
        //return $this->requestAllCartData;
        //$this->cartName     = "SellCreateAddToCart";
        $cartName           = [];
        $cartName           = session()->has($this->cartName) ? session()->get($this->cartName)  : [];

        $this->product_id   = $this->requestAllCartData['product_id'];
        $this->product_name = $this->requestAllCartData['product_name'];
        $this->custom_code  = $this->requestAllCartData['custom_code'];

        $purchasingQty = 0;
        $purchasingStockId = NULL;
        $instantlyReceivingQty = 0;
        $remainingQty = 0;
        $lineSubtotal = 0;
        $purchasePrice = 0;
        $mrpPrice = 0;
        $purchasePrice = 0;
        $allPrices = [];
        if(count($this->requestAllCartData['stocks']) > 0)
        {
            foreach($this->requestAllCartData['stocks'] as $stock){
                if($this->requestAllCartData['purchase_quantity_sid_'.$stock] > 0)
                {
                    $purchasingQty = $this->requestAllCartData['purchase_quantity_sid_'.$stock];
                    $purchasingStockId =  $stock;
                    $instantlyReceivingQty = $this->requestAllCartData['instant_receive_sid_'.$stock];
                    $remainingQty = $this->requestAllCartData['remaining_qty_sid_'.$stock];
                    $lineSubtotal = $this->requestAllCartData['subtotal_sid_'.$stock];
                    $mrpPrice = $this->requestAllCartData['price_sid_'.$stock.'_pid_'.mrpPriceId_hh()];
                    $purchasePrice = $this->requestAllCartData['price_sid_'.$stock.'_pid_'.purchaseLineTotalSubtotalWhenCartCreateAndShowCartList_hh()];
                }//end basic information for session store

                //all pricess
                foreach($this->requestAllCartData['prices'] as $priceId)
                {
                    $allPrices[$stock][$priceId] =  $this->requestAllCartData['price_sid_'.$stock.'_pid_'.$priceId];
                }
            }
        }
        //$allPrices[3][1];heigh stock, mrp price
        
       
        $cartName[$this->product_id] = [
            'product_id'    => $this->product_id,
            'custom_code'   => $this->custom_code,
            'product_name'  => $this->product_name,
            'supplier_id'   => $this->requestAllCartData['supplier_id'],
            'unit_id'       => $this->requestAllCartData['unit_id'],
            'unit_name'     => $this->requestAllCartData['unit_name'],
            
            'mrp_price'  => $mrpPrice,
            'purchase_price'  => $purchasePrice,
            'purchase_qty'  => $purchasingQty,
            'stock_id' => $purchasingStockId,
            'instantly_receiving_qty' => $instantlyReceivingQty,
            'remaining_qty' => $remainingQty,
            'purchase_line_subtotal'  => $lineSubtotal,  
            
            'stocks' => $this->requestAllCartData['stocks'],
            'prices' => $this->requestAllCartData['prices'],
            'product_prices' => $allPrices,
        ];
        session([$this->cartName => $cartName]);
        return true;
        if(array_key_exists($this->product_id,$cartName))
        {
            //$cartName[$this->requestAllCartData['stocks']] = number_format($sale_price,2,'.', '');
        }
        else{
            $cartName[$this->product_id] = [
                'product_id'                => $this->product_id,
            ];
        }
        session([$this->cartName => $cartName]);
        return true;
    }
    

    
    /*Remove Single item From  Cart Working Properly*/
    public function removeSingleItemFromPurchaseCreateAddedToCartList()
    {
        $this->cartName     = purchaseCreateCartSessionName_hh();//"SellCreateAddToCart";
        $this->product_id   = $this->requestAllCartData['product_id'];
        $cartName           = session()->has($this->cartName) ? session()->get($this->cartName)  : [];
        unset($cartName[$this->product_id]);
        session([$this->cartName => $cartName]);
        return true;
    }

    /*Remove All item From Cart Working Properly*/
    public function removeAllItemFromPurchaseCreateAddedToCartList()
    {
        $this->cartName = purchaseCreateCartSessionName_hh();;//"SellCreateAddToCart";
        session([$this->cartName => []]);
        return true;
    }

    /*When changing quantity*/
    public function whenChangingQuantityFromCartList()
    {   
        $this->cartName = purchaseCreateCartSessionName_hh();//"SellCreateAddToCart";
        $cartName       = session()->has($this->cartName) ? session()->get($this->cartName)  : [];
        
        $this->product_id  = $this->requestAllCartData['product_id'];
        $this->changeType  = $this->requestAllCartData['change_type'];
        $this->changingQuantity = $this->requestAllCartData['quantity'];
        
        $this->totalPurchaseQuantity     = $cartName[$this->product_id]['purchase_qty'];

        if(array_key_exists($this->product_id,$cartName))
        {
            if($this->changeType == 'minus')
            {
                if((double) $cartName[$this->product_id]['purchase_qty'] ==  1)
                {
                    $this->totalPurchaseQuantity     = $cartName[$this->product_id]['purchase_qty'];
                }
                else if((double) $cartName[$this->product_id]['purchase_qty'] > 1)
                {
                    $this->totalPurchaseQuantity     = $cartName[$this->product_id]['purchase_qty'] - $this->changingQuantity;
                }
            }
            else if($this->changeType == 'plus')
            {
                $this->totalPurchaseQuantity     = $cartName[$this->product_id]['purchase_qty']   + $this->changingQuantity;
            }
            $cartName[$this->product_id]['purchase_qty']  =  $this->totalPurchaseQuantity;
            $cartName[$this->product_id]['purchase_line_subtotal']  =  number_format(($this->totalPurchaseQuantity * $cartName[$this->product_id]['purchase_price']),2,'.', '');
        }
        session([$this->cartName => $cartName]);   
        return true;
    } /*When changing quantity*/





        
    //====================================================================
    protected function shippingCostAndOtherInformationStoreInSession()
    {
        $invoice_shipping_cost = $this->requestAllCartData['invoice_shipping_cost'];
        $shipping_note = $this->requestAllCartData['shipping_note'];
        $purchase_note = $this->requestAllCartData['purchase_note'];
        $receiver_details = $this->requestAllCartData['receiver_details'];

        $cartName           = [];
        $cartName           = session()->has($this->cartName) ? session()->get($this->cartName)  : [];
        $cartName = [
            'invoice_shipping_cost'=> $invoice_shipping_cost,
            'shipping_note'=> $shipping_note,
            'purchase_note'=> $purchase_note,
            'receiver_details'=> $receiver_details,
        ];
        session([$this->cartName => $cartName]);
        return $this->cartName;
    }
    //====================================================================







    //====================================================================

    public function cartInsertUpdateWhenReturnOrEditSale()
    {
        $cartName = [];
        $cartName           = session()->has($this->cartName) ? session()->get($this->cartName)  : [];

        if(array_key_exists($this->product_var_id,$cartName))
        {

        }
        else{
            $cartName[$this->product_var_id] = [
                'name'   => "",
            ];
        }
        session([$this->cartName => $cartName]);
        return true;
    }


    private function discountAmount()
    {
        $distAmount = 0;
        if($this->discountType == 'percentage')
        {
            $unit_price = 0;
            $distAmount = number_format((($unit_price * ($this->quantity) * $this->discountValue) / 100),2,'.','');
        }else{
            $distAmount = $this->discountValue;
        }
        return  number_format(($distAmount),2,'.','');
    }


    private function netUnitSalePriceWithOutDiscount()
    {
        $disAmount = 0;
        if($this->discountType == 'percentage')
        {
            $unit_price = 0;
            $disAmount = number_format((($unit_price * ($this->quantity + $this->quantity) * $this->discountValue) / 100),2,'.','');
        }else{
            $disAmount = $this->discountValue;
        }
        $singleDiscount = ($disAmount / ($this->quantity + $this->quantity));
       return  number_format((($unit_price) - $singleDiscount),2,'.','');
    }



    /*Remove Single Data From  Cart Working Properly*/
    public function removeSingleDataFromCart()
    {
        $cartName  = session()->has($this->cartName) ? session()->get($this->cartName)  : [];
		unset($cartName[$this->product_var_id]);
        session([$this->cartName => $cartName]);
        return true;
    }

    /*Remove All Data From Cart Working Properly*/
    public function removeAllDataFromSaleEditCreateCart()
    {
        session([$this->cartName => []]);
        return true;
    }



  
 
}