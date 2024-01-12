<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoremessageRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'number' => 'required|numeric',
            'message' => 'required|string',
            'sender_id' => 'required|exists:users,id',
        ];
    }

    public function messages()
    {
        return [

            'number.required' =>  __('general.requiredField',['field' => 'number']),
            'number.numeric' =>  __('general.numericField',['field' => 'number']),

            'message.required' =>  __('general.requiredField',['field' => 'message']),
            'message.string' =>  __('general.stringField',['field' => 'message']),

            'sender_id.required' =>  __('general.requiredField',['field' => 'sender id']),
            'sender_id.exists' =>  __('general.mustBeExistsInTable',['field' => 'sender id' , 'table' => 'users']),
        ];
    }
}
