<!DOCTYPE html>
<html lang="en" data-sidenav-size="sm-hover-active" data-bs-theme="light" data-menu-color="light" data-topbar-color="brand">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ABYzone - Channel Partner Dashboard</title>
    <meta name="description" content="ABYzone Channel Partner Dashboard">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/app.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/custom.css') }}" rel="stylesheet">
</head>
<body>
<div class="wrapper active">
    <aside class="sidenav-menu show">
        <a href="{{ route('channel-partner.dashboard') }}" class="logo">
            <span class="logo-light">
                <span class="logo-lg"><img src="{{ asset('assets/admin/images/logo.png') }}" alt="ABYzone" height="35"></span>
                <span class="logo-sm"><img src="{{ asset('assets/admin/images/logo.png') }}" alt="ABYzone" height="30"></span>
            </span>
            <span class="logo-dark">
                <span class="logo-lg"><img src="{{ asset('assets/admin/images/logo.png') }}" alt="ABYzone" height="35"></span>
                <span class="logo-sm"><img src="{{ asset('assets/admin/images/logo.png') }}" alt="ABYzone" height="30"></span>
            </span>
        </a>

        <button type="button" class="button-close-fullsidebar" aria-label="Close sidebar">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <ul class="side-nav">
            @include('includes.logout-form')
            <li class="side-nav-title">MAIN MENU</li>
            <li class="side-nav-item">
                <a href="{{ route('channel-partner.dashboard') }}" class="side-nav-link {{ request()->routeIs('channel-partner.dashboard') ? 'active' : '' }}">
                    <span class="menu-icon"><i class="fa-solid fa-gauge-high"></i></span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('channel-partner.opportunities.index') }}" class="side-nav-link {{ request()->routeIs('channel-partner.opportunities.*') ? 'active' : '' }}">
                    <span class="menu-icon"><i class="fa-solid fa-briefcase"></i></span>
                    <span class="menu-text">Service Opportunities</span>
                </a>
            </li>
            <li class="side-nav-title">ACCOUNT</li>
            <li class="side-nav-item">
                <a href="{{ route('channel-partner.profile') }}" class="side-nav-link {{ request()->routeIs('channel-partner.profile*') ? 'active' : '' }}">
                    <span class="menu-icon"><i class="fa-solid fa-user"></i></span>
                    <span class="menu-text">Service Profile</span>
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

    <header class="app-topbar">
        <div class="page-container topbar-menu d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('channel-partner.dashboard') }}" class="logo">
                    <img src="{{ asset('assets/admin/images/logo.png') }}" alt="ABYzone" height="50">
                </a>
                <button type="button" class="topnav-toggle-button btn px-2"
                        data-bs-toggle="collapse" data-bs-target="#topnav-menu-content"
                        aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars fs-5"></i>
                </button>
            </div>

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

            <div class="d-flex align-items-center gap-3">
                <div class="dropdown">
                    <button type="button" class="btn topbar-link position-relative" id="notificationDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false" aria-label="Notifications">
                        <i class="fa-regular fa-bell fs-5"></i>
                        @if($headerNotificationCount > 0)
                            <span class="noti-icon-badge">{{ $headerNotificationCount > 99 ? '99+' : $headerNotificationCount }}</span>
                        @endif
                    </button>
                    <div class="dropdown-menu dropdown-menu-end shadow border-0 p-0 ab-dropdown" aria-labelledby="notificationDropdown">
                        <div class="d-flex align-items-center justify-content-between px-3 py-3 border-bottom">
                            <h6 class="mb-0 fw-bold">Notifications</h6>
                            <span class="badge bg-primary">{{ $headerNotificationCount }} new</span>
                        </div>
                        <div class="ab-notification-list">
                            @forelse($headerNotifications as $notification)
                                <div class="dropdown-item py-3 border-bottom text-wrap">
                                    <div class="d-flex align-items-start gap-2">
                                        <span class="ab-notification-icon"><i class="fa-solid fa-bell"></i></span>
                                        <div class="text-wrap">
                                            <div class="fw-semibold">{{ $notification->title }}</div>
                                            <small class="text-muted">Unread notification</small>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4 px-3">
                                    <i class="fa-regular fa-bell-slash fs-3 text-muted"></i>
                                    <p class="mb-0 mt-2 text-muted small">You're all caught up!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="dropdown">
                    <button type="button" class="btn topbar-link d-flex align-items-center gap-2 p-0"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="ab-user-avatar"><i class="fa-solid fa-user"></i></span>
                        <span class="d-none d-md-flex flex-column text-start">
                            <span class="fw-semibold text-dark">{{ auth()->user()->name }}</span>
                            <small class="text-muted">Channel Partner Account</small>
                        </span>
                        <i class="fa-solid fa-chevron-down small ms-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end shadow border-0 ab-user-dropdown">
                        <div class="px-3 py-3 border-bottom">
                            <div class="fw-bold">{{ auth()->user()->name }}</div>
                            <small class="text-muted">{{ auth()->user()->email }}</small>
                        </div>
                        <a href="{{ route('channel-partner.profile') }}" class="dropdown-item py-2">
                            <i class="fa-regular fa-user me-2 text-primary"></i>Service Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('auth.logout') }}" class="dropdown-item py-2 text-danger"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-right-from-bracket me-2"></i>Log Out
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
