@if($user->isVerified())
    <span {{ $attributes->merge(['class' => 'badge rounded-pill bg-success-subtle text-success']) }}>
        <i class="fa-solid fa-circle-check me-1"></i>Verified
    </span>
@endif
