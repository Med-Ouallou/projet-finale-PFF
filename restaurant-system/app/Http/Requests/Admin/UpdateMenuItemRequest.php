<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'category_id' => 'sometimes|integer|exists:categories,id',
            'description' => 'nullable|string|max:1000',
            'price' => 'sometimes|numeric|min:0',
            'unit' => 'nullable|string|max:50',
            'status' => 'sometimes|in:available,unavailable,disabled',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
