<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $payment->invoice_number }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #263247; font-size: 12px; }
        .header { border-bottom: 2px solid #244e80; padding-bottom: 16px; margin-bottom: 22px; }
        .brand { color: #244e80; font-size: 24px; font-weight: bold; }
        .muted { color: #697586; }
        .row { width: 100%; margin-bottom: 20px; }
        .column { width: 50%; vertical-align: top; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #dce2ea; padding: 9px; text-align: left; }
        th { background: #f1f5f9; }
        .amount { text-align: right; }
        .total { font-size: 15px; font-weight: bold; color: #244e80; }
    </style>
</head>
<body>
    <div class="header">
        <div class="brand">ABYzone</div>
        <div class="muted">Warehouse booking invoice</div>
    </div>

    <table class="row">
        <tr>
            <td class="column">
                <strong>Invoice</strong><br>
                {{ $payment->invoice_number }}<br>
                Issued: {{ $payment->created_at->format('d M Y') }}<br>
                Status: {{ ucfirst(str_replace('_', ' ', $payment->status)) }}
            </td>
            <td class="column">
                <strong>Bill to</strong><br>
                {{ $snapshot['customer_name'] }}<br>
                {{ $snapshot['customer_email'] }}<br><br>
                <strong>Vendor</strong><br>
                {{ $snapshot['vendor_name'] }}
            </td>
        </tr>
    </table>

    <p><strong>Warehouse:</strong> {{ $snapshot['warehouse_name'] }}</p>
    @if($snapshot['warehouse_address'])
        <p><strong>Address:</strong> {{ $snapshot['warehouse_address'] }}</p>
    @endif
    <p>
        <strong>Booking:</strong> #{{ $snapshot['booking_id'] }} |
        {{ \Carbon\Carbon::parse($snapshot['start_date'])->format('d M Y') }}
        – {{ \Carbon\Carbon::parse($snapshot['end_date'])->format('d M Y') }} |
        {{ number_format((float) $snapshot['requested_capacity'], 2) }} {{ $snapshot['requested_capacity_unit'] }}
    </p>

    <table>
        <thead>
            <tr><th>Description</th><th class="amount">Amount</th></tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{ $snapshot['warehouse_name'] }} storage ({{ $snapshot['days'] }} days)<br>
                    <span class="muted">{{ number_format((float) $snapshot['requested_capacity'], 2) }} chargeable units · {{ $snapshot['price_unit'] }}</span>
                </td>
                <td class="amount">{{ $payment->currency }} {{ number_format($payment->subtotal_cents / 100, 2) }}</td>
            </tr>
            <tr>
                <td>Tax ({{ number_format((float) $payment->tax_rate, 4) }}%)</td>
                <td class="amount">{{ $payment->currency }} {{ number_format($payment->tax_cents / 100, 2) }}</td>
            </tr>
            <tr>
                <td class="total">{{ $payment->status === 'paid' || $payment->status === 'refunded' ? 'Amount paid' : 'Total due' }}</td>
                <td class="amount total">{{ $payment->currency }} {{ number_format($payment->total_cents / 100, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <p class="muted">This invoice was generated automatically when the warehouse booking was approved.</p>
</body>
</html>
