<x-layouts.admin :title="'Détails Commande - Resto Admin'" :breadcrumb="'Commande #' . $order->id">

    @php
        $statusLabels = [
            'pending' => ['En attente', 'bg-amber-100', 'text-amber-800'],
            'preparing' => ['En préparation', 'bg-blue-100', 'text-blue-800'],
            'ready' => ['Prête', 'bg-purple-100', 'text-purple-800'],
            'delivered' => ['Livrée', 'bg-emerald-100', 'text-emerald-800'],
            'cancelled' => ['Annulée', 'bg-red-100', 'text-red-800'],
        ];
        $currentStatus = $statusLabels[$order->status] ?? ['Inconnu', 'bg-gray-100', 'text-gray-800'];
    @endphp

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <!-- Header -->
            <div class="p-6 border-b border-gray-100">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-lg font-bold font-heading text-gray-900">Commande #{{ $order->id }}</h2>
                        <p class="text-sm text-gray-400">Passée le {{ $order->created_at->format('d/m/Y à H:i') }}</p>
                    </div>
                    <span class="inline-flex items-center py-1.5 px-3 rounded-full text-sm font-bold {{ $currentStatus[1] }} {{ $currentStatus[2] }}">
                        {{ $currentStatus[0] }}
                    </span>
                </div>
            </div>

            <!-- Status Update -->
            @if($order->status !== 'cancelled' && $order->status !== 'delivered')
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" class="flex items-center gap-4">
                        @csrf
                        @method('PATCH')
                        <label class="text-sm font-bold text-gray-800">Mettre à jour le statut :</label>
                        <select name="status" onchange="this.form.submit()" class="py-2.5 px-4 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all">
                            @foreach($statusLabels as $key => $label)
                                @if($key !== 'cancelled')
                                    <option value="{{ $key }}" {{ $order->status == $key ? 'selected' : '' }}>{{ $label[0] }}</option>
                                @endif
                            @endforeach
                        </select>
                    </form>
                </div>
            @endif

            <!-- Customer Info -->
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-sm font-bold text-gray-800 mb-4">Informations client</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-400">Nom</p>
                        <p class="text-sm font-medium text-gray-800">{{ $order->customer->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Téléphone</p>
                        <p class="text-sm font-medium text-gray-800">{{ $order->customer->phone }}</p>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-sm font-bold text-gray-800 mb-4">Articles commandés</h3>
                <div class="space-y-3">
                    @foreach($order->orderItems as $item)
                        <div class="flex justify-between items-center py-3 border-b border-gray-50 last:border-0">
                            <div>
                                <p class="text-sm font-medium text-gray-800">{{ $item->menuItem->name }}</p>
                                <p class="text-xs text-gray-400">{{ number_format($item->unit_price_at_order, 2) }} DH × {{ $item->quantity }}</p>
                            </div>
                            <p class="text-sm font-bold text-gray-800">{{ number_format($item->subtotal, 2) }} DH</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Totals -->
            <div class="p-6 bg-gray-50">
                <div class="space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Sous-total</span>
                        <span class="font-medium">{{ number_format($order->subtotal, 2) }} DH</span>
                    </div>
                    @if($order->discount_amount > 0)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Remise</span>
                            <span class="font-medium text-red-600">-{{ number_format($order->discount_amount, 2) }} DH</span>
                        </div>
                    @endif
                    <div class="flex justify-between text-lg font-bold pt-2 border-t border-gray-200">
                        <span class="text-gray-800">Total</span>
                        <span class="text-emerald-600">{{ number_format($order->total_amount, 2) }} DH</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="p-6 border-t border-gray-100 flex justify-between">
                <a href="{{ route('admin.orders.index') }}" class="py-2.5 px-4 text-sm font-semibold rounded-xl border border-gray-200 text-gray-700 bg-white hover:bg-gray-50 transition">
                    Retour aux commandes
                </a>
                @if($order->status !== 'cancelled' && $order->status !== 'delivered')
                    <form method="POST" action="{{ route('admin.orders.cancel', $order) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette commande ?')">
                        @csrf
                        <button type="submit" class="py-2.5 px-4 text-sm font-semibold rounded-xl bg-red-100 text-red-700 hover:bg-red-200 transition">
                            Annuler la commande
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

</x-layouts.admin>
