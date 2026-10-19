@php
    $reviews = $user->approvedCustomerReviews();
    $userAttributes = $user->getAttributes();
    $reviewCount = array_key_exists('approved_customer_reviews_count', $userAttributes)
        ? (int) $user->getAttribute('approved_customer_reviews_count')
        : (clone $reviews)->count();
    $averageRating = array_key_exists('approved_customer_reviews_avg_rating', $userAttributes)
        ? $user->getAttribute('approved_customer_reviews_avg_rating')
        : ($reviewCount ? (clone $reviews)->avg('rating') : null);
@endphp

@if($reviewCount)
    <div {{ $attributes->merge(['class' => 'text-warning']) }} aria-label="{{ number_format($averageRating, 1) }} out of 5 from {{ $reviewCount }} reviews">
        <i class="fa-solid fa-star"></i>
        <span class="fw-semibold text-body">{{ number_format($averageRating, 1) }}</span>
        <span class="text-muted">({{ $reviewCount }} {{ \Illuminate\Support\Str::plural('review', $reviewCount) }})</span>
    </div>
@else
    <div {{ $attributes->merge(['class' => 'small text-muted']) }}>No customer reviews yet</div>
@endif
