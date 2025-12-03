function openCustomModal(id, productName) {
    document.getElementById("modalProductId").value = id;
    document.getElementById("modalProductName").innerText =
        "Custom Bumbu - " + productName;
    document.getElementById("customModal").classList.remove("hidden");
}

function closeCustomModal() {
    document.getElementById("customModal").classList.add("hidden");
}
