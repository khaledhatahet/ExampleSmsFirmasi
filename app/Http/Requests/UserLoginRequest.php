<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email' ,
            'password' => 'required|string' ,
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('general.requiredField' , ['field' => 'email']),
            'email.email' => __('general.emailField' , ['field' => 'email']),
            'email.exists' => __('general.checkTheEmail'),

            'password.required' => __('general.requiredField' , ['field' => 'password']),
            'password.string' => __('general.stringField' , ['field' => 'password']),
        ];
    }
}
