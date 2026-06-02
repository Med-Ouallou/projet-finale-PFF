@props([
    'breadcrumb' => '',
])

<header class="sticky top-0 z-30 bg-white border-b border-gray-100 shadow-sm px-4 sm:px-6 py-3 flex items-center justify-between gap-3">
    <div class="flex items-center gap-3">
        <!-- Mobile sidebar toggle -->
        <button type="button" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 text-gray-500 transition-colors" data-hs-overlay="#application-sidebar" aria-controls="application-sidebar" aria-label="Ouvrir le menu">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>

        <!-- Breadcrumb -->
        <nav class="flex items-center gap-1.5 text-sm text-gray-500" aria-label="Fil d'Ariane">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600 font-medium transition-colors">Admin</a>
            @if($breadcrumb)
                <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M9 18l6-6-6-6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="font-bold text-gray-800">{{ $breadcrumb }}</span>
            @endif
        </nav>
    </div>

    <div class="flex items-center gap-2 sm:gap-3">
        {{ $actions ?? '' }}

        <!-- Go to Public Site -->
        <a href="{{ route('accueil') }}" 
           class="hidden sm:flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors"
           title="Voir le site public">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                <polyline points="15 3 21 3 21 9"/>
                <line x1="10" y1="14" x2="21" y2="3"/>
            </svg>
            <span>Voir le site</span>
        </a>

        <!-- Notification dropdown container -->
        <div class="hs-dropdown relative [--placement:bottom-right]">
            <button id="hs-dropdown-notifications" type="button" class="hs-dropdown-toggle relative p-2.5 text-gray-500 hover:text-emerald-600 hover:bg-gray-50 rounded-xl transition-all" aria-label="Notifications" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                    <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                </svg>
                <template x-if="unreadCount > 0">
                    <span class="absolute top-1 right-1 min-w-[16px] h-4 px-1 flex items-center justify-center bg-red-500 text-[9px] font-black text-white rounded-full ring-2 ring-white animate-pulse" x-text="unreadCount"></span>
                </template>
            </button>

            <!-- Dropdown Menu -->
            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden mt-2 w-80 sm:w-96 bg-white rounded-2xl border border-gray-100 shadow-xl z-50 overflow-hidden" aria-labelledby="hs-dropdown-notifications">
                
                <!-- Dropdown Header -->
                <div class="px-5 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white flex items-center justify-between">
                    <div>
                        <h3 class="text-[10px] font-black text-gray-800 uppercase tracking-widest">Alerte & Commandes</h3>
                        <div class="flex items-center gap-1.5 mt-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span class="text-[10px] text-gray-400 font-bold" x-text="notifications.filter(n => !isRead(n.id)).length + ' en attente'"></span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <button x-show="unreadCount > 0" 
                                @click.stop="markAllAsRead()" 
                                class="text-[10px] font-black text-emerald-600 hover:text-emerald-700 transition flex items-center gap-1 uppercase tracking-wider">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            Tout effacer
                        </button>
                    </div>
                </div>

                <!-- Notification Scroll Area -->
                <div class="max-h-[360px] overflow-y-auto divide-y divide-gray-50">
                    
                    <!-- Notification loop templates (Displays only UNREAD items, so they vanish upon reading) -->
                    <template x-for="item in notifications.filter(n => !isRead(n.id))" :key="item.id">
                        <div class="group relative p-4 bg-white hover:bg-slate-50/50 transition-all flex gap-3.5 border-b border-slate-50">
                            
                            <!-- Type Icon enclosed in a subtle glowing ring -->
                            <div class="shrink-0">
                                <template x-if="item.type === 'new_order'">
                                    <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center shadow-sm">
                                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                </template>
                                <template x-if="item.type === 'low_stock'">
                                    <div class="w-9 h-9 rounded-xl bg-red-50 text-red-600 border border-red-100 flex items-center justify-center shadow-sm">
                                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                        </svg>
                                    </div>
                                </template>
                            </div>

                            <!-- Info / Message Area -->
                            <div class="flex-1 min-w-0 pr-6">
                                <!-- Top line: Category name & relative time -->
                                <div class="flex items-center justify-between">
                                    <span class="text-[9px] font-black uppercase tracking-widest"
                                          :class="item.type === 'new_order' ? 'text-emerald-600' : 'text-red-600'"
                                          x-text="item.type === 'new_order' ? 'Nouvelle Commande' : 'Stock Bas'"></span>
                                    <span class="text-[9px] text-slate-400 font-bold uppercase tracking-wider" x-text="item.time"></span>
                                </div>
                                
                                <!-- Alert Title -->
                                <h4 class="text-xs font-extrabold text-slate-900 mt-1" x-text="item.title"></h4>
                                
                                <!-- Alert Message -->
                                <p class="text-[11px] leading-relaxed mt-1" 
                                   x-text="item.message"
                                   :class="item.type === 'low_stock' ? 'text-red-600 font-black' : 'text-slate-500 font-medium'"></p>
                                
                                <!-- Bottom Details Link -->
                                <div class="mt-2.5">
                                    <a :href="item.link" 
                                       @click="markAsRead(item.id)"
                                       class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-600 hover:text-emerald-700 transition">
                                        Voir les détails
                                        <svg class="w-2.5 h-2.5 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Dismiss / Archive Button on top right -->
                            <button @click.prevent.stop="markAsRead(item.id)" 
                                    class="absolute top-3.5 right-3.5 p-1 rounded-lg text-slate-350 hover:text-slate-500 hover:bg-slate-50 transition"
                                    title="Archiver l'alerte">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                        </div>
                    </template>

                    <!-- Empty state displayed when all items are cleared -->
                    <template x-if="notifications.filter(n => !isRead(n.id)).length === 0">
                        <div class="p-10 text-center flex flex-col items-center justify-center gap-3 bg-white">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100 shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.746 3.746 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-black text-slate-800">Aucune alerte en attente</p>
                                <p class="text-[10px] text-slate-450 font-semibold mt-1">Vos stocks et vos commandes sont à jour.</p>
                            </div>
                        </div>
                    </template>

                </div>

            </div>
        </div>

        <!-- Avatar with Dropdown -->
        <div class="hs-dropdown relative [--placement:bottom-right]">
            <button id="hs-dropdown-admin-profile" type="button" class="hs-dropdown-toggle flex items-center focus:outline-none" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                <img class="w-8 h-8 rounded-full object-cover cursor-pointer ring-2 ring-emerald-500 hover:ring-emerald-600 transition" src="https://i.pravatar.cc/36?img=8" alt="Admin">
            </button>

            <!-- Dropdown Menu -->
            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden mt-2 w-48 bg-white rounded-xl border border-gray-100 shadow-lg py-1 z-50" aria-labelledby="hs-dropdown-admin-profile">
                <div class="px-4 py-2 border-b border-gray-100">
                    <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-gray-500">{{ auth()->user()->email ?? 'admin@resto.com' }}</p>
                </div>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <polyline points="16 17 21 12 16 7"/>
                            <line x1="21" x2="9" y1="12" y2="12"/>
                        </svg>
                        Se déconnecter
                    </span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</header>
