<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInventoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $itemId = $this->route('inventoryItem');

        return [
            'name' => 'sometimes|string|max:255',
            'reference' => ['sometimes', 'string', 'max:100', Rule::unique('inventory_items')->ignore($itemId)],
            'quantity_in_stock' => 'sometimes|integer|min:0',
            'min_threshold' => 'sometimes|integer|min:0',
            'unit' => 'sometimes|string|max:50',
            'unit_price' => 'sometimes|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'reference.unique' => 'Cette référence existe déjà.',
        ];
    }
}
