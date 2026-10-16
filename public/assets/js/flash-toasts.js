(function () {
    const labels = {
        success: 'Success',
        error: 'Error',
        warning: 'Warning',
        info: 'Notice',
    };

    function getContainer() {
        let container = document.getElementById('app-toast-container');
        if (container) {
            return container;
        }

        container = document.createElement('div');
        container.id = 'app-toast-container';
        container.className = 'app-toast-container';
        container.setAttribute('role', 'region');
        container.setAttribute('aria-label', 'Notifications');
        container.setAttribute('aria-live', 'polite');
        document.body.appendChild(container);

        return container;
    }

    window.showAppToast = function (type, message) {
        const toastType = Object.prototype.hasOwnProperty.call(labels, type) ? type : 'info';
        const toast = document.createElement('div');
        toast.className = 'app-toast app-toast-' + toastType;
        toast.setAttribute('role', toastType === 'error' ? 'alert' : 'status');

        const text = document.createElement('div');
        text.className = 'app-toast-content';

        const title = document.createElement('strong');
        title.className = 'app-toast-title';
        title.textContent = labels[toastType];

        const description = document.createElement('span');
        description.className = 'app-toast-message';
        description.textContent = String(message);

        const close = document.createElement('button');
        close.type = 'button';
        close.className = 'app-toast-close';
        close.setAttribute('aria-label', 'Dismiss notification');
        close.textContent = '\u00d7';

        function dismiss() {
            if (!toast.isConnected) {
                return;
            }

            toast.classList.add('app-toast-hiding');
            window.setTimeout(function () {
                toast.remove();
            }, 180);
        }

        close.addEventListener('click', dismiss);
        text.append(title, description);
        toast.append(text, close);
        getContainer().appendChild(toast);
        window.setTimeout(dismiss, 3000);
    };
})();
