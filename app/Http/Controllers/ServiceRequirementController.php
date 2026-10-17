<?php

namespace App\Http\Controllers;

use App\Helpers\NotificationHelper;
use App\Http\Controllers\ChannelPartner\ChannelPartnerController;
use App\Models\ServiceRequirement;
use App\Models\ServiceRequirementOffer;
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
            ->withCount('offers')
            ->latest()
            ->paginate(12);

        return view('service-requirements.index', compact('requirements'));
    }

    public function create(): View
    {
        return view('service-requirements.create', [
            'serviceTypes' => ChannelPartnerController::SERVICE_TYPES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'service_type' => ['required', 'string', Rule::in(ChannelPartnerController::SERVICE_TYPES)],
            'title' => ['required', 'string', 'max:180'],
            'description' => ['required', 'string', 'max:5000'],
            'service_location' => ['required', 'string', 'max:255'],
            'needed_by' => ['nullable', 'date', 'after_or_equal:today'],
        ]);

        $requirement = ServiceRequirement::create([
            ...$data,
            'requester_id' => $request->user()->id,
            'requester_role' => $request->user()->role,
        ]);

        return redirect()->route($this->routeName($request, 'index'))
            ->with('success', "Service request #{$requirement->id} is now available to matching Channel Partners.");
    }

    public function show(Request $request, ServiceRequirement $serviceRequirement): View
    {
        $this->authorizeRequester($request, $serviceRequirement);

        $serviceRequirement->load([
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

    private function routeName(Request $request, string $action): string
    {
        return $request->user()->role === 'vendor'
            ? "owner.service-requirements.{$action}"
            : "user.service-requirements.{$action}";
    }
}
