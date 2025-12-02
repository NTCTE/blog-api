<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class FiltersRequest extends FormRequest
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
            'author_id' => [
                'sometimes', 'integer',
            ],
            'search_term' => [
                'sometimes', 'string',
            ],
            'is_draft' => [
                'sometimes', 'boolean',
            ],
            'sort_by' => [
                'sometimes', 'string', 'in:created_at,title',
            ],
            'sort_order' => [
                'sometimes', 'string', 'in:asc,desc',
            ],
            'per_page' => [
                'sometimes', 'integer', 'min:1', 'max:100',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'author_id' => __('attributes.post.author_id'),
            'search_term' => __('attributes.filters.search_term'),
            'is_draft' => __('attributes.post.is_draft'),
            'sort_by' => __('attributes.filters.sort_by'),
            'sort_order' => __('attributes.filters.sort_order'),
            'per_page' => __('attributes.filters.per_page'),
        ];
    }
}
