function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const eye = document.getElementById("eyeIcon");
    const eyeSlash = document.getElementById("eyeSlashIcon");

    if (!input || !eye || !eyeSlash) return;

    if (input.type === "password") {
        input.type = "text";
        eye.classList.add("hidden");
        eyeSlash.classList.remove("hidden");
    } else {
        input.type = "password";
        eye.classList.remove("hidden");
        eyeSlash.classList.add("hidden");
    }
}
