<?php
namespace App\Http\Requests\Backend\Supplier;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * 
 */
trait SupplierValidationTrait
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
            'supplier_type_id' => 'required',
            'name' => 'required|max:150',
            'custom_id' => 'nullable|max:30',
            'email' => 'nullable|max:191|unique:suppliers,email',
            'phone' => 'required|max:15|unique:suppliers,phone',
            //'phone_2' => 'nullable|max:15|unique:suppliers,phone_2',
            //'unique_id_no' => 'nullable|max:30|unique:suppliers,unique_id_no',
            //'previous_due' => 'nullable|numeric', //'required|numeric|between:0,99.99',
            //'previous_due_date' => 'nullable|date_format:Y-m-d', //'date_format:m/d/Y',
            //'next_payment_date' => 'nullable|date_format:Y-m-d', //'date_format:m/d/Y',
            //$request->newpasswordconfirm === 'yes' ? 'required': 'nullable',
            //'required_if:is_company,1',
            //$allFormData['supplier_type_id'] == 1 ? 'required': 'nullable'.'|max:15|unique:suppliers,phone',
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
            'name' => 'required|max:150',
            'custom_id' => 'nullable|max:30',
            'email' => 'nullable|max:191|unique:suppliers,email,'.$id,
            //'phone' => 'required|max:15|unique:suppliers,phone,'.$id,
            'phone' => 'required|max:15|unique:suppliers,phone,'.$id,
            //'phone_2' => 'nullable|max:15|unique:suppliers,phone_2,'.$id,
            //'unique_id_no' => 'nullable|max:30|unique:suppliers,unique_id_no,'.$id,
            //'previous_due' => 'nullable|numeric', //'required|numeric|between:0,99.99',
            //'previous_due_date' => 'nullable|date_format:Y-m-d', //'date_format:m/d/Y',
            //'next_payment_date' => 'nullable|date_format:Y-m-d', //'date_format:m/d/Y',
            //'phone' => $allFormData['customer_type_id'] == 1 ? 'required': 'nullable'.'|max:15|unique:suppliers,phone,'.$id,
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
