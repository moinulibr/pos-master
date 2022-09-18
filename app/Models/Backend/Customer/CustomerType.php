<?php

namespace App\Models\Backend\Customer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CustomerType extends Model
{
    use SoftDeletes;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

    protected $table = 'customer_typies';
    //protected $primaryKey = 'GROUP_ROLE_ID';
    protected $fillable = [
        'name','branch_id','description','company_name','address','note','verified','deleted_at','verified_by','created_by'
    ];
}
