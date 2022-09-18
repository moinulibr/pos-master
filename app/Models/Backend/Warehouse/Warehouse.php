<?php

namespace App\Models\Backend\Warehouse;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Warehouse extends Model
{
    use SoftDeletes;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

    protected $table = 'warehouses';
    //protected $primaryKey = 'GROUP_ROLE_ID';
    protected $fillable = [
        'name','branch_id','description','verified','verified_by','status','deleted_at','created_by'
    ];

}
