<header class="flex flex-wrap sm:justify-start sm:flex-nowrap z-50 w-full bg-white/90 backdrop-blur-md border-b border-gray-100 text-sm py-2 sm:py-0 sticky top-0 shadow-sm">
    <nav class="relative max-w-[1200px] w-full mx-auto px-6 sm:flex sm:items-center sm:justify-between" aria-label="Global">
        
        <!-- Navbar Logo & Mobile Controls -->
        <div class="flex items-center justify-between h-16">
            <a class="flex items-center gap-2.5 text-xl font-bold font-heading text-slate-900 focus:outline-none" href="{{ route('accueil') }}">
                <div class="flex items-center justify-center w-9 h-9 bg-emerald-600 rounded-xl shadow-lg shadow-emerald-200">
                    <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                    </svg>
                </div>
                Resto<span class="text-emerald-600">Manager</span>
            </a>
            
            <div class="flex items-center gap-3 sm:hidden">
                <!-- Mobile Cart Icon (Visible on Mobile Header) -->
                <button type="button" data-hs-overlay="#hs-offcanvas-cart" class="relative p-2.5 text-gray-500 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all" aria-controls="hs-offcanvas-cart" aria-label="Panier">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
                    </svg>
                    <template x-if="itemCount > 0">
                        <span class="absolute top-1 right-1 min-w-[18px] h-[18px] px-1 flex items-center justify-center bg-emerald-600 text-[10px] font-black text-white rounded-full ring-2 ring-white" x-text="itemCount"></span>
                    </template>
                </button>

                <!-- Hamburger toggle -->
                <button type="button" class="hs-collapse-toggle w-9 h-9 flex justify-center items-center rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-collapse="#navbar-collapse-with-animation" aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
                    <svg class="hs-collapse-open:hidden w-4 h-4" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                    </svg>
                    <svg class="hs-collapse-open:block hidden w-4 h-4" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Desktop Nav Links & Controls -->
        <div id="navbar-collapse-with-animation" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:block">
            <div class="flex flex-col gap-y-4 gap-x-0 mt-5 sm:flex-row sm:items-center sm:justify-end sm:gap-y-0 sm:gap-x-8 sm:mt-0 sm:ps-7">
                <a class="font-semibold {{ request()->routeIs('accueil') ? 'text-emerald-600 border-b-2 border-emerald-500' : 'text-gray-500 hover:text-gray-800' }} pb-4 text-sm transition-colors" href="{{ route('accueil') }}">Accueil</a>
                <a class="font-semibold {{ request()->routeIs('menu') ? 'text-emerald-600 border-b-2 border-emerald-500' : 'text-gray-500 hover:text-gray-800' }} pb-4 text-sm transition-colors" href="{{ route('menu') }}">Menu</a>
                <a class="font-semibold {{ request()->routeIs('contact') ? 'text-emerald-600 border-b-2 border-emerald-500' : 'text-gray-500 hover:text-gray-800' }} pb-4 text-sm transition-colors" href="{{ route('contact') }}">Contact</a>
                
                <div class="sm:ps-4 pb-4 sm:border-s border-gray-200 flex items-center gap-3">
                    
                    <!-- Desktop Cart Icon Button -->
                    <button type="button" 
                            data-hs-overlay="#hs-offcanvas-cart" aria-controls="hs-offcanvas-cart"
                            aria-label="Voir le panier"
                            class="relative p-2 text-stone-650 hover:text-emerald-700 hover:bg-stone-50 rounded-xl transition-all focus:outline-none flex items-center justify-center mr-1">
                        <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                            <path d="M3 6h18m-5 4a4 4 0 1 1-8 0" />
                        </svg>
                        <span x-show="itemCount > 0" x-cloak
                              class="absolute top-0.5 right-0.5 w-4.5 h-4.5 flex items-center justify-center bg-emerald-700 text-[#FAF9F6] text-[8px] font-black rounded-full border border-white animate-pulse"
                              x-text="itemCount">
                        </span>
                    </button>

                    @guest
                        <div class="flex items-center gap-2">
                            <a href="{{ route('login') }}" class="py-2 px-4.5 inline-flex items-center gap-x-2 text-sm font-semibold rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 transition-all">
                                Connexion
                            </a>
                            <a href="{{ route('register') }}" class="py-2 px-4.5 inline-flex items-center gap-x-2 text-sm font-semibold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-md shadow-emerald-200 transition-all hover:shadow-lg hover:shadow-emerald-200 hover:-translate-y-0.5">
                                S'inscrire
                            </a>
                        </div>
                    @else
                        <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
                            <button id="hs-dropdown-profile" type="button" class="hs-dropdown-toggle flex items-center gap-2 text-sm font-medium text-gray-700 hover:text-emerald-600 transition-colors focus:outline-none">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-xs font-bold text-emerald-600">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                                <svg class="hs-dropdown-open:rotate-180 w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden mt-2 w-48 bg-white rounded-xl border border-gray-100 shadow-lg py-2 z-[100]" aria-labelledby="hs-dropdown-profile">
                                <div class="px-4 py-2 border-b border-gray-100">
                                    <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                
                                @if(Auth::user()->isCustomer())
                                    {{-- Customer Profile Link --}}
                                    <a href="{{ route('client.profile') }}"
                                       class="flex items-center gap-2 px-4 py-2 text-sm text-emerald-600 hover:bg-emerald-50 transition-colors">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" /><circle cx="12" cy="7" r="4" />
                                        </svg>
                                        Mon profil
                                    </a>
                                @else
                                    {{-- Admin/Employee Dashboard Link --}}
                                    <a href="{{ route('admin.dashboard') }}"
                                       class="flex items-center gap-2 px-4 py-2 text-sm text-emerald-600 hover:bg-emerald-50 transition-colors">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                                        </svg>
                                        Tableau de bord
                                    </a>
                                @endif
                                
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('navbar-logout-form').submit();"
                                   class="flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors mt-1">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                        <polyline points="16 17 21 12 16 7"/>
                                        <line x1="21" x2="9" y1="12" y2="12"/>
                                    </svg>
                                    Se déconnecter
                                </a>
                                <form id="navbar-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
</header>
