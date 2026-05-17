<x-customer.layouts.app>
    <x-slot:title>Contact - Resto Manager</x-slot:title>

    <!-- Hero Section -->
    <section class="py-16 bg-white border-b border-gray-100">
        <div class="max-w-[1200px] mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold font-heading text-slate-900 mb-4">Contactez-nous</h1>
            <p class="text-lg text-slate-500 max-w-2xl mx-auto">Une question, un événement spécial ou une simple envie de nous saluer ? Notre équipe vous répond avec plaisir.</p>
        </div>
    </section>

    <!-- Contact Content -->
    <main class="max-w-[1200px] mx-auto px-6 py-16 flex-1 text-start">
        <div class="grid md:grid-cols-2 gap-16">

            <!-- Info Column -->
            <div class="space-y-12">
                <div>
                    <h2 class="text-2xl font-bold font-heading text-slate-900 mb-8 uppercase tracking-tight">Informations Pratiques</h2>
                    <div class="space-y-6">
                        <!-- Card 1 -->
                        <div class="flex gap-4 p-5 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex-shrink-0 w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" /><circle cx="12" cy="10" r="3" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900">Notre Adresse</h3>
                                <p class="text-sm text-slate-500 mt-1">123 Boulevard Gourmet, 75001 Paris</p>
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div class="flex gap-4 p-5 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex-shrink-0 w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900">Téléphone</h3>
                                <p class="text-sm text-slate-500 mt-1">+33 1 23 45 67 89</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-bold font-heading text-slate-900 mb-4 uppercase tracking-tight">Horaires d'ouverture</h3>
                    <div class="bg-emerald-900 rounded-2xl p-6 text-white overflow-hidden relative shadow-2xl shadow-emerald-900/40">
                        <div class="absolute inset-0 opacity-10 pointer-events-none">
                            <div class="absolute -top-10 -right-10 size-32 bg-emerald-400 rounded-full blur-2xl"></div>
                        </div>
                        <div class="space-y-3 relative z-10">
                            <div class="flex justify-between text-sm py-2 border-b border-emerald-800">
                                <span>Lundi - Vendredi</span>
                                <span class="font-bold">12:00 - 23:00</span>
                            </div>
                            <div class="flex justify-between text-sm py-2">
                                <span>Samedi - Dimanche</span>
                                <span class="font-bold text-amber-400">11:00 - 00:00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Column -->
            <div class="bg-white border border-gray-100 rounded-3xl p-8 shadow-2xl shadow-slate-200/50">
                <h2 class="text-2xl font-bold font-heading text-slate-900 mb-6 uppercase tracking-tight">Envoyez-nous un message</h2>
                <form action="#" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-5 text-start">
                        <div>
                            <label class="block text-sm font-semibold mb-2">Nom complet</label>
                            <input type="text" name="name" required
                                class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-gray-50 transition"
                                placeholder="Jean Dupont">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Email</label>
                            <input type="email" name="email" required
                                class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-gray-50 transition"
                                placeholder="jean@exemple.fr">
                        </div>
                    </div>
                    <div class="text-start">
                        <label class="block text-sm font-semibold mb-2">Objet</label>
                        <select name="subject"
                            class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-gray-50 transition">
                            <option>Question générale</option>
                            <option>Réservation spéciale</option>
                            <option>Événementiel</option>
                            <option>Recrutement</option>
                        </select>
                    </div>
                    <div class="text-start">
                        <label class="block text-sm font-semibold mb-2">Message</label>
                        <textarea name="message" required
                            class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-gray-50 transition"
                            rows="5" placeholder="Votre message ici..."></textarea>
                    </div>
                    <x-ui.button type="submit" variant="dark" size="xl" class="w-full">
                        Envoyer le message
                    </x-ui.button>
                </form>
            </div>

        </div>
    </main>
</x-customer.layouts.app>
