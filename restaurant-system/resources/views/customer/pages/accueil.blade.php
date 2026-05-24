<x-customer.layouts.app>
    <x-slot:title>Bienvenue chez L'Artisanal - Resto Manager</x-slot:title>

    <div class="relative min-h-screen bg-[#FDFBF7] font-sans pb-20 overflow-hidden">

        <!-- ===== HERO SECTION (Prestigious Dark Ambient Gastronomic Billboard) ===== -->
        <section class="max-w-[1240px] mx-auto px-6 pt-6">
            <div class="relative overflow-hidden bg-gradient-to-br from-stone-900 via-emerald-950 to-stone-950 rounded-[32px] p-8 lg:p-16 shadow-xl border border-emerald-950/40 text-start">
                
                <!-- Gentle luxury glow halos -->
                <div class="absolute inset-0 z-0 opacity-20 pointer-events-none">
                    <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-500 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-amber-300 rounded-full blur-3xl"></div>
                </div>

                <div class="relative z-10 grid lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    
                    <!-- Left Column: High-Impact Luxury Typography -->
                    <div class="lg:col-span-7 space-y-6">
                        <span class="inline-flex items-center gap-1.5 py-1 px-3.5 bg-emerald-500/10 border border-emerald-400/20 text-emerald-300 text-[10px] font-black rounded-full uppercase tracking-wider">
                            ✨ L'Artisanal Gastronomique
                        </span>
                        
                        <h1 class="text-4.5xl lg:text-6xl font-serif font-extrabold text-white leading-tight tracking-tight">
                            Une expérience <br>
                            <span class="text-amber-300 italic font-serif">culinaire d'exception</span> <br>
                            à votre table
                        </h1>
                        
                        <p class="text-sm lg:text-base text-stone-300 font-medium leading-relaxed max-w-xl">
                            Bienvenue dans notre havre gastronomique. Nos chefs passionnés subliment des ingrédients nobles locaux pour composer des assiettes d'exception, alliant tradition culinaire et créativité moderne.
                        </p>
                        
                        <!-- CTA Row with Action Buttons -->
                        <div class="pt-4 flex flex-wrap items-center gap-4">
                            <a href="{{ route('menu') }}" class="inline-flex justify-center items-center gap-x-2 py-4 px-9 text-xs font-black rounded-full bg-emerald-700 text-[#FAF9F6] hover:bg-emerald-800 transition-all shadow-lg shadow-emerald-900/40 active:scale-95 uppercase tracking-widest">
                                Découvrir notre Carte
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                            
                            <a href="{{ route('contact') }}" class="inline-flex justify-center items-center py-4 px-9 text-xs font-black rounded-full border border-stone-700 text-stone-300 hover:bg-stone-850 hover:text-white transition-all active:scale-95 uppercase tracking-widest">
                                Réserver une table
                            </a>
                        </div>

                        <!-- Minimal Sourcing Tags -->
                        <div class="pt-6 flex flex-wrap gap-4 text-[10px] font-bold uppercase tracking-widest text-stone-400">
                            <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Ingrédients Locaux</span>
                            <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Cuisine Haute Couture</span>
                            <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Service Privilégié</span>
                        </div>
                    </div>

                    <!-- Right Column: Fine Circular Golden Frame & Signature Culinary Masterpiece -->
                    <div class="lg:col-span-5 relative flex justify-center items-center pr-6">
                        <div class="relative w-80 lg:w-[420px] aspect-square flex items-center justify-center">
                            
                            <!-- Golden Orbit ring rotation details -->
                            <div class="absolute w-[90%] h-[90%] rounded-full border border-amber-300/10 animate-spin" style="animation-duration: 25s;"></div>
                            <div class="absolute w-[80%] h-[80%] rounded-full border border-dashed border-emerald-500/15"></div>
                            
                            <!-- Background golden radial flare backdrop -->
                            <div class="absolute w-48 h-48 bg-amber-400/10 rounded-full filter blur-2xl"></div>

                            <!-- Master Food Plate cutout in circular framing -->
                            <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=700&q=80" 
                                 alt="Signature Culinary Dish"
                                 class="w-[75%] h-[75%] object-cover rounded-full border-4 border-stone-850 shadow-2xl transform hover:scale-105 hover:rotate-3 transition-all duration-500 z-10">
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ===== PROMO BANNERS GRID ("Les Offres du Moment") ===== -->
        <section class="max-w-[1240px] mx-auto px-6 py-10">
            <div class="grid md:grid-cols-3 gap-6">
                
                <!-- Promo 1 (Le Goût du Gril) -->
                <div class="group bg-gradient-to-br from-stone-900 via-stone-950 to-stone-900 border border-stone-850 rounded-[32px] p-6 relative overflow-hidden h-48 flex flex-col justify-between hover:shadow-lg transition-all duration-300">
                    <div class="absolute -right-6 -bottom-6 w-36 h-36 opacity-35 group-hover:scale-110 transition-transform duration-500">
                        <img src="https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=300&q=80" alt="Grill Promo" class="w-full h-full object-cover rounded-full border-4 border-stone-800">
                    </div>
                    <div class="relative z-10 space-y-2 text-start">
                        <span class="text-[9px] font-black text-amber-400 uppercase tracking-widest">Tradition</span>
                        <h3 class="text-lg font-serif font-extrabold text-white leading-tight">
                            Le Goût <br> du Gril
                        </h3>
                    </div>
                    <div class="relative z-10 text-start">
                        <a href="{{ route('menu') }}" class="text-[10px] font-black text-white hover:text-emerald-400 uppercase tracking-widest flex items-center gap-1.5">
                            Découvrir
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Promo 2 (Double Morbier) -->
                <div class="group bg-gradient-to-br from-amber-400 to-amber-500 rounded-[32px] p-6 relative overflow-hidden h-48 flex flex-col justify-between hover:shadow-lg transition-all duration-300">
                    <div class="absolute -right-6 -bottom-6 w-36 h-36 opacity-30 group-hover:scale-110 transition-transform duration-500">
                        <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=300&q=80" alt="Cheese Promo" class="w-full h-full object-cover rounded-full border-4 border-amber-300">
                    </div>
                    <div class="relative z-10 space-y-2 text-start">
                        <span class="text-[9px] font-black text-stone-950 uppercase tracking-widest">Fondant</span>
                        <h3 class="text-lg font-serif font-extrabold text-stone-950 leading-tight">
                            Double <br> Morbier AOP
                        </h3>
                    </div>
                    <div class="relative z-10 text-start">
                        <a href="{{ route('menu') }}" class="text-[10px] font-black text-stone-950 hover:text-emerald-800 uppercase tracking-widest flex items-center gap-1.5">
                            Découvrir
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Promo 3 (Sain & Gourmand) -->
                <div class="group bg-gradient-to-br from-emerald-800 to-emerald-950 rounded-[32px] p-6 relative overflow-hidden h-48 flex flex-col justify-between hover:shadow-lg transition-all duration-300">
                    <div class="absolute -right-6 -bottom-6 w-36 h-36 opacity-35 group-hover:scale-110 transition-transform duration-500">
                        <img src="https://images.unsplash.com/photo-1473093295043-cdd812d0e601?auto=format&fit=crop&w=300&q=80" alt="Pasta Promo" class="w-full h-full object-cover rounded-full border-4 border-emerald-700">
                    </div>
                    <div class="relative z-10 space-y-2 text-start">
                        <span class="text-[9px] font-black text-amber-200 uppercase tracking-widest">Fait Maison</span>
                        <h3 class="text-lg font-serif font-extrabold text-white leading-tight">
                            Sain & <br> Gourmand
                        </h3>
                    </div>
                    <div class="relative z-10 text-start">
                        <a href="{{ route('menu') }}" class="text-[10px] font-black text-white hover:text-amber-300 uppercase tracking-widest flex items-center gap-1.5">
                            Découvrir
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <!-- ===== "CUSTOMER FAVOURITES" GRID ===== -->
        <section class="max-w-[1240px] mx-auto px-6 py-12 text-start">
            <div class="space-y-1 mb-10">
                <span class="text-xs font-black text-emerald-800 uppercase tracking-widest block">Notre Sélection</span>
                <h2 class="text-2.5xl lg:text-3.5xl font-serif font-extrabold text-stone-850">
                    Customer Favourites
                </h2>
                <p class="text-xs text-stone-500 font-medium">Les incontournables les plus commandés de la semaine.</p>
            </div>

            <!-- Horizontal Favorites Dishes Row -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Dish 1 -->
                <div class="group flex flex-col bg-white border border-stone-150 rounded-[28px] overflow-hidden hover:shadow-xl hover:border-emerald-150/40 hover:-translate-y-1.5 transition-all duration-300">
                    <div class="p-3 pb-0">
                        <div class="relative h-44 rounded-2xl overflow-hidden bg-stone-50 shadow-inner">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                                 src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=400&q=80" 
                                 alt="Morbier Signature">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/10 via-transparent to-transparent opacity-65"></div>
                        </div>
                    </div>
                    <div class="p-5 pt-4 flex flex-col flex-1 text-start">
                        <h3 class="text-lg font-serif font-bold text-gray-850 group-hover:text-emerald-700 transition-colors duration-250 leading-tight">
                            Morbier Signature
                        </h3>
                        <p class="text-xs text-gray-400 font-medium leading-relaxed mt-2 mb-5 flex-1 line-clamp-2 min-h-[36px]">
                            Wagyu premium, fromage Morbier AOP fondant, confit d'oignons caramélisés.
                        </p>
                        <div class="flex justify-between items-center pt-3 border-t border-stone-50 mt-auto">
                            <div class="flex flex-col">
                                <span class="text-lg font-serif font-black text-slate-800 leading-none">
                                    95.00 <span class="text-xs text-emerald-800 font-bold">DH</span>
                                </span>
                                <span class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-1">TTC</span>
                            </div>
                            <a href="{{ route('menu') }}" class="py-2.5 px-4 inline-flex items-center gap-1 text-[11px] font-black rounded-full bg-emerald-700 text-[#FAF9F6] hover:bg-emerald-800 transition-all shadow-sm active:scale-95 group/btn uppercase tracking-wider">
                                <svg class="w-3 h-3 group-hover/btn:rotate-90 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14" /><path d="M12 5v14" />
                                </svg>
                                Ajouter
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Dish 2 -->
                <div class="group flex flex-col bg-white border border-stone-150 rounded-[28px] overflow-hidden hover:shadow-xl hover:border-emerald-150/40 hover:-translate-y-1.5 transition-all duration-300">
                    <div class="p-3 pb-0">
                        <div class="relative h-44 rounded-2xl overflow-hidden bg-stone-50 shadow-inner">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                                 src="https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=400&q=80" 
                                 alt="Filet Mignon Herbes">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/10 via-transparent to-transparent opacity-65"></div>
                        </div>
                    </div>
                    <div class="p-5 pt-4 flex flex-col flex-1 text-start">
                        <h3 class="text-lg font-serif font-bold text-gray-850 group-hover:text-emerald-700 transition-colors duration-250 leading-tight">
                            Filet Mignon Herbes
                        </h3>
                        <p class="text-xs text-gray-400 font-medium leading-relaxed mt-2 mb-5 flex-1 line-clamp-2 min-h-[36px]">
                            Filet de bœuf grillé, infusion au romarin sauvage, beurre de truffe fine.
                        </p>
                        <div class="flex justify-between items-center pt-3 border-t border-stone-50 mt-auto">
                            <div class="flex flex-col">
                                <span class="text-lg font-serif font-black text-slate-800 leading-none">
                                    145.00 <span class="text-xs text-emerald-800 font-bold">DH</span>
                                </span>
                                <span class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-1">TTC</span>
                            </div>
                            <a href="{{ route('menu') }}" class="py-2.5 px-4 inline-flex items-center gap-1 text-[11px] font-black rounded-full bg-emerald-700 text-[#FAF9F6] hover:bg-emerald-800 transition-all shadow-sm active:scale-95 group/btn uppercase tracking-wider">
                                <svg class="w-3 h-3 group-hover/btn:rotate-90 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14" /><path d="M12 5v14" />
                                </svg>
                                Ajouter
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Dish 3 -->
                <div class="group flex flex-col bg-white border border-stone-150 rounded-[28px] overflow-hidden hover:shadow-xl hover:border-emerald-150/40 hover:-translate-y-1.5 transition-all duration-300">
                    <div class="p-3 pb-0">
                        <div class="relative h-44 rounded-2xl overflow-hidden bg-stone-50 shadow-inner">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                                 src="https://images.unsplash.com/photo-1473093295043-cdd812d0e601?auto=format&fit=crop&w=400&q=80" 
                                 alt="Pâtes à la Truffe">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/10 via-transparent to-transparent opacity-65"></div>
                        </div>
                    </div>
                    <div class="p-5 pt-4 flex flex-col flex-1 text-start">
                        <h3 class="text-lg font-serif font-bold text-gray-850 group-hover:text-emerald-700 transition-colors duration-250 leading-tight">
                            Pâtes à la Truffe
                        </h3>
                        <p class="text-xs text-gray-400 font-medium leading-relaxed mt-2 mb-5 flex-1 line-clamp-2 min-h-[36px]">
                            Crème de truffe blanche d'Alba, éclats de noisettes, parmesan affiné.
                        </p>
                        <div class="flex justify-between items-center pt-3 border-t border-stone-50 mt-auto">
                            <div class="flex flex-col">
                                <span class="text-lg font-serif font-black text-slate-800 leading-none">
                                    110.00 <span class="text-xs text-emerald-800 font-bold">DH</span>
                                </span>
                                <span class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-1">TTC</span>
                            </div>
                            <a href="{{ route('menu') }}" class="py-2.5 px-4 inline-flex items-center gap-1 text-[11px] font-black rounded-full bg-emerald-700 text-[#FAF9F6] hover:bg-emerald-800 transition-all shadow-sm active:scale-95 group/btn uppercase tracking-wider">
                                <svg class="w-3 h-3 group-hover/btn:rotate-90 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14" /><path d="M12 5v14" />
                                </svg>
                                Ajouter
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Dish 4 -->
                <div class="group flex flex-col bg-white border border-stone-150 rounded-[28px] overflow-hidden hover:shadow-xl hover:border-emerald-150/40 hover:-translate-y-1.5 transition-all duration-300">
                    <div class="p-3 pb-0">
                        <div class="relative h-44 rounded-2xl overflow-hidden bg-stone-50 shadow-inner">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                                 src="https://images.unsplash.com/photo-1560684352-8497838a2229?auto=format&fit=crop&w=400&q=80" 
                                 alt="Chicken Croustillant">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/10 via-transparent to-transparent opacity-65"></div>
                        </div>
                    </div>
                    <div class="p-5 pt-4 flex flex-col flex-1 text-start">
                        <h3 class="text-lg font-serif font-bold text-gray-850 group-hover:text-emerald-700 transition-colors duration-250 leading-tight">
                            Chicken Croustillant
                        </h3>
                        <p class="text-xs text-gray-400 font-medium leading-relaxed mt-2 mb-5 flex-1 line-clamp-2 min-h-[36px]">
                            Filets de poulet fermier frits, panure aux épices, frites fraîches de saison.
                        </p>
                        <div class="flex justify-between items-center pt-3 border-t border-stone-50 mt-auto">
                            <div class="flex flex-col">
                                <span class="text-lg font-serif font-black text-slate-800 leading-none">
                                    85.00 <span class="text-xs text-emerald-800 font-bold">DH</span>
                                </span>
                                <span class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-1">TTC</span>
                            </div>
                            <a href="{{ route('menu') }}" class="py-2.5 px-4 inline-flex items-center gap-1 text-[11px] font-black rounded-full bg-emerald-700 text-[#FAF9F6] hover:bg-emerald-800 transition-all shadow-sm active:scale-95 group/btn uppercase tracking-wider">
                                <svg class="w-3 h-3 group-hover/btn:rotate-90 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14" /><path d="M12 5v14" />
                                </svg>
                                Ajouter
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ===== "EXPLODED INGREDIENTS" ANATOMY SHOWCASE ===== -->
        <section class="max-w-[1240px] mx-auto px-6 py-12">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-black text-emerald-800 uppercase tracking-widest block mb-1">Pourquoi nos clients nous adorent ?</span>
                <h2 class="text-2.5xl lg:text-3.5xl font-serif font-extrabold text-stone-850">
                    Préparé avec des Ingrédients Premium
                </h2>
                <p class="text-xs text-stone-500 font-medium">Une anatomie transparente de notre burger vedette.</p>
            </div>

            <div class="grid lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left Column: The Exploded Ingredients Stack (Interactive UI Graphic) -->
                <div class="lg:col-span-7 relative flex justify-center items-center h-[520px] bg-white border border-stone-150 rounded-[40px] p-8 shadow-sm">
                    
                    <!-- Exploded Indicator lines & Detail Pills -->
                    <div class="absolute inset-0 z-20 pointer-events-none font-sans">
                        
                        <!-- Ingredient 1: Top Bun -->
                        <div class="absolute top-[48px] left-[10%] lg:left-[15%] flex items-center gap-2">
                            <span class="bg-emerald-50 border border-emerald-100 text-emerald-800 font-black text-[10px] uppercase py-1.5 px-3 rounded-full shadow-sm">Pain Brioché Maison 🍞</span>
                            <div class="w-16 h-px border-t border-dashed border-emerald-600"></div>
                        </div>

                        <!-- Ingredient 2: Veggies -->
                        <div class="absolute top-[168px] right-[10%] lg:right-[15%] flex items-center gap-2">
                            <div class="w-16 h-px border-t border-dashed border-emerald-600"></div>
                            <span class="bg-emerald-50 border border-emerald-100 text-emerald-800 font-black text-[10px] uppercase py-1.5 px-3 rounded-full shadow-sm">Tomates & Salades Bio 🥬</span>
                        </div>

                        <!-- Ingredient 3: Morbier Cheese -->
                        <div class="absolute bottom-[218px] left-[8%] lg:left-[12%] flex items-center gap-2">
                            <span class="bg-emerald-50 border border-emerald-100 text-emerald-800 font-black text-[10px] uppercase py-1.5 px-3 rounded-full shadow-sm">Double Morbier AOP 🧀</span>
                            <div class="w-20 h-px border-t border-dashed border-emerald-600"></div>
                        </div>

                        <!-- Ingredient 4: Wagyu Patty -->
                        <div class="absolute bottom-[98px] right-[10%] lg:right-[15%] flex items-center gap-2">
                            <div class="w-16 h-px border-t border-dashed border-emerald-600"></div>
                            <span class="bg-emerald-50 border border-emerald-100 text-emerald-800 font-black text-[10px] uppercase py-1.5 px-3 rounded-full shadow-sm">100% Viande Wagyu Hachée 🥩</span>
                        </div>

                    </div>

                    <!-- Centered Exploded Gourmet Burger View -->
                    <div class="relative w-80 lg:w-[380px] aspect-square flex justify-center items-center z-10">
                        <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=650&q=80" 
                             alt="Exploded Burger Ingredients"
                             class="w-full h-full object-contain filter drop-shadow-2xl transform hover:scale-105 transition-all duration-500">
                    </div>

                </div>

                <!-- Right Column: Premium Quality CTA Action Box -->
                <div class="lg:col-span-5 bg-stone-50 border border-stone-200 rounded-[32px] p-8 text-start space-y-6 shadow-inner">
                    <span class="inline-flex items-center gap-1.5 py-1 px-3 bg-emerald-50 border border-emerald-100 text-emerald-800 text-[9px] font-black rounded-full uppercase tracking-wider">
                        🥬 100% Ingrédients Locaux
                    </span>
                    
                    <h3 class="text-xl lg:text-2.5xl font-serif font-extrabold text-stone-850 leading-snug">
                        Notre Burger Signature Wagyu
                    </h3>
                    
                    <p class="text-xs text-stone-500 font-medium leading-relaxed">
                        Pour nous, une assiette exceptionnelle commence par le respect du produit. Nous travaillons main dans la main avec des producteurs locaux pour vous livrer des ingrédients frais au lever du jour.
                    </p>

                    <div class="space-y-4 pt-2 border-t border-stone-200">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-black text-stone-700 uppercase tracking-wider">Prix Unitaire</span>
                            <span class="text-xl font-serif font-extrabold text-emerald-800">95 DH</span>
                        </div>
                        
                        <a href="{{ route('menu') }}" class="w-full py-4 px-6 inline-flex justify-center items-center text-xs font-black rounded-full bg-emerald-700 hover:bg-emerald-800 text-[#FAF9F6] shadow-md active:scale-95 transition-all uppercase tracking-widest">
                            Commander maintenant
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <!-- ===== CLIENT REVIEWS SECTION ("Témoignages de nos Hôtes") ===== -->
        <section class="max-w-[1240px] mx-auto px-6 py-12 text-start">
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-2">
                <span class="text-xs font-black text-emerald-800 uppercase tracking-widest block">L'avis de nos hôtes</span>
                <h2 class="text-2.5xl lg:text-3.5xl font-serif font-extrabold text-stone-850 uppercase">
                    Ce qu'ils disent de nous
                </h2>
                <div class="w-12 h-0.5 bg-amber-400 mx-auto mt-2"></div>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                
                <!-- Review Card 1 -->
                <div class="group bg-white border border-stone-150 rounded-[32px] p-8 shadow-sm flex flex-col justify-between space-y-6 hover:shadow-md transition-all duration-300 relative overflow-hidden">
                    <!-- Background quote mark decoration -->
                    <div class="absolute top-4 right-6 text-stone-100/50 z-0 select-none">
                        <svg class="w-16 h-16 fill-current" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.748-9.77 9-10.109v2.334c-2.918.455-4.475 2.226-4.667 5.312h4.667v10h-9zm-11 0v-7.391c0-5.704 3.748-9.77 9-10.109v2.334c-2.918.455-4.475 2.226-4.667 5.312h4.667v10h-9z" />
                        </svg>
                    </div>

                    <div class="relative z-10 space-y-4">
                        <!-- Gold Vector Stars (5 stars) -->
                        <div class="flex items-center gap-1">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-4.5 h-4.5 text-amber-400 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-xs lg:text-sm text-stone-600 font-medium italic leading-relaxed">
                            "Une expérience inoubliable ! Le burger Wagyu au Morbier AOP est une pure merveille. Les saveurs sont équilibrées et le pain brioché maison est incroyablement aérien. Je recommande sans hésiter !"
                        </p>
                    </div>

                    <div class="relative z-10 flex items-center gap-3 pt-4 border-t border-stone-100">
                        <div class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-800 font-black text-xs flex items-center justify-center border border-emerald-100">
                            SM
                        </div>
                        <div>
                            <h4 class="text-xs font-black text-stone-800 uppercase tracking-wide">Sarah M.</h4>
                            <p class="text-[9px] text-stone-400 font-bold uppercase tracking-wider">Critique Culinaire</p>
                        </div>
                    </div>
                </div>

                <!-- Review Card 2 -->
                <div class="group bg-white border border-stone-150 rounded-[32px] p-8 shadow-sm flex flex-col justify-between space-y-6 hover:shadow-md transition-all duration-300 relative overflow-hidden">
                    <!-- Background quote mark decoration -->
                    <div class="absolute top-4 right-6 text-stone-100/50 z-0 select-none">
                        <svg class="w-16 h-16 fill-current" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.748-9.77 9-10.109v2.334c-2.918.455-4.475 2.226-4.667 5.312h4.667v10h-9zm-11 0v-7.391c0-5.704 3.748-9.77 9-10.109v2.334c-2.918.455-4.475 2.226-4.667 5.312h4.667v10h-9z" />
                        </svg>
                    </div>

                    <div class="relative z-10 space-y-4">
                        <!-- Gold Vector Stars (5 stars) -->
                        <div class="flex items-center gap-1">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-4.5 h-4.5 text-amber-400 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-xs lg:text-sm text-stone-600 font-medium italic leading-relaxed">
                            "La qualité des ingrédients se ressent dès la première bouchée. Travailler avec des producteurs locaux fait toute la différence. Le service est impeccable et la commande par WhatsApp ultra-pratique."
                        </p>
                    </div>

                    <div class="relative z-10 flex items-center gap-3 pt-4 border-t border-stone-100">
                        <div class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-800 font-black text-xs flex items-center justify-center border border-emerald-100">
                            AD
                        </div>
                        <div>
                            <h4 class="text-xs font-black text-stone-800 uppercase tracking-wide">Antoine D.</h4>
                            <p class="text-[9px] text-stone-400 font-bold uppercase tracking-wider">Gastronome Passionné</p>
                        </div>
                    </div>
                </div>

                <!-- Review Card 3 -->
                <div class="group bg-white border border-stone-150 rounded-[32px] p-8 shadow-sm flex flex-col justify-between space-y-6 hover:shadow-md transition-all duration-300 relative overflow-hidden">
                    <!-- Background quote mark decoration -->
                    <div class="absolute top-4 right-6 text-stone-100/50 z-0 select-none">
                        <svg class="w-16 h-16 fill-current" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.748-9.77 9-10.109v2.334c-2.918.455-4.475 2.226-4.667 5.312h4.667v10h-9zm-11 0v-7.391c0-5.704 3.748-9.77 9-10.109v2.334c-2.918.455-4.475 2.226-4.667 5.312h4.667v10h-9z" />
                        </svg>
                    </div>

                    <div class="relative z-10 space-y-4">
                        <!-- Gold Vector Stars (5 stars) -->
                        <div class="flex items-center gap-1">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-4.5 h-4.5 text-amber-400 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-xs lg:text-sm text-stone-600 font-medium italic leading-relaxed">
                            "Notre adresse favorite le week-end ! L'ambiance chaleureuse du restaurant est aussi agréable que la livraison rapide à domicile. Les tagliatelles à la truffe blanche sont exceptionnelles."
                        </p>
                    </div>

                    <div class="relative z-10 flex items-center gap-3 pt-4 border-t border-stone-100">
                        <div class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-800 font-black text-xs flex items-center justify-center border border-emerald-100">
                            LR
                        </div>
                        <div>
                            <h4 class="text-xs font-black text-stone-800 uppercase tracking-wide">Léa R.</h4>
                            <p class="text-[9px] text-stone-400 font-bold uppercase tracking-wider">Cliente Fidèle</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ===== GOURMET DELIVERY / MASCOT BANNER ===== -->
        <section class="max-w-[1240px] mx-auto px-6 pt-10 text-center">
            <div class="relative overflow-hidden bg-emerald-50/50 border border-emerald-100 rounded-[40px] p-8 lg:p-12 shadow-sm">
                
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8 text-start max-w-5xl mx-auto">
                    
                    <!-- Left side: Impactful delivery typography -->
                    <div class="space-y-4 max-w-xl">
                        <span class="text-[9px] font-black text-emerald-800 uppercase tracking-widest block">Chez vous en 30 minutes</span>
                        <h2 class="text-2.5xl lg:text-3.5xl font-serif font-extrabold text-stone-850 leading-tight tracking-tight">
                            Votre repas préféré, livré chaud à votre porte
                        </h2>
                        <p class="text-xs text-stone-500 font-medium leading-relaxed">
                            Commandez instantanément via notre carte en ligne, et faites-vous livrer chez vous rapidement. Vos commandes sont expédiées par WhatsApp pour une validation directe !
                        </p>
                        
                        <div class="pt-2">
                            <a href="{{ route('menu') }}" class="inline-flex justify-center items-center gap-x-2 py-3.5 px-8 text-[10px] font-black rounded-full bg-emerald-700 text-[#FAF9F6] hover:bg-emerald-800 transition-all shadow-md active:scale-95 uppercase tracking-widest">
                                Ouvrir le Menu
                            </a>
                        </div>
                    </div>

                    <!-- Right side: Sleek visual mascot card (Delivery bike SVG / representation) -->
                    <div class="relative w-48 h-48 flex-shrink-0 hidden md:flex items-center justify-center">
                        <div class="absolute inset-4 bg-emerald-250/20 rounded-full blur-xl"></div>
                        <!-- Sleek Minimal Delivery Mascot Vector SVG -->
                        <svg class="w-32 h-32 text-emerald-800 z-10 animate-pulse" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124l-.321-5.128a1.135 1.135 0 0 0-1.1-1.061H16.125M16.125 10.5h-2.25M14.25 6h-2.25M12.375 6.75A2.625 2.625 0 1 1 9.75 4.125" />
                        </svg>
                    </div>

                </div>
            </div>
        </section>

    </div>
</x-customer.layouts.app>
