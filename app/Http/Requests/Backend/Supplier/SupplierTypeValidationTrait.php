<?php
namespace App\Http\Requests\Backend\Supplier;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * 
 */
trait SupplierTypeValidationTrait
{


    /**
     * Unit validation function
     *
     * @param array $allFormData
     * @return array
     */
    public function supplierValidationWhenStoreSupplier(array $allFormData) : array
    {
        $validators =  Validator::make($allFormData,[
            //'name' => 'required|max:200|unique:suppliers,name',
            'name' => 'required|max:150',
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
    public function supplierValidationWhenUpdateSupplier(array $allFormData,$id) : array
    {
        $validators =  Validator::make($allFormData,[
            //'name' => 'required|max:170|unique:suppliers,name,'.$id,
            'name' => 'required|max:150',
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
