<?php
namespace App\Http\Requests\Backend\Warehouse;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * 
 */
trait RackValidationTrait
{


    
    
    /**
     * Unit validation function
     *
     * @param array $allFormData
     * @return array
     */
    public function WarehouseRackValidationWhenStoreWarehouseRack(array $allFormData) : array
    {
        $validators =  Validator::make($allFormData,[
            'name' => 'required|max:100|unique:warehouse_racks,name',
            'warehouse_id' => 'required',
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
    public function WarehouseRackValidationWhenUpdateWarehouseRack(array $allFormData,$id) : array
    {
        $validators =  Validator::make($allFormData,[
            'name' => 'required|max:100|unique:warehouse_racks,name,'.$id,
            'warehouse_id' => 'required',
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
