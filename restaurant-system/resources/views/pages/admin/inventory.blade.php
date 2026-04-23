<x-layouts.admin :title="'Gestion Inventaire - Resto Admin'" :breadcrumb="'Gestion Inventaire'">

    <x-slot:actions>
        <button type="button" @click="$dispatch('open-modal', { id: 'modal-inventory' })"
            class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-md shadow-emerald-200/50 transition-all hover:-translate-y-0.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round" /></svg>
            Ajouter un produit
        </button>
    </x-slot:actions>

    <!-- KPI Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-slate-100 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-gray-900">156</p>
            <p class="text-xs text-gray-400 font-medium">Total Articles</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-amber-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-amber-600">12</p>
            <p class="text-xs text-gray-400 font-medium">Stock Faible</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-red-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-red-500">3</p>
            <p class="text-xs text-gray-400 font-medium">Rupture de Stock</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-emerald-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.202-2.04-.591-.795-.523-1.89-.645-2.902-.268-1.015.377-1.74 1.165-1.928 2.12a2.122 2.122 0 001.17 2.302c.49.237 1.068-.022 1.322-.595z" /></svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-emerald-600">12,450 €</p>
            <p class="text-xs text-gray-400 font-medium">Valeur Totale</p>
        </div>
    </div>

    <!-- Filters Bar -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex flex-col sm:flex-row gap-3 items-stretch sm:items-center justify-between">
        <div class="relative flex-1 max-w-xs">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z" stroke-linecap="round" stroke-linejoin="round" /></svg>
            </div>
            <input type="text" class="py-2.5 ps-10 pe-4 block w-full bg-gray-50 border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500 transition-shadow" placeholder="Rechercher un produit...">
        </div>
        <div class="flex gap-2">
            <div x-data="{ catOpen: false, selectedCat: 'Catégorie' }" class="relative inline-flex">
                <button type="button" @click="catOpen = !catOpen" class="py-2.5 px-3.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                    <span x-text="selectedCat"></span>
                    <svg class="w-3.5 h-3.5 text-gray-400 transition-transform" :class="{ 'rotate-180': catOpen }" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" /></svg>
                </button>
                <div x-show="catOpen" x-cloak @click.away="catOpen = false" x-transition class="absolute end-0 min-w-[190px] bg-white shadow-xl rounded-2xl border border-gray-100 mt-2 z-[80] p-2">
                    <button type="button" @click="selectedCat = 'Catégorie'; catOpen = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors w-full text-start"><span class="w-2 h-2 bg-gray-400 rounded-full"></span>Toutes les catégories</button>
                    <div class="my-1 border-t border-gray-100"></div>
                    <button type="button" @click="selectedCat = 'Produits frais'; catOpen = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors w-full text-start"><span class="w-2 h-2 bg-emerald-400 rounded-full"></span>Produits frais</button>
                    <button type="button" @click="selectedCat = 'Boissons'; catOpen = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors w-full text-start"><span class="w-2 h-2 bg-blue-400 rounded-full"></span>Boissons</button>
                    <button type="button" @click="selectedCat = 'Épicerie'; catOpen = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors w-full text-start"><span class="w-2 h-2 bg-amber-400 rounded-full"></span>Épicerie</button>
                </div>
            </div>
            <div x-data="{ stockOpen: false, selectedStock: 'Stock' }" class="relative inline-flex">
                <button type="button" @click="stockOpen = !stockOpen" class="py-2.5 px-3.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" /></svg>
                    <span x-text="selectedStock"></span>
                    <svg class="w-3.5 h-3.5 text-gray-400 transition-transform" :class="{ 'rotate-180': stockOpen }" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" /></svg>
                </button>
                <div x-show="stockOpen" x-cloak @click.away="stockOpen = false" x-transition class="absolute end-0 min-w-[160px] bg-white shadow-xl rounded-2xl border border-gray-100 mt-2 z-[80] p-2">
                    <button type="button" @click="selectedStock = 'Stock'; stockOpen = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors w-full text-start"><span class="w-2 h-2 bg-gray-400 rounded-full"></span>Tous</button>
                    <button type="button" @click="selectedStock = 'En stock'; stockOpen = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-emerald-50 text-emerald-700 transition-colors w-full text-start"><span class="w-2 h-2 bg-emerald-500 rounded-full"></span>En stock</button>
                    <button type="button" @click="selectedStock = 'Stock faible'; stockOpen = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-amber-50 text-amber-700 transition-colors w-full text-start"><span class="w-2 h-2 bg-amber-500 rounded-full"></span>Stock faible</button>
                    <button type="button" @click="selectedStock = 'Rupture'; stockOpen = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-red-50 text-red-700 transition-colors w-full text-start"><span class="w-2 h-2 bg-red-500 rounded-full"></span>Rupture</button>
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
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Produit</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Catégorie</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Quantité</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Stock Min</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Statut</th>
                        <th scope="col" class="px-6 py-3.5 text-end text-[10px] font-bold uppercase text-gray-400 tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <tr class="hover:bg-emerald-50/20 transition-colors group">
                        <td class="px-6 py-4"><div class="flex items-center gap-3.5"><img class="w-10 h-10 rounded-xl object-cover shadow-sm shrink-0" src="https://images.unsplash.com/photo-1587049352846-4a222e784d38?w=100&h=100&fit=crop" alt=""><div><p class="text-sm font-bold text-gray-800">Tomates Bio</p><p class="text-xs text-gray-400 mt-0.5">Unité: kg</p></div></div></td>
                        <td class="px-6 py-4"><span class="inline-flex items-center gap-1 py-1 px-2.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700"><span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>Produits frais</span></td>
                        <td class="px-6 py-4"><span class="text-sm font-bold text-gray-800">25 kg</span></td>
                        <td class="px-6 py-4"><span class="text-sm text-gray-500">10 kg</span></td>
                        <td class="px-6 py-4"><span class="inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>En stock</span></td>
                        <td class="px-6 py-4"><div class="flex justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity"><button type="button" aria-label="Modifier" @click="$dispatch('open-modal', { id: 'modal-inventory' })" class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" stroke-linecap="round" stroke-linejoin="round" /></svg></button><button type="button" aria-label="Supprimer" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" stroke-linecap="round" stroke-linejoin="round" /></svg></button></div></td>
                    </tr>
                    <tr class="hover:bg-emerald-50/20 transition-colors group">
                        <td class="px-6 py-4"><div class="flex items-center gap-3.5"><img class="w-10 h-10 rounded-xl object-cover shadow-sm shrink-0" src="https://images.unsplash.com/photo-1622483767028-3f66f32aef97?w=100&h=100&fit=crop" alt=""><div><p class="text-sm font-bold text-gray-800">Coca-Cola 33cl</p><p class="text-xs text-gray-400 mt-0.5">Unité: pack (24)</p></div></div></td>
                        <td class="px-6 py-4"><span class="inline-flex items-center gap-1 py-1 px-2.5 rounded-full text-[11px] font-bold bg-blue-50 text-blue-700"><span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>Boissons</span></td>
                        <td class="px-6 py-4"><span class="text-sm font-bold text-amber-600">8 packs</span></td>
                        <td class="px-6 py-4"><span class="text-sm text-gray-500">10 packs</span></td>
                        <td class="px-6 py-4"><span class="inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-amber-100 text-amber-700"><span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>Stock faible</span></td>
                        <td class="px-6 py-4"><div class="flex justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity"><button type="button" aria-label="Modifier" @click="$dispatch('open-modal', { id: 'modal-inventory' })" class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" stroke-linecap="round" stroke-linejoin="round" /></svg></button><button type="button" aria-label="Supprimer" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" stroke-linecap="round" stroke-linejoin="round" /></svg></button></div></td>
                    </tr>
                    <tr class="hover:bg-emerald-50/20 transition-colors group">
                        <td class="px-6 py-4"><div class="flex items-center gap-3.5"><img class="w-10 h-10 rounded-xl object-cover shadow-sm shrink-0" src="https://images.unsplash.com/photo-1550989460-0adf9ea622e2?w=100&h=100&fit=crop" alt=""><div><p class="text-sm font-bold text-gray-800">Huile d'Olive Extra</p><p class="text-xs text-gray-400 mt-0.5">Unité: litre</p></div></div></td>
                        <td class="px-6 py-4"><span class="inline-flex items-center gap-1 py-1 px-2.5 rounded-full text-[11px] font-bold bg-amber-50 text-amber-700"><span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>Épicerie</span></td>
                        <td class="px-6 py-4"><span class="text-sm font-bold text-red-600">0 L</span></td>
                        <td class="px-6 py-4"><span class="text-sm text-gray-500">5 L</span></td>
                        <td class="px-6 py-4"><span class="inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-red-100 text-red-700"><span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>Rupture</span></td>
                        <td class="px-6 py-4"><div class="flex justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity"><button type="button" aria-label="Modifier" @click="$dispatch('open-modal', { id: 'modal-inventory' })" class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" stroke-linecap="round" stroke-linejoin="round" /></svg></button><button type="button" aria-label="Supprimer" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" stroke-linecap="round" stroke-linejoin="round" /></svg></button></div></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Affichage de 1-3 sur 156</span>
            <div class="inline-flex gap-x-1">
                <button type="button" class="py-1.5 px-3 text-xs font-bold text-gray-300 pointer-events-none rounded-lg border border-gray-100 bg-white transition cursor-not-allowed">←</button>
                <button type="button" class="py-1.5 px-3 text-xs font-bold text-gray-600 rounded-lg border border-gray-200 bg-white hover:bg-gray-50 transition">→</button>
            </div>
        </div>
    </div>

    <!-- Inventory Modal -->
    <x-slot:modal>
        <div x-data="{ open: false }" x-init="window.addEventListener('open-modal', e => { if(e.detail.id === 'modal-inventory') open = true }) })"
             @close-modal.window="if($event.detail.id === 'modal-inventory') open = false"
             class="fixed inset-0 z-[80] overflow-x-hidden overflow-y-auto" :class="{ 'pointer-events-none': !open }">
            <div x-show="open" x-cloak x-transition:enter="transition-opacity ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="open = false" class="fixed inset-0 bg-black/40"></div>
            <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4" class="relative min-h-[calc(100%-3.5rem)] flex items-center m-3 sm:mx-auto sm:max-w-xl sm:w-full">
                <div class="w-full flex flex-col bg-white border border-gray-100 shadow-2xl rounded-3xl pointer-events-auto relative">
                    <div class="flex justify-between items-center py-5 px-6 border-b border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 bg-emerald-100 rounded-xl flex items-center justify-center shrink-0"><svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round" /></svg></div>
                            <div><h3 class="font-bold font-heading text-gray-900 leading-none">Nouveau Produit</h3><p class="text-xs text-gray-400 mt-0.5">Ajoutez un article à l'inventaire.</p></div>
                        </div>
                        <button type="button" @click="open = false" class="size-8 inline-flex justify-center items-center rounded-full border border-gray-200 bg-white text-gray-600 hover:bg-gray-50 transition-colors shrink-0"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" /></svg></button>
                    </div>
                    <div class="p-6 space-y-5 overflow-y-auto max-h-[70vh]">
                        <div><label class="block text-sm font-bold text-gray-800 mb-1.5">Nom du produit <span class="text-red-400">*</span></label><input type="text" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" placeholder="Ex: Tomates Bio"></div>
                        <div class="grid grid-cols-2 gap-4">
                            <div><label class="block text-sm font-bold text-gray-800 mb-1.5">Catégorie <span class="text-red-400">*</span></label>
                                <div x-data="{ catOpen: false, selectedCat: 'Produits frais' }" class="relative w-full">
                                    <button type="button" @click="catOpen = !catOpen" class="py-3 px-4 inline-flex items-center justify-between w-full gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-gray-50 text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition text-start"><span x-text="selectedCat"></span><svg class="w-4 h-4 text-gray-400 transition-transform shrink-0" :class="{ 'rotate-180': catOpen }" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" /></svg></button>
                                    <div x-show="catOpen" x-cloak @click.away="catOpen = false" x-transition class="absolute w-full bg-white shadow-xl rounded-2xl border border-gray-100 mt-1 z-[90] p-2">
                                        <button type="button" @click="selectedCat = 'Produits frais'; catOpen = false" class="flex items-center py-2 px-3 rounded-xl text-sm text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">Produits frais</button>
                                        <button type="button" @click="selectedCat = 'Boissons'; catOpen = false" class="flex items-center py-2 px-3 rounded-xl text-sm text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">Boissons</button>
                                        <button type="button" @click="selectedCat = 'Épicerie'; catOpen = false" class="flex items-center py-2 px-3 rounded-xl text-sm text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">Épicerie</button>
                                        <button type="button" @click="selectedCat = 'Viandes'; catOpen = false" class="flex items-center py-2 px-3 rounded-xl text-sm text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">Viandes</button>
                                    </div>
                                </div>
                            </div>
                            <div><label class="block text-sm font-bold text-gray-800 mb-1.5">Unité <span class="text-red-400">*</span></label>
                                <div x-data="{ unitOpen: false, selectedUnit: 'kg' }" class="relative w-full">
                                    <button type="button" @click="unitOpen = !unitOpen" class="py-3 px-4 inline-flex items-center justify-between w-full gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-gray-50 text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition text-start"><span x-text="selectedUnit"></span><svg class="w-4 h-4 text-gray-400 transition-transform shrink-0" :class="{ 'rotate-180': unitOpen }" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" /></svg></button>
                                    <div x-show="unitOpen" x-cloak @click.away="unitOpen = false" x-transition class="absolute w-full bg-white shadow-xl rounded-2xl border border-gray-100 mt-1 z-[90] p-2">
                                        <button type="button" @click="selectedUnit = 'kg'; unitOpen = false" class="flex items-center py-2 px-3 rounded-xl text-sm text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">kg</button>
                                        <button type="button" @click="selectedUnit = 'L'; unitOpen = false" class="flex items-center py-2 px-3 rounded-xl text-sm text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">L</button>
                                        <button type="button" @click="selectedUnit = 'unité'; unitOpen = false" class="flex items-center py-2 px-3 rounded-xl text-sm text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">unité</button>
                                        <button type="button" @click="selectedUnit = 'pack'; unitOpen = false" class="flex items-center py-2 px-3 rounded-xl text-sm text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">pack</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div><label class="block text-sm font-bold text-gray-800 mb-1.5">Quantité <span class="text-red-400">*</span></label><input type="number" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" placeholder="0"></div>
                            <div><label class="block text-sm font-bold text-gray-800 mb-1.5">Stock Minimum <span class="text-red-400">*</span></label><input type="number" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" placeholder="Alerte quand en dessous..."></div>
                        </div>
                        <div><label class="block text-sm font-bold text-gray-800 mb-1.5">Description</label><textarea class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" rows="2" placeholder="Notes sur le produit..."></textarea></div>
                    </div>
                    <div class="flex justify-end items-center gap-3 px-6 py-5 border-t border-gray-100">
                        <button type="button" @click="open = false" class="py-2.5 px-5 text-sm font-semibold text-gray-500 hover:bg-gray-100 rounded-xl transition-colors">Annuler</button>
                        <button type="button" class="py-2.5 px-6 text-sm font-bold inline-flex items-center gap-x-2 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-lg shadow-emerald-200/50 transition-all hover:-translate-y-0.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M4.5 12.75l6 6 9-13.5" stroke-linecap="round" stroke-linejoin="round" /></svg>Créer</button>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:modal>

</x-layouts.admin>
