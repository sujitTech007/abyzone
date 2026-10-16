@php
    $warehouse = $booking->warehouse;
    $address = collect([
        $warehouse->address_street,
        $warehouse->address_city,
        $warehouse->address_state,
        $warehouse->address_postal,
        $warehouse->address_country,
        $warehouse->location,
    ])->filter()->unique()->implode(', ');
    $statusTitle = match ($status) {
        'approved' => 'Your booking is confirmed',
        'declined' => 'Booking request update',
        'meeting_scheduled' => 'A meeting has been scheduled',
        'cancelled' => 'Your booking has been cancelled',
        default => 'Booking request update',
    };
    $statusMessage = match ($status) {
        'approved' => 'The warehouse owner has approved your requested dates. Your booking details are below.',
        'declined' => 'The warehouse owner could not approve this request. You can browse other available spaces from your dashboard.',
        'meeting_scheduled' => 'The warehouse owner would like to meet with you. Meeting details are included below.',
        'cancelled' => 'The warehouse owner cancelled this booking. Its dates are now available again.',
        default => 'There has been an update to your warehouse booking request.',
    };
    [$statusLabel, $statusColor, $statusBackground, $statusBorder] = match ($status) {
        'approved' => ['BOOKING CONFIRMED', '#166534', '#f0fdf4', '#bbf7d0'],
        'declined' => ['REQUEST DECLINED', '#b91c1c', '#fef2f2', '#fecaca'],
        'meeting_scheduled' => ['MEETING SCHEDULED', '#1d4ed8', '#eff6ff', '#bfdbfe'],
        'cancelled' => ['BOOKING CANCELLED', '#b91c1c', '#fef2f2', '#fecaca'],
        default => ['BOOKING UPDATED', '#475569', '#f8fafc', '#cbd5e1'],
    };
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $statusTitle }}</title>
</head>
<body style="margin:0;padding:0;background:#f1f5f9;font-family:Arial,Helvetica,sans-serif;color:#1e293b;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f1f5f9;padding:32px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellspacing="0" cellpadding="0" style="width:100%;max-width:600px;background:#ffffff;border-radius:16px;overflow:hidden;">
                    <tr>
                        <td style="padding:30px 36px;background:#102a43;color:#ffffff;">
                            <div style="font-size:12px;font-weight:bold;letter-spacing:2px;color:#b7d5f3;">ABYZONE · WAREHOUSE BOOKINGS</div>
                            <h1 style="margin:16px 0 8px;font-size:26px;line-height:1.25;">{{ $statusTitle }}</h1>
                            <p style="margin:0;color:#d9e7f5;font-size:15px;line-height:1.6;">Hello {{ $booking->customer->name }}, {{ $statusMessage }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px 36px;">
                            <div style="margin-bottom:22px;padding:14px 16px;border:1px solid {{ $statusBorder }};border-radius:10px;background:{{ $statusBackground }};color:{{ $statusColor }};font-weight:bold;">
                                {{ $statusLabel }} · BOOKING #{{ $booking->id }}
                            </div>
                            @if($status === 'cancelled' && $booking->cancellation_reason)
                                <p style="margin:0 0 22px;padding:14px 16px;border-left:3px solid #fca5a5;background:#fef2f2;color:#7f1d1d;font-size:14px;line-height:1.6;">
                                    <strong>Cancellation note:</strong> {{ $booking->cancellation_reason }}
                                </p>
                            @endif

                            <h2 style="margin:0 0 14px;font-size:18px;">Booking details</h2>
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;font-size:14px;">
                                <tr>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;color:#64748b;width:38%;">Warehouse</td>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;font-weight:bold;">{{ $warehouse->name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;color:#64748b;">Warehouse type</td>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;">{{ $warehouse->warehouse_type ?: ($warehouse->storage_type ?: 'Not specified') }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;color:#64748b;">Location</td>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;">{{ $address ?: 'Contact the warehouse owner for address details' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;color:#64748b;">Warehouse capacity</td>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;">
                                        @if($warehouse->capacity_quantity)
                                            {{ number_format($warehouse->capacity_quantity) }} {{ $warehouse->capacity_unit }}
                                        @elseif($warehouse->size_sqft)
                                            {{ number_format($warehouse->size_sqft) }} sq. ft.
                                        @else
                                            Not specified
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;color:#64748b;">Booking dates</td>
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
                                        {{ $booking->requested_capacity
                                            ? number_format($booking->requested_capacity) . ' ' . ($booking->requested_capacity_unit ?? '')
                                            : 'Not specified' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;color:#64748b;">Warehouse pricing</td>
                                    <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;">
                                        @if($warehouse->price_value !== null && $warehouse->price_unit)
                                            {{ number_format($warehouse->price_value, 2) }} {{ $warehouse->price_unit }}
                                        @elseif($warehouse->price_per_month !== null)
                                            {{ number_format($warehouse->price_per_month, 2) }} per month
                                        @else
                                            Contact the owner for pricing
                                        @endif
                                    </td>
                                </tr>
                                @if($status === 'meeting_scheduled' && $booking->meeting_scheduled_for)
                                    <tr>
                                        <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;color:#64748b;">Meeting time</td>
                                        <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;font-weight:bold;">{{ $booking->meeting_scheduled_for->format('l, d M Y \a\t g:i A') }}</td>
                                    </tr>
                                @endif
                                @if($booking->meeting_notes)
                                    <tr>
                                        <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;color:#64748b;">Message from the owner</td>
                                        <td style="padding:11px 0;border-bottom:1px solid #e2e8f0;">{{ $booking->meeting_notes }}</td>
                                    </tr>
                                @endif
                            </table>

                            @if($warehouse->owner)
                                <h2 style="margin:24px 0 8px;font-size:16px;">Warehouse contact</h2>
                                <p style="margin:0;color:#475569;font-size:14px;line-height:1.8;">
                                    {{ $warehouse->owner->name }}<br>
                                    @if($warehouse->owner->email)
                                        <a href="mailto:{{ $warehouse->owner->email }}" style="color:#2463eb;">{{ $warehouse->owner->email }}</a><br>
                                    @endif
                                    @if($warehouse->owner->phone)
                                        {{ $warehouse->owner->phone }}
                                    @endif
                                </p>
                            @endif

                            @if($booking->notes)
                                <h2 style="margin:24px 0 8px;font-size:16px;">Your booking notes</h2>
                                <p style="margin:0;color:#475569;font-size:14px;line-height:1.6;">{{ $booking->notes }}</p>
                            @endif

                            <div style="margin:28px 0 8px;text-align:center;">
                                <a href="{{ route('user.warehouses.requests', [], true) }}" style="display:inline-block;padding:13px 22px;border-radius:8px;background:#2463eb;color:#ffffff;text-decoration:none;font-size:14px;font-weight:bold;">
                                    View my booking requests
                                </a>
                            </div>
                            <p style="margin:22px 0 0;color:#64748b;font-size:13px;line-height:1.6;">
                                Questions about this booking? Reply to this email or contact the warehouse owner through your ABYzone dashboard.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px 36px;background:#f8fafc;border-top:1px solid #e2e8f0;color:#64748b;font-size:12px;line-height:1.6;">
                            Thank you for choosing ABYzone.<br>
                            This is an automated booking update. Please keep this email for your records.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>