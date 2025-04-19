// Navigation Menu
const menuBtn = document.getElementById("menuBtn");
const navMenu = document.getElementById("navMenu");

menuBtn.addEventListener("click", () => {
    navMenu.classList.toggle("active");
});

// Scroll Animation
const observerOptions = {
    threshold: 0.2,
    rootMargin: "50px",
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add("visible");
        }
    });
}, observerOptions);

document.querySelectorAll("[data-scroll]").forEach((element) => {
    observer.observe(element);
});

// Smooth Scroll
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute("href"));
        if (target) {
            target.scrollIntoView({
                behavior: "smooth",
            });
        }
    });
});

// Newsletter Form
const newsletterForm = document.querySelector(".newsletter-form");
if (newsletterForm) {
    newsletterForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const email = e.target.querySelector('input[type="email"]').value;
        console.log("Newsletter subscription for:", email);
        e.target.reset();
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const startExploringBtn = document.getElementById("startExploringBtn");
    const searchOverlay = document.getElementById("searchOverlay");
    const carSearch = document.getElementById("carSearch");
    const searchResults = document.getElementById("searchResults");
    let searchTimeout;

    startExploringBtn.addEventListener("click", function () {
        searchOverlay.style.display = "flex";
        carSearch.focus();
    });

    searchOverlay.addEventListener("click", function (e) {
        if (e.target === searchOverlay) {
            searchOverlay.style.display = "none";
        }
    });

    carSearch.addEventListener("input", function () {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            const searchTerm = this.value.trim();
            if (searchTerm.length > 0) {
                fetchCarResults(searchTerm);
            } else {
                searchResults.innerHTML = "";
            }
        }, 300);
    });

    function fetchCarResults(searchTerm) {
        fetch(`handlers/search_cars.php?term=${encodeURIComponent(searchTerm)}`)
            .then((response) => response.json())
            .then((data) => {
                displayResults(data);
            })
            .catch((error) => console.error("Error:", error));
    }

    function displayResults(cars) {
        searchResults.innerHTML = "";
        cars.forEach((car) => {
            const div = document.createElement("div");
            div.className = "search-result-item";
            div.textContent = car.name;
            div.addEventListener("click", () => {
                window.location.href = `car-details.php?car_id=${car.car_id}`;
            });
            searchResults.appendChild(div);
        });
    }
});
