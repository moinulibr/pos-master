<?php

namespace App\Models\Backend\ProductAttribute;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Brand extends Model
{
    use SoftDeletes;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

    protected $table = 'brands';
    //protected $primaryKey = 'GROUP_ROLE_ID';
    protected $fillable = [
        'name','branch_id','description','note','verified','deleted_at','verified_by','created_by'
    ];
}
