const copy = document.getElementById("copy");
const modal = document.getElementById("modal");
const closeBtn = document.getElementById("closeBtn");

copy.addEventListener("click", async function () {
    const passwordInput = document.querySelector('input[type="text"]');
        if (!passwordInput.value.trim()) {
            return;
        }

    await navigator.clipboard.writeText(passwordInput.value);
    modal.classList.add("show");
});

closeBtn.addEventListener("click", function () {
    modal.classList.remove("show");
});

modal.addEventListener("click", function (event) {
    if (event.target === modal) {
        modal.classList.remove("show");
    }
});