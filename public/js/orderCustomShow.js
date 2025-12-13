    function copyOrderDetails() {
        const orderDetails = `
Custom Order Details:
=====================
Produk: {{ $custom->produk->name ?? 'N/A' }}
Catatan: {{ $custom->request_note }}
Nama Penerima: {{ $custom->namaPenerima }}
No HP: {{ $custom->nomorHp }}
Alamat: {{ $custom->alamat }}
Status: {{ ucfirst($custom->status) }}
Tanggal: {{ $custom->created_at->format('d M Y, H:i') }}
    `.trim();

        navigator.clipboard.writeText(orderDetails).then(() => {
            showNotification('Detail order berhasil disalin!', 'success');
        });
    }

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 px-6 py-3 rounded-xl shadow-lg text-white font-medium z-50 transform transition-all duration-300 ${type === 'success' ? 'bg-green-600' : 'bg-blue-600'
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
