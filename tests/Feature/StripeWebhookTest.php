<?php

namespace Tests\Feature;

use App\Http\Controllers\StripeWebhookController;
use App\Services\WarehousePaymentService;
use Illuminate\Http\Request;
use Tests\TestCase;

class StripeWebhookTest extends TestCase
{
    public function test_stripe_webhook_accepts_a_valid_timestamped_signature(): void
    {
        $secret = 'whsec_test_signing_secret';
        config()->set('services.stripe.webhook_secret', $secret);
        $payload = json_encode([
            'id' => 'evt_unhandled_test',
            'type' => 'product.created',
            'data' => ['object' => []],
        ], JSON_THROW_ON_ERROR);
        $timestamp = (string) time();
        $signature = hash_hmac('sha256', $timestamp . '.' . $payload, $secret);

        $request = Request::create('/api/stripe/webhook', 'POST', [], [], [], [
            'CONTENT_TYPE' => 'application/json',
            'HTTP_STRIPE_SIGNATURE' => "t={$timestamp},v1={$signature}",
        ], $payload);
        $paymentService = $this->mock(WarehousePaymentService::class);
        $paymentService->shouldReceive('handleWebhook')->once()->with([
            'id' => 'evt_unhandled_test',
            'type' => 'product.created',
            'data' => ['object' => []],
        ]);

        $response = app(StripeWebhookController::class)->handle($request, $paymentService);
        $this->assertSame(200, $response->getStatusCode());
    }

    public function test_stripe_webhook_rejects_an_invalid_signature(): void
    {
        config()->set('services.stripe.webhook_secret', 'whsec_test_signing_secret');
        $timestamp = (string) time();
        $payload = '{"id":"evt_invalid","type":"product.created","data":{"object":[]}}';

        $request = Request::create('/api/stripe/webhook', 'POST', [], [], [], [
            'CONTENT_TYPE' => 'application/json',
            'HTTP_STRIPE_SIGNATURE' => "t={$timestamp},v1=invalid",
        ], $payload);
        $paymentService = $this->mock(WarehousePaymentService::class);
        $paymentService->shouldNotReceive('handleWebhook');

        $response = app(StripeWebhookController::class)->handle($request, $paymentService);
        $this->assertSame(400, $response->getStatusCode());
    }
}
