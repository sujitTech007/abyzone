<!DOCTYPE html>
<!-- saved from url=(0050)index.html -->
<html lang="en" data-sidenav-size="sm-hover-active" data-bs-theme="light" data-menu-color="light" data-topbar-color="brand">

<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABYzone - User Dashboard</title>
    <meta name="description" content="ABYzone User Dashboard">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet" type="text/css">
    
    <link href="{{ asset('assets/admin/css/toastr.min.css') }}" rel="stylesheet" type="text/css" id="app-style">
    <link href="{{ asset('assets/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style">
    <link href="{{ asset('assets/admin/css/custom.css') }}" rel="stylesheet" type="text/css">
</head>



<body>

    <!-- Begin page -->

    <div class="wrapper active">



{{-- Sidebar --}}
<aside class="sidenav-menu show">
    <a href="{{ route('user.dashboard') }}" class="logo">
        <span class="logo-light">
            <span class="logo-lg">
                <img src="{{ asset('assets/admin/images/logo.png') }}" alt="Abyzone" height="35">
            </span>
            <span class="logo-sm">
                <img src="{{ asset('assets/admin/images/logo.png') }}" alt="Abyzone" height="30">
            </span>
        </span>

        <span class="logo-dark">
            <span class="logo-lg">
                <img src="{{ asset('assets/admin/images/logo.png') }}" alt="Abyzone" height="35">
            </span>
            <span class="logo-sm">
                <img src="{{ asset('assets/admin/images/logo.png') }}" alt="Abyzone" height="30">
            </span>
        </span>
    </a>

    <button type="button" class="button-close-fullsidebar"
        aria-label="Close sidebar">
        <i class="fa-solid fa-xmark"></i>
    </button>

    <ul class="side-nav">
        @include('includes.logout-form')

        <li class="side-nav-title">MAIN MENU</li>

        <li class="side-nav-item">
            <a href="{{ route('user.dashboard') }}"
                class="side-nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <span class="menu-icon"><i class="fa-solid fa-gauge-high"></i></span>
                <span class="menu-text">Dashboard</span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="{{ route('user.warehouses.index') }}"
                class="side-nav-link {{ request()->routeIs('user.warehouses.index') ? 'active' : '' }}">
                <span class="menu-icon"><i class="fa-solid fa-warehouse"></i></span>
                <span class="menu-text">Find Warehouses</span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="{{ route('user.warehouses.requests') }}"
                class="side-nav-link {{ request()->routeIs('user.warehouses.requests') ? 'active' : '' }}">
                <span class="menu-icon"><i class="fa-solid fa-calendar-check"></i></span>
                <span class="menu-text">My Requests</span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="{{ route('user.orders') }}"
                class="side-nav-link {{ request()->routeIs('user.orders*') ? 'active' : '' }}">
                <span class="menu-icon"><i class="fa-solid fa-calendar-check"></i></span>
                <span class="menu-text">My Booking</span>
            </a>
        </li>

        <!-- <li class="side-nav-item">
            <a href="{{ route('user.wishlist') }}"
                class="side-nav-link {{ request()->routeIs('user.wishlist') ? 'active' : '' }}">
                <span class="menu-icon"><i class="fa-solid fa-heart"></i></span>
                <span class="menu-text">Wishlist</span>
            </a>
        </li> -->

        <li class="side-nav-title">ACCOUNT</li>

        <!-- <li class="side-nav-item">
            <a href="{{ route('user.support') }}"
                class="side-nav-link {{ request()->routeIs('user.support') ? 'active' : '' }}">
                <span class="menu-icon"><i class="fa-solid fa-headset"></i></span>
                <span class="menu-text">Support</span>
            </a>
        </li> -->

        <li class="side-nav-item">
            <a href="{{ route('user.reviews') }}"
                class="side-nav-link {{ request()->routeIs('user.reviews*') ? 'active' : '' }}">
                <span class="menu-icon"><i class="fa-solid fa-star"></i></span>
                <span class="menu-text">Reviews</span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="{{ route('user.notifications') }}"
                class="side-nav-link {{ request()->routeIs('user.notifications') ? 'active' : '' }}">
                <span class="menu-icon"><i class="fa-solid fa-bell"></i></span>
                <span class="menu-text">Notifications</span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="{{ route('user.profile') }}"
                class="side-nav-link {{ request()->routeIs('user.profile*') ? 'active' : '' }}">
                <span class="menu-icon"><i class="fa-solid fa-user"></i></span>
                <span class="menu-text">Profile</span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="{{ route('auth.logout') }}" class="side-nav-link"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="menu-icon"><i class="fa-solid fa-right-from-bracket"></i></span>
                <span class="menu-text">Log Out</span>
            </a>
        </li>
    </ul>
