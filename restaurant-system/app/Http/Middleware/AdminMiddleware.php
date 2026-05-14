<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter.');
        }

        $user = auth()->user();

        // Allow both admin and employee roles
        if (!$user->isAdmin() && !$user->isEmployee()) {
            return redirect()->route('login')->with('error', 'Accès réservé aux administrateurs et employés.');
        }

        return $next($request);
    }
}
