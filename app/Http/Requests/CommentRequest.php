<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'content' => 'required|string|min:3|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'The comment field is required.',
            'content.string' => 'The comment field must be a string.',
            'content.min' => 'The comment field must be more than 3 characters.',
            'content.max' => 'The comment field must not exceed 1000 characters.',
        ];
    }
}
