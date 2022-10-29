<?php
namespace App\Traits\Backend\Payment;

use App\Models\Backend\Payment\AccountPayment;
use App\Models\Backend\Payment\AccountPaymentDetails;
use App\Models\Backend\Payment\AccountPaymentInvoice;

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
        $this->insertAccountPaymentInvoice();
        return true;
    }

    protected function insertAccountPaymentInvoice()
    {
        $ap = new AccountPaymentInvoice();
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
        $ap->user_id = $this->paymentProcessingRequiredOfAllRequestOfModuleRelatedData['user_id'];
        $ap->received_by = authId_hh();
        $ap->payment_date = date('Y-m-d');

       
        $ap->payment_method_details = json_encode($this->paymentProcessingRelatedOfAllRequestData['payment_method_details']);

        $ap->next_payment_date = $this->paymentProcessingRelatedOfAllRequestData['next_payment_date'];
        $ap->payment_note = $this->paymentProcessingRelatedOfAllRequestData['payment_note'];
        $ap->sms_send = $this->paymentProcessingRelatedOfAllRequestData['sms_send'];
        $ap->email_send = $this->paymentProcessingRelatedOfAllRequestData['email_send'];
        $ap->save();
        
        $lopping = paymentMethodsBasedLooping_hh($this->paymentProcessingRelatedOfAllRequestData['payment_method_id']);
        for ($paymentOptionId=1; $paymentOptionId <= $lopping; $paymentOptionId++) { 
            $this->insertAccountPaymentInformation($ap,$paymentOptionId);
        }
        return $ap;
    }
    protected function insertAccountPaymentInformation($accPymntInvoice,$paymentOptionId)
    {
        //required parameter 2 : $this->paymentCdfTypeId, $this->currentPaymentAmount
        $this->currentPaymentAmount = 0;
        $this->paymentCdfTypeId = 1;
        $cdcAmountBeforeInsertingThisPayment = $this->currentCdcAmountAfterCalculationByCdfType();

        $ap = new AccountPayment();

       $ap->branch_id = $accPymntInvoice->branch_id;
       $ap->account_payment_invoice_id = $accPymntInvoice->id;
       $ap->payment_invoice_no = $accPymntInvoice->payment_invoice_no;
       $ap->payment_reference_no = $accPymntInvoice->payment_reference_no;
       $ap->module_id = $accPymntInvoice->module_id;
       $ap->module_invoice_no = $accPymntInvoice->module_invoice_no;

       $ap->cdf_type_id = $accPymntInvoice->cdf_type_id;
       $ap->payment_date = $accPymntInvoice->payment_date;
        
       $ap->cdf_type_id = $this->paymentCdfTypeId;
       $ap->payment_amount = $this->paymentAmount;
       
       $ap->cdc_amount = $cdcAmountBeforeInsertingThisPayment;

       $ap->user_id = $accPymntInvoice->user_id;


       $ap->account_id = $this->paymentProcessingRelatedOfAllRequestData['account_id'];
       $ap->payment_method_id = $this->paymentProcessingRelatedOfAllRequestData['payment_method_id'];
       $ap->payment_options = json_encode($this->paymentProcessingRelatedOfAllRequestData['payment_method_details']);

        if($paymentOptionId == 1)
        {
           $ap->payment_amount = $this->paymentProcessingRelatedOfAllRequestData['payment_method_details']['cash_payment_value'] ?? 0;
           $ap->account_id = $accPymntInvoice->account_id;
           $ap->payment_method_id = $accPymntInvoice->payment_method_id;
        }
        if($paymentOptionId == 2)
        {
           $ap->payment_amount = $this->paymentProcessingRelatedOfAllRequestData['payment_method_details']['advance_payment_value'] ?? 0;
           $ap->account_id = $accPymntInvoice->account_id;
           $ap->payment_method_id = $accPymntInvoice->payment_method_id;
        }
        if($paymentOptionId == 3)
        {
           $ap->payment_amount = $this->paymentProcessingRelatedOfAllRequestData['payment_method_details']['banking_payment_value'] ?? 0;
           $ap->account_id = $accPymntInvoice->account_id;
           $ap->payment_method_id = $accPymntInvoice->payment_method_id;
        }
        //$apd->payment_options = $accPymntInvoice->payment_options;//
        //$apd->transaction_no = $this->paymentProcessingRelatedOfAllRequestData;
      

        $ap->received_by = authId_hh();
        $ap->next_payment_date = $this->paymentProcessingRelatedOfAllRequestData['next_payment_date'];
        $ap->save();
        return $ap;
    }

    //insert account payment details information data
    private function ddinsertAccountPaymentInformation($accountPayment,$paymentOptionId)
    {
       $ap = new AccountPaymentDetails();
       $ap->branch_id = $accPymntInvoice->branch_id;
       $ap->account_payment_id = $accPymntInvoice->id;
       $ap->payment_invoice_no = $accPymntInvoice->payment_invoice_no;
       $ap->payment_reference_no = $accPymntInvoice->payment_reference_no;
       $ap->module_id = $accPymntInvoice->module_id;
       $ap->module_invoice_no = $accPymntInvoice->module_invoice_no;

       $ap->cdf_type_id = $accPymntInvoice->cdf_type_id;
       $ap->payment_date = $accPymntInvoice->payment_date;
        
        if($paymentOptionId == 1)
        {
           $ap->payment_amount = $this->paymentProcessingRelatedOfAllRequestData['payment_method_details']['cash_payment_value'] ?? 0;
           $ap->account_id = $accPymntInvoice->account_id;
           $ap->payment_method_id = $accPymntInvoice->payment_method_id;
        }
        if($paymentOptionId == 2)
        {
           $ap->payment_amount = $this->paymentProcessingRelatedOfAllRequestData['payment_method_details']['advance_payment_value'] ?? 0;
           $ap->account_id = $accPymntInvoice->account_id;
           $ap->payment_method_id = $accPymntInvoice->payment_method_id;
        }
        if($paymentOptionId == 3)
        {
           $ap->payment_amount = $this->paymentProcessingRelatedOfAllRequestData['payment_method_details']['banking_payment_value'] ?? 0;
           $ap->account_id = $accPymntInvoice->account_id;
           $ap->payment_method_id = $accPymntInvoice->payment_method_id;
        }
        //$apd->payment_options = $accPymntInvoice->payment_options;//
        //$apd->transaction_no = $this->paymentProcessingRelatedOfAllRequestData;
      
       $ap->save();
        return true;
    }
   
    
    //current cdc amount after culculation by cdf type id
    private function currentCdcAmountAfterCalculationByCdfType()
    {
        //required parameter 2 : $this->paymentCdfTypeId, $this->currentPaymentAmount

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
            $cdcAmount = $lastAmount + $this->currentPaymentAmount;
        }else{
           $cdcAmount = $lastAmount - $this->currentPaymentAmount;
        }
        return $cdcAmount;
    }

}
