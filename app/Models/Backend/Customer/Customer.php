<?php

namespace App\Models\Backend\Customer;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Backend\Customer\CustomerShippingAddress;
use App\Models\Backend\Customer\CustomerTransactionHistory;

class Customer extends Model
{
    use SoftDeletes;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

    protected $table = 'customers';
    //protected $primaryKey = 'GROUP_ROLE_ID';
    protected $fillable = [
        'customer_type_id','branch_id','custom_id','name','email','email_verified_at','password','gender','phone','phone_2','blood_group','religion','unique_id_no','company_name','address','previous_due_date','next_payment_date','note','verified','deleted_at','verified_by','created_by',
        'previous_total_sell_amount','previous_total_sell_reference_amount','previous_total_sell_profit_amount','previous_due','previous_advance','previous_loan','previous_return','previous_due_paid','previous_advance_paid','previous_loan_paid','previous_return_paid','previous_due_paid_now','previous_advance_paid_now','previous_loan_paid_now','previous_return_paid_now','previous_total_due','previous_total_advance','previous_total_loan','previous_total_return','current_due','current_advance','current_loan','current_return','current_paid_due','current_paid_advance','current_paid_loan',
        'current_paid_return','current_total_due','current_total_advance','current_total_loan','current_total_return','total_due','total_advance','total_loan','total_return','current_total_sell_amount','current_total_sell_reference_amount','current_total_sell_profit_amount','total_sell_amount','total_sell_reference_amount','total_sell_profit_amount',
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

    public function createdBY()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }


    public function customerTransactionStatement()
    {
        return $this->hasMany(CustomerTransactionHistory::class,'user_id','id');
    }
}
