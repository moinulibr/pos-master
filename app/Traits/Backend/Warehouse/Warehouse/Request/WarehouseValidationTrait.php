<?php
namespace App\Http\Requests\Backend\Warehouse;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * 
 */
trait WarehouseValidationTrait
{


    /**
     * Unit validation function
     *
     * @param array $allFormData
     * @return array
     */
    public function warehouseValidationWhenStoreWarehouse(array $allFormData) : array
    {
        $validators =  Validator::make($allFormData,[
            'name' => 'required|max:200|unique:warehouses,name',
        ]);
        $data = [];
        $data['status'] = false;
        if($validators->fails()){ 
            $data['status'] = true;
            $data['errors'] = $validators;
            return $data;
        } 
        return $data;
    }

/**
     * Undocumented function
     *
     * @param array $allFormData
     * @param [type] $id
     * @return array
     */
    public function warehouseValidationWhenUpdateWarehouse(array $allFormData,$id) : array
    {
        $validators =  Validator::make($allFormData,[
            'name' => 'required|max:100|unique:warehouses,name,'.$id,
        ]);
        $data = [];
        $data['status'] = false;
        if($validators->fails()){ 
            $data['status'] = true;
            $data['errors'] = $validators;
            return $data;
        } 
        return $data;
    }


}
