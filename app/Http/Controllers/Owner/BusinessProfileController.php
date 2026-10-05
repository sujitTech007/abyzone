<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class BusinessProfileController extends Controller
{
    public function show()
    {
        $owner = auth()->user();

        return view('owner.business-profile.show', compact('owner'));
    }

    public function edit()
    {
        $owner = auth()->user();

        return view('owner.business-profile.edit', compact('owner'));
    }

    public function update(Request $request)
    {
        $owner = auth()->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'business_name' => 'nullable|string|max:255',
            // 'business_type' => 'nullable|string|max:255',
            // 'turnaround_time' => 'nullable|string|max:255',
            'product_details' => 'nullable|string',
            'business_address' => 'nullable|string',
            'warehouse_types' => 'nullable|array',
            'warehouse_types.*' => 'string',
            'warehouse_types_others' => 'nullable|string|max:255',
            'address_street' => 'nullable|string|max:255',
            'address_city' => 'nullable|string|max:255',
            'address_state' => 'nullable|string|max:255',
            'address_postal' => 'nullable|string|max:50',
        ]);

        $owner->update($data);

        return redirect()
            ->route('owner.business.profile')
            ->with('success', 'Business profile updated successfully.');
    }
}
