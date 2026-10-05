<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('id', 'desc')->paginate(15);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|in:1,0',
        ]);
        

         // 🔹 Create slug from title
        $slug = Str::slug($request->title);

        // 🔹 Ensure unique slug
        $count = Service::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }
        $data['slug'] = $slug;


         $path = public_path('uploads/service-images');
    
        // Save Image Manually in /public/uploads/blog-images
        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $imageName  = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/service-images'), $imageName);
            $data['image'] = 'uploads/service-images/' . $imageName;
        }
    
        Service::create($data);

        return redirect()->route('admin.services')->with('success', 'Service created successfully');
    }

    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.show', compact('service'));
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
              'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|in:1,0',
        ]);
        
         // 🔹 Update slug ONLY if title changed
        if ($service->title !== $request->title) {

            $slug = Str::slug($request->title);

            // 🔹 Ensure unique slug (ignore current record)
            $count = Service::where('slug', 'LIKE', "{$slug}%")
                ->where('id', '!=', $service->id)
                ->count();

            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }

            $data['slug'] = $slug;
        }


         if ($request->hasFile('image')) {

            // Delete old image if exists
            if ($service->image && file_exists(public_path($service->image))) {
                unlink(public_path($service->image));
            }
    
            $image      = $request->file('image');
            $imageName  = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $uploadPath = public_path('uploads/service-images');
    
            $image->move($uploadPath, $imageName);
    
            $data['image'] = 'uploads/service-images/' . $imageName;
        }
    
        $service->update($data);

        return redirect()->route('admin.services')->with('success', 'Service updated successfully');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect()->route('admin.services')->with('success', 'Service deleted');
    }
}
