<x-layouts.admin :title="'Dashboard - Resto Admin'" :breadcrumb="'Tableau de bord'">

    <!-- Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <x-admin.stat-card
            :label="'Revenus du jour'"
            :value="'1,250 DH'"
            :badge="'+12%'"
            :badgeColor="'emerald'"
            :iconColor="'emerald'"
            :icon="'<svg class=\'w-5 h-5\' xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><line x1=\'12\' y1=\'1\' x2=\'12\' y2=\'23\'/><path d=\'M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6\'/></svg>'" />

        <x-admin.stat-card
            :label="'Commandes aujourd\'hui'"
            :value="'24'"
            :badge="'6 en cours'"
            :badgeColor="'amber'"
            :iconColor="'amber'"
            :icon="'<svg class=\'w-5 h-5\' xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><path d=\'M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2\'/><rect x=\'8\' y=\'2\' width=\'8\' height=\'4\' rx=\'1\' ry=\'1\'/></svg>'" />

        <x-admin.stat-card
            :label="'Clients uniques'"
            :value="'156'"
            :badge="'+8%'"
            :badgeColor="'emerald'"
            :iconColor="'blue'"
            :icon="'<svg class=\'w-5 h-5\' xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><path d=\'M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2\'/><circle cx=\'9\' cy=\'7\' r=\'4\'/></svg>'" />

        <x-admin.stat-card
            :label="'Taux de satisfaction'"
            :value="'98%'"
            :badge="'Excellent'"
            :badgeColor="'emerald'"
            :iconColor="'violet'"
            :icon="'<svg class=\'w-5 h-5\' xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><path d=\'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z\'/></svg>'" />
    </div>

    <!-- Orders Table -->
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="px-4 sm:px-6 py-4 flex justify-between items-center border-b border-gray-100">
            <div>
                <h2 class="text-base font-bold font-heading text-gray-800">Commandes récentes</h2>
                <p class="text-xs text-gray-400">Mises à jour en temps réel</p>
            </div>
            <button type="button"
                class="py-2 px-4 inline-flex items-center gap-x-2 text-xs font-semibold rounded-xl border border-gray-200 text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                Voir tout
            </button>
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
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-4 sm:px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img class="w-8 h-8 rounded-full object-cover" src="https://i.pravatar.cc/32?img=1" alt="">
                                <span class="text-sm font-medium text-gray-800">Ayoube Jamali</span>
                            </div>
                        </td>
                        <td class="px-4 sm:px-6 py-4 text-sm text-gray-500">Bowl Santé × 2</td>
                        <td class="px-4 sm:px-6 py-4 text-sm text-gray-400">15:42</td>
                        <td class="px-4 sm:px-6 py-4">
                            <span class="py-1 px-2.5 inline-flex items-center gap-x-1 text-xs font-semibold bg-emerald-100 text-emerald-800 rounded-full">Livrée</span>
                        </td>
                        <td class="px-4 sm:px-6 py-4 text-right text-sm font-bold text-gray-800">45.00 DH</td>
                    </tr>
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-4 sm:px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img class="w-8 h-8 rounded-full object-cover" src="https://i.pravatar.cc/32?img=5" alt="">
                                <span class="text-sm font-medium text-gray-800">Marie Durand</span>
                            </div>
                        </td>
                        <td class="px-4 sm:px-6 py-4 text-sm text-gray-500">Pancakes Gourmands × 1</td>
                        <td class="px-4 sm:px-6 py-4 text-sm text-gray-400">15:51</td>
                        <td class="px-4 sm:px-6 py-4">
                            <span class="py-1 px-2.5 inline-flex items-center gap-x-1 text-xs font-semibold bg-amber-100 text-amber-800 rounded-full">En cours</span>
                        </td>
                        <td class="px-4 sm:px-6 py-4 text-right text-sm font-bold text-gray-800">9.00 DH</td>
                    </tr>
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-4 sm:px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img class="w-8 h-8 rounded-full object-cover" src="https://i.pravatar.cc/32?img=9" alt="">
                                <span class="text-sm font-medium text-gray-800">Fatima Zahra</span>
                            </div>
                        </td>
                        <td class="px-4 sm:px-6 py-4 text-sm text-gray-500">Tajine Poulet × 1, Salade × 1</td>
                        <td class="px-4 sm:px-6 py-4 text-sm text-gray-400">16:02</td>
                        <td class="px-4 sm:px-6 py-4">
                            <span class="py-1 px-2.5 inline-flex items-center gap-x-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full">Confirmée</span>
                        </td>
                        <td class="px-4 sm:px-6 py-4 text-right text-sm font-bold text-gray-800">32.50 DH</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</x-layouts.admin>
