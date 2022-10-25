<?php
namespace App\Traits\Backend\Payment;

//use App\Models\Backend\Stock\Stock;


/**
 * Stock changing trait
 * 
 */
trait PaymentProcessTrait
{
    //use Stock;
    //fsct == for stock changing trait
    protected $idd;
    protected $iii;

    
    /** 1
     * initial stock as increment stock
     * when product created : 
     * increase_stock_when_product_add
     */
    public function processingPayment()
    {   
        return getModuleBySingleModuleId_hh(2);
        return getModuleBySingleModuleLebel_hh('Sell');
    }



   

}
