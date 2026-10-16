<?php



namespace App\Http\Controllers\User;



use App\Http\Controllers\Controller;

use App\Models\Warehouse;

use App\Models\WarehouseBooking;
use App\Models\WarehouseBookingEvent;

use App\Helpers\NotificationHelper;

use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use Illuminate\View\View;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Mail\BookingRequestMail;



class WarehouseController extends Controller

{

    public function index(Request $request): View
    {
        $query = Warehouse::query()
            ->where('status', 'available');

        if ($search = $request->string('search')->toString()) {
            $query->where(function ($qb) use ($search) {
                $qb->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($location = $request->string('location')->toString()) {
            $query->where('location', 'like', "%{$location}%");
        }

        if ($type = $request->string('type')->toString()) {
            $query->where('warehouse_type', $type);
        }

        if ($availability = $request->string('availability')->toString()) {
            if ($availability === 'now') {
                $query->where(function ($availabilityQuery) {
                    $availabilityQuery->whereNull('available_from')
                        ->orWhereDate('available_from', '<=', now()->toDateString());
                });
            } elseif ($availability === 'upcoming') {
                $query->whereDate('available_from', '>', now()->toDateString());
            }
        }

        if ($size = $request->string('size')->toString()) {
            $query->where(function ($sizeQuery) use ($size) {
                $columnQuery = static function ($query, string $column) use ($size) {
                    if ($size === 'small') {
                        $query->where($column, '>', 0)->where($column, '<', 1000);
                    } elseif ($size === 'medium') {
                        $query->whereBetween($column, [1000, 4999.99]);
                    } elseif ($size === 'large') {
                        $query->where($column, '>=', 5000);
                    }
                };

                $sizeQuery->where(function ($query) use ($columnQuery) {
                    $columnQuery($query, 'size_sqft');
                })->orWhere(function ($query) use ($columnQuery) {
                    $query->where('capacity_unit', 'SQFT');
                    $columnQuery($query, 'capacity_quantity');
                });
            });
        }

        match ($request->input('sort')) {
            'price_low' => $query->orderByRaw('COALESCE(price_value, price_per_month) ASC'),
            'price_high' => $query->orderByRaw('COALESCE(price_value, price_per_month) DESC'),
            'name' => $query->orderBy('name'),
            default => $query->orderByDesc('id'),
        };

        $warehouseTypes = Warehouse::query()
            ->where('status', 'available')
            ->whereNotNull('warehouse_type')
            ->distinct()
            ->orderBy('warehouse_type')
            ->pluck('warehouse_type');

        $warehouses = $query
            ->paginate(9)
            ->withQueryString();

        return view('user.warehouses.index', [
            'warehouses' => $warehouses,
            'warehouseTypes' => $warehouseTypes,
            'filters' => $request->only(['search', 'location', 'type', 'size', 'availability', 'sort']),
        ]);
    }



    public function show(Warehouse $warehouse): View

    {

        abort_if($warehouse->status !== 'available', 404);

        $warehouse->load('owner');

        $bookedDateRanges = $warehouse->confirmedBookings()
            ->whereNotNull('start_date')
            ->get(['start_date', 'end_date'])
            ->map(fn (WarehouseBooking $booking) => [
                'start' => $booking->start_date->toDateString(),
                'end' => ($booking->end_date ?? $booking->start_date)->toDateString(),
            ])
            ->values();

        return view('user.warehouses.show', compact('warehouse', 'bookedDateRanges'));
    }



    public function book(Request $request, Warehouse $warehouse): RedirectResponse
    {

        abort_if($warehouse->status !== 'available', 404);

        $data = $request->validate([

            'start_date' => 'required|date|after_or_equal:today',

            'end_date' => 'nullable|date|after_or_equal:start_date',

            'requested_capacity' => 'nullable|numeric|min:0',

            'requested_capacity_unit' => 'nullable|string|in:SQFT,SQM,CBM,Weight,Pallet',

            'notes' => 'nullable|string|max:1000',

            'service_template_answer' => 'nullable|file|mimes:pdf,doc,docx,xlsx|max:5120',

        ]);



        $booking = DB::transaction(function () use ($request, $warehouse, $data) {
            $lockedWarehouse = Warehouse::query()
                ->whereKey($warehouse->id)
                ->lockForUpdate()
                ->firstOrFail();

            abort_if($lockedWarehouse->status !== 'available', 404);

            $endDate = $data['end_date'] ?? $data['start_date'];
            if ($lockedWarehouse->hasConfirmedBookingConflict($data['start_date'], $endDate)) {
                throw ValidationException::withMessages([
                    'start_date' => 'These dates are already booked. Please choose another date range.',
                ]);
            }

            if ($request->hasFile('service_template_answer')) {
                $file = $request->file('service_template_answer');
                $name = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $directory = public_path('uploads/service-templates');

                if (! is_dir($directory) && ! mkdir($directory, 0755, true) && ! is_dir($directory)) {
                    throw new \RuntimeException('Unable to prepare the service template upload directory.');
                }

                $file->move($directory, $name);
                $data['service_template_answer'] = 'uploads/service-templates/' . $name;
            }

            $booking = WarehouseBooking::create([
                'warehouse_id' => $lockedWarehouse->id,
                'owner_id' => $lockedWarehouse->user_id,
                'customer_id' => $request->user()->id,
                'status' => WarehouseBooking::STATUS_PENDING,
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'] ?? null,
                'requested_capacity' => $data['requested_capacity'] ?? null,
                'requested_capacity_unit' => $data['requested_capacity_unit'] ?? null,
                'notes' => $data['notes'] ?? null,
                'service_template_answer' => $data['service_template_answer'] ?? null,
            ]);

            WarehouseBookingEvent::create([
                'warehouse_booking_id' => $booking->id,
                'event_type' => 'request_submitted',
                'to_status' => WarehouseBooking::STATUS_PENDING,
                'actor_id' => $request->user()->id,
                'actor_role' => 'customer',
                'message' => 'Booking request submitted.',
            ]);

            return $booking;
        });



        $booking->load(['warehouse.owner', 'customer']);
        $owner = $booking->warehouse->owner;



        // Send notification to warehouse owner

        NotificationHelper::newBooking(

            $warehouse->user_id,

            $request->user()->name,

            $warehouse->name

        );



        // email the warehouse owner



        if ($owner?->email) {
            Mail::to($owner->email)->send(new BookingRequestMail($booking));
        } else {
            Log::warning('Booking request created, but the warehouse owner has no email address.', [
                'booking_id' => $booking->id,
                'owner_id' => $booking->owner_id,
            ]);
        }





        return redirect()

            ->route('user.warehouses.show', ['warehouse' => $warehouse->slug])

            ->with('success', 'Booking request submitted. The owner will review and get back to you soon.');
    }
}
