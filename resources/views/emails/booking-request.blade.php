<p>Hello {{ $booking->warehouse->user->name ?? 'Owner' }},</p>

<p>You have received a new booking request from <strong>{{ $booking->customer->name }}</strong> for the warehouse <strong>{{ $booking->warehouse->name }}</strong>.</p>

<ul>
    <li><strong>Start date:</strong> {{ $booking->start_date?->format('d M Y') ?? 'N/A' }}</li>
    <li><strong>End date:</strong> {{ $booking->end_date?->format('d M Y') ?? 'N/A' }}</li>
    <li><strong>Capacity requested:</strong> {{ $booking->requested_capacity ? number_format($booking->requested_capacity) . ' ' . $booking->requested_capacity_unit : 'N/A' }}</li>
</ul>

<p>Please log in to your dashboard to review and respond to the request.</p>

<p>Thank you,<br>The ABYzone Team</p>
