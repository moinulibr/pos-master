<?php

namespace App\Models\Backend\Purchase;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Supplier\Supplier;
use App\Models\Backend\Purchase\PurchaseProduct;
use App\Models\Backend\Purchase\PurchaseProductStock;

class PurchaseInvoice extends Model
{
    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id','id');
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


}
