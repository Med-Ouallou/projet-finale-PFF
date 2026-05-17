<x-layouts.admin :title="'Gestion Menu - Resto Admin'" :breadcrumb="'Gestion du Menu'">
    <div x-data="menuItemsApp({ items: @js($items), categories: @js($categories), filters: @js($filters) })" x-init="init()">
    @php
        $totalItems = $items->count();
        $availableItems = $items->where('status', 'available')->count();
        $unavailableItems = $items->where('status', 'unavailable')->count();
        $categoriesCount = $categories->count();
    @endphp

    <!-- KPI Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-slate-100 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-gray-900" x-text="filteredItems.length">{{ $totalItems }}</p>
            <p class="text-xs text-gray-400 font-medium">Total plats</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-emerald-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-emerald-600" x-text="filteredItems.filter(i => i.status === 'available').length">{{ $availableItems }}</p>
            <p class="text-xs text-gray-400 font-medium">Disponibles</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-red-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-red-500" x-text="filteredItems.filter(i => i.status === 'unavailable').length">{{ $unavailableItems }}</p>
            <p class="text-xs text-gray-400 font-medium">En rupture</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-amber-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-gray-900">{{ $categoriesCount }}</p>
            <p class="text-xs text-gray-400 font-medium">Catégories</p>
        </div>
    </div>

    <!-- Filters Bar -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex flex-col sm:flex-row gap-3 items-stretch sm:items-center justify-between mb-6">
        <div class="relative flex-1 max-w-xs">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <input type="text" x-model="search" @input.debounce.300ms="applyFilters()"
                class="py-2.5 ps-10 pe-4 block w-full bg-gray-50 border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500 transition-shadow"
                placeholder="Rechercher un plat...">
        </div>
        <div class="flex gap-2">
            <button type="button" @click="showCreateModal = true"
                class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-md shadow-emerald-200/50 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Ajouter
            </button>
            <select x-model="categoryFilter" @change="applyFilters()"
                class="py-2.5 px-3.5 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all">
                <option value="">Toutes les catégories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <select x-model="statusFilter" @change="applyFilters()"
                class="py-2.5 px-3.5 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all">
                <option value="">Tous les statuts</option>
                <option value="available">Disponible</option>
                <option value="unavailable">Indisponible</option>
            </select>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50/80 border-b border-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Plat</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Catégorie</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Prix</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Statut</th>
                        <th scope="col" class="px-6 py-3.5 text-end text-[10px] font-bold uppercase text-gray-400 tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <template x-for="item in filteredItems" :key="item.id">
                        <tr class="hover:bg-emerald-50/20 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3.5">
                                    <template x-if="item.image_url">
                                        <img class="w-12 h-12 rounded-xl object-cover shadow-sm shrink-0" :src="'/storage/' + item.image_url" :alt="item.name">
                                    </template>
                                    <template x-if="!item.image_url">
                                        <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center text-gray-400 text-xs" x-text="item.name ? item.name.substring(0, 1).toUpperCase() : '?'">
                                        </div>
                                    </template>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800" x-text="item.name"></p>
                                        <p class="text-xs text-gray-400 mt-0.5" x-text="item.description ? item.description.substring(0, 40) : ''"></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <template x-if="item.category">
                                    <span class="inline-flex items-center gap-1 py-1 px-2.5 rounded-full text-[11px] font-bold bg-blue-50 text-blue-700">
                                        <span class="w-1.5 h-1.5 bg-blue-400 rounded-full"></span><span x-text="item.category.name"></span>
                                    </span>
                                </template>
                                <template x-if="!item.category">
                                    <span class="text-xs text-gray-400">-</span>
                                </template>
                            </td>
                            <td class="px-6 py-4"><span class="text-sm font-bold text-gray-800" x-text="Number(item.price).toFixed(2) + ' DH'"></span></td>
                            <td class="px-6 py-4">
                                <span :class="item.status === 'available' ? 'inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700' : 'inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-red-100 text-red-700'">
                                    <span :class="item.status === 'available' ? 'w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse' : 'w-1.5 h-1.5 rounded-full bg-red-500'"></span>
                                    <span x-text="item.status === 'available' ? 'Disponible' : 'Indisponible'"></span>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a :href="`/admin/menu-items/${item.id}/edit`"
                                        class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition"
                                        title="Modifier">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                    <button type="button" @click="toggleStatus(item.id)"
                                        class="p-2 text-gray-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition"
                                        title="Changer statut">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                    <button type="button" @click="deleteItem(item.id)"
                                        class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition"
                                        title="Supprimer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="filteredItems.length === 0">
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            Aucun plat trouvé
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



    <!-- Create Modal -->
    <div x-show="showCreateModal" x-cloak style="display: none;" class="fixed inset-0 z-[80] overflow-x-hidden overflow-y-auto">
        <div class="fixed inset-0 bg-black/40" @click="showCreateModal = false"></div>
        <div class="relative min-h-[calc(100%-3.5rem)] flex items-center m-3 sm:mx-auto sm:max-w-xl sm:w-full">
                <div class="w-full flex flex-col bg-white border border-gray-100 shadow-2xl rounded-3xl pointer-events-auto relative">
                    <div class="flex justify-between items-center py-5 px-6 border-b border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 bg-emerald-100 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold font-heading text-gray-900 leading-none">Ajouter un plat</h3>
                                <p class="text-xs text-gray-400 mt-0.5">Remplissez les informations ci-dessous.</p>
                            </div>
                        </div>
                        <button type="button" @click="showCreateModal = false" class="size-8 inline-flex justify-center items-center rounded-full border border-gray-200 bg-white text-gray-600 hover:bg-gray-50 transition-colors shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('admin.menu-items.store') }}" enctype="multipart/form-data" class="p-6 space-y-5 overflow-y-auto max-h-[70vh]">
                        @csrf

                        <!-- Validation Errors -->
                        @if($errors->any())
                            <div class="p-4 bg-red-50 border border-red-200 rounded-xl">
                                <p class="text-sm font-bold text-red-700 mb-2">Veuillez corriger les erreurs :</p>
                                <ul class="text-sm text-red-600 space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Image Upload -->
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2">Photo du plat</label>
                            <div class="flex items-center gap-4">
                                <label class="w-20 h-20 rounded-2xl bg-gray-50 flex flex-col gap-1 items-center justify-center border-2 border-dashed border-gray-200 hover:border-emerald-400 hover:bg-emerald-50 hover:text-emerald-500 text-gray-400 transition-all cursor-pointer group">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <input type="file" name="image" class="hidden" accept="image/*">
                                </label>
                                <div>
                                    <p class="text-sm font-semibold text-gray-700">Cliquez pour uploader</p>
                                    <p class="text-xs text-gray-400 mt-1">PNG, JPG, WebP — max 2MB</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Grid -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="block text-sm font-bold text-gray-800 mb-1.5">Nom du plat <span class="text-red-400">*</span></label>
                                <input type="text" name="name" required
                                    class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition"
                                    placeholder="Ex: Pizza Margherita" value="{{ old('name') }}">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-800 mb-1.5">Catégorie <span class="text-red-400">*</span></label>
                                <select name="category_id" required class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                                    <option value="">Sélectionner...</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-800 mb-1.5">Prix <span class="text-red-400">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                        <span class="text-sm font-bold text-gray-400">DH</span>
                                    </div>
                                    <input type="number" name="price" step="0.01" min="0" required
                                        class="py-3 ps-9 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition"
                                        placeholder="0.00" value="{{ old('price') }}">
                                </div>
                            </div>

                            <div class="col-span-2">
                                <label class="block text-sm font-bold text-gray-800 mb-1.5">Description</label>
                                <textarea name="description" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" rows="3" placeholder="Ingrédients, allergènes, remarques...">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-emerald-50/60 rounded-2xl border border-emerald-100">
                            <div>
                                <p class="text-sm font-bold text-gray-800">Disponible immédiatement</p>
                                <p class="text-xs text-gray-400 mt-0.5">Visible dans le menu client.</p>
                            </div>
                            <select name="status" class="py-2 px-3 text-sm rounded-xl border border-gray-200 bg-white">
                                <option value="available">Disponible</option>
                                <option value="unavailable">Indisponible</option>
                            </select>
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="button" @click="showCreateModal = false" class="flex-1 py-3.5 px-4 text-center text-sm font-semibold rounded-xl border border-gray-200 text-gray-700 bg-white hover:bg-gray-50 transition">Annuler</button>
                            <button type="submit" class="flex-1 py-3.5 px-4 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 transition">Créer le plat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</x-layouts.admin>
