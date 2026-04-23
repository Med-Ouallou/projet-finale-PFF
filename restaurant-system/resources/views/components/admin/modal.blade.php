@props([
    'id' => 'modal',
    'title' => '',
    'subtitle' => '',
    'icon' => '',
])

<!-- Modal Overlay -->
<div x-data="{ open: false }"
     x-init="$watch('open', val => { if(val) document.body.style.overflow='hidden'; else document.body.style.overflow='' })"
     id="{{ $id }}"
     role="dialog"
     aria-modal="true"
     aria-labelledby="{{ $id }}-title"
     class="fixed inset-0 z-[80] overflow-x-hidden overflow-y-auto"
     :class="{ 'pointer-events-none': !open }">

    <!-- Backdrop -->
    <div x-show="open" x-cloak
         x-transition:enter="transition-opacity ease-out duration-300"
         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-200"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         @click="open = false"
         class="fixed inset-0 bg-black/40"></div>

    <!-- Modal Content -->
    <div x-show="open" x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="relative min-h-[calc(100%-3.5rem)] flex items-center m-3 sm:mx-auto sm:max-w-xl sm:w-full">
        <div class="w-full flex flex-col bg-white border border-gray-100 shadow-2xl rounded-3xl pointer-events-auto relative">

            <!-- Header -->
            <div class="flex justify-between items-center py-5 px-6 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    @if($icon)
                        <div class="w-9 h-9 bg-emerald-100 rounded-xl flex items-center justify-center shrink-0">
                            {!! $icon !!}
                        </div>
                    @endif
                    <div>
                        <h3 id="{{ $id }}-title" class="font-bold font-heading text-gray-900 leading-none">{{ $title }}</h3>
                        @if($subtitle)
                            <p class="text-xs text-gray-400 mt-0.5">{{ $subtitle }}</p>
                        @endif
                    </div>
                </div>
                <button type="button" @click="open = false"
                        class="size-8 inline-flex justify-center items-center rounded-full border border-gray-200 bg-white text-gray-600 hover:bg-gray-50 transition-colors shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

            <!-- Body -->
            <div class="p-6 space-y-5 overflow-y-auto max-h-[70vh]">
                {{ $slot }}
            </div>

            <!-- Footer -->
            @if(isset($footer))
                <div class="flex justify-end items-center gap-3 px-6 py-5 border-t border-gray-100">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>
