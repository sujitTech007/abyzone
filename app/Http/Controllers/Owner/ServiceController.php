<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Vendor;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        // In a real app you would filter by the logged-in vendor
        $services = Service::orderBy('id','desc')->paginate(15);
        return view('owner.services.index', compact('services'));
    }

    public function create()
    {
        return view('owner.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'nullable|integer',
            'status' => 'nullable|in:pending,active,inactive',
        ]);

        // Assign to a vendor - for now pick first vendor or null
        $vendor = Vendor::first();
        $data['vendor_id'] = $vendor ? $vendor->id : null;
        $data['slug'] = Str::slug($data['title']).'-'.time();

        $service = Service::create($data);

        return redirect()->route('owner.services.index')->with('success', 'Service created');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('owner.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'nullable|integer',
            'status' => 'nullable|in:pending,active,inactive',
        ]);

        $service->update($data);

        return redirect()->route('owner.services.index')->with('success', 'Service updated');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect()->route('owner.services.index')->with('success', 'Service deleted');
    }

    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('owner.services.show', compact('service'));
    }
}
