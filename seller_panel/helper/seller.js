
document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");
    form.addEventListener("submit", function() {
        const submitButton = form.querySelector("button[type='submit']");
        submitButton.disabled = true; // Disable the button
        submitButton.innerText = "Adding..."; // Optional: Change button text
    });
});
