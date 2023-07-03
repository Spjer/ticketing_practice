<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRegisterRequest extends FormRequest
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
            //
            'name' => ['required', 'max:30'],
            'email' => ['required', 'email', 'max:40', 'unique:clients,email'],
            'phone_number' =>  ['required', 'min:11', 'max:12', 'regex:/^([0-9]){3}-([0-9]){3}-([0-9])/'],
            'password' => ['required','min:6'],
        ];
    }
}
