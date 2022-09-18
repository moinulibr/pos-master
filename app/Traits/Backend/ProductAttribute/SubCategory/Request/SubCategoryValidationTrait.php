<?php
namespace App\Http\Requests\Backend\ProductAttribute;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * 
 */
trait SubCategoryValidationTrait
{


    
    
    /**
     * Unit validation function
     *
     * @param array $allFormData
     * @return array
     */
    public function subCategoryValidationWhenStoreSubCategory(array $allFormData) : array
    {
        $validators =  Validator::make($allFormData,[
            'name' => 'required|max:200|unique:sub_categories,name',
            'category_id' => 'required',
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
    public function subCategoryValidationWhenUpdateSubCategory(array $allFormData,$id) : array
    {
        $validators =  Validator::make($allFormData,[
            'name' => 'required|max:170|unique:sub_categories,name,'.$id,
            'category_id' => 'required',
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
