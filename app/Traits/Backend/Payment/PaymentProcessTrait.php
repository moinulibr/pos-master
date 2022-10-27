<?php
namespace App\Traits\Backend\Payment;

use App\Models\Backend\Payment\AccountPayment;
use App\Models\Backend\Payment\AccountPaymentDetails;

//use App\Models\Backend\Stock\Stock;


/**
 * Stock changing trait
 * 
 */
trait PaymentProcessTrait
{
    //use Stock;

    protected $paymentModuleId;
    protected $paymentCdfTypeId;
    protected $paymentProcessingRelatedOfAllRequestData;
    protected $paymentProcessingRequiredOfAllRequestOfModuleRelatedData;
    protected $paymentAmount;

    private $currentPaymentAmount;
    private $lastPaymentAmount;
    
    /** 1
     * initial stock as increment stock
     * when product created : 
     * increase_stock_when_product_add
     */
    public function processingPayment()
    {   
        //getCdfBySingleCdfId_hh($key)
        //getCdfBySingleCdfLebel_hh($value)
        $this->insertAccountPaymentInformation();
        return true;
    }

    private function currentCdcAmountAfterCalculationByCdfType()
    {//required parameter 2 : $this->paymentCdfTypeId, $this->paymentAmount

        $lastPaymentAmount = AccountPayment::select('cdc_amount','cdf_type_id')->latest()->first();
        if($lastPaymentAmount)
        {
            $lastAmount = $lastPaymentAmount->cdc_amount;
        }else{
            $lastAmount = 0;
        }
        $cdcAmount = 0;
        if($this->paymentCdfTypeId == 1)
        {
            $cdcAmount = $lastAmount + $this->paymentAmount;
        }else{
           $cdcAmount = $lastAmount - $this->paymentAmount;
        }
        return $cdcAmount;
    }


    protected function insertAccountPaymentInformation()
    {
        //cdc amount before inserting this payment 
        $cdcAmountBeforeInsertingThisPayment = $this->currentCdcAmountAfterCalculationByCdfType();

        $ap = new AccountPayment();
        $rand = rand(01,99);
        $makeInvoice = date("iHsymd").$rand;
        $ap->branch_id = authBranch_hh();
        $ap->payment_invoice_no = $makeInvoice;;
        $ap->payment_reference_no = "";
        $ap->module_id = $this->paymentModuleId;
        $ap->module_invoice_no = $this->paymentProcessingRequiredOfAllRequestOfModuleRelatedData['module_invoice_no'];
        $ap->module_invoice_id = $this->paymentProcessingRequiredOfAllRequestOfModuleRelatedData['module_invoice_id'];

        $ap->cdf_type_id = $this->paymentCdfTypeId;
        $ap->payment_amount = $this->paymentAmount;
        //$ap->payment_type_id = $this->paymentProcessingRelatedOfAllRequestData;

        $ap->cdc_amount = $cdcAmountBeforeInsertingThisPayment;

        $ap->user_id = $this->paymentProcessingRequiredOfAllRequestOfModuleRelatedData['user_id'];

        $ap->received_by = authId_hh();
        $ap->payment_date = date('Y-m-d');

        $ap->account_id = $this->paymentProcessingRelatedOfAllRequestData['account_id'];
        $ap->payment_method_id = $this->paymentProcessingRelatedOfAllRequestData['payment_method_id'];
        $ap->payment_method_details = json_encode($this->paymentProcessingRelatedOfAllRequestData['payment_method_details']);

        $ap->next_payment_date = $this->paymentProcessingRelatedOfAllRequestData['next_payment_date'];
        $ap->payment_note = $this->paymentProcessingRelatedOfAllRequestData['payment_note'];
        $ap->sms_send = $this->paymentProcessingRelatedOfAllRequestData['sms_send'];
        $ap->email_send = $this->paymentProcessingRelatedOfAllRequestData['email_send'];
        $ap->save();

        //$this->insertAccountPaymentDetailsInformation($ap);
    }

    //insert account payment details information data
    private function insertAccountPaymentDetailsInformation($accountPayment)
    {
        $apd = new AccountPaymentDetails();
        $apd->branch_id = $this->paymentProcessingRelatedOfAllRequestData;
        $apd->account_payment_id = $this->paymentProcessingRelatedOfAllRequestData;
        $apd->payment_invoice_no = $this->paymentProcessingRelatedOfAllRequestData;
        $apd->payment_reference_no = $this->paymentProcessingRelatedOfAllRequestData;
        $apd->module_id = $this->paymentProcessingRelatedOfAllRequestData;
        $apd->module_invoice_no = $this->paymentProcessingRelatedOfAllRequestData;

        $apd->account_id = $this->paymentProcessingRelatedOfAllRequestData;
        $apd->payment_method_id = $this->paymentProcessingRelatedOfAllRequestData;
        $apd->payment_options = $this->paymentProcessingRelatedOfAllRequestData;//
        $apd->cdf_type_id = $this->paymentProcessingRelatedOfAllRequestData;
        $apd->transaction_no = $this->paymentProcessingRelatedOfAllRequestData;
      
        $apd->payment_amount = $this->paymentProcessingRelatedOfAllRequestData;
        $apd->payment_date = $this->paymentProcessingRelatedOfAllRequestData;
       
        $apd->save();
    }
   

}
