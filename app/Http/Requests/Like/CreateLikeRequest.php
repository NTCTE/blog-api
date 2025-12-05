<?php

namespace App\Http\Requests\Like;

use App\Enums\Likes\MorphModelsEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateLikeRequest extends FormRequest
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
            'model' => [
                'required',
                Rule::in(array_column(MorphModelsEnum::cases(), 'name')),
            ],
            'model_id' => [
                'required',
                'int',
            ],
            'is_like' => [
                'required',
                'boolean',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'model' => __('attributes.like.model'),
            'model_id' => __('attributes.like.model_id'),
            'is_like' => __('attributes.like.is_like'),
        ];
    }
}
