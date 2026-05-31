<x-layouts.admin :title="'Promotions - Resto Admin'" :breadcrumb="'Gestion des Promotions'">
    <div x-data="promotionsApp({ promotions: @js($promotions), filters: @js($filters) })" x-init="init()">
    @php
        $totalPromotions = $promotions->count();
        $activePromotions = $promotions->filter(fn($p) => (!$p->valid_from || $p->valid_from <= now()) && (!$p->valid_until || $p->valid_until >= now()))->count();
    @endphp

    <!-- KPI Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-slate-100 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a1.875 1.875 0 002.652 0l4.318-4.318a1.875 1.875 0 000-2.652L11.16 3.659A1.875 1.875 0 009.568 3z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 7.5h.008v.008H6V7.5z" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-gray-900" x-text="filteredPromotions.length">{{ $totalPromotions }}</p>
            <p class="text-xs text-gray-400 font-medium">Total promotions</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-emerald-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-emerald-600">{{ $activePromotions }}</p>
            <p class="text-xs text-gray-400 font-medium">Promotions en cours</p>
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
                placeholder="Rechercher un code...">
        </div>
        <div class="flex gap-2">
            <button type="button" data-hs-overlay="#create-modal"
                class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-md shadow-emerald-200/50 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Ajouter
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50/80 border-b border-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Code</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Remise (Pourcentage)</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Remise (Fixe)</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Période de Validité</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Limite d'utilisation</th>
                        <th scope="col" class="px-6 py-3.5 text-end text-[10px] font-bold uppercase text-gray-400 tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <template x-for="promotion in paginatedPromotions" :key="promotion.id">
                        <tr class="hover:bg-emerald-50/20 transition-colors group">
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-gray-800" x-text="promotion.code"></span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-600" x-text="promotion.discount_percentage ? promotion.discount_percentage + ' %' : '-'"></span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-600" x-text="promotion.discount_amount ? promotion.discount_amount + ' DH' : '-'"></span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-xs text-gray-500">
                                    <div>Début: <span x-text="promotion.valid_from || 'Immédiat'"></span></div>
                                    <div>Fin: <span x-text="promotion.valid_until || 'Indéterminé'"></span></div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-600" x-text="promotion.usage_limit || 'Illimitée'"></span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button type="button" @click="openEditModal(promotion)"
                                        class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition"
                                        title="Modifier">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                    <button type="button" @click="deletePromotion(promotion.id)" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition" title="Supprimer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="filteredPromotions.length === 0">
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">Aucune promotion trouvée</td>
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
                        Affichage de <span class="font-medium" x-text="((currentPage - 1) * perPage) + 1"></span> à <span class="font-medium" x-text="Math.min(currentPage * perPage, filteredPromotions.length)"></span> sur <span class="font-medium" x-text="filteredPromotions.length"></span> promotions
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
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
            <div class="w-full flex flex-col bg-white border border-gray-100 shadow-2xl rounded-3xl pointer-events-auto relative">
                <div class="flex justify-between items-center py-5 px-6 border-b border-gray-100">
                    <h3 class="font-bold font-heading text-gray-900">Nouvelle promotion</h3>
                    <button type="button" data-hs-overlay="#create-modal" class="size-8 inline-flex justify-center items-center rounded-full border border-gray-200 bg-white text-gray-600 hover:bg-gray-50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <form method="POST" action="{{ route('admin.promotions.store') }}" class="p-6 space-y-4">
                    @csrf

                    @if($errors->any())
                        <div class="p-4 bg-red-50 border border-red-200 rounded-xl">
                            <p class="text-sm font-bold text-red-700 mb-2">Erreurs :</p>
                            <ul class="text-sm text-red-600 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Code de coupon <span class="text-red-400">*</span></label>
                        <input type="text" name="code" required class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" placeholder="Ex: COUPO20">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Pourcentage (%)</label>
                            <input type="number" name="discount_percentage" step="0.01" min="0" max="100" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" placeholder="Ex: 10.00">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Montant Fixe (DH)</label>
                            <input type="number" name="discount_amount" step="0.01" min="0" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" placeholder="Ex: 50.00">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Valide à partir de</label>
                            <x-ui.datepicker name="valid_from" placeholder="Sélectionner la date" />
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Valide jusqu'à</label>
                            <x-ui.datepicker name="valid_until" align="right" placeholder="Sélectionner la date" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Limite d'utilisation</label>
                        <input type="number" name="usage_limit" min="1" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" placeholder="Laisser vide pour illimitée">
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="button" data-hs-overlay="#create-modal" class="flex-1 py-3.5 px-4 text-center text-sm font-semibold rounded-xl border border-gray-200 text-gray-700 bg-white hover:bg-gray-50">Annuler</button>
                        <button type="submit" class="flex-1 py-3.5 px-4 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700">Créer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div x-show="showEditModal" 
        class="fixed inset-0 z-[80] overflow-x-hidden overflow-y-auto bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-3"
        style="display: none;">
        <div @click.outside="showEditModal = false" class="w-full sm:max-w-lg bg-white border border-gray-100 shadow-2xl rounded-3xl relative">
            <div class="flex justify-between items-center py-5 px-6 border-b border-gray-100">
                <h3 class="font-bold font-heading text-gray-900">Modifier la promotion</h3>
                <button type="button" @click="showEditModal = false" class="size-8 inline-flex justify-center items-center rounded-full border border-gray-200 bg-white text-gray-600 hover:bg-gray-50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <form method="POST" :action="`/admin/promotions/${editForm.id}`" class="p-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-1.5">Code de coupon <span class="text-red-400">*</span></label>
                    <input type="text" name="code" required x-model="editForm.code" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Pourcentage (%)</label>
                        <input type="number" name="discount_percentage" step="0.01" min="0" max="100" x-model="editForm.discount_percentage" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Montant Fixe (DH)</label>
                        <input type="number" name="discount_amount" step="0.01" min="0" x-model="editForm.discount_amount" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Valide à partir de</label>
                        <x-ui.datepicker name="valid_from" model="editForm.valid_from" placeholder="Sélectionner la date" />
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Valide jusqu'à</label>
                        <x-ui.datepicker name="valid_until" model="editForm.valid_until" align="right" placeholder="Sélectionner la date" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-1.5">Limite d'utilisation</label>
                    <input type="number" name="usage_limit" min="1" x-model="editForm.usage_limit" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" @click="showEditModal = false" class="flex-1 py-3.5 px-4 text-center text-sm font-semibold rounded-xl border border-gray-200 text-gray-700 bg-white hover:bg-gray-50">Annuler</button>
                    <button type="submit" class="flex-1 py-3.5 px-4 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>
