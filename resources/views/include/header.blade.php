<!DOCTYPE html>

<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>

    <meta charSet="utf-8" />

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.css') }}">

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="{{ asset('assets/images/qby-logo.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/css/aaa5c0f168402b6e.css') }}" data-precedence="next" />

    <link rel="stylesheet" href="{{ asset('assets/css/9793277900c9dac9.css') }}" data-precedence="next" />

    <link rel="stylesheet" href="{{ asset('assets/css/a9767450ca923300.css') }}" data-precedence="next" />

    <link rel="stylesheet" href="{{ asset('assets/css/74632f41d41e0b8d.css') }}" data-precedence="next" />

    <link rel="stylesheet" href="{{ asset('assets/css/724120c35b20b244.css') }}" data-precedence="next" />

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" data-precedence="next" />


    <script src="{{ asset('assets/main.js/4bd1b696-16029bbff0e3804c.js') }}" async=""></script>
    <script src="{{ asset('assets/main.js/517-47ff303fab14ebda.js') }}" async=""></script>

    <script src="{{ asset('assets/main.js/209-8898e30c50bf71bf.js') }}" async=""></script>

    <script src="{{ asset('assets/main.js/206-92691ffdb88e0357.js') }}" async=""></script>

    <script src="{{ asset('assets/main.js/301-41e567c285cdfdcb.js') }}" async=""></script>

    <script src="{{ asset('assets/main.js/188-5eeef9bc2bb7e99d.js') }}" async=""></script>

    <script src="{{ asset('assets/main.js/876-cf184394677fb9f1.js') }}" async=""></script>

    <script src="{{ asset('assets/main.js/159-b0143b32923895f8.js') }}" async=""></script>

    <script src="{{ asset('assets/main.js/43-77a193837de74252.js') }}" async=""></script>

    <script src="{{ asset('assets/main.js/466-af3424d16c27946b.js') }}" async=""></script>

    <script src="{{ asset('assets/app/page-901b5164f695dc82.js') }}" async=""></script>
    <meta name="description" content="abyzone" />
    <link rel="icon" href="{{ asset('assets/images/icon/favicon.png') }}" sizes="any" />

    <title>ABYzone</title>
    <script src="{{ asset('assets/main.js/polyfills-42372ed130431b0a.js') }}" noModule=""></script>

    <script>

        window.addEventListener('scroll', function () {

            const header = document.getElementById('sticky-header');

            if (window.scrollY > 100) {

                header.classList.add('is-sticky');

            } else {

                header.classList.remove('is-sticky');

            }

        });

    </script>



</head>



