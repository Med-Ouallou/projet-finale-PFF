<x-layouts.admin :title="'Modifier Plat - Resto Admin'" :breadcrumb="'Modifier le plat'">

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-lg font-bold font-heading text-gray-900">Modifier le plat</h2>
                <p class="text-sm text-gray-400">Mettez à jour les informations du plat.</p>
            </div>

            <form method="POST" action="{{ route('admin.menu-items.update', $item) }}" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Image -->
                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-2">Photo du plat</label>
                    <div class="flex items-center gap-4">
                        @if($item->image_url)
                            <img src="{{ asset('storage/' . $item->image_url) }}" alt="{{ $item->name }}" class="w-20 h-20 rounded-2xl object-cover">
                        @endif
                        <label class="w-20 h-20 rounded-2xl bg-gray-50 flex flex-col gap-1 items-center justify-center border-2 border-dashed border-gray-200 hover:border-emerald-400 hover:bg-emerald-50 hover:text-emerald-500 text-gray-400 transition-all cursor-pointer group">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <input type="file" name="image" class="hidden" accept="image/*">
                        </label>
                        <div>
                            <p class="text-sm font-semibold text-gray-700">Cliquez pour changer</p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG, WebP — max 2MB</p>
                        </div>
                    </div>
                </div>

                <!-- Form Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Nom du plat <span class="text-red-400">*</span></label>
                        <input type="text" name="name" required value="{{ old('name', $item->name) }}"
                            class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Catégorie <span class="text-red-400">*</span></label>
                        <x-ui.select name="category_id" required class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                            <option value="">Sélectionner...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </x-ui.select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Prix <span class="text-red-400">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <span class="text-sm font-bold text-gray-400">DH</span>
                            </div>
                            <input type="number" name="price" step="0.01" min="0" required value="{{ old('price', $item->price) }}"
                                class="py-3 ps-9 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Description</label>
                        <textarea name="description" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" rows="3">{{ old('description', $item->description) }}</textarea>
                    </div>
                </div>

                <div class="flex items-center justify-between p-4 bg-emerald-50/60 rounded-2xl border border-emerald-100">
                    <div>
                        <p class="text-sm font-bold text-gray-800">Statut</p>
                        <p class="text-xs text-gray-400 mt-0.5">Visibilité dans le menu client.</p>
                    </div>
                    <x-ui.select name="status" class="py-2 px-3 text-sm rounded-xl border border-gray-200 bg-white">
                        <option value="available" {{ old('status', $item->status) == 'available' ? 'selected' : '' }}>Disponible</option>
                        <option value="unavailable" {{ old('status', $item->status) == 'unavailable' ? 'selected' : '' }}>Indisponible</option>
                    </x-ui.select>
                </div>

                <div class="flex gap-3 pt-2">
                    <a href="{{ route('admin.menu-items.index') }}" class="flex-1 py-3.5 px-4 text-center text-sm font-semibold rounded-xl border border-gray-200 text-gray-700 bg-white hover:bg-gray-50 transition">Annuler</a>
                    <button type="submit" class="flex-1 py-3.5 px-4 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 transition">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.admin>
