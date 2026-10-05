<?php

namespace App\Http\Controllers;

use App\Models\QuoteRequest;
use App\Models\MeetingRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    // Store Quote Form
    public function storeQuote(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',

            'industry_type' => 'required',
            'business_size' => 'required',
            'space_needed' => 'required',
            'warehouse_location' => 'required',
            'estimated' => 'required',
            'need_warehouse' => 'required',
        ]);

        QuoteRequest::create($validated);

        return back()->with('success', 'Quote request submitted successfully!');
    }

    // Store Meeting Form
    public function storeMeeting(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'preferred_date' => 'nullable|date',
            'message' => 'nullable',
        ]);

        MeetingRequest::create($validated);

        return back()->with('success', 'Meeting request submitted successfully!');
    }
}
