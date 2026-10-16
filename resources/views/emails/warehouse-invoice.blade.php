<div style="font-family:Arial,sans-serif;color:#263247;max-width:640px;margin:auto;line-height:1.6">
    <div style="background:#244e80;color:#fff;padding:24px;border-radius:12px 12px 0 0">
        <h1 style="margin:0;font-size:22px">Your warehouse booking is confirmed</h1>
        <p style="margin:8px 0 0">Invoice {{ $payment->invoice_number }} is ready.</p>
    </div>
    <div style="border:1px solid #e2e8f0;border-top:0;padding:24px;border-radius:0 0 12px 12px">
        <p>Hello {{ $payment->invoice_snapshot['customer_name'] }},</p>
        <p>Your booking for <strong>{{ $payment->invoice_snapshot['warehouse_name'] }}</strong> has been approved. The invoice PDF is attached to this email.</p>
        <p><strong>Total due:</strong> {{ $payment->currency }} {{ number_format($payment->total_cents / 100, 2) }}</p>
        <p style="text-align:center;margin:28px 0">
            <a href="{{ $invoiceUrl }}" style="background:#244e80;color:#fff;padding:12px 22px;text-decoration:none;border-radius:6px">Review invoice and pay securely</a>
        </p>
        <p style="color:#697586;font-size:13px">Payment is processed securely by Stripe. Your checkout session identifier is kept private and is not included in the return link.</p>
    </div>
</div>
