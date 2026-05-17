@extends('mobile.layouts.app')

@section('title', 'RestoManager - Accueil')
@section('body-class', 'app-gradient')

@section('content')

<div x-data="accueil('{{ config('resto.api_url') }}')">

    <!-- Header -->
    @include('mobile.components.header')

    <main class="px-6 py-4 space-y-8">

        <!-- Welcome Section -->
        <div>
            <h2 class="font-heading font-black text-3xl text-slate-900 leading-tight">Envie de<br><span
                    class="text-emerald-600">Delicieux ?</span></h2>
            <p class="text-gray-400 text-sm mt-2">Decouvrez nos saveurs artisanales livrees chez vous via WhatsApp.</p>
        </div>

        <!-- Promo Banner -->
        <template x-if="promo">
            <div class="relative rounded-[32px] bg-emerald-950 p-6 overflow-hidden shadow-2xl">
                <div class="absolute top-0 right-0 size-40 bg-emerald-500/20 rounded-full -mr-20 -mt-20 blur-3xl"></div>
                <div class="relative z-10">
                    <span
                        class="py-1 px-3 bg-emerald-500 text-white text-[10px] font-black rounded-full uppercase tracking-tighter shadow-lg shadow-emerald-500/20">Special
                        du Jour</span>
                    <h3 class="font-heading font-bold text-xl text-white mt-4" x-text="promo.code"></h3>
                    <p class="text-emerald-200/60 text-xs mt-2 leading-relaxed">
                        <span x-show="promo.discount_percentage">
                            <span x-text="promo.discount_percentage"></span>% de reduction
                        </span>
                        <span x-show="promo.discount_amount">
                            <span x-text="promo.discount_amount"></span> DH de remise
                        </span>
                    </p>
                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('mobile.menu') }}"
                            class="py-2.5 px-6 bg-white text-emerald-950 text-xs font-black rounded-2xl shadow-xl transition-all active:scale-95">Commander</a>
                    </div>
                </div>
            </div>
        </template>

        <!-- Categories Quick Access -->
        <section>
            <div class="flex justify-between items-center mb-4 px-1">
                <h3 class="font-heading font-bold text-gray-800">Categories</h3>
                <a href="{{ route('mobile.menu') }}"
                    class="text-xs font-bold text-emerald-600 uppercase tracking-widest">Voir tout</a>
            </div>
            <div class="flex gap-4 overflow-x-auto pb-4 scrollbar-hide px-1">
                <template x-for="cat in categories" :key="cat.id">
                    <a :href="'{{ route('mobile.menu') }}?category=' + cat.id"
                        class="flex-shrink-0 flex flex-col items-center gap-2">
                        <div
                            class="size-16 bg-white border border-gray-100 rounded-3xl flex items-center justify-center shadow-sm">
                            <span x-text="cat.icon_url || '🍽️'"></span>
                        </div>
                        <span class="text-[10px] font-bold text-gray-500 uppercase" x-text="cat.name"></span>
                    </a>
                </template>

                <!-- Loading skeleton -->
                <template x-if="loading">
                    <template x-for="i in 4" :key="i">
                        <div class="flex-shrink-0 flex flex-col items-center gap-2">
                            <div class="size-16 bg-gray-100 rounded-3xl animate-pulse"></div>
                            <div class="h-2 w-12 bg-gray-100 rounded animate-pulse"></div>
                        </div>
                    </template>
                </template>
            </div>
        </section>

    </main>
</div>

@endsection
