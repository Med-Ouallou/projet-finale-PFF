<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'menu_id' => 'sometimes|integer|exists:menus,id',
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string|max:1000',
            'parent_id' => 'nullable|integer|exists:categories,id',
            'display_order' => 'nullable|integer|min:0',
            'icon_url' => 'nullable|string|max:500',
            'is_active' => 'sometimes|boolean',
        ];
    }
}
