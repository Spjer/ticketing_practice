<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatMessageRequest extends FormRequest
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
            'reciever_id' => ['required', 'numeric'],
            'body' => ['required', 'string', 'max:256'],
            'username' => ['required', 'string', 'max:64'],
            'sender_id' => ['required', 'numeric'],



        ];
    }
}
