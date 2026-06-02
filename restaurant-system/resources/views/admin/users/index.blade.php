<x-layouts.admin :title="'Utilisateurs - Resto Admin'" :breadcrumb="'Gestion des Utilisateurs'">
    <div x-data="usersApp({ users: @js($users), filters: @js($filters), authId: {{ auth()->id() }} })" x-init="init()">
    @php
        $totalUsers = $users->count();
        $adminUsers = $users->filter(fn($u) => $u->isAdmin())->count();
        $employeeUsers = $users->filter(fn($u) => $u->isEmployee())->count();
        $customerUsers = $users->filter(fn($u) => $u->isCustomer())->count();
    @endphp

    <!-- KPI Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-slate-100 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.538-2.378m0 0A5.998 5.998 0 0112 12c2.21 0 4 .805 5.197 2.12" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-gray-900" x-text="filteredUsers.length">{{ $totalUsers }}</p>
            <p class="text-xs text-gray-400 font-medium">Total utilisateurs</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-emerald-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-emerald-600" x-text="filteredUsers.filter(u => u.role_name === 'admin').length">{{ $adminUsers }}</p>
            <p class="text-xs text-gray-400 font-medium">Administrateurs</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 3.147V3.587c0-1.081-.768-2.015-1.837-2.175a48.111 48.111 0 00-3.413-.387m1.5 3.147a2.25 2.25 0 01-1.5 3.147m-12 0a2.25 2.25 0 011.5-3.147m0 0a2.18 2.18 0 01.75 1.661v4.253c0 1.081-.768 2.015-1.837 2.175a48.114 48.114 0 00-3.413.387m13.5-3.147a2.18 2.18 0 00-.75-1.661V5.587c0-1.081.768-2.015 1.837-2.175a48.114 48.114 0 013.413-.387m-8.25 3.147a2.25 2.25 0 01-1.5 3.147m12 0a2.25 2.25 0 01-1.5-3.147" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-blue-600" x-text="filteredUsers.filter(u => u.role_name === 'employee').length">{{ $employeeUsers }}</p>
            <p class="text-xs text-gray-400 font-medium">Employés</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-amber-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-amber-500" x-text="filteredUsers.filter(u => u.role_name === 'customer').length">{{ $customerUsers }}</p>
            <p class="text-xs text-gray-400 font-medium">Clients</p>
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
                placeholder="Rechercher un utilisateur...">
        </div>
        <div class="flex gap-2">
            <button type="button" data-hs-overlay="#create-modal"
                class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-md shadow-emerald-200/50 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Ajouter
            </button>
            <div class="w-48">
                <x-ui.select x-model="roleFilter" @change="applyFilters()">
                    <option value="">Tous les rôles</option>
                    <option value="admin">Admin</option>
                    <option value="employee">Employé</option>
                    <option value="customer">Client</option>
                </x-ui.select>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50/80 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Utilisateur</th>
                        <th class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Email</th>
                        <th class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Rôle</th>
                        <th class="px-6 py-3.5 text-end text-[10px] font-bold uppercase text-gray-400 tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <template x-for="user in paginatedUsers" :key="user.id">
                        <tr :class="['hover:bg-emerald-50/20 transition-colors group', user.id === authId ? 'bg-blue-50/30' : '']">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-xs font-bold text-emerald-600" x-text="user.name ? user.name.substring(0, 1).toUpperCase() : '?'">
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800" x-text="user.name"></p>
                                        <template x-if="user.id === authId">
                                            <p class="text-xs text-blue-600">(Vous)</p>
                                        </template>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-600" x-text="user.email"></span>
                            </td>
                            <td class="px-6 py-4">
                                <span :class="{
                                    'inline-flex items-center py-1 px-2.5 rounded-full text-xs font-bold bg-violet-50 text-violet-700': user.role_name === 'admin',
                                    'inline-flex items-center py-1 px-2.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700': user.role_name === 'employee',
                                    'inline-flex items-center py-1 px-2.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700': user.role_name === 'customer',
                                }" x-text="user.role_name === 'admin' ? 'Admin' : (user.role_name === 'employee' ? 'Employé' : 'Client')"></span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button type="button" @click="openEditModal(user)" class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                    <template x-if="user.id !== authId">
                                        <button type="button" @click="deleteUser(user.id)" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </template>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="filteredUsers.length === 0">
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">Aucun utilisateur trouvé</td>
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
                        Affichage de <span class="font-medium" x-text="((currentPage - 1) * perPage) + 1"></span> à <span class="font-medium" x-text="Math.min(currentPage * perPage, filteredUsers.length)"></span> sur <span class="font-medium" x-text="filteredUsers.length"></span> utilisateurs
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
                    <h3 class="font-bold font-heading text-gray-900">Nouvel utilisateur</h3>
                    <button type="button" data-hs-overlay="#create-modal" class="size-8 inline-flex justify-center items-center rounded-full border border-gray-200 bg-white text-gray-600 hover:bg-gray-50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <form method="POST" action="{{ route('admin.users.store') }}" class="p-6 space-y-4">
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
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Email <span class="text-red-400">*</span></label>
                        <input type="email" name="email" required class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Mot de passe <span class="text-red-400">*</span></label>
                        <input type="password" name="password" required minlength="8" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                        <p class="text-xs text-gray-400 mt-1">Minimum 8 caractères</p>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Rôle <span class="text-red-400">*</span></label>
                        <x-ui.select name="role" required>
                            <option value="admin">Admin</option>
                            <option value="employee" selected>Employé</option>
                            <option value="customer">Client</option>
                        </x-ui.select>
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
        <div @click.outside="showEditModal = false" class="w-full sm:max-w-lg bg-white border border-gray-100 shadow-2xl rounded-3xl overflow-hidden relative">
            <div class="flex justify-between items-center py-5 px-6 border-b border-gray-100">
                <h3 class="font-bold font-heading text-gray-900">Modifier l'utilisateur</h3>
                <button type="button" @click="showEditModal = false" class="size-8 inline-flex justify-center items-center rounded-full border border-gray-200 bg-white text-gray-600 hover:bg-gray-50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <form method="POST" :action="`/admin/users/${editForm.id}`" class="p-6 space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-1.5">Nom <span class="text-red-400">*</span></label>
                    <input type="text" name="name" required x-model="editForm.name" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-1.5">Email <span class="text-red-400">*</span></label>
                    <input type="email" name="email" required x-model="editForm.email" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-1.5">Mot de passe</label>
                    <input type="password" name="password" x-model="editForm.password" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" placeholder="Laisser vide pour ne pas modifier">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-1.5">Rôle <span class="text-red-400">*</span></label>
                    <x-ui.select name="role" x-model="editForm.role" required>
                        <option value="admin">Admin</option>
                        <option value="employee">Employé</option>
                        <option value="customer">Client</option>
                    </x-ui.select>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" @click="showEditModal = false" class="flex-1 py-3.5 px-4 text-center text-sm font-semibold rounded-xl border border-gray-200 text-gray-700 bg-white hover:bg-gray-50">Annuler</button>
                    <button type="submit" class="flex-1 py-3.5 px-4 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.admin>
