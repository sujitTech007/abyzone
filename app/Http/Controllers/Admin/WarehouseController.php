<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class WarehouseController extends Controller
{
    public function index(): View
    {
    

        $warehouses = Warehouse::query()
            ->orderByDesc('id')
            ->paginate(15);
        $users = User::where('role', 'vendor')->get();

        return view('admin.warehouses.index', compact('warehouses', 'users'));
    }

    public function create(): View
    {
      $users = User::where('role', 'vendor')->get();

        return view('admin.warehouses.create', compact('users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        // require user id passed by select
        $data['slug'] = Str::slug($data['name']).'-'.Str::random(8);
        $data['code'] = $data['code'] ?: strtoupper(Str::random(6));
        $data['amenities'] = $this->normalizeAmenities($request->input('amenities'));

        // multiple images
        if ($request->hasFile('images')) {
            $paths = [];
            foreach ($request->file('images') as $file) {
                $imageName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/warehouse-images'), $imageName);
                $paths[] = 'uploads/warehouse-images/' . $imageName;
            }
            $data['images'] = $paths;
        }

        // service template
        if ($request->hasFile('service_template')) {
            $file = $request->file('service_template');
            $name = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/service-templates'), $name);
            $data['service_template'] = 'uploads/service-templates/' . $name;
        }

        Warehouse::create($data);

        return redirect()
            ->route('admin.warehouses')
            ->with('success', 'Warehouse created successfully.');
    }

    public function show(Warehouse $warehouse): View
    {
        

        return view('admin.warehouses.show', compact('warehouse'));
    }

    public function edit(Warehouse $warehouse): View
    {
      
 $users = User::where('role', 'vendor')->get();
        $amenities = implode(', ', $warehouse->amenities ?? []);

        return view('admin.warehouses.edit', compact('warehouse', 'amenities', 'users'));
    }

    // public function update(Request $request, Warehouse $warehouse): RedirectResponse
    // {
        

    //     $data = $this->validatedData($request);

    //     if ($warehouse->name !== $data['name']) {
    //         $data['slug'] = Str::slug($data['name']).'-'.Str::random(5);
    //     }

    //     $data['code'] = $data['code'] ?: $warehouse->code ?? strtoupper(Str::random(6));
    //     $data['amenities'] = $this->normalizeAmenities($request->input('amenities'));

    //     // replace images
    //     if ($request->hasFile('images')) {
    //         if (!empty($warehouse->images) && is_array($warehouse->images)) {
    //             foreach ($warehouse->images as $old) {
    //                 if (file_exists(public_path($old))) {
    //                     unlink(public_path($old));
    //                 }
    //             }
    //         }
    //         $paths = [];
    //         foreach ($request->file('images') as $file) {
    //             $imageName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
    //             $file->move(public_path('uploads/warehouse-images'), $imageName);
    //             $paths[] = 'uploads/warehouse-images/' . $imageName;
    //         }
    //         $data['images'] = $paths;
    //     }

    //     if ($request->hasFile('service_template')) {
    //         if ($warehouse->service_template && file_exists(public_path($warehouse->service_template))) {
    //             unlink(public_path($warehouse->service_template));
    //         }
    //         $file = $request->file('service_template');
    //         $name = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
    //         $file->move(public_path('uploads/service-templates'), $name);
    //         $data['service_template'] = 'uploads/service-templates/' . $name;
    //     }


    //     $warehouse->update($data);

    //     return redirect()
    //         ->route('admin.warehouses')
    //         ->with('success', 'Warehouse updated successfully.');
    // }
    
    public function update(Request $request, Warehouse $warehouse): RedirectResponse
{
    $data = $this->validatedData($request);

    if ($warehouse->name !== $data['name']) {
        $data['slug'] = Str::slug($data['name']) . '-' . Str::random(5);
    }

    $data['code'] = $data['code'] ?: $warehouse->code ?? strtoupper(Str::random(6));

    /*
    |--------------------------------
    | Get existing images
    |--------------------------------
    */
    $existingImages = [];

    if (!empty($warehouse->images)) {
        $existingImages = is_array($warehouse->images)
            ? $warehouse->images
            : json_decode($warehouse->images, true);
    }

    /*
    |--------------------------------
    | Remove selected images
    |--------------------------------
    */
    if ($request->has('remove_images')) {

        foreach ($request->remove_images as $img) {

            if (file_exists(public_path($img))) {
                unlink(public_path($img));
            }

            $existingImages = array_diff($existingImages, [$img]);
        }
    }

    /*
    |--------------------------------
    | Upload new images
    |--------------------------------
    */
    if ($request->hasFile('images')) {

        foreach ($request->file('images') as $file) {

            $imageName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

            $file->move(public_path('uploads/warehouse-images'), $imageName);

            $existingImages[] = 'uploads/warehouse-images/'.$imageName;
        }
    }

    $data['images'] = array_values($existingImages);

    /*
    |--------------------------------
    | Service template upload
    |--------------------------------
    */
    if ($request->hasFile('service_template')) {

        if ($warehouse->service_template && file_exists(public_path($warehouse->service_template))) {
            unlink(public_path($warehouse->service_template));
        }

        $file = $request->file('service_template');

        $name = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

        $file->move(public_path('uploads/service-templates'), $name);

        $data['service_template'] = 'uploads/service-templates/'.$name;
    }

    $warehouse->update($data);

    return redirect()
        ->route('admin.warehouses')
        ->with('success', 'Warehouse updated successfully.');
}

    public function destroy(Warehouse $warehouse): RedirectResponse
    {
        

        $warehouse->delete();

        return redirect()
            ->route('admin.warehouses')
            ->with('success', 'Warehouse deleted successfully.');
    }

    protected function validatedData(Request $request): array
    {
        return $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',

            // address parts
            'address_street' => 'nullable|string|max:255',
            'address_city' => 'nullable|string|max:255',
            'address_state' => 'nullable|string|max:255',
            'address_postal' => 'nullable|string|max:50',

            'available_from' => 'nullable|date',
            'warehouse_type' => 'nullable|string|max:255',
            'warehouse_type_other' => 'nullable|string|max:255',

            'size_sqft' => 'nullable|numeric|min:0',
            'capacity_quantity' => 'nullable|numeric|min:0',
            'capacity_unit' => 'nullable|string|max:50',

            'price_value' => 'nullable|numeric|min:0',
            'price_unit' => 'nullable|string|max:50',

            'status' => 'required|in:draft,available,unavailable',

            'infra_amenities' => 'nullable|array',
            'infra_amenities.*' => 'string',
            'infra_amenities_others' => 'nullable|string',

            'service_template' => 'nullable|file|max:2048',
            'description' => 'nullable|string',

             'images' => 'required|array|max:3',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:200', // 200KB
        ]);
    }

    protected function requireOwner(): User
    {
        $user = auth()->user();

        abort_unless($user instanceof User, 403, 'Only authenticated owners can access warehouses.');
        abort_unless($user->role === 'vendor', 403, 'Only vendor accounts can access warehouses.');

        return $user;
    }

    protected function normalizeAmenities(?string $amenities): ?array
    {
        if (! $amenities) {
            return null;
        }

        $items = array_filter(array_map('trim', preg_split('/[,\\n]+/', $amenities)));

        return ! empty($items) ? array_values($items) : null;
    }

    protected function authorizeWarehouse(Warehouse $warehouse): void
    {
        $ownerId = $this->requireOwnerId();

        abort_if($warehouse->user_id !== $ownerId, 403);
    }

    protected function requireOwnerId(): int
    {
        return $this->requireOwner()->id;
    }
}
