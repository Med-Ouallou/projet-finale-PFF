<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePromotionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => 'required|string|unique:promotions,code|max:255',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'discount_amount' => 'nullable|numeric|min:0',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after_or_equal:valid_from',
            'usage_limit' => 'nullable|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Le code de promotion est requis.',
            'code.unique' => 'Ce code de promotion existe déjà.',
            'discount_percentage.min' => 'Le pourcentage doit être positif.',
            'discount_percentage.max' => 'Le pourcentage ne peut pas dépasser 100%.',
            'discount_amount.min' => 'Le montant doit être positif.',
            'valid_until.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
            'usage_limit.min' => 'La limite d\'utilisation doit être d\'au moins 1.',
        ];
    }
}
