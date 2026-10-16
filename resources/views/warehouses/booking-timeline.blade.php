<div class="card border-0 shadow-sm rounded-4 mt-4">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-3"><i class="fa-solid fa-clock-rotate-left text-primary me-2"></i>Booking timeline</h5>
        <ol class="list-unstyled mb-0">
            @forelse($booking->timelineEvents as $event)
                <li class="d-flex gap-3 pb-3">
                    <span class="text-primary"><i class="fa-solid fa-circle"></i></span>
                    <div class="flex-grow-1">
                        <div class="d-flex flex-wrap justify-content-between gap-2">
                            <strong>
                                @if($event->from_status && $event->from_status !== $event->to_status)
                                    {{ ucwords(str_replace('_', ' ', $event->from_status)) }} &rarr;
                                @endif
                                {{ ucwords(str_replace('_', ' ', $event->to_status)) }}
                            </strong>
                            <small class="text-muted">{{ $event->created_at->format('d M Y, h:i A') }}</small>
                        </div>
                        <small class="text-muted">
                            {{ $event->actor?->name ?? ucfirst($event->actor_role) }}
                            @if($event->event_type === 'request_submitted')
                                submitted this request
                            @elseif($event->event_type === 'cancelled')
                                cancelled this booking
                            @else
                                updated the booking
                            @endif
                        </small>
                        @if($event->message)
                            <p class="mb-0 mt-1 text-muted">{{ $event->message }}</p>
                        @endif
                    </div>
                </li>
            @empty
                <li class="d-flex gap-3">
                    <span class="text-primary"><i class="fa-solid fa-circle"></i></span>
                    <div>
                        <strong>Request submitted</strong>
                        <small class="d-block text-muted">{{ $booking->created_at?->format('d M Y, h:i A') }}</small>
                        <small class="text-muted">Earlier status updates were not recorded.</small>
                    </div>
                </li>
            @endforelse
        </ol>
    </div>
</div>
