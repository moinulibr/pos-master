<?php

namespace App\Models\Backend\Price;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    use SoftDeletes;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

    protected $table = 'prices';
    //protected $primaryKey = 'GROUP_ROLE_ID';
    /* protected $fillable = [
        'customer_type_id','branch_id','custom_id','name','email','email_verified_at','password','gender','phone','phone_2','blood_group','religion','unique_id_no','company_name','address','previous_due','previous_due_date','next_payment_date','note','verified','deleted_at','verified_by','created_by'
    ]; */

    
}
