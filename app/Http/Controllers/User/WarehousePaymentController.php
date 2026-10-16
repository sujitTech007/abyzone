<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\WarehousePayment;
use App\Services\WarehousePaymentService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class WarehousePaymentController extends Controller
{
    public function show(Request $request, WarehousePayment $payment): View
    {
        $this->authorizePayment($payment, $request);
        $payment->load(['booking.warehouse', 'events' => fn ($query) => $query->latest()]);

        return view('user.warehouse-payments.show', compact('payment'));
    }

    public function invoice(Request $request, WarehousePayment $payment)
    {
        $this->authorizePayment($payment, $request);
        $payment->load('booking');

        return Pdf::loadView('invoices.warehouse-booking', [
            'payment' => $payment,
            'snapshot' => $payment->invoice_snapshot,
        ])->download($payment->invoice_number . '.pdf');
    }

    public function checkout(
        Request $request,
        WarehousePayment $payment,
        WarehousePaymentService $paymentService
    ): RedirectResponse {
        $this->authorizePayment($payment, $request);
        try {
            $checkoutUrl = $paymentService->checkout($payment, $request->user());
        } catch (RequestException|ConnectionException $exception) {
            Log::error('Could not create Stripe Checkout for a warehouse invoice.', [
                'payment_id' => $payment->id,
                'exception' => $exception->getMessage(),
            ]);

            return redirect()
                ->route('user.warehouse-payments.show', $payment)
                ->with('error', 'Stripe checkout could not be started. No payment was taken; please try again.');
        }
        $host = parse_url($checkoutUrl, PHP_URL_HOST);
        abort_unless($host === 'checkout.stripe.com', 502, 'Stripe returned an unexpected checkout URL.');

        return redirect()->away($checkoutUrl);
    }

    public function success(
        Request $request,
        WarehousePayment $payment,
        WarehousePaymentService $paymentService
    ): RedirectResponse {
        $this->authorizePayment($payment, $request);
        $payment = $paymentService->confirmReturn($payment, $request->user());

        return redirect()
            ->route('user.warehouse-payments.show', $payment)
            ->with($payment->status === 'paid' ? 'success' : 'info', $payment->status === 'paid'
                ? 'Payment confirmed. A receipt has been sent to your email.'
                : 'Payment is being confirmed by Stripe. This page will update when confirmation is received.');
    }

    public function retryRefund(
        Request $request,
        WarehousePayment $payment,
        WarehousePaymentService $paymentService
    ): RedirectResponse {
        $this->authorizePayment($payment, $request);
        $status = $paymentService->retryRefund($payment);

        return redirect()
            ->route('user.warehouse-payments.show', $payment)
            ->with($status === 'refund_failed' ? 'error' : 'success', $status === 'refund_failed'
                ? 'Stripe could not start the refund. Please contact support.'
                : 'Your refund request has been sent to Stripe.');
    }

    private function authorizePayment(WarehousePayment $payment, Request $request): void
    {
        abort_if($payment->booking()->value('customer_id') !== $request->user()->id, 404);
    }
}
