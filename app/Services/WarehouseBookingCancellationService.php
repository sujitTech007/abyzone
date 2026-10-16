<?php

namespace App\Services;

use App\Models\User;
use App\Models\WarehouseBooking;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class WarehouseBookingCancellationService
{
    public function cancel(
        WarehouseBooking $warehouseBooking,
        User $actor,
        string $actorRole,
        ?string $reason
    ): WarehouseBooking {
        return DB::transaction(function () use ($warehouseBooking, $actor, $actorRole, $reason) {
            $booking = WarehouseBooking::query()
                ->whereKey($warehouseBooking->id)
                ->lockForUpdate()
                ->firstOrFail();

            if (! in_array($booking->status, [
                WarehouseBooking::STATUS_PENDING,
                WarehouseBooking::STATUS_APPROVED,
                WarehouseBooking::STATUS_MEETING,
            ], true)) {
                throw ValidationException::withMessages([
                    'booking' => 'This booking can no longer be cancelled.',
                ]);
            }

            if ($booking->start_date && $booking->start_date->lt(today())) {
                throw ValidationException::withMessages([
                    'booking' => 'This booking can no longer be cancelled because its start date has passed.',
                ]);
            }

            $previousStatus = $booking->status;
            $booking->update([
                'status' => WarehouseBooking::STATUS_CANCELLED,
                'cancellation_reason' => $reason,
            ]);

            $booking->timelineEvents()->create([
                'event_type' => 'cancelled',
                'from_status' => $previousStatus,
                'to_status' => WarehouseBooking::STATUS_CANCELLED,
                'actor_id' => $actor->id,
                'actor_role' => $actorRole,
                'message' => $reason,
            ]);

            return $booking->fresh(['warehouse.owner', 'customer', 'timelineEvents']);
        });
    }
}
