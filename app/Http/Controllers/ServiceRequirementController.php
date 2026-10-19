<?php

namespace App\Http\Controllers;

use App\Helpers\NotificationHelper;
use App\Http\Controllers\ChannelPartner\ChannelPartnerController;
use App\Models\ServiceRequirement;
use App\Models\ServiceRequirementOffer;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\WarehouseBooking;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ServiceRequirementController extends Controller
{
    public function index(Request $request): View
    {
        $requirements = ServiceRequirement::query()
            ->where('requester_id', $request->user()->id)
            ->where('requester_role', $request->user()->role)
            ->with('warehouse:id,name,location,address_street,address_city,address_state,address_country,address_postal')
            ->withCount('offers')
            ->latest()
            ->paginate(12);

        return view('service-requirements.index', compact('requirements'));
    }

    public function create(Request $request): View
    {
        $warehouses = $this->eligibleWarehouses($request)
            ->orderBy('name')
            ->get([
                'id',
                'name',
                'location',
                'address_street',
                'address_city',
                'address_state',
                'address_country',
                'address_postal',
            ]);

        return view('service-requirements.create', [
            'serviceTypes' => ChannelPartnerController::SERVICE_TYPES,
            'warehouses' => $warehouses,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'service_type' => ['required', 'string', Rule::in(ChannelPartnerController::SERVICE_TYPES)],
            'warehouse_id' => ['required', 'integer', 'exists:warehouses,id'],
            'title' => ['required', 'string', 'max:180'],
            'description' => ['required', 'string', 'max:5000'],
            'needed_by' => ['nullable', 'date', 'after_or_equal:today'],
        ]);

        $warehouse = $this->eligibleWarehouses($request)
            ->findOrFail($data['warehouse_id']);
        $data['service_location'] = $this->warehouseLocation($warehouse);

        $requirement = ServiceRequirement::create([
            ...$data,
            'requester_id' => $request->user()->id,
            'requester_role' => $request->user()->role,
        ]);

        $matchingPartners = User::query()
            ->where('role', 'channel_partner')
            ->where('status', 1)
            ->whereJsonContains('partner_service_types', $requirement->service_type)
            ->get(['id']);

        foreach ($matchingPartners as $partner) {
            NotificationHelper::sendToUser(
                $partner->id,
                'service_requirement',
                'New matching service request',
                "{$request->user()->name} needs {$requirement->service_type} for {$warehouse->name}: \"{$requirement->title}\"."
            );
        }

        return redirect()->route($this->routeName($request, 'index'))
            ->with('success', "Service request #{$requirement->id} is now available to matching Channel Partners.");
    }

    public function show(Request $request, ServiceRequirement $serviceRequirement): View
    {
        $this->authorizeRequester($request, $serviceRequirement);

        $serviceRequirement->load([
            'warehouse:id,name,location,address_street,address_city,address_state,address_country,address_postal',
            'payment',
            'offers.channelPartner' => fn ($query) => $query->where('role', 'channel_partner'),
        ]);

        return view('service-requirements.show', compact('serviceRequirement'));
    }

    public function opportunities(Request $request): View|RedirectResponse
    {
        if (! $this->channelPartnerProfileComplete($request)) {
            return redirect()->route('channel-partner.profile.edit')
                ->with('info', 'Complete your Channel Partner profile before browsing service opportunities.');
        }

        $serviceTypes = $request->user()->partner_service_types ?? [];
        $requirements = ServiceRequirement::query()
            ->where(function ($query) use ($request, $serviceTypes) {
                $query->where(function ($open) use ($serviceTypes) {
                    $open->where('status', 'open')->whereIn('service_type', $serviceTypes);
                })->orWhereHas('offers', fn ($offers) => $offers
                    ->where('channel_partner_id', $request->user()->id));
            })
            ->with('requester:id,name,role')
            ->with('warehouse:id,name,location,address_street,address_city,address_state,address_country,address_postal')
            ->with(['offers' => fn ($query) => $query->where('channel_partner_id', $request->user()->id)])
            ->latest()
            ->paginate(12);

        return view('channel-partner.opportunities.index', compact('requirements'));
    }

    public function opportunity(Request $request, ServiceRequirement $serviceRequirement): View|RedirectResponse
    {
        if (! $this->channelPartnerProfileComplete($request)) {
            return redirect()->route('channel-partner.profile.edit')
                ->with('info', 'Complete your Channel Partner profile before viewing service opportunities.');
        }

        $hasExistingOffer = $serviceRequirement->offers()
            ->where('channel_partner_id', $request->user()->id)
            ->exists();
        abort_unless(
            ($serviceRequirement->status === 'open'
                && in_array($serviceRequirement->service_type, $request->user()->partner_service_types ?? [], true))
                || $hasExistingOffer,
            404
        );

        $serviceRequirement->load([
            'requester:id,name,role,email,phone,phone_code',
            'warehouse:id,name,location,address_street,address_city,address_state,address_country,address_postal',
            'offers' => fn ($query) => $query->where('channel_partner_id', $request->user()->id),
        ]);

        return view('channel-partner.opportunities.show', compact('serviceRequirement'));
    }

    public function offer(Request $request, ServiceRequirement $serviceRequirement): RedirectResponse
    {
        if (! $this->channelPartnerProfileComplete($request)) {
            return redirect()->route('channel-partner.profile.edit')
                ->with('info', 'Complete your Channel Partner profile before sending offers.');
        }

        abort_unless($serviceRequirement->status === 'open', 404);
        abort_unless(in_array($serviceRequirement->service_type, $request->user()->partner_service_types ?? [], true), 403);

        $data = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01', 'max:9999999999.99'],
            'description' => ['required', 'string', 'max:5000'],
        ]);

        $offer = ServiceRequirementOffer::updateOrCreate(
            [
                'service_requirement_id' => $serviceRequirement->id,
                'channel_partner_id' => $request->user()->id,
            ],
            [
                ...$data,
                'status' => 'pending',
            ]
        );

        NotificationHelper::sendToUser(
            $serviceRequirement->requester_id,
            'service_offer',
            'New service offer received',
            "{$request->user()->name} submitted an offer of {$offer->amount} for \"{$serviceRequirement->title}\"."
        );

        return redirect()->route('channel-partner.opportunities.show', $serviceRequirement)
            ->with('success', 'Your offer has been sent to the requester.');
    }

    public function acceptOffer(Request $request, ServiceRequirement $serviceRequirement, ServiceRequirementOffer $offer): RedirectResponse
    {
        $this->authorizeRequester($request, $serviceRequirement);

        DB::transaction(function () use ($request, $serviceRequirement, $offer) {
            $lockedRequirement = ServiceRequirement::whereKey($serviceRequirement->id)
                ->lockForUpdate()
                ->firstOrFail();
            abort_unless($lockedRequirement->status === 'open', 409, 'This service request has already been awarded or closed.');

            $selectedOffer = ServiceRequirementOffer::whereKey($offer->id)
                ->where('service_requirement_id', $lockedRequirement->id)
                ->where('status', 'pending')
                ->firstOrFail();

            $selectedOffer->update(['status' => 'accepted']);
            ServiceRequirementOffer::where('service_requirement_id', $lockedRequirement->id)
                ->where('id', '!=', $selectedOffer->id)
                ->where('status', 'pending')
                ->update(['status' => 'not_selected']);
            $lockedRequirement->update(['status' => 'awarded']);

            NotificationHelper::sendToUser(
                $selectedOffer->channel_partner_id,
                'service_offer_accepted',
                'Your service offer was accepted',
                "Your offer for \"{$lockedRequirement->title}\" was accepted by the requester."
            );
        });

        return redirect()->route($this->routeName($request, 'show'), $serviceRequirement)
            ->with('success', 'You selected the Channel Partner offer. Other offers are now closed.');
    }

    private function authorizeRequester(Request $request, ServiceRequirement $serviceRequirement): void
    {
        abort_unless(
            $serviceRequirement->requester_id === $request->user()->id
                && $serviceRequirement->requester_role === $request->user()->role,
            403
        );
    }

    private function channelPartnerProfileComplete(Request $request): bool
    {
        $partner = $request->user();
        $types = $partner->partner_service_types ?? [];

        return count($types) > 0
            && count(array_diff($types, ChannelPartnerController::SERVICE_TYPES)) === 0
            && filled($partner->address_street)
            && filled($partner->address_city)
            && filled($partner->address_state)
            && filled($partner->address_country)
            && filled($partner->address_postal);
    }

    private function warehouseLocation(Warehouse $warehouse): string
    {
        $location = collect([
            $warehouse->address_street,
            $warehouse->address_city,
            $warehouse->address_state,
            $warehouse->address_country,
            $warehouse->address_postal,
            $warehouse->location,
        ])->filter(fn ($value) => filled($value))
            ->unique()
            ->implode(', ');

        return \Illuminate\Support\Str::limit($location, 255, '');
    }

    private function eligibleWarehouses(Request $request): Builder
    {
        return Warehouse::query()
            ->when(
                $request->user()->role === 'vendor',
                fn ($query) => $query->where('user_id', $request->user()->id),
                fn ($query) => $query->whereHas('bookings', fn ($bookings) => $bookings
                    ->where('customer_id', $request->user()->id)
                    ->where('status', WarehouseBooking::STATUS_APPROVED))
            );
    }

    private function routeName(Request $request, string $action): string
    {
        return $request->user()->role === 'vendor'
            ? "owner.service-requirements.{$action}"
            : "user.service-requirements.{$action}";
    }
}
