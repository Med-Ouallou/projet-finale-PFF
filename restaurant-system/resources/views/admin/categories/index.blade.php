<x-layouts.admin :title="'Catégories - Resto Admin'" :breadcrumb="'Gestion des Catégories'">
    <div x-data="categoriesApp({ categories: @js($categories), menus: @js($menus), filters: @js($filters) })" x-init="init()">
    @php
        $totalCategories = $categories->count();
        $activeCategories = $categories->where('is_active', true)->count();
        $inactiveCategories = $categories->where('is_active', false)->count();
        $menusCount = $menus->count();
    @endphp

    <!-- KPI Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-slate-100 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-gray-900" x-text="filteredCategories.length">{{ $totalCategories }}</p>
            <p class="text-xs text-gray-400 font-medium">Total catégories</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-emerald-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-emerald-600" x-text="filteredCategories.filter(c => c.is_active).length">{{ $activeCategories }}</p>
            <p class="text-xs text-gray-400 font-medium">Actives</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-red-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-red-500" x-text="filteredCategories.filter(c => !c.is_active).length">{{ $inactiveCategories }}</p>
            <p class="text-xs text-gray-400 font-medium">Inactives</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-amber-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-gray-900">{{ $menusCount }}</p>
            <p class="text-xs text-gray-400 font-medium">Menus</p>
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
                placeholder="Rechercher une catégorie...">
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
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50/80 border-b border-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Nom</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Menu</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Ordre</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Statut</th>
                        <th scope="col" class="px-6 py-3.5 text-end text-[10px] font-bold uppercase text-gray-400 tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <template x-for="category in filteredCategories" :key="category.id">
                        <tr class="hover:bg-emerald-50/20 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <template x-if="category.icon_url">
                                        <img :src="category.icon_url" class="w-8 h-8 rounded-lg object-cover">
                                    </template>
                                    <template x-if="!category.icon_url">
                                        <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 text-xs font-bold" x-text="category.name ? category.name.substring(0, 1).toUpperCase() : '?'">
                                        </div>
                                    </template>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800" x-text="category.name"></p>
                                        <p class="text-xs text-gray-400" x-text="category.description ? category.description.substring(0, 30) : ''"></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-600" x-text="category.menu?.name || '-'"></span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium text-gray-800" x-text="category.display_order || 0"></span>
                            </td>
                            <td class="px-6 py-4">
                                <span :class="category.is_active ? 'inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700' : 'inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-gray-100 text-gray-700'" x-text="category.is_active ? 'Actif' : 'Inactif'"></span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a :href="`/admin/categories/${category.id}/edit`"
                                        class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                    <button type="button" @click="toggleActive(category.id)" class="p-2 text-gray-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                    <button type="button" @click="deleteCategory(category.id)" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="filteredCategories.length === 0">
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">Aucune catégorie trouvée</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function categoriesApp(initialData) {
            return {
                allCategories: initialData.categories || [],
                menus: initialData.menus || [],
                search: '',
                statusFilter: initialData.filters?.is_active || '',
                showCreateModal: false,
                filteredCategories: [],
                
                init() {
                    this.applyFilters();
                    @if($errors->any()) this.showCreateModal = true; @endif
                },
                
                applyFilters() {
                    this.filteredCategories = this.allCategories.filter(category => {
                        const matchesSearch = !this.search || 
                            (category.name && category.name.toLowerCase().includes(this.search.toLowerCase()));
                        const matchesStatus = this.statusFilter === '' || 
                            category.is_active == (this.statusFilter === '1');
                        return matchesSearch && matchesStatus;
                    });
                },
                
                async toggleActive(id) {
                    try {
                        const response = await fetch(`/admin/categories/${id}/toggle`, {
                            method: 'PATCH',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                                'Accept': 'application/json',
                            }
                        });
                        if (response.ok) {
                            const category = this.allCategories.find(c => c.id === id);
                            if (category) {
                                category.is_active = !category.is_active;
                                this.applyFilters();
                            }
                        }
                    } catch (error) {
                        console.error('Error toggling status:', error);
                    }
                },
                
                deleteCategory(id) {
                    showConfirm('Supprimer cette catégorie ?', async () => {
                        try {
                            const response = await fetch(`/admin/categories/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                                    'Accept': 'application/json',
                                }
                            });
                            const data = await response.json();
                            if (response.ok && data.success) {
                                this.allCategories = this.allCategories.filter(c => c.id !== id);
                                this.applyFilters();
                                showAlert('Catégorie supprimée avec succès', 'success');
                            } else {
                                showAlert(data.message || 'Erreur lors de la suppression', 'error');
                            }
                        } catch (error) {
                            console.error('Error deleting category:', error);
                        }
                    }, { type: 'warning', title: 'Confirmation de suppression' });
                }
            }
        }
    </script>

    <!-- Create Modal -->
    <div id="create-modal" x-show="showCreateModal" x-cloak style="display: none;" class="fixed inset-0 z-[80]">
        <div class="fixed inset-0 bg-black/40" @click="showCreateModal = false"></div>
        <div class="relative min-h-[calc(100%-3.5rem)] flex items-center m-3 sm:mx-auto sm:max-w-lg sm:w-full">
            <div class="w-full flex flex-col bg-white border border-gray-100 shadow-2xl rounded-3xl pointer-events-auto relative">
                <div class="flex justify-between items-center py-5 px-6 border-b border-gray-100">
                    <h3 class="font-bold font-heading text-gray-900">Nouvelle catégorie</h3>
                    <button type="button" @click="showCreateModal = false" class="size-8 inline-flex justify-center items-center rounded-full border border-gray-200 bg-white text-gray-600 hover:bg-gray-50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <form method="POST" action="{{ route('admin.categories.store') }}" class="p-6 space-y-4">
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
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Nom <span class="text-red-400">*</span></label>
                        <input type="text" name="name" required class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Menu <span class="text-red-400">*</span></label>
                        <select name="menu_id" required class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                            <option value="">Sélectionner...</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Description</label>
                        <textarea name="description" rows="2" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition"></textarea>
                    </div>
                    <div class="flex gap-2">
                        <div class="flex-1">
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Ordre d'affichage</label>
                            <input type="number" name="display_order" min="0" value="0" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Actif</label>
                            <select name="is_active" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="button" @click="showCreateModal = false" class="flex-1 py-3.5 px-4 text-center text-sm font-semibold rounded-xl border border-gray-200 text-gray-700 bg-white hover:bg-gray-50">Annuler</button>
                        <button type="submit" class="flex-1 py-3.5 px-4 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700">Créer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layouts.admin>
