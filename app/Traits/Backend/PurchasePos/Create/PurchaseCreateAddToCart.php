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

    protected $changeType;
    protected $discountType;
    protected $discountValue;
    protected $discountAmount;
    protected $totalSellingQuantity;
    protected $mainProductStockQuantity;
    protected $otherProductStockQuantityPurchasePrice;
    protected $mainProductStockQuantityPurchasePrice;
    protected $totalPurchasePriceOfAllQuantity;
    protected $changingQuantity;


    protected $saleDetails;
    protected $singleCartId;
    protected $available_status;
    protected $saleUnitPrice;
    protected $sale_unit_price;
    protected $sale_quantity;
    protected $sale_return_quantity;

    protected $identityNumber;
    protected $sale_from_stock_id;
    protected $sale_type_id;
    protected $sale_unit_id;
    protected $purchase_price;
    protected $sub_total;
    protected $selling_unit_name;
    protected $price_cat_id;

    //sell cart invoice summery [session:SellCartInvoiceSummery]
    protected function sellCartInvoiceSummery()
    {
        //return $this->requestAllCartData;
        //$this->cartName     = "SellCartInvoiceSummery";
        $cartName           = [];
        $cartName           = session()->has($this->cartName) ? session()->get($this->cartName)  : [];

        $subtotalFromSellCartList   = $this->requestAllCartData['subtotalFromSellCartList'];
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
        $lineInvoiceSubTotal   = number_format($this->requestAllCartData['subtotalFromSellCartList'],2,'.', '');
        $lineAfterDiscountWithInvoiceSubTotal   = number_format(($this->requestAllCartData['subtotalFromSellCartList'] - $this->requestAllCartData['totalInvoiceDiscountAmount']),2,'.', '');
        $lineAfterDiscountAndVatWithInvoiceSubTotal   = number_format((($this->requestAllCartData['subtotalFromSellCartList'] - $this->requestAllCartData['totalInvoiceDiscountAmount'])+ $this->requestAllCartData['totalVatAmountCalculation']),2,'.', '');
        $lineAfterShippingCostDiscountAndVatWithInvoiceSubTotal   = number_format((($this->requestAllCartData['subtotalFromSellCartList'] - $this->requestAllCartData['totalInvoiceDiscountAmount']) +  $this->requestAllCartData['totalVatAmountCalculation'] + $this->requestAllCartData['totalShippingCost']),2,'.', '');
        $lineAfterOtherCostShippingCostDiscountAndVatWithInvoiceSubTotal   = number_format((($this->requestAllCartData['subtotalFromSellCartList'] - $this->requestAllCartData['totalInvoiceDiscountAmount']) +  $this->requestAllCartData['totalVatAmountCalculation'] + $this->requestAllCartData['totalShippingCost'] + $this->requestAllCartData['invoiceOtherCostAmount']),2,'.', '');
        $lineInvoiceRoundingAmount   = number_format((round($lineAfterOtherCostShippingCostDiscountAndVatWithInvoiceSubTotal) - $lineAfterOtherCostShippingCostDiscountAndVatWithInvoiceSubTotal),2,'.', '');
        $lineInvoicePayableAmountWithRounding   = number_format(round($lineAfterOtherCostShippingCostDiscountAndVatWithInvoiceSubTotal),2,'.', '');

        $cartName = [
            'invoice_customer_id'=> $this->requestAllCartData['customer_id'],
            'invoice_reference_id'=> $this->requestAllCartData['reference_id'],

            'subtotalFromSellCartList'=> $subtotalFromSellCartList,
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
        /* $subtotalFromSellCartList = $request->subtotalFromSellCartList;
        $totalItem = $request->totalItem;
        $invoiceDiscountAmount = $request->invoiceDiscountAmount;
        $invoiceDiscountType = $request->invoiceDiscountType;
        $totalInvoiceDiscountAmount = $request->totalInvoiceDiscountAmount;
        $invoiceVatAmount = $request->invoiceVatAmount;
        $totalVatAmountCalculation = $request->totalVatAmountCalculation;
        $totalShippingCost = $request->totalShippingCost;
        $invoiceOtherCostAmount = $request->invoiceOtherCostAmount;
        $totalInvoicePayableAmount = $request->totalInvoicePayableAmount;
        return $request; */
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
        $lineSubtotal = 0;
        if(count($this->requestAllCartData['stocks']) > 0)
        {
            foreach($this->requestAllCartData['stocks'] as $stock){
                if($this->requestAllCartData['purchase_quantity_sid_'.$stock] > 0)
                {
                    $purchasingQty = $this->requestAllCartData['purchase_quantity_sid_'.$stock];
                    $purchasingStockId =  $stock;
                    $instantlyReceivingQty = $this->requestAllCartData['instant_receive_sid_'.$stock];
                    $lineSubtotal = $this->requestAllCartData['subtotal_sid_'.$stock];
                }
            }
        }


        $othersProductStocks = [];
        if($this->requestAllCartData['more_quantity_from_others_product_stock'] == 1)
        {
            if(count($this->requestAllCartData['product_stock_id']) > 0)
            {
                foreach($this->requestAllCartData['product_stock_id'] as $productStockId)
                {
                    $othersProductStocks[$this->product_id]['others_product_stock_ids'][]   = $productStockId;  
                    $othersProductStocks[$this->product_id]['others_product_stock_qtys'][]  = $this->requestAllCartData['product_stock_quantity_'.$productStockId] ;  
                }
            }
        }
       
        $cartName[$this->product_id] = [
            'product_id'    => $this->product_id,
            'custom_code'   => $this->custom_code,
            'product_name'  => $this->product_name,
            'supplier_id'   => $this->requestAllCartData['supplier_id'],
            'unit_id'       => $this->requestAllCartData['unit_id'],
            'unit_name'     => $this->requestAllCartData['unit_name'],
            
            'purchase_qty'  => $purchasingQty,
            'stock_id' => $purchasingStockId,
            'instantly_receiving_qty' => $instantlyReceivingQty,
            'purchase_line_subtotal'  => $lineSubtotal,           
        ];
        session([$this->cartName => $cartName]);
        return true;
        if(array_key_exists($this->product_id,$cartName))
        {
            //$cartName[$this->saleDetails->id]['sale_price']           = number_format($sale_price,2,'.', '');
            //$cartName[$this->saleDetails->id]['quantity']             = $quantity;
        }
        else{
            $cartName[$this->product_id] = [
                'price_cat_id'              => $this->saleDetails->price_cat_id,
                'productVari_id'            => $this->saleDetails->product_variation_id,
                'product_id'                => $this->saleDetails->product_id,
                'sale_from_stock_id'        => $this->saleDetails->sale_from_stock_id,
                'selling_unit_name'         => $this->saleDetails->units?$this->saleDetails->units->short_name:NULL,
                'sale_type_id'              => $this->saleDetails->sale_type_id,
                'identityNumber'            => $this->saleDetails->saleWarrantyGrarantees?$this->saleDetails->saleWarrantyGrarantees->identity_number:NULL,
            ];
        }
        session([$this->cartName => $cartName]);
        return true;
    }
    
    /*Remove Single item From  Cart Working Properly*/
    public function removeSingleItemFromSellCreateAddedToCartList()
    {
        $this->cartName     = purchaseCreateCartSessionName_hh();//"SellCreateAddToCart";
        $this->product_id   = $this->requestAllCartData['product_id'];
        $cartName           = session()->has($this->cartName) ? session()->get($this->cartName)  : [];
        unset($cartName[$this->product_id]);
        session([$this->cartName => $cartName]);
        return true;
    }

    /*Remove All item From Cart Working Properly*/
    public function removeAllItemFromSellCreateAddedToCartList()
    {
        $this->cartName = purchaseCreateCartSessionName_hh();;//"SellCreateAddToCart";
        session([$this->cartName => []]);
        return true;
    }

    /*When changing quantity*/
    public function whenChangingQuantityFromCartList()
    {   
        $this->cartName         = purchaseCreateCartSessionName_hh();//"SellCreateAddToCart";
        $cartName               = session()->has($this->cartName) ? session()->get($this->cartName)  : [];
        
        $this->product_id       = $this->requestAllCartData['product_id'];
        $this->changeType       = $this->requestAllCartData['change_type'];
        $this->changingQuantity = $this->requestAllCartData['quantity'];
        
        $this->totalSellingQuantity             = $cartName[$this->product_id]['final_sell_quantity'];
        $this->mainProductStockQuantity         = $cartName[$this->product_id]['total_qty_of_main_product_stock'];
        
        if(array_key_exists($this->product_id,$cartName))
        {
            $this->available_status   = NULL;
            if($this->changeType == 'minus')
            {
                if((double) $cartName[$this->product_id]['total_qty_of_main_product_stock'] ==  1)
                {
                    //unset($cartName[$this->product_id]);
                    //session([$this->cartName => $cartName]);
                    //return true;
                    $this->totalSellingQuantity     = $cartName[$this->product_id]['final_sell_quantity'];
                    $this->mainProductStockQuantity = $cartName[$this->product_id]['total_qty_of_main_product_stock'];
                }
                else if((double) $cartName[$this->product_id]['total_qty_of_main_product_stock'] > 1)
                {
                    $this->totalSellingQuantity     = $cartName[$this->product_id]['final_sell_quantity'] - $this->changingQuantity;
                    $this->mainProductStockQuantity = $cartName[$this->product_id]['total_qty_of_main_product_stock'] - $this->changingQuantity;
                }
            }
            else if($this->changeType == 'plus')
            {
                $this->totalSellingQuantity     = $cartName[$this->product_id]['final_sell_quantity']   + $this->changingQuantity;
                $this->mainProductStockQuantity = $cartName[$this->product_id]['total_qty_of_main_product_stock'] + $this->changingQuantity;
            }

            if($cartName[$this->product_id]['discount_type'] == "percentage" && $cartName[$this->product_id]['discount_amount'])
            {
                $totalDiscountAmount =  (($this->totalSellingQuantity *  $cartName[$this->product_id]['final_sell_price']) * ($cartName[$this->product_id]['discount_amount']) / 100);
            }
            else if($cartName[$this->product_id]['discount_type'] == "fixed" && $cartName[$this->product_id]['discount_amount'])
            {
                $totalDiscountAmount =  $cartName[$this->product_id]['discount_amount'] ;
            }
            else{
                $totalDiscountAmount = 0 ;
            }
            $this->mainProductStockQuantityPurchasePrice    = $cartName[$this->product_id]['purchase_price'] * $this->mainProductStockQuantity;
            $this->otherProductStockQuantityPurchasePrice   = $cartName[$this->product_id]['others_product_stock_quantity_purchase_price'];
            $this->totalPurchasePriceOfAllQuantity          = $this->mainProductStockQuantityPurchasePrice + $this->otherProductStockQuantityPurchasePrice;

            $cartName[$this->product_id]['main_product_stock_quantity_purchase_price']      = $this->mainProductStockQuantityPurchasePrice; 
            $cartName[$this->product_id]['others_product_stock_quantity_purchase_price']    = $this->otherProductStockQuantityPurchasePrice;
            $cartName[$this->product_id]['total_purchase_price_of_all_quantity']            = $this->totalPurchasePriceOfAllQuantity;
            
            $cartName[$this->product_id]['final_sell_quantity']                             =  $this->totalSellingQuantity;
            $cartName[$this->product_id]['final_sell_quantity']                             =  $this->totalSellingQuantity;
            $cartName[$this->product_id]['selling_final_amount']                            =  number_format(($this->totalSellingQuantity *   $cartName[$this->product_id]['final_sell_price']) - $totalDiscountAmount,2,'.', '');
            $cartName[$this->product_id]['total_qty_of_main_product_stock']                 =  $this->mainProductStockQuantity;
            $cartName[$this->product_id]['total_discount_amount']                           =  $totalDiscountAmount;
            $cartName[$this->product_id]['total_amount_before_discount']                    =  number_format(($this->totalSellingQuantity *  $cartName[$this->product_id]['final_sell_price']),2,'.', '');;
        }
        session([$this->cartName => $cartName]);   
        return true;
    } /*When changing quantity*/





    







    //====================================================================

    public function cartInsertUpdateWhenReturnOrEditSale()
    {
        $cartName = [];
        $cartName           = session()->has($this->cartName) ? session()->get($this->cartName)  : [];

        //$this->discountType     = $this->saleDetails->discount_type;
        //$this->discountValue    = $this->saleDetails->discount_value;
        //$this->discountAmount   = $this->saleDetails->discount_amount;

        $this->sale_unit_price  = $this->saleDetails->unit_price;
        $this->purchase_price   = $this->saleDetails->purchase_price;
        $this->sale_quantity    = $this->saleDetails->quantity;
        $this->sale_return_quantity = $this->saleDetails->return_quantity?$this->saleDetails->return_quantity:0;

        //$this->saleUnitPrice    = $this->netUnitSalePriceWithOutDiscount();

        $productName    = $this->saleDetails->products->name;

        if(array_key_exists($this->product_var_id,$cartName))
            {
                //$cartName[$this->saleDetails->id]['sale_price']           = number_format($sale_price,2,'.', '');
                //$cartName[$this->saleDetails->id]['quantity']             = $quantity;
            }
        else{
            $cartName[$this->product_var_id] = [
                'price_cat_id'              => $this->saleDetails->price_cat_id,
                'productVari_id'            => $this->saleDetails->product_variation_id,
                'product_id'                => $this->saleDetails->product_id,
                'name'                      => $productName,
                'sale_price'                => number_format($this->sale_unit_price,2,'.', ''),
                'purchase_price'            => number_format($this->purchase_price,2,'.', ''),
                'discountType'              => $this->saleDetails->discount_type,
                'discountValue'             => $this->saleDetails->discount_value,
                'discountAmount'            => $this->saleDetails->discount_amount,
                'sub_total'                 => number_format((($this->sale_quantity * $this->sale_unit_price) - $this->discountAmount()),2,'.',''),
                'quantity'                  => $this->sale_quantity,
                'sale_unit_id'              => $this->saleDetails->sale_unit_id,
                'sale_from_stock_id'        => $this->saleDetails->sale_from_stock_id,
                'selling_unit_name'         => $this->saleDetails->units?$this->saleDetails->units->short_name:NULL,
                'sale_type_id'              => $this->saleDetails->sale_type_id,
                'identityNumber'            => $this->saleDetails->saleWarrantyGrarantees?$this->saleDetails->saleWarrantyGrarantees->identity_number:NULL,
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
            $distAmount = number_format((($this->sale_unit_price * ($this->sale_quantity) * $this->discountValue) / 100),2,'.','');
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
            $disAmount = number_format((($this->sale_unit_price * ($this->sale_quantity + $this->sale_return_quantity) * $this->discountValue) / 100),2,'.','');
        }else{
            $disAmount = $this->discountValue;
        }
        $singleDiscount = ($disAmount / ($this->sale_quantity + $this->sale_return_quantity));
       return  number_format((($this->sale_unit_price) - $singleDiscount),2,'.','');
    }



    /*Remove Single Data From  Cart Working Properly*/
    public function removeSingleDataFromCart()
    {
        $cartName           = session()->has($this->cartName) ? session()->get($this->cartName)  : [];
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