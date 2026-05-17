<x-layouts.admin :title="'Modifier Article - Resto Admin'" :breadcrumb="'Modifier l\'article'">

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-lg font-bold font-heading text-gray-900">Modifier l'article</h2>
                <p class="text-sm text-gray-400">Mettez à jour les informations de l'article.</p>
            </div>

            <form method="POST" action="{{ route('admin.inventory.update', $item) }}" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Nom <span class="text-red-400">*</span></label>
                        <input type="text" name="name" required value="{{ old('name', $item->name) }}"
                            class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Référence <span class="text-red-400">*</span></label>
                        <input type="text" name="reference" required value="{{ old('reference', $item->reference) }}"
                            class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Quantité en stock <span class="text-red-400">*</span></label>
                        <input type="number" name="quantity_in_stock" min="0" required value="{{ old('quantity_in_stock', $item->quantity_in_stock) }}"
                            class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Seuil minimum <span class="text-red-400">*</span></label>
                        <input type="number" name="min_threshold" min="0" required value="{{ old('min_threshold', $item->min_threshold) }}"
                            class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Unité <span class="text-red-400">*</span></label>
                        <select name="unit" required class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                            @foreach(['kg', 'g', 'l', 'ml', 'unité', 'pièce', 'botte'] as $unit)
                                <option value="{{ $unit }}" {{ old('unit', $item->unit) == $unit ? 'selected' : '' }}>{{ $unit }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Prix unitaire <span class="text-red-400">*</span></label>
                        <input type="number" name="unit_price" step="0.01" min="0" required value="{{ old('unit_price', $item->unit_price) }}"
                            class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <a href="{{ route('admin.inventory.index') }}" class="flex-1 py-3.5 px-4 text-center text-sm font-semibold rounded-xl border border-gray-200 text-gray-700 bg-white hover:bg-gray-50 transition">Annuler</a>
                    <button type="submit" class="flex-1 py-3.5 px-4 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 transition">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.admin>
