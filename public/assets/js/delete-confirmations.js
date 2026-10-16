(function () {
    document.addEventListener('submit', function (event) {
        const form = event.target;
        if (!(form instanceof HTMLFormElement)) {
            return;
        }

        if (form.hasAttribute('data-confirm-cancel')) {
            if (form.dataset.cancellationConfirmed === 'true') {
                delete form.dataset.cancellationConfirmed;
                return;
            }

            event.preventDefault();
            if (!window.Swal) {
                console.error('SweetAlert2 is required for booking cancellation confirmation.');
                if (window.showAppToast) {
                    window.showAppToast('error', 'Could not open the cancellation confirmation. Please refresh and try again.');
                }
                return;
            }

            window.Swal.fire({
                title: 'Cancel this booking?',
                text: form.dataset.confirmCancel || 'This cancellation is final.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, cancel booking',
                cancelButtonText: 'Keep booking',
                confirmButtonColor: '#dc3545',
                reverseButtons: true,
            }).then(function (result) {
                if (!result.isConfirmed) {
                    return;
                }

                form.dataset.cancellationConfirmed = 'true';
                if (typeof form.requestSubmit === 'function') {
                    form.requestSubmit(event.submitter || undefined);
                } else {
                    form.submit();
                }
            });
            return;
        }

        const method = form.querySelector('input[name="_method"]');
        if (!method || method.value.toUpperCase() !== 'DELETE') {
            return;
        }

        if (form.dataset.deleteConfirmed === 'true') {
            delete form.dataset.deleteConfirmed;
            return;
        }

        event.preventDefault();

        if (!window.Swal) {
            console.error('SweetAlert2 is required for delete confirmation.');
            if (window.showAppToast) {
                window.showAppToast('error', 'Could not open the delete confirmation. Please refresh and try again.');
            }
            return;
        }

        window.Swal.fire({
            title: 'Are you sure?',
            text: form.dataset.confirmDelete || 'This item will be permanently deleted.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#dc3545',
            reverseButtons: true,
        }).then(function (result) {
            if (!result.isConfirmed) {
                return;
            }

            form.dataset.deleteConfirmed = 'true';
            if (typeof form.requestSubmit === 'function') {
                form.requestSubmit(event.submitter || undefined);
            } else {
                form.submit();
            }
        });
    }, true);

    window.confirmAppDelete = function (message) {
        if (!window.Swal) {
            console.error('SweetAlert2 is required for delete confirmation.');
            return Promise.reject(new Error('SweetAlert2 is unavailable.'));
        }

        return window.Swal.fire({
            title: 'Are you sure?',
            text: message || 'This item will be permanently deleted.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#dc3545',
            reverseButtons: true,
        }).then(function (result) {
            return result.isConfirmed;
        });
    };
})();
