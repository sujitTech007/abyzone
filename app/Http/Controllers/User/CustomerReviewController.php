<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CustomerReview;
use App\Models\ServiceRequirement;
use App\Models\User;
use App\Models\WarehouseBooking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CustomerReviewController extends Controller
{
    public function businesses(): View
    {
        $businesses = User::query()
            ->whereIn('role', ['vendor', 'channel_partner'])
            ->where('status', 1)
            ->withCount('approvedCustomerReviews')
            ->withAvg('approvedCustomerReviews', 'rating')
            ->orderBy('name')
            ->paginate(20);

        return view('user.feedback.businesses', compact('businesses'));
    }

    public function business(User $business): View
    {
        abort_unless(
            in_array($business->role, ['vendor', 'channel_partner'], true)
                && (bool) $business->status,
            404
        );
        $reviews = $business->approvedCustomerReviews()
            ->with('author:id,name')
            ->latest()
            ->paginate(15);

        return view('user.feedback.business', compact('business', 'reviews'));
    }

    public function index(Request $request): View
    {
        $user = $request->user();
        $completedBookings = WarehouseBooking::query()
            ->with(['warehouse:id,name', 'owner:id,name'])
            ->where('customer_id', $user->id)
            ->where('status', WarehouseBooking::STATUS_APPROVED)
            ->whereNotNull('end_date')
            ->whereDate('end_date', '<', today())
            ->whereDoesntHave('customerReviews', fn ($reviews) => $reviews->where('author_id', $user->id))
            ->latest('end_date')
            ->get();
        $awardedRequirements = ServiceRequirement::query()
            ->with(['offers' => fn ($offers) => $offers->where('status', 'accepted')->with('channelPartner:id,name')])
            ->where('requester_id', $user->id)
            ->where('requester_role', 'customer')
            ->where('status', 'completed')
            ->whereHas('offers', fn ($offers) => $offers->where('status', 'accepted'))
            ->whereDoesntHave('customerReviews', fn ($reviews) => $reviews->where('author_id', $user->id))
            ->latest()
            ->get();
        $reviews = CustomerReview::query()
            ->with(['target:id,name', 'warehouseBooking.warehouse:id,name', 'serviceRequirement:id,title'])
            ->where('author_id', $user->id)
            ->latest()
            ->paginate(15);

        return view('user.feedback.index', compact('completedBookings', 'awardedRequirements', 'reviews'));
    }

    public function createBooking(Request $request, WarehouseBooking $warehouseBooking): View
    {
        $this->authorizeCompletedBooking($request, $warehouseBooking);
        abort_if($warehouseBooking->customerReviews()->where('author_id', $request->user()->id)->exists(), 409);

        return view('user.feedback.create', [
            'target' => $warehouseBooking->owner,
            'subject' => 'Warehouse booking: '.$warehouseBooking->warehouse->name,
            'action' => route('user.feedback.booking.store', $warehouseBooking),
        ]);
    }

    public function storeBooking(Request $request, WarehouseBooking $warehouseBooking): RedirectResponse
    {
        $this->authorizeCompletedBooking($request, $warehouseBooking);
        $data = $this->validatedReview($request);

        DB::transaction(function () use ($request, $warehouseBooking, $data) {
            $booking = WarehouseBooking::query()->whereKey($warehouseBooking->id)->lockForUpdate()->firstOrFail();
            $this->authorizeCompletedBooking($request, $booking);
            abort_if($booking->customerReviews()->where('author_id', $request->user()->id)->exists(), 409);

            $booking->customerReviews()->create([
                ...$data,
                'author_id' => $request->user()->id,
                'target_user_id' => $booking->owner_id,
                'status' => 'pending',
            ]);
        });

        return redirect()->route('user.feedback.index')->with('success', 'Thank you. Your review is awaiting moderation.');
    }

    public function createService(Request $request, ServiceRequirement $serviceRequirement): View
    {
        $offer = $this->acceptedCustomerServiceOffer($request, $serviceRequirement);
        abort_if($serviceRequirement->customerReviews()->where('author_id', $request->user()->id)->exists(), 409);

        return view('user.feedback.create', [
            'target' => $offer->channelPartner,
            'subject' => 'Service requirement: '.$serviceRequirement->title,
            'action' => route('user.feedback.service.store', $serviceRequirement),
        ]);
    }

    public function storeService(Request $request, ServiceRequirement $serviceRequirement): RedirectResponse
    {
        $data = $this->validatedReview($request);

        DB::transaction(function () use ($request, $serviceRequirement, $data) {
            $requirement = ServiceRequirement::query()->whereKey($serviceRequirement->id)->lockForUpdate()->firstOrFail();
            $offer = $this->acceptedCustomerServiceOffer($request, $requirement);
            abort_if($requirement->customerReviews()->where('author_id', $request->user()->id)->exists(), 409);

            $requirement->customerReviews()->create([
                ...$data,
                'author_id' => $request->user()->id,
                'target_user_id' => $offer->channel_partner_id,
                'status' => 'pending',
            ]);
        });

        return redirect()->route('user.feedback.index')->with('success', 'Thank you. Your review is awaiting moderation.');
    }

    public function resubmit(Request $request, CustomerReview $customerReview): RedirectResponse
    {
        abort_unless(
            $customerReview->author_id === $request->user()->id
                && $customerReview->status === 'rejected',
            404
        );
        $data = $this->validatedReview($request);
        DB::transaction(function () use ($request, $customerReview, $data) {
            $review = CustomerReview::query()
                ->whereKey($customerReview->id)
                ->lockForUpdate()
                ->firstOrFail();
            abort_unless(
                $review->author_id === $request->user()->id
                    && $review->status === 'rejected',
                404
            );
            $review->update([
                ...$data,
                'status' => 'pending',
                'moderation_note' => null,
                'moderated_by' => null,
                'moderated_at' => null,
            ]);
        });

        return redirect()->route('user.feedback.index')->with('success', 'Your updated review has been resubmitted for moderation.');
    }

    private function validatedReview(Request $request): array
    {
        return $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required', 'string', 'min:10', 'max:3000'],
        ]);
    }

    private function authorizeCompletedBooking(Request $request, WarehouseBooking $booking): void
    {
        abort_unless(
            $booking->customer_id === $request->user()->id
                && $booking->status === WarehouseBooking::STATUS_APPROVED
                && $booking->end_date !== null
                && $booking->end_date->isBefore(today()),
            404
        );
        $booking->loadMissing(['owner:id,name', 'warehouse:id,name']);
    }

    private function acceptedCustomerServiceOffer(Request $request, ServiceRequirement $requirement)
    {
        abort_unless(
            $requirement->requester_id === $request->user()->id
                && $requirement->requester_role === 'customer'
                && $requirement->status === 'completed',
            404
        );

        return $requirement->offers()
            ->with('channelPartner:id,name')
            ->where('status', 'accepted')
            ->firstOrFail();
    }
}
