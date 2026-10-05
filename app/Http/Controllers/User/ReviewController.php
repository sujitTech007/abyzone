<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::where('user_id', auth()->id())
            ->with('service')
            ->orderBy('id', 'desc')
            ->paginate(15);
        return view('user.reviews.index', compact('reviews'));
    }

    public function create()
    {
        return view('user.reviews.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'service_id' => 'required|exists:services,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10',
        ]);

        $data['user_id'] = auth()->id();

        Review::create($data);

        return redirect()->route('user.reviews.index')->with('success', 'Review posted successfully');
    }

    public function show($id)
    {
        $review = Review::where('user_id', auth()->id())->with('service')->findOrFail($id);
        return view('user.reviews.show', compact('review'));
    }

    public function edit($id)
    {
        $review = Review::where('user_id', auth()->id())->findOrFail($id);
        return view('user.reviews.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = Review::where('user_id', auth()->id())->findOrFail($id);

        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10',
        ]);

        $review->update($data);

        return redirect()->route('user.reviews.index')->with('success', 'Review updated successfully');
    }

    public function destroy($id)
    {
        $review = Review::where('user_id', auth()->id())->findOrFail($id);
        $review->delete();
        return redirect()->route('user.reviews.index')->with('success', 'Review deleted');
    }
}
