@props([])

<!-- Sidebar -->
<aside id="application-sidebar" class="hs-overlay [--auto-close:lg] hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform hidden fixed top-0 start-0 bottom-0 z-[60] w-[260px] bg-white border-e border-gray-100 overflow-y-auto lg:block lg:translate-x-0 lg:end-auto lg:bottom-0" role="dialog" tabindex="-1" aria-label="Sidebar">
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="px-6 py-5 bg-emerald-900">
            <a class="flex items-center gap-2.5 font-bold font-heading text-lg text-white" href="{{ route('admin.dashboard') }}">
                <div class="w-8 h-8 bg-emerald-500 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                    </svg>
                </div>
                Resto<span class="text-emerald-300">Admin</span>
            </a>
        </div>

        <!-- Navigation -->
        <nav class="flex flex-col flex-1 p-3 pt-4 gap-0.5 overflow-y-auto" id="sidebar-nav">
            <p class="text-[10px] font-bold uppercase text-gray-400 tracking-widest px-2 mb-1">Principal</p>

            <a href="{{ route('admin.dashboard') }}"
               class="nav-link flex items-center gap-x-3.5 py-2.5 px-3 rounded-xl text-sm transition-all group {{ request()->routeIs('admin.dashboard') ? 'font-bold bg-emerald-50 text-emerald-700 border border-emerald-100' : 'font-medium text-gray-600 hover:bg-gray-100' }}">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.dashboard') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-emerald-600' }} transition" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75" />
                </svg>
                Dashboard
            </a>

            <a href="{{ route('admin.menus.index') }}"
               class="nav-link flex items-center gap-x-3.5 py-2.5 px-3 rounded-xl text-sm transition-all group {{ request()->routeIs('admin.menus.index') ? 'font-bold bg-emerald-50 text-emerald-700 border border-emerald-100' : 'font-medium text-gray-600 hover:bg-gray-100' }}">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.menus.index') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-emerald-600' }} transition" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
                Menus
            </a>

            <a href="{{ route('admin.menu-items.index') }}"
               class="nav-link flex items-center gap-x-3.5 py-2.5 px-3 rounded-xl text-sm transition-all group {{ request()->routeIs('admin.menu-items.index') ? 'font-bold bg-emerald-50 text-emerald-700 border border-emerald-100' : 'font-medium text-gray-600 hover:bg-gray-100' }}">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.menu-items.index') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-emerald-600' }} transition" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                </svg>
                Gestion du Menu
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="nav-link flex items-center gap-x-3.5 py-2.5 px-3 rounded-xl text-sm transition-all group {{ request()->routeIs('admin.categories.index') ? 'font-bold bg-emerald-50 text-emerald-700 border border-emerald-100' : 'font-medium text-gray-600 hover:bg-gray-100' }}">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.categories.index') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-emerald-600' }} transition" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
                Catégories
            </a>

            <a href="{{ route('admin.reports.index') }}"
               class="nav-link flex items-center gap-x-3.5 py-2.5 px-3 rounded-xl text-sm transition-all group {{ request()->routeIs('admin.reports.index') ? 'font-bold bg-emerald-50 text-emerald-700 border border-emerald-100' : 'font-medium text-gray-600 hover:bg-gray-100' }}">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.reports.index') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-emerald-600' }} transition" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                </svg>
                Rapports & Stats
            </a>

            <a href="{{ route('admin.orders.index') }}"
               class="nav-link flex items-center gap-x-3.5 py-2.5 px-3 rounded-xl text-sm transition-all group {{ request()->routeIs('admin.orders.index') ? 'font-bold bg-emerald-50 text-emerald-700 border border-emerald-100' : 'font-medium text-gray-600 hover:bg-gray-100' }}">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.orders.index') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-emerald-600' }} transition" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
                </svg>
                Commandes
            </a>

            <a href="{{ route('admin.promotions.index') }}"
               class="nav-link flex items-center gap-x-3.5 py-2.5 px-3 rounded-xl text-sm transition-all group {{ request()->routeIs('admin.promotions.index') ? 'font-bold bg-emerald-50 text-emerald-700 border border-emerald-100' : 'font-medium text-gray-600 hover:bg-gray-100' }}">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.promotions.index') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-emerald-600' }} transition" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a1.875 1.875 0 002.652 0l4.318-4.318a1.875 1.875 0 000-2.652L11.16 3.659A1.875 1.875 0 009.568 3z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 7.5h.008v.008H6V7.5z" />
                </svg>
                Promotions
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="nav-link flex items-center gap-x-3.5 py-2.5 px-3 rounded-xl text-sm transition-all group {{ request()->routeIs('admin.users.index') ? 'font-bold bg-emerald-50 text-emerald-700 border border-emerald-100' : 'font-medium text-gray-600 hover:bg-gray-100' }}">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.users.index') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-emerald-600' }} transition" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                Utilisateurs
            </a>

            <a href="{{ route('admin.inventory.index') }}"
               class="nav-link flex items-center gap-x-3.5 py-2.5 px-3 rounded-xl text-sm transition-all group {{ request()->routeIs('admin.inventory.index') ? 'font-bold bg-emerald-50 text-emerald-700 border border-emerald-100' : 'font-medium text-gray-600 hover:bg-gray-100' }}">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.inventory.index') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-emerald-600' }} transition" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                </svg>
                Inventaire
            </a>

            <!-- Divider -->
            <div class="my-2 border-t border-gray-100"></div>
            <p class="text-[10px] font-bold uppercase text-gray-400 tracking-widest px-2 mb-1">Compte</p>

            <a href="#" class="nav-link flex items-center gap-x-3.5 py-2.5 px-3 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-100 transition-all group">
                <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-600 transition" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Paramètres
            </a>

            <!-- User Profile (bottom) -->
            <div class="mt-auto pt-3 border-t border-gray-100">
                <div class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 cursor-pointer transition-all">
                    <img class="w-9 h-9 rounded-full object-cover shrink-0 ring-2 ring-emerald-100" src="https://i.pravatar.cc/36?img=8" alt="Admin">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-gray-800 truncate">Admin</p>
                        <p class="text-[11px] text-gray-400 truncate">admin@restomanager.fr</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-300 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M8 9l4-4 4 4m0 6l-4 4-4-4" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
        </nav>
    </div>
</aside>
