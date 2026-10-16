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
    <title>New warehouse booking request</title>
</head>
<body style="margin:0;padding:0;background:#f1f5f9;font-family:Arial,Helvetica,sans-serif;color:#1e293b;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f1f5f9;padding:32px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="620" cellspacing="0" cellpadding="0" style="width:100%;max-width:620px;background:#ffffff;border-radius:16px;overflow:hidden;">
                    <tr>
                        <td style="padding:32px 36px;background:#102a43;color:#ffffff;">
                            <div style="font-size:12px;font-weight:bold;letter-spacing:2px;color:#b7d5f3;">ABYZONE · OWNER NOTIFICATION</div>
                            <h1 style="margin:16px 0 8px;font-size:27px;line-height:1.25;">A new booking request is waiting</h1>
                            <p style="margin:0;color:#d9e7f5;font-size:15px;line-height:1.6;">
                                Hello {{ $warehouse->owner?->name ?? 'Warehouse owner' }}, {{ $customer->name ?? 'A customer' }} has requested to book your warehouse.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px 36px;">
                            <div style="margin-bottom:24px;padding:14px 16px;border:1px solid #bfdbfe;border-radius:10px;background:#eff6ff;color:#1d4ed8;font-weight:bold;">
                                ACTION REQUIRED · Request #{{ $booking->id }} · PENDING REVIEW
                            </div>

                            <h2 style="margin:0 0 14px;font-size:18px;">Requested booking</h2>
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;font-size:14px;">
                                <tr>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;color:#64748b;width:38%;">Warehouse</td>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;font-weight:bold;">{{ $warehouse->name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;color:#64748b;">Warehouse type</td>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;">{{ $warehouse->warehouse_type ?: 'Not specified' }}</td>
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
                                <tr>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;color:#64748b;">Requested capacity</td>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;">
                                        {{ $booking->requested_capacity !== null
                                            ? number_format($booking->requested_capacity) . ' ' . ($booking->requested_capacity_unit ?? '')
                                            : 'Not specified' }}
                                    </td>
                                </tr>
                                @if($warehouse->price_value !== null && $warehouse->price_unit)
                                    <tr>
                                        <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;color:#64748b;">Listed price</td>
                                        <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;">{{ number_format($warehouse->price_value, 2) }} {{ $warehouse->price_unit }}</td>
                                    </tr>
                                @elseif($warehouse->price_per_month !== null)
                                    <tr>
                                        <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;color:#64748b;">Listed price</td>
                                        <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;">{{ number_format($warehouse->price_per_month, 2) }} per month</td>
                                    </tr>
                                @endif
                            </table>

                            <h2 style="margin:26px 0 12px;font-size:18px;">Customer details</h2>
                            <div style="padding:16px;border:1px solid #e2e8f0;border-radius:10px;background:#f8fafc;font-size:14px;line-height:1.8;">
                                <strong>{{ $customer->name ?? 'Customer' }}</strong><br>
                                @if($customer?->email)
                                    <a href="mailto:{{ $customer->email }}" style="color:#2463eb;text-decoration:none;">{{ $customer->email }}</a><br>
                                @endif
                                @if($customer?->phone)
                                    {{ $customer->phone }}
                                @endif
                            </div>

                            @if($booking->notes)
                                <h2 style="margin:24px 0 8px;font-size:16px;">Customer's note</h2>
                                <p style="margin:0;padding:14px 16px;border-left:3px solid #93c5fd;background:#f8fafc;color:#475569;font-size:14px;line-height:1.7;">{{ $booking->notes }}</p>
                            @endif

                            @if($booking->service_template_answer)
                                <p style="margin:20px 0 0;font-size:14px;">
                                    <a href="{{ asset($booking->service_template_answer) }}" style="color:#2463eb;font-weight:bold;text-decoration:none;">View the customer's completed service template</a>
                                </p>
                            @endif

                            <div style="margin:28px 0 8px;text-align:center;">
                                <a href="{{ route('owner.warehouse-bookings.show', $booking, true) }}" style="display:inline-block;padding:14px 24px;border-radius:8px;background:#2463eb;color:#ffffff;text-decoration:none;font-size:14px;font-weight:bold;">
                                    Review booking request
                                </a>
                            </div>
                            <p style="margin:20px 0 0;color:#64748b;font-size:13px;line-height:1.6;">
                                Please review the requested dates and details, then update the customer from your ABYzone owner dashboard.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px 36px;background:#f8fafc;border-top:1px solid #e2e8f0;color:#64748b;font-size:12px;line-height:1.6;">
                            ABYzone · Warehouse booking notifications<br>
                            This is an automated message about booking request #{{ $booking->id }}.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
