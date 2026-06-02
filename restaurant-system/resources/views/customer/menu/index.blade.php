<x-customer.layouts.app>
    <x-slot:title>Commander en Ligne - Resto Manager</x-slot:title>

    <div x-data="{ categoryDropdownOpen: false }" 
         @add-to-cart.window="addToCart($event.detail)"
         class="relative min-h-screen bg-[#FDFBF7] font-sans pb-16">

        <!-- ===== HERO SECTION (Relaxing Welcome Billboard) ===== -->
        <section class="max-w-[1240px] mx-auto px-6 pt-6">
            <div class="relative overflow-hidden bg-gradient-to-br from-stone-900 via-emerald-950 to-stone-950 rounded-[32px] p-8 lg:p-12 shadow-xl border border-emerald-950/40 text-start">
                
                <!-- Gentle visual glow overlay -->
                <div class="absolute inset-0 z-0 opacity-15 pointer-events-none">
                    <div class="absolute -top-24 -right-24 w-80 h-80 bg-emerald-500 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-amber-200 rounded-full blur-3xl"></div>
                </div>

                <div class="relative z-10 grid lg:grid-cols-12 gap-8 items-center">
                    
                    <!-- Left: Welcome text -->
                    <div class="lg:col-span-7 space-y-4">
                        <span class="inline-flex items-center gap-1.5 py-1 px-3.5 bg-emerald-500/10 border border-emerald-400/20 text-emerald-300 text-[10px] font-black rounded-full uppercase tracking-wider">
                            🍷 Carte & Saveurs
                        </span>
                        <h1 class="text-3xl lg:text-5xl font-serif font-extrabold text-white tracking-tight leading-tight">
                            Installez-vous confortablement...
                        </h1>
                        <p class="text-sm lg:text-base text-stone-300 font-medium leading-relaxed max-w-xl">
                            Découvrez notre carte préparée avec amour et des ingrédients frais de saison. Composez votre festin à votre rythme et laissez vos envies s'exprimer.
                        </p>

                        <div class="pt-2 flex flex-wrap gap-4 text-[10px] font-bold uppercase tracking-widest text-stone-400">
                            <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Cuisine Artisanale</span>
                            <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Produits de Saison</span>
                            <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Expérience Privilégiée</span>
                        </div>
                    </div>

                    <!-- Right: Gorgeous Overlapping Culinary Showcase (Desktop only) -->
                    <div class="lg:col-span-5 relative hidden lg:flex justify-end pr-8">
                        <div class="relative w-72 h-72">
                            <!-- Background golden radial flare -->
                            <div class="absolute inset-4 bg-amber-300/10 rounded-full filter blur-xl animate-pulse"></div>
                            
                            <!-- Plate 2 (Back plate) -->
                            <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?auto=format&fit=crop&w=400&q=80" 
                                 alt="Pizza Artisanale"
                                 class="w-40 h-40 rounded-full object-cover border-4 border-[#FAF9F6]/90 shadow-2xl absolute -bottom-2 -left-6 z-0 -rotate-12 transform hover:rotate-0 hover:scale-105 transition-all duration-500">

                            <!-- Plate 1 (Front plate) -->
                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=500&q=80" 
                                 alt="Salade Fraîche"
                                 class="w-56 h-56 rounded-full object-cover border-4 border-[#FAF9F6] shadow-2xl absolute top-2 right-2 z-10 rotate-6 transform hover:rotate-0 hover:scale-105 transition-all duration-500">
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ===== MAIN CONTENT (Scalable 3-Column Layout) ===== -->
        <main class="max-w-[1240px] mx-auto px-6 py-10">

            <!-- MOBILE ACCORDION CATEGORY FILTER (Visible on Mobile Only) -->
            <div class="hs-dropdown relative w-full lg:hidden mb-6 [--placement:bottom-left]">
                <button id="hs-dropdown-mobile-category" type="button" class="hs-dropdown-toggle w-full bg-white border border-stone-200 rounded-2xl py-3.5 px-5 flex items-center justify-between text-xs font-extrabold text-stone-750 shadow-sm transition-all" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-700"></span>
                        <span class="uppercase tracking-wider">
                            <span x-show="activeCategory === 'all'">Tout voir</span>
                            @foreach($categories as $category)
                                <span x-show="activeCategory === '{{ $category->id }}'" style="display: none;">{{ $category->name }}</span>
                            @endforeach
                        </span>
                    </span>
                    <svg class="hs-dropdown-open:rotate-180 w-4 h-4 text-stone-400 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="m19.5 8.25-7.5 7.5-7.5-7.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                
                <!-- Dropdown List Overlay -->
                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden mt-2 z-50 w-full bg-white border border-stone-200 rounded-2xl shadow-xl max-h-64 overflow-y-auto p-2 space-y-1" aria-labelledby="hs-dropdown-mobile-category">
                    
                    <button @click="activeCategory = 'all'" 
                            class="w-full text-start py-2.5 px-4 text-xs font-bold rounded-xl transition-all"
                            :class="activeCategory === 'all' ? 'bg-emerald-50 text-emerald-800' : 'text-stone-600 hover:bg-stone-50'">
                        Tout voir
                    </button>
                    
                    @foreach($categories as $category)
                        <button @click="activeCategory = '{{ $category->id }}'" 
                                class="w-full text-start py-2.5 px-4 text-xs font-bold rounded-xl transition-all"
                                :class="activeCategory === '{{ $category->id }}' ? 'bg-emerald-50 text-emerald-800' : 'text-stone-600 hover:bg-stone-50'">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- ===== 3-COLUMN WORKSPACE ===== -->
            <div class="grid lg:grid-cols-12 gap-8 items-start">
                
                <!-- COLUMN 1: Sticky Vertical Categories Sidebar (3/12 Cols - Desktop Only) -->
                <aside class="hidden lg:block lg:col-span-3 sticky top-24 max-h-[75vh] overflow-y-auto no-scrollbar bg-white border border-stone-150 rounded-[32px] p-5 shadow-sm shadow-stone-100/40">
                    <h3 class="font-serif font-bold text-stone-850 text-base mb-4 border-b border-stone-100 pb-3">Catégories</h3>
                    <div class="space-y-1">
                        
                        <!-- All Button -->
                        <button @click="activeCategory = 'all'" 
                                :class="activeCategory === 'all' ? 'bg-emerald-50 text-emerald-800 border-l-4 border-emerald-700 font-extrabold pl-3' : 'text-stone-550 hover:bg-stone-50 pl-2'"
                                class="w-full text-start py-2.5 px-2 text-xs rounded-r-xl transition-all flex items-center justify-between group">
                            <span class="uppercase tracking-wider">Tout voir</span>
                            <span :class="activeCategory === 'all' ? 'bg-emerald-100 text-emerald-800' : 'bg-stone-100 text-stone-500'"
                                  class="text-[9px] font-extrabold px-2 py-0.5 rounded-full transition-colors">
                                {{ $categories->sum(fn($cat) => $cat->menuItems->count()) }}
                            </span>
                        </button>

                        <!-- Loop Categories Buttons -->
                        @foreach($categories as $category)
                            <button @click="activeCategory = '{{ $category->id }}'" 
                                    :class="activeCategory === '{{ $category->id }}' ? 'bg-emerald-50 text-emerald-800 border-l-4 border-emerald-700 font-extrabold pl-3' : 'text-stone-550 hover:bg-stone-50 pl-2'"
                                    class="w-full text-start py-2.5 px-2 text-xs rounded-r-xl transition-all flex items-center justify-between group">
                                <span class="uppercase tracking-wider truncate mr-2">{{ $category->name }}</span>
                                <span :class="activeCategory === '{{ $category->id }}' ? 'bg-emerald-100 text-emerald-800' : 'bg-stone-100 text-stone-500'"
                                      class="text-[9px] font-extrabold px-2 py-0.5 rounded-full transition-colors flex-shrink-0">
                                    {{ $category->menuItems->count() }}
                                </span>
                            </button>
                        @endforeach
                    </div>
                </aside>

                <!-- COLUMN 2: Menu Catalog Grid (9/12 Cols on Desktop, 12/12 on Mobile) -->
                <div class="col-span-12 lg:col-span-9 space-y-12">
                    <div class="space-y-12">
                        @foreach($categories as $category)
                            <div x-show="activeCategory === 'all' || activeCategory === '{{ $category->id }}'" 
                                 x-transition:enter="transition ease-out duration-250"
                                 x-transition:enter-start="opacity-0 translate-y-4"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 class="space-y-6">
                                
                                <!-- Elegant Serif Category Header -->
                                <div class="flex items-center justify-between border-b border-stone-200 pb-3">
                                    <h2 class="text-xl font-serif font-extrabold text-stone-855 tracking-tight flex items-center gap-2">
                                        <span class="w-1.5 h-6 bg-emerald-700 rounded-full"></span>
                                        {{ $category->name }}
                                    </h2>
                                    <span class="text-[10px] font-extrabold text-emerald-800 bg-emerald-50/70 border border-emerald-100/50 px-3 py-1 rounded-full uppercase tracking-wider">
                                        {{ $category->menuItems->count() }} Spécialités
                                    </span>
                                </div>
                                
                                <!-- Products Grid -->
                                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-8">
                                    @foreach($category->menuItems as $item)
                                        <x-customer.product-card :item="$item" />
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>


    </div>

</x-customer.layouts.app>
