<p>Hello {{ $booking->customer->name }},</p>

<p>Your booking request for <strong>{{ $booking->warehouse->name }}</strong> has been <strong>{{ ucfirst($status) }}</strong> by the owner.</p>

<p>
    @if($status === 'approved')
        You may proceed with any further arrangements as discussed.
    @elseif($status === 'declined')
        Unfortunately, the owner has declined your request. You may try other warehouses.
    @elseif($status === 'meeting_scheduled')
        A meeting has been scheduled as per the owner's instructions.
    @endif
</p>

<p>{{ $booking->notes }}</p>

<p>Please log in to your account for more details.</p>

<p>Thank you,<br>The ABYzone Team</p>