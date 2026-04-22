<header x-data="{ mobileMenuOpen: false }" class="flex flex-wrap sm:justify-start sm:flex-nowrap z-50 w-full bg-white/90 backdrop-blur-md border-b border-gray-100 text-sm py-2 sm:py-0 sticky top-0 shadow-sm">
    <nav class="relative max-w-[1200px] w-full mx-auto px-6 sm:flex sm:items-center sm:justify-between" aria-label="Global">
        <div class="flex items-center justify-between h-16">
            <a class="flex items-center gap-2.5 text-xl font-bold font-heading text-slate-900 focus:outline-none" href="{{ route('accueil') }}">
                <div class="flex items-center justify-center w-9 h-9 bg-emerald-600 rounded-xl shadow-lg shadow-emerald-200">
                    <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                    </svg>
                </div>
                Resto<span class="text-emerald-600">Manager</span>
            </a>
            <div class="sm:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="w-9 h-9 flex justify-center items-center rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50">
                    <svg x-show="!mobileMenuOpen" class="w-4 h-4" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                    </svg>
                    <svg x-show="mobileMenuOpen" x-cloak class="w-4 h-4" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                </button>
            </div>
        </div>
        
        <div :class="{ 'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }" class="hidden overflow-hidden transition-all duration-300 basis-full grow sm:block">
            <div class="flex flex-col gap-y-4 gap-x-0 mt-5 sm:flex-row sm:items-center sm:justify-end sm:gap-y-0 sm:gap-x-8 sm:mt-0 sm:ps-7">
                <a class="font-medium {{ request()->routeIs('accueil') ? 'text-emerald-600 border-b-2 border-emerald-500' : 'text-gray-500 hover:text-gray-800' }} pb-4 text-sm transition-colors" href="{{ route('accueil') }}">Accueil</a>
                <a class="font-medium {{ request()->routeIs('menu') ? 'text-emerald-600 border-b-2 border-emerald-500' : 'text-gray-500 hover:text-gray-800' }} pb-4 text-sm transition-colors" href="{{ route('menu') }}">Menu</a>
                <a class="font-medium {{ request()->routeIs('contact') ? 'text-emerald-600 border-b-2 border-emerald-500' : 'text-gray-500 hover:text-gray-800' }} pb-4 text-sm transition-colors" href="{{ route('contact') }}">Contact</a>
                
                <div class="sm:ps-4 pb-4 sm:border-s border-gray-200">
                    <a href="{{ route('admin.login') }}" class="py-2.5 px-5 inline-flex items-center gap-x-2 text-sm font-semibold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-md shadow-emerald-200 transition-all hover:shadow-lg hover:shadow-emerald-200 hover:-translate-y-0.5">
                        Connexion
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>
