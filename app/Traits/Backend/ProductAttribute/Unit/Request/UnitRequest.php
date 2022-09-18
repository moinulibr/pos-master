<?php

namespace App\Http\Requests\Backend\ProductAttribute;

use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'full_name' => 'required|min:2|max:170',
            'short_name' => 'required|min:2|max:30',
            'parent_id' => 'required',
            'base_unit_id' => 'required',
            'calculation_value' => 'required|numeric',
        ];
    }
}
