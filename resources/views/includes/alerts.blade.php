@once
    <link rel="stylesheet" href="{{ asset('assets/css/flash-toasts.css') }}">
    <script src="{{ asset('assets/js/flash-toasts.js') }}"></script>
@endonce

@if ($errors->any() || session()->has('success') || session()->has('error') || session()->has('warning') || session()->has('info'))
    <script>
        @foreach ($errors->all() as $error)
            window.showAppToast('error', @json($error));
        @endforeach

        @if (session()->has('success'))
            window.showAppToast('success', @json(session('success')));
        @endif

        @if (session()->has('error'))
            window.showAppToast('error', @json(session('error')));
        @endif

        @if (session()->has('warning'))
            window.showAppToast('warning', @json(session('warning')));
        @endif

        @if (session()->has('info'))
            window.showAppToast('info', @json(session('info')));
        @endif
    </script>
@endif
