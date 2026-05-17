@extends('mobile.layouts.app')

@section('title', 'RestoManager - Contact')
@section('body-class', 'bg-gray-50/50')

@section('content')

<div x-data="contact('{{ config('resto.whatsapp_phone') }}')">

    <header class="bg-white px-6 pt-12 pb-6 border-b border-gray-100">
        <h1 class="font-heading font-black text-3xl text-slate-900">Contact</h1>
        <p class="text-gray-400 text-sm mt-1">On adore avoir de vos nouvelles !</p>
    </header>

    <main class="p-6 space-y-6">

        <!-- Info Cards -->
        <div class="grid grid-cols-2 gap-4">
            <a :href="callUrl"
                class="bg-white border border-gray-100 p-6 rounded-[32px] flex flex-col items-center text-center shadow-sm active:scale-95 transition-all">
                <div class="size-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="size-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path
                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                    </svg>
                </div>
                <span class="text-[10px] font-black uppercase text-gray-400 tracking-widest">Appeler</span>
            </a>
            <a href="https://maps.google.com" target="_blank"
                class="bg-white border border-gray-100 p-6 rounded-[32px] flex flex-col items-center text-center shadow-sm active:scale-95 transition-all">
                <div class="size-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="size-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                </div>
                <span class="text-[10px] font-black uppercase text-gray-400 tracking-widest">Maps</span>
            </a>
        </div>

        <!-- WhatsApp Support Card -->
        <div class="bg-emerald-950 rounded-[40px] p-8 relative overflow-hidden shadow-2xl">
            <div class="absolute top-0 right-0 size-32 bg-emerald-500/20 rounded-full -mr-16 -mt-16 blur-3xl"></div>
            <div class="relative z-10 flex flex-col items-center text-center">
                <div
                    class="size-16 bg-white/10 backdrop-blur-md rounded-3xl flex items-center justify-center mb-6 border border-white/10">
                    <svg class="size-8 text-emerald-400" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.171.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.538-2.961-2.654-.087-.116-.708-.941-.708-1.795 0-.855.449-1.277.608-1.45.159-.174.348-.217.464-.217.116 0 .232.001.333.006.106.005.249-.04.391.305.144.35.492 1.203.535 1.29.043.087.072.188.014.305-.058.116-.087.188-.174.29-.087.101-.183.225-.261.305-.087.087-.179.183-.077.358.101.174.451.745.966 1.204.664.591 1.224.774 1.398.86.174.087.275.072.376-.044.101-.116.435-.508.55-.682.116-.174.232-.145.391-.087.159.058 1.014.478 1.187.565.174.087.29.131.334.203.04.072.04.417-.104.821zM12 1c6.075 0 11 4.925 11 11s-4.925 11-11 11S1 18.075 1 12 5.925 1 12 1z" />
                    </svg>
                </div>
                <h2 class="font-heading font-black text-white text-2xl tracking-tight">Support Live</h2>
                <p class="text-emerald-200/50 text-xs mt-2 px-4 leading-relaxed uppercase tracking-widest font-bold">
                    Zero attente, reponse instantanee via WhatsApp</p>
                <a :href="whatsappUrl" target="_blank"
                    class="mt-8 w-full py-5 bg-emerald-500 text-emerald-950 text-sm font-black rounded-[32px] shadow-2xl shadow-emerald-500/20 active:scale-95 transition-all">Ouvrir
                    le chat</a>
            </div>
        </div>

        <div
            class="bg-white border border-gray-100 rounded-[40px] p-8 h-40 flex flex-col items-center justify-center text-center opacity-40">
            <p class="text-[10px] font-black uppercase text-gray-400 tracking-widest">Prochainement</p>
            <p class="text-sm font-bold text-gray-400 mt-1">Programme de Fidelite App</p>
        </div>

    </main>
</div>

@endsection
