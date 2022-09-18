<?php
namespace App\Http\Requests\Backend\ProductAttribute;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * 
 */
trait ColorValidationTrait
{


    
    /**
     * Unit validation function
     *
     * @param array $allFormData
     * @return array
     */
    public function colorValidationWhenStoreColor(array $allFormData) : array
    {
        $validators =  Validator::make($allFormData,[
            'name' => 'required|max:200|unique:colors,name',
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
    public function colorValidationWhenUpdateColor(array $allFormData,$id) : array
    {
        $validators =  Validator::make($allFormData,[
            'name' => 'required|max:170|unique:colors,name,'.$id,
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
