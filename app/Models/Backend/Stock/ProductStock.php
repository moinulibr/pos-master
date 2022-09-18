<?php

namespace App\Models\Backend\Stock;

use App\Models\Backend\Price\Price;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Price\ProductPrice;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductStock extends Model
{
    use SoftDeletes;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

    protected $table = 'product_stocks';
    //protected $primaryKey = 'GROUP_ROLE_ID';
    /* protected $fillable = [
        'customer_type_id','branch_id','custom_id','name','email','email_verified_at','password','gender','phone','phone_2','blood_group','religion','unique_id_no','company_name','address','previous_due','previous_due_date','next_payment_date','note','verified','deleted_at','verified_by','created_by'
    ]; */

    
    public function stocks()
    {
        return $this->belongsTo(Stock::class,'stock_id','id');
    }


    public function productPrices()
    {
        return $this->hasMany(ProductPrice::class,'product_stock_id','id');
    }


    /**
     * product stock wise product price
     * its use in: 
     */
    public function productStockWiseProductPrices()
    {
        $activePriceAndProductPrice = ProductPrice::select("product_prices.id","product_prices.price_id",
        "product_prices.stock_id","product_prices.product_id","product_prices.price","product_prices.product_stock_id",
        "prices.id as pId","prices.name as pName",'prices.label',"prices.status as pStatus"
        )
        ->join("prices","prices.id","=","product_prices.price_id")
        ->where('product_prices.product_stock_id',$this->id)
        ->where('product_prices.branch_id',authBranch_hh())
        ->where('product_prices.status',1)
        ->where('prices.status',1)
        ->orderBy('prices.custom_serial','ASC')
        ->where('prices.branch_id',authBranch_hh())
        ->get();
        return $activePriceAndProductPrice;
    }




}
