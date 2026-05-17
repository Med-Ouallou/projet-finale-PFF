<footer class="bg-slate-900 text-white mt-auto">
    <div class="max-w-[1200px] mx-auto px-6 py-16">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-10 text-start">
            <div class="col-span-2 lg:col-span-1">
                <a class="text-xl font-bold font-heading" href="{{ route('accueil') }}">Resto<span class="text-emerald-400">Manager</span></a>
                <p class="mt-3 text-sm text-slate-400 leading-relaxed">La plateforme idéale pour digitaliser la gestion de votre restaurant.</p>
            </div>
            <div>
                <h4 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-4">Produit</h4>
                <div class="space-y-2 text-sm text-slate-400">
                    <p><a href="{{ route('menu') }}" class="hover:text-emerald-400 transition-colors">Menu Online</a></p>
                    <p><a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-400 transition-colors">Dashboard Admin</a></p>
                    <p><a href="#" class="hover:text-emerald-400 transition-colors">Tarifs</a></p>
                </div>
            </div>
            <div>
                <h4 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-4">Support</h4>
                <div class="space-y-2 text-sm text-slate-400">
                    <p><a href="#" class="hover:text-emerald-400 transition-colors">Documentation</a></p>
                    <p><a href="{{ route('contact') }}" class="hover:text-emerald-400 transition-colors">Contact</a></p>
                </div>
            </div>
            <div>
                <h4 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-4">Légal</h4>
                <div class="space-y-2 text-sm text-slate-400">
                    <p><a href="#" class="hover:text-emerald-400 transition-colors">Mentions légales</a></p>
                    <p><a href="#" class="hover:text-emerald-400 transition-colors">Confidentialité</a></p>
                </div>
            </div>
        </div>
        <div class="mt-12 pt-8 border-t border-slate-800 flex flex-col sm:flex-row justify-between items-center gap-4">
            <p class="text-sm text-slate-500">&copy; {{ date('Y') }} RestoManager. Tous droits réservés.</p>
            <div class="flex gap-4">
                <a href="#" class="text-slate-500 hover:text-emerald-400 transition-colors">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z" />
                    </svg>
                </a>
                <a href="#" class="text-slate-500 hover:text-emerald-400 transition-colors">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5" />
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                        <line x1="17.5" x2="17.51" y1="6.5" y2="6.5" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</footer>
