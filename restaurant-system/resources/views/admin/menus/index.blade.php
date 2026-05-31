<x-layouts.admin :title="'Gestion Menus - Resto Admin'" :breadcrumb="'Gestion des Menus'">
    <div x-data="menusApp({ menus: @js($menus), filters: @js($filters), hasErrors: @js($errors->any()) })" x-init="init()">
    @php
        $totalMenus = $menus->count();
        $activeMenus = $menus->where('is_active', true)->count();
        $inactiveMenus = $menus->where('is_active', false)->count();
        $categoriesCount = $menus->sum('categories_count');
    @endphp

    <!-- KPI Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-slate-100 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-gray-900" x-text="filteredMenus.length">{{ $totalMenus }}</p>
            <p class="text-xs text-gray-400 font-medium">Total menus</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-emerald-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-emerald-600" x-text="filteredMenus.filter(m => m.is_active).length">{{ $activeMenus }}</p>
            <p class="text-xs text-gray-400 font-medium">Actifs</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-red-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-red-500" x-text="filteredMenus.filter(m => !m.is_active).length">{{ $inactiveMenus }}</p>
            <p class="text-xs text-gray-400 font-medium">Inactifs</p>
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
                placeholder="Rechercher un menu...">
        </div>
        <div class="flex gap-2">
            <button type="button" data-hs-overlay="#create-modal"
                class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-md shadow-emerald-200/50 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Ajouter
            </button>
            <div class="w-48">
                <x-ui.select x-model="statusFilter" @change="applyFilters()"
                    class="py-2.5 px-3.5 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all">
                    <option value="">Tous les statuts</option>
                    <option value="1">Actif</option>
                    <option value="0">Inactif</option>
                </x-ui.select>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50/80 border-b border-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Menu</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Description</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Catégories</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Statut</th>
                        <th scope="col" class="px-6 py-3.5 text-end text-[10px] font-bold uppercase text-gray-400 tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <template x-for="menu in paginatedMenus" :key="menu.id">
                        <tr class="hover:bg-emerald-50/20 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3.5">
                                    <template x-if="menu.image_url">
                                        <img class="w-12 h-12 rounded-xl object-cover shadow-sm shrink-0" :src="'/storage/' + menu.image_url" :alt="menu.name">
                                    </template>
                                    <template x-if="!menu.image_url">
                                        <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-600 text-sm font-bold shrink-0" x-text="menu.name ? menu.name.substring(0, 1).toUpperCase() : '?'">
                                        </div>
                                    </template>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800" x-text="menu.name"></p>
                                        <p class="text-xs text-gray-400 mt-0.5" x-text="menu.currency || 'MAD'"></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-600 truncate max-w-xs block" x-text="menu.description || '-'"></span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium text-gray-800" x-text="menu.categories_count || 0"></span>
                            </td>
                            <td class="px-6 py-4">
                                <span :class="menu.is_active ? 'inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700' : 'inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-red-100 text-red-700'">
                                    <span :class="menu.is_active ? 'w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse' : 'w-1.5 h-1.5 rounded-full bg-red-500'"></span>
                                    <span x-text="menu.is_active ? 'Actif' : 'Inactif'"></span>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button type="button" @click="openEditModal(menu)"
                                        class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition"
                                        title="Modifier">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                    <button type="button" @click="toggleStatus(menu.id)"
                                        class="p-2 text-gray-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition"
                                        title="Changer statut">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                    <button type="button" @click="deleteMenu(menu.id)"
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
                    <tr x-show="filteredMenus.length === 0">
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            Aucun menu trouvé
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination controls -->
        <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between" x-show="totalPages > 1">
            <div class="flex-1 flex justify-between sm:hidden">
                <button @click="prevPage()" :disabled="currentPage === 1" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 transition-colors">
                    Précédent
                </button>
                <button @click="nextPage()" :disabled="currentPage === totalPages" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 transition-colors">
                    Suivant
                </button>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Affichage de <span class="font-medium" x-text="((currentPage - 1) * perPage) + 1"></span> à <span class="font-medium" x-text="Math.min(currentPage * perPage, filteredMenus.length)"></span> sur <span class="font-medium" x-text="filteredMenus.length"></span> menus
                    </p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex rounded-xl shadow-sm -space-x-px" aria-label="Pagination">
                        <button @click="prevPage()" :disabled="currentPage === 1" class="relative inline-flex items-center px-2.5 py-2 rounded-l-xl border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 transition-colors">
                            <span class="sr-only">Précédent</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                        </button>
                        
                        <template x-for="page in totalPages" :key="page">
                            <button @click="goToPage(page)" 
                                :class="page === currentPage ? 'z-10 bg-emerald-50 border-emerald-500 text-emerald-600 relative inline-flex items-center px-4 py-2 border text-sm font-bold transition-all' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium transition-all'"
                                x-text="page">
                            </button>
                        </template>

                        <button @click="nextPage()" :disabled="currentPage === totalPages" class="relative inline-flex items-center px-2.5 py-2 rounded-r-xl border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 transition-colors">
                            <span class="sr-only">Suivant</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <!-- Create Modal -->
    <div id="create-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="create-modal-label">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-xl sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
            <div class="w-full flex flex-col bg-white border border-gray-100 shadow-2xl rounded-3xl pointer-events-auto relative">
                <div class="flex justify-between items-center py-5 px-6 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-emerald-100 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold font-heading text-gray-900 leading-none">Ajouter un menu</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Remplissez les informations ci-dessous.</p>
                        </div>
                    </div>
                    <button type="button" data-hs-overlay="#create-modal" class="size-8 inline-flex justify-center items-center rounded-full border border-gray-200 bg-white text-gray-600 hover:bg-gray-50 transition-colors shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <form method="POST" action="{{ route('admin.menus.store') }}" enctype="multipart/form-data" class="p-6 space-y-5 overflow-y-auto max-h-[70vh]">
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
                    <div x-data="{ previewUrl: null }">
                        <label class="block text-sm font-bold text-gray-800 mb-2">Image du menu</label>
                        <div class="flex items-center gap-4">
                            <label class="w-20 h-20 rounded-2xl bg-gray-50 flex flex-col gap-1 items-center justify-center border-2 border-dashed border-gray-200 hover:border-emerald-400 hover:bg-emerald-50 hover:text-emerald-500 text-gray-400 transition-all cursor-pointer group relative overflow-hidden">
                                <template x-if="!previewUrl">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </template>
                                <template x-if="previewUrl">
                                    <img :src="previewUrl" class="absolute inset-0 w-full h-full object-cover">
                                </template>
                                <input type="file" name="image" class="sr-only" accept="image/*" @change="const file = $event.target.files[0]; if (file) { previewUrl = URL.createObjectURL(file); }">
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
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Nom du menu <span class="text-red-400">*</span></label>
                            <input type="text" name="name" required
                                class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition"
                                placeholder="Ex: Menu du jour" value="{{ old('name') }}">
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Description</label>
                            <textarea name="description" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" rows="3" placeholder="Description du menu...">{{ old('description') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Devise</label>
                            <input type="text" name="currency" value="{{ old('currency', 'MAD') }}"
                                class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Ordre d'affichage</label>
                            <input type="number" name="display_order" value="{{ old('display_order', 0) }}" min="0"
                                class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-emerald-50/60 rounded-2xl border border-emerald-100">
                        <div>
                            <p class="text-sm font-bold text-gray-800">Actif immédiatement</p>
                            <p class="text-xs text-gray-400 mt-0.5">Visible dans le menu client.</p>
                        </div>
                        <x-ui.select name="is_active" class="py-2 px-3 text-sm rounded-xl border border-gray-200 bg-white">
                            <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Actif</option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactif</option>
                        </x-ui.select>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="button" data-hs-overlay="#create-modal" class="flex-1 py-3.5 px-4 text-center text-sm font-semibold rounded-xl border border-gray-200 text-gray-700 bg-white hover:bg-gray-50 transition">Annuler</button>
                        <button type="submit" class="flex-1 py-3.5 px-4 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 transition">Créer le menu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div x-show="showEditModal" 
        class="fixed inset-0 z-[80] overflow-x-hidden overflow-y-auto bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-3"
        style="display: none;">
        <div @click.outside="showEditModal = false" class="w-full sm:max-w-xl bg-white border border-gray-100 shadow-2xl rounded-3xl overflow-hidden relative">
            <div class="flex justify-between items-center py-5 px-6 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-emerald-100 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold font-heading text-gray-900 leading-none">Modifier le menu</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Mettez à jour les informations du menu.</p>
                    </div>
                </div>
                <button type="button" @click="showEditModal = false" class="size-8 inline-flex justify-center items-center rounded-full border border-gray-200 bg-white text-gray-600 hover:bg-gray-50 transition-colors shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <form method="POST" :action="`/admin/menus/${editForm.id}`" enctype="multipart/form-data" class="p-6 space-y-5 overflow-y-auto max-h-[70vh]">
                @csrf
                @method('PUT')

                <!-- Image Upload -->
                <div x-data="{ previewUrl: null }">
                    <label class="block text-sm font-bold text-gray-800 mb-2">Image du menu</label>
                    <div class="flex items-center gap-4">
                        <label class="w-20 h-20 rounded-2xl bg-gray-50 flex flex-col gap-1 items-center justify-center border-2 border-dashed border-gray-200 hover:border-emerald-400 hover:bg-emerald-50 hover:text-emerald-500 text-gray-400 transition-all cursor-pointer group relative overflow-hidden">
                            <template x-if="!previewUrl && !editForm.image_url">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </template>
                            <template x-if="previewUrl">
                                <img :src="previewUrl" class="absolute inset-0 w-full h-full object-cover">
                            </template>
                            <template x-if="!previewUrl && editForm.image_url">
                                <img :src="'/storage/' + editForm.image_url" class="absolute inset-0 w-full h-full object-cover">
                            </template>
                            <input type="file" name="image" class="sr-only" accept="image/*" @change="const file = $event.target.files[0]; if (file) { previewUrl = URL.createObjectURL(file); }">
                        </label>
                        <div>
                            <p class="text-sm font-semibold text-gray-700">Cliquez pour uploader</p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG, WebP — max 2MB</p>
                        </div>
                        <template x-if="editForm.image_url">
                            <div class="ml-auto">
                                <label class="flex items-center gap-2 text-gray-500 cursor-pointer hover:text-red-600 transition-colors text-sm">
                                    <input type="checkbox" name="remove_image" value="1" class="rounded bg-gray-50 border-gray-200 text-red-500 focus:ring-red-500">
                                    <span>Supprimer l'image</span>
                                </label>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Form Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Nom du menu <span class="text-red-400">*</span></label>
                        <input type="text" name="name" required x-model="editForm.name"
                            class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition"
                            placeholder="Ex: Menu du jour">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Description</label>
                        <textarea name="description" x-model="editForm.description" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" rows="3" placeholder="Description du menu..."></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Devise</label>
                        <input type="text" name="currency" x-model="editForm.currency"
                            class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Ordre d'affichage</label>
                        <input type="number" name="display_order" x-model="editForm.display_order" min="0"
                            class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                    </div>
                </div>

                <div class="flex items-center justify-between p-4 bg-emerald-50/60 rounded-2xl border border-emerald-100">
                    <div>
                        <p class="text-sm font-bold text-gray-800">Actif immédiatement</p>
                        <p class="text-xs text-gray-400 mt-0.5">Visible dans le menu client.</p>
                    </div>
                    <x-ui.select name="is_active" x-model="editForm.is_active" class="py-2 px-3 text-sm rounded-xl border border-gray-200 bg-white">
                        <option value="1">Actif</option>
                        <option value="0">Inactif</option>
                    </x-ui.select>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" @click="showEditModal = false" class="flex-1 py-3.5 px-4 text-center text-sm font-semibold rounded-xl border border-gray-200 text-gray-700 bg-white hover:bg-gray-50 transition">Annuler</button>
                    <button type="submit" class="flex-1 py-3.5 px-4 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 transition">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.admin>
