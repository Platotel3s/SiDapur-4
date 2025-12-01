function shareOrder() {
    const orderNumber = '{{ $order->order_number }}';
    const totalPrice = 'Rp {{ number_format($order->total_price, 0, ",", ".") }}';
    const text = `Saya baru saja berhasil melakukan pemesanan di SiDapur! 🎉\n\n` +
        `📦 Pesanan #${orderNumber}\n` +
        `💰 Total: ${totalPrice}\n` +
        `🛒 ${$order -> itemOrder -> count()} item\n\n` +
        `Terima kasih SiDapur!`;
        if (navigator.share) {
            navigator.share({
                title: 'Pesanan Berhasil - SiDapur',
                text: text,
                url: window.location.href
            }).catch(console.error);
        } else {
            navigator.clipboard.writeText(text).then(() => {
                alert('Teks pesanan berhasil disalin ke clipboard! 📋');
            });
        }
    }
    function printOrder() {
        window.print();
    }
    const style = document.createElement('style');
    style.innerHTML = `
        @media print {
            body * {
                visibility: hidden;
            }
            .max-w-4xl, .max-w-4xl * {
                visibility: visible;
            }
            .max-w-4xl {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                background: white;
                color: black;
            }
            button, .no-print {
                display: none !important;
            }
        }
    `;
document.head.appendChild(style);

