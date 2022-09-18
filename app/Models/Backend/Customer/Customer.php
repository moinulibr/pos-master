<?php

namespace App\Models\Backend\Customer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Backend\Customer\CustomerShippingAddress;

class Customer extends Model
{
    use SoftDeletes;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

    protected $table = 'customers';
    //protected $primaryKey = 'GROUP_ROLE_ID';
    protected $fillable = [
        'customer_type_id','branch_id','custom_id','name','email','email_verified_at','password','gender','phone','phone_2','blood_group','religion','unique_id_no','company_name','address','previous_due','previous_due_date','next_payment_date','note','verified','deleted_at','verified_by','created_by'
    ];

    
    public function customerTypies()
    {
        return $this->belongsTo(CustomerType::class,'customer_type_id','id');
    }

    //get shipping address
    public function shippingAddresses()
    {
        return $this->hasMany(CustomerShippingAddress::class,'customer_id','id');
    }

}
