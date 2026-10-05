<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class WarehouseController extends Controller
{
    public function index(): View
    {
        $ownerId = $this->requireOwnerId();

        $warehouses = Warehouse::query()
            ->where('user_id', $ownerId)
            ->orderByDesc('id')
            ->paginate(15);

        return view('owner.warehouses.index', compact('warehouses'));
    }

    public function create(): View
    {
        $this->requireOwnerId();

        return view('owner.warehouses.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        $data['user_id'] = $this->requireOwnerId();
        $data['slug'] = Str::slug($data['name']).'-'.Str::random(8);
        $data['code'] = $data['code'] ?: strtoupper(Str::random(6));

        // infra_amenities comes through validation as array or null
        // leave as is (cast will handle JSON storage)

        // handle multiple images upload
        if ($request->hasFile('images')) {
            $paths = [];
            foreach ($request->file('images') as $file) {
                $imageName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/warehouse-images'), $imageName);
                $paths[] = 'uploads/warehouse-images/' . $imageName;
            }
            $data['images'] = $paths;
        }

        // service questionnaire template
        if ($request->hasFile('service_template')) {
            $file = $request->file('service_template');
            $name = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/service-templates'), $name);
            $data['service_template'] = 'uploads/service-templates/' . $name;
        }

        Warehouse::create($data);
        
        Notification::create([
            'user_id' => 1, // Default admin ID
            'user_type' => 'admin',
            'type' => 'warehouse_create',
            'title' => 'New Warehouse Created',
            'message' => "Owner " . auth()->user()->name . " created a new warehouse '{$data['name']}'.",
            'is_read' => 0,
        ]);

        return redirect()
            ->route('owner.warehouses.index')
            ->with('success', 'Warehouse created successfully.');
    }

    public function show(Warehouse $warehouse): View
    {
        $this->authorizeWarehouse($warehouse);

        return view('owner.warehouses.show', compact('warehouse'));
    }

    public function edit(Warehouse $warehouse): View
    {
        $this->authorizeWarehouse($warehouse);

        return view('owner.warehouses.edit', compact('warehouse'));
    }

    public function update(Request $request, Warehouse $warehouse): RedirectResponse
    {
        $this->authorizeWarehouse($warehouse);

        $data = $this->validatedData($request);

        if ($warehouse->name !== $data['name']) {
            $data['slug'] = Str::slug($data['name']).'-'.Str::random(5);
        }

        $data['code'] = $data['code'] ?: $warehouse->code ?? strtoupper(Str::random(6));

        // handle replaces for images
        // if ($request->hasFile('images')) {
        //     // delete old images
        //     if (!empty($warehouse->images) && is_array($warehouse->images)) {
        //         foreach ($warehouse->images as $old) {
        //             if (file_exists(public_path($old))) {
        //                 unlink(public_path($old));
        //             }
        //         }
        //     }
        //     $paths = [];
        //     foreach ($request->file('images') as $file) {
        //         $imageName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        //         $file->move(public_path('uploads/warehouse-images'), $imageName);
        //         $paths[] = 'uploads/warehouse-images/' . $imageName;
        //     }
        //     $data['images'] = $paths;
        // }
        
        // existing images
$existingImages = $warehouse->images ?? [];

/*
|----------------------------------
| Remove selected images
|----------------------------------
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
|----------------------------------
| Add new images
|----------------------------------
*/
if ($request->hasFile('images')) {

    foreach ($request->file('images') as $file) {

        $imageName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/warehouse-images'), $imageName);

        $existingImages[] = 'uploads/warehouse-images/' . $imageName;

    }

}

$data['images'] = array_values($existingImages);


        // handle service template replacement
        if ($request->hasFile('service_template')) {
            if ($warehouse->service_template && file_exists(public_path($warehouse->service_template))) {
                unlink(public_path($warehouse->service_template));
            }
            $file = $request->file('service_template');
            $name = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/service-templates'), $name);
            $data['service_template'] = 'uploads/service-templates/' . $name;
        }

        $warehouse->update($data);

        return redirect()
            ->route('owner.warehouses.index')
            ->with('success', 'Warehouse updated successfully.');
    }

    public function destroy(Warehouse $warehouse): RedirectResponse
    {
        $this->authorizeWarehouse($warehouse);

        $warehouse->delete();

        return redirect()
            ->route('owner.warehouses.index')
            ->with('success', 'Warehouse deleted successfully.');
    }

    protected function validatedData(Request $request): array
    {
        return $request->validate([
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

            'capacity_quantity' => 'nullable|numeric|min:0',
            'capacity_unit' => 'nullable|string|max:50',

            'price_value' => 'nullable|numeric|min:0',
            'price_unit' => 'nullable|string|max:50',

            'status' => 'required|in:draft,available,unavailable',

            // infrastructure/amenities checkbox list
            'infra_amenities' => 'nullable|array',
            'infra_amenities.*' => 'string',
            'infra_amenities_others' => 'nullable|string',

            'service_template' => 'nullable|file|max:2048',

            'size_sqft' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',

            // image uploads
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
