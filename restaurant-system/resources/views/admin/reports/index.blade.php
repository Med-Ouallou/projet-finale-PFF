<x-layouts.admin :title="'Rapports - Resto Admin'" :breadcrumb="'Rapports et Statistiques'">

    <!-- Date Filters -->
    <form method="GET" action="{{ route('admin.reports.index') }}" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex flex-col sm:flex-row gap-3 items-stretch sm:items-center justify-between">
        <div class="flex gap-2 items-center">
            <span class="text-sm font-medium text-gray-600">Période :</span>
            <div class="w-40">
                <x-ui.datepicker name="date_from" value="{{ $dateFrom }}" placeholder="Date de début" />
            </div>
            <span class="text-sm text-gray-400">à</span>
            <div class="w-40">
                <x-ui.datepicker name="date_to" value="{{ $dateTo }}" placeholder="Date de fin" />
            </div>
            <button type="submit" class="py-2.5 px-4 text-sm font-semibold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 transition">
                Filtrer
            </button>
        </div>
    </form>

    <!-- Stats Cards -->
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-emerald-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-emerald-600">{{ number_format($report['revenue'], 2) }} DH</p>
            <p class="text-xs text-gray-400 font-medium">Chiffre d'affaires</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-blue-600">{{ $report['orders_count'] }}</p>
            <p class="text-xs text-gray-400 font-medium">Commandes</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex flex-col gap-1">
            <div class="w-9 h-9 bg-amber-50 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
            <p class="text-3xl font-extrabold font-heading text-amber-600">{{ number_format($report['average_order'], 2) }} DH</p>
            <p class="text-xs text-gray-400 font-medium">Panier moyen</p>
        </div>
    </div>

    <!-- Top Items -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-base font-bold font-heading text-gray-800">Plats les plus vendus</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50/80 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Plat</th>
                        <th class="px-6 py-3 text-end text-[10px] font-bold uppercase text-gray-400 tracking-widest">Quantité vendue</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($report['top_items'] as $item)
                        <tr class="hover:bg-emerald-50/20 transition-colors">
                            <td class="px-6 py-3 text-sm font-medium text-gray-800">{{ $item->name }}</td>
                            <td class="px-6 py-3 text-end text-sm font-bold text-gray-800">{{ $item->total_sold }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-8 text-center text-gray-500">Aucune donnée disponible</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Daily Revenue -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-base font-bold font-heading text-gray-800">Revenus par jour</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50/80 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-start text-[10px] font-bold uppercase text-gray-400 tracking-widest">Date</th>
                        <th class="px-6 py-3 text-end text-[10px] font-bold uppercase text-gray-400 tracking-widest">Revenu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($report['daily_revenue'] as $day)
                        <tr class="hover:bg-emerald-50/20 transition-colors">
                            <td class="px-6 py-3 text-sm font-medium text-gray-800">{{ \Carbon\Carbon::parse($day->date)->format('d/m/Y') }}</td>
                            <td class="px-6 py-3 text-end text-sm font-bold text-emerald-600">{{ number_format($day->revenue, 2) }} DH</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-8 text-center text-gray-500">Aucune donnée disponible</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-layouts.admin>