</aside>


{{-- Header --}}
<header class="app-topbar">
    <div class="page-container topbar-menu d-flex align-items-center justify-content-between">

        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('user.dashboard') }}" class="logo">
                <img src="{{ asset('assets/admin/images/logo.png') }}"
                    alt="Abyzone" height="50">
            </a>

            <button type="button" class="topnav-toggle-button btn px-2"
                data-bs-toggle="collapse" data-bs-target="#topnav-menu-content"
                aria-label="Toggle navigation">
                <i class="fa-solid fa-bars fs-5"></i>
            </button>
           
        </div>

        <div class="d-flex align-items-center gap-3">

            {{-- Notifications --}}
            @php
                $headerNotifications = \App\Models\Notification::where('user_id', auth()->id())
                    ->where('user_type', 'user')
                    ->where('is_read', 0)
                    ->latest()
                    ->limit(5)
                    ->get();

                $headerNotificationCount = \App\Models\Notification::where('user_id', auth()->id())
                    ->where('user_type', 'user')
                    ->where('is_read', 0)
                    ->count();
            @endphp

          
                <div class="dropdown">
                    <button type="button"
                        class="btn topbar-link position-relative"
                        id="notificationDropdown"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        aria-label="Notifications">

                        <i class="fa-regular fa-bell fs-5"></i>

                        @if($headerNotificationCount > 0)
                            <span class="noti-icon-badge">
                                {{ $headerNotificationCount > 99 ? '99+' : $headerNotificationCount }}
                            </span>
                        @endif
                    </button>

                    <div class="dropdown-menu dropdown-menu-end shadow border-0 p-0 ab-dropdown"
                        aria-labelledby="notificationDropdown">

                        <div class="d-flex align-items-center justify-content-between px-3 py-3 border-bottom">
                            <h6 class="mb-0 fw-bold">Notifications</h6>
                            <span class="badge bg-primary">
                                {{ $headerNotificationCount }} new
                            </span>
                        </div>

                        <div class="ab-notification-list">
                            @forelse($headerNotifications as $n)
                                <div class="dropdown-item py-3 border-bottom text-wrap"
                                    id="header-noti-{{ $n->id }}">

                                    <div class="d-flex align-items-start gap-2">
                                        <span class="ab-notification-icon">
                                            <i class="fa-solid fa-bell"></i>
                                        </span>

                                        <div class="text-wrap">
                                            <div class="fw-semibold">{{ $n->title }}</div>
                                            <small class="text-muted">Unread notification</small>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4 px-3">
                                    <i class="fa-regular fa-bell-slash fs-3 text-muted"></i>
                                    <p class="mb-0 mt-2 text-muted small">
                                        You're all caught up!
                                    </p>
                                </div>
                            @endforelse
                        </div>

                        <a href="{{ route('user.notifications') }}"
                            class="dropdown-item text-center py-3 fw-semibold border-top text-primary">
                            View all notifications
                            <i class="fa-solid fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>


            {{-- User Profile Dropdown --}}
            <div class="dropdown">
                <button type="button"
                    class="btn topbar-link d-flex align-items-center gap-2 p-0"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">

                    <span class="ab-user-avatar">
                        <i class="fa-solid fa-user"></i>
                    </span>

                    <span class="d-none d-md-flex flex-column text-start">
                        <span class="fw-semibold text-dark">
                            {{ auth()->user()->name }}
                        </span>
                        <small class="text-muted">Customer Account</small>
                    </span>

                    <i class="fa-solid fa-chevron-down small ms-1"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-end shadow border-0 ab-user-dropdown">
                    <div class="px-3 py-3 border-bottom">
                        <div class="fw-bold">{{ auth()->user()->name }}</div>
                        <small class="text-muted">{{ auth()->user()->email }}</small>
                    </div>

                    <a href="{{ route('user.profile') }}" class="dropdown-item py-2">
                        <i class="fa-regular fa-user me-2 text-primary"></i>
                        My Profile
                    </a>

                    <a href="{{ route('user.notifications') }}" class="dropdown-item py-2">
                        <i class="fa-regular fa-bell me-2 text-primary"></i>
                        Notifications
                    </a>

                    <div class="dropdown-divider"></div>

                    <a href="{{ route('auth.logout') }}"
                        class="dropdown-item py-2 text-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket me-2"></i>
                        Log Out
                    </a>
                </div>
            </div>

        </div>
    </div>
</header>




        