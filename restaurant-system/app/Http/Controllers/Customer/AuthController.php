<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }

        return view('customer.auth.login');
    }

    /**
     * Handle login - smart redirect based on role.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return $this->redirectByRole(Auth::user());
        }

        return back()
            ->withErrors(['email' => 'Les identifiants sont incorrects.'])
            ->withInput();
    }

    /**
     * Redirect user based on their role.
     */
    private function redirectByRole($user)
    {
        if ($user->isAdmin() || $user->isEmployee()) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended(route('accueil'));
    }

    /**
     * Show the customer registration form.
     */
    public function showRegister()
    {
        if (Auth::check() && Auth::user()->isCustomer()) {
            return redirect()->route('accueil');
        }

        return view('customer.auth.register');
    }

    /**
     * Handle customer registration.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        // Create user in users table
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        // Assign customer role
        $user->assignRole('customer');

        // Create customer profile
        Customer::create([
            'user_id' => $user->id,
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);

        // Log in the customer
        Auth::login($user);

        return redirect()->route('accueil')
            ->with('success', 'Votre compte a été créé avec succès !');
    }

    /**
     * Log out the customer.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('client.login');
    }
}
