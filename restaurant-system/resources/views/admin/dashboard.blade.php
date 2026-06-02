<x-layouts.admin :title="'Dashboard - Resto Admin'" :breadcrumb="'Tableau de bord'">

    <!-- Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <x-admin.stat-card
            :label="'Revenus du jour'"
            :value="number_format($stats['revenue'], 2) . ' DH'"
            :badge="'Aujourd\'hui'"
            :badgeColor="'emerald'"
            :iconColor="'emerald'"
            :icon="'<svg class=\'w-5 h-5\' xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><line x1=\'12\' y1=\'1\' x2=\'12\' y2=\'23\'/><path d=\'M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6\'/></svg>'" />

        <x-admin.stat-card
            :label="'Commandes aujourd\'hui'"
            :value="$stats['orders_count']"
            :badge="$stats['pending_orders'] . ' en attente'"
            :badgeColor="'amber'"
            :iconColor="'amber'"
            :icon="'<svg class=\'w-5 h-5\' xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><path d=\'M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2\'/><rect x=\'8\' y=\'2\' width=\'8\' height=\'4\' rx=\'1\' ry=\'1\'/></svg>'" />

        <x-admin.stat-card
            :label="'Clients uniques'"
            :value="$stats['unique_clients']"
            :badge="'Aujourd\'hui'"
            :badgeColor="'emerald'"
            :iconColor="'blue'"
            :icon="'<svg class=\'w-5 h-5\' xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><path d=\'M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2\'/><circle cx=\'9\' cy=\'7\' r=\'4\'/></svg>'" />

        <x-admin.stat-card
            :label="'Commandes en attente'"
            :value="$stats['pending_orders']"
            :badge="'À traiter'"
            :badgeColor="'amber'"
            :iconColor="'violet'"
            :icon="'<svg class=\'w-5 h-5\' xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><path d=\'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z\'/></svg>'" />
    </div>

    <!-- Orders Table -->
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden mb-6">
        <div class="px-4 sm:px-6 py-4 flex justify-between items-center border-b border-gray-100">
            <div>
                <h2 class="text-base font-bold font-heading text-gray-800">Commandes récentes</h2>
                <p class="text-xs text-gray-400">Mises à jour en temps réel</p>
            </div>
            <a href="{{ route('admin.orders.index') }}"
                class="py-2 px-4 inline-flex items-center gap-x-2 text-xs font-semibold rounded-xl border border-gray-200 text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                Voir tout
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th scope="col" class="px-4 sm:px-6 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-gray-400">Client</th>
                        <th scope="col" class="px-4 sm:px-6 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-gray-400">Plats commandés</th>
                        <th scope="col" class="px-4 sm:px-6 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-gray-400">Heure</th>
                        <th scope="col" class="px-4 sm:px-6 py-3 text-left text-[10px] font-bold uppercase tracking-widest text-gray-400">Statut</th>
                        <th scope="col" class="px-4 sm:px-6 py-3 text-right text-[10px] font-bold uppercase tracking-widest text-gray-400">Montant</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-4 sm:px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-xs font-bold text-emerald-600">
                                        {{ strtoupper(substr($order->customer->name, 0, 1)) }}
                                    </div>
                                    <span class="text-sm font-medium text-gray-800">{{ $order->customer->name }}</span>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-500">
                                {{ $order->orderItems->map(fn($item) => $item->menuItem->name . ' × ' . $item->quantity)->implode(', ') }}
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-400">{{ $order->created_at->format('H:i') }}</td>
                            <td class="px-4 sm:px-6 py-4">
                                @php
                                    $statusColors = [
                                        'pending' => ['bg-amber-100', 'text-amber-800', 'En attente'],
                                        'preparing' => ['bg-blue-100', 'text-blue-800', 'En préparation'],
                                        'ready' => ['bg-purple-100', 'text-purple-800', 'Prête'],
                                        'delivered' => ['bg-emerald-100', 'text-emerald-800', 'Livrée'],
                                        'cancelled' => ['bg-red-100', 'text-red-800', 'Annulée'],
                                    ];
                                    $status = $statusColors[$order->status] ?? ['bg-gray-100', 'text-gray-800', $order->status];
                                @endphp
                                <span class="py-1 px-2.5 inline-flex items-center gap-x-1 text-xs font-semibold {{ $status[0] }} {{ $status[1] }} rounded-full">
                                    {{ $status[2] }}
                                </span>
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-right text-sm font-bold text-gray-800">{{ number_format($order->total_amount, 2) }} DH</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 sm:px-6 py-8 text-center text-gray-500">
                                Aucune commande récente
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-layouts.admin>
