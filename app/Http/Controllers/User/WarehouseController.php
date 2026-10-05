<?php



namespace App\Http\Controllers\User;



use App\Http\Controllers\Controller;

use App\Models\Warehouse;

use App\Models\User;

use App\Models\WarehouseBooking;

use App\Helpers\NotificationHelper;

use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use Illuminate\View\View;

use Illuminate\Support\Facades\Mail;

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

        $warehouses = $query
            ->orderByDesc('id')
            ->paginate(9)
            ->withQueryString();

        return view('user.warehouses.index', [
            'warehouses' => $warehouses,
            'filters' => $request->only(['search', 'location']),
        ]);
    }



    public function show(Warehouse $warehouse): View

    {

        abort_if($warehouse->status === 'draft', 404);



        return view('user.warehouses.show', compact('warehouse'));
    }



    public function book(Request $request, Warehouse $warehouse): RedirectResponse

    {

        $data = $request->validate([

            'start_date' => 'required|date|after_or_equal:today',

            'end_date' => 'nullable|date|after_or_equal:start_date',

            'requested_capacity' => 'nullable|numeric|min:0',

            'requested_capacity_unit' => 'nullable|string|in:SQFT,SQM,CBM,Weight,Pallet',

            'notes' => 'nullable|string|max:1000',

            'service_template_answer' => 'nullable|file|mimes:pdf,doc,docx,xlsx|max:5120',

        ]);



        // service questionnaire template

        if ($request->hasFile('service_template_answer')) {

            $file = $request->file('service_template_answer');

            $name = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/service-templates'), $name);

            $data['service_template_answer'] = 'uploads/service-templates/' . $name;
        }



        $booking = WarehouseBooking::create([

            'warehouse_id' => $warehouse->id,

            'owner_id' => $warehouse->user_id,

            'customer_id' => $request->user()->id,

            'status' => WarehouseBooking::STATUS_PENDING,

            'start_date' => $data['start_date'],

            'end_date' => $data['end_date'] ?? null,

            'requested_capacity' => $data['requested_capacity'] ?? null,

            'requested_capacity_unit' => $data['requested_capacity_unit'] ?? null,

            'notes' => $data['notes'] ?? null,

            'service_template_answer' => $data['service_template_answer'] ?? null,

        ]);



        $owner = User::where('id', $booking->owner_id)->first();



        // Send notification to warehouse owner

        NotificationHelper::newBooking(

            $warehouse->user_id,

            $request->user()->name,

            $warehouse->name

        );



        // email the warehouse owner



        Mail::to($owner->email)->send(new BookingRequestMail($booking));





        return redirect()

            ->route('user.warehouses.show', ['warehouse' => $warehouse->slug])

            ->with('success', 'Booking request submitted. The owner will review and get back to you soon.');
    }
}
