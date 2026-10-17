<?php

namespace App\Http\Controllers\ChannelPartner;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ChannelPartnerController extends Controller
{
    public const SERVICE_TYPES = [
        'Warehouse Cleaning / Cleaner',
        'Pesticide Treatment / Pest Control',
        'Transportation / Delivery',
        'Packing & Packaging',
        'Loading & Unloading',
        'Security Services',
        'Equipment Maintenance',
        'Inventory Handling',
        'Waste Management',
    ];

    public function dashboard(Request $request): View|RedirectResponse
    {
        $partner = $request->user();
        if (! $this->profileIsComplete($partner)) {
            return redirect()->route('channel-partner.profile.edit')
                ->with('info', 'Complete your service and address details to finish setting up your Channel Partner profile.');
        }

        $providedServices = array_values(array_intersect(
            self::SERVICE_TYPES,
            $partner->partner_service_types ?? []
        ));

        return view('channel-partner.dashboard', compact('partner', 'providedServices'));
    }

    public function profile(Request $request): View
    {
        $partner = $request->user();
        $providedServices = array_values(array_intersect(
            self::SERVICE_TYPES,
            $partner->partner_service_types ?? []
        ));

        return view('channel-partner.profile', compact('partner', 'providedServices'));
    }

    public function editProfile(Request $request): View
    {
        $partner = $request->user();
        $serviceTypes = self::SERVICE_TYPES;
        $selectedServiceTypes = array_values(array_intersect(
            $serviceTypes,
            $partner->partner_service_types ?? []
        ));

        return view('channel-partner.profile-edit', compact('partner', 'serviceTypes', 'selectedServiceTypes'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $rawPhone = trim((string) $request->input('phone'));
        $phoneDigits = preg_replace('/\D+/', '', $rawPhone);
        $phoneCodeDigits = preg_replace('/\D+/', '', (string) $request->input('phone_code'));
        if (str_starts_with($rawPhone, '+') && $phoneCodeDigits !== '' && str_starts_with($phoneDigits, $phoneCodeDigits)) {
            $phoneDigits = substr($phoneDigits, strlen($phoneCodeDigits));
        }

        $request->merge([
            'phone' => $phoneDigits,
            'phone_code' => '+' . $phoneCodeDigits,
        ]);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($request->user()->id)],
            'phone_code' => ['required', 'string', 'regex:/^\+[1-9]\d{0,2}$/'],
            'phone' => ['required', 'string', 'regex:/^\d{4,15}$/', Rule::unique('users', 'phone')->ignore($request->user()->id)],
            'partner_service_types' => ['required', 'array', 'min:1'],
            'partner_service_types.*' => ['required', 'string', 'distinct', Rule::in(self::SERVICE_TYPES)],
            'address_street' => ['required', 'string', 'max:255'],
            'address_city' => ['required', 'string', 'max:255'],
            'address_state' => ['required', 'string', 'max:255'],
            'address_country' => ['required', 'string', 'max:255'],
            'address_postal' => ['required', 'string', 'max:50'],
        ]);

        $request->user()->update($data);

        return redirect()->route('channel-partner.profile')
            ->with('success', 'Your Channel Partner profile has been saved.');
    }

    private function profileIsComplete(User $partner): bool
    {
        $serviceTypes = $partner->partner_service_types ?? [];

        return count($serviceTypes) > 0
            && count(array_diff($serviceTypes, self::SERVICE_TYPES)) === 0
            && filled($partner->address_street)
            && filled($partner->address_city)
            && filled($partner->address_state)
            && filled($partner->address_country)
            && filled($partner->address_postal);
    }
}
