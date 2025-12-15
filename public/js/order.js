let selectedFile = null;

function openPaymentModal(orderId) {
    console.log('Opening modal for order:', orderId);
    document.getElementById('order_id').value = orderId;
    document.getElementById('paymentModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    resetForm();
}

function closePaymentModal() {
    document.getElementById('paymentModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    resetForm();
}

function resetForm() {
    document.getElementById('bukti').value = '';
    selectedFile = null;
    document.getElementById('uploadContent').classList.remove('hidden');
    document.getElementById('imagePreview').classList.add('hidden');
    document.getElementById('fileInfo').classList.add('hidden');
    document.getElementById('fileError').classList.add('hidden');
}

function previewFile(input) {
    const file = input.files[0];
    if (!file) return;
    const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
    const maxSize = 5 * 1024 * 1024;
    if (!validTypes.includes(file.type)) {
        showError('Format file tidak didukung. Gunakan JPG, PNG, atau PDF.');
        return;
    }
    if (file.size > maxSize) {
        showError('Ukuran file terlalu besar. Maksimal 5MB.');
        return;
    }
    selectedFile = file;
    document.getElementById('fileName').textContent = file.name;
    document.getElementById('fileSize').textContent = formatFileSize(file.size);
    document.getElementById('fileInfo').classList.remove('hidden');
    document.getElementById('fileError').classList.add('hidden');
    if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImage').src = e.target.result;
            document.getElementById('uploadContent').classList.add('hidden');
            document.getElementById('imagePreview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    } else {
        document.getElementById('uploadContent').classList.add('hidden');
        document.getElementById('imagePreview').classList.remove('hidden');
        document.getElementById('previewImage').src = 'data:image/svg+xml;base64,' + btoa(`
            <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24" fill="none" viewBox="0 0 24 24" stroke="#ef4444">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        `);
    }
}
function removeImage() {
    resetForm();
}
function changeImage() {
    document.getElementById('bukti').click();
}
function showError(message) {
    const errorDiv = document.getElementById('fileError');
    errorDiv.textContent = message;
    errorDiv.classList.remove('hidden');
    document.getElementById('bukti').value = '';
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('bukti');

    if (uploadArea && fileInput) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
        });
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, highlight, false);
        });
        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, unhighlight, false);
        });
        function highlight() {
            uploadArea.classList.add('border-blue-500', 'bg-gray-800');
        }
        function unhighlight() {
            uploadArea.classList.remove('border-blue-500', 'bg-gray-800');
        }
        uploadArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
            previewFile(fileInput);
        }
        uploadArea.addEventListener('click', function() {
            fileInput.click();
        });
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePaymentModal();
        }
    });
    const modal = document.getElementById('paymentModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closePaymentModal();
            }
        });
    }
});

function showNotification(type, message) {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
        type === 'success' ? 'bg-green-600 text-white' : 'bg-red-600 text-white'
    }`;
    notification.textContent = message;
    document.body.appendChild(notification);
    setTimeout(() => {
        notification.remove();
    }, 6000);
}
window.openPaymentModal = openPaymentModal;
window.closePaymentModal = closePaymentModal;
window.previewFile = previewFile;
window.removeImage = removeImage;
window.changeImage = changeImage;

