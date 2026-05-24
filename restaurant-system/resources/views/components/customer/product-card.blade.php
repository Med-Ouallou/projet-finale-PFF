@props(['item'])

<div data-id="{{ $item->id }}" 
     data-name="{{ $item->name }}" 
     data-price="{{ $item->price }}"
     class="group flex flex-col bg-white border border-stone-150 rounded-[28px] overflow-hidden hover:shadow-xl hover:border-emerald-150/40 hover:-translate-y-1.5 transition-all duration-300">
    
    <!-- Image Wrapper with rounded cushion margin -->
    <div class="p-3 pb-0">
        <div class="relative h-44 rounded-2xl overflow-hidden bg-stone-50 shadow-inner">
            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                 src="{{ $item->image_url ?? 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600' }}" 
                 alt="{{ $item->name }}">
            
            <!-- Gradient Overlay for Depth -->
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/10 via-transparent to-transparent opacity-65"></div>
            
            <!-- Cozy Popular Badge -->
            @if($item->is_popular ?? false)
                <div class="absolute top-3 left-3">
                    <span class="inline-flex items-center gap-1.5 py-1 px-3.5 text-[9px] font-black bg-[#FDFBF7] text-amber-800 rounded-full shadow-sm uppercase tracking-widest border border-amber-100/50">
                        ★ Populaire
                    </span>
                </div>
            @endif
        </div>
    </div>

    <!-- Card Body Content -->
    <div class="p-5 pt-4 flex flex-col flex-1 text-start">
        <!-- Artisanal Serif Food Name -->
        <h3 class="text-lg font-serif font-bold text-gray-850 group-hover:text-emerald-700 transition-colors duration-250 leading-tight">
            {{ $item->name }}
        </h3>
        
        <p class="text-xs text-gray-400 font-medium leading-relaxed mt-2 mb-5 flex-1 line-clamp-2 min-h-[36px]">
            {{ $item->description }}
        </p>
        
        <div class="flex justify-between items-center pt-3 border-t border-stone-50 mt-auto">
            <!-- Price Display -->
            <div class="flex flex-col">
                <span class="text-lg font-serif font-black text-slate-800 leading-none">
                    {{ number_format($item->price, 2) }} <span class="text-xs text-emerald-800 font-bold">DH</span>
                </span>
                <span class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-1">TTC</span>
            </div>
            
            <!-- Comforting Pill CTA Button -->
            <button type="button" 
                    @click="addToCart({ id: '{{ $item->id }}', name: '{{ $item->name }}', price: {{ $item->price }} })"
                    aria-label="Ajouter {{ $item->name }} au panier"
                    class="py-2.5 px-4 inline-flex items-center gap-1 text-[11px] font-black rounded-full bg-emerald-700 text-[#FAF9F6] hover:bg-emerald-800 transition-all shadow-sm active:scale-95 group/btn uppercase tracking-wider">
                <svg class="w-3 h-3 group-hover/btn:rotate-90 transition-transform duration-300"
                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                </svg>
                Ajouter
            </button>
        </div>
    </div>
</div>
