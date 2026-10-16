<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class StripeGateway
{
    private function secret(): string
    {
        $secret = config('services.stripe.secret');
        if (! is_string($secret) || $secret === '') {
            throw ValidationException::withMessages([
                'payment' => 'Online payments are not configured yet. Please contact support.',
            ]);
        }

        return $secret;
    }

    public function get(string $path): array
    {
        return Http::withToken($this->secret())
            ->acceptJson()
            ->get('https://api.stripe.com/v1/' . ltrim($path, '/'))
            ->throw()
            ->json();
    }

    public function post(string $path, array $data, ?string $idempotencyKey = null): array
    {
        $request = Http::asForm()
            ->withToken($this->secret())
            ->acceptJson();
        if ($idempotencyKey !== null) {
            $request = $request->withHeaders(['Idempotency-Key' => $idempotencyKey]);
        }

        return $request
            ->post('https://api.stripe.com/v1/' . ltrim($path, '/'), $data)
            ->throw()
            ->json();
    }
}
