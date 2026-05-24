<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Resto Manager') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body x-data="cartManager()" class="bg-[#FDFBF7] h-full font-sans antialiased">
    <div id="app" class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <x-customer.navbar />

        <!-- Main Content -->
        <main class="flex-1">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <x-customer.footer />
    </div>

    <!-- ===== GLOBAL CART SLIDE-OUT DRAWER (POPUP RIGHT) ===== -->
    <div id="hs-offcanvas-cart" class="hs-overlay hs-overlay-open:translate-x-0 hidden translate-x-full fixed top-0 end-0 transition-all duration-300 transform h-full max-w-sm w-full z-[100] bg-white shadow-2xl border-l border-stone-150 flex flex-col" tabindex="-1">
        <!-- Drawer Header -->
        <div class="flex justify-between items-center px-5 py-4.5 border-b border-stone-100">
            <div>
                <h3 class="font-serif font-bold text-stone-850 text-base">Mon Panier</h3>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-0.5" x-text="itemCount > 0 ? itemCount + ' article(s)' : 'Panier vide'"></p>
            </div>
            <button type="button" data-hs-overlay="#hs-offcanvas-cart"
                    class="w-8 h-8 flex justify-center items-center rounded-xl bg-stone-50 hover:bg-red-50 text-gray-450 hover:text-red-500 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M18 6 6 18M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>

        <!-- Scrollable Basket Items -->
        <div class="flex-1 overflow-y-auto p-5 space-y-3.5 no-scrollbar">
            <template x-if="cart.length === 0">
                <div class="flex flex-col items-center justify-center h-full py-10 text-center opacity-30">
                    <span class="text-3xl mb-3">🍽️</span>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest leading-none">Votre panier est vide</p>
                </div>
            </template>

            <template x-for="(item, index) in cart" :key="item.id">
                <div class="flex items-center gap-3 bg-stone-50/50 border border-stone-100 p-3 rounded-2xl transition-all hover:bg-white hover:shadow-sm">
                    <!-- Monogram -->
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-100 flex-shrink-0 flex items-center justify-center text-xs font-black text-emerald-800 uppercase shadow-inner">
                        <span x-text="item.name[0]"></span>
                    </div>
                    <div class="flex-1 min-w-0 text-start">
                        <p class="text-xs font-bold text-stone-850 truncate" x-text="item.name"></p>
                        <p class="text-xs text-emerald-700 font-extrabold mt-0.5" x-text="(item.price * item.quantity).toFixed(2) + ' DH'"></p>
                    </div>
                    
                    <!-- Qty adjustment -->
                    <div class="flex items-center bg-white border border-stone-150 rounded-lg p-1.5 gap-2.5">
                        <button @click="changeQty(index, -1)" class="w-5 h-5 flex items-center justify-center text-[10px] text-gray-400 hover:text-red-500 transition-colors font-bold">-</button>
                        <span class="text-xs font-bold text-gray-800 w-3 text-center" x-text="item.quantity"></span>
                        <button @click="changeQty(index, 1)" class="w-5 h-5 flex items-center justify-center text-[10px] text-emerald-600 hover:text-emerald-700 transition-colors font-bold">+</button>
                    </div>
                </div>
            </template>
        </div>

        <!-- Drawer Footer Billing -->
        <div class="p-5 border-t border-stone-100 bg-[#FDFBF7]">
            <div class="flex justify-between items-center mb-5">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total à payer</span>
                <span class="text-xl font-serif font-black text-emerald-700" x-text="totalPrice.toFixed(2) + ' DH'"></span>
            </div>

            <button @click="sendToWhatsApp()" 
                    :disabled="cart.length === 0"
                    class="w-full py-3.5 px-5 inline-flex justify-center items-center gap-x-2 text-xs font-bold rounded-full bg-emerald-700 text-[#FAF9F6] hover:bg-emerald-800 transition-all shadow-md active:scale-[0.98] disabled:opacity-40 disabled:grayscale uppercase tracking-wider">
                <svg class="w-4 h-4 animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.171.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.538-2.961-2.654-.087-.116-.708-.941-.708-1.795 0-.855.449-1.277.608-1.45.159-.174.348-.217.464-.217.116 0 .232.001.333.006.106.005.249-.04.391.305.144.35.492 1.203.535 1.29.043.087.072.188.014.305-.058.116-.087.188-.174.29-.087.101-.183.225-.261.305-.087.087-.179.183-.077.358.101.174.451.745.966 1.204.664.591 1.224.774 1.398.86.174.087.275.072.376-.044.101-.116.435-.508.55-.682.116-.174.232-.145.391-.087.159.058 1.014.478 1.187.565.174.087.29.131.334.203.04.072.04.417-.104.821zM12 1c6.075 0 11 4.925 11 11s-4.925 11-11 11S1 18.075 1 12 5.925 1 12 1z" />
                </svg>
                Envoyer la Commande
            </button>
        </div>
    </div>
</body>
</html>
