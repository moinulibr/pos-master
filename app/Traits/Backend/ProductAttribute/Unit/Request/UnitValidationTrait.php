<?php
namespace App\Traits\Backend\ProductAttribute\Unit\Request;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * 
 */
trait UnitValidationTrait
{

    /**
     * Unit validation function
     *
     * @param array $allFormData
     * @return array
     */
    public function unitValidationWhenStoreUnit(array $allFormData) : array
    {
        $validators =  Validator::make($allFormData,[
            'full_name' => 'required|max:170|unique:units,full_name',
            'short_name' => 'required|max:30|unique:units,short_name',
            'parent_id' => 'required',
            'base_unit_id' => 'required',
            'calculation_value' => 'required|numeric',
        ]);
        $data = [];
        $data['status'] = false;
        if($validators->fails()){ 
            $data['status'] = true;
            $data['errors'] = $validators;
            return $data;
        } 
        return $data;
        /* 
            $validators =  Validator::make($request->all(),[
                'full_name' => 'required|min:2|max:170|unique:units,full_name',
                'short_name' => 'required|min:2|max:30|unique:units,short_name',
                'parent_id' => 'required',
                'base_unit_id' => 'required',
                'calculation_value' => 'required|numeric',
            ]);
            if($validators->fails()){ 
                return response()->json([
                    'status' => 'errors',
                    'error'=> $validators->getMessageBag()->toArray()
                ]);
            } 
        */ 
    }


    /**
     * Undocumented function
     *
     * @param array $allFormData
     * @param [type] $id
     * @return array
     */
    public function unitValidationWhenUpdateUnit(array $allFormData,$id) : array
    {
        $validators =  Validator::make($allFormData,[
            'full_name' => 'required|max:170|unique:units,full_name,'.$id,
            'short_name' => 'required|max:30|unique:units,short_name,'.$id,
            'parent_id' => 'required',
            'base_unit_id' => 'required',
            'calculation_value' => 'required|numeric',
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
