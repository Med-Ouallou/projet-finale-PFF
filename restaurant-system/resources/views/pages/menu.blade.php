<x-layouts.app>
    <x-slot:title>Commander en Ligne - Resto Manager</x-slot:title>

    <div x-data="cartManager()" 
         @add-to-cart.window="addToCart($event.detail)"
         class="relative min-h-screen">

        <!-- ===== HERO SECTION ===== -->
        <section class="bg-emerald-900 relative overflow-hidden text-start">
            <div class="absolute inset-0 opacity-10 pointer-events-none">
                <div class="absolute -top-20 -right-20 size-80 bg-emerald-400 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-20 -left-20 size-64 bg-amber-400 rounded-full blur-3xl"></div>
            </div>

            <div class="max-w-[1200px] mx-auto px-6 py-12 lg:py-16 relative">
                <h1 class="text-4xl lg:text-5xl font-black font-heading text-white max-w-2xl leading-tight">
                    Explorez nos saveurs authentiques <span class="text-emerald-400">faites maison</span>
                </h1>
                <p class="mt-4 text-emerald-200/80 text-lg max-w-xl font-medium">
                    Découvrez notre carte renouvelée chaque saison avec des produits frais du terroir.
                </p>

                <div class="mt-8 flex flex-wrap gap-4 text-[10px] font-bold uppercase tracking-widest text-emerald-100/60">
                    <span class="flex items-center gap-2"><span class="size-1.5 bg-emerald-400 rounded-full"></span> Livraison Rapide</span>
                    <span class="flex items-center gap-2"><span class="size-1.5 bg-emerald-400 rounded-full"></span> Produits Frais</span>
                    <span class="flex items-center gap-2"><span class="size-1.5 bg-emerald-400 rounded-full"></span> Meilleur Prix</span>
                </div>
            </div>
        </section>

        <!-- ===== MAIN CONTENT ===== -->
        <main class="max-w-[1200px] mx-auto px-6 py-12 text-start">

            <!-- Category Pills -->
            <div class="sticky top-[72px] z-40 bg-gray-50/80 backdrop-blur-sm -mx-6 px-6 py-4 mb-10 border-b border-gray-200 overflow-x-auto no-scrollbar flex gap-2">
                <button @click="activeCategory = 'all'" 
                        :class="activeCategory === 'all' ? 'bg-emerald-600 text-white' : 'bg-white text-gray-500 hover:border-emerald-300'"
                        class="shrink-0 py-2.5 px-6 text-xs font-bold rounded-full border border-gray-200 shadow-sm transition-all focus:outline-none">
                    Tout voir
                </button>
                @foreach($categories as $category)
                    <button @click="activeCategory = '{{ $category->id }}'" 
                            :class="activeCategory === '{{ $category->id }}' ? 'bg-emerald-600 text-white' : 'bg-white text-gray-500 hover:border-emerald-300'"
                            class="shrink-0 py-2.5 px-6 text-xs font-bold rounded-full border border-gray-200 shadow-sm transition-all focus:outline-none uppercase tracking-wider">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            <!-- Products Grid -->
            <div class="space-y-16">
                @foreach($categories as $category)
                    <div x-show="activeCategory === 'all' || activeCategory === '{{ $category->id }}'" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform translate-y-4"
                         x-transition:enter-end="opacity-100 transform translate-y-0">
                        
                        <h2 class="text-xl font-black font-heading text-gray-900 mb-8 border-l-4 border-emerald-600 pl-4 uppercase tracking-tight">
                            {{ $category->name }}
                        </h2>
                        
                        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-6 gap-y-10">
                            @foreach($category->menuItems as $item)
                                <x-ui.product-card :item="$item" />
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </main>

        <!-- CART TOGGLE BUTTON (Floating) -->
        <button @click="cartOpen = true" 
                class="fixed bottom-8 right-8 z-[60] size-16 bg-emerald-600 text-white rounded-2xl shadow-2xl flex items-center justify-center hover:scale-110 active:scale-95 transition-all">
            <svg class="size-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" /><path d="M3 6h18m-5 4a4 4 0 1 1-8 0" />
            </svg>
            <span x-show="itemCount > 0" x-cloak
                  class="absolute -top-2 -right-2 size-6 flex items-center justify-center bg-red-500 text-white text-xs font-bold rounded-full border-2 border-white animate-bounce">
                <span x-text="itemCount"></span>
            </span>
        </button>

        <!-- CART DRAWER (ALPINE OVERLAY) -->
        <div x-show="cartOpen" x-cloak class="fixed inset-0 z-[100] overflow-hidden">
            <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" @click="cartOpen = false"></div>
            
            <div x-show="cartOpen" 
                 x-transition:enter="transition ease-in-out duration-300 sm:duration-500"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in-out duration-300 sm:duration-500"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full"
                 class="absolute inset-y-0 right-0 max-w-full flex">
                
                <div class="w-screen max-w-sm bg-white shadow-2xl border-l border-gray-100 flex flex-col">
                    <!-- Header -->
                    <div class="flex justify-between items-center px-6 py-5 border-b border-gray-100">
                        <div>
                            <h3 class="font-bold font-heading text-gray-800 text-lg uppercase tracking-tight">Mon Panier</h3>
                            <p class="text-xs text-gray-400 font-bold" x-text="itemCount > 0 ? itemCount + ' article(s)' : 'Panier vide'"></p>
                        </div>
                        <button type="button" @click="cartOpen = false"
                                class="size-9 flex justify-center items-center rounded-xl bg-gray-50 hover:bg-red-50 text-gray-400 hover:text-red-500 transition-all">
                            <svg class="size-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M18 6 6 18M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>

                    <!-- Scrollable content -->
                    <div class="flex-1 overflow-y-auto p-6 space-y-4">
                        <template x-if="cart.length === 0">
                            <div class="flex flex-col items-center justify-center h-full py-10 text-center opacity-40">
                                <div class="size-20 bg-gray-50 rounded-3xl flex items-center justify-center mb-4">
                                    <svg class="size-10 text-gray-200" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" /><path d="M3 6h18M16 10a4 4 0 0 1-8 0" />
                                    </svg>
                                </div>
                                <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Panier vide</p>
                            </div>
                        </template>

                        <template x-for="(item, index) in cart" :key="item.id">
                            <div class="flex items-center gap-4 bg-gray-50/50 border border-gray-100 p-3 rounded-2xl group transition-all hover:bg-white hover:shadow-md">
                                <div class="size-12 rounded-xl bg-gray-200 overflow-hidden flex-shrink-0">
                                     <div class="w-full h-full bg-emerald-100 flex items-center justify-center font-bold text-emerald-800 text-xs" x-text="item.name[0]"></div>
                                </div>
                                <div class="flex-1 min-w-0 text-start">
                                    <p class="text-sm font-bold text-gray-800 truncate" x-text="item.name"></p>
                                    <p class="text-xs text-emerald-600 font-bold" x-text="(item.price * item.quantity).toFixed(2) + ' DH'"></p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button @click="changeQty(index, -1)" class="size-6 rounded-full bg-white border border-gray-200 text-gray-600 flex items-center justify-center text-xs hover:bg-red-50 hover:text-red-500 transition-all font-bold">×</button>
                                    <span class="text-sm font-black text-gray-800 w-4 text-center" x-text="item.quantity"></span>
                                    <button @click="changeQty(index, 1)" class="size-6 rounded-full bg-emerald-600 text-white flex items-center justify-center text-xs hover:bg-emerald-700 transition-all shadow-sm font-bold">+</button>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Footer -->
                    <div class="px-6 py-6 border-t border-gray-100 bg-gray-50/50">
                        <div class="flex justify-between items-center mb-6">
                            <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">Total à payer</span>
                            <span class="text-2xl font-black font-heading text-emerald-700 leading-none" x-text="totalPrice.toFixed(2) + ' DH'"></span>
                        </div>

                        <button @click="sendToWhatsApp()" 
                                :disabled="cart.length === 0"
                                class="w-full py-4 px-6 inline-flex justify-center items-center gap-x-3 text-sm font-bold rounded-2xl bg-emerald-600 text-white hover:bg-emerald-800 transition-all shadow-xl shadow-emerald-200/50 active:scale-95 disabled:opacity-40 disabled:grayscale">
                            <svg class="size-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.171.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.538-2.961-2.654-.087-.116-.708-.941-.708-1.795 0-.855.449-1.277.608-1.45.159-.174.348-.217.464-.217.116 0 .232.001.333.006.106.005.249-.04.391.305.144.35.492 1.203.535 1.29.043.087.072.188.014.305-.058.116-.087.188-.174.29-.087.101-.183.225-.261.305-.087.087-.179.183-.077.358.101.174.451.745.966 1.204.664.591 1.224.774 1.398.86.174.087.275.072.376-.044.101-.116.435-.508.55-.682.116-.174.232-.145.391-.087.159.058 1.014.478 1.187.565.174.087.29.131.334.203.04.072.04.417-.104.821zM12 1c6.075 0 11 4.925 11 11s-4.925 11-11 11S1 18.075 1 12 5.925 1 12 1z" />
                            </svg>
                            Commander via WhatsApp
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
