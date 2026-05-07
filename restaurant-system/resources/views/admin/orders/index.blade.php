<x-layouts.admin :title="'Commandes - Resto Admin'" :breadcrumb="'Gestion des Commandes'">

    @php
        $statusLabels = [
            'pending' => ['En attente', 'bg-amber-100', 'text-amber-800'],
            'preparing' => ['En préparation', 'bg-blue-100', 'text-blue-800'],
            'ready' => ['Prête', 'bg-purple-100', 'text-purple-800'],
            'delivered' => ['Livrée', 'bg-emerald-100', 'text-emerald-800'],
            'cancelled' => ['Annulée', 'bg-red-100', 'text-red-800'],
        ];
    @endphp

    <!-- Filters Bar -->
    <form method="GET" action="{{ route('admin.orders.index') }}" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex flex-col sm:flex-row gap-3 items-stretch sm:items-center justify-between mb-6">
        <div class="flex gap-2">
            <select name="status" onchange="this.form.submit()"
                class="py-2.5 px-3.5 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all">
                <option value="">Tous les statuts</option>
                @foreach($statusLabels as $key => $label)
                    <option value="{{ $key }}" {{ ($filters['status'] ?? '') == $key ? 'selected' : '' }}>{{ $label[0] }}</option>
                @endforeach
            </select>
            <input type="date" name="date_from" value="{{ $filters['date_from'] ?? '' }}" onchange="this.form.submit()"
                class="py-2.5 px-3.5 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all">
            <input type="date" name="date_to" value="{{ $filters['date_to'] ?? '' }}" onchange="this.form.submit()"
                class="py-2.5 px-3.5 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all">
        </div>
    </form>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-6">
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
                    @forelse($orders as $order)
                        <tr class="hover:bg-emerald-50/20 transition-colors group">
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-gray-900">#{{ $order->id }}</span>
                                <p class="text-xs text-gray-400">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-xs font-bold text-emerald-600">
                                        {{ strtoupper(substr($order->customer->name, 0, 1)) }}
                                    </div>
                                    <span class="text-sm font-medium text-gray-800">{{ $order->customer->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-600">{{ $order->orderItems->count() }} article(s)</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-gray-800">{{ number_format($order->total_amount, 2) }} DH</span>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $status = $statusLabels[$order->status] ?? ['Inconnu', 'bg-gray-100', 'text-gray-800'];
                                @endphp
                                <span class="inline-flex items-center py-1 px-2.5 rounded-full text-xs font-bold {{ $status[1] }} {{ $status[2] }}">
                                    {{ $status[0] }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                        class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition"
                                        title="Voir détails">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                    @if($order->status !== 'cancelled' && $order->status !== 'delivered')
                                        <form method="POST" action="{{ route('admin.orders.cancel', $order) }}" class="inline" onsubmit="return confirm('Annuler cette commande ?')">
                                            @csrf
                                            <button type="submit" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition" title="Annuler">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">Aucune commande trouvée</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $orders->links() }}
        </div>
    </div>

</x-layouts.admin>