<body>

    <div class="theme-blue">

        <button class="scroll__top ultra-smooth-scroll" data-target="html">

            <i class="tg-flaticon-arrowhead-up"></i>

        </button>

        <header>

            <div id="header-fixed-height"></div>



            <div class="tg-header__top header-banner">

                <div class="container-fluid p-0">

                    <div class="row align-items-center">

                        <div class="col-xl-7">

                            <ul class="tg-header__top-info left-side list-wrap">

                               

                                <li><i class="flaticon-envelope"></i><a
                                        href="mailto:connect@abyzone.ca">connect@abyzone.ca</a></li>

                            </ul>

                        </div>

                        <div class="col-xl-5">

                            <div class="tg-header__top-right">



                                <div class="tg-header__top-social">

                                    <ul class="list-wrap">

                                        <li><a target="_blank" href="https://www.facebook.com/abyzone.ca" class="px-2">
                                                <i class="fab fa-facebook-f"></i></a>
                                        </li>

                                        <li><a target="_blank" href="https://www.instagram.com/abyzone.ca/"
                                                class="px-2">
                                                <i class="fab fa-instagram"></i></a>
                                        </li>

                                        <li><a target="_blank" href="https://www.linkedin.com/company/abyzone/"
                                                class="px-2">
                                                <i class="fab fa-linkedin"></i></a>
                                        </li>

                                    </ul>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div id="sticky-header" class="tg-header__area">

                <div class="container-fluid p-0">

                    <div class="row gx-0">

                        <div class="col-12">

                            <div class="tgmenu__wrap">

                                <div class="tgmenu__nav-left-side">

                                    <div class="offcanvas-toggle"></div>

                                    <div class="logo"><a href="{{ route('home') }}"><img alt="Logo" loading="lazy"
                                                decoding="async" data-nimg="1" style="color:transparent"
                                                src="{{ asset('assets/images/images/qby-logo.png') }}"></a></div>

                                </div>

                                <div class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-xl-flex">

                                    <ul class="navigation">

                                        <li class="{{ request()->routeIs('home') ? 'active' : '' }}">

                                            <a href="{{ route('home') }}">Home</a>

                                        </li>

                                        <li class="{{ request()->routeIs('about') ? 'active' : '' }}">

                                            <a href="{{ route('about') }}">About</a>

                                        </li>

                                        <li class="{{ request()->routeIs('services') ? 'active' : '' }}">

                                            <a href="{{ route('services') }}">Services</a>

                                        </li>

                                        <li class="{{ request()->routeIs('explore') ? 'active' : '' }}">

                                            <a href="{{ route('explore') }}">Explore</a>

                                        </li>

                                        <li class="{{ request()->routeIs('blog') ? 'active' : '' }}">

                                            <a href="{{ route('blog') }}">Blog</a>

                                        </li>

                                        <li class="{{ request()->routeIs('contact') ? 'active' : '' }}">

                                            <a href="{{ route('contact') }}">Contact</a>

                                        </li>

                                    </ul>

                                </div>

                                <div class="tgmenu__action d-none d-md-flex">

                                    <ul class="list-wrap d-flex align-items-center gap-3">

                                        @if(!Auth::check())

                                            <li class="header-btn">

                                                <a class="btn" href="{{ route('auth.register') }}">Sign Up</a>

                                            </li>

                                            <li class="header-btn">

                                                <a class="btn btn-outline-light" href="{{ route('auth.login') }}">Login</a>

                                            </li>

                                        @else

                                            <li class="header-btn">

                                                <a class="btn btn-outline-light"
                                                    href="{{ route('user.dashboard') }}">Dashboard</a>

                                            </li>

                                        @endif


                                        <form action="{{ route('explore') }}" method="GET">

                                            <div class="custom-search-box">

                                                <input type="text" name="search" value="{{ $query ?? '' }}"
                                                    placeholder="Find Warehouse" class="custom-search-input">

                                                <button type="submit" class="custom-search-icon"
                                                    style="border: 10px;width: 45px;height: 40px;border-radius: 10px;background: #faa31b;color: white;"><i
                                                        class="flaticon-search"></i></button>

                                            </div>

                                        </form>


                                    </ul>



                                </div>

                                <div class="mobile-nav-toggler"><i class="tg-flaticon-menu-1"></i></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="offCanvas__info ">

                <div class="offCanvas__close-icon menu-close"><button><i class="far fa-window-close"></i></button></div>

                <div class="offCanvas__logo mb-30"><a href="index.html"><img alt="Logo" loading="lazy" width="142"
                            height="40" decoding="async" data-nimg="1" style="color:transparent"
                            src="assets/images/images/qby-logo.png" /></a></div>

                <div class="">

                    <div class="tgmobile__menu">

                        <nav class="tgmobile__menu-box">

                            <div class="close-btn"><i class="tg-flaticon-close"></i></div>

                            <div class="nav-logo"><a href="index.html"><img alt="Logo" loading="lazy" width="142"
                                        height="40" decoding="async" data-nimg="1" style="color:transparent"
                                        src="assets/images/images/qby-logo.png" style="width: 150px;" /></a></div>

                            <div class="tgmobile__search">

                                <form><input type="text" placeholder="Search here..." /><button><i
                                            class="fas fa-search"></i></button></form>

                            </div>

                            <div class="tgmobile__menu-outer">





                            </div>

                            <div class="social-links">

                                <ul class="list-wrap">

                                    <li><a target="_blank" href="https://www.facebook.com/abyzone.ca"><i
                                        class="fab fa-facebook-f"></i></a></li>

                             <li><a target="_blank" href="https://www.linkedin.com/company/abyzone"><i
                                        class="fab fa-linkedin"></i></a></li> 



                            <li><a target="_blank" href="https://www.instagram.com/abyzone.ca/"><i
                                        class="fab fa-instagram"></i></a></li>



                                </ul>

                            </div>

                        </nav>

                    </div>

                    <div class="tgmobile__menu-backdrop"></div>

                </div>

                <div class="offCanvas__side-info mb-30">



                    <div class="my-mobile-nav">

                        <div class="tgmobile__search">

                            <form><input type="text" placeholder="Search here..." /><button><i
                                        class="fas fa-search"></i></button></form>

                        </div>



                        <ul class="my-mobile-menu">

                            <li class="my-has-children">

                                <a class="active" href="{{ route('home') }}">Home</a>

                            </li>



                            <li>

                                <a href="{{ route('about') }}">About</a>

                            </li>



                            <li class="my-has-children">

                                <a href="{{ route('services') }}">Services</a>



                            </li>



                            <li class="my-has-children">

                                <a href="{{ route('explore') }}">Explore</a>

                            </li>



                            <li class="my-has-children">

                                <a href="{{ route('blog') }}">Blog</a>

                            </li>



                            <li>

                                <a href="{{ route('contact') }}">Contact</a>

                            </li>

                        </ul>

                    </div>







                </div>

                <div class="offCanvas__social-icon mt-30"><a href="#"><i class="fab fa-facebook-f"></i></a><a
                        href="#"><i class="fab fa-twitter"></i></a><a href="#"><i
                            class="fab fa-google-plus-g"></i></a><a href="#"><i class="fab fa-instagram"></i></a></div>

            </div>

            <div class="offCanvas__overly "></div>

            <div class="search__popup">

                <div class="container">

                    <div class="row">

                        <div class="col-12">

                            <div class="search__wrapper">

                                <div class="search__close"><button type="button" class="search-close-btn"><svg
                                            width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">

                                            <path d="M17 1L1 17" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>

                                            <path d="M1 1L17 17" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>

                                        </svg></button></div>

                                <div class="search__form">

                                    <form>

                                        <div class="search__input"><input class="search-input-field" type="text"
                                                placeholder="Type keywords here" value="" /><span
                                                class="search-focus-border"></span><button><svg width="20" height="20"
                                                    viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">

                                                    <path
                                                        d="M9.55 18.1C14.272 18.1 18.1 14.272 18.1 9.55C18.1 4.82797 14.272 1 9.55 1C4.82797 1 1 4.82797 1 9.55C1 14.272 4.82797 18.1 9.55 18.1Z"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>

                                                    <path d="M19.0002 19.0002L17.2002 17.2002" stroke="currentcolor"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>

                                                </svg></button></div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="search-popup-overlay "></div>



        </header>



        <!-- Toast container -->

        <div id="toast-container" style="position:fixed;top:20px;right:20px;z-index:2000"></div>



        <script>

            (function () {

                function showToast(message, type) {

                    var container = document.getElementById('toast-container');

                    var toast = document.createElement('div');

                    toast.className = 'alert';

                    toast.style.minWidth = '200px';

                    toast.style.marginTop = '10px';

                    toast.style.opacity = '0.95';

                    if (type === 'success') toast.classList.add('alert-success');

                    else if (type === 'error') toast.classList.add('alert-danger');

                    else toast.classList.add('alert-info');

                    toast.innerText = message;

                    container.appendChild(toast);

                    setTimeout(function () { toast.remove(); }, 5000);

                }



                var flashes = {

                    success: "{{ session('success') ?? '' }}",

                    error: "{{ session('error') ?? '' }}",

                    info: "{{ session('info') ?? '' }}"

                };



                for (var k in flashes) {

                    if (flashes[k]) showToast(flashes[k], k);

                }

            })();

        </script>