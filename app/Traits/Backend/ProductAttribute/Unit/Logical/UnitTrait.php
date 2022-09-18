<?php
namespace App\Traits\Backend\ProductAttribute\Unit\Logical;

use App\Models\Backend\ProductAttribute\Unit;

/**
 * 
 */
trait UnitTrait
{
    /**
     * Its containt only unit id
     * from units table
     * @var integer
     */
    public int $unitId;

    /**
     * get unit by unit id function
     *
     */
    public function getUnitByUnitId()
    {
        $data['status'] = false;
        if($this->unitId > 0)
        {
            $data['unit'] = Unit::find($this->unitId);
            if($data['unit'])
            {
                $data['status'] = true;
            }
        }
        return $data;
    }



}
