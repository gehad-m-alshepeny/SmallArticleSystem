<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:255',
            'content' => 'required|string|min:3|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The name field is required.',
            'title.string' => 'The name field must be a string.',
            'title.min' => 'The title field must be more than 3 characters.',
            'title.max' => 'The name field must not exceed 255 characters.',
            'content.required' => 'The content field is required.',
            'content.string' => 'The content field must be a string.',
            'content.min' => 'The content field must be more than 3 characters.',
            'content.max' => 'The content field must not exceed 1000 characters.',
        ];
    }
}