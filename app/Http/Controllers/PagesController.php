<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Subscribe;
use App\Models\Blog;
use App\Models\Service;
use App\Models\Warehouse;
use App\Models\terms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;

class PagesController extends Controller
{
    public function home()
    {
        $services = Service::where('status', 1)->get();

        $blogs = Blog::where('status', 1)
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();

        $warehouses = Warehouse::where('status', 'available')->get();

        return view('index', compact('services', 'blogs', 'warehouses'));
    }
    public function about()
    {
        return view('about');
    }
    public function terms()
    {
        return view('terms');
    }
    public function privacy()
    {
        return view('privacy');
    }

    public function services()
    {
        $services = Service::where('status', 1)->get();
        return view('service', compact('services'));
    }

    public function warehousingDetail()
    {
        return view('warehousedetail');
    }

    public function contact()
    {
        return view('contact');
    }

    public function subscribeStore(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        Subscribe::create([
            'email' => $request->email,
        ]);

        return response()->json(['message' => 'You have successfully subscribed!']);
    }


    public function contactStore(Request $request)
    {
        // Validate Form Data (optional but recommended)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required|string',
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $contact->save();

        Mail::to($contact->email)->send(new ContactUsMail($contact));

        return redirect()->back()->with('success', 'Your message has been submitted successfully!');
    }

    // public function blog()
    // {

    //     $blogs = Blog::where('status', 1)->get();
    //     $latestBlogs = Blog::where('status', 1)->orderBy('id', 'desc')->limit(4)->get();
    //      // Categories
    //     $categories = ['Logistics', 'Green Practices', 'Scalability', 'Warehouse', 'AI Warehouse'];

    //     $categoryCounts = Blog::whereIn('category', $categories)
    //         ->where('status', 1)
    //         ->select('category', \DB::raw('count(*) as total'))
    //         ->groupBy('category')
    //         ->pluck('total','category');
    //     return view('blog', compact('blogs','latestBlogs', 'categories', 'categoryCounts'));
    // }

