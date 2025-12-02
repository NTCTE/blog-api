<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
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
            'content' => ['required', 'string', 'max:5000'],
            'post_id' => ['required', 'int'],
            'parent_id' => ['nullable', 'integer'],
        ];
    }

    public function attributes(): array
    {
        return [
            'content' => __('attributes.comment.content'),
            'post_id' => __('attributes.comment.page_id'),
            'parent_id' => __('attributes.comment.parent_id'),
        ];
    }
}
