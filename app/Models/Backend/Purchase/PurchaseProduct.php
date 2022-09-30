<?php

namespace App\Models\Backend\Purchase;

use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Purchase\PurchaseProductStock;

class PurchaseProduct extends Model
{
    
    public function purchaseProductStocks()
    {
        return $this->hasMany(PurchaseProductStock::class,'purchase_product_id','id');
    }

    
}
