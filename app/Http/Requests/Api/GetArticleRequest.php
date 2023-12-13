<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class GetArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sortBy' => 'nullable|string|in:id,title,description,category,created_at',
            'sortValue' => 'nullable|string|in:asc,desc',
            'filter_by' => 'nullable|string|in:source,category,title,description',
            'filter_value' => 'nullable|string',
            'filter_condition' => 'nullable|string|in:=,like',
        ];
    }
}