    public function blog($category = null)
    {
        // Categories
        $categories = ['Logistics', 'Green Practices', 'Scalability', 'Warehouse', 'AI Warehouse'];

        // Count blogs per category
        $categoryCounts = Blog::whereIn('category', $categories)
            ->where('status', 1)
            ->select('category', \DB::raw('count(*) as total'))
            ->groupBy('category')
            ->pluck('total', 'category');

        // Get blogs (filtered by category if provided)
        $blogsQuery = Blog::where('status', 1);

        if ($category) {
            $blogsQuery->where('category', $category);
        }

        $blogs = $blogsQuery->get();

        $latestBlogs = Blog::where('status', 1)
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();

        return view('blog', compact('blogs', 'latestBlogs', 'categories', 'categoryCounts', 'category'));
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;

        $blogs = Blog::where('status', 1)
            ->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%$keyword%")
                    ->orWhere('content', 'like', "%$keyword%");
            })
            ->get();

        // Format data for AJAX
        $blogs = $blogs->map(function ($blog) {
            return [
                'id' => $blog->id,
                'title' => $blog->title,
                'image' => $blog->image,
                'content_short' => \Illuminate\Support\Str::limit($blog->content, 100),
                'created_at' => \Carbon\Carbon::parse($blog->created_at)->format('d M, Y'),
            ];
        });

        return response()->json(['blogs' => $blogs]);
    }



    public function blogDetail($id)
    {
        $latestBlogs = Blog::where('status', 1)
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();
        $blog = Blog::find($id);
        return view('blog-detail', compact('blog', 'latestBlogs'));
    }

    // public function explore(Request $request)
    // {
    //      $query = $request->input('search'); // get search input

    // $warehouses = Warehouse::where('status', 'available')
    //     ->when($query, function ($q) use ($query) {
    //         $q->where('name', 'like', "%{$query}%")
    //           ->orWhere('location', 'like', "%{$query}%")
    //           ->orWhere('address', 'like', "%{$query}%")
    //           ->orWhere('code', 'like', "%{$query}%");
    //     })
    //     ->get();

    // return view('explore', compact('warehouses', 'query'));


    // }



    public function explore(Request $request)
    {
        $warehouses = Warehouse::where('status', 'available');

        /* ================= SIZE FILTER ================= */
        if ($request->size) {
            $warehouses->where(function ($q) use ($request) {
                foreach ($request->size as $size) {
                    match ($size) {
                        '500-1000'   => $q->orWhereBetween('size_sqft', [500, 1000]),
                        '1000-5000'  => $q->orWhereBetween('size_sqft', [1000, 5000]),
                        '5000-10000' => $q->orWhereBetween('size_sqft', [5000, 10000]),
                        '10000+'     => $q->orWhere('size_sqft', '>=', 10000),
                    };
                }
            });
        }

        /* ================= PRICE FILTER ================= */
        if ($request->price) {
            $warehouses->where(function ($q) use ($request) {
                foreach ($request->price as $price) {
                    match ($price) {
                        '0-20000'     => $q->orWhereBetween('price_per_month', [0, 20000]),
                        '20000-50000' => $q->orWhereBetween('price_per_month', [20000, 50000]),
                        '50000+'      => $q->orWhere('price_per_month', '>=', 50000),
                    };
                }
            });
        }

        /* ================= HOME SEARCH FILTERS ================= */
        if ($request->filled('location')) {
            $location = $request->input('location');
            if (is_array($location)) {
                $warehouses->whereIn('location', $location);
            } else {
                $warehouses->where('location', 'like', '%' . trim($location) . '%');
            }
        }

        $storageType = $request->input('storage_type');
        if (is_array($storageType) && $storageType !== []) {
            $warehouses->whereIn('storage_type', $storageType);
        } elseif (is_string($storageType) && trim($storageType) !== '') {
            $warehouses->where('storage_type', 'like', '%' . trim($storageType) . '%');
        }

        /* ================= AMENITIES FILTER (JSON) ================= */
        if ($request->amenities) {
            foreach ($request->amenities as $amenity) {
                $warehouses->whereJsonContains('amenities', $amenity);
            }
        }

        /* ================= CAPACITY FILTER ================= */
        if (is_scalar($request->input('min_size')) && $request->filled('min_size')) {
            $minimumSize = (int) $request->input('min_size');
            if (in_array($minimumSize, [1000, 5000, 10000], true)) {
                $warehouses->where(function ($query) use ($minimumSize) {
                    $query->where('size_sqft', '>=', $minimumSize)
                        ->orWhere(function ($query) use ($minimumSize) {
                            $query->where('capacity_unit', 'SQFT')
                                ->where('capacity_quantity', '>=', $minimumSize);
                        });
                });
            }
        }

        if (is_array($request->input('capacity')) && $request->filled('capacity')) {
            $warehouses->where(function ($q) use ($request) {
                foreach ($request->capacity as $range) {
                    if ($range === '300+') {
                        $q->orWhere('capacity_units', '>=', 300);
                    } else {
                        [$min, $max] = explode('-', $range);
                        $q->orWhereBetween('capacity_units', [(int)$min, (int)$max]);
                    }
                }
            });
        }



        $warehouses = $warehouses->get();

        /* ================= DYNAMIC FILTER DATA ================= */

        // Locations
        $locations = Warehouse::where('status', 'available')
            ->distinct()
            ->pluck('location');

        // Amenities (JSON safe)
        $amenities = Warehouse::where('status', 'available')
            ->pluck('amenities')
            ->flatMap(function ($amenity) {
                return is_array($amenity) ? $amenity : [];
            })
            ->map(fn($a) => trim($a))
            ->unique()
            ->values();

        /* ================= AJAX RESPONSE ================= */
        if ($request->ajax()) {
            return response()->json([
                'html' => view('explore-list', compact('warehouses'))->render()
            ]);
        }

        return view('explore', compact('warehouses', 'locations', 'amenities'));
    }











    public function serviceDetail($slug)
    {
        $service = Service::where('slug', $slug)->first();
        return view('service-detail', compact('service'));
    }

    public function warehouseDetail($slug)
    {
        $warehouse = Warehouse::where('slug', $slug)->first();
        return view('warehousedetail', compact('warehouse'));
    }
}
