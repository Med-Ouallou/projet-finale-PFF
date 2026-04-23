@props([
    'breadcrumb' => '',
])

<header class="sticky top-0 z-30 bg-white border-b border-gray-100 shadow-sm px-4 sm:px-6 py-3 flex items-center justify-between gap-3">
    <div class="flex items-center gap-3">
        <!-- Mobile sidebar toggle -->
        <button type="button" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 text-gray-500 transition-colors" @click="toggleSidebar()" aria-label="Ouvrir le menu">
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

        <!-- Notification bell -->
        <button class="relative p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition-colors" aria-label="Notifications">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                <path d="M13.73 21a2 2 0 0 1-3.46 0" />
            </svg>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full ring-2 ring-white"></span>
        </button>

        <!-- Avatar with Dropdown -->
        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
            <button @click="open = !open" class="flex items-center focus:outline-none">
                <img class="w-8 h-8 rounded-full object-cover cursor-pointer ring-2 ring-emerald-500 hover:ring-emerald-600 transition" src="https://i.pravatar.cc/36?img=8" alt="Admin">
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-xl border border-gray-100 shadow-lg py-1 z-50">
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
