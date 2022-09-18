<?php

namespace App\Models\Backend\Supplier;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Supplier extends Model
{
    use SoftDeletes;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

    protected $table = 'suppliers';
    //protected $primaryKey = 'GROUP_ROLE_ID';
    protected $fillable = [
        'supplier_type_id','branch_id','supplier_group_id','custom_id','name','email','email_verified_at','password','phone','phone_2','contract_person_name','contract_person_phone','contract_person_designation','unique_id_no','company_name','address','previous_due','previous_due_date','next_payment_date','note','verified','deleted_at','verified_by','created_by'
    ];


    public function supplierTypies()
    {
        return $this->belongsTo(SupplierType::class,'supplier_type_id','id');
    }

}
