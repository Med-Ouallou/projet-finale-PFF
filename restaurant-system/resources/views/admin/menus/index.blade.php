<x-layouts.admin :title="'Menus - Resto Admin'" :breadcrumb="'Gestion des Menus'">
    <div x-data="menusApp({ menus: @js($menus), filters: @js($filters) })" x-init="init()">
    @php
        $totalMenus = $menus->count();
        $activeMenus = $menus->where('is_active', true)->count();
    @endphp

    <!-- KPI Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-slate-100 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
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
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex flex-col sm:flex-row gap-3 items-stretch sm:items-center justify-between">
        <div class="relative flex-1 max-w-xs">
            <input type="text" x-model="search" @input.debounce.300ms="applyFilters()"
                class="py-2.5 ps-4 pe-4 block w-full bg-gray-50 border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500 transition-shadow"
                placeholder="Rechercher un menu...">
        </div>
        <div class="flex gap-2">
            <button type="button" @click="showCreateModal = true"
                class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-md shadow-emerald-200/50 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Ajouter
            </button>
            <select x-model="statusFilter" @change="applyFilters()"
                class="py-2.5 px-3.5 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all">
                <option value="">Tous les statuts</option>
                <option value="1">Actif</option>
                <option value="0">Inactif</option>
            </select>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50/80 border-b border-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Image</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Nom</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Description</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Ordre</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Statut</th>
                        <th scope="col" class="px-6 py-3.5 text-end text-[10px] font-bold uppercase text-gray-400 tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <template x-for="menu in filteredMenus" :key="menu.id">
                        <tr class="hover:bg-emerald-50/20 transition-colors group">
                            <td class="px-6 py-4">
                                <template x-if="menu.image_url">
                                    <img :src="`/storage/${menu.image_url}`" class="w-10 h-10 rounded-lg object-cover">
                                </template>
                                <template x-if="!menu.image_url">
                                    <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 text-xs font-bold" x-text="menu.name ? menu.name.substring(0, 1).toUpperCase() : '?'">
                                    </div>
                                </template>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-sm font-bold text-gray-800" x-text="menu.name"></p>
                                    <p class="text-xs text-gray-400" x-text="menu.currency || 'MAD'"></p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-600 truncate max-w-xs block" x-text="menu.description || '-'"></span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium text-gray-800" x-text="menu.display_order || 0"></span>
                            </td>
                            <td class="px-6 py-4">
                                <button @click="toggleStatus(menu.id)" 
                                    :class="menu.is_active ? 'inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700' : 'inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-gray-100 text-gray-700'"
                                    x-text="menu.is_active ? 'Actif' : 'Inactif'">
                                </button>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a :href="`/admin/menus/${menu.id}/edit`"
                                        class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                    <button @click="deleteMenu(menu.id)" class="p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
            <div x-show="filteredMenus.length === 0" class="p-8 text-center text-gray-400">
                Aucun menu trouvé
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div x-show="showCreateModal" x-cloak style="display: none;" class="fixed inset-0 z-[80]">
        <div class="fixed inset-0 bg-black/40" @click="showCreateModal = false"></div>
        <div class="relative min-h-[calc(100%-3.5rem)] flex items-center m-3 sm:mx-auto sm:max-w-lg sm:w-full">
            <div class="w-full bg-white border border-gray-100 shadow-2xl rounded-3xl">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900">Ajouter un Menu</h3>
                    <button @click="showCreateModal = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nom <span class="text-rose-400">*</span></label>
                        <input type="text" name="name" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-gray-900 focus:border-emerald-500 focus:ring-emerald-500">
                        @error('name')<p class="text-rose-400 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-gray-900 focus:border-emerald-500 focus:ring-emerald-500"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Devise</label>
                            <input type="text" name="currency" value="MAD" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-gray-900 focus:border-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ordre</label>
                            <input type="number" name="display_order" value="0" min="0" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-gray-900 focus:border-emerald-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                        <input type="file" name="image" accept="image/*" class="w-full text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-emerald-600 file:text-white hover:file:bg-emerald-700">
                    </div>
                    <div class="flex justify-end gap-3 pt-4">
                        <button type="button" @click="showCreateModal = false" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-medium transition-colors">Annuler</button>
                        <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-medium shadow-md shadow-emerald-200/50 transition-all">Créer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function menusApp(config) {
            return {
                showCreateModal: false,
                allMenus: config.menus || [],
                filteredMenus: [],
                filters: config.filters || {},
                search: '',
                statusFilter: '',
                
                init() {
                    @if($errors->any())
                        this.showCreateModal = true;
                    @endif
                    this.applyFilters();
                },
                
                applyFilters() {
                    this.filteredMenus = this.allMenus.filter(menu => {
                        if (this.search && !menu.name.toLowerCase().includes(this.search.toLowerCase())) {
                            return false;
                        }
                        if (this.statusFilter !== '' && menu.is_active !== (this.statusFilter === '1')) {
                            return false;
                        }
                        return true;
                    });
                },
                
                resetFilters() {
                    this.search = '';
                    this.statusFilter = '';
                    this.applyFilters();
                },
                
                async deleteMenu(id) {
                    if (!confirm('Supprimer ce menu ?')) return;
                    try {
                        const response = await fetch(`/admin/menus/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                                'Accept': 'application/json',
                            }
                        });
                        const data = await response.json();
                        if (response.ok && data.success) {
                            this.allMenus = this.allMenus.filter(m => m.id !== id);
                            this.applyFilters();
                        } else {
                            alert(data.message || 'Erreur lors de la suppression');
                        }
                    } catch (error) {
                        console.error('Error deleting menu:', error);
                    }
                },
                
                async toggleStatus(id) {
                    try {
                        const response = await fetch(`/admin/menus/${id}/toggle`, {
                            method: 'PATCH',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                                'Accept': 'application/json',
                            }
                        });
                        if (response.ok) {
                            const menu = this.allMenus.find(m => m.id === id);
                            if (menu) menu.is_active = !menu.is_active;
                            this.applyFilters();
                        }
                    } catch (error) {
                        console.error('Error toggling status:', error);
                    }
                }
            }
        }
    </script>
</x-layouts.admin>
