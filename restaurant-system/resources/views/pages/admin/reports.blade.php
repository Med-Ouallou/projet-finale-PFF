<x-layouts.admin :title="'Rapports & Statistiques - Resto Admin'" :breadcrumb="'Rapports & Statistiques'">

    <x-slot:actions>
        <div class="hidden sm:flex items-center bg-gray-50 p-1 rounded-xl border border-gray-100">
            <button class="px-3 py-1.5 text-xs font-bold rounded-lg bg-white text-emerald-600 shadow-sm">30 derniers jours</button>
            <button class="px-3 py-1.5 text-xs font-bold rounded-lg text-gray-500 hover:text-gray-700">7 jours</button>
            <button class="px-3 py-1.5 text-xs font-bold rounded-lg text-gray-500 hover:text-gray-700">Aujourd'hui</button>
        </div>
        <button type="button"
            class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-bold rounded-xl bg-gray-100 text-gray-600 hover:bg-gray-200 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M3 15v4c0 1.1.9 2 2 2h14a2 2 0 002-2v-4M7 10l5 5 5-5M12 15V3" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Exporter
        </button>
    </x-slot:actions>

    <!-- Section Title -->
    <div class="flex flex-col gap-1 text-start">
        <h1 class="text-2xl font-bold font-heading text-gray-900">Performance de l'Établissement</h1>
        <p class="text-sm text-gray-500">Analyse détaillée de votre activité commerciale.</p>
    </div>

    <!-- KPIs Flash -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm text-start">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Revenu Total</p>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black font-heading text-gray-900">142,500 DH</span>
                <span class="text-xs font-bold text-emerald-600">+12%</span>
            </div>
        </div>
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm text-start">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Panier Moyen</p>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black font-heading text-gray-900">185 DH</span>
                <span class="text-xs font-bold text-emerald-600">+5%</span>
            </div>
        </div>
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm text-start">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Commandes</p>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black font-heading text-gray-900">770</span>
                <span class="text-xs font-bold text-gray-400">Stable</span>
            </div>
        </div>
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm text-start">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Complétion</p>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black font-heading text-gray-900">98.2%</span>
                <span class="text-xs font-bold text-emerald-600">+1.2%</span>
            </div>
        </div>
    </div>

    <!-- Graphs Section -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Area Chart Placeholder -->
        <div class="xl:col-span-2 bg-white border border-gray-100 shadow-sm rounded-3xl p-8 text-start flex flex-col">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h3 class="text-lg font-bold font-heading text-gray-800">Tendance du Chiffre d'Affaires</h3>
                    <p class="text-sm text-gray-500">Statistiques de ventes hebdomadaires</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="flex items-center gap-1.5 text-xs font-bold text-gray-600">
                        <span class="size-2 rounded-full bg-emerald-500"></span> Ce mois
                    </span>
                    <span class="flex items-center gap-1.5 text-xs font-bold text-gray-400">
                        <span class="size-2 rounded-full bg-gray-200"></span> Précédent
                    </span>
                </div>
            </div>
            <!-- Chart Placeholder -->
            <div class="relative h-72 w-full bg-gray-50 rounded-2xl flex items-end gap-1 p-6">
                <div class="flex-1 h-2/5 bg-emerald-100/60 rounded-t-xl hover:bg-emerald-200 transition-colors"></div>
                <div class="flex-1 h-3/5 bg-emerald-100/60 rounded-t-xl hover:bg-emerald-200 transition-colors"></div>
                <div class="flex-1 h-4/5 bg-emerald-200/60 rounded-t-xl hover:bg-emerald-300 transition-colors"></div>
                <div class="flex-1 h-3/5 bg-emerald-200/60 rounded-t-xl hover:bg-emerald-300 transition-colors"></div>
                <div class="flex-1 h-5/5 bg-emerald-300/80 rounded-t-xl hover:bg-emerald-400 transition-colors"></div>
                <div class="flex-1 h-full bg-emerald-600 rounded-t-xl"></div>
                <div class="flex-1 h-4/5 bg-emerald-300/80 rounded-t-xl hover:bg-emerald-400 transition-colors"></div>
                <!-- Grid Lines -->
                <div class="absolute inset-x-6 top-1/4 h-px bg-gray-100"></div>
                <div class="absolute inset-x-6 top-2/4 h-px bg-gray-100"></div>
                <div class="absolute inset-x-6 top-3/4 h-px bg-gray-100"></div>
            </div>
        </div>

        <!-- Donut Chart Placeholder -->
        <div class="bg-white border border-gray-100 shadow-sm rounded-3xl p-8 text-start">
            <h3 class="text-lg font-bold font-heading text-gray-800 mb-2">Ventes par Catégorie</h3>
            <p class="text-sm text-gray-500 mb-8">Répartition du volume de commandes</p>

            <div class="relative flex items-center justify-center mb-8">
                <div class="size-48 rounded-full border-[16px] border-emerald-600 border-r-amber-400 border-b-blue-400 border-l-red-400 transform rotate-45 flex items-center justify-center shadow-inner">
                    <div class="text-center">
                        <p class="text-2xl font-black font-heading text-gray-800">770</p>
                        <p class="text-[10px] font-bold text-gray-400 uppercase">Total</p>
                    </div>
                </div>
            </div>

            <div class="space-y-3">
                <div class="flex justify-between items-center bg-gray-50/50 p-2 rounded-xl">
                    <span class="flex items-center gap-3 text-sm font-bold text-gray-700">
                        <span class="size-2 rounded-full bg-emerald-600"></span> Plats
                    </span>
                    <span class="text-xs font-bold text-gray-500">45%</span>
                </div>
                <div class="flex justify-between items-center p-2">
                    <span class="flex items-center gap-3 text-sm font-bold text-gray-700">
                        <span class="size-2 rounded-full bg-amber-400"></span> Entrées
                    </span>
                    <span class="text-xs font-bold text-gray-500">25%</span>
                </div>
                <div class="flex justify-between items-center p-2">
                    <span class="flex items-center gap-3 text-sm font-bold text-gray-700">
                        <span class="size-2 rounded-full bg-blue-400"></span> Boissons
                    </span>
                    <span class="text-xs font-bold text-gray-500">20%</span>
                </div>
                <div class="flex justify-between items-center p-2">
                    <span class="flex items-center gap-3 text-sm font-bold text-gray-700">
                        <span class="size-2 rounded-full bg-red-400"></span> Desserts
                    </span>
                    <span class="text-xs font-bold text-gray-500">10%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Analysis Section -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
        <!-- Top Sellers -->
        <div class="bg-white border border-gray-100 shadow-sm rounded-3xl p-8 text-start">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-lg font-bold font-heading text-gray-800">Top des Ventes</h3>
                <a href="#" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 transition">Tout voir</a>
            </div>
            <div class="space-y-5">
                <div class="flex items-center gap-4 group cursor-pointer">
                    <img class="size-14 rounded-2xl object-cover shadow-sm group-hover:scale-105 transition-transform" src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=100&h=100&fit=crop" alt="">
                    <div class="flex-1">
                        <p class="text-sm font-bold text-gray-900">Salade César Premium</p>
                        <p class="text-xs text-gray-400">142 vendus · Salades</p>
                    </div>
                    <div class="text-end">
                        <p class="text-sm font-bold text-emerald-700">12,070 DH</p>
                        <div class="w-16 h-1.5 bg-gray-100 rounded-full mt-1 overflow-hidden">
                            <div class="h-full bg-emerald-500" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-4 group cursor-pointer">
                    <img class="size-14 rounded-2xl object-cover shadow-sm group-hover:scale-105 transition-transform" src="https://images.unsplash.com/photo-1513104890138-7c749659a591?w=100&h=100&fit=crop" alt="">
                    <div class="flex-1">
                        <p class="text-sm font-bold text-gray-900">Pizza Quattro Stagioni</p>
                        <p class="text-xs text-gray-400">98 vendus · Pizzas</p>
                    </div>
                    <div class="text-end">
                        <p class="text-sm font-bold text-emerald-700">11,270 DH</p>
                        <div class="w-16 h-1.5 bg-gray-100 rounded-full mt-1 overflow-hidden">
                            <div class="h-full bg-emerald-500" style="width: 65%"></div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-4 group cursor-pointer">
                    <img class="size-14 rounded-2xl object-cover shadow-sm group-hover:scale-105 transition-transform" src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=100&h=100&fit=crop" alt="">
                    <div class="flex-1">
                        <p class="text-sm font-bold text-gray-900">Burger Avocado Toast</p>
                        <p class="text-xs text-gray-400">76 vendus · Hamburgers</p>
                    </div>
                    <div class="text-end">
                        <p class="text-sm font-bold text-emerald-700">8,360 DH</p>
                        <div class="w-16 h-1.5 bg-gray-100 rounded-full mt-1 overflow-hidden">
                            <div class="h-full bg-emerald-500" style="width: 45%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Staff Performance -->
        <div class="bg-white border border-gray-100 shadow-sm rounded-3xl p-8 text-start">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-lg font-bold font-heading text-gray-800">Performance Staff</h3>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest px-2 py-1 bg-gray-50 rounded-lg">Top 3 Employés</span>
            </div>
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <img class="size-12 rounded-full border-2 border-emerald-100 p-0.5" src="https://i.pravatar.cc/100?img=12" alt="">
                        <div>
                            <p class="text-sm font-bold text-gray-900">Ahmed Mansour</p>
                            <p class="text-xs text-gray-400">Cuisine · Expert</p>
                        </div>
                    </div>
                    <div class="text-end">
                        <p class="text-sm font-bold text-gray-800">4.9 / 5</p>
                        <div class="flex gap-0.5">
                            <span class="size-2 bg-amber-400 rounded-full"></span>
                            <span class="size-2 bg-amber-400 rounded-full"></span>
                            <span class="size-2 bg-amber-400 rounded-full"></span>
                            <span class="size-2 bg-amber-400 rounded-full"></span>
                            <span class="size-2 bg-amber-400 rounded-full"></span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <img class="size-12 rounded-full border-2 border-gray-100 p-0.5" src="https://i.pravatar.cc/100?img=11" alt="">
                        <div>
                            <p class="text-sm font-bold text-gray-900">Salma Bennani</p>
                            <p class="text-xs text-gray-400">Service · Confirmé</p>
                        </div>
                    </div>
                    <div class="text-end">
                        <p class="text-sm font-bold text-gray-800">4.7 / 5</p>
                        <div class="flex gap-0.5">
                            <span class="size-2 bg-amber-400 rounded-full"></span>
                            <span class="size-2 bg-amber-400 rounded-full"></span>
                            <span class="size-2 bg-amber-400 rounded-full"></span>
                            <span class="size-2 bg-amber-400 rounded-full"></span>
                            <span class="size-2 bg-gray-200 rounded-full"></span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <img class="size-12 rounded-full border-2 border-gray-100 p-0.5" src="https://i.pravatar.cc/100?img=14" alt="">
                        <div>
                            <p class="text-sm font-bold text-gray-900">Karim Alami</p>
                            <p class="text-xs text-gray-400">Service · Débutant</p>
                        </div>
                    </div>
                    <div class="text-end">
                        <p class="text-sm font-bold text-gray-800">4.5 / 5</p>
                        <div class="flex gap-0.5">
                            <span class="size-2 bg-amber-400 rounded-full"></span>
                            <span class="size-2 bg-amber-400 rounded-full"></span>
                            <span class="size-2 bg-amber-400 rounded-full"></span>
                            <span class="size-2 bg-amber-400 rounded-full"></span>
                            <span class="size-2 bg-gray-200 rounded-full"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stocks Alert Section -->
    <div class="bg-red-50/50 border border-red-100 shadow-sm rounded-3xl overflow-hidden text-start">
        <div class="px-4 sm:px-8 py-5 flex items-center gap-4 border-b border-red-100">
            <div class="size-10 bg-red-100 rounded-xl flex items-center justify-center">
                <svg class="size-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold font-heading text-red-900 leading-none">Alertes de Stocks</h3>
                <p class="text-xs text-red-600 mt-1">4 produits nécessitent votre attention immédiate.</p>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-red-100">
                <thead class="bg-red-100/30">
                    <tr>
                        <th scope="col" class="px-4 sm:px-8 py-3 text-start"><span class="text-[10px] font-bold uppercase tracking-wider text-red-700/50">Produit</span></th>
                        <th scope="col" class="px-4 sm:px-8 py-3 text-start"><span class="text-[10px] font-bold uppercase tracking-wider text-red-700/50">Quantité Restante</span></th>
                        <th scope="col" class="px-4 sm:px-8 py-3 text-start"><span class="text-[10px] font-bold uppercase tracking-wider text-red-700/50">Statut</span></th>
                        <th scope="col" class="px-4 sm:px-8 py-3 text-end"><span class="text-[10px] font-bold uppercase tracking-wider text-red-700/50">Action</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-red-100">
                    <tr>
                        <td class="px-4 sm:px-8 py-4 whitespace-nowrap"><span class="text-sm font-bold text-red-900">Tomates Cerises</span></td>
                        <td class="px-4 sm:px-8 py-4 whitespace-nowrap"><span class="text-sm text-red-700">1.2 Kg</span></td>
                        <td class="px-4 sm:px-8 py-4 whitespace-nowrap"><span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-lg text-[10px] font-bold bg-red-100 text-red-800">RUPTURE PROCHE</span></td>
                        <td class="px-4 sm:px-8 py-4 whitespace-nowrap text-end"><button class="text-xs font-bold text-red-600 hover:text-red-800 transition">Commander</button></td>
                    </tr>
                    <tr>
                        <td class="px-4 sm:px-8 py-4 whitespace-nowrap"><span class="text-sm font-bold text-red-900">Mozzarella di Bufala</span></td>
                        <td class="px-4 sm:px-8 py-4 whitespace-nowrap"><span class="text-sm text-red-700">0.5 Kg</span></td>
                        <td class="px-4 sm:px-8 py-4 whitespace-nowrap"><span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-lg text-[10px] font-bold bg-red-200 text-red-900">CRITIQUE</span></td>
                        <td class="px-4 sm:px-8 py-4 whitespace-nowrap text-end"><button class="text-xs font-bold text-red-600 hover:text-red-800 transition">Commander</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</x-layouts.admin>
