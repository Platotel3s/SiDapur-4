
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if (!input || !icon) return;
    if (input.type === "password") {
        input.type = "text";
        icon.innerHTML = `
          <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
          <path fill-rule="evenodd"
            d="M.458 10C1.732 5.943 5.522 3 10 3
            c2.02 0 3.9.627 5.45 1.707L14.1 6.05
            A4 4 0 006 10a4 4 0 006.05 3.45l1.35 1.35
            C12.3 15.372 11.17 15.5 10 15.5
            c-4.478 0-8.268-2.943-9.542-7z"
            clip-rule="evenodd"/>
        `;
    } else {
        input.type = "password";
        icon.innerHTML = `
          <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
          <path fill-rule="evenodd"
            d="M.458 10C1.732 5.943 5.522 3 10 3
            s8.268 2.943 9.542 7
            c-1.274 4.057-5.064 7-9.542 7
            S1.732 14.057.458 10z
            M14 10a4 4 0 11-8 0 4 4 0 018 0z"
            clip-rule="evenodd" />
        `;
    }
}
