<?php

namespace App\Models\Backend\Payment;

use Illuminate\Database\Eloquent\Model;

class AccountPayment extends Model
{
    public function paymentMethods()
    {
        return $this->belongsTo(PaymentMethod::class,'payment_method_id','id');
    }

    public function paymentAccount()
    {
        return $this->belongsTo(Account::class,'account_id','id');
    }

    public function accountPaymentInvoice()
    {
        return $this->belongsTo(AccountPaymentInvoice::class,'account_payment_invoice_id','id');
    }
}
