<?php
namespace App\Http\Requests\Backend\ProductAttribute;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * 
 */
trait ProductGradeValidationTrait
{


    
    /**
     * Unit validation function
     *
     * @param array $allFormData
     * @return array
     */
    public function productGradeValidationWhenStoreProductGrade(array $allFormData) : array
    {
        $validators =  Validator::make($allFormData,[
            'name' => 'required|max:200|unique:product_grades,name',
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
    public function productGradeValidationWhenUpdateProductGrade(array $allFormData,$id) : array
    {
        $validators =  Validator::make($allFormData,[
            'name' => 'required|max:170|unique:product_grades,name,'.$id,
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
