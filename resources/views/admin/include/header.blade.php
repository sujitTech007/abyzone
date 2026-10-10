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
<aside class="sidenav-menu show">

    {{-- Logo --}}
    <a href="{{ route('admin.dashboard') }}" class="logo">
        <span class="logo-light">
            <span class="logo-lg">
                <img src="{{ asset('assets/admin/images/logo.png') }}"
                     alt="Abyzone" height="35">
            </span>
            <span class="logo-sm">
                <img src="{{ asset('assets/admin/images/logo.png') }}"
                     alt="Abyzone" height="30">
            </span>
        </span>

        <span class="logo-dark">
            <span class="logo-lg">
                <img src="{{ asset('assets/admin/images/logo.png') }}"
                     alt="Abyzone" height="35">
            </span>
            <span class="logo-sm">
                <img src="{{ asset('assets/admin/images/logo.png') }}"
                     alt="Abyzone" height="30">
            </span>
        </span>
    </a>

    {{-- Close Sidebar --}}
    <button type="button"
        class="button-close-fullsidebar"
        aria-label="Close sidebar">
        <i class="fa-solid fa-xmark"></i>
    </button>

    <ul class="side-nav">

        @include('includes.logout-form')

        <li class="side-nav-title">MAIN MENU</li>

        {{-- Dashboard --}}
        <li class="side-nav-item">
            <a href="{{ route('admin.dashboard') }}"
               class="side-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-solid fa-gauge-high"></i>
                </span>
                <span class="menu-text">Dashboard</span>
            </a>
        </li>

        {{-- Users --}}
        <li class="side-nav-item">
            <a href="{{ route('admin.users') }}"
               class="side-nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-solid fa-users"></i>
                </span>
                <span class="menu-text">Users</span>
            </a>
        </li>

        {{-- Warehouses --}}
        <li class="side-nav-item">
            <a href="{{ route('admin.warehouses') }}"
               class="side-nav-link {{ request()->routeIs('admin.warehouses*') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-solid fa-warehouse"></i>
                </span>
                <span class="menu-text">Warehouses</span>
            </a>
        </li>

        {{-- Warehouse Bookings --}}
        <li class="side-nav-item">
            <a href="{{ route('admin.warehouse-bookings.index') }}"
               class="side-nav-link {{ request()->routeIs('admin.warehouse-bookings.*') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-solid fa-calendar-check"></i>
                </span>
                <span class="menu-text">Warehouse Bookings</span>
            </a>
        </li>

        {{-- Blogs --}}
        <li class="side-nav-item">
            <a href="{{ route('admin.blog') }}"
               class="side-nav-link {{ request()->routeIs('admin.blog*') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-solid fa-newspaper"></i>
                </span>
                <span class="menu-text">Blogs</span>
            </a>
        </li>

        {{-- Service Categories --}}
        <li class="side-nav-item">
            <a href="{{ route('admin.category') }}"
               class="side-nav-link {{ request()->routeIs('admin.category*') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-solid fa-layer-group"></i>
                </span>
                <span class="menu-text">Service Categories</span>
            </a>
        </li>

        {{-- Services --}}
        <li class="side-nav-item">
            <a href="{{ route('admin.services') }}"
               class="side-nav-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-solid fa-file-lines"></i>
                </span>
                <span class="menu-text">Services</span>
            </a>
        </li>

        {{-- Inquiries --}}
        <li class="side-nav-item">
            <a href="{{ route('admin.inquiry') }}"
               class="side-nav-link {{ request()->routeIs('admin.inquiry*') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </span>
                <span class="menu-text">Inquiries</span>
            </a>
        </li>

        {{-- Quote Requests --}}
        <li class="side-nav-item">
            <a href="{{ route('admin.quote.request') }}"
               class="side-nav-link {{ request()->routeIs('admin.quote.request*') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-solid fa-file-invoice"></i>
                </span>
                <span class="menu-text">Quote Requests</span>
            </a>
        </li>

        {{-- Meeting Requests --}}
        <li class="side-nav-item">
            <a href="{{ route('admin.meeting.request') }}"
               class="side-nav-link {{ request()->routeIs('admin.meeting.request*') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-solid fa-handshake"></i>
                </span>
                <span class="menu-text">Meeting Requests</span>
            </a>
        </li>

        {{-- Subscribers --}}
        <li class="side-nav-item">
            <a href="{{ route('admin.subscribe') }}"
               class="side-nav-link {{ request()->routeIs('admin.subscribe*') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-solid fa-user-plus"></i>
                </span>
                <span class="menu-text">Subscribers</span>
            </a>
        </li>

        {{-- Notifications --}}
        <li class="side-nav-item">
            <a href="{{ route('admin.notification') }}"
               class="side-nav-link {{ request()->routeIs('admin.notification*') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-solid fa-bell"></i>
                </span>
                <span class="menu-text">Notifications</span>
            </a>
        </li>

        <li class="side-nav-title">ACCOUNT</li>

        {{-- Settings --}}
        <li class="side-nav-item">
            <a href="{{ route('admin.settings') }}"
               class="side-nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-solid fa-gear"></i>
                </span>
                <span class="menu-text">Settings</span>
            </a>
        </li>

        {{-- Logout --}}
        <li class="side-nav-item">
            <a href="{{ route('auth.logout') }}"
               class="side-nav-link"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="menu-icon">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </span>
                <span class="menu-text">Log Out</span>
            </a>
        </li>

    </ul>
