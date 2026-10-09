<!DOCTYPE html>

<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>

<title>ABYzone | AI-Powered Warehousing & Fulfillment Solutions</title>
<meta name="description" content="ABYzone provides AI-powered warehousing, flexible storage, fulfillment, and warehouse locator solutions for small and medium businesses across Canada and North America.">
<meta name="keywords" content="ABYzone, warehousing, warehouse solutions, AI warehouse, warehouse locator, storage solutions, fulfillment, logistics, Canada">
<meta name="author" content="ABYzone">
<meta name="robots" content="noindex, nofollow">

<link rel="canonical" href="{{ url('/') }}">

<!-- Favicon -->
<link rel="icon" href="{{ asset('assets/images/icon/favicon.png') }}" type="image/png">
<link rel="apple-touch-icon" href="{{ asset('assets/images/icon/favicon.png') }}">

<!-- Theme Color -->
<meta name="theme-color" content="#ffffff">
<!-- Preconnect -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<!-- CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>



<body>

  <header>

    <!-- Top Strip -->
    <div class="header-top text-white">
        <div class="container px-3 px-lg-4">
            <div class="d-flex justify-content-between align-items-center py-2 small">

                <div class="d-flex gap-3">
                    <span class="d-none d-md-block fs-11">
                    Canada's Trusted Warehouse Logistics Platform
                </span>

                <a href="mailto:connect@abyzone.ca"
                   class="text-white text-decoration-none fs-11">
                    <i class="fa-solid fa-envelope me-1"></i>
                    connect@abyzone.ca
                </a>
                </div>

                <div class="d-flex gap-3">
                    <a href="https://www.facebook.com/abyzone.ca"
                       target="_blank"
                       class="text-white">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>

                    <a href="https://www.instagram.com/abyzone.ca/"
                       target="_blank"
                       class="text-white">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                    <a href="https://www.linkedin.com/company/abyzone/"
                       target="_blank"
                       class="text-white">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>


    <!-- ================= ONE NAVBAR ================= -->
    <nav class="navbar navbar-expand-xl bg-white shadow-sm sticky-top">

        <div class="container px-3 px-lg-4">

            <!-- Logo -->
            <a class="navbar-brand p-0" href="{{ route('home') }}">
                <img src="{{ asset('assets/images/abyzone-logo.png') }}"
                     alt="ABYzone"
                     height="60">
            </a>


            <!-- Mobile Menu Button -->
            <button class="navbar-toggler border-0 shadow-none"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#mainNavbar"
                    aria-controls="mainNavbar"
                    aria-expanded="false"
                    aria-label="Toggle navigation">

                <i class="fa-solid fa-bars fa-lg"></i>

            </button>


            <!-- ONE MENU ONLY -->
            <div class="collapse navbar-collapse" id="mainNavbar">

                <!-- Navigation -->
                <ul class="navbar-nav mx-auto align-items-xl-center">

                    <li class="nav-item">
                        <a class="nav-link px-3 {{ request()->routeIs('home') ? 'active' : '' }}"
                           href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link px-3 {{ request()->routeIs('about') ? 'active' : '' }}"
                           href="{{ route('about') }}">
                            About
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link px-3 {{ request()->routeIs('services') ? 'active' : '' }}"
                           href="{{ route('services') }}">
                            Services
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link px-3 {{ request()->routeIs('explore') ? 'active' : '' }}"
                           href="{{ route('explore') }}">
                            Explore
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link px-3 {{ request()->routeIs('blog') ? 'active' : '' }}"
                           href="{{ route('blog') }}">
                            Blog
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link px-3 {{ request()->routeIs('contact') ? 'active' : '' }}"
                           href="{{ route('contact') }}">
                            Contact
                        </a>
                    </li>

                </ul>


                <!-- RIGHT SIDE -->
                <div class="d-flex align-items-center gap-2 mt-3 mt-xl-0">

                    
                    <!-- <button type="button"
                            class="btn btn-link text-dark text-decoration-none fs-5"
                            data-bs-toggle="modal"
                            data-bs-target="#searchModal"
                            aria-label="Search">

                        <i class="fa-solid fa-magnifying-glass"></i>

                    </button> -->

                    <div class="header_btn">
                        
                        @if(Auth::check())

                            <a href="{{ route('user.dashboard') }}"
                            class="btn secondary-text-color  rounded-pill px-3 text-nowrap">
                                <i class="fa-regular fa-user me-1"></i>
                                Dashboard
                            </a>

                        @else

                            <!-- Login -->
                            <a href="{{ route('auth.login') }}"
                            class="btn btn-link text-dark text-decoration-none text-nowrap">
                                <i class="fa-regular fa-user me-1"></i>
                                Login
                            </a>

                            <!-- Get Started -->
                            <a href="{{ route('auth.register') }}"
                            class="btn theme_btn">
                                Get Started
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>

                        @endif
                    </div>


                    <div class="signup-link d-none">

                        Need to create an account?

                        <a href="{{ route('auth.register') }}">
                            Sign up
                        </a>

                    </div>
                     <div class="login-link d-none">

                            Already have an account?

                            <a href="{{ route('auth.login') }}">
                                Sign in
                            </a>

                        </div>

                </div>

            </div>

        </div>

    </nav>

</header>

<!-- ================= SEARCH MODAL ================= -->

<div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-fullscreen">

        <div class="modal-content bg-white">

            <!-- Close -->
            <div class="container-fluid px-3 px-lg-5">

                <div class="d-flex justify-content-between align-items-center py-4 border-bottom">

                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/images//qby-logo.png') }}" alt="ABYzone" height="42">
                    </a>

                    <button type="button" class="btn btn-light rounded-circle" data-bs-dismiss="modal"
                        aria-label="Close">

                        <i class="fa-solid fa-xmark fs-4"></i>

                    </button>

                </div>


                <!-- Search Area -->
                <div class="row justify-content-center">

                    <div class="col-12 col-lg-8">

                        <div class="text-center mt-5 pt-lg-5">

                            <h2 class="fw-bold mb-2">
                                Find Your Warehouse
                            </h2>

                            <p class="text-muted mb-4">
                                Search warehouses by name, city or location
                            </p>


                            <!-- Search Form -->
                            <form action="{{ route('explore') }}" method="GET" id="searchForm">

                                <div class="input-group input-group-lg">

                                    <input type="text" name="search" id="popupWarehouseSearch" class="form-control"
                                        placeholder="Search warehouse..." autocomplete="off" autofocus>

                                    <button type="submit" class="btn theme_btn px-4">

                                        <i class="fa-solid fa-magnifying-glass"></i>

                                    </button>

                                </div>

                            </form>


                            <!-- Dynamic Results -->
                            <div id="popupSearchResults" class="text-start mt-2">
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('popupWarehouseSearch');
    const resultsBox = document.getElementById('popupSearchResults');

    if (!searchInput || !resultsBox) return;

    let searchTimer;


    searchInput.addEventListener('input', function () {

        clearTimeout(searchTimer);

        const keyword = this.value.trim();

        if (keyword.length < 2) {

            resultsBox.innerHTML = '';

            return;
        }


        // 

    });


    // Clear search when modal closes
    document.getElementById('searchModal')
        .addEventListener('hidden.bs.modal', function () {

            searchInput.value = '';
            resultsBox.innerHTML = '';

        });

});
</script>
