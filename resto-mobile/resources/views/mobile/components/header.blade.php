<header class="px-6 pt-10 pb-4 flex justify-between items-center bg-white/50 backdrop-blur-sm sticky top-0 z-40">
    <div class="flex items-center gap-3">
        <div
            class="size-10 bg-emerald-600 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-200">
            <svg class="size-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
            </svg>
        </div>
        <div>
            <h1 class="font-heading font-black text-xl text-slate-900 leading-none">Resto<span
                    class="text-emerald-600">M.</span></h1>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-0.5">Mobile App</p>
        </div>
    </div>
    @if($withCart ?? false)
    <button @click="$store.cart.isOpen = true"
        class="size-10 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 shadow-sm relative">
        <svg class="size-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
            <path d="M3 6h18M16 10a4 4 0 0 1-8 0" />
        </svg>
        <span x-show="$store.cart.count > 0" x-text="$store.cart.count"
            class="absolute -top-1 -right-1 size-5 bg-emerald-600 text-white text-[10px] font-black rounded-full flex items-center justify-center border-2 border-white shadow-lg"></span>
    </button>
    @endif
</header>
