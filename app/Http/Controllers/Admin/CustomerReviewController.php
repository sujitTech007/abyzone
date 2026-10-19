<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerReview;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CustomerReviewController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'status' => ['nullable', Rule::in(['pending', 'approved', 'rejected'])],
        ]);
        $reviews = CustomerReview::query()
            ->with(['author:id,name,email', 'target:id,name,role', 'warehouseBooking.warehouse:id,name', 'serviceRequirement:id,title'])
            ->when(isset($filters['status']), fn ($query) => $query->where('status', $filters['status']))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.customer-reviews.index', compact('reviews', 'filters'));
    }

    public function show(CustomerReview $customerReview): View
    {
        $customerReview->load([
            'author:id,name,email',
            'target:id,name,email,role',
            'warehouseBooking.warehouse:id,name',
            'serviceRequirement:id,title',
        ]);

        return view('admin.customer-reviews.show', compact('customerReview'));
    }

    public function moderate(Request $request, CustomerReview $customerReview): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['approved', 'rejected'])],
            'moderation_note' => ['required_if:status,rejected', 'nullable', 'string', 'max:2000'],
        ]);

        DB::transaction(function () use ($request, $customerReview, $data) {
            $review = CustomerReview::query()
                ->whereKey($customerReview->id)
                ->lockForUpdate()
                ->firstOrFail();
            $review->update([
                'status' => $data['status'],
                'moderation_note' => $data['status'] === 'rejected' ? $data['moderation_note'] : null,
                'moderated_by' => $request->user('admin')->id,
                'moderated_at' => now(),
            ]);
        });

        return back()->with('success', 'Review marked '.strtolower($data['status']).'.');
    }
}
