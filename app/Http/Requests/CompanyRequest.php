<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
        if ( $this->method() == 'PUT' ) {
            $rules = [
                'name'      => 'min: 2',
                'email'     => 'email',
                'logo'      => 'file|dimensions: min_width=100, min_height=100'
            ];
        } else {
            $rules = [
                'name'      => 'required| min: 2',
                'email'     => 'required|email',
                'logo'      => 'required|file|dimensions: min_width=100, min_height=100'
            ];
        }
        return $rules;
    }

    public function messages() 
    {
        return [
            'name.required'     => 'Name for company is required field',
            'name.min'          => 'Name for company must be more than 2 letters',
            'email.required'    => 'Email is required',
            'email.email'       => 'Email should be of proper format',
            'logo.required'     => 'Logo is required'
        ];
    }
}
