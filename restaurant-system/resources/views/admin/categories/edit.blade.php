<x-layouts.admin :title="'Modifier Catégorie - Resto Admin'" :breadcrumb="'Modifier la catégorie'">

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-lg font-bold font-heading text-gray-900">Modifier la catégorie</h2>
                <p class="text-sm text-gray-400">Mettez à jour les informations de la catégorie.</p>
            </div>

            <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Nom <span class="text-red-400">*</span></label>
                        <input type="text" name="name" required value="{{ old('name', $category->name) }}"
                            class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Menu <span class="text-red-400">*</span></label>
                        <select name="menu_id" required class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}" {{ old('menu_id', $category->menu_id) == $menu->id ? 'selected' : '' }}>{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Description</label>
                        <textarea name="description" rows="2" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Ordre d'affichage</label>
                        <input type="number" name="display_order" min="0" value="{{ old('display_order', $category->display_order ?? 0) }}"
                            class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Actif</label>
                        <select name="is_active" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                            <option value="1" {{ old('is_active', $category->is_active) ? 'selected' : '' }}>Oui</option>
                            <option value="0" {{ !old('is_active', $category->is_active) ? 'selected' : '' }}>Non</option>
                        </select>
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <a href="{{ route('admin.categories.index') }}" class="flex-1 py-3.5 px-4 text-center text-sm font-semibold rounded-xl border border-gray-200 text-gray-700 bg-white hover:bg-gray-50 transition">Annuler</a>
                    <button type="submit" class="flex-1 py-3.5 px-4 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 transition">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.admin>