</aside>

        {{-- Admin Header --}}
<header class="app-topbar">
    <div class="page-container topbar-menu d-flex align-items-center justify-content-between">

        {{-- Logo & Navigation --}}
        <div class="d-flex align-items-center gap-2">

            <a href="{{ route('admin.dashboard') }}" class="logo">
                <span class="logo-light">
                    <span class="logo-lg">
                        <img src="{{ asset('assets/admin/images/logo.png') }}"
                             alt="Abyzone" height="50">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('assets/admin/images/logo-sm.png') }}"
                             alt="Abyzone" height="30">
                    </span>
                </span>

                <span class="logo-dark">
                    <span class="logo-lg">
                        <img src="{{ asset('assets/admin/images/logo.png') }}"
                             alt="Abyzone" height="50">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('assets/admin/images/logo-sm.png') }}"
                             alt="Abyzone" height="30">
                    </span>
                </span>
            </a>

            {{-- Sidebar Toggle --}}
            <button type="button"
                class="sidenav-toggle-button btn px-2"
                aria-label="Toggle sidebar">
                <i class="fa-solid fa-bars fs-5"></i>
            </button>

            {{-- Top Navigation Toggle --}}
            <button type="button"
                class="topnav-toggle-button btn px-2"
                data-bs-toggle="collapse"
                data-bs-target="#topnav-menu-content"
                aria-label="Toggle navigation">
                <i class="fa-solid fa-bars fs-5"></i>
            </button>

            {{-- Search Modal Trigger --}}
            <div class="topbar-item d-flex d-xl-none">
                <button type="button"
                    class="btn topbar-link"
                    data-bs-toggle="modal"
                    data-bs-target="#searchModal"
                    aria-label="Search">
                    <i class="fa-solid fa-magnifying-glass fs-5"></i>
                </button>
            </div>

        </div>

        {{-- Right Side --}}
        <div class="d-flex align-items-center gap-3">

            {{-- Admin Notifications --}}
            @php
                $headerNotifications = \App\Models\Notification::where('is_read', 0)
                    ->latest()
                    ->limit(5)
                    ->get();

                $headerNotificationCount = \App\Models\Notification::where('is_read', 0)
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
                                        <div class="fw-semibold">
                                            {{ $n->title }}
                                        </div>
                                        <small class="text-muted">
                                            Unread notification
                                        </small>
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

                    <a href="{{ route('admin.notification') }}"
                        class="dropdown-item text-center py-3 fw-semibold border-top text-primary">
                        View all notifications
                        <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>

                </div>
            </div>

            {{-- Admin Profile Dropdown --}}
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
                        <small class="text-muted">Administrator</small>
                    </span>

                    <i class="fa-solid fa-chevron-down small ms-1"></i>

                </button>

                <div class="dropdown-menu dropdown-menu-end shadow border-0 ab-user-dropdown">

                    <div class="px-3 py-3 border-bottom">
                        <div class="fw-bold">
                            {{ auth()->user()->name }}
                        </div>
                        <small class="text-muted">
                            {{ auth()->user()->email }}
                        </small>
                    </div>

                    {{-- Admin Settings / Profile --}}
                    <a href="{{ route('admin.settings') }}"
                        class="dropdown-item py-2">
                        <i class="fa-solid fa-gear me-2 text-primary"></i>
                        Settings / Profile
                    </a>

                    {{-- Admin Notifications --}}
                    <a href="{{ route('admin.notification') }}"
                        class="dropdown-item py-2">
                        <i class="fa-regular fa-bell me-2 text-primary"></i>
                        Notifications
                    </a>

                    <div class="dropdown-divider"></div>

                    {{-- Logout --}}
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

{{-- Search Modal --}}
<div class="modal fade" id="searchModal"
    tabindex="-1"
    aria-labelledby="searchModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-transparent">

            <form action="#" method="GET"
                onsubmit="return false;">

                <div class="card mb-1">
                    <div class="px-3 py-2 d-flex flex-row align-items-center"
                        id="top-search">

                        <i class="fa-solid fa-magnifying-glass fs-5"></i>

                        <input type="search"
                            class="form-control border-0"
                            id="search-modal-input"
                            placeholder="Search for actions, people...">

                        <button type="button"
                            class="btn p-0"
                            data-bs-dismiss="modal"
                            aria-label="Close">

                            <i class="fa-solid fa-xmark"></i>

                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

        {{-- Logout form include (hidden) --}}
        @include('includes.logout-form')