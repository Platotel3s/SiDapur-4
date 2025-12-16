    function incrementQuantity(button, maxStock = null) {
        const form = button.closest('form');
        const input = form.querySelector('input[name="kuantitas"]');
        let value = parseInt(input.value) || 1;

        if (maxStock && value >= maxStock) {
            showNotification(`Stok maksimal ${maxStock}`, 'warning');
            return;
        }

        input.value = value + 1;
    }

    function decrementQuantity(button) {
        const form = button.closest('form');
        const input = form.querySelector('input[name="kuantitas"]');
        let value = parseInt(input.value) || 1;

        if (value > 1) {
            input.value = value - 1;
        }
    }

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white font-medium z-50 transform transition-transform duration-300 ${type === 'warning' ? 'bg-yellow-600' : 'bg-blue-600'
            }`;
        notification.textContent = message;
        notification.style.transform = 'translateX(100%)';
        document.body.appendChild(notification);
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 10);
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

