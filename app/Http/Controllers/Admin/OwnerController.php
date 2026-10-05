<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = Vendor::orderBy('id','desc')->paginate(15);
        return view('admin.owners.index', compact('owners'));
    }

    public function create()
    {
        return view('admin.owners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'nullable|email|unique:vendors,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $data['status'] = isset($data['status']) ? 1 : 0;

        $vendor = Vendor::create($data);

        return redirect()->route('admin.owners.index')->with('success','Owner created successfully');
    }

    public function show($id)
    {
        $owner = Vendor::findOrFail($id);
        return view('admin.owners.show', compact('owner'));
    }

    public function edit($id)
    {
        $owner = Vendor::findOrFail($id);
        return view('admin.owners.edit', compact('owner'));
    }

    public function update(Request $request, $id)
    {
        $owner = Vendor::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'nullable|email|unique:vendors,email,'.$owner->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $data['status'] = isset($data['status']) ? 1 : 0;
        $owner->update($data);

        return redirect()->route('admin.owners.index')->with('success','Owner updated successfully');
    }

    public function destroy($id)
    {
        $owner = Vendor::findOrFail($id);
        $owner->delete();
        return redirect()->route('admin.owners.index')->with('success','Owner deleted');
    }
}
