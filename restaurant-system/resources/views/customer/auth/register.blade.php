<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Client - Restaurant</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center py-8">
    <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-lg">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Créer un compte</h1>
            <p class="text-gray-500 text-sm mt-2">Rejoignez-nous pour commander en ligne</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                <ul class="text-sm text-red-600 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('client.register.post') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all"
                    placeholder="Jean Dupont" required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all"
                    placeholder="votre@email.com" required>
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all"
                    placeholder="+212 6XX XXX XXX">
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Adresse</label>
                <textarea name="address" id="address" rows="2"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all resize-none"
                    placeholder="Votre adresse de livraison...">{{ old('address') }}</textarea>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all"
                    placeholder="••••••••" required>
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all"
                    placeholder="••••••••" required>
            </div>

            <button type="submit"
                class="w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl transition-colors duration-200">
                Créer mon compte
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Déjà un compte ?
                <a href="{{ route('client.login') }}" class="text-emerald-600 hover:text-emerald-700 font-medium">
                    Se connecter
                </a>
            </p>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('accueil') }}" class="text-sm text-gray-400 hover:text-gray-600">
                ← Retour à l'accueil
            </a>
        </div>
    </div>
</body>
</html>
