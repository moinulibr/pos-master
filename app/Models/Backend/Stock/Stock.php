<?php

namespace App\Models\Backend\Stock;

use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Stock\ProductStock;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use SoftDeletes;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

    protected $table = 'stocks';
    //protected $primaryKey = 'GROUP_ROLE_ID';
    /* protected $fillable = [
        'customer_type_id','branch_id','custom_id','name','email','email_verified_at','password','gender','phone','phone_2','blood_group','religion','unique_id_no','company_name','address','previous_due','previous_due_date','next_payment_date','note','verified','deleted_at','verified_by','created_by'
    ]; */

    public function productStocks()
    {
        return $this->hasMany(ProductStock::class,'stock_id','id');
    }



}
