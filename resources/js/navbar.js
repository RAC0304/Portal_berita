// Mobile menu toggle
const hamburger = document.getElementById("hamburger");
const menu = document.querySelector(".menu");

if (hamburger && menu) {
    hamburger.addEventListener("click", () => {
        menu.classList.toggle("active");
        hamburger.classList.toggle("active");
    });

    // Close menu when clicking outside
    document.addEventListener("click", (e) => {
        if (
            !e.target.closest(".hamburger") &&
            !e.target.closest(".menu") &&
            menu.classList.contains("active")
        ) {
            menu.classList.remove("active");
            hamburger.classList.remove("active");
        }
    });
}
