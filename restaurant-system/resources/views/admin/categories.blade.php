<x-layouts.admin :title="'Gestion Catégories - Resto Admin'" :breadcrumb="'Gestion Catégories'">

    <x-slot:actions>
        <button type="button" @click="$dispatch('open-modal', { id: 'modal-category' })"
            class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-md shadow-emerald-200/50 transition-all hover:-translate-y-0.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Ajouter une catégorie
        </button>
    </x-slot:actions>

    <!-- KPI Cards -->
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1 items-start text-start">
            <div class="w-9 h-9 bg-emerald-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-gray-900">12</p>
            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Total Catégories</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1 items-start text-start">
            <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-gray-900">Plats principaux</p>
            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">La plus fournie (15 plats)</p>
        </div>
    </div>

    <!-- Table Component -->
    <div class="flex flex-col bg-white border border-gray-100 shadow-sm rounded-3xl overflow-hidden">
        <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-100">
            <div>
                <h2 class="text-xl font-bold font-heading text-gray-800">Liste des Catégories</h2>
                <p class="text-sm text-gray-500">Gérez l'organisation de votre carte restaurant.</p>
            </div>
        </div>
        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-start"><span class="text-xs font-bold uppercase tracking-wider text-gray-400">Catégorie</span></th>
                        <th scope="col" class="px-6 py-3 text-start"><span class="text-xs font-bold uppercase tracking-wider text-gray-400">Description</span></th>
                        <th scope="col" class="px-6 py-3 text-start"><span class="text-xs font-bold uppercase tracking-wider text-gray-400">Plats</span></th>
                        <th scope="col" class="px-6 py-3 text-end"><span class="text-xs font-bold uppercase tracking-wider text-gray-400">Actions</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50/80 transition-colors group">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center text-xl text-start">🥗</div>
                                <div>
                                    <span class="block text-sm font-bold text-gray-900">Entrées</span>
                                    <div class="flex items-center gap-1.5 mt-0.5 text-start">
                                        <div class="size-1.5 rounded-full bg-emerald-500"></div>
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tight">Actif</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-600 max-w-xs truncate">Salades fraîches et amuse-bouches pour bien commencer.</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-gray-100 text-gray-800">12 plats</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-end">
                            <div class="flex justify-end gap-2 translate-x-3 opacity-0 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-200">
                                <button type="button" aria-label="Modifier" class="size-8 inline-flex justify-center items-center rounded-lg border border-gray-200 bg-white text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 transition-all">
                                    <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <button type="button" aria-label="Supprimer" class="size-8 inline-flex justify-center items-center rounded-lg border border-gray-200 bg-white text-gray-600 hover:bg-red-50 hover:text-red-500 hover:border-red-200 transition-all">
                                    <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50/80 transition-colors group">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center text-xl text-start">🍽️</div>
                                <div>
                                    <span class="block text-sm font-bold text-gray-900">Plats Principaux</span>
                                    <div class="flex items-center gap-1.5 mt-0.5 text-start">
                                        <div class="size-1.5 rounded-full bg-blue-500"></div>
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tight">Actif</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-600 max-w-xs truncate">Nos meilleures sélections de viandes et poissons.</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-gray-100 text-gray-800">24 plats</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-end">
                            <div class="flex justify-end gap-2 translate-x-3 opacity-0 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-200">
                                <button type="button" aria-label="Modifier" class="size-8 inline-flex justify-center items-center rounded-lg border border-gray-200 bg-white text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 transition-all">
                                    <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <button type="button" aria-label="Supprimer" class="size-8 inline-flex justify-center items-center rounded-lg border border-gray-200 bg-white text-gray-600 hover:bg-red-50 hover:text-red-500 hover:border-red-200 transition-all">
                                    <svg class="size-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Affichage de 1-10 sur 12</span>
            <div class="inline-flex gap-x-1">
                <button type="button" class="py-1.5 px-3 text-xs font-bold text-gray-300 pointer-events-none rounded-lg border border-gray-100 bg-white transition cursor-not-allowed">←</button>
                <button type="button" class="py-1.5 px-3 text-xs font-bold text-gray-600 rounded-lg border border-gray-200 bg-white hover:bg-gray-50 transition">→</button>
            </div>
        </div>
    </div>

    <!-- Category Modal -->
    <x-slot:modal>
        <div x-data="{ open: false }" x-init="window.addEventListener('open-modal', e => { if(e.detail.id === 'modal-category') open = true }) })"
             @close-modal.window="if($event.detail.id === 'modal-category') open = false"
             class="fixed inset-0 z-[80] overflow-x-hidden overflow-y-auto" :class="{ 'pointer-events-none': !open }">

            <!-- Backdrop -->
            <div x-show="open" x-cloak
                 x-transition:enter="transition-opacity ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 @click="open = false" class="fixed inset-0 bg-black/40"></div>

            <!-- Modal Content -->
            <div x-show="open" x-cloak
                 x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4"
                 class="relative min-h-[calc(100%-3.5rem)] flex items-center m-3 sm:mx-auto sm:max-w-xl sm:w-full">
                <div class="w-full flex flex-col bg-white border border-gray-100 shadow-2xl rounded-3xl pointer-events-auto relative">
                    <!-- Header -->
                    <div class="flex justify-between items-center py-5 px-6 border-b border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 bg-emerald-100 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold font-heading text-gray-900 leading-none">Nouvelle Catégorie</h3>
                                <p class="text-xs text-gray-400 mt-0.5">Organisez vos plats par thématiques.</p>
                            </div>
                        </div>
                        <button type="button" @click="open = false"
                                class="size-8 inline-flex justify-center items-center rounded-full border border-gray-200 bg-white text-gray-600 hover:bg-gray-50 transition-colors shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                    <!-- Body -->
                    <div class="p-6 space-y-5">
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Nom de la catégorie <span class="text-red-400">*</span></label>
                            <input type="text" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" placeholder="Ex: Desserts Gourmands">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-800 mb-1.5">Icône</label>
                                <div x-data="{ iconOpen: false, selectedIcon: '📁 Par défaut' }" class="relative w-full">
                                    <button type="button" @click="iconOpen = !iconOpen" class="py-3 px-4 inline-flex items-center justify-between w-full gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-gray-50 text-gray-700 hover:bg-gray-100 focus:outline-none transition text-start">
                                        <span x-text="selectedIcon"></span>
                                        <svg class="w-4 h-4 text-gray-400 transition-transform" :class="{ 'rotate-180': iconOpen }" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                    <div x-show="iconOpen" x-cloak @click.away="iconOpen = false"
                                         x-transition class="absolute w-full bg-white shadow-xl rounded-2xl border border-gray-100 mt-1 z-[90] p-2">
                                        <button type="button" @click="selectedIcon = '🥗 Entrées'; iconOpen = false" class="flex items-center py-2 px-3 rounded-xl text-sm text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">🥗 Entrées</button>
                                        <button type="button" @click="selectedIcon = '🍽️ Plats'; iconOpen = false" class="flex items-center py-2 px-3 rounded-xl text-sm text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">🍽️ Plats</button>
                                        <button type="button" @click="selectedIcon = '🍰 Desserts'; iconOpen = false" class="flex items-center py-2 px-3 rounded-xl text-sm text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">🍰 Desserts</button>
                                        <button type="button" @click="selectedIcon = '🥤 Boissons'; iconOpen = false" class="flex items-center py-2 px-3 rounded-xl text-sm text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">🥤 Boissons</button>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-800 mb-1.5">Couleur</label>
                                <div x-data="{ colorOpen: false, selectedColor: 'Émeraude', selectedClass: 'bg-emerald-500' }" class="relative w-full">
                                    <button type="button" @click="colorOpen = !colorOpen" class="py-3 px-4 inline-flex items-center justify-between w-full gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-gray-50 text-gray-700 hover:bg-gray-100 focus:outline-none transition text-start">
                                        <div class="flex items-center gap-2">
                                            <div class="size-3 rounded-full" :class="selectedClass"></div>
                                            <span x-text="selectedColor"></span>
                                        </div>
                                        <svg class="w-4 h-4 text-gray-400 transition-transform" :class="{ 'rotate-180': colorOpen }" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                    <div x-show="colorOpen" x-cloak @click.away="colorOpen = false"
                                         x-transition class="absolute w-full bg-white shadow-xl rounded-2xl border border-gray-100 mt-1 z-[90] p-2">
                                        <button type="button" @click="selectedColor = 'Émeraude'; selectedClass = 'bg-emerald-500'; colorOpen = false" class="flex items-center gap-2 py-2 px-3 rounded-xl text-sm text-gray-700 hover:bg-gray-100 w-full text-start">
                                            <div class="size-3 rounded-full bg-emerald-500"></div> Émeraude
                                        </button>
                                        <button type="button" @click="selectedColor = 'Ambre'; selectedClass = 'bg-amber-500'; colorOpen = false" class="flex items-center gap-2 py-2 px-3 rounded-xl text-sm text-gray-700 hover:bg-gray-100 w-full text-start">
                                            <div class="size-3 rounded-full bg-amber-500"></div> Ambre
                                        </button>
                                        <button type="button" @click="selectedColor = 'Bleu'; selectedClass = 'bg-blue-500'; colorOpen = false" class="flex items-center gap-2 py-2 px-3 rounded-xl text-sm text-gray-700 hover:bg-gray-100 w-full text-start">
                                            <div class="size-3 rounded-full bg-blue-500"></div> Bleu
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Description</label>
                            <textarea class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" rows="2" placeholder="Petite note..."></textarea>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div class="flex justify-end items-center gap-3 px-6 py-5 border-t border-gray-100">
                        <button type="button" @click="open = false" class="py-2.5 px-5 text-sm font-semibold text-gray-500 hover:bg-gray-100 rounded-xl transition-colors">Annuler</button>
                        <button type="button" class="py-2.5 px-6 text-sm font-bold inline-flex items-center gap-x-2 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-lg shadow-emerald-200/50 transition-all hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M4.5 12.75l6 6 9-13.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Créer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:modal>

</x-layouts.admin>
