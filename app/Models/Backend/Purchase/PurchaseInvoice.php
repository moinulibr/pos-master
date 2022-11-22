<?php

namespace App\Models\Backend\Purchase;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Supplier\Supplier;
use App\Models\Backend\Payment\AccountPayment;
use App\Models\Backend\Purchase\PurchaseProduct;
use App\Models\Backend\Purchase\PurchaseProductStock;
use App\Models\Backend\Supplier\SupplierType;

class PurchaseInvoice extends Model
{
    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }
     public function supplierType()
    {
        return $this->belongsTo(SupplierType::class,'supplier_type_id','id');
    }
    
    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    
    public function purchaseProducts()
    {
        return $this->hasMany(PurchaseProduct::class,'purchase_invoice_id','id');
    }

    public function purchaseProductStocks()
    {
        return $this->hasMany(PurchaseProductStock::class,'purchase_invoice_id','id');
    }

    
    public function invoicePayment()
    {
        return $this->hasMany(AccountPayment::class,'main_module_invoice_id','id')->where('main_module_id',getModuleIdBySingleModuleLebel_hh("Purchase"));
    }
    public function moduleWiseInvoicePayment()
    {
        return $this->hasMany(AccountPayment::class,'module_invoice_id','id')->where('module_id',getModuleIdBySingleModuleLebel_hh("Purchase"));
    }


}
