<?php

namespace App\Services;

use App\Models\Order;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaymentService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Create a Stripe Checkout Session and return the URL.
     */
    public function createCheckoutSession(Order $order): string
    {
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'mad',
                    'product_data' => [
                        'name' => 'Commande #' . $order->id . ' - Resto Manager',
                        'description' => 'Règlement sécurisé de votre commande de restauration.',
                    ],
                    'unit_amount' => (int) ($order->total_amount * 100),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('client.payment.stripe.success') . '?session_id={CHECKOUT_SESSION_ID}&order_id=' . $order->id,
            'cancel_url' => route('client.payment.stripe.cancel') . '?order_id=' . $order->id,
        ]);

        return $session->url;
    }

    /**
     * Handle payment success callback.
     */
    public function handlePaymentSuccess(string $sessionId, Order $order): bool
    {
        $session = Session::retrieve($sessionId);

        if ($session->payment_status === 'paid') {
            $order->update([
                'status' => 'processing',
            ]);
            return true;
        }

        return false;
    }

    /**
     * Handle payment cancel callback.
     */
    public function handlePaymentCancel(Order $order): void
    {
        $order->update(['status' => 'cancelled']);
    }
}
