@props(['item'])

<div data-id="{{ $item->id }}" 
     data-name="{{ $item->name }}" 
     data-price="{{ $item->price }}"
     class="group flex flex-col bg-white border border-gray-100 shadow-sm rounded-3xl overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
    
    <div class="relative h-48 overflow-hidden">
        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
             src="{{ $item->image_url ?? 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600' }}" 
             alt="{{ $item->name }}">
        
        <div class="absolute top-3 left-3 flex flex-col gap-1">
            @if($item->is_popular)
                <span class="py-1 px-3 text-[10px] font-bold bg-emerald-600 text-white rounded-full shadow-lg backdrop-blur-sm self-start uppercase tracking-wider">
                    Populaire
                </span>
            @endif
        </div>
    </div>

    <div class="p-5 flex flex-col flex-1 text-start">
        <div class="flex justify-between items-start mb-1">
            <h3 class="text-base font-bold font-heading text-gray-900 group-hover:text-emerald-700 transition-colors">
                {{ $item->name }}
            </h3>
        </div>
        <p class="text-[11px] text-gray-400 leading-relaxed line-clamp-2 mt-1 mb-4 flex-1">
            {{ $item->description }}
        </p>
        
        <div class="flex justify-between items-center pt-2 mt-auto">
            <div class="flex flex-col">
                <span class="text-lg font-black font-heading text-emerald-700 leading-none">
                    {{ number_format($item->price, 2) }} DH
                </span>
                <span class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-0.5">TTC</span>
            </div>
            
            <button type="button" 
                    @click="addToCart({ id: '{{ $item->id }}', name: '{{ $item->name }}', price: {{ $item->price }} })"
                    aria-label="Ajouter {{ $item->name }} au panier"
                    class="py-2.5 px-5 inline-flex items-center gap-x-1.5 text-xs font-bold rounded-2xl bg-emerald-600 text-white hover:bg-emerald-900 transition-all shadow-lg shadow-emerald-200 active:scale-95 group/btn">
                <svg class="w-3.5 h-3.5 group-hover/btn:rotate-90 transition-transform"
                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                </svg>
                Ajouter
            </button>
        </div>
    </div>
</div>
