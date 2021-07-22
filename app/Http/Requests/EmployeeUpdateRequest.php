<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
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
            'firstname'=> 'required|string',
            'lastname'=>'required|string',
            // pass an {id} to edit unique field 
            'email'=>'email|unique:employees,email,'.$this->employee->id,    
            'phone'=> 'sometimes|string|unique:employees,phone,'.$this->employee->id,
            'company'=>'nullable|integer'
        ];
    }
}