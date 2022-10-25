<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Backend\Price\ProductPrice;
use App\Models\Backend\ProductAttribute\Unit;
use App\Models\Backend\Stock\ProductStock;

    function authBranch_hh()
    {
        return Auth::guard('web')->user()->branch_id;
        //Auth::guard('web')->user()->id;
    }
    function authId_hh()
    {
        return Auth::guard('web')->user()->id;
    }


    function regularStockId_hh()
    {
        return 1;
    }
    function regularSellId_hh()
    {
        return 2;
    }
    function mrpSellId_hh()
    {
        return 1;
    }
    function mrpPriceId_hh()
    {
        return 1;
    }
    function purchasePriceId_hh()
    {
        return 5;
    }
    function offerPurchasePriceId_hh()
    {
        return 4;
    }
    function wholeSellPriceId_hh()
    {
        return 3;
    }
    function retailSellPriceId_hh()
    {
        return 2;
    }

    //show subtotal and line total when purchase cart create and cart list  
    function purchaseLineTotalSubtotalWhenCartCreateAndShowCartList_hh()
    {
        return purchasePriceId_hh();
    }
    //show subtotal and line total when purchase cart create and cart list  


    /*
    |----------------------------------------------------------------------------
    | selling master
    |----------------------------------------------------------------------------
    */
        function masterSellingSession_hh()
        {
            return "master_selling_session";
        } 

        //get selling current session from master session
        function getSellingCurrentSession_hh()
        {
            $sellMasterCartName = masterSellingSession_hh();
            $sellCartMaster   = [];
            $sellCartMaster   = session()->has($sellMasterCartName) ? session()->get($sellMasterCartName)  : [];
            
            $currentSession = NULL;
            foreach($sellCartMaster as $master)
            {
                if($master['status'] == 'active')
                {
                    $currentSession = $master['session_name'];
                }
            }
            return $currentSession;
        }

        //current selling session from master session
        function currentSellingSession_hh()
        {
            return getSellingCurrentSession_hh();
        }


        //first time default master selling session create
        function firstTimeDefaultMasterSellSessionCreate_hh()
        {
            $mastersessionname = masterSellingSession_hh();
            $mastersession    = [];
            $mastersession    = session()->has($mastersessionname) ? session()->get($mastersessionname)  : [];
            if(count($mastersession) == 0)
            {
                $mastersession[defaultSellingSession_hh()] = [
                        'session_name' => defaultSellingSession_hh(),
                        'name' => defaultSellingSessionName_hh(),
                        'status' => 'active',
                    ];
                session([$mastersessionname => $mastersession]);
            }
        }

        //unset last sell session from master session (not using this)
        function unsetLastSellSessionFromMasterSession_hh()
        {
            $mastersessionname = masterSellingSession_hh();
            $mastersession    = [];
            $mastersession    = session()->has($mastersessionname) ? session()->get($mastersessionname)  : [];
            
            if(count($mastersession) > 0)
            {
                unset($mastersession[currentSellingSession_hh()]);
            }
            session([$mastersessionname => $mastersession]);
        }

        //unset all from sell master session
        function unsetRequestedSellSessionFromMasterSession_hh($requestSession)
        {
            session([sellCreateCartSessionName_hh() => []]);
            session([sellCreateCartInvoiceSummerySessionName_hh() => []]);
            session([sellCreateCartShippingAddressSessionName_hh() => []]);
            
            $mastersessionname = masterSellingSession_hh();
            $mastersession    = [];
            $mastersession    = session()->has($mastersessionname) ? session()->get($mastersessionname)  : [];
            if(count($mastersession) > 0)
            {
                unset($mastersession[$requestSession]);
            }
            session([$mastersessionname => $mastersession]);
        }

        //remove all from sell master session
        function removeAllSellSessionFromMasterSession_hh()
        {
            session([sellCreateCartSessionName_hh() => []]);
            session([sellCreateCartInvoiceSummerySessionName_hh() => []]);
            session([sellCreateCartShippingAddressSessionName_hh() => []]);

            session([masterSellingSession_hh() => []]);
        }
    /*
    |----------------------------------------------------------------------------
    | selling master
    |----------------------------------------------------------------------------
    */

    /*
    |---------------------------------------
    | sell related session part
    |-------------------------------------
    */
        function defaultSellingSession_hh()
        {
            return "defaultSellingSession";
        }
        function defaultSellingSessionName_hh()
        {
            return "Default Selling Customer";
        }
        function sellCreateCartSessionName_hh()
        {
            return "SellCreateAddToCart_".currentSellingSession_hh(); 
        }
        function sellCreateCartInvoiceSummerySessionName_hh()
        {
            return "SellCartInvoiceSummery_".currentSellingSession_hh();
        } 
        function sellCreateCartShippingAddressSessionName_hh()
        {
            return "customerShippingAddress_".currentSellingSession_hh();
        }
    /*
    |---------------------------------------
    | sell related session part
    |-------------------------------------
    */


    
    /*
    |---------------------------------------
    | purchase related session part
    |-------------------------------------
    */
        function defaultPurchaseSession_hh()
        {
            return "defaultPurchaseSession";
        }
        function defaultPurchaseSessionName_hh()
        {
            return "Default Purchase Customer";
        }
        function purchaseCreateCartSessionName_hh()
        {
            return "PurchaseCreateAddToCart_".currentPurchaseSession_hh(); 
        }
        function purchaseCreateCartInvoiceSummerySessionName_hh()
        {
            return "PurchaseCartInvoiceSummery_".currentPurchaseSession_hh();
        } 
        function purchaseCreateCartShippingCostSessionName_hh()
        {
            return "purchaseShippingCost_".currentPurchaseSession_hh();
        }

        //current selling session from master session
        function currentPurchaseSession_hh()
        {
            return getSellingCurrentSession_hh();
        }
    /*
    |---------------------------------------
    | purchase related session part
    |-------------------------------------
    */


    //get only single price, by product id,product stock id, stock id, price id
    function getProductPriceByProductStockIdProductIdStockIdPriceId_hh($productId,$productStockId,$stockId,$priceId)
    {
        $price = ProductPrice::where('product_id',$productId)->where('stock_id',$stockId)
                    ->where('product_stock_id',$productStockId)
                    ->where('price_id',$priceId)//purchase price 
                    ->first();
        return $price ? $price->price : 0 ;
    }


    function defaultProductImageUrl_hh()
    {
        return 'storage/backend/default/product/default.png';
    }
    function productStoreImageLocation_hh()
    {
        return 'backend/product/product/';
    }
    function productImageViewLocation_hh()
    {
        return 'storage/backend/product/product/';
    }
    function defaultUserImageUrl_hh()
    {
        return 5;
    }
    function userImageLocation_hh()
    {
        return 5;
    }

    function defaultSelectedProductStockId_hh()
    {
        return 1;
    }
    function defaultSelectedPriceId_hh()
    {
        return 2;
    }

    function unitIdWiseUnitView_hh(
        $available_stock,$available_base_stock,
        $purchase_unit_id,$changing_unit_id
    )
    {
        $totalStock = $available_base_stock;
        if($purchase_unit_id == $changing_unit_id)
        {
            $totalStock =  $available_base_stock; 
        }else{
            $result = Unit::find($changing_unit_id)->calculation_result;
            $totalBaseStock = $available_stock / $result;
            return $totalBaseStock;
        }
        return $totalStock;
    }

    //stock
    function unitView_hh($unitId,$stockQuantity)
    {
        $unit = Unit::find($unitId);
        return $stockQuantity / $unit->calculation_result;
    }


    //sell applicable when selling price is less than purchase price
    function sellApplicableOrNotWhensellingPriceIsLessThanPurchasePrice_hh()
    {
        return 1;
        // 1 = yes sell, when selling price is less than purchase price
        // 0 = not sell, when selling price is less than purchase price
    } 

    // sell applicable when stock is less than zero
    function sellApplicableOrNotWhenStockIsLessThanZero_hh()
    {
        return 1;
        // 1 = not sell, when product stock is less than zero (stock will be never minus)
        // 0 = yes sell, when product stock is less than zero (stock will be never minus)
    }
    function sellApplicableOrNotWhenTotalDiscountAmountIsGreaterThanTotalPurchasePrice_hh()
    {
        return 1;
        // 1 = yes sell, when total discount amout is less than total purchase price
        // 0 = not sell, when total discount amout is less than total purchase price
    }
    
    function displayMrpOrRegularSellPriceInTheCustomerInvoice_hh()
    {
        return 1;
        // 0 = regular sell price
        // 1 = mrp price
    }

    //vat for sell
    function vatApplicableOrNotWhenSellCreate_hh()
    {
        return 0;
        // 0 = no
        // 1 = yes
    }
    function vatApplicableOrNotWithVatAmountWhenSellCreate_hh()
    {
       if(vatApplicableOrNotWhenSellCreate_hh() == 1)
       {
            return 5; 
       }else{
        return 0;
       }
    }
    function vatCustomizationApplicableOrNotWhenSellCreate_hh()
    {
        return 0;
        // 0 = no
        // 1 = yes
    }
    //vat for sell


    //vat for purchase
    function vatApplicableOrNotWhenPurchaseCreate_hh()
    {
        return 0;
        // 0 = no
        // 1 = yes
    }
    function vatApplicableOrNotWithVatAmountWhenPurchaseCreate_hh()
    {
       if(vatApplicableOrNotWhenPurchaseCreate_hh() == 1)
       {
            return 5; 
       }else{
        return 0;
       }
    }
    function vatCustomizationApplicableOrNotWhenPurchaseCreate_hh()
    {
        return 0;
        // 0 = no
        // 1 = yes
    }
    //vat for purchase



    //product stock
    function productStockByProductStockId_hh($id)
    {
        $pstock = ProductStock::findOrFail($id);
        if($pstock)
        {
            return $pstock;
        }
        return NULL;
    }



    /*
    |--------------------------------------------------------------------------
    | Module during payment processing
    |--------------------------------------------------------------------------
    */
        function getModuleBySingleModuleId_hh($key)
        {
            $arrayLabel = "Not Match";
            if(array_key_exists($key,allModule_hh()))
            {
                $arrayLabel = allModule_hh()[$key];
            }
            return $arrayLabel;
        }
        function getModuleBySingleModuleLebel_hh($value)
        {
            $indexOfValue = "Not Match";
            if(in_array($value,allModule_hh()))
            {
                foreach(allModule_hh() as $index => $val)
                {
                    if($value == $val)
                    {
                        $indexOfValue = $index;
                        break;
                    }
                }
            }
            return $indexOfValue; 
        }
        function allModule_hh()
        {
            return [
                //value = label
                1 => "Purchase",
                2 => "Sell",
                3 => "Expense",
            ];
        }
    /*
    |--------------------------------------------------------------------------
    | Module during payment processing
    |--------------------------------------------------------------------------
    */
