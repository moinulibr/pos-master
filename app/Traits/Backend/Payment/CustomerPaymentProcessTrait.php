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

    private $currentPaymentAmount;
    private $lastPaymentAmount;
    
    /*
    * Processing Payment
    */
    public function processingOfAllCustomerTransaction()
    {   

        $this->insertAccountPaymentInvoice();
        return true;
    }

    //insert account payment invoice
    protected function insertAccountPaymentInvoice()
    {
        $ap = new CustomerTransactionHistory();
        $rand = rand(01,99);
        $makeInvoice = date("iHsymd").$rand;
        $ap->branch_id = authBranch_hh();
      
        $ap->ledger_page_no = $this->processingOfAllCustomerTransactionRequestData['ledger_page_no'];
        $ap->next_payment_date = $this->processingOfAllCustomerTransactionRequestData['next_payment_date'];
        $ap->created_date = date('Y-m-d');
        $ap->tt_module_id = $this->ctsTTModuleId;
        $ap->tt_module_invoice_no = $this->ttModuleInvoicsDataArrayFormated['invoice_no'];
        $ap->tt_module_invoice_id = $this->ttModuleInvoicsDataArrayFormated['invoice_id'];
        $ap->cdf_type_id = $this->ctsCdsTypeId;
        $ap->amount = $this->amount;
        $ap->sell_amount = $this->processingOfAllCustomerTransactionRequestData['sell_amount'];
        $ap->sell_paid = $this->processingOfAllCustomerTransactionRequestData['sell_paid'];
        $ap->sell_due = $this->processingOfAllCustomerTransactionRequestData['sell_due'];
        $ap->user_id = $this->ctsCustomerId;
        $ap->received_by = authId_hh();
        $ap->short_note = $this->processingOfAllCustomerTransactionRequestData['short_note'];
        $ap->save();

        //$this->ctsCustomerId
        $ap->cdc_amount = $this->currentCdcAmountAfterCalculationByCtsCdfType();
        $ap->save();
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
        $ap->cdf_type_id = $this->ctsCdsTypeId;
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

        //required parameter 2 : $this->ctsCdsTypeId, $this->currentPaymentAmount
        $this->currentPaymentAmount = $payingAmountNow;
        $cdcAmountBeforeInsertingThisPayment = $this->currentCdcAmountAfterCalculationByCtsCdfType();

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
    private function currentCdcAmountAfterCalculationByCtsCdfType()
    {
        //required parameter 2 : $this->ctsCdsTypeId, $this->currentPaymentAmount

        $lastPaymentAmount = CustomerTransactionHistory::select('cdc_amount','cdf_type_id','user_id')->where('user_id',$this->ctsCustomerId)->latest()->first();
        if($lastPaymentAmount)
        {
            $lastAmount = $lastPaymentAmount->cdc_amount;
        }else{
            $lastAmount = 0;
        }
        $cdcAmount = 0;
        if($this->ctsCdsTypeId == 1) // credit = paid
        {
            $cdcAmount = $lastAmount + $this->currentPaymentAmount;
        }
        else if($this->ctsCdsTypeId == 2)
        {
            $cdcAmount = $lastAmount - $this->currentPaymentAmount;
        }
        else{
           $cdcAmount = $lastAmount;
        }
        return $cdcAmount;
    }

}
