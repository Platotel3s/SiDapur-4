document.querySelector("select").addEventListener("change", function (e) {
    const status = e.target.value;
    if (status) {
        window.location.href = `?status=${status}`;
    } else {
        window.location.href = window.location.pathname;
    }
});
let searchTimeout;
document
    .querySelector('input[type="text"]')
    .addEventListener("input", function (e) {
        clearTimeout(searchTimeout);
        const searchTerm = e.target.value.trim();

        searchTimeout = setTimeout(() => {
            if (searchTerm.length >= 2 || searchTerm.length === 0) {
                const url = new URL(window.location.href);
                if (searchTerm) {
                    url.searchParams.set("search", searchTerm);
                } else {
                    url.searchParams.delete("search");
                }
                window.location.href = url.toString();
            }
        }, 500);
    });
const urlParams = new URLSearchParams(window.location.search);
const statusParam = urlParams.get("status");
if (statusParam) {
    document.querySelector("select").value = statusParam;
}
