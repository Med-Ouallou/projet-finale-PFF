<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function __construct(private PaymentService $paymentService) {}

    public function checkout(Request $request)
    {
        $orderId = $request->query('order_id');
        $order = Order::findOrFail($orderId);

        // Ensure user owns this order
        if ($order->customer_id !== auth()->user()->customer->id) {
            abort(403, 'Accès interdit.');
        }

        try {
            $url = $this->paymentService->createCheckoutSession($order);
            return redirect($url);
        } catch (\Exception $e) {
            logger()->error('Stripe error: ' . $e->getMessage());
            return redirect()->route('client.profile')->with('error', 'Erreur de paiement: ' . $e->getMessage() . '. Veuillez vérifier vos clés Stripe API dans le fichier .env.');
        }
    }

    public function success(Request $request)
    {
        $orderId = $request->query('order_id');
        $sessionId = $request->query('session_id');

        $order = Order::findOrFail($orderId);

        // Verify user owns order
        if ($order->customer_id !== auth()->user()->customer->id) {
            abort(403);
        }

        try {
            $paid = $this->paymentService->handlePaymentSuccess($sessionId, $order);

            if ($paid) {
                return redirect()->route('client.profile')->with('success', 'Votre paiement a été validé ! Votre commande est en cours de préparation.');
            }

            return redirect()->route('client.profile')->with('error', 'Le paiement n\'a pas pu être validé.');
        } catch (\Exception $e) {
            logger()->error('Stripe success callback error: ' . $e->getMessage());
            return redirect()->route('client.profile')->with('error', 'Erreur lors de la validation du paiement.');
        }
    }

    public function cancel(Request $request)
    {
        $orderId = $request->query('order_id');
        $order = Order::findOrFail($orderId);

        if ($order->customer_id !== auth()->user()->customer->id) {
            abort(403);
        }

        $this->paymentService->handlePaymentCancel($order);

        return redirect()->route('client.profile')->with('warning', 'Le paiement a été annulé. La commande a été annulée.');
    }
}
