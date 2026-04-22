<x-layouts.app>
    <x-slot:title>Accueil - Resto Manager</x-slot:title>

    <!-- HERO -->
    <section class="hero-gradient relative overflow-hidden">
        <div class="absolute inset-0 opacity-30">
            <div class="absolute top-20 left-10 w-72 h-72 bg-emerald-200 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-20 w-96 h-96 bg-amber-100 rounded-full blur-3xl"></div>
        </div>
        <div class="relative max-w-[1200px] mx-auto px-6 py-20 lg:py-28">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div class="text-start">
                    <span class="inline-flex items-center gap-x-2 py-1.5 px-4 text-xs font-semibold bg-emerald-50 text-emerald-700 rounded-full border border-emerald-200 mb-6 tracking-widest uppercase">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                        Solution de gestion No.1 en France
                    </span>
                    <h1 class="text-4xl lg:text-5xl xl:text-6xl font-extrabold font-heading text-gray-900 leading-tight">
                        La gestion de votre restaurant,<br>
                        <span class="text-emerald-600 relative inline-block">enfin simplifiée.</span>
                    </h1>
                    <p class="mt-6 text-lg text-gray-500 leading-relaxed max-w-lg">
                        Commandes, menu, revenus et personnel — tout centralisé dans une interface intuitive conçue pour les restaurateurs ambitieux.
                    </p>
                    <div class="mt-8 flex flex-col sm:flex-row gap-3">
                        <x-ui.button variant="primary" size="lg">
                            Démarrer gratuitement
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14" /><path d="m12 5 7 7-7 7" />
                            </svg>
                        </x-ui.button>
                        <x-ui.button variant="secondary" size="lg">
                            <svg class="w-4 h-4 text-emerald-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="5 3 19 12 5 21 5 3" />
                            </svg>
                            Voir la démo
                        </x-ui.button>
                    </div>
                </div>
                <div class="relative">
                    <div class="relative z-10 rounded-2xl overflow-hidden shadow-2xl shadow-slate-200 border border-gray-100">
                        <img class="w-full" src="https://images.unsplash.com/photo-1551218808-94e220e084d2?ixlib=rb-4.0.3&auto=format&fit=crop&w=1400&q=90" alt="Interface RestoManager">
                    </div>
                    <!-- Floating card -->
                    <div class="absolute -bottom-5 -left-6 z-20 bg-white rounded-2xl p-4 shadow-xl border border-gray-100 flex items-center gap-3 w-52 text-start">
                        <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="22 7 13.5 15.5 8.5 10.5 2 17" /><polyline points="16 7 22 7 22 13" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Revenus du mois</p>
                            <p class="text-base font-bold font-heading text-gray-800">+18,420 DH</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SOCIAL PROOF -->
    <section class="bg-gray-50 border-y border-gray-100 py-8">
        <div class="max-w-[1200px] mx-auto px-6 text-center">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-6">Utilisé par les meilleurs établissements</p>
            <div class="flex flex-wrap justify-center items-center gap-8 lg:gap-12 text-gray-400 font-bold font-heading text-lg opacity-60">
                <span>Le Jardin Vert</span><span>Chez Aziz</span><span>La Table Dorée</span><span>Casa Blanca</span><span>Saveurs d'Ici</span>
            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section id="features" class="max-w-[1200px] mx-auto px-6 py-20 lg:py-28">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="inline-flex items-center py-1.5 px-4 text-xs font-semibold bg-amber-50 text-amber-700 rounded-full border border-amber-200 mb-4 tracking-widest uppercase">
                Fonctionnalités clés
            </span>
            <h2 class="text-3xl lg:text-4xl font-extrabold font-heading text-gray-900">Tout ce dont votre restaurant a besoin</h2>
            <p class="mt-4 text-gray-500 text-lg">Des outils puissants, une interface simple — concentrez-vous sur la cuisine.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 text-start">
            <div class="group bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:border-emerald-100 transition-all hover:-translate-y-1">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-5 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" /><rect x="8" y="2" width="8" height="4" rx="1" ry="1" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold font-heading text-gray-800 mb-2">Gestion des Commandes</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Recevez, traitez et suivez toutes vos commandes en temps réel depuis un tableau de bord unifié.</p>
            </div>

            <div class="group bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:border-emerald-100 transition-all hover:-translate-y-1">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-5 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" /><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold font-heading text-gray-800 mb-2">Menu Dynamique</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Modifiez votre menu, ajoutez des photos, gérez vos catégories et vos prix en quelques secondes.</p>
            </div>

            <div class="group bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:border-emerald-100 transition-all hover:-translate-y-1">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-5 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="22 7 13.5 15.5 8.5 10.5 2 17" /><polyline points="16 7 22 7 22 13" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold font-heading text-gray-800 mb-2">Analytiques Avancées</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Visualisez vos revenus, vos plats les plus vendus et vos périodes de pointe pour mieux planifier.</p>
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="bg-emerald-900 relative overflow-hidden py-20 text-center">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-emerald-400 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 left-0 w-72 h-72 bg-amber-300 rounded-full blur-3xl -translate-x-1/2 translate-y-1/2"></div>
        </div>
        <div class="relative max-w-[1200px] mx-auto px-6">
            <h2 class="text-3xl lg:text-4xl font-extrabold font-heading text-white mb-4">Prêt à transformer votre restaurant ?</h2>
            <p class="text-emerald-200 text-lg mb-8 max-w-xl mx-auto">Commencez gratuitement et découvrez pourquoi 2,400 restaurants nous font confiance.</p>
            <a href="{{ route('admin.login') }}">
                <x-ui.button variant="primary" size="xl" class="bg-white text-emerald-900 hover:bg-emerald-50">
                    Essai gratuit — 14 jours
                </x-ui.button>
            </a>
        </div>
    </section>
</x-layouts.app>
