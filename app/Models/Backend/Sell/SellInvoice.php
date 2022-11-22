<?php

namespace App\Models\Backend\Sell;

use App\Models\Backend\Customer\Customer;
use App\Models\Backend\Customer\CustomerShippingAddress;
use App\Models\Backend\Payment\AccountPayment;
use App\Models\Backend\Reference\Reference;
use App\User;
use Illuminate\Database\Eloquent\Model;

class SellInvoice extends Model
{

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    public function referenceBy()
    {
        return $this->belongsTo(Reference::class,'reference_id','id');
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function shipping()
    {
        return $this->hasOne(CustomerShippingAddress::class,'id','shipping_id');
    }

    public function sellProducts()
    {
        return $this->hasMany(SellProduct::class,'sell_invoice_id','id');
    }

    public function invoicePayment()
    {
        return $this->hasMany(AccountPayment::class,'main_module_invoice_id','id')->where('main_module_id',getModuleIdBySingleModuleLebel_hh("Sell"));
    } 
    public function moduleWiseInvoicePayment()
    {
        return $this->hasMany(AccountPayment::class,'module_invoice_id','id')->where('module_id',getModuleIdBySingleModuleLebel_hh("Sell"));
    }
}
