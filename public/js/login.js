let passwordInput = document.getElementById("password");
let toggleButton = document.getElementById("togglePassword");

toggleButton.addEventListener("click", function () {
    if (passwordInput.type === "password") {
        passwordInput.type === "text";
        toggleButton.textContent === "Hide";
    } else {
        passwordInput.type === "password";
        toggleButton.textContent = "Show";
    }
});
document.addEventListener("DOMContentLoaded", function () {
    const togglePassword = document.getElementById("togglePassword");
    const passwordField = document.getElementById("password");
    const eyeIcon = document.getElementById("eyeIcon");
    const eyeSlashIcon = document.getElementById("eyeSlashIcon");

    togglePassword.addEventListener("click", function () {
        const type =
            passwordField.getAttribute("type") === "password"
                ? "text"
                : "password";
        passwordField.setAttribute("type", type);

        // Toggle icon visibility
        if (type === "text") {
            eyeIcon.classList.add("hidden");
            eyeSlashIcon.classList.remove("hidden");
        } else {
            eyeIcon.classList.remove("hidden");
            eyeSlashIcon.classList.add("hidden");
        }
    });
    document.getElementById("login").focus();
});
