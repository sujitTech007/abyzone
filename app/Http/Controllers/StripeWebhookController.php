<?php

namespace App\Http\Controllers;

use App\Services\WarehousePaymentService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class StripeWebhookController extends Controller
{
    public function handle(Request $request, WarehousePaymentService $paymentService): Response
    {
        $secret = config('services.stripe.webhook_secret');
        if (! is_string($secret) || $secret === '') {
            Log::error('Stripe webhook received without STRIPE_WEBHOOK_SECRET configured.');

            return response('Webhook is not configured.', 500);
        }

        $signatureHeader = $request->header('Stripe-Signature', '');
        $parts = collect(explode(',', $signatureHeader))
            ->mapWithKeys(function (string $part) {
                $pair = explode('=', $part, 2);

                return count($pair) === 2 ? [$pair[0] => $pair[1]] : [];
            });
        $timestamp = $parts->get('t');
        $signatures = $parts->get('v1') ? [$parts->get('v1')] : [];
        foreach (explode(',', $signatureHeader) as $part) {
            if (str_starts_with($part, 'v1=')) {
                $signatures[] = substr($part, 3);
            }
        }
        $signatures = array_values(array_unique(array_filter($signatures)));

        if (! is_string($timestamp)
            || ! ctype_digit($timestamp)
            || abs(time() - (int) $timestamp) > 300
        ) {
            return response('Invalid webhook timestamp.', 400);
        }

        $expected = hash_hmac('sha256', $timestamp . '.' . $request->getContent(), $secret);
        $valid = false;
        foreach ($signatures as $signature) {
            $valid = $valid || hash_equals($expected, $signature);
        }
        if (! $valid) {
            return response('Invalid webhook signature.', 400);
        }

        $event = json_decode($request->getContent(), true);
        if (! is_array($event)) {
            return response('Invalid webhook payload.', 400);
        }

        $paymentService->handleWebhook($event);

        return response('ok', 200);
    }
}
