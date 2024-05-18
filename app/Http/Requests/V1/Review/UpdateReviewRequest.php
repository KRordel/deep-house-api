<?php

namespace App\Http\Requests\V1\Review;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
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
            'title' => ['sometimes', 'string', 'max:190'],
            'content' => ['sometimes', 'string'],
            'name' => ['sometimes', 'string', 'max:190'],
            'is_active' => ['sometimes', 'boolean']
        ];
    }
}
