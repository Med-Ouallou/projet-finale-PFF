@extends('mobile.layouts.app')

@section('title', 'RestoManager - Menu')
@section('body-class', 'bg-gray-50/50')

@section('content')

<div x-data="menu('{{ config('resto.api_url') }}')"
    x-init="init(); $store.cart.init('{{ config('resto.whatsapp_phone') }}')">

    <!-- Header / Sticky NavBar -->
    <header class="bg-white/80 backdrop-blur-md sticky top-0 z-40 border-b border-gray-100">
        <div class="px-6 py-4 flex items-center justify-between">
            <h1 class="font-heading font-black text-xl text-slate-900 tracking-tight">Notre <span
                    class="text-emerald-600">Menu</span></h1>

            <button @click="$store.cart.isOpen = true"
                class="relative group active:scale-95 transition-transform p-3 bg-emerald-50 rounded-2xl shadow-sm">
                <svg class="size-6 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                    <path d="M3 6h18M16 10a4 4 0 0 1-8 0" />
                </svg>
                <span x-show="$store.cart.count > 0" x-text="$store.cart.count"
                    class="absolute -top-1 -right-1 size-5 bg-emerald-600 text-white text-[10px] font-black rounded-full flex items-center justify-center border-2 border-white shadow-lg transition-all duration-300"></span>
            </button>
        </div>

        <!-- Categories Filter -->
        <div class="flex gap-3 overflow-x-auto px-6 pb-4 scrollbar-hide">
            <button @click="selectedCategory = null"
                :class="selectedCategory === null ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'bg-white border border-gray-100 text-gray-400'"
                class="flex-shrink-0 px-5 py-2.5 text-xs font-bold rounded-2xl uppercase tracking-wider transition-all">Tout</button>
            <template x-for="cat in categories" :key="cat.id">
                <button @click="selectedCategory = cat.id"
                    :class="selectedCategory === cat.id ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'bg-white border border-gray-100 text-gray-400'"
                    class="flex-shrink-0 px-5 py-2.5 text-xs font-bold rounded-2xl uppercase tracking-wider transition-all"
                    x-text="cat.name"></button>
            </template>
        </div>
    </header>

    <main class="p-6">
        <!-- Loading skeleton -->
        <template x-if="loading">
            <div class="space-y-6">
                <template x-for="i in 3" :key="i">
                    <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden">
                        <div class="h-44 bg-gray-100 animate-pulse"></div>
                        <div class="p-5 space-y-3">
                            <div class="h-4 bg-gray-100 rounded w-3/4 animate-pulse"></div>
                            <div class="h-3 bg-gray-100 rounded w-full animate-pulse"></div>
                            <div class="h-12 bg-gray-100 rounded-2xl animate-pulse"></div>
                        </div>
                    </div>
                </template>
            </div>
        </template>

        <!-- Product List -->
        <div class="space-y-6">
            <template x-for="item in filteredItems" :key="item.id">
                <div
                    class="flex flex-col bg-white border border-gray-100 rounded-3xl overflow-hidden shadow-sm active:scale-[0.98] transition-all duration-300">
                    <div class="relative h-44">
                        <img class="w-full h-full object-cover"
                            :src="item.image_url || 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400'"
                            :alt="item.name">
                        <span x-show="item.category"
                            class="absolute top-3 left-3 py-1 px-3 bg-emerald-600 text-white text-[10px] font-black rounded-full shadow-lg"
                            x-text="item.category ? item.category.name : ''"></span>
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <h3 class="font-heading font-black text-gray-900" x-text="item.name"></h3>
                            <span class="text-emerald-700 font-black font-heading"><span
                                    x-text="parseFloat(item.price).toFixed(2)"></span> DH</span>
                        </div>
                        <p class="text-[11px] text-gray-400 mt-2 mb-5 leading-relaxed"
                            x-text="item.description"></p>
                        <button @click="$store.cart.addItem(item)"
                            class="w-full py-3 bg-emerald-600 text-white text-xs font-black rounded-2xl shadow-lg shadow-emerald-200 transition-all active:scale-95 flex items-center justify-center gap-2">
                            <svg class="size-4" fill="none" stroke="currentColor" stroke-width="3"
                                viewBox="0 0 24 24">
                                <path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Ajouter
                        </button>
                    </div>
                </div>
            </template>

            <!-- Empty state -->
            <template x-if="!loading && filteredItems.length === 0">
                <div class="flex flex-col items-center justify-center py-20 opacity-40 grayscale">
                    <div class="size-24 bg-gray-50 rounded-[40px] flex items-center justify-center mb-6">🍽️</div>
                    <p class="text-sm font-black text-gray-400 uppercase tracking-widest">Aucun plat</p>
                </div>
            </template>
        </div>
    </main>

    <!-- Cart Drawer -->
    @include('mobile.components.cart-drawer')

</div>

@endsection
