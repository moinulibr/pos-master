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

    protected $mainPaymentModuleId;
    protected $paymentModuleId;
    protected $paymentCdfTypeId;
    protected $paymentProcessingRelatedOfAllRequestData;
    protected $paymentProcessingRequiredOfAllRequestOfModuleRelatedData;
    protected $invoiceTotalPayingAmount;

    private $currentPaymentAmount;
    private $lastPaymentAmount;
    
    /*
    * Processing Payment
    */
    public function processingPayment()
    {   
        $this->insertAccountPaymentInvoice();
        return true;
    }

    //insert account payment invoice
    protected function insertAccountPaymentInvoice()
    {
        $ap = new AccountPaymentInvoice();
        $rand = rand(01,99);
        $makeInvoice = date("iHsymd").$rand;
        $ap->branch_id = authBranch_hh();
        $ap->payment_invoice_no = $makeInvoice;;
        $ap->payment_reference_no = "";
        $ap->main_module_id = $this->mainPaymentModuleId;
        $ap->module_id = $this->paymentModuleId;
        $ap->main_module_invoice_no = $this->paymentProcessingRequiredOfAllRequestOfModuleRelatedData['main_module_invoice_no'];
        $ap->main_module_invoice_id = $this->paymentProcessingRequiredOfAllRequestOfModuleRelatedData['main_module_invoice_id'];
        $ap->module_invoice_no = $this->paymentProcessingRequiredOfAllRequestOfModuleRelatedData['module_invoice_no'];
        $ap->module_invoice_id = $this->paymentProcessingRequiredOfAllRequestOfModuleRelatedData['module_invoice_id'];

        $ap->cdf_type_id = $this->paymentCdfTypeId;
        $ap->payment_amount = $this->invoiceTotalPayingAmount;
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

    //insert account payment information
    protected function insertAccountPaymentInformation($accPymntInvoice,$paymentOptionId)
    {
        $ap = new AccountPayment();
        $ap->branch_id = $accPymntInvoice->branch_id;
        $ap->account_payment_invoice_id = $accPymntInvoice->id;
        $ap->payment_invoice_no = $accPymntInvoice->payment_invoice_no;
        $ap->payment_reference_no = $accPymntInvoice->payment_reference_no;
        $ap->main_module_id = $accPymntInvoice->main_module_id;
        $ap->main_module_invoice_no = $accPymntInvoice->main_module_invoice_no;
        $ap->main_module_invoice_id = $accPymntInvoice->main_module_invoice_id;
        $ap->module_id = $accPymntInvoice->module_id;
        $ap->module_invoice_no = $accPymntInvoice->module_invoice_no;
        $ap->module_invoice_id = $accPymntInvoice->module_invoice_id;

        $ap->cdf_type_id = $accPymntInvoice->cdf_type_id;
        $ap->payment_date = $accPymntInvoice->payment_date;
        $ap->cdf_type_id = $this->paymentCdfTypeId;
        $ap->user_id = $accPymntInvoice->user_id;
       
        
        $accId = 1;
        $subPayingAmount = 1;
        $accArray = accountIdExtensionByPaymentMethodOrOptionId_hh($paymentOptionId, $this->paymentProcessingRelatedOfAllRequestData['payment_method_id']);
        if(is_array($accArray))
        if(array_key_exists('acc_id',$accArray))
        {
            $accId = $accArray['acc_id'];
            $subPayingAmount = $accArray['subtotal_paying_amount'];
        }
        $ap->account_id = $this->paymentProcessingRelatedOfAllRequestData["account_id_".$accId];
        $ap->payment_method_id = $this->paymentProcessingRelatedOfAllRequestData['payment_method_id'];
      
        $payingAmountNow = $this->paymentProcessingRelatedOfAllRequestData[$subPayingAmount] ?? 0;;
        
        $ap->payment_amount = $payingAmountNow;

        //required parameter 2 : $this->paymentCdfTypeId, $this->currentPaymentAmount
        $this->currentPaymentAmount = $payingAmountNow;
        $cdcAmountBeforeInsertingThisPayment = $this->currentCdcAmountAfterCalculationByCdfType();

        $ap->cdc_amount = $cdcAmountBeforeInsertingThisPayment;

        $options = currentPaymentOptionMethod_hh($paymentOptionId, $this->paymentProcessingRelatedOfAllRequestData['payment_method_id'],$this->paymentProcessingRelatedOfAllRequestData);
        //$ap->payment_options = json_encode($this->paymentProcessingRelatedOfAllRequestData['payment_method_details']);
        $ap->payment_options = json_encode($options['currentPaymentAccounts']);
        $ap->transaction_no = $options['transactionId'];
        

        $ap->received_by = authId_hh();
        $ap->save();
        return $ap;
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
