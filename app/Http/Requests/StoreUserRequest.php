<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:users,name',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
            'rePassword' => 'required|string|same:password',
        ];
    }

    public function messages(): array
    {
        return [
            'userName.required' =>  __('general.requiredField',['field' => 'userName']),
            'userName.string' =>  __('general.stringField',['field' => 'userName']),
            'userName.unique' => __('general.uniqueField', ['field' => 'userName']),

            'email.required' =>  __('general.requiredField',['field' => 'email']),
            'email.string' =>  __('general.stringField',['field' => 'email']),
            'email.email' => __('general.emailField', ['field' => 'email']),
            'email.unique' => __('general.uniqueField', ['field' => 'email']),

            'password.required' =>  __('general.requiredField',['field' => 'password']),
            'password.string' =>  __('general.stringField',['field' => 'password']),

            'rePassword.required' =>  __('general.requiredField',['field' => 'repassword']),
            'rePassword.string' =>  __('general.stringField',['field' => 'repassword']),
            'rePassword.same' =>  __('general.passwordsMustBeSame'),
        ];
    }
}
