@php
    $warehouse = $booking->warehouse;
    $customer = $booking->customer;
    $address = collect([
        $warehouse->address_street,
        $warehouse->address_city,
        $warehouse->address_state,
        $warehouse->address_postal,
        $warehouse->address_country,
        $warehouse->location,
    ])->filter()->unique()->implode(', ');
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Warehouse booking cancelled</title>
</head>
<body style="margin:0;padding:0;background:#f1f5f9;font-family:Arial,Helvetica,sans-serif;color:#1e293b;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f1f5f9;padding:32px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellspacing="0" cellpadding="0" style="width:100%;max-width:600px;background:#ffffff;border-radius:16px;overflow:hidden;">
                    <tr>
                        <td style="padding:30px 36px;background:#102a43;color:#ffffff;">
                            <div style="font-size:12px;font-weight:bold;letter-spacing:2px;color:#b7d5f3;">ABYZONE · BOOKING UPDATE</div>
                            <h1 style="margin:16px 0 8px;font-size:26px;line-height:1.25;">A booking has been cancelled</h1>
                            <p style="margin:0;color:#d9e7f5;font-size:15px;line-height:1.6;">
                                Hello {{ $warehouse->owner?->name ?? 'Warehouse owner' }}, {{ $cancelledBy === 'customer' ? 'the customer cancellation is recorded and these dates are available again.' : 'the booking has been cancelled and these dates are available again.' }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px 36px;">
                            <div style="margin-bottom:22px;padding:14px 16px;border:1px solid #fecaca;border-radius:10px;background:#fef2f2;color:#b91c1c;font-weight:bold;">
                                CANCELLED · BOOKING #{{ $booking->id }}
                            </div>
                            <h2 style="margin:0 0 14px;font-size:18px;">Booking summary</h2>
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;font-size:14px;">
                                <tr>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;color:#64748b;width:38%;">Warehouse</td>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;font-weight:bold;">{{ $warehouse->name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;color:#64748b;">Location</td>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;">{{ $address ?: 'Not specified' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;color:#64748b;">Requested dates</td>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;font-weight:bold;">
                                        {{ $booking->start_date?->format('d M Y') ?? 'Not specified' }}
                                        @if($booking->end_date)
                                            – {{ $booking->end_date->format('d M Y') }}
                                        @endif
                                    </td>
                                </tr>
                            </table>

                            <h2 style="margin:24px 0 12px;font-size:18px;">Customer</h2>
                            <p style="margin:0;color:#475569;font-size:14px;line-height:1.8;">
                                <strong>{{ $customer?->name ?? 'Customer' }}</strong><br>
                                @if($customer?->email)
                                    <a href="mailto:{{ $customer->email }}" style="color:#2463eb;text-decoration:none;">{{ $customer->email }}</a><br>
                                @endif
                                @if($customer?->phone)
                                    {{ $customer->phone }}
                                @endif
                            </p>

                            @if($booking->cancellation_reason)
                                <h2 style="margin:24px 0 8px;font-size:16px;">Cancellation note</h2>
                                <p style="margin:0;padding:14px 16px;border-left:3px solid #fca5a5;background:#fef2f2;color:#7f1d1d;font-size:14px;line-height:1.6;">{{ $booking->cancellation_reason }}</p>
                            @endif

                            <div style="margin:28px 0 8px;text-align:center;">
                                <a href="{{ route('owner.warehouse-bookings.show', $booking, true) }}" style="display:inline-block;padding:13px 22px;border-radius:8px;background:#2463eb;color:#ffffff;text-decoration:none;font-size:14px;font-weight:bold;">
                                    View booking details
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px 36px;background:#f8fafc;border-top:1px solid #e2e8f0;color:#64748b;font-size:12px;line-height:1.6;">
                            ABYzone · Warehouse booking notifications<br>
                            This is an automated update for booking #{{ $booking->id }}.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
