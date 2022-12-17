<?php
namespace App\Traits\Backend\Payment;

use App\Models\Backend\Customer\CustomerTransactionHistory;
use App\Models\Backend\Payment\AccountPayment;




/**
 * Stock changing trait
 * 
 */
trait CustomerPaymentProcessTrait
{
    //use Stock;

    protected $processingOfAllCustomerTransactionRequestData;

    //customer transaction statement, transaction type == tt
    protected $ctsTTModuleId;
    protected $ctsCustomerId;
    protected $ttModuleInvoicsDataArrayFormated;
    protected $ctsCdsTypeId;
    protected $amount;
    protected $ctsCurrentPaymentAmount;

    private $ctsLastPaymentAmount;
    
    /*
    * Processing Payment
    */
    public function processingOfAllCustomerTransaction()
    {   
        $this->insertCustomerTransactionHistory();
        return true;
    }

    //insert account payment invoice
    protected function insertCustomerTransactionHistory()
    {   
        //$this->ctsCustomerId
        $lastAmountOfThisCustomer = $this->currentCdcAmountAfterCalculationByCtsCdfType();
        
        $customerTransaction = new CustomerTransactionHistory();
        $rand = rand(01,99);
        $makeInvoice = date("iHsymd").$rand;
        $customerTransaction->branch_id = authBranch_hh();
      
        $customerTransaction->ledger_page_no =  $this->processingOfAllCustomerTransactionRequestData['ledger_page_no'];
        $customerTransaction->next_payment_date = $this->processingOfAllCustomerTransactionRequestData['next_payment_date'] ? date('Y-m-d',strtotime($this->processingOfAllCustomerTransactionRequestData['next_payment_date'])) : NULL;
        $customerTransaction->created_date = date('Y-m-d');
        $customerTransaction->tt_module_id = $this->ctsTTModuleId;
        $customerTransaction->tt_module_invoice_no = $this->ttModuleInvoicsDataArrayFormated['invoice_no'];
        $customerTransaction->tt_module_invoice_id = $this->ttModuleInvoicsDataArrayFormated['invoice_id'];
        $customerTransaction->cdf_type_id = $this->ctsCdsTypeId;
        $customerTransaction->amount = $this->amount;
        $customerTransaction->sell_amount = $this->processingOfAllCustomerTransactionRequestData['sell_amount'];
        $customerTransaction->sell_paid = $this->processingOfAllCustomerTransactionRequestData['sell_paid'];
        $customerTransaction->sell_due = $this->processingOfAllCustomerTransactionRequestData['sell_due'];
        $customerTransaction->user_id = $this->ctsCustomerId;
        $customerTransaction->received_by = authId_hh();
        $customerTransaction->short_note = $this->processingOfAllCustomerTransactionRequestData['short_note'];
        $customerTransaction->save();

        
        $customerTransaction->cdc_amount = $lastAmountOfThisCustomer;
        $customerTransaction->save();
        return $customerTransaction;
    }
    
    //current cdc amount after culculation by cdf type id
    private function currentCdcAmountAfterCalculationByCtsCdfType()
    {
        //required parameter 2 : $this->ctsCdsTypeId, $this->currentPaymentAmount

        $lastPaymentAmount = CustomerTransactionHistory::select('cdc_amount','user_id')->where('user_id',$this->ctsCustomerId)->latest()->first();
        if($lastPaymentAmount)
        {
            $lastAmount = $lastPaymentAmount->cdc_amount;
        }else{
            $lastAmount = 0;
        }

        $cdcAmount = 0;
        if($this->ctsCdsTypeId == 1) // credit = paid
        {
            $cdcAmount = $lastAmount + $this->ctsCurrentPaymentAmount;//$this->currentPaymentAmount;
        }
        else if($this->ctsCdsTypeId == 2)
        {
            $cdcAmount = $lastAmount - $this->ctsCurrentPaymentAmount;//$this->currentPaymentAmount;
        }
        else{
           $cdcAmount = $lastAmount;
        }
        return $cdcAmount;
    }

}
