<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
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
            'name'=> 'required|string',
            // add an {id} to edit unique field
            'email'=>'required|email|unique:companies,email,'.$this->company->id,
            'logo'=> 'nullable|image|mimes:png,jpg,jpeg|dimensions:min_width=100,min_height=100|max:2048',
            'website'=>'nullable|string'
        ];
    }
}