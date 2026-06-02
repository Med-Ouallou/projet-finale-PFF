<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'reference' => 'required|string|max:100|unique:inventory_items,reference',
            'quantity_in_stock' => 'required|integer|min:0',
            'min_threshold' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'unit_price' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est requis.',
            'reference.required' => 'La référence est requise.',
            'reference.unique' => 'Cette référence existe déjà.',
            'quantity_in_stock.required' => 'La quantité en stock est requise.',
            'min_threshold.required' => 'Le seuil minimum est requis.',
        ];
    }
}
