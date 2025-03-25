document.addEventListener("DOMContentLoaded", function () {
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

    // Get all navbar menu items
    const menuItems = document.querySelectorAll(".menu li a");
    const categoryCards = document.querySelectorAll(".category-card");

    // Combine menu items and category cards for event listeners
    const clickableCategories = [...menuItems, ...categoryCards];

    // Add click event listener to each menu item and category card
    clickableCategories.forEach((item) => {
        item.addEventListener("click", function (e) {
            e.preventDefault(); // Prevent default link behavior

            // Get the category text (lowercase and trim whitespace)
            const category = this.textContent.toLowerCase().trim();

            // Filter news based on category
            filterNewsByCategory(category);

            // Update active state in navbar
            updateActiveMenuItem(category);

            // Close mobile menu if open
            if (menu && menu.classList.contains("active")) {
                menu.classList.remove("active");
                hamburger.classList.remove("active");
            }
        });
    });

    // Function to filter news by category
    function filterNewsByCategory(category) {
        // Normalize category names
        const normalizedCategory = normalizeCategory(category);

        // Get all news articles
        const newsArticles = document.querySelectorAll(".news-article");

        // If category is 'beranda' or empty, show all articles
        if (category === "beranda" || !category) {
            newsArticles.forEach((article) => {
                article.style.display = "block";
            });
            return;
        }

        // Hide all articles first
        newsArticles.forEach((article) => {
            article.style.display = "none";
        });

        // Show articles matching the selected category
        const matchingArticles = document.querySelectorAll(
            `.news-article[data-category="${normalizedCategory}"]`
        );
        matchingArticles.forEach((article) => {
            article.style.display = "block";
        });

        // Optional: Show message if no articles found
        const noResultsMessage = document.getElementById("no-results-message");
        if (noResultsMessage) {
            noResultsMessage.style.display =
                matchingArticles.length > 0 ? "none" : "block";
        }
    }

    // Function to normalize category names
    function normalizeCategory(category) {
        const categoryMap = {
            nasional: "nasional",
            internasional: "internasional",
            ekonomi: "ekonomi",
            olahraga: "olahraga",
            teknologi: "teknologi",
            hiburan: "hiburan",
            "gaya hidup": "gaya hidup",
            beranda: "",
        };

        return categoryMap[category] || category;
    }

    // Function to update active menu item
    function updateActiveMenuItem(category) {
        // Remove active class from all menu items
        menuItems.forEach((item) => {
            const itemText = item.textContent.toLowerCase().trim();
            const isMatchingCategory =
                normalizeCategory(itemText) === normalizeCategory(category);

            item.parentElement.classList.toggle("active", isMatchingCategory);
        });
    }
});
