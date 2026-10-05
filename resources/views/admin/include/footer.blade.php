
    <!-- Vendor js -->
    <script src="{{ asset('assets/admin/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/admin/js/app.js') }}"></script>

    <!-- Apex Chart js -->
    <script src="{{ asset('assets/admin/js/apexcharts.min.js') }}"></script>

    <!-- Projects Analytics Dashboard App js -->
    <script src="{{ asset('assets/admin/js/dashboard.js') }}"></script>

    <!-- Toastr JS (for session toasts) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        if (typeof toastr !== 'undefined') {
            toastr.options = { "positionClass": "toast-top-right" };
        }
    </script>

</body>

</html>