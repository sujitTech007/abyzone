<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'AbyZone'))</title>

    <!-- Bootstrap CSS (CDN) -->
     <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
          <link rel="stylesheet" href="{{ asset('assets/css/reset.css') }}">

    @stack('head')
</head>
<body>


    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>

<!-- Bootstrap JS (CDN) -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
@stack('scripts')
</body>
</html>