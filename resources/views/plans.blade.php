@include('include.header')

<style>
    .plans-hero {
        background:
            radial-gradient(circle at 85% 20%, rgba(250, 163, 27, .18), transparent 26%),
            linear-gradient(125deg, #282660, #39377f);
        color: #fff;
    }

    .plans-eyebrow {
        color: #faa31b;
        font-size: .8rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
    }

    .plan-card {
        border: 1px solid #e8e8ef;
        border-radius: 18px;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .plan-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 2.5rem rgba(40, 38, 96, .12) !important;
    }

    .plan-card-featured {
        border: 2px solid #faa31b;
    }

    .plan-feature-icon {
        color: #282660;
        background: rgba(250, 163, 27, .16);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
    }
</style>

<main>
    <section class="plans-hero py-5">
        <div class="container py-lg-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <span class="plans-eyebrow">Flexible options for your business</span>
                    <h1 class="display-4 fw-bold mt-3 mb-3">Choose your plan</h1>
                    <p class="lead mb-0 text-white-50">
                        Find the right level of support for your warehousing and logistics needs.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('contact') }}" class="btn theme_btn btn-lg px-4">
                        Talk to our team <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container py-lg-4">
            <div class="text-center mx-auto mb-5" style="max-width: 720px;">
                <span class="sub_title">ABYzone plans</span>
                <h2 class="fw-bold mt-2">Simple plans, built to scale</h2>
                <p class="text-muted mb-0">
                    Compare the options below and contact us when you’re ready to discuss your requirements.
                </p>
                <div class="alert alert-warning d-inline-flex align-items-center gap-2 mt-4 mb-0 py-2 px-3" role="note">
                    <i class="fa-solid fa-circle-info"></i>
                    <span><strong>Sample plans:</strong> Prices and features are placeholders and may change.</span>
                </div>
            </div>

            <div class="row g-4 justify-content-center align-items-stretch">
                @forelse($plans as $plan)
                    <div class="col-md-6 col-xl-4">
                        <article class="card plan-card h-100 shadow-sm {{ $plan->is_featured ? 'plan-card-featured' : '' }}">
                            @if($plan->is_featured)
                                <div class="card-header text-center border-0 pt-3 pb-0 bg-transparent">
                                    <span class="badge rounded-pill px-3 py-2" style="background-color: var(--secondary-color); color: var(--primary-color);">
                                        <i class="fa-solid fa-star me-1"></i>Most popular
                                    </span>
                                </div>
                            @endif
                            <div class="card-body p-4 p-lg-5 d-flex flex-column">
                                <div class="plan-feature-icon mb-3">
                                    <i class="fa-solid fa-boxes-stacked"></i>
                                </div>
                                <h3 class="h4 fw-bold mb-2">{{ $plan->name }}</h3>
                                <p class="text-muted mb-4">{{ $plan->description }}</p>

                                <div class="mb-4 pb-4 border-bottom">
                                    <span class="display-5 fw-bold" style="color: var(--primary-color);">
                                        {{ $plan->currency }} {{ number_format((float) $plan->price, 2) }}
                                    </span>
                                    <span class="text-muted">/ {{ str_replace('_', ' ', $plan->billing_period) }}</span>
                                </div>

                                <h4 class="small text-uppercase fw-bold text-muted mb-3">What's included</h4>
                                <ul class="list-unstyled mb-4">
                                    @foreach($plan->features ?? [] as $feature)
                                        <li class="d-flex gap-2 mb-3">
                                            <i class="fa-solid fa-circle-check mt-1" style="color: var(--secondary-color);"></i>
                                            <span>{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>

                                <a href="{{ route('contact') }}" class="btn {{ $plan->is_featured ? 'theme_btn' : 'btn-outline-primary' }} w-100 mt-auto py-2">
                                    Contact us about {{ $plan->name }}
                                    <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card border-0 shadow-sm text-center rounded-4">
                            <div class="card-body py-5">
                                <i class="fa-solid fa-tags fs-1 mb-3" style="color: var(--secondary-color);"></i>
                                <h2 class="h4">Plans are coming soon</h2>
                                <p class="text-muted mb-4">Contact our team to discuss a plan for your business.</p>
                                <a href="{{ route('contact') }}" class="btn theme_btn">Contact us</a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-5">
                <p class="text-muted mb-2">Need help choosing? Our team is happy to help.</p>
                <a href="{{ route('contact') }}" class="fw-semibold text-decoration-none" style="color: var(--primary-color);">
                    Contact ABYzone <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </section>
</main>

@include('include.footer')
