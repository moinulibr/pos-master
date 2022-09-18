<?php
namespace App\Http\Requests\Backend\Reference;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * 
 */
trait ReferenceValidationTrait
{


    /**
     * Unit validation function
     *
     * @param array $allFormData
     * @return array
     */
    public function referenceValidationWhenStoreReference(array $allFormData) : array
    {
        $validators =  Validator::make($allFormData,[
            //'customer_type_id' => 'required',
            'name' => 'required|max:150',
            'custom_id' => 'nullable|max:30',
            'email' => 'nullable|max:191|unique:references,email',
            'phone' => 'required|max:15|unique:references,phone',
            'phone_2' => 'nullable|max:15|unique:references,phone_2',
            'profession' => 'required|max:50',
            'unique_id_no' => 'nullable|max:30|unique:references,unique_id_no',
            'previous_due' => 'nullable|numeric', //'required|numeric|between:0,99.99',
            'previous_due_date' => 'nullable|date_format:Y-m-d', //'date_format:m/d/Y',
            'next_payment_date' => 'nullable|date_format:Y-m-d', //'date_format:m/d/Y',
            //$request->newpasswordconfirm === 'yes' ? 'required': 'nullable',
            //'required_if:is_company,1',
            // /'phone' => $allFormData['customer_type_id'] == 1 ? 'required': 'nullable'.'|max:15|unique:customers,phone',
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
    public function referenceValidationWhenUpdateReference(array $allFormData,$id) : array
    {
        $validators =  Validator::make($allFormData,[
            'name' => 'required|max:150',
            'custom_id' => 'nullable|max:30',
            'email' => 'nullable|max:191|unique:references,email,'.$id,
            //'phone' => 'required|max:15|unique:references,phone,'.$id,
            'phone' => 'required|max:15|unique:references,phone,'.$id,
            'profession' => 'required|max:50',
            'phone_2' => 'nullable|max:15|unique:references,phone_2,'.$id,
            'unique_id_no' => 'nullable|max:30|unique:references,unique_id_no,'.$id,
            'previous_due' => 'nullable|numeric', //'required|numeric|between:0,99.99',
            'previous_due_date' => 'nullable|date_format:Y-m-d', //'date_format:m/d/Y',
            'next_payment_date' => 'nullable|date_format:Y-m-d', //'date_format:m/d/Y',
            //'phone' => $allFormData['customer_type_id'] == 1 ? 'required': 'nullable'.'|max:15|unique:customers,phone,'.$id,
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
