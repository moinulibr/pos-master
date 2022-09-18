<?php

namespace App\Models\Backend\Warehouse;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class WarehouseRack extends Model
{
    use SoftDeletes;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $table = 'warehouse_racks';

    protected $fillable = [
       'warehouse_id', 'branch_id','name','description','verified','verified_by','status','deleted_at','created_by'
    ];


    public function warehouses()
    {
        return $this->belongsTo(Warehouse::class,'warehouse_id','id');
    }

}
