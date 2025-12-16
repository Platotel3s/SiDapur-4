const modal = document.getElementById("customModal");
const modalProductName = document.getElementById("modalProductName");
const modalProductId = document.getElementById("modalProductId");
const customForm = document.getElementById("customForm");

function openCustomModal(productId, productName) {
    modal.classList.remove("hidden");
    modal.classList.add("flex");
    document.body.style.overflow = "hidden";
    modalProductName.innerText = "Custom Bumbu - " + productName;
    modalProductId.value = productId;
    customForm.action = `/custom/order/${id}`;
}

function closeCustomModal() {
    modal.classList.add("hidden");
    modal.classList.remove("flex");
    document.body.style.overflow = "auto";

    customForm.reset();
}
modal.addEventListener("click", function (e) {
    if (e.target === modal) {
        closeCustomModal();
    }
});
document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
        closeCustomModal();
    }
});
