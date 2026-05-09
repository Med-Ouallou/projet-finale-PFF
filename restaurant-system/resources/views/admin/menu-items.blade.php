<x-layouts.admin :title="'Gestion Menu - Resto Admin'" :breadcrumb="'Gestion du Menu'">

    <x-slot:actions>
        <button type="button" @click="$dispatch('open-modal', { id: 'modal-menu-item' })"
            class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-md shadow-emerald-200/50 transition-all hover:-translate-y-0.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Ajouter un plat
        </button>
    </x-slot:actions>

    <!-- KPI Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-slate-100 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-gray-900">24</p>
            <p class="text-xs text-gray-400 font-medium">Total plats</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-emerald-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-emerald-600">20</p>
            <p class="text-xs text-gray-400 font-medium">Disponibles</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-red-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-red-500">4</p>
            <p class="text-xs text-gray-400 font-medium">En rupture</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-amber-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-gray-900">5</p>
            <p class="text-xs text-gray-400 font-medium">Catégories</p>
        </div>
    </div>

    <!-- Filters Bar -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex flex-col sm:flex-row gap-3 items-stretch sm:items-center justify-between">
        <div class="relative flex-1 max-w-xs">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <input type="text" class="py-2.5 ps-10 pe-4 block w-full bg-gray-50 border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500 transition-shadow" placeholder="Rechercher un plat...">
        </div>
        <div class="flex gap-2">
            <!-- Catégorie Dropdown -->
            <div x-data="{ catOpen: false, selectedCat: 'Catégorie' }" class="relative inline-flex">
                <button type="button" @click="catOpen = !catOpen"
                    class="py-2.5 px-3.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span x-text="selectedCat"></span>
                    <svg class="w-3.5 h-3.5 text-gray-400 transition-transform" :class="{ 'rotate-180': catOpen }" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <div x-show="catOpen" x-cloak @click.away="catOpen = false"
                     x-transition class="absolute end-0 min-w-[190px] bg-white shadow-xl rounded-2xl border border-gray-100 mt-2 z-[80] p-2">
                    <button type="button" @click="selectedCat = 'Catégorie'; catOpen = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">
                        <span class="w-2 h-2 bg-gray-400 rounded-full"></span>Toutes les catégories
                    </button>
                    <div class="my-1 border-t border-gray-100"></div>
                    <button type="button" @click="selectedCat = 'Entrées'; catOpen = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">
                        <span class="w-2 h-2 bg-blue-400 rounded-full"></span>Entrées
                    </button>
                    <button type="button" @click="selectedCat = 'Plats principaux'; catOpen = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">
                        <span class="w-2 h-2 bg-emerald-400 rounded-full"></span>Plats principaux
                    </button>
                    <button type="button" @click="selectedCat = 'Desserts'; catOpen = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">
                        <span class="w-2 h-2 bg-pink-400 rounded-full"></span>Desserts
                    </button>
                    <button type="button" @click="selectedCat = 'Boissons'; catOpen = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">
                        <span class="w-2 h-2 bg-amber-400 rounded-full"></span>Boissons
                    </button>
                </div>
            </div>
            <!-- Statut Dropdown -->
            <div x-data="{ statOpen: false, selectedStat: 'Statut' }" class="relative inline-flex">
                <button type="button" @click="statOpen = !statOpen"
                    class="py-2.5 px-3.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span x-text="selectedStat"></span>
                    <svg class="w-3.5 h-3.5 text-gray-400 transition-transform" :class="{ 'rotate-180': statOpen }" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <div x-show="statOpen" x-cloak @click.away="statOpen = false"
                     x-transition class="absolute end-0 min-w-[160px] bg-white shadow-xl rounded-2xl border border-gray-100 mt-2 z-[80] p-2">
                    <button type="button" @click="selectedStat = 'Statut'; statOpen = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">
                        <span class="w-2 h-2 bg-gray-400 rounded-full"></span>Tous
                    </button>
                    <button type="button" @click="selectedStat = 'Disponible'; statOpen = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-emerald-50 text-emerald-700 transition-colors w-full text-start">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>Disponible
                    </button>
                    <button type="button" @click="selectedStat = 'Rupture'; statOpen = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-red-50 text-red-700 transition-colors w-full text-start">
                        <span class="w-2 h-2 bg-red-500 rounded-full"></span>Rupture
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
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
                    <tr class="hover:bg-emerald-50/20 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3.5">
                                <img class="w-12 h-12 rounded-xl object-cover shadow-sm shrink-0" src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=100&h=100&fit=crop" alt="">
                                <div>
                                    <p class="text-sm font-bold text-gray-800">Bowl Santé Quinoa</p>
                                    <p class="text-xs text-gray-400 mt-0.5">Quinoa, avocat, légumes frais</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 py-1 px-2.5 rounded-full text-[11px] font-bold bg-blue-50 text-blue-700">
                                <span class="w-1.5 h-1.5 bg-blue-400 rounded-full"></span>Plat Principal
                            </span>
                        </td>
                        <td class="px-6 py-4"><span class="text-sm font-bold text-gray-800">14.50 DH</span></td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>Disponible
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button type="button" aria-label="Modifier" @click="$dispatch('open-modal', { id: 'modal-menu-item' })"
                                    class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <button type="button" aria-label="Dupliquer" class="p-2 text-gray-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <button type="button" aria-label="Supprimer" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-emerald-50/20 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3.5">
                                <img class="w-12 h-12 rounded-xl object-cover shadow-sm shrink-0" src="https://images.unsplash.com/photo-1567620905732-2d1ec7bb7445?w=100&h=100&fit=crop" alt="">
                                <div>
                                    <p class="text-sm font-bold text-gray-800">Pancakes aux Fruits</p>
                                    <p class="text-xs text-gray-400 mt-0.5">Fruits rouges, sirop d'érable</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 py-1 px-2.5 rounded-full text-[11px] font-bold bg-amber-50 text-amber-700">
                                <span class="w-1.5 h-1.5 bg-amber-400 rounded-full"></span>Petit Déj.
                            </span>
                        </td>
                        <td class="px-6 py-4"><span class="text-sm font-bold text-gray-800">9.00 DH</span></td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>Rupture
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button type="button" aria-label="Modifier" @click="$dispatch('open-modal', { id: 'modal-menu-item' })"
                                    class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <button type="button" aria-label="Dupliquer" class="p-2 text-gray-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <button type="button" aria-label="Supprimer" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-emerald-50/20 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3.5">
                                <img class="w-12 h-12 rounded-xl object-cover shadow-sm shrink-0" src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=100&h=100&fit=crop" alt="">
                                <div>
                                    <p class="text-sm font-bold text-gray-800">Pizza Margherita</p>
                                    <p class="text-xs text-gray-400 mt-0.5">Tomate, mozzarella, basilic</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 py-1 px-2.5 rounded-full text-[11px] font-bold bg-red-50 text-red-600">
                                <span class="w-1.5 h-1.5 bg-red-400 rounded-full"></span>Plats
                            </span>
                        </td>
                        <td class="px-6 py-4"><span class="text-sm font-bold text-gray-800">12.00 DH</span></td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>Disponible
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button type="button" aria-label="Modifier" @click="$dispatch('open-modal', { id: 'modal-menu-item' })"
                                    class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <button type="button" aria-label="Dupliquer" class="p-2 text-gray-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <button type="button" aria-label="Supprimer" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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
        <div class="px-6 py-4 bg-gray-50/60 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-3">
            <span class="text-xs text-gray-500 font-medium">Affichage <span class="font-bold text-gray-700">1-3</span> sur <span class="font-bold text-gray-700">12</span> résultats</span>
            <nav class="flex items-center gap-1">
                <button class="py-1.5 px-3 text-xs font-bold text-gray-400 rounded-lg border border-gray-200 bg-white disabled:opacity-50 transition" disabled>←</button>
                <button class="py-1.5 px-3 text-xs font-bold text-white rounded-lg bg-emerald-600 shadow-sm shadow-emerald-200">1</button>
                <button class="py-1.5 px-3 text-xs font-bold text-gray-600 rounded-lg border border-gray-200 bg-white hover:bg-gray-50 transition">2</button>
                <button class="py-1.5 px-3 text-xs font-bold text-gray-600 rounded-lg border border-gray-200 bg-white hover:bg-gray-50 transition">3</button>
                <button class="py-1.5 px-3 text-xs font-bold text-gray-600 rounded-lg border border-gray-200 bg-white hover:bg-gray-50 transition">→</button>
            </nav>
        </div>
    </div>

    <!-- Menu Item Modal -->
    <x-slot:modal>
        <div x-data="{ open: false }" x-init="window.addEventListener('open-modal', e => { if(e.detail.id === 'modal-menu-item') open = true }) })"
             @close-modal.window="if($event.detail.id === 'modal-menu-item') open = false"
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
                                <h3 class="font-bold font-heading text-gray-900 leading-none">Ajouter un plat</h3>
                                <p class="text-xs text-gray-400 mt-0.5">Remplissez les informations ci-dessous.</p>
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
                    <div class="p-6 space-y-5 overflow-y-auto max-h-[70vh]">
                        <!-- Image Upload -->
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2">Photo du plat</label>
                            <div class="flex items-center gap-4">
                                <label class="w-20 h-20 rounded-2xl bg-gray-50 flex flex-col gap-1 items-center justify-center border-2 border-dashed border-gray-200 hover:border-emerald-400 hover:bg-emerald-50 hover:text-emerald-500 text-gray-400 transition-all cursor-pointer group">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <input type="file" class="hidden" accept="image/*">
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
                                <input type="text" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" placeholder="Ex: Pizza Margherita">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-800 mb-1.5">Catégorie <span class="text-red-400">*</span></label>
                                <div x-data="{ catOpen: false, selectedCat: 'Sélectionner...' }" class="relative w-full">
                                    <button type="button" @click="catOpen = !catOpen"
                                        class="py-3 px-4 inline-flex items-center justify-between w-full gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-gray-50 text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition">
                                        <span x-text="selectedCat"></span>
                                        <svg class="w-4 h-4 text-gray-400 transition-transform shrink-0" :class="{ 'rotate-180': catOpen }" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                    <div x-show="catOpen" x-cloak @click.away="catOpen = false"
                                         x-transition class="absolute w-full bg-white shadow-xl rounded-2xl border border-gray-100 mt-1 z-[90] p-2">
                                        <button type="button" @click="selectedCat = '🥗 Entrées'; catOpen = false" class="flex items-center py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">🥗 Entrées</button>
                                        <button type="button" @click="selectedCat = '🍽️ Plats principaux'; catOpen = false" class="flex items-center py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">🍽️ Plats principaux</button>
                                        <button type="button" @click="selectedCat = '🍰 Desserts'; catOpen = false" class="flex items-center py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">🍰 Desserts</button>
                                        <button type="button" @click="selectedCat = '🥤 Boissons'; catOpen = false" class="flex items-center py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">🥤 Boissons</button>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-800 mb-1.5">Prix <span class="text-red-400">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                        <span class="text-sm font-bold text-gray-400">DH</span>
                                    </div>
                                    <input type="number" step="0.01" min="0" class="py-3 ps-9 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" placeholder="0.00">
                                </div>
                            </div>

                            <div class="col-span-2">
                                <label class="block text-sm font-bold text-gray-800 mb-1.5">Description</label>
                                <textarea class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" rows="3" placeholder="Ingrédients, allergènes, remarques..."></textarea>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-emerald-50/60 rounded-2xl border border-emerald-100">
                            <div>
                                <p class="text-sm font-bold text-gray-800">Disponible immédiatement</p>
                                <p class="text-xs text-gray-400 mt-0.5">Visible dans le menu client en temps réel.</p>
                            </div>
                            <div class="flex items-center">
                                <input id="modal-avail-toggle" type="checkbox" class="relative w-11 h-6 bg-gray-200 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-emerald-600 checked:bg-emerald-600 checked:border-emerald-600 before:inline-block before:size-5 before:bg-white checked:before:bg-white before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200" checked>
                                <label for="modal-avail-toggle" class="sr-only">Disponible</label>
                            </div>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div class="flex justify-end items-center gap-3 px-6 py-5 border-t border-gray-100">
                        <button type="button" @click="open = false" class="py-2.5 px-5 text-sm font-semibold text-gray-500 hover:bg-gray-100 rounded-xl transition-colors">Annuler</button>
                        <button type="button" class="py-2.5 px-6 text-sm font-bold inline-flex items-center gap-x-2 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-lg shadow-emerald-200/50 transition-all hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M4.5 12.75l6 6 9-13.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Enregistrer le plat
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:modal>

</x-layouts.admin>
