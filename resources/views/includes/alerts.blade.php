@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            if (typeof toastr !== 'undefined') {
                toastr.success("{!! addslashes(session('success')) !!}");
            } else {
                alert("{!! addslashes(session('success')) !!}");
            }
        });
    </script>
@endif

@if (session('error'))
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            if (typeof toastr !== 'undefined') {
                toastr.error("{!! addslashes(session('error')) !!}");
            } else {
                alert("{!! addslashes(session('error')) !!}");
            }
        });
    </script>
@endif
