let passwordInput = document.getElementById("password");
let toggleButton = document.getElementById("togglePassword");

toggleButton.addEventListener("click", function() {
    if (passwordInput.type==='password') {
        passwordInput.type==='text';
        toggleButton.textContent==="Hide";
    }else{
        passwordInput.type==="password";
        toggleButton.textContent="Show";
    }
});
