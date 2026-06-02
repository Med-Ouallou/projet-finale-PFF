<x-layouts.admin :title="'Point de Vente - Resto Admin'" :breadcrumb="'POS'">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 h-[calc(100vh-200px)]">
        <!-- Menu Items -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-lg font-bold font-heading text-gray-900">Menu</h2>
                <p class="text-sm text-gray-500">Sélectionnez les articles à ajouter</p>
            </div>
            <div class="p-6 overflow-y-auto flex-1">
                <!-- Category Tabs -->
                <div class="flex gap-2 mb-6 overflow-x-auto pb-2">
                    <button class="shrink-0 py-2 px-4 text-xs font-bold rounded-full bg-emerald-600 text-white">Tout</button>
                    <button class="shrink-0 py-2 px-4 text-xs font-bold rounded-full bg-white text-gray-600 border border-gray-200 hover:border-emerald-300">Entrées</button>
                    <button class="shrink-0 py-2 px-4 text-xs font-bold rounded-full bg-white text-gray-600 border border-gray-200 hover:border-emerald-300">Plats</button>
                    <button class="shrink-0 py-2 px-4 text-xs font-bold rounded-full bg-white text-gray-600 border border-gray-200 hover:border-emerald-300">Desserts</button>
                    <button class="shrink-0 py-2 px-4 text-xs font-bold rounded-full bg-white text-gray-600 border border-gray-200 hover:border-emerald-300">Boissons</button>
                </div>

                <!-- Items Grid -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <button class="group p-4 bg-gray-50 rounded-2xl border border-gray-100 hover:border-emerald-300 hover:bg-emerald-50/50 transition-all text-start">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center text-lg">🥗</div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">Salade César</p>
                                <p class="text-xs text-emerald-600 font-bold">45.00 DH</p>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 line-clamp-1">Poulet grillé, parmesan, croûtons</p>
                    </button>
                    <button class="group p-4 bg-gray-50 rounded-2xl border border-gray-100 hover:border-emerald-300 hover:bg-emerald-50/50 transition-all text-start">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center text-lg">🍔</div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">Burger Classic</p>
                                <p class="text-xs text-emerald-600 font-bold">65.00 DH</p>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 line-clamp-1">Bœuf, cheddar, bacon</p>
                    </button>
                    <button class="group p-4 bg-gray-50 rounded-2xl border border-gray-100 hover:border-emerald-300 hover:bg-emerald-50/50 transition-all text-start">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center text-lg">🥤</div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">Coca-Cola</p>
                                <p class="text-xs text-emerald-600 font-bold">15.00 DH</p>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 line-clamp-1">33cl</p>
                    </button>
                </div>
            </div>
        </div>

        <!-- Cart -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-lg font-bold font-heading text-gray-900">Panier</h2>
                <p class="text-sm text-gray-500">Commande en cours</p>
            </div>
            <div class="flex-1 overflow-y-auto p-6">
                <div class="flex flex-col items-center justify-center h-full text-center text-gray-400">
                    <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <p class="text-sm font-medium">Panier vide</p>
                    <p class="text-xs mt-1">Ajoutez des articles depuis le menu</p>
                </div>
            </div>
            <div class="p-6 border-t border-gray-100 bg-gray-50/50">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-sm font-bold text-gray-600">Total</span>
                    <span class="text-xl font-black font-heading text-emerald-700">0.00 DH</span>
                </div>
                <button type="button" disabled class="w-full py-3 px-6 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 disabled:opacity-50 disabled:cursor-not-allowed transition-all">
                    Finaliser la commande
                </button>
            </div>
        </div>
    </div>

</x-layouts.admin>
