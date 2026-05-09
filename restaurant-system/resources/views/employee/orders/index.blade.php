<x-layouts.admin :title="'Commandes - Resto Admin'" :breadcrumb="'Gestion des Commandes'">

    <!-- Filters -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex flex-col sm:flex-row gap-3 items-stretch sm:items-center justify-between">
        <div class="relative flex-1 max-w-xs">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <input type="text" class="py-2.5 ps-10 pe-4 block w-full bg-gray-50 border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500 transition-shadow" placeholder="Rechercher une commande...">
        </div>
        <div class="flex gap-2">
            <div x-data="{ open: false, selected: 'Tous les statuts' }" class="relative inline-flex">
                <button type="button" @click="open = !open" class="py-2.5 px-3.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-700 shadow-sm hover:bg-gray-50 transition-all">
                    <span x-text="selected"></span>
                    <svg class="w-3.5 h-3.5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <div x-show="open" x-cloak @click.away="open = false" x-transition class="absolute end-0 min-w-[180px] bg-white shadow-xl rounded-2xl border border-gray-100 mt-2 z-[80] p-2">
                    <button type="button" @click="selected = 'Tous les statuts'; open = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 w-full text-start">Tous</button>
                    <button type="button" @click="selected = 'En attente'; open = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-amber-700 hover:bg-amber-50 w-full text-start">En attente</button>
                    <button type="button" @click="selected = 'En préparation'; open = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-blue-700 hover:bg-blue-50 w-full text-start">En préparation</button>
                    <button type="button" @click="selected = 'Prête'; open = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-emerald-700 hover:bg-emerald-50 w-full text-start">Prête</button>
                    <button type="button" @click="selected = 'Livrée'; open = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 w-full text-start">Livrée</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50/80 border-b border-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">N° Commande</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Client</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Date</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Total</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Statut</th>
                        <th scope="col" class="px-6 py-3.5 text-end text-[10px] font-bold uppercase text-gray-400 tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <tr class="hover:bg-emerald-50/20 transition-colors group">
                        <td class="px-6 py-4"><span class="text-sm font-bold text-gray-900">#ORD-001</span></td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-xs font-bold text-emerald-600">JD</div>
                                <span class="text-sm font-medium text-gray-800">Jean Dupont</span>
                            </div>
                        </td>
                        <td class="px-6 py-4"><span class="text-sm text-gray-600">09/05/2026 14:30</span></td>
                        <td class="px-6 py-4"><span class="text-sm font-bold text-gray-900">45.00 DH</span></td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-amber-100 text-amber-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>En attente
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-1">
                                <a href="#" class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Affichage de 1-1 sur 1</span>
            <div class="inline-flex gap-x-1">
                <button type="button" class="py-1.5 px-3 text-xs font-bold text-gray-300 pointer-events-none rounded-lg border border-gray-100 bg-white transition cursor-not-allowed">←</button>
                <button type="button" class="py-1.5 px-3 text-xs font-bold text-gray-300 pointer-events-none rounded-lg border border-gray-100 bg-white transition cursor-not-allowed">→</button>
            </div>
        </div>
    </div>

</x-layouts.admin>
