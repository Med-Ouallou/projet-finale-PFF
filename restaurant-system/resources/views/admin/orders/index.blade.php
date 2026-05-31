<x-layouts.admin :title="'Commandes - Resto Admin'" :breadcrumb="'Gestion des Commandes'">

    <div x-data="ordersApp({ orders: @js($orders), filters: @js($filters) })" x-init="init()">
        <!-- Filters Bar -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex flex-col sm:flex-row gap-3 items-stretch sm:items-center justify-between mb-6">
            <div class="flex gap-2">
                <div class="w-48">
                    <x-ui.select name="status" x-model="filters.status" @change="applyFilters()"
                        class="py-2.5 px-3.5 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all">
                        <option value="">Tous les statuts</option>
                        <option value="pending">En attente</option>
                        <option value="preparing">En préparation</option>
                        <option value="ready">Prête</option>
                        <option value="delivered">Livrée</option>
                        <option value="cancelled">Annulée</option>
                    </x-ui.select>
                </div>
                <div class="w-40" @change="filters.date_from = $event.target.value; applyFilters()">
                    <x-ui.datepicker name="date_from" value="{{ $filters['date_from'] ?? '' }}" placeholder="Date de début" />
                </div>
                <div class="w-40" @change="filters.date_to = $event.target.value; applyFilters()">
                    <x-ui.datepicker name="date_to" value="{{ $filters['date_to'] ?? '' }}" placeholder="Date de fin" />
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-6 relative">
            <div x-show="isLoading" class="absolute inset-0 bg-white/50 backdrop-blur-[1px] flex items-center justify-center z-10" style="display: none;">
                <div class="animate-spin inline-block size-6 border-[3px] border-current border-t-transparent text-emerald-600 rounded-full" role="status" aria-label="loading">
                    <span class="sr-only">Chargement...</span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50/80 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Commande</th>
                            <th class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Client</th>
                            <th class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Articles</th>
                            <th class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Total</th>
                            <th class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Statut</th>
                            <th class="px-6 py-3.5 text-end text-[10px] font-bold uppercase text-gray-400 tracking-widest">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <template x-for="order in orders" :key="order.id">
                            <tr class="hover:bg-emerald-50/20 transition-colors group">
                                <td class="px-6 py-4">
                                    <span class="text-sm font-bold text-gray-900" x-text="'#' + order.id"></span>
                                    <p class="text-xs text-gray-400" x-text="formatDate(order.created_at)"></p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-xs font-bold text-emerald-600" x-text="order.customer?.name ? order.customer.name.substring(0, 1).toUpperCase() : '?'">
                                        </div>
                                        <span class="text-sm font-medium text-gray-800" x-text="order.customer?.name || 'Client inconnu'"></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-600" x-text="(order.order_items ? order.order_items.length : 0) + ' article(s)'"></span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-bold text-gray-800" x-text="parseFloat(order.total_amount).toFixed(2) + ' DH'"></span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center py-1 px-2.5 rounded-full text-xs font-bold" :class="getStatusClass(order.status)" x-text="getStatusLabel(order.status)">
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button type="button" @click="openDetailModal(order)"
                                            class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition"
                                            title="Voir détails">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                        <template x-if="order.status !== 'cancelled' && order.status !== 'delivered'">
                                            <button type="button" @click="cancelOrder(order.id)"
                                                class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition" title="Annuler">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </template>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="orders.length === 0">
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">Aucune commande trouvée</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between" x-show="pagination.last_page > 1">
                <div class="flex-1 flex justify-between sm:hidden">
                    <button @click="applyFilters(pagination.current_page - 1)" :disabled="!pagination.prev_page_url" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50">
                        Précédent
                    </button>
                    <button @click="applyFilters(pagination.current_page + 1)" :disabled="!pagination.next_page_url" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50">
                        Suivant
                    </button>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Affichage de <span class="font-medium" x-text="pagination.from || 0"></span> à <span class="font-medium" x-text="pagination.to || 0"></span> sur <span class="font-medium" x-text="pagination.total || 0"></span> commandes
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <button @click="applyFilters(pagination.current_page - 1)" :disabled="!pagination.prev_page_url" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50">
                                <span class="sr-only">Précédent</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            </button>
                            
                            <template x-for="page in Array.from({length: pagination.last_page}, (_, i) => i + 1)" :key="page">
                                <button @click="applyFilters(page)" 
                                    :class="page === pagination.current_page ? 'z-10 bg-emerald-50 border-emerald-500 text-emerald-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium'"
                                    x-text="page">
                                </button>
                            </template>

                            <button @click="applyFilters(pagination.current_page + 1)" :disabled="!pagination.next_page_url" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50">
                                <span class="sr-only">Suivant</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Detail Modal -->
        <div x-show="showDetailModal" 
            class="fixed inset-0 z-[80] overflow-x-hidden overflow-y-auto bg-slate-900/40 backdrop-blur-md flex items-center justify-center p-3 sm:p-6"
            style="display: none;"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            
            <div @click.outside="showDetailModal = false" 
                class="w-full sm:max-w-lg bg-white border border-gray-100/80 shadow-2xl rounded-3xl overflow-hidden relative flex flex-col max-h-[90vh]"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4">
                
                <!-- Header -->
                <div class="flex justify-between items-center py-5 px-6 border-b border-gray-100/60 shrink-0 bg-white">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-50 rounded-2xl flex items-center justify-center shrink-0 border border-emerald-100">
                            <svg class="w-5.5 h-5.5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-extrabold font-heading text-gray-900 text-base" x-text="'Commande #' + (selectedOrder ? selectedOrder.id : '')"></h3>
                            <p class="text-xs text-gray-400 font-medium mt-0.5" x-text="selectedOrder ? 'Passée le ' + formatDate(selectedOrder.created_at) : ''"></p>
                        </div>
                    </div>
                    <button type="button" @click="showDetailModal = false" class="size-8 inline-flex justify-center items-center rounded-full border border-gray-100 bg-white text-gray-400 hover:text-gray-600 hover:scale-105 transition-all shrink-0 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>

                <!-- Content -->
                <div class="p-6 space-y-6 overflow-y-auto flex-1 bg-gray-50/20" x-show="selectedOrder">
                    <template x-if="selectedOrder">
                        <div class="space-y-6">
                            <!-- Status Card -->
                            <div class="p-5 bg-white rounded-2xl border border-gray-100 shadow-sm space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-bold text-gray-700">Statut de la commande</span>
                                    <span class="inline-flex items-center py-1 px-3 rounded-full text-xs font-bold shadow-sm" 
                                        :class="getStatusClass(selectedOrder.status)" 
                                        x-text="getStatusLabel(selectedOrder.status)">
                                    </span>
                                </div>
                                
                                <template x-if="selectedOrder.status !== 'cancelled' && selectedOrder.status !== 'delivered'">
                                    <div class="flex items-center justify-between gap-4 pt-3 border-t border-gray-100">
                                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Mettre à jour</label>
                                        <div class="w-40">
                                            <x-ui.select id="modal-order-status-select" x-bind:value="selectedOrder.status" 
                                                @change="updateOrderStatus(selectedOrder.id, $event.target.value)">
                                                <option value="pending">En attente</option>
                                                <option value="preparing">En préparation</option>
                                                <option value="ready">Prête</option>
                                                <option value="delivered">Livrée</option>
                                            </x-ui.select>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <!-- Customer Info Card -->
                            <div class="p-5 bg-white rounded-2xl border border-gray-100 shadow-sm space-y-3">
                                <h4 class="text-xs font-extrabold uppercase text-gray-400 tracking-wider">Client</h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-[10px] uppercase font-bold text-gray-400">Nom complet</p>
                                        <p class="text-sm font-bold text-gray-800 mt-0.5" x-text="selectedOrder.customer?.name || 'Client inconnu'"></p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] uppercase font-bold text-gray-400">Téléphone</p>
                                        <p class="text-sm font-bold text-gray-800 mt-0.5" x-text="selectedOrder.customer?.phone || '-'"></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Ordered Items List -->
                            <div class="p-5 bg-white rounded-2xl border border-gray-100 shadow-sm space-y-3">
                                <h4 class="text-xs font-extrabold uppercase text-gray-400 tracking-wider">Plats Commandés</h4>
                                <div class="divide-y divide-gray-100/70 max-h-56 overflow-y-auto pr-1">
                                    <template x-for="item in selectedOrder.order_items" :key="item.id">
                                        <div class="flex justify-between items-center py-3.5 first:pt-0 last:pb-0">
                                            <div class="space-y-1">
                                                <p class="text-sm font-bold text-gray-800" x-text="item.menu_item?.name"></p>
                                                <p class="text-xs text-gray-400 font-medium" x-text="parseFloat(item.unit_price_at_order).toFixed(2) + ' DH × ' + item.quantity"></p>
                                            </div>
                                            <p class="text-sm font-bold text-gray-900" x-text="parseFloat(item.subtotal).toFixed(2) + ' DH'"></p>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Billing Summary -->
                            <div class="p-5 bg-gradient-to-br from-emerald-50/30 to-emerald-50/60 rounded-2xl border border-emerald-100/50 shadow-sm space-y-3.5">
                                <div class="flex justify-between text-xs text-gray-500 font-medium">
                                    <span>Sous-total</span>
                                    <span class="font-bold text-gray-800" x-text="parseFloat(selectedOrder.subtotal).toFixed(2) + ' DH'"></span>
                                </div>
                                <template x-if="parseFloat(selectedOrder.discount_amount) > 0">
                                    <div class="flex justify-between text-xs text-red-600 font-medium">
                                        <span>Remise appliqué</span>
                                        <span class="font-bold" x-text="'-' + parseFloat(selectedOrder.discount_amount).toFixed(2) + ' DH'"></span>
                                    </div>
                                </template>
                                <div class="flex justify-between text-base font-extrabold text-gray-900 pt-3 border-t border-dashed border-emerald-200/80">
                                    <span class="text-gray-800">Total net</span>
                                    <span class="text-emerald-600 text-lg" x-text="parseFloat(selectedOrder.total_amount).toFixed(2) + ' DH'"></span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Footer -->
                <div class="p-5 border-t border-gray-100 flex justify-between shrink-0 bg-white shadow-inner">
                    <button type="button" @click="showDetailModal = false" class="py-2.5 px-5 text-sm font-bold rounded-xl border border-gray-200 text-gray-700 bg-white hover:bg-gray-50 shadow-sm transition">
                        Fermer
                    </button>
                    <template x-if="selectedOrder && selectedOrder.status !== 'cancelled' && selectedOrder.status !== 'delivered'">
                        <button type="button" @click="cancelOrder(selectedOrder.id); showDetailModal = false;" class="py-2.5 px-5 text-sm font-bold rounded-xl bg-red-50 text-red-700 hover:bg-red-100 border border-red-100 shadow-sm transition">
                            Annuler la commande
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </div>

</x-layouts.admin>
