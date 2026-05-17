@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 p-4 sm:p-6">
    <div class="w-full max-w-md mx-auto">
        <!-- Card -->
        <div class="bg-white border border-gray-100 rounded-3xl shadow-2xl shadow-slate-200 overflow-hidden">
            <div class="p-8 sm:p-10">
                <div class="text-center mb-8">
                    <h1 class="block text-2xl font-bold font-heading text-gray-900">{{ __('Register') }}</h1>
                    <p class="mt-2 text-sm text-gray-500">Créez un compte pour accéder au site.</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="grid gap-y-5">
                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-semibold mb-2 text-gray-800">{{ __('Name') }}</label>
                            <div class="relative">
                                <input type="text" id="name" name="name"
                                    class="py-3 px-4 ps-11 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-gray-50 @error('name') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                    required autocomplete="name" autofocus placeholder="Votre nom" value="{{ old('name') }}">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>
                                </div>
                            </div>
                            @error('name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-semibold mb-2 text-gray-800">{{ __('Email Address') }}</label>
                            <div class="relative">
                                <input type="email" id="email" name="email"
                                    class="py-3 px-4 ps-11 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-gray-50 @error('email') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                    required autocomplete="email" placeholder="nom@exemple.com" value="{{ old('email') }}">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="20" height="16" x="2" y="4" rx="2" />
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                    </svg>
                                </div>
                            </div>
                            @error('email')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" class="block text-sm font-semibold mb-2 text-gray-800">{{ __('Password') }}</label>
                            <div class="relative">
                                <input type="password" id="password" name="password"
                                    class="py-3 px-4 ps-11 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-gray-50 @error('password') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                    required autocomplete="new-password" placeholder="••••••••">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                    </svg>
                                </div>
                            </div>
                            @error('password')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div>
                            <label for="password-confirm" class="block text-sm font-semibold mb-2 text-gray-800">{{ __('Confirm Password') }}</label>
                            <div class="relative">
                                <input type="password" id="password-confirm" name="password_confirmation"
                                    class="py-3 px-4 ps-11 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-gray-50"
                                    required autocomplete="new-password" placeholder="••••••••">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                        <path d="m9 12 2 2 4-4"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full py-3.5 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-xl border border-transparent bg-emerald-600 text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all shadow-lg shadow-emerald-200/50 hover:shadow-emerald-200">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="px-8 py-5 bg-gray-50 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-600">
                    {{ __('Already have an account?') }}
                    <a href="{{ route('login') }}" class="text-emerald-600 decoration-2 hover:underline font-medium">{{ __('Login') }}</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
