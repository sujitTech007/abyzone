<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequirementPayment;
use App\Services\ServiceRequirementPaymentService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ServiceRequirementPaymentController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $payments = ServiceRequirementPayment::query()
            ->with(['requirement:id,title,service_type', 'requester:id,name,role', 'channelPartner:id,name'])
            ->when(
                $user->role === 'channel_partner',
                fn ($query) => $query->where('channel_partner_id', $user->id),
                fn ($query) => $query->where('requester_id', $user->id)
            )
            ->latest()
            ->paginate(15);
        $header = $user->role === 'channel_partner'
            ? 'channel-partner.include.header'
            : ($user->role === 'vendor' ? 'owner.include.header' : 'user.include.header');
        $prefix = $this->routePrefix($user);

        return view('service-requirement-payments.index', compact('payments', 'header', 'prefix'));
    }

    public function show(Request $request, ServiceRequirementPayment $payment): View
    {
        $this->authorizePayment($request, $payment);
        $payment->load(['requirement', 'requester', 'channelPartner']);

        $user = $request->user();
        $header = $user->role === 'channel_partner'
            ? 'channel-partner.include.header'
            : ($user->role === 'vendor' ? 'owner.include.header' : 'user.include.header');
        $prefix = $this->routePrefix($user);
        $canPay = $payment->requester_id === $user->id
            && in_array($payment->status, ['payment_due', 'checkout_pending'], true);

        return view('service-requirement-payments.show', compact('payment', 'header', 'prefix', 'canPay'));
    }

    public function checkout(
        Request $request,
        ServiceRequirementPayment $payment,
        ServiceRequirementPaymentService $paymentService
    ): RedirectResponse {
        abort_unless($payment->requester_id === $request->user()->id, 404);
        try {
            $url = $paymentService->checkout($payment, $request->user());
        } catch (RequestException|ConnectionException $exception) {
            Log::error('Could not start Stripe checkout for a completed Channel Partner service.', [
                'service_requirement_payment_id' => $payment->id,
                'exception' => $exception->getMessage(),
            ]);

            return redirect()->route($this->routePrefix($request->user()).'.service-payments.show', $payment)
                ->with('error', 'Stripe checkout could not be started. No payment was taken; please try again.');
        }

        return redirect()->away($url);
    }

    public function success(
        Request $request,
        ServiceRequirementPayment $payment,
        ServiceRequirementPaymentService $paymentService
    ): RedirectResponse {
        abort_unless($payment->requester_id === $request->user()->id, 404);
        $payment = $paymentService->confirmReturn($payment, $request->user());

        return redirect()->route($this->routePrefix($request->user()).'.service-payments.show', $payment)
            ->with($payment->status === 'paid' ? 'success' : 'info', $payment->status === 'paid'
                ? 'Service payment confirmed. The admin will record the platform commission.'
                : 'Your payment is being confirmed by Stripe.');
    }

    private function authorizePayment(Request $request, ServiceRequirementPayment $payment): void
    {
        abort_unless(
            $payment->requester_id === $request->user()->id
                || $payment->channel_partner_id === $request->user()->id,
            404
        );
    }

    private function routePrefix($user): string
    {
        return match ($user->role) {
            'vendor' => 'owner',
            'channel_partner' => 'channel-partner',
            default => 'user',
        };
    }
}
