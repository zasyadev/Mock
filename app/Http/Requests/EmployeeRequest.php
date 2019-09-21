<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
                'first_name'        => 'min: 2',
                'last_name'         => 'min:2',
                'email'             => 'email',
                'company_id'        => 'required',
                'phone'             => 'digits:10'
            ];
        } else {
            $rules = [
                'first_name'        => 'required|min: 2',
                'last_name'         => 'required| min:2',
                'email'             => 'required|email',
                'company_id'        => 'required|int',
                'phone'             => 'required|digits:10'
            ];
        }
        return $rules;
    }

    public function messages() 
    {
        return [
            'first_name.required'       => 'First Name for company is required field',
            'last_name.required'        => 'Last Name for company is required field',
            'first_name.min'            => 'First Name for company must be more than 2 letters',
            'last_name.min'             => 'Last Name for company must be more than 2 letters',
            'email.required'            => 'Email is required',
            'email.email'               => 'Email should be of proper format',
            'phone.required'            => 'Phone no is required',
            'phone.digits'              => 'Phone no must be atleast 10 ',
            'company_id'                => 'Company is required'
        ];
    }
}
