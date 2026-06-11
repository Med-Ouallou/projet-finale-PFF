<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isCustomer();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric',
            'notes' => 'nullable|string|max:500',
            'promotion_code' => 'nullable|string|exists:promotions,code',
            'payment_method' => 'required|string|in:cash,stripe',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'items.required' => 'Le panier ne peut pas être vide.',
            'items.array' => 'Format de commande invalide.',
            'items.min' => 'Vous devez ajouter au moins un article.',
            'items.*.id.exists' => 'Un article sélectionné n\'existe plus.',
            'items.*.quantity.min' => 'La quantité minimale est de 1.',
        ];
    }
}
