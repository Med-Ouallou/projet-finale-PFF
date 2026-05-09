<x-layouts.admin :title="'Dashboard Employé - Resto Admin'" :breadcrumb="'Tableau de bord'">

    <!-- KPI Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-emerald-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-emerald-600">5</p>
            <p class="text-xs text-gray-400 font-medium">Commandes en attente</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-blue-600">12</p>
            <p class="text-xs text-gray-400 font-medium">Commandes traitées</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-amber-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.202-2.04-.591-.795-.523-1.89-.645-2.902-.268-1.015.377-1.74 1.165-1.928 2.12a2.122 2.122 0 001.17 2.302c.49.237 1.068-.022 1.322-.595z" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-amber-600">1,250 DH</p>
            <p class="text-xs text-gray-400 font-medium">Ventes aujourd'hui</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-purple-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 12.375v-3.375m0 0v-3.375m0 3.375H8.25m3.75 0h3.75" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-purple-600">3</p>
            <p class="text-xs text-gray-400 font-medium">Clients actifs</p>
        </div>
    </div>

    <!-- Orders Section -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <div>
                <h2 class="text-lg font-bold font-heading text-gray-900">Commandes récentes</h2>
                <p class="text-sm text-gray-500">Gérez les commandes en cours</p>
            </div>
            <a href="{{ route('employee.orders.index') }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-700">Voir tout</a>
        </div>
        <div class="p-6">
            <p class="text-gray-400 text-sm">Aucune commande en attente pour le moment.</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="{{ route('employee.pos.index') }}" class="group bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-6 text-white shadow-lg shadow-emerald-200 hover:shadow-xl transition-all">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-lg">Point de Vente (POS)</h3>
                    <p class="text-emerald-100 text-sm">Créer une nouvelle commande</p>
                </div>
            </div>
        </a>
        <a href="{{ route('employee.orders.index') }}" class="group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v8.25A2.25 2.25 0 006 16.5h2.25m-3 0v1.5A2.25 2.25 0 006 20.25h12a2.25 2.25 0 002.25-2.25V15m-6 0v-3.75A2.25 2.25 0 0015 9h-1.5" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-lg text-gray-900">Historique</h3>
                    <p class="text-gray-500 text-sm">Voir toutes les commandes</p>
                </div>
            </div>
        </a>
    </div>

</x-layouts.admin>
