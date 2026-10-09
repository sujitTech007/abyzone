<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Subscribe;
use App\Models\Blog;
use App\Models\Service;
use App\Models\Warehouse;
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

        $sizeRanges = $request->input('size', []);
        $sizeRanges = is_array($sizeRanges)
            ? array_values(array_filter($sizeRanges, 'is_string'))
            : [];
        $selectedSize = $request->input('size_select');
        if (is_string($selectedSize) && $selectedSize !== '') {
            $sizeRanges[] = $selectedSize;
        }

        $validSizeRanges = ['500-1000', '1000-5000', '5000-10000', '10000-50000', '10000+'];
        $sizeRanges = array_values(array_intersect($validSizeRanges, $sizeRanges));
        if ($sizeRanges !== []) {
            $warehouses->where(function ($query) use ($sizeRanges) {
                foreach ($sizeRanges as $range) {
                    $query->orWhere(function ($rangeQuery) use ($range) {
                        $applyRange = static function ($columnQuery, string $column) use ($range) {
                            match ($range) {
                                '500-1000' => $columnQuery->whereBetween($column, [500, 1000]),
                                '1000-5000' => $columnQuery->whereBetween($column, [1000, 5000]),
                                '5000-10000' => $columnQuery->whereBetween($column, [5000, 10000]),
                                '10000-50000' => $columnQuery->whereBetween($column, [10000, 50000]),
                                '10000+' => $columnQuery->where($column, '>=', 10000),
                            };
                        };

                        $rangeQuery->where(function ($sizeQuery) use ($applyRange) {
                            $applyRange($sizeQuery, 'size_sqft');
                        })->orWhere(function ($capacityQuery) use ($applyRange) {
                            $capacityQuery->where('capacity_unit', 'SQFT');
                            $applyRange($capacityQuery, 'capacity_quantity');
                        });
                    });
                }
            });
        }

        $priceRanges = $request->input('price', []);
        $priceRanges = is_array($priceRanges)
            ? array_values(array_filter($priceRanges, 'is_string'))
            : [];
        $selectedPrice = $request->input('price_select');
        if (is_string($selectedPrice) && $selectedPrice !== '') {
            $priceRanges[] = $selectedPrice;
        }
        $validPriceRanges = ['0-20000', '20000-50000', '50000+'];
        $priceRanges = array_values(array_intersect($validPriceRanges, $priceRanges));
        if ($priceRanges !== []) {
            $warehouses->where(function ($query) use ($priceRanges) {
                foreach ($priceRanges as $range) {
                    $query->orWhere(function ($rangeQuery) use ($range) {
                        match ($range) {
                            '0-20000' => $rangeQuery->whereRaw('COALESCE(price_value, price_per_month) BETWEEN ? AND ?', [0, 20000]),
                            '20000-50000' => $rangeQuery->whereRaw('COALESCE(price_value, price_per_month) BETWEEN ? AND ?', [20000, 50000]),
                            '50000+' => $rangeQuery->whereRaw('COALESCE(price_value, price_per_month) >= ?', [50000]),
                        };
                    });
                }
            });
        }

        if ($request->filled('location')) {
            $location = $request->input('location');
            if (is_array($location)) {
                $locations = array_values(array_filter($location, 'is_string'));
                if ($locations !== []) {
                    $warehouses->whereIn('location', $locations);
                }
            } elseif (is_string($location)) {
                $warehouses->where('location', 'like', '%' . trim($location) . '%');
            }
        }

        if (is_string($request->input('home_location')) && trim($request->input('home_location')) !== '') {
            $warehouses->where('location', 'like', '%' . trim($request->input('home_location')) . '%');
        }

        $storageType = $request->input('storage_type', []);
        if (is_array($storageType)) {
            $storageTypes = array_values(array_filter($storageType, 'is_string'));
            if ($storageTypes !== []) {
                $warehouses->where(function ($query) use ($storageTypes) {
                    foreach ($storageTypes as $type) {
                        $storageLabel = str_replace(' Storage', '', $type);

                        $query->orWhere(function ($typeQuery) use ($storageLabel, $type) {
                            $typeQuery->where('storage_type', 'like', '%' . $storageLabel . '%');

                            if ($type === 'Dry Storage') {
                                $typeQuery->orWhereNull('storage_type')
                                    ->orWhere('storage_type', '');
                            }
                        });
                    }
                });
            }
        } elseif (is_string($storageType) && trim($storageType) !== '') {
            $warehouses->where('storage_type', 'like', '%' . trim($storageType) . '%');
        }

        if (is_string($request->input('home_storage_type')) && trim($request->input('home_storage_type')) !== '') {
            $warehouses->where('storage_type', 'like', '%' . trim($request->input('home_storage_type')) . '%');
        }

        $amenitiesFilter = $request->input('amenities', []);
        if (is_array($amenitiesFilter)) {
            foreach (array_filter($amenitiesFilter, 'is_string') as $amenity) {
                $warehouses->whereJsonContains('amenities', $amenity);
            }
        }

        $minimumSizeValue = $request->input('min_size', $request->input('home_min_size'));
        if (is_scalar($minimumSizeValue) && $minimumSizeValue !== '') {
            $minimumSize = (int) $minimumSizeValue;
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

        $capacityRanges = $request->input('capacity', []);
        $validCapacityRanges = ['0-50', '50-100', '100-300', '300+'];
        $capacityRanges = is_array($capacityRanges)
            ? array_values(array_intersect($validCapacityRanges, array_filter($capacityRanges, 'is_string')))
            : [];
        if ($capacityRanges !== []) {
            $warehouses->where(function ($q) use ($capacityRanges) {
                foreach ($capacityRanges as $range) {
                    if ($range === '300+') {
                        $q->orWhere('capacity_units', '>=', 300);
                    } else {
                        [$min, $max] = explode('-', $range);
                        $q->orWhereBetween('capacity_units', [(int)$min, (int)$max]);
                    }
                }
            });
        }

        if ($request->input('sort') === 'price_low') {
            $warehouses->orderByRaw('COALESCE(price_value, price_per_month) ASC');
        } elseif ($request->input('sort') === 'price_high') {
            $warehouses->orderByRaw('COALESCE(price_value, price_per_month) DESC');
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
                'html' => view('explore-list', compact('warehouses'))->render(),
                'count' => $warehouses->count(),
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
