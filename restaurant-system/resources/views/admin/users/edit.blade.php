<x-layouts.admin :title="'Modifier Utilisateur - Resto Admin'" :breadcrumb="'Modifier l\'utilisateur'">

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-lg font-bold font-heading text-gray-900">Modifier l'utilisateur</h2>
                <p class="text-sm text-gray-400">Mettez à jour les informations de l'utilisateur.</p>
            </div>

            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                @if($errors->any())
                    <div class="p-4 bg-red-50 border border-red-200 rounded-xl">
                        <p class="text-sm font-bold text-red-700 mb-2">Veuillez corriger les erreurs :</p>
                        <ul class="text-sm text-red-600 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Nom <span class="text-red-400">*</span></label>
                        <input type="text" name="name" required value="{{ old('name', $user->name) }}"
                            class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Email <span class="text-red-400">*</span></label>
                        <input type="email" name="email" required value="{{ old('email', $user->email) }}"
                            class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Mot de passe (laisser vide pour ne pas changer)</label>
                        <input type="password" name="password" minlength="8"
                            class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                        <p class="text-xs text-gray-400 mt-1">Minimum 8 caractères si modification</p>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-800 mb-1.5">Rôle</label>
                        <select name="role" class="py-3 px-4 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-gray-50 transition">
                            <option value="admin" {{ old('role', $user->role_name) == 'admin' ? 'selected' : '' }}>Administrateur</option>
                            <option value="employee" {{ old('role', $user->role_name) == 'employee' ? 'selected' : '' }}>Employé</option>
                            <option value="customer" {{ old('role', $user->role_name) == 'customer' ? 'selected' : '' }}>Client</option>
                        </select>
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <a href="{{ route('admin.users.index') }}" class="flex-1 py-3.5 px-4 text-center text-sm font-semibold rounded-xl border border-gray-200 text-gray-700 bg-white hover:bg-gray-50 transition">Annuler</a>
                    <button type="submit" class="flex-1 py-3.5 px-4 text-sm font-bold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 transition">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.admin>
