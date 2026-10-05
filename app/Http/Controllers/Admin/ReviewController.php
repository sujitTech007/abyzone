<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['service', 'user'])->orderBy('id', 'desc')->paginate(15);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function show($id)
    {
        $review = Review::with(['service', 'user'])->findOrFail($id);
        return view('admin.reviews.show', compact('review'));
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted');
    }
}
