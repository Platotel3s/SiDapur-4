let currentForm = null;
function showConfirmation(form) {
    currentForm = form;
    document.getElementById("confirmModal").classList.remove("hidden");
}
function closeModal() {
    document.getElementById("confirmModal").classList.add("hidden");
    currentForm = null;
}
document.getElementById("confirmButton").addEventListener("click", function () {
    if (currentForm) {
        currentForm.submit();
    }
    closeModal();
});
document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll('form[action*="/marked"]');
    forms.forEach((form) => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            showConfirmation(this);
        });
    });
});
document.querySelector("select").addEventListener("change", function (e) {
    const status = e.target.value;
    if (status) {
        window.location.href = `?payment_status=${status}`;
    } else {
        window.location.href = window.location.pathname;
    }
});
