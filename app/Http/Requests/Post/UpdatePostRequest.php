<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'heading' => [
                'sometimes', 'string', 'min:10', 'max:255',
            ],
            'body' => [
                'sometimes', 'string', 'min:50',
            ],
            'is_draft' => [
                'sometimes', 'boolean',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'heading' => __('attributes.post.heading'),
            'body' => __('attributes.post.body'),
            'is_draft' => __('attributes.post.is_draft'),
        ];
    }
}
