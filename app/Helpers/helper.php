<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Backend\Payment\Account;
use App\Models\Backend\Price\ProductPrice;
use App\Models\Backend\Stock\ProductStock;
use App\Models\Backend\ProductAttribute\Unit;

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
        function getModuleIdBySingleModuleLebel_hh($value)
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
                3 => "Purchase Return",
                4 => "Sell Return",
                5 => "Expense",
            ];
        }
    /*
    |--------------------------------------------------------------------------
    | Module during payment processing
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | CDF during payment processing
    |--------------------------------------------------------------------------
    */
        function getCdfLabelBySingleCdfId_hh($key)
        {
            $arrayLabel = "Not Match";
            if(array_key_exists($key,allCdf_hh()))
            {
                $arrayLabel = allCdf_hh()[$key];
            }
            return $arrayLabel;
        }
        
        function getCdfIdBySingleCdfLebel_hh($value)
        {
            $indexOfValue = "Not Match";
            if(in_array($value,allCdf_hh()))
            {
                foreach(allCdf_hh() as $index => $val)
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
        function allCdf_hh()
        {
            return [
                //value = label
                1 => "Credit",
                2 => "Debit"
            ];
        }

        //not using this..just for understand
        //get cdf sign by single cdf id
        function getCdfSignBySingleCdfId_hh($key)
        {
            $arraySign = "Not Match";
            if(array_key_exists($key,allCdfSign_hh()))
            {
                $arraySign = allCdfSign_hh()[$key];  
            }
            return $arraySign;
        }
        //all cdf sign
        function allCdfSign_hh()
        {
            return [
                //value = label
                1 => "+",//"Credit",
                2 => "-"//"Debit"
            ];
        }
        //not using this..just for understand
    /*
    |--------------------------------------------------------------------------
    | CDF during payment processing
    |--------------------------------------------------------------------------
    */



    /*
    |----------------------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    | Payment Details : when INSERT
    |--------------------------------------------------------------------------
    */
        //payment method: 1=cash, 2=advance,4=bank
        //cash accounts
        function cashAccounts_hh()
        {
            return Account::where('payment_method_id',1)->get();
        }
        //advance account 
        function advanceAccounts_hh()
        {
            return Account::whereIn('payment_method_id',[1,2])->get();
        }

        //all banking account
        function bankAccounts_hh()
        {
            return Account::where('payment_method_id',4)->get();
        }

        //all mobile banking account
        function mobileBankingAccounts_hh()
        {
            return Account::whereNotNull('banking_option_id')->where('banking_option_id',1)->get();
        }
        
        //only banking accounts
        function onlyBankingAccounts_hh()
        {
            return Account::whereNotNull('banking_option_id')->where('banking_option_id',2)->get();
        }

        function paymentDataProcessingWhenPurchaseingSubmitFromPos_hh($sellCreateFormData)
        {
            return paymentDataProcessingWhenSubmitingFromPos_hh($sellCreateFormData);
        }
        function paymentDataProcessingWhenSellingSubmitFromPos_hh($sellCreateFormData)
        {
            return paymentDataProcessingWhenSubmitingFromPos_hh($sellCreateFormData);
        }
        //payment data processing when selling submit from post
        function paymentDataProcessingWhenSubmitingFromPos_hh($sellCreateFormData)
        {
            $currentPaymentAccount = [];
            $transactionId = NULL;
            $paymentAllData = [ 
                'current_transaction_id' => $transactionId,
                'current_payment_options' => $currentPaymentAccount,//it's array

                'account_id_1' => $sellCreateFormData['account_id_1'] ?? NULL,
                'account_id_2' => $sellCreateFormData['account_id_2'] ?? NULL,
                'account_id_3' => $sellCreateFormData['account_id_3'] ?? NULL,
                'payment_method_id' => $sellCreateFormData['payment_option_id'],
                'next_payment_date' => $sellCreateFormData['next_payment_date'] ?? NULL,
                'sms_send' => $sellCreateFormData['send_sms'],
                'email_send' => $sellCreateFormData['send_email'],
                'payment_note' => $sellCreateFormData['payment_note'],

                'invoice_total_paying_amount' => $sellCreateFormData['invoice_total_paying_amount'] ?? 0,
                'invoice_total_due_amount' => $sellCreateFormData['invoice_total_due_amount'] ?? 0,
                'cash_payment_value' => $sellCreateFormData['cash_payment_value'] ?? 0,
                'advance_payment_value' => $sellCreateFormData['advance_payment_value'] ?? 0,
                'banking_payment_value' => $sellCreateFormData['banking_payment_value'] ?? 0,

                'payment_method_details' => [
                    'invoice_continue_with' => $sellCreateFormData['invoice_continue_with'],
                    'payment_method_id' => $sellCreateFormData['payment_option_id'],
                    'invoice_total_paying_amount' => $sellCreateFormData['invoice_total_paying_amount'] ?? 0,
                    'invoice_total_due_amount' => $sellCreateFormData['invoice_total_due_amount'] ?? 0,
                    'cash_payment_value' => $sellCreateFormData['cash_payment_value'] ?? 0,
                    'advance_payment_value' => $sellCreateFormData['advance_payment_value'] ?? 0,
                    'banking_payment_value' => $sellCreateFormData['banking_payment_value'] ?? 0,
                    'banking_option_id' => $sellCreateFormData['banking_option_id'],
                    
                    'banking_option_name' => $sellCreateFormData['banking_option_name'] ?? "cash_or_advance",

                    //mobile banking
                    'account_id_3_1' => $sellCreateFormData['account_id_3'],//mobile banking
                    'mb_customer_moible_no' => $sellCreateFormData['mobile_banking_customer_mobile_no'],
                    'mb_transaction_id' => $sellCreateFormData['mobile_banking_transaction_id'],
    
                    'b_transaction_type' => $sellCreateFormData['banking_transaction_type'],
                    'account_id_3_2' => $sellCreateFormData['account_id_3'],//banking
    
                    'cheque_no' => $sellCreateFormData['cheque_no'],
                    'cheque_customer_b_name' => $sellCreateFormData['cheque_customer_bank_name'],
                    'cheque_b_short_note' => $sellCreateFormData['cheque_banking_short_note'],
    
                    'online_transfer_customer_b_name' => $sellCreateFormData['banking_online_transfer_transation_customer_bank_name'],
                    'online_transfer_customer_transaction_note' => $sellCreateFormData['banking_online_transfer_customer_transaction_note'],
                    'online_transfer_received_transaction_id' => $sellCreateFormData['banking_online_transfer_received_bank_transaction_id'],
                    
                    'b_card_swipe_code' => $sellCreateFormData['bank_card_swipe_code'],
                    'b_card_credit_card_no' => $sellCreateFormData['bank_card_credit_card_no'],
                    'b_card_holder_name' => $sellCreateFormData['bank_card_holder_name'],
                    'b_card_type' => $sellCreateFormData['bank_card_type'],
                    'b_card_expire_month' => $sellCreateFormData['bank_card_expire_month'],
                    'b_card_expire_year' => $sellCreateFormData['bank_card_expire_year'],
                    'b_card_cvv2' => $sellCreateFormData['bank_card_cvv2'],
                ],
            ];
            return $paymentAllData;
        }
        //current account payment option
        function currentAccountPaymentOption_hh($sellCreateFormData, $paymentMethodId)
        {
            $currentPaymentAccount = [];
            $transactionId = NULL;
            if( $paymentMethodId == 1)//cash
            {
                $currentPaymentAccount = [
                    'payment_method_id' => $sellCreateFormData['payment_method_id'],
                    'account_id_1' => $sellCreateFormData['account_id_1'],
                ];
            }
            else if( $paymentMethodId == 2)//advance
            {
                $currentPaymentAccount = [
                    'payment_method_id' => $sellCreateFormData['payment_method_id'],
                    'account_id_2' => $sellCreateFormData['account_id_2'],
                ];
            } 
            else if( $paymentMethodId == 4)//bank 
            {
                if($sellCreateFormData['payment_method_details']['banking_option_id'] == 1) // mobile banking
                {
                    $transactionId = $sellCreateFormData['payment_method_details']['mb_transaction_id'];
                    $currentPaymentAccount = [
                        'payment_method_id' => $sellCreateFormData['payment_method_id'],
                        'banking_option_id' => $sellCreateFormData['payment_method_details']['banking_option_id'],
                        'account_id_3' => $sellCreateFormData['account_id_3'],//banking
                        'account_id_3_1' => $sellCreateFormData['account_id_3'],//mobile banking
                        'mb_customer_moible_no' => $sellCreateFormData['payment_method_details']['mb_customer_moible_no'],
                        'mb_transaction_id' => $sellCreateFormData['payment_method_details']['mb_transaction_id'],
                    ];
                }
                else if($sellCreateFormData['payment_method_details']['banking_option_id'] == 2)//Banking
                {
                    if($sellCreateFormData['payment_method_details']['b_transaction_type'] == 1)//direct deposit
                    {
                        $currentPaymentAccount = [
                            'payment_method_id' => $sellCreateFormData['payment_method_id'],
                            'banking_option_id' => $sellCreateFormData['payment_method_details']['banking_option_id'],
                            'b_transaction_type' => $sellCreateFormData['payment_method_details']['b_transaction_type'],
                            'account_id_3' => $sellCreateFormData['account_id_3'],//banking
                            'account_id_3_2' => $sellCreateFormData['account_id_3'],//banking
                        ];
                    }
                    else if($sellCreateFormData['payment_method_details']['b_transaction_type'] == 2)
                    {
                        $currentPaymentAccount = [
                            'banking_option_id' => $sellCreateFormData['payment_method_details']['banking_option_id'],
                            'b_transaction_type' => $sellCreateFormData['payment_method_details']['b_transaction_type'],
                            'account_id_3' => $sellCreateFormData['account_id_3'],//banking
                            'account_id_3_2' => $sellCreateFormData['account_id_3'],//banking
                            'cheque_no' => $sellCreateFormData['payment_method_details']['cheque_no'],
                            'cheque_customer_b_name' => $sellCreateFormData['payment_method_details']['cheque_customer_b_name'],
                            'cheque_b_short_note' => $sellCreateFormData['payment_method_details']['cheque_b_short_note'],        
                        ];
                    }
                    else if($sellCreateFormData['payment_method_details']['b_transaction_type'] == 3)
                    {
                        $transactionId = $sellCreateFormData['payment_method_details']['online_transfer_received_transaction_id'];
                        $currentPaymentAccount = [
                            'banking_option_id' => $sellCreateFormData['payment_method_details']['banking_option_id'],
                            'b_transaction_type' => $sellCreateFormData['payment_method_details']['b_transaction_type'],
                            'account_id_3' => $sellCreateFormData['account_id_3'],//banking
                            'account_id_3_2' => $sellCreateFormData['account_id_3'],//banking
                            'online_transfer_customer_b_name' => $sellCreateFormData['payment_method_details']['online_transfer_customer_b_name'],
                            'online_transfer_customer_transaction_note' => $sellCreateFormData['payment_method_details']['online_transfer_customer_transaction_note'],
                            'online_transfer_received_transaction_id' => $sellCreateFormData['payment_method_details']['online_transfer_received_transaction_id'],
                        ];
                    }
                }
                else if($sellCreateFormData['payment_method_details']['banking_option_id'] == 3) // card
                {
                    $currentPaymentAccount = [
                        'payment_method_id' => $sellCreateFormData['payment_method_id'],
                        'b_card_swipe_code' => $sellCreateFormData['payment_method_details']['b_card_swipe_code'],
                        'b_card_credit_card_no' => $sellCreateFormData['payment_method_details']['b_card_credit_card_no'],
                        'b_card_holder_name' => $sellCreateFormData['payment_method_details']['b_card_holder_name'],
                        'b_card_type' => $sellCreateFormData['payment_method_details']['b_card_type'],
                        'b_card_expire_month' => $sellCreateFormData['payment_method_details']['b_card_expire_month'],
                        'b_card_expire_year' => $sellCreateFormData['payment_method_details']['b_card_expire_year'],
                        'b_card_cvv2' => $sellCreateFormData['payment_method_details']['b_card_cvv2'],
                    ];
                }
            }
            return [
                'transactionId' => $transactionId,
                'currentPaymentAccounts' => $currentPaymentAccount
            ];
        }
        //current payment option method
        function currentPaymentOptionMethod_hh($paymentOptionId, $paymentMethodOptionId,$sellCreateFormData)
        {
            $paymentMethodOptionId = $sellCreateFormData['payment_method_id'];
            if($paymentMethodOptionId == 1)//"Cash Only",
            {
                return currentAccountPaymentOption_hh($sellCreateFormData,$paymentMethodId = 1);//cash     
            } 
            else if($paymentMethodOptionId == 2)//"Advance Only",
            {
                return currentAccountPaymentOption_hh($sellCreateFormData,$paymentMethodId = 2);//advance   
            }
            else if($paymentMethodOptionId == 3)//"Cash + Advance"
            {
                if($paymentOptionId == 1)
                {
                    return currentAccountPaymentOption_hh($sellCreateFormData,$paymentMethodId = 1);//cash 
                }
                else if($paymentOptionId == 2)
                {
                    return currentAccountPaymentOption_hh($sellCreateFormData,$paymentMethodId = 2);//advance 
                }
            }
            else if($paymentMethodOptionId == 4)//"Banking Only",
            { 
                return currentAccountPaymentOption_hh($sellCreateFormData,$paymentMethodId = 4);//Banking 
            }
            else if($paymentMethodOptionId == 5)//"Banking + Cash",
            {
                if($paymentOptionId == 1)
                {
                    return currentAccountPaymentOption_hh($sellCreateFormData,$paymentMethodId = 1);//Cash 
                }
                else if($paymentOptionId == 2)
                {
                    return currentAccountPaymentOption_hh($sellCreateFormData,$paymentMethodId = 4);//Banking  
                }
            }
            else if($paymentMethodOptionId == 6)//"Banking + Advance",
            {
                if($paymentOptionId == 1)
                {
                    return currentAccountPaymentOption_hh($sellCreateFormData,$paymentMethodId = 2);//advance
                }
                else if($paymentOptionId == 2)
                {
                    return currentAccountPaymentOption_hh($sellCreateFormData,$paymentMethodId = 4);//Banking
                }
            }
            else if($paymentMethodOptionId == 7)//"Banking + Cash + Advance",
            {
                if($paymentOptionId == 1)
                {
                    return currentAccountPaymentOption_hh($sellCreateFormData,$paymentMethodId = 1);//Cash 
                }
                else if($paymentOptionId == 2)
                {
                    return currentAccountPaymentOption_hh($sellCreateFormData,$paymentMethodId = 2);//Advance 
                }
                else if($paymentOptionId == 3)
                {
                    return currentAccountPaymentOption_hh($sellCreateFormData,$paymentMethodId = 4);//Banking 
                }
            }
            return 1;
        }

        //invoice continue with
        function invoiceContinueWith_hh()
        {
            return [
                1 => "Due",
                2 => "Payment",
            ];
        }
        //payment methods based looping
        function paymentMethodsBasedLooping_hh($key)
        {
            $looping = 1;
            if(array_key_exists($key,paymentMethodsBasedOnStoreData_hh()))
            {
                $looping = paymentMethodsBasedOnStoreData_hh()[$key];
            }
            return $looping;
        }

        //payment methods based on store data
        function paymentMethodsBasedOnStoreData_hh()
        {
            return [
                //payment method id = looping time
                1 => 1,
                2 => 1,
                3 => 2,//cash+advance
                4 => 1,
                5 => 2,//cash+banking
                6 => 2,//banking+advance
                7 => 3,//cash+banking+advance
            ];
        }

        //get payment method id by label/name
        function getPaymentMethodIdByLebel_hh($value)
        {
            $indexOfValue = "Not Match";
            if(in_array($value,paymentMethodAndPaymentOptionBothAreSame_hh()))
            {
                foreach(paymentMethodAndPaymentOptionBothAreSame_hh() as $index => $val)
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
        
        //get payment method label/name by payment method id
        function getPaymentMethodLabelById_hh($key)
        {
            $label = "Not Match";
            if(array_key_exists($key,paymentMethodAndPaymentOptionBothAreSame_hh()))
            {
                $label = paymentMethodAndPaymentOptionBothAreSame_hh()[$key];
            }
            return $label;
        }
        
        //payment method and payment option 
        function paymentMethodAndPaymentOptionBothAreSame_hh()
        {
            return [
                //index = value
                1 => "Cash Only",
                2 => "Advance Only",
                3 => "Cash + Advance",
                4 => "Banking Only",
                5 => "Banking + Cash",
                6 => "Banking + Advance",
                7 => "Banking + Cash + Advance",
            ];
        }
        //all banking options
        function bankingOptions_hh()
        {
            return [
                //index = value
                1 => "Mobile Banking",
                2 => "Bank",
                //3 => "Card",
            ];
        }
        //banking transaction type
        function bankingTransactionType_hh()
        {
            return [
                //index = value
                1 => "Direct Deposit",
                2 => "Cheque",
                3 => "Online Transfer",
            ];
        }
        //banking card type
        function bankingCardType_hh()
        {
            return [
                //index = value
                //"" => 'Card Type',
                1 => "Credit Card",
                2 => "Debit Card",
                3 => "Visa Card",
                4 => "Master Card",
            ];
        }

        //get account_id_ extension
        function accountExtensions_hh($acc_id, $extension)
        {
            $method = [];
            $method['subtotal_paying_amount'] = NULL;
            $method['acc_id'] = NULL;
            if( $extension == 1)//cash
            {
                $method['subtotal_paying_amount'] = "cash_payment_value";
                $method['acc_id'] = $acc_id;
            }
            else if( $extension == 2)//advance
            {
                $method['subtotal_paying_amount'] = "advance_payment_value";
                $method['acc_id'] = $acc_id;
            } 
            else if( $extension == 4)//bank 
            {
                $method['subtotal_paying_amount'] = "banking_payment_value";
                $method['acc_id'] = $acc_id;
            }
            return $method; 
        }
        //account id extension by payment method or option
        function accountIdExtensionByPaymentMethodOrOptionId_hh($paymentOptionId, $paymentMethodOptionId)
        {
            if($paymentMethodOptionId == 1)//"Cash Only",
            {
                return accountExtensions_hh($acc_id = 1,$paymentMethodId = 1);//cash     
            } 
            else if($paymentMethodOptionId == 2)//"Advance Only",
            {
                return accountExtensions_hh($acc_id = 2,$paymentMethodId = 2);//advance   
            }
            else if($paymentMethodOptionId == 3)//"Cash + Advance"
            {
                if($paymentOptionId == 1)
                {
                    return accountExtensions_hh($acc_id = 1,$paymentMethodId = 1);//cash 
                }
                else if($paymentOptionId == 2)
                {
                    return accountExtensions_hh($acc_id = 2,$paymentMethodId = 2);//advance 
                }
            }
            else if($paymentMethodOptionId == 4)//"Banking Only",
            { 
                return accountExtensions_hh($acc_id = 3,$paymentMethodId = 4);//Banking 
            }
            else if($paymentMethodOptionId == 5)//"Banking + Cash",
            {
                if($paymentOptionId == 1)
                {
                    return accountExtensions_hh($acc_id = 1,$paymentMethodId = 1);//Cash 
                }
                else if($paymentOptionId == 2)
                {
                    return accountExtensions_hh($acc_id = 3,$paymentMethodId = 4);//Banking  
                }
            }
            else if($paymentMethodOptionId == 6)//"Banking + Advance",
            {
                if($paymentOptionId == 1)
                {
                    return accountExtensions_hh($acc_id = 2,$paymentMethodId = 2);//advance
                }
                else if($paymentOptionId == 2)
                {
                    return accountExtensions_hh($acc_id = 3,$paymentMethodId = 4);//Banking
                }
            }
            else if($paymentMethodOptionId == 7)//"Banking + Cash + Advance",
            {
                if($paymentOptionId == 1)
                {
                    return accountExtensions_hh($acc_id = 1,$paymentMethodId = 1);//Cash 
                }
                else if($paymentOptionId == 2)
                {
                    return accountExtensions_hh($acc_id = 2,$paymentMethodId = 2);//Advance 
                }
                else if($paymentOptionId == 3)
                {
                    return accountExtensions_hh($acc_id = 3,$paymentMethodId = 4);//Banking 
                }
            }
            return 1;
        }
    /*
    |--------------------------------------------------------------------------
    | Payment Details : when INSERT
    |--------------------------------------------------------------------------
    |----------------------------------------------------------------------------------------
    */
      

    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    | Setting, App Name, App Address, Phone, and others
    |----------------------------------------------------------------------------------------
    */
        function AppName_hh()
        {
            return "Amader Sanitary"; 
        }
        function AppPhone_hh()
        {
            return "01711 11 11 92";
        }
        function AppAddressFirstLine_hh()
        {
            return "Janata Bank More, Hafej Bulding Under";
        } 
        function AppAddressSecondLine_hh()
        {
            return "Graound, Faridpur";
        }
    /*
    |--------------------------------------------------------------------------
    | Setting, App Name, App Address, Phone, and others
    |--------------------------------------------------------------------------
    |----------------------------------------------------------------------------------------
    */
      