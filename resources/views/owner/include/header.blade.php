<!DOCTYPE html>
<!-- saved from url=(0050)index.html -->
<html lang="en" data-sidenav-size="sm-hover-active" data-bs-theme="light" data-menu-color="light"
    data-topbar-color="brand">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>ABYzone - Owner Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/admin/images/favicon.ico') }}">

    <!-- Vendor css -->
    <link href="{{ asset('assets/admin/css/vendor.min.css') }}" rel="stylesheet" type="text/css">

    <!-- App css -->
    <link href="{{ asset('assets/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style">

    <!-- Icons css -->
    <link href="{{ asset('assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/css/custom.css') }}" rel="stylesheet" type="text/css">
    <!-- Toastr css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Theme Config Js -->
    <script src="{{ asset('assets/admin/js/config.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>




<body>

    <!-- Begin page -->

    <div class="wrapper active">



        <!-- Menu -->

        <!-- Sidenav Menu Start -->

        <div class="sidenav-menu show">



            <!-- Brand Logo -->

            <a href="{{ route('owner.dashboard') }}" class="logo">

                <span class="logo-light">

                    <span class="logo-lg"><img src="assets/images/logo.png" alt="logo"></span>

                    <span class="logo-sm"><img src="assets/images/logo-sm.png" alt="small logo"></span>

                </span>



                <span class="logo-dark">

                    <span class="logo-lg"><img src="assets/images/logo-dark.png" alt="dark logo"></span>

                    <span class="logo-sm"><img src="assets/images/logo-sm.png" alt="small logo"></span>

                </span>

            </a>



            <!-- Full Sidebar Menu Close Button -->

            <button class="button-close-fullsidebar">

                <i class="ri-close-line align-middle"></i>

            </button>



            <div data-simplebar="init" class="simplebar-scrollable-y">

                <div class="simplebar-wrapper active" style="margin: 0px;">

                    <div class="simplebar-height-auto-observer-wrapper">

                        <div class="simplebar-height-auto-observer"></div>

                    </div>

                    <div class="simplebar-mask sidebarNavbar show">

                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">

                            <div class="simplebar-content-wrapper active" tabindex="0" role="region"

                                aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">

                                <div class="simplebar-content show" style="padding: 0px;">



                                    <!--- Sidenav Menu -->

                <ul class="side-nav">
                    @include('includes.logout-form')

                    <li class="side-nav-title">Navigation</li>



                    <li class="side-nav-item {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('owner.dashboard') }}" class="side-nav-link {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}">
                            <span class="menu-icon"><i class="ri-dashboard-line"></i></span>
                            <span class="menu-text"> Dashboard </span>
                        </a>
                    </li>



                    <li class="side-nav-title">Manage</li>



                    

                    <!-- <li class="side-nav-item {{ request()->routeIs('owner.services.*') ? 'active' : '' }}">
                        <a href="{{ route('owner.services.index') }}" class="side-nav-link {{ request()->routeIs('owner.services.*') ? 'active' : '' }}">
                            <span class="menu-icon"><i class="ri-tools-line"></i></span>
                            <span class="menu-text"> Services </span>
                        </a>
                    </li> -->

                    <li class="side-nav-item {{ request()->routeIs('owner.warehouses.*') ? 'active' : '' }}">
                        <a href="{{ route('owner.warehouses.index') }}" class="side-nav-link {{ request()->routeIs('owner.warehouses.*') ? 'active' : '' }}">
                            <span class="menu-icon"><i class="ri-building-2-fill"></i></span>
                            <span class="menu-text"> Warehouses </span>
                        </a>
                    </li>

                    <li class="side-nav-item {{ request()->routeIs('owner.warehouse-bookings.*') ? 'active' : '' }}">
                        <a href="{{ route('owner.warehouse-bookings.index') }}" class="side-nav-link {{ request()->routeIs('owner.warehouse-bookings.*') ? 'active' : '' }}">
                            <span class="menu-icon"><i class="ri-calendar-check-line"></i></span>
                            <span class="menu-text"> Booking Requests </span>
                        </a>
                    </li>

                    <li class="side-nav-item {{ request()->routeIs('owner.business.profile*') ? 'active' : '' }}">
                        <a href="{{ route('owner.business.profile') }}" class="side-nav-link {{ request()->routeIs('owner.business.profile*') ? 'active' : '' }}">
                            <span class="menu-icon"><i class="ri-account-pin-box-line"></i></span>
                            <span class="menu-text"> Business Profile </span>
                        </a>
                    </li>

                    <li class="side-nav-item {{ request()->routeIs('owner.payments*') ? 'active' : '' }}">
                        <a href="{{ route('owner.payments') }}" class="side-nav-link {{ request()->routeIs('owner.payments*') ? 'active' : '' }}">
                            <span class="menu-icon"><i class="ri-exchange-dollar-line"></i></span>
                            <span class="menu-text"> Payments </span>
                        </a>
                    </li>

                    <li class="side-nav-item {{ request()->routeIs('owner.notifications') ? 'active' : '' }}">
                       <a href="{{ route('owner.notifications') }}" class="side-nav-link {{ request()->routeIs('owner.notifications') ? 'active' : '' }}">
                           <span class="menu-icon"><i class="ri-notification-3-line"></i></span>
                           <span class="menu-text"> Notifications </span>
                       </a>
                   </li> 
                    
                    <li class="side-nav-item">
                        <a href="{{ route('auth.logout') }}" class="side-nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                            <span class="menu-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="share" class="lucide lucide-share"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path><polyline points="16 6 12 2 8 6"></polyline><line x1="12" x2="12" y1="2" y2="15"></line></svg></span>

                            <span class="menu-text"> Log Out </span>

                        </a>

                    </li>                   

                </ul>



                                    <div class="clearfix"></div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="simplebar-placeholder" style="width: 240px; height: 826px;"></div>

                </div>

                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">

                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>

                </div>

                <div class="simplebar-track simplebar-vertical" style="visibility: visible;">

                    <div class="simplebar-scrollbar"

                        style="height: 527px; transform: translate3d(0px, 0px, 0px); display: block;"></div>

                </div>

            </div>

        </div>

        <!-- Sidenav Menu End -->



        <!-- Topbar Start -->

        <header class="app-topbar">

            <div class="page-container topbar-menu">

                <div class="d-flex align-items-center gap-2">



                    <!-- Brand Logo -->

                    <a href="{{ route('owner.dashboard') }}" class="logo">

                        <span class="logo-light">

                            <span class="logo-lg"><img src="{{ asset('assets/admin/images/logo.png') }}" alt="logo"></span>

                            <span class="logo-sm"><img src="{{ asset('assets/admin/images/logo-sm.png') }}" alt="small logo"></span>

                        </span>



                        <span class="logo-dark">

                            <span class="logo-lg"><img src="{{ asset('assets/admin/images/logo-dark.png') }}" alt="dark logo"></span>

                            <span class="logo-sm"><img src="{{ asset('assets/admin/images/logo-sm.png') }}" alt="small logo"></span>

                        </span>

                    </a>



                    <!-- Sidebar Menu Toggle Button -->

                    <button class="sidenav-toggle-button px-2">

                        <i class="ri-menu-2-line fs-24"></i>

                    </button>



                    <!-- Horizontal Menu Toggle Button -->

                    <button class="topnav-toggle-button px-2" data-bs-toggle="collapse"

                        data-bs-target="#topnav-menu-content">

                        <i class="ri-menu-2-line fs-24"></i>

                    </button>



                    <!-- Search for small devices -->

                    <div class="topbar-item d-flex d-xl-none">

                        <button class="topbar-link" data-bs-toggle="modal" data-bs-target="#searchModal" type="button">

                            <i class="ri-search-line fs-22"></i>

                        </button>

                    </div>



                    <!-- Button Trigger Search Modal -->

                   

                </div>



                <div class="d-flex align-items-center gap-2">







                    <!-- Language Dropdown -->





                    <!-- Notification Dropdown -->

                    @php
                    use App\Models\Notification;

                    $headerNotifications = Notification::where('user_id', auth()->id())->where('user_type', 'owner')->where('is_read', 0)
                    ->latest()
                    ->limit(5)
                    ->get();

                    $headerNotificationCount = Notification::where('user_id', auth()->id())->where('user_type', 'owner')->where('is_read', 0)->count();
                    @endphp


                    <!-- Notification Dropdown -->
                    <div class="topbar-item position-relative">
                        <div class="dropdown">
                            <button class="topbar-link dropdown-toggle drop-arrow-none text-dark fs-3"
                                data-bs-toggle="dropdown" data-bs-offset="0,25"
                                type="button" data-bs-auto-close="outside">

                                <i class="ri-notification-4-line"></i>

                                @if($headerNotificationCount > 0)
                                <span class="noti-icon-badge">
                                    {{ $headerNotificationCount }}
                                </span>
                                @endif
                            </button>

                            <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg"
                                style="min-height:300px;">

                                <div class="p-2 border-bottom border-dashed">
                                    <h6 class="m-0 fs-16 fw-semibold text-dark">Notifications</h6>
                                </div>

                                <div style="max-height:240px;overflow-y:auto;">
                                    @forelse($headerNotifications as $n)
                                    <div class="dropdown-item d-flex gap-2 align-items-start"
                                        id="header-noti-{{ $n->id }}">

                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 fs-14">{{ $n->title }}</h6>
                                        </div>


                                    </div>
                                    @empty
                                    <div class="dropdown-item text-center text-muted py-4">
                                        No new notifications 🎉
                                    </div>
                                    @endforelse
                                </div>

                                <a href="{{ route('owner.notifications') }}"
                                    class="dropdown-item text-center fw-bold border-top py-2">
                                    View All
                                </a>
                            </div>
                        </div>
                    </div>










                    <!-- User Dropdown -->

                    <div class="topbar-item nav-user">

                        <div class="dropdown">

                            <a class="topbar-link dropdown-toggle drop-arrow-none px-2 text-dark"

                                data-bs-toggle="dropdown" data-bs-offset="0,25" type="button" aria-haspopup="false"

                                aria-expanded="false">

                                <i class="bi bi-person-circle" style="font-size:32px; margin-right: 10px;"></i>

                                <span class="d-lg-flex flex-column gap-1 d-none">

                                    <span class="fw-semibold">{{ auth()->user()->name }}</span>

                                </span>

                                <i class="ri-arrow-down-s-line d-none d-lg-block align-middle ms-2"></i>

                            </a>

                            <div class="dropdown-menu dropdown-menu-end">

                                <!-- item-->

                                <div class="dropdown-header noti-title">

                                    <h6 class="text-overflow m-0">Welcome !</h6>

                                </div>



                                <!-- item-->

                                <a href="{{ route('owner.business.profile') }}" class="dropdown-item">

                                    <i class="ri-account-circle-line me-1 fs-16 align-middle"></i>

                                    <span class="align-middle">Profile</span>

                                </a>

                                <div class="dropdown-divider"></div>
                                <a href="{{ route('auth.logout') }}" class="dropdown-item fw-semibold text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                                    <i class="ri-logout-box-line me-1 fs-16 align-middle"></i>

                                    <span class="align-middle">Log Out</span>

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </header>

        <!-- Topbar End -->



        <!-- Search Modal -->

        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-lg">

                <div class="modal-content bg-transparent">

                    <form>

                        <div class="card mb-1">

                            <div class="px-3 py-2 d-flex flex-row align-items-center" id="top-search">

                                <i class="ri-search-line fs-22"></i>

                                <input type="search" class="form-control border-0" id="search-modal-input"

                                    placeholder="Search for actions, people,">

                                <button type="submit" class="btn p-0" data-bs-dismiss="modal" aria-label="Close"><i

                                        class="ri-close-line"></i></button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>





