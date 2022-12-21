<?php
namespace App\Traits\Backend\Customer\Request;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * 
 */
trait CustomerValidationTrait
{


    /**
     * Unit validation function
     *
     * @param array $allFormData
     * @return array
     */
    public function customerValidationWhenStoreCustomer(array $allFormData) : array
    {
        $validators =  Validator::make($allFormData,[
            'customer_type_id' => 'required',
            'name' => 'required|max:150',
            'custom_id' => 'nullable|max:30',
            'email' => 'nullable|max:191|unique:customers,email',
            'phone' => $allFormData['customer_type_id'] == 1 ? 'required': 'nullable'.'|max:15|unique:customers,phone',
            'phone_2' => 'nullable|max:15|unique:customers,phone_2',
            'unique_id_no' => 'nullable|max:30|unique:customers,unique_id_no',
            'previous_due' => 'nullable|numeric', //'required|numeric|between:0,99.99',
            'previous_due_date' => 'nullable|date_format:Y-m-d', //'date_format:m/d/Y',
            'next_payment_date' => 'nullable|date_format:Y-m-d', //'date_format:m/d/Y',
            //$request->newpasswordconfirm === 'yes' ? 'required': 'nullable',
            //'required_if:is_company,1',
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
    public function customerValidationWhenUpdateCustomer(array $allFormData,$id) : array
    {
        $validators =  Validator::make($allFormData,[
            'name' => 'required|max:150',
            'custom_id' => 'nullable|max:30',
            'email' => 'nullable|max:191|unique:customers,email,'.$id,
            //'phone' => 'required|max:15|unique:customers,phone,'.$id,
            'phone' => $allFormData['customer_type_id'] == 1 ? 'required': 'nullable'.'|max:15|unique:customers,phone,'.$id,
            'phone_2' => 'nullable|max:15|unique:customers,phone_2,'.$id,
            'unique_id_no' => 'nullable|max:30|unique:customers,unique_id_no,'.$id,
            'previous_due' => 'nullable|numeric', //'required|numeric|between:0,99.99',
            'previous_due_date' => 'nullable|date_format:Y-m-d', //'date_format:m/d/Y',
            'next_payment_date' => 'nullable|date_format:Y-m-d', //'date_format:m/d/Y',
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
