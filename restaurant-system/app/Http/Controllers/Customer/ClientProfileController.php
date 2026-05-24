<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use App\Http\Requests\Customer\UpdateProfileRequest;
use App\Http\Requests\Customer\UpdatePasswordRequest;

class ClientProfileController extends Controller
{
    /**
     * Show the customer profile management page.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Ensure customer profile exists
        if (!$user->customer) {
            $user->customer()->create();
            $user->load('customer');
        }

        $customer = $user->customer;

        // Fetch all orders for this customer with their items
        $orders = Order::where('customer_id', $customer->id)
            ->with(['orderItems.menuItem'])
            ->latest()
            ->get();

        // Get the active order for the real-time status tracker (if any)
        $activeOrder = $orders->whereIn('status', ['pending', 'preparing', 'ready'])->first();

        return view('customer.profile', compact('user', 'customer', 'orders', 'activeOrder'));
    }

    /**
     * Update the customer profile details.
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $user = Auth::user();
                
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);

                if (!$user->customer) {
                    $user->customer()->create();
                }

                $user->customer->update([
                    'phone' => $request->phone,
                    'address' => $request->address,
                ]);
            });

            return back()->with('success', 'Votre profil a été mis à jour avec succès.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erreur lors de la mise à jour: ' . $e->getMessage()]);
        }
    }

    /**
     * Update the customer's password.
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        try {
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return back()->with('success_password', 'Votre mot de passe a été modifié avec succès.');

        } catch (\Exception $e) {
            return back()->withErrors(['password_error' => 'Erreur lors de la mise à jour: ' . $e->getMessage()]);
        }
    }
}
