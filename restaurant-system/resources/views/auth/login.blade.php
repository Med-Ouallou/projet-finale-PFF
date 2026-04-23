@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 p-4 sm:p-6">
    <div class="w-full max-w-md mx-auto">
        <!-- Card -->
        <div class="bg-white border border-gray-100 rounded-3xl shadow-2xl shadow-slate-200 overflow-hidden">
            <div class="p-8 sm:p-10">
                <div class="text-center mb-8">
                    <h1 class="block text-2xl font-bold font-heading text-gray-900">Connexion</h1>
                    <p class="mt-2 text-sm text-gray-500">Connectez-vous pour accéder à votre compte.</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="grid gap-y-5">
                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-semibold mb-2 text-gray-800">{{ __('Email Address') }}</label>
                            <div class="relative">
                                <input type="email" id="email" name="email"
                                    class="py-3 px-4 ps-11 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-gray-50 @error('email') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                    required autocomplete="email" autofocus placeholder="nom@exemple.com" value="{{ old('email') }}">
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
                            <div class="flex justify-between items-center mb-2">
                                <label for="password" class="block text-sm font-semibold text-gray-800">{{ __('Password') }}</label>
                                @if (Route::has('password.request'))
                                    <a class="text-sm text-emerald-600 decoration-2 hover:underline font-medium" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="relative">
                                <input type="password" id="password" name="password"
                                    class="py-3 px-4 ps-11 block w-full border border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-gray-50 @error('password') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                    required autocomplete="current-password" placeholder="••••••••">
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

                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <div class="flex">
                                <input id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}
                                    class="shrink-0 mt-0.5 border-gray-200 rounded text-emerald-600 focus:ring-emerald-500">
                            </div>
                            <div class="ms-3">
                                <label for="remember" class="text-sm text-gray-600">{{ __('Remember Me') }}</label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full py-3.5 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-xl border border-transparent bg-emerald-600 text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all shadow-lg shadow-emerald-200/50 hover:shadow-emerald-200">
                            {{ __('Login') }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="px-8 py-5 bg-gray-50 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-600">
                    {{ __("Don't have an account?") }}
                    <a href="{{ route('register') }}" class="text-emerald-600 decoration-2 hover:underline font-medium">{{ __('Register') }}</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
