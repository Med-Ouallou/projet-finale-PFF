<x-layouts.admin :title="'Inventaire - Resto Admin'" :breadcrumb="'Gestion de l\'Inventaire'">
    <div x-data="inventoryApp({ items: @js($items), filters: @js($filters), lowStockCount: {{ $lowStockCount }} })" x-init="init()">
    @php
        $totalItems = $items->count();
        $lowStockItems = $items->filter(fn($item) => $item->quantity_in_stock <= $item->min_threshold)->count();
        $goodStockItems = $totalItems - $lowStockItems;
        $totalValue = $items->sum(fn($item) => $item->quantity_in_stock * $item->unit_price);
    @endphp

    <!-- KPI Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-slate-100 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-gray-900" x-text="filteredItems.length">{{ $totalItems }}</p>
            <p class="text-xs text-gray-400 font-medium">Total articles</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-emerald-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-emerald-600" x-text="filteredItems.filter(i => i.quantity_in_stock > i.min_threshold).length">{{ $goodStockItems }}</p>
            <p class="text-xs text-gray-400 font-medium">Stock OK</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-amber-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-amber-600" x-text="filteredItems.filter(i => i.quantity_in_stock <= i.min_threshold).length">{{ $lowStockItems }}</p>
            <p class="text-xs text-gray-400 font-medium">Stock faible</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.003 0l.194.148" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-gray-900">{{ number_format($totalValue, 2) }}</p>
            <p class="text-xs text-gray-400 font-medium">Valeur totale (DH)</p>
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
                placeholder="Rechercher un article...">
        </div>
        <div class="flex gap-2">
            <button type="button" @click="showCreateModal = true"
                class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-md shadow-emerald-200/50 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Ajouter
            </button>
            <label class="flex items-center gap-2 py-2.5 px-3.5 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-700 shadow-sm cursor-pointer hover:bg-gray-50 transition">
                <input type="checkbox" x-model="lowStockOnly" @change="applyFilters()">
                Stock faible uniquement
            </label>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50/80 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Article</th>
                        <th class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Référence</th>
                        <th class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Stock</th>
                        <th class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Seuil</th>
                        <th class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Prix unitaire</th>
                        <th class="px-6 py-3.5 text-end text-[10px] font-bold uppercase text-gray-400 tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <template x-for="item in filteredItems" :key="item.id">
                        <tr :class="['hover:bg-emerald-50/20 transition-colors group', item.quantity_in_stock <= item.min_threshold ? 'bg-amber-50/30' : '']">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div :class="['w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold', item.quantity_in_stock <= item.min_threshold ? 'bg-amber-100 text-amber-600' : 'bg-emerald-100 text-emerald-600']" x-text="item.name ? item.name.substring(0, 1).toUpperCase() : '?'">
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800" x-text="item.name"></p>
                                        <p class="text-xs text-gray-400" x-text="item.unit"></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <code class="text-xs bg-gray-100 px-2 py-1 rounded" x-text="item.reference"></code>
                            </td>
                            <td class="px-6 py-4">
                                <span :class="['text-sm font-bold', item.quantity_in_stock <= item.min_threshold ? 'text-amber-600' : 'text-gray-800']">
                                    <span x-text="item.quantity_in_stock + ' ' + item.unit"></span>
                                </span>
                                <span x-show="item.quantity_in_stock <= item.min_threshold" class="ml-2 text-xs text-amber-600 font-medium">⚠️ Faible</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-600" x-text="item.min_threshold + ' ' + item.unit"></span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium text-gray-800" x-text="Number(item.unit_price).toFixed(2) + ' DH'"></span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a :href="`/admin/inventory/${item.id}/edit`" class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                    <button type="button" @click="deleteItem(item.id)" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="filteredItems.length === 0">
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">Aucun article trouvé</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function inventoryApp(initialData) {
            return {
                allItems: initialData.items || [],
                search: '',
                lowStockOnly: initialData.filters?.low_stock || false,
                showCreateModal: false,
                filteredItems: [],
                
                init() {
                    this.applyFilters();
                },
                
                applyFilters() {
                    this.filteredItems = this.allItems.filter(item => {
                        const searchTerm = this.search.toLowerCase();
                        const matchesSearch = !this.search || 
                            (item.name && item.name.toLowerCase().includes(searchTerm)) ||
                            (item.reference && item.reference.toLowerCase().includes(searchTerm));
                        const matchesLowStock = !this.lowStockOnly || 
                            item.quantity_in_stock <= item.min_threshold;
                        return matchesSearch && matchesLowStock;
                    });
                },
                
                deleteItem(id) {
                    showConfirm('Supprimer cet article ?', async () => {
                        try {
                            const response = await fetch(`/admin/inventory/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                                    'Accept': 'application/json',
                                }
                            });
                            if (response.ok) {
                                this.allItems = this.allItems.filter(i => i.id !== id);
                                this.applyFilters();
                                showAlert('Article supprimé avec succès', 'success');
                            } else {
                                const data = await response.json();
                                showAlert(data.message || 'Erreur lors de la suppression', 'error');
                            }
                        } catch (error) {
                            console.error('Error deleting item:', error);
                        }
                    }, { type: 'warning', title: 'Confirmation de suppression' });
                }
            }
        }
    </script>

    <!-- Create Modal -->
    <div id="create-modal" class="fixed inset-0 z-[80] @if($errors->any()) @else hidden @endif">
        <div class="fixed inset-0 bg-black/40" onclick="document.getElementById('create-modal').classList.add('hidden')"></div>
        <div class="relative min-h-[calc(100%-3.5rem)] flex items-center m-3 sm:mx-auto sm:max-w-lg sm:w-full">
            <div class="w-full flex flex-col bg-white border border-gray-100 shadow-2xl rounded-3xl pointer-events-auto relative">
                <div class="flex justify-between items-center py-5 px-6 border-b border-gray-100">
                    <h3 class="font-bold font-heading text-gray-900">Nouvel article</h3>
                    <button onclick="document.getElementById('create-modal').classList.add('hidden')" class="size-8 inline-flex justify-center items-center rounded-full border border-gray-200 bg-white text-gray-600 hover:bg-gray-50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <form method="POST" action="{{ route('admin.inventory.store') }}" class="p-6 space-y-4">
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
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Nom <span class="text-red-400">*</span></label>
                            <input type="text" name="name" required class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Référence <span class="text-red-400">*</span></label>
                            <input type="text" name="reference" required class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Quantité <span class="text-red-400">*</span></label>
                            <input type="number" name="quantity_in_stock" min="0" required class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Seuil min <span class="text-red-400">*</span></label>
                            <input type="number" name="min_threshold" min="0" required class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Unité <span class="text-red-400">*</span></label>
                            <select name="unit" required class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                                <option value="kg">kg</option>
                                <option value="g">g</option>
                                <option value="l">l</option>
                                <option value="ml">ml</option>
                                <option value="unité">unité</option>
                                <option value="pièce">pièce</option>
                                <option value="botte">botte</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Prix unitaire <span class="text-red-400">*</span></label>
                            <input type="number" name="unit_price" step="0.01" min="0" required class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                        </div>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="button" onclick="document.getElementById('create-modal').classList.add('hidden')" class="flex-1 py-3.5 px-4 text-center text-sm font-semibold rounded-xl border border-gray-200 text-gray-700 bg-white hover:bg-gray-50">Annuler</button>
                        <button type="submit" class="flex-1 py-3.5 px-4 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700">Créer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layouts.admin>
