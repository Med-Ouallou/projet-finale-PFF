<x-customer.layouts.app>
    <x-slot:title>Contactez-Nous - Resto Manager</x-slot:title>

    <div class="relative min-h-screen bg-[#FDFBF7] font-sans pb-20">

        <!-- ===== HERO SECTION (Relaxing Welcome Billboard) ===== -->
        <section class="max-w-[1240px] mx-auto px-6 pt-6">
            <div class="relative overflow-hidden bg-gradient-to-br from-stone-900 via-emerald-950 to-stone-950 rounded-[32px] p-8 lg:p-12 shadow-xl border border-emerald-950/40 text-start">
                
                <!-- Gentle visual glow overlay -->
                <div class="absolute inset-0 z-0 opacity-15 pointer-events-none">
                    <div class="absolute -top-24 -right-24 w-80 h-80 bg-emerald-500 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-amber-200 rounded-full blur-3xl"></div>
                </div>

                <div class="relative z-10 grid lg:grid-cols-12 gap-8 items-center">
                    
                    <!-- Left: Welcome text -->
                    <div class="lg:col-span-7 space-y-4">
                        <span class="inline-flex items-center gap-1.5 py-1 px-3.5 bg-emerald-500/10 border border-emerald-400/20 text-emerald-300 text-[10px] font-black rounded-full uppercase tracking-wider">
                            👋 À votre écoute
                        </span>
                        <h1 class="text-3xl lg:text-5xl font-serif font-extrabold text-white tracking-tight leading-tight">
                            Contactez notre équipe
                        </h1>
                        <p class="text-sm lg:text-base text-stone-300 font-medium leading-relaxed max-w-xl">
                            Une question sur nos plats, une envie d’organiser un événement mémorable ou simplement pour nous saluer ? Nous sommes là pour vous répondre chaleureusement.
                        </p>

                        <div class="pt-2 flex flex-wrap gap-4 text-[10px] font-bold uppercase tracking-widest text-stone-400">
                            <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Réponse Rapide</span>
                            <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Événements sur mesure</span>
                        </div>
                    </div>

                    <!-- Right: Gorgeous Overlapping Culinary Showcase (Desktop only) -->
                    <div class="lg:col-span-5 relative hidden lg:flex justify-end pr-8">
                        <div class="relative w-72 h-72">
                            <!-- Background golden radial flare -->
                            <div class="absolute inset-4 bg-amber-300/10 rounded-full filter blur-xl animate-pulse"></div>
                            
                            <!-- Plate 2 (Back plate) -->
                            <img src="https://images.unsplash.com/photo-1560684352-8497838a2229?auto=format&fit=crop&w=400&q=80" 
                                 alt="Accompagnements Grillés"
                                 class="w-40 h-40 rounded-full object-cover border-4 border-[#FAF9F6]/90 shadow-2xl absolute -bottom-2 -left-6 z-0 -rotate-12 transform hover:rotate-0 hover:scale-105 transition-all duration-500">

                            <!-- Plate 1 (Front plate) -->
                            <img src="https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=500&q=80" 
                                 alt="Viandes Nobles"
                                 class="w-56 h-56 rounded-full object-cover border-4 border-[#FAF9F6] shadow-2xl absolute top-2 right-2 z-10 rotate-6 transform hover:rotate-0 hover:scale-105 transition-all duration-500">
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ===== CONTACT DETAILS & FORM SECTION ===== -->
        <main class="max-w-[1240px] mx-auto px-6 py-12 text-start">
            <div class="grid lg:grid-cols-12 gap-8 items-start">

                <!-- LEFT SIDEBAR: Practical Info & Hours (5 Cols) -->
                <div class="col-span-12 lg:col-span-5 space-y-8">
                    
                    <!-- Info Card -->
                    <div class="bg-white border border-stone-150 rounded-[32px] p-8 shadow-sm space-y-6">
                        <h2 class="text-xl font-serif font-extrabold text-stone-855 tracking-tight flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-emerald-700 rounded-full"></span>
                            Informations Pratiques
                        </h2>
                        
                        <div class="space-y-4">
                            <!-- Card 1: Address -->
                            <div class="flex items-start gap-4 p-4.5 bg-[#FDFBF7] border border-stone-100 rounded-2xl transition-all hover:bg-stone-50/50">
                                <div class="flex-shrink-0 w-11 h-11 bg-emerald-50 border border-emerald-100 rounded-xl flex items-center justify-center text-emerald-700 shadow-inner">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                </div>
                                <div class="space-y-1">
                                    <h4 class="text-xs font-bold uppercase tracking-wider text-stone-400">Notre Adresse</h4>
                                    <p class="text-sm font-semibold text-stone-800 leading-snug">123 Boulevard Gourmet, 75001 Paris</p>
                                </div>
                            </div>

                            <!-- Card 2: Phone -->
                            <div class="flex items-start gap-4 p-4.5 bg-[#FDFBF7] border border-stone-100 rounded-2xl transition-all hover:bg-stone-50/50">
                                <div class="flex-shrink-0 w-11 h-11 bg-emerald-50 border border-emerald-100 rounded-xl flex items-center justify-center text-emerald-700 shadow-inner">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.502-5.17-3.848-6.672-6.672l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                    </svg>
                                </div>
                                <div class="space-y-1">
                                    <h4 class="text-xs font-bold uppercase tracking-wider text-stone-400">Téléphone Direct</h4>
                                    <p class="text-sm font-semibold text-stone-800 leading-snug">+33 1 23 45 67 89</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hours Card -->
                    <div class="bg-gradient-to-br from-stone-900 to-stone-950 border border-stone-800 rounded-[32px] p-8 shadow-xl relative overflow-hidden text-start">
                        <!-- Gentle background visual -->
                        <div class="absolute inset-0 z-0 opacity-10 pointer-events-none">
                            <div class="absolute -top-12 -right-12 w-48 h-48 bg-emerald-500 rounded-full blur-2xl"></div>
                        </div>

                        <div class="relative z-10 space-y-6">
                            <h2 class="text-xl font-serif font-extrabold text-[#FAF9F6] tracking-tight flex items-center gap-2">
                                <span class="w-1.5 h-6 bg-emerald-505 rounded-full"></span>
                                Horaires de Table
                            </h2>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-2.5 border-b border-stone-850/80">
                                    <span class="text-xs font-bold uppercase tracking-widest text-stone-400">Lundi - Vendredi</span>
                                    <span class="text-sm font-semibold text-[#FAF9F6]">12:00 - 23:00</span>
                                </div>
                                <div class="flex justify-between items-center py-2.5">
                                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-450">Samedi - Dimanche</span>
                                    <span class="text-sm font-bold text-amber-300">11:00 - 00:00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT MAIN CONTENT: Message Form (7 Cols) -->
                <div class="col-span-12 lg:col-span-7" x-data="contactForm('{{ config('services.web3forms.key') }}')">
                    <div class="bg-white border border-stone-150 rounded-[32px] p-8 shadow-sm space-y-6">
                        <div class="space-y-1">
                            <h2 class="text-xl font-serif font-extrabold text-stone-855 tracking-tight flex items-center gap-2">
                                <span class="w-1.5 h-6 bg-emerald-700 rounded-full"></span>
                                Envoyez-nous un message
                            </h2>
                            <p class="text-[10px] text-gray-400 font-extrabold uppercase tracking-widest leading-none pl-3.5">
                                Réponse sous 24 heures ouvrées
                            </p>
                        </div>

                        <form @submit.prevent="submitForm($event)" class="space-y-6 pt-2">
                            @csrf
                            <div class="grid md:grid-cols-2 gap-6 text-start">
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-bold uppercase tracking-widest text-stone-400">Nom Complet</label>
                                    <input type="text" name="name" required
                                        class="w-full bg-[#FDFBF7] border border-stone-200 focus:border-emerald-600 focus:ring-emerald-600 rounded-2xl py-3.5 px-4 text-xs font-medium text-stone-800 transition-all placeholder-stone-400"
                                        placeholder="Jean Dupont">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-bold uppercase tracking-widest text-stone-400">Adresse Email</label>
                                    <input type="email" name="email" required
                                        class="w-full bg-[#FDFBF7] border border-stone-200 focus:border-emerald-600 focus:ring-emerald-600 rounded-2xl py-3.5 px-4 text-xs font-medium text-stone-800 transition-all placeholder-stone-400"
                                        placeholder="jean@exemple.fr">
                                </div>
                            </div>

                            <div class="space-y-2 text-start">
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-stone-400">Sujet du Message</label>
                                <div class="relative">
                                    <x-ui.select name="subject"
                                        class="w-full bg-[#FDFBF7] border border-stone-200 focus:border-emerald-600 focus:ring-emerald-600 rounded-2xl py-3.5 px-4 text-xs font-medium text-stone-800 transition-all appearance-none cursor-pointer">
                                        <option>Question générale</option>
                                        <option>Réservation spéciale</option>
                                        <option>Événementiel</option>
                                        <option>Recrutement</option>
                                    </x-ui.select>
                                </div>
                            </div>

                            <div class="space-y-2 text-start">
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-stone-400">Votre Message</label>
                                <textarea name="message" required
                                    class="w-full bg-[#FDFBF7] border border-stone-200 focus:border-emerald-600 focus:ring-emerald-600 rounded-2xl py-3.5 px-4 text-xs font-medium text-stone-800 transition-all placeholder-stone-400"
                                    rows="5" placeholder="Écrivez votre message avec le plus de détails possibles..."></textarea>
                            </div>

                            <x-ui.button type="submit" variant="primary" size="xl" ::disabled="sending" class="w-full rounded-full py-4 bg-emerald-700 hover:bg-emerald-800 text-xs font-bold uppercase tracking-wider shadow-md disabled:opacity-50 disabled:cursor-not-allowed">
                                <span x-show="!sending">Envoyer le message</span>
                                <span x-show="sending" class="flex items-center justify-center gap-2" x-cloak>
                                    <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Envoi en cours...
                                </span>
                            </x-ui.button>
                        </form>
                    </div>
                </div>

            </div>
        </main>

    </div>
</x-customer.layouts.app>
