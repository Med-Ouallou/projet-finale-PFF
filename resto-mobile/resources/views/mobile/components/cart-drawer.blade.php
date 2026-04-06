<div x-show="$store.cart.isOpen" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
    x-transition:leave-end="translate-x-full"
    class="fixed top-0 end-0 h-full max-w-sm w-full z-[90] bg-white border-s border-gray-100 shadow-2xl">
    <div class="flex justify-between items-center px-6 py-8 border-b border-gray-100 h-28">
        <div>
            <h3 class="font-heading font-black text-slate-800 text-xl uppercase tracking-tighter">Mon Panier</h3>
            <p class="text-xs text-gray-400 font-bold"><span x-text="$store.cart.count"></span> article(s)</p>
        </div>
        <button @click="$store.cart.isOpen = false"
            class="size-11 flex justify-center items-center rounded-2xl bg-gray-50 text-gray-400 active:bg-red-50 active:text-red-500 transition-all">
            <svg class="size-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path d="M18 6 6 18M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div class="p-6 space-y-4 overflow-y-auto h-[calc(100%-340px)] scrollbar-hide">
        <div x-show="$store.cart.items.length === 0"
            class="flex flex-col items-center justify-center h-full py-10 opacity-40 grayscale">
            <div class="size-24 bg-gray-50 rounded-[40px] flex items-center justify-center mb-6">🥗</div>
            <p class="text-sm font-black text-gray-400 uppercase tracking-widest">Panier vide</p>
        </div>

        <template x-for="(item, index) in $store.cart.items" :key="item.id">
            <div class="flex items-center gap-4 bg-gray-50/50 border border-gray-100 p-4 rounded-3xl">
                <div
                    class="size-14 rounded-2xl bg-emerald-100 flex items-center justify-center font-black text-emerald-800 text-sm overflow-hidden flex-shrink-0">
                    <span x-text="item.name.charAt(0)"></span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-black text-gray-800 truncate" x-text="item.name"></p>
                    <p class="text-xs text-emerald-600 font-black"><span x-text="item.price.toFixed(2)"></span> DH</p>
                </div>
                <div class="flex items-center gap-3">
                    <button @click="$store.cart.changeQty(index, -1)"
                        class="size-8 rounded-full bg-white border border-gray-200 text-gray-600 flex items-center justify-center font-black transition-all">-</button>
                    <span class="text-sm font-black text-gray-800 w-4 text-center"
                        x-text="item.quantity"></span>
                    <button @click="$store.cart.changeQty(index, 1)"
                        class="size-8 rounded-full bg-emerald-600 text-white flex items-center justify-center font-black shadow-sm">+</button>
                </div>
            </div>
        </template>
    </div>

    <div class="absolute bottom-0 w-full px-6 pb-12 pt-6 border-t border-gray-100 bg-white/90 backdrop-blur-md">
        <div class="flex justify-between items-center mb-8">
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Total</span>
            <span class="text-3xl font-black font-heading text-emerald-700"><span
                    x-text="$store.cart.total.toFixed(2)"></span> DH</span>
        </div>
        <a :href="$store.cart.whatsappUrl" target="_blank"
            class="block w-full py-5 bg-emerald-600 text-white text-sm font-black text-center rounded-3xl shadow-2xl shadow-emerald-200 transition-all active:scale-95"
            :class="{ 'opacity-30 grayscale pointer-events-none': $store.cart.items.length === 0 }">
            Commander (WhatsApp)
        </a>
    </div>
</div>

<div x-show="$store.cart.isOpen" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" @click="$store.cart.isOpen = false"
    class="fixed inset-0 bg-black/20 backdrop-blur-sm z-[85]"></div>
