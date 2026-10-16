<div style="font-family:Arial,sans-serif;color:#263247;max-width:640px;margin:auto;line-height:1.6">
    <div style="background:#244e80;color:#fff;padding:24px;border-radius:12px 12px 0 0">
        <h1 style="margin:0;font-size:22px">
            @if($eventType === 'payment_confirmed') Payment confirmed
            @elseif($eventType === 'refund_initiated') Refund requested
            @elseif($eventType === 'refund_confirmed') Refund completed
            @else Payment update
            @endif
        </h1>
        <p style="margin:8px 0 0">Invoice {{ $payment->invoice_number }}</p>
    </div>
    <div style="border:1px solid #e2e8f0;border-top:0;padding:24px;border-radius:0 0 12px 12px">
        <p>Hello {{ $payment->invoice_snapshot['customer_name'] }},</p>
        @if($eventType === 'payment_confirmed')
            <p>We received your payment of <strong>{{ $payment->currency }} {{ number_format($payment->total_cents / 100, 2) }}</strong> for {{ $payment->invoice_snapshot['warehouse_name'] }}. This email confirms your payment.</p>
        @elseif($eventType === 'refund_initiated')
            <p>Your booking was cancelled and a refund of <strong>{{ $payment->currency }} {{ number_format($payment->total_cents / 100, 2) }}</strong> has been requested from Stripe. Your bank may take several business days to post it.</p>
        @elseif($eventType === 'refund_confirmed')
            <p>Your refund of <strong>{{ $payment->currency }} {{ number_format($payment->refunded_cents / 100, 2) }}</strong> has been confirmed by Stripe. Your bank may take several business days to post it.</p>
        @else
            <p>We could not automatically complete your refund request. Please contact the warehouse owner or ABYzone support for assistance.</p>
        @endif
        <p><a href="{{ $invoiceUrl }}" style="color:#244e80">View invoice and payment details</a></p>
    </div>
</div>
