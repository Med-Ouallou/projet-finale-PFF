<div x-data="chatbotApp({ messageUrl: '{{ route('admin.chatbot.message') }}' })" @click.outside="open = false; saveState();" class="font-sans">
    <!-- Chatbot Toggle Button -->
    <button @click="toggleOpen" 
            class="fixed bottom-6 right-6 z-50 flex items-center justify-center w-14 h-14 bg-gradient-to-tr from-emerald-600 to-teal-500 rounded-full text-white shadow-xl hover:shadow-2xl hover:scale-105 active:scale-95 transition-all duration-300 group focus:outline-none"
            aria-label="Open AI Assistant">
        <span class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-red-500 rounded-full animate-ping" x-show="unread"></span>
        <span class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-red-500 rounded-full border-2 border-white" x-show="unread"></span>
        
        <!-- Chat Icon -->
        <svg x-show="!open" class="w-6 h-6 transform transition-transform duration-300 group-hover:rotate-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
        </svg>
        
        <!-- Close Icon -->
        <svg x-show="open" x-cloak class="w-6 h-6 transform transition-transform duration-300 rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

    <!-- Chat Window Container -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 translate-y-8 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-8 scale-95"
         x-cloak
         class="fixed bottom-24 right-6 w-[350px] sm:w-[400px] h-[500px] max-h-[calc(100vh-120px)] bg-white rounded-2xl shadow-2xl border border-gray-100 z-50 flex flex-col overflow-hidden">
        
        <!-- Header -->
        <div class="px-4 py-3.5 bg-gradient-to-r from-emerald-600 to-teal-600 text-white flex items-center justify-between shadow-sm shrink-0">
            <div class="flex items-center gap-2.5">
                <div class="w-8.5 h-8.5 rounded-full bg-white/15 flex items-center justify-center border border-white/10 shadow-inner">
                    <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-sm tracking-wide">Resto AI Assistant</h3>
                    <div class="flex items-center gap-1 mt-0.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="text-[10px] text-emerald-100 font-medium">En ligne</span>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-1">
                <!-- Clear history button -->
                <button @click="clearHistory" title="Effacer l'historique" class="text-white/85 hover:text-white transition-colors focus:outline-none p-1 rounded-lg hover:bg-white/10">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
                <button @click="toggleOpen" class="text-white/80 hover:text-white transition-colors focus:outline-none p-1 rounded-lg hover:bg-white/10">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Messages Box -->
        <div x-ref="chatBox" class="flex-1 p-4 overflow-y-auto bg-slate-50/70 space-y-4 [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-thumb]:bg-slate-200 [&::-webkit-scrollbar-track]:bg-transparent">
            <!-- Dynamic Messages -->
            <template x-for="(msg, index) in messages" :key="index">
                <div>
                    <!-- Bot Bubble -->
                    <template x-if="msg.sender === 'bot'">
                        <div class="flex items-start gap-2 max-w-[90%] transition-all">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-emerald-600 to-teal-500 flex items-center justify-center text-[10px] font-bold text-white shrink-0 border border-emerald-100/20 shadow-sm">
                                AI
                            </div>
                            <div :class="[
                                'border rounded-2xl rounded-tl-none p-3.5 text-sm shadow-sm transition-all leading-relaxed flex flex-col gap-3',
                                msg.success 
                                    ? 'bg-emerald-50 border-emerald-200 text-emerald-950 shadow-emerald-50/50' 
                                    : 'bg-white border-gray-100 text-gray-800'
                            ]">
                                <p class="whitespace-pre-line text-xs sm:text-sm" x-text="msg.text"></p>
                                
                                <!-- Suggestions inside the welcome/bot bubble card -->
                                <template x-if="msg.options && msg.options.length">
                                    <div class="flex flex-col gap-1.5 pt-1">
                                        <template x-for="opt in msg.options">
                                            <button type="button" @click="useOption(opt.prompt)" class="w-full flex items-center gap-2 px-3.5 py-2 text-xs font-semibold bg-gray-50 hover:bg-emerald-50 hover:text-emerald-700 text-gray-700 border border-gray-200 hover:border-emerald-300 rounded-xl transition-all focus:outline-none shadow-sm">
                                                <!-- Clean Vector Icons -->
                                                <template x-if="opt.icon === 'category'">
                                                    <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                                    </svg>
                                                </template>
                                                <template x-if="opt.icon === 'item'">
                                                    <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                                    </svg>
                                                </template>
                                                <template x-if="opt.icon === 'report'">
                                                    <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v5.25c0 .621-.504 1.125-1.125 1.125h-2.25A1.125 1.125 0 013 18.375v-5.25zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125v-9.75zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v14.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
                                                    </svg>
                                                </template>
                                                <template x-if="opt.icon === 'stock'">
                                                    <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                    </svg>
                                                </template>
                                                <template x-if="opt.icon === 'block'">
                                                    <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                                    </svg>
                                                </template>
                                                
                                                <span x-text="opt.label"></span>
                                            </button>
                                        </template>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>

                    <!-- User Bubble -->
                    <template x-if="msg.sender === 'user'">
                        <div class="flex items-start gap-2 max-w-[90%] ms-auto justify-end transition-all">
                            <div class="bg-emerald-600 text-white rounded-2xl rounded-tr-none p-3.5 shadow-sm text-sm leading-relaxed text-start">
                                <p class="text-xs sm:text-sm" x-text="msg.text"></p>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-slate-200 border border-slate-300 flex items-center justify-center text-[10px] font-bold text-slate-700 shrink-0 shadow-sm">
                                AD
                            </div>
                        </div>
                    </template>
                </div>
            </template>

            <!-- Loading Indicator -->
            <div x-show="isLoading" class="flex items-start gap-2 max-w-[90%]" x-cloak>
                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-emerald-600 to-teal-500 flex items-center justify-center text-[10px] font-bold text-white shrink-0 shadow-sm">
                    AI
                </div>
                <div class="bg-white border border-gray-100 rounded-2xl rounded-tl-none px-4 py-3 flex items-center gap-1.5 shadow-sm">
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></span>
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></span>
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.3s"></span>
                </div>
            </div>
        </div>

        <!-- Input Form -->
        <form @submit.prevent="sendMessage" class="p-3 bg-white border-t border-gray-100 flex items-center gap-2 shrink-0">
            <input type="text" 
                   x-model="newMessage" 
                   placeholder="Ajouter une catégorie 'Dessert'..." 
                   class="flex-1 px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 placeholder-gray-400"
                   :disabled="isLoading" />
            <button type="submit" 
                    class="p-2.5 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 active:scale-95 transition-all shadow-md shadow-emerald-200 focus:outline-none disabled:opacity-50"
                    :disabled="isLoading || !newMessage.trim()">
                <svg class="w-5 h-5 transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
            </button>
        </form>
    </div>
</div>

<style>
/* Hide scrollbar for Chrome, Safari and Opera */
.no-scrollbar::-webkit-scrollbar {
    display: none;
}
/* Hide scrollbar for IE, Edge and Firefox */
.no-scrollbar {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
</style>
