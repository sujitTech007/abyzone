<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Blog;
use App\Models\Warehouse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
    

        $blogs = Blog::query()
            ->orderByDesc('id')
            ->paginate('10');

        return view('admin.blog.index', compact('blogs'));
    }

    public function create(): View
    {

        return view('admin.blog.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate form data
        $request->validate([
            'category' => 'required|string|max:255',
            'title'    => 'required|string|max:255',
            'content'  => 'nullable|string',
            'image'    => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'   => 'required|in:0,1',
        ]);
    
        // Create new Blog model
        $blog = new Blog();
        $blog->category = $request->category;
        $blog->title    = $request->title;
        $blog->content  = $request->content;
        $blog->status   = $request->status;
    
        // Save Image Manually in /public/uploads/blog-images
        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $imageName  = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blog-images'), $imageName);
            $blog->image = 'uploads/blog-images/' . $imageName;
        }
    
        $blog->save();
    
        return redirect()
            ->route('admin.blog')
            ->with('success', 'Blog created successfully.');
    }

    public function show(Warehouse $warehouse): View
    {
        

        return view('admin.warehouses.show', compact('warehouse'));
    }

    public function edit($id): View
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $blog = Blog::findOrFail($id);
    
        // Validation
        $request->validate([
            'category' => 'required|string|max:255',
            'title'    => 'required|string|max:255',
            'content'  => 'nullable|string',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'   => 'required|in:0,1',
        ]);
    
        // Update fields
        $blog->category = $request->category;
        $blog->title    = $request->title;
        $blog->content  = $request->content;
        $blog->status   = $request->status;
    
        // Image update
        if ($request->hasFile('image')) {
    
            // delete old file
            if ($blog->image && file_exists(public_path($blog->image))) {
                unlink(public_path($blog->image));
            }
    
            // save new image
            $image      = $request->file('image');
            $imageName  = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blog-images'), $imageName);
    
            $blog->image = 'uploads/blog-images/' . $imageName;
        }
    
        $blog->save();
    
        return redirect()
            ->route('admin.blog')
            ->with('success', 'Blog updated successfully.');
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
            'address' => 'nullable|string',
            'size_sqft' => 'nullable|numeric|min:0',
            'capacity_units' => 'nullable|integer|min:0',
            'price_per_month' => 'nullable|numeric|min:0',
            'status' => 'required|in:draft,available,unavailable',
            'amenities' => 'nullable|string',
            'description' => 'nullable|string',
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
