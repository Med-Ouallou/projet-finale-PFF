<x-layouts.admin :title="'Modifier Menu - Resto Admin'" :breadcrumb="'Modifier Menu'">
    <div class="max-w-2xl mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('admin.menus.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-emerald-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span class="font-medium">Retour aux menus</span>
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-emerald-700">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-rose-50 border border-rose-200 rounded-2xl text-rose-700">{{ session('error') }}</div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h1 class="text-xl font-bold text-gray-900">Modifier Menu</h1>
            </div>
            
            <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Image Preview -->
                @if($menu->image_url)
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('storage/' . $menu->image_url) }}" alt="Current" class="w-20 h-20 rounded-xl object-cover border border-gray-200">
                        <div>
                            <label class="flex items-center gap-2 text-gray-500 cursor-pointer hover:text-rose-600 transition-colors">
                                <input type="checkbox" name="remove_image" value="1" class="rounded bg-gray-50 border-gray-200 text-rose-500 focus:ring-rose-500">
                                <span class="text-sm font-medium">Supprimer l'image</span>
                            </label>
                        </div>
                    </div>
                @endif

                <!-- Name -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nom <span class="text-rose-400">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $menu->name) }}" required
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-900 focus:border-emerald-500 focus:ring-emerald-500 transition-all">
                    @error('name')<p class="text-rose-400 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-900 focus:border-emerald-500 focus:ring-emerald-500 transition-all">{{ old('description', $menu->description) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Currency -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Devise</label>
                        <input type="text" name="currency" value="{{ old('currency', $menu->currency ?? 'MAD') }}"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-900 focus:border-emerald-500">
                    </div>

                    <!-- Display Order -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Ordre d'affichage</label>
                        <input type="number" name="display_order" value="{{ old('display_order', $menu->display_order ?? 0) }}" min="0"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-900 focus:border-emerald-500">
                    </div>
                </div>

                <!-- New Image -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nouvelle Image</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:bg-emerald-600 file:text-white hover:file:bg-emerald-700 file:font-medium transition-all">
                    @error('image')<p class="text-rose-400 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.menus.index') }}" class="px-5 py-2.5 text-gray-500 hover:text-gray-700 font-medium transition-colors">
                        Annuler
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold shadow-md shadow-emerald-200/50 transition-all">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>
