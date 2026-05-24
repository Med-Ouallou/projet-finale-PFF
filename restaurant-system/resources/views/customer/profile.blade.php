<x-customer.layouts.app>
    <x-slot:title>Mon Profil - Resto Manager</x-slot:title>

    <div class="bg-gray-50/50 min-h-screen py-8" x-data="{ showActiveOrder: true }">
        <div class="max-w-[1140px] mx-auto px-6">
            
            <!-- Clean Premium Header Card -->
            <div class="bg-white border border-gray-150/80 rounded-2xl p-6 lg:p-8 shadow-sm mb-8 text-start relative overflow-hidden">
                <div class="absolute inset-0 opacity-40 pointer-events-none">
                    <div class="absolute -top-12 -right-12 w-64 h-64 bg-emerald-50 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-12 -left-12 w-48 h-48 bg-amber-50 rounded-full blur-3xl"></div>
                </div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                        <!-- Profile Monogram -->
                        <div class="w-16 h-16 rounded-2xl bg-emerald-600 text-white flex items-center justify-center font-bold text-2xl shadow-md shadow-emerald-600/10 flex-shrink-0">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="space-y-1">
                            <span class="inline-flex items-center gap-1.5 py-1 px-3 bg-emerald-50 border border-emerald-200/50 text-emerald-700 text-[10px] font-bold rounded-full uppercase tracking-wider">
                                Espace Client
                            </span>
                            <h1 class="text-2xl lg:text-3xl font-extrabold font-heading text-gray-900 tracking-tight">
                                {{ $user->name }}
                            </h1>
                            <p class="text-sm text-gray-500 max-w-lg font-medium">
                                Gérez vos coordonnées personnelles, sécurisez votre compte et suivez vos commandes.
                            </p>
                        </div>
                    </div>

                    <!-- Client Summary Metrics -->
                    <div class="flex items-center gap-4 bg-gray-50 border border-gray-100 rounded-xl p-4 min-w-[200px] justify-between">
                        <div class="text-start">
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Compte créé le</p>
                            <p class="text-sm font-bold text-gray-800 mt-0.5">{{ $user->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div class="text-end border-l border-gray-200 pl-4">
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Commandes</p>
                            <p class="text-sm font-bold text-emerald-600 mt-0.5 bg-emerald-50 px-2 py-0.5 rounded-md inline-block">{{ $orders->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Workspace Grid -->
            <div class="grid lg:grid-cols-4 gap-8">
                
                <!-- Sidebar Tabs Navigation -->
                <div class="lg:col-span-1">
                    <nav class="flex flex-col space-y-1 bg-white border border-gray-150 rounded-2xl p-4 shadow-sm sticky top-24" aria-label="Tabs" role="tablist">
                        
                        <button type="button" class="hs-tab-active:bg-emerald-600 hs-tab-active:text-white hs-tab-active:font-bold hs-tab-active:shadow-md hs-tab-active:shadow-emerald-600/10 text-gray-500 hover:bg-gray-50 hover:text-gray-800 w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-start transition-all duration-150 active" id="profile-tab" data-hs-tab="#profile-panel" aria-controls="profile-panel" role="tab">
                            <svg class="w-4.5 h-4.5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" /><circle cx="12" cy="7" r="4" />
                            </svg>
                            Mes Informations
                        </button>

                        <button type="button" class="hs-tab-active:bg-emerald-600 hs-tab-active:text-white hs-tab-active:font-bold hs-tab-active:shadow-md hs-tab-active:shadow-emerald-600/10 text-gray-500 hover:bg-gray-50 hover:text-gray-800 w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-start transition-all duration-150" id="security-tab" data-hs-tab="#security-panel" aria-controls="security-panel" role="tab">
                            <svg class="w-4.5 h-4.5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" /><path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                            Sécurité & Accès
                        </button>

                        <button type="button" class="hs-tab-active:bg-emerald-600 hs-tab-active:text-white hs-tab-active:font-bold hs-tab-active:shadow-md hs-tab-active:shadow-emerald-600/10 text-gray-500 hover:bg-gray-50 hover:text-gray-800 w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-start transition-all duration-150 relative" id="orders-tab" data-hs-tab="#orders-panel" aria-controls="orders-panel" role="tab">
                            <svg class="w-4.5 h-4.5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" /><polyline points="12 6 12 12 16 14" />
                            </svg>
                            Mes Commandes
                            @if($activeOrder)
                                <span class="absolute right-4 w-2 h-2 bg-emerald-500 border border-white rounded-full animate-ping"></span>
                            @endif
                        </button>
                    </nav>
                </div>

                <!-- Main Content Panel -->
                <div class="lg:col-span-3">
                    
                    <!-- TAB 1: PROFILE EDIT -->
                    <div id="profile-panel" role="tabpanel" aria-labelledby="profile-tab" class="space-y-6">
                        <div class="bg-white border border-gray-150 rounded-2xl p-6 lg:p-8 shadow-sm text-start">
                            
                            <div class="flex items-center gap-2 border-b border-gray-100 pb-4 mb-6">
                                <h2 class="text-lg font-bold font-heading text-gray-850">
                                    Coordonnées Personnelles
                                </h2>
                            </div>

                            <!-- Success / Error banners -->
                            @if(session('success'))
                                <div class="p-3.5 mb-5 bg-emerald-50 border border-emerald-200/50 text-emerald-800 rounded-xl text-xs font-semibold flex items-center gap-2.5">
                                    <span class="w-5 h-5 bg-emerald-650 text-white rounded-full flex items-center justify-center text-[10px]">✓</span>
                                    <span>{{ session('success') }}</span>
                                </div>
                            @endif

                            @if($errors->any() && !session('success_password') && !$errors->has('current_password') && !$errors->has('password'))
                                <div class="p-4 mb-5 bg-red-50 border border-red-200/50 text-red-900 rounded-xl text-xs flex items-start gap-2.5">
                                    <span class="w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center text-[10px] font-bold flex-shrink-0">!</span>
                                    <div>
                                        <h5 class="font-bold text-red-950 mb-0.5">Veuillez corriger les erreurs suivantes :</h5>
                                        <ul class="list-disc pl-4 space-y-0.5 text-xs text-red-800">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <form action="{{ route('client.profile.update') }}" method="POST" class="space-y-6">
                                @csrf
                                @method('PUT')

                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="space-y-1.5">
                                        <label for="name" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest">Nom Complet</label>
                                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-800 text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:outline-none transition-all">
                                    </div>

                                    <div class="space-y-1.5">
                                        <label for="email" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest">Adresse Email</label>
                                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-800 text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:outline-none transition-all">
                                    </div>
                                </div>

                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="space-y-1.5">
                                        <label for="phone" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest">Téléphone</label>
                                        <input type="text" name="phone" id="phone" value="{{ old('phone', $customer->phone) }}"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-800 text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:outline-none transition-all"
                                            placeholder="Ex: 0612345678">
                                    </div>

                                    <div class="space-y-1.5">
                                        <label for="address" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest">Adresse de Livraison</label>
                                        <input type="text" name="address" id="address" value="{{ old('address', $customer->address) }}"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-800 text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:outline-none transition-all"
                                            placeholder="Ex: Rue 12, Casablanca">
                                    </div>
                                </div>

                                <div class="flex justify-end pt-5 border-t border-gray-100">
                                    <button type="submit" 
                                        class="px-5 py-3 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl shadow-md shadow-emerald-600/10 transition-all hover:shadow-lg active:scale-[0.98] uppercase tracking-wider">
                                        Enregistrer les modifications
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- TAB 2: SECURITY -->
                    <div id="security-panel" role="tabpanel" aria-labelledby="security-tab" class="hidden space-y-6">
                        <div class="bg-white border border-gray-150 rounded-2xl p-6 lg:p-8 shadow-sm text-start">
                            
                            <div class="flex items-center gap-2 border-b border-gray-100 pb-4 mb-6">
                                <h2 class="text-lg font-bold font-heading text-gray-850">
                                    Modifier le Mot de Passe
                                </h2>
                            </div>

                            <!-- Success / Error banners -->
                            @if(session('success_password'))
                                <div class="p-3.5 mb-5 bg-emerald-50 border border-emerald-200/50 text-emerald-800 rounded-xl text-xs font-semibold flex items-center gap-2.5">
                                    <span class="w-5 h-5 bg-emerald-650 text-white rounded-full flex items-center justify-center text-[10px]">✓</span>
                                    <span>{{ session('success_password') }}</span>
                                </div>
                            @endif

                            @if($errors->any() && (session('success_password') || $errors->has('current_password') || $errors->has('password')))
                                <div class="p-4 mb-5 bg-red-50 border border-red-200/50 text-red-900 rounded-xl text-xs flex items-start gap-2.5">
                                    <span class="w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center text-[10px] font-bold flex-shrink-0">!</span>
                                    <div>
                                        <h5 class="font-bold text-red-950 mb-0.5">Veuillez corriger les erreurs de sécurité :</h5>
                                        <ul class="list-disc pl-4 space-y-0.5 text-xs text-red-800">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <form action="{{ route('client.password.update') }}" method="POST" class="space-y-6">
                                @csrf
                                @method('PUT')

                                <div class="space-y-1.5">
                                    <label for="current_password" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest">Mot de passe actuel</label>
                                    <input type="password" name="current_password" id="current_password" required
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-800 text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:outline-none transition-all">
                                </div>

                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="space-y-1.5">
                                        <label for="password" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest">Nouveau mot de passe</label>
                                        <input type="password" name="password" id="password" required
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-800 text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:outline-none transition-all"
                                            placeholder="Min. 8 caractères">
                                    </div>

                                    <div class="space-y-1.5">
                                        <label for="password_confirmation" class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest">Confirmer le mot de passe</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" required
                                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-800 text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:outline-none transition-all">
                                    </div>
                                </div>

                                <div class="flex justify-end pt-5 border-t border-gray-100">
                                    <button type="submit" 
                                        class="px-5 py-3 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl shadow-md shadow-emerald-600/10 transition-all hover:shadow-lg active:scale-[0.98] uppercase tracking-wider">
                                        Modifier le mot de passe
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- TAB 3: COMMANDES -->
                    <div id="orders-panel" role="tabpanel" aria-labelledby="orders-tab" class="hidden space-y-6">
                        
                        <!-- 1. Sleek Order Status Timeline -->
                        @if($activeOrder)
                            <div x-show="showActiveOrder" class="bg-white border border-gray-150 rounded-2xl p-6 shadow-sm text-start relative overflow-hidden">
                                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-emerald-500 to-emerald-400"></div>

                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-gray-100 pb-4 mb-6 gap-3">
                                    <div class="space-y-0.5">
                                        <span class="inline-flex items-center gap-1 py-0.5 px-2 bg-emerald-50 border border-emerald-100 text-emerald-800 text-[9px] font-bold rounded-full uppercase tracking-wider">
                                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-ping"></span>
                                            Suivi en temps réel
                                        </span>
                                        <h3 class="font-heading font-black text-gray-800 text-base uppercase tracking-tight">Commande #{{ $activeOrder->id }}</h3>
                                    </div>
                                    <div class="flex items-center gap-2.5">
                                        <span class="text-[11px] font-bold text-gray-400">Heure : {{ $activeOrder->created_at->format('H:i') }}</span>
                                        <button @click="showActiveOrder = false" class="text-gray-300 hover:text-gray-500 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- TIMELINE LAYOUT -->
                                <div class="relative flex flex-col md:flex-row justify-between items-start md:items-center w-full gap-6 md:gap-0 md:px-8">
                                    <!-- Connect line -->
                                    <div class="hidden md:block absolute top-1/2 left-8 right-8 h-1 bg-gray-100 -translate-y-1/2 z-0">
                                        <div class="h-full bg-emerald-500 rounded-full transition-all duration-500" 
                                            style="width: @if($activeOrder->status === 'pending') 0% @elseif($activeOrder->status === 'preparing') 33.3% @elseif($activeOrder->status === 'ready') 66.6% @else 100% @endif;"></div>
                                    </div>

                                    <!-- Step 1: Reçue -->
                                    <div class="flex items-center md:flex-col gap-3.5 md:gap-2 z-10 text-start md:text-center relative">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center transition-all shadow-sm
                                            @if($activeOrder->status === 'pending') bg-amber-500 text-white border-2 border-white ring-4 ring-amber-500/10 scale-105 @else bg-emerald-600 text-white @endif">
                                            @if($activeOrder->status === 'pending')
                                                <svg class="w-4.5 h-4.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                                                </svg>
                                            @else
                                                <svg class="w-4.5 h-4.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-xs text-gray-800">Reçue</h4>
                                            <p class="text-[10px] text-gray-400">En cours</p>
                                        </div>
                                    </div>

                                    <!-- Step 2: Cuisine -->
                                    <div class="flex items-center md:flex-col gap-3.5 md:gap-2 z-10 text-start md:text-center relative">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center transition-all shadow-sm
                                            @if($activeOrder->status === 'preparing') bg-amber-500 text-white border-2 border-white ring-4 ring-amber-500/10 scale-105 @elseif($activeOrder->status === 'ready' || $activeOrder->status === 'delivered') bg-emerald-600 text-white @else bg-gray-100 text-gray-400 @endif">
                                            <svg class="w-4.5 h-4.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2M7 2v9M21 15V2v0a5 5 0 0 0-5 5v3c0 2.2 1.8 4 4 4h1v8"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-xs @if($activeOrder->status === 'preparing' || $activeOrder->status === 'ready' || $activeOrder->status === 'delivered') text-gray-800 @else text-gray-400 @endif">En Cuisine</h4>
                                            <p class="text-[10px] text-gray-400">Préparation</p>
                                        </div>
                                    </div>

                                    <!-- Step 3: Prête -->
                                    <div class="flex items-center md:flex-col gap-3.5 md:gap-2 z-10 text-start md:text-center relative">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center transition-all shadow-sm
                                            @if($activeOrder->status === 'ready') bg-amber-500 text-white border-2 border-white ring-4 ring-amber-500/10 scale-105 @elseif($activeOrder->status === 'delivered') bg-emerald-600 text-white @else bg-gray-100 text-gray-400 @endif">
                                            <svg class="w-4.5 h-4.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 0 1-3.46 0"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-xs @if($activeOrder->status === 'ready' || $activeOrder->status === 'delivered') text-gray-800 @else text-gray-400 @endif">Prête</h4>
                                            <p class="text-[10px] text-gray-400">Prêt à servir</p>
                                        </div>
                                    </div>

                                    <!-- Step 4: Livrée -->
                                    <div class="flex items-center md:flex-col gap-3.5 md:gap-2 z-10 text-start md:text-center relative">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center transition-all shadow-sm
                                            @if($activeOrder->status === 'delivered') bg-emerald-600 text-white border-2 border-white ring-4 ring-emerald-500/10 scale-105 @else bg-gray-100 text-gray-400 @endif">
                                            <svg class="w-4.5 h-4.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4zM3 6h18M16 10a4 4 0 0 1-8 0"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-xs @if($activeOrder->status === 'delivered') text-gray-800 @else text-gray-400 @endif">Livrée</h4>
                                            <p class="text-[10px] text-gray-400">Bon appétit</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- 2. Clean Order History Listing -->
                        <div class="bg-white border border-gray-150 rounded-2xl p-6 lg:p-8 shadow-sm text-start">
                            
                            <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-6">
                                <h2 class="text-lg font-bold font-heading text-gray-850">
                                    Historique des Commandes
                                </h2>
                                <span class="text-xs font-semibold text-gray-400 bg-gray-50 border border-gray-100/50 px-2.5 py-1 rounded-lg">{{ $orders->count() }} commandes</span>
                            </div>

                            @if($orders->isEmpty())
                                <div class="flex flex-col items-center justify-center py-16 opacity-50">
                                    <div class="w-16 h-16 bg-gray-50 border border-gray-100 rounded-2xl flex items-center justify-center mb-4 text-2xl">🥗</div>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Aucune commande enregistrée</p>
                                </div>
                            @else
                                <div class="overflow-hidden border border-gray-150 rounded-xl">
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-sm text-left text-gray-500">
                                            <thead class="text-[10px] text-gray-400 uppercase bg-gray-50 border-b border-gray-150 font-bold tracking-wider">
                                                <tr>
                                                    <th scope="col" class="px-6 py-4">Commande</th>
                                                    <th scope="col" class="px-6 py-4">Date</th>
                                                    <th scope="col" class="px-6 py-4">Détails des plats</th>
                                                    <th scope="col" class="px-6 py-4">Montant</th>
                                                    <th scope="col" class="px-6 py-4">Statut</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-100 text-gray-700">
                                                @foreach($orders as $order)
                                                    <tr class="bg-white hover:bg-gray-50/40 transition-colors">
                                                        <td class="px-6 py-4.5 font-bold text-gray-900">
                                                            #{{ $order->id }}
                                                        </td>
                                                        <td class="px-6 py-4.5 text-xs text-gray-400 font-medium">
                                                            {{ $order->created_at->format('d/m/Y') }}
                                                        </td>
                                                        <td class="px-6 py-4.5">
                                                            <div class="space-y-0.5 text-xs font-medium text-gray-600">
                                                                @foreach($order->orderItems as $item)
                                                                    <div class="truncate max-w-[200px]">
                                                                        <span class="text-gray-400 text-[10px] font-semibold">{{ $item->quantity }}x</span> {{ $item->menuItem?->name ?? 'Plat inconnu' }}
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4.5">
                                                            <div class="font-bold text-emerald-700">{{ number_format($order->total_amount, 2) }} DH</div>
                                                            @if($order->discount_amount > 0)
                                                                <span class="inline-block text-[9px] text-amber-600 bg-amber-50 px-1 py-0.5 rounded font-bold border border-amber-100/50 mt-0.5">
                                                                    -{{ number_format($order->discount_amount, 2) }} DH
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td class="px-6 py-4.5">
                                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[9px] font-bold uppercase tracking-wider border
                                                                @if($order->status === 'pending') bg-amber-50 text-amber-700 border-amber-200/40
                                                                @elseif($order->status === 'preparing') bg-blue-50 text-blue-700 border-blue-200/40
                                                                @elseif($order->status === 'ready') bg-teal-50 text-teal-700 border-teal-200/40
                                                                @elseif($order->status === 'delivered') bg-emerald-50 text-emerald-700 border-emerald-200/40
                                                                @else bg-red-50 text-red-700 border-red-200/40
                                                                @endif">
                                                                
                                                                <!-- Micro Dot status -->
                                                                <span class="w-1 h-1 rounded-full
                                                                    @if($order->status === 'pending') bg-amber-500
                                                                    @elseif($order->status === 'preparing') bg-blue-500
                                                                    @elseif($order->status === 'ready') bg-teal-500
                                                                    @elseif($order->status === 'delivered') bg-emerald-500
                                                                    @else bg-red-500
                                                                    @endif"></span>

                                                                @if($order->status === 'pending') En attente
                                                                @elseif($order->status === 'preparing') En cuisine
                                                                @elseif($order->status === 'ready') Prête
                                                                @elseif($order->status === 'delivered') Livrée
                                                                @else Annulée
                                                                @endif
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-customer.layouts.app>
