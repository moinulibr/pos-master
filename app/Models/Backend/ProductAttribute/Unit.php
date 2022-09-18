<?php

namespace App\Models\Backend\ProductAttribute;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Unit extends Model
{
    use SoftDeletes;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

    protected $table = 'units';
    //protected $primaryKey = 'GROUP_ROLE_ID';
    protected $fillable = [
        'full_name','branch_id','short_name','parent_id','parent_cal_result','calculation_value','calculation_result','base_unit_id','description','note','verified','deleted_at','verified_by','created_by'
    ];
    

    public function parentUnit()
    {
        $parent['status'] = false;
        if($this->parent_id > 0)
        {
            $unit = Unit::find($this->parent_id);
            if($unit)
            {
                $parent['status'] = true;
                $parent['unit'] = $unit;
            }
        }
        return $parent;   
    } 
    public function baseUnit()
    {
        $base['status'] = false;
        if($this->base_unit_id > 0)
        {
            $unit = Unit::find($this->base_unit_id);
            if($unit)
            {
                $base['status'] = true;
                $base['unit'] = $unit;
            }
        }
        return $base;   
    }
    
}
