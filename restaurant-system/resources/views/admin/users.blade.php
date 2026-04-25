<x-layouts.admin :title="'Gestion Utilisateurs - Resto Admin'" :breadcrumb="'Gestion Utilisateurs'">

    <x-slot:actions>
        <button type="button" @click="$dispatch('open-modal', { id: 'modal-user' })"
            class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-md shadow-emerald-200/50 transition-all hover:-translate-y-0.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round" /></svg>
            Ajouter un utilisateur
        </button>
    </x-slot:actions>

    <!-- KPI Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-slate-100 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-gray-900">8</p>
            <p class="text-xs text-gray-400 font-medium">Total Utilisateurs</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-violet-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-violet-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-violet-600">2</p>
            <p class="text-xs text-gray-400 font-medium">Admins</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.703 2.032-1.695 2.374l-2.024.675a2.25 2.25 0 01-2.289-.668l-.622-.621a1.875 1.875 0 00-2.65 0l-.622.621a2.25 2.25 0 01-2.289.668l-2.024-.675A2.202 2.202 0 012.75 18.4V14.15a5.25 5.25 0 014.5-5.2h10.5a5.25 5.25 0 014.5 5.2zM9 12.75a.75.75 0 00.75.75h4.5a.75.75 0 000-1.5H9.75A.75.75 0 009 12.75zM9 8.25a.75.75 0 01.75-.75h4.5a.75.75 0 010 1.5H9.75A.75.75 0 019 8.25z" /></svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-blue-600">6</p>
            <p class="text-xs text-gray-400 font-medium">Employés</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-emerald-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-emerald-600">5</p>
            <p class="text-xs text-gray-400 font-medium">Actifs</p>
        </div>
    </div>

    <!-- Filters Bar -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex flex-col sm:flex-row gap-3 items-stretch sm:items-center justify-between">
        <div class="relative flex-1 max-w-xs">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z" stroke-linecap="round" stroke-linejoin="round" /></svg>
            </div>
            <input type="text" class="py-2.5 ps-10 pe-4 block w-full bg-gray-50 border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500 transition-shadow" placeholder="Rechercher un utilisateur...">
        </div>
        <div class="flex gap-2">
            <div x-data="{ roleOpen: false, selectedRole: 'Rôle' }" class="relative inline-flex">
                <button type="button" @click="roleOpen = !roleOpen" class="py-2.5 px-3.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    <span x-text="selectedRole"></span>
                    <svg class="w-3.5 h-3.5 text-gray-400 transition-transform" :class="{ 'rotate-180': roleOpen }" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" /></svg>
                </button>
                <div x-show="roleOpen" x-cloak @click.away="roleOpen = false" x-transition class="absolute end-0 min-w-[160px] bg-white shadow-xl rounded-2xl border border-gray-100 mt-2 z-[80] p-2">
                    <button type="button" @click="selectedRole = 'Rôle'; roleOpen = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors w-full text-start"><span class="w-2 h-2 bg-gray-400 rounded-full"></span>Tous les rôles</button>
                    <div class="my-1 border-t border-gray-100"></div>
                    <button type="button" @click="selectedRole = 'Admin'; roleOpen = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-violet-50 text-violet-700 transition-colors w-full text-start"><span class="w-2 h-2 bg-violet-500 rounded-full"></span>Admin</button>
                    <button type="button" @click="selectedRole = 'Employé'; roleOpen = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-blue-50 text-blue-700 transition-colors w-full text-start"><span class="w-2 h-2 bg-blue-500 rounded-full"></span>Employé</button>
                </div>
            </div>
            <div x-data="{ statOpen: false, selectedStat: 'Statut' }" class="relative inline-flex">
                <button type="button" @click="statOpen = !statOpen" class="py-2.5 px-3.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span x-text="selectedStat"></span>
                    <svg class="w-3.5 h-3.5 text-gray-400 transition-transform" :class="{ 'rotate-180': statOpen }" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" /></svg>
                </button>
                <div x-show="statOpen" x-cloak @click.away="statOpen = false" x-transition class="absolute end-0 min-w-[160px] bg-white shadow-xl rounded-2xl border border-gray-100 mt-2 z-[80] p-2">
                    <button type="button" @click="selectedStat = 'Statut'; statOpen = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors w-full text-start"><span class="w-2 h-2 bg-gray-400 rounded-full"></span>Tous</button>
                    <button type="button" @click="selectedStat = 'Actif'; statOpen = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-emerald-50 text-emerald-700 transition-colors w-full text-start"><span class="w-2 h-2 bg-emerald-500 rounded-full"></span>Actif</button>
                    <button type="button" @click="selectedStat = 'Inactif'; statOpen = false" class="flex items-center gap-2.5 py-2 px-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors w-full text-start"><span class="w-2 h-2 bg-gray-400 rounded-full"></span>Inactif</button>
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
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Utilisateur</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Rôle</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Statut</th>
                        <th scope="col" class="px-6 py-3.5 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Dernière connexion</th>
                        <th scope="col" class="px-6 py-3.5 text-end text-[10px] font-bold uppercase text-gray-400 tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <tr class="hover:bg-emerald-50/20 transition-colors group">
                        <td class="px-6 py-4"><div class="flex items-center gap-3.5"><img class="w-10 h-10 rounded-full object-cover shadow-sm shrink-0" src="https://i.pravatar.cc/40?img=8" alt=""><div><p class="text-sm font-bold text-gray-800">Mohamed Ouallou</p><p class="text-xs text-gray-400 mt-0.5">admin@restomanager.fr</p></div></div></td>
                        <td class="px-6 py-4"><span class="inline-flex items-center gap-1 py-1 px-2.5 rounded-full text-[11px] font-bold bg-violet-50 text-violet-700"><span class="w-1.5 h-1.5 bg-violet-500 rounded-full"></span>Admin</span></td>
                        <td class="px-6 py-4"><span class="inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>Actif</span></td>
                        <td class="px-6 py-4"><span class="text-sm text-gray-500">Aujourd'hui, 14:30</span></td>
                        <td class="px-6 py-4"><div class="flex justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity"><button type="button" aria-label="Modifier" @click="$dispatch('open-modal', { id: 'modal-user' })" class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" stroke-linecap="round" stroke-linejoin="round" /></svg></button><button type="button" aria-label="Supprimer" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" stroke-linecap="round" stroke-linejoin="round" /></svg></button></div></td>
                    </tr>
                    <tr class="hover:bg-emerald-50/20 transition-colors group">
                        <td class="px-6 py-4"><div class="flex items-center gap-3.5"><img class="w-10 h-10 rounded-full object-cover shadow-sm shrink-0" src="https://i.pravatar.cc/40?img=12" alt=""><div><p class="text-sm font-bold text-gray-800">Ayoube Jamali</p><p class="text-xs text-gray-400 mt-0.5">employe1@restomanager.fr</p></div></div></td>
                        <td class="px-6 py-4"><span class="inline-flex items-center gap-1 py-1 px-2.5 rounded-full text-[11px] font-bold bg-blue-50 text-blue-700"><span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>Employé</span></td>
                        <td class="px-6 py-4"><span class="inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>Actif</span></td>
                        <td class="px-6 py-4"><span class="text-sm text-gray-500">Aujourd'hui, 10:15</span></td>
                        <td class="px-6 py-4"><div class="flex justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity"><button type="button" aria-label="Modifier" @click="$dispatch('open-modal', { id: 'modal-user' })" class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" stroke-linecap="round" stroke-linejoin="round" /></svg></button><button type="button" aria-label="Supprimer" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" stroke-linecap="round" stroke-linejoin="round" /></svg></button></div></td>
                    </tr>
                    <tr class="hover:bg-emerald-50/20 transition-colors group">
                        <td class="px-6 py-4"><div class="flex items-center gap-3.5"><img class="w-10 h-10 rounded-full object-cover shadow-sm shrink-0" src="https://i.pravatar.cc/40?img=5" alt=""><div><p class="text-sm font-bold text-gray-800">Fatima Zahra</p><p class="text-xs text-gray-400 mt-0.5">employe2@restomanager.fr</p></div></div></td>
                        <td class="px-6 py-4"><span class="inline-flex items-center gap-1 py-1 px-2.5 rounded-full text-[11px] font-bold bg-blue-50 text-blue-700"><span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>Employé</span></td>
                        <td class="px-6 py-4"><span class="inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-gray-100 text-gray-700"><span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>Inactif</span></td>
                        <td class="px-6 py-4"><span class="text-sm text-gray-500">Hier, 18:45</span></td>
                        <td class="px-6 py-4"><div class="flex justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity"><button type="button" aria-label="Modifier" @click="$dispatch('open-modal', { id: 'modal-user' })" class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" stroke-linecap="round" stroke-linejoin="round" /></svg></button><button type="button" aria-label="Supprimer" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" stroke-linecap="round" stroke-linejoin="round" /></svg></button></div></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Affichage de 1-3 sur 8</span>
            <div class="inline-flex gap-x-1">
                <button type="button" class="py-1.5 px-3 text-xs font-bold text-gray-300 pointer-events-none rounded-lg border border-gray-100 bg-white transition cursor-not-allowed">←</button>
                <button type="button" class="py-1.5 px-3 text-xs font-bold text-gray-600 rounded-lg border border-gray-200 bg-white hover:bg-gray-50 transition">→</button>
            </div>
        </div>
    </div>

    <!-- User Modal -->
    <x-slot:modal>
        <div x-data="{ open: false }" x-init="window.addEventListener('open-modal', e => { if(e.detail.id === 'modal-user') open = true }) })"
             @close-modal.window="if($event.detail.id === 'modal-user') open = false"
             class="fixed inset-0 z-[80] overflow-x-hidden overflow-y-auto" :class="{ 'pointer-events-none': !open }">
            <div x-show="open" x-cloak x-transition:enter="transition-opacity ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="open = false" class="fixed inset-0 bg-black/40"></div>
            <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4" class="relative min-h-[calc(100%-3.5rem)] flex items-center m-3 sm:mx-auto sm:max-w-xl sm:w-full">
                <div class="w-full flex flex-col bg-white border border-gray-100 shadow-2xl rounded-3xl pointer-events-auto relative">
                    <div class="flex justify-between items-center py-5 px-6 border-b border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 bg-emerald-100 rounded-xl flex items-center justify-center shrink-0"><svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round" /></svg></div>
                            <div><h3 class="font-bold font-heading text-gray-900 leading-none">Nouvel Utilisateur</h3><p class="text-xs text-gray-400 mt-0.5">Ajoutez un membre à l'équipe.</p></div>
                        </div>
                        <button type="button" @click="open = false" class="size-8 inline-flex justify-center items-center rounded-full border border-gray-200 bg-white text-gray-600 hover:bg-gray-50 transition-colors shrink-0"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" /></svg></button>
                    </div>
                    <div class="p-6 space-y-5 overflow-y-auto max-h-[70vh]">
                        <div class="grid grid-cols-2 gap-4">
                            <div><label class="block text-sm font-bold text-gray-800 mb-1.5">Prénom <span class="text-red-400">*</span></label><input type="text" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" placeholder="Prénom"></div>
                            <div><label class="block text-sm font-bold text-gray-800 mb-1.5">Nom <span class="text-red-400">*</span></label><input type="text" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" placeholder="Nom"></div>
                        </div>
                        <div><label class="block text-sm font-bold text-gray-800 mb-1.5">Email <span class="text-red-400">*</span></label><input type="email" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" placeholder="email@exemple.com"></div>
                        <div class="grid grid-cols-2 gap-4">
                            <div><label class="block text-sm font-bold text-gray-800 mb-1.5">Rôle <span class="text-red-400">*</span></label>
                                <div x-data="{ roleOpen: false, selectedRole: 'Employé' }" class="relative w-full">
                                    <button type="button" @click="roleOpen = !roleOpen" class="py-3 px-4 inline-flex items-center justify-between w-full gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-gray-50 text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition text-start"><span x-text="selectedRole"></span><svg class="w-4 h-4 text-gray-400 transition-transform shrink-0" :class="{ 'rotate-180': roleOpen }" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" /></svg></button>
                                    <div x-show="roleOpen" x-cloak @click.away="roleOpen = false" x-transition class="absolute w-full bg-white shadow-xl rounded-2xl border border-gray-100 mt-1 z-[90] p-2">
                                        <button type="button" @click="selectedRole = 'Admin'; roleOpen = false" class="flex items-center py-2 px-3 rounded-xl text-sm text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">Admin</button>
                                        <button type="button" @click="selectedRole = 'Employé'; roleOpen = false" class="flex items-center py-2 px-3 rounded-xl text-sm text-gray-700 hover:bg-gray-100 transition-colors w-full text-start">Employé</button>
                                    </div>
                                </div>
                            </div>
                            <div><label class="block text-sm font-bold text-gray-800 mb-1.5">Téléphone</label><input type="tel" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" placeholder="+212 6XX XXX XXX"></div>
                        </div>
                        <div><label class="block text-sm font-bold text-gray-800 mb-1.5">Mot de passe <span class="text-red-400">*</span></label><input type="password" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition" placeholder="••••••••"><p class="text-xs text-gray-400 mt-1">Minimum 8 caractères</p></div>
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
