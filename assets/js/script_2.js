let currentImageIndex = 0;
let isAnimating = false;

function initializePage() {
    fetch("get_images.php")
        .then((response) => response.json())
        .then((imageUrls) => {
            const carousel = document.querySelector(".carousel");

            carousel
                .querySelectorAll(".carousel-image")
                .forEach((el) => el.remove());
            carousel
                .querySelectorAll(".carousel-dots")
                .forEach((el) => el.remove());

            imageUrls.forEach((src, index) => {
                const img = document.createElement("img");
                img.src = src;
                img.alt = `Car image ${index + 1}`;
                img.className = "carousel-image";
                img.style.position = "absolute";
                img.style.top = 0;
                img.style.left = 0;
                img.style.transition = "transform 0.3s ease-in-out";
                if (index === 0) img.classList.add("active");
                carousel.appendChild(img);
            });

            const dotsContainer = document.createElement("div");
            dotsContainer.className = "carousel-dots";
            imageUrls.forEach((_, index) => {
                const dot = document.createElement("div");
                dot.className = `dot ${index === 0 ? "active" : ""}`;
                dot.addEventListener("click", () => goToSlide(index));
                dotsContainer.appendChild(dot);
            });

            carousel.appendChild(dotsContainer);
        })
        .catch((err) => console.error("Error fetching images:", err));
}

// Function to navigate to a specific slide
function goToSlide(index) {
    if (isAnimating || index === currentImageIndex) return;
    isAnimating = true;

    const images = document.querySelectorAll(".carousel-image");
    const dots = document.querySelectorAll(".dot");
    const direction = index > currentImageIndex ? 1 : -1;

    images[currentImageIndex].style.transform = `translateX(${
        direction * -100
    }%)`;
    images[index].style.transform = `translateX(${direction * 100}%)`;

    dots[currentImageIndex].classList.remove("active");
    dots[index].classList.add("active");

    setTimeout(() => {
        images[currentImageIndex].classList.remove("active");
        images[index].classList.add("active");
        images[currentImageIndex].style.transform = "translateX(0)";
        images[index].style.transform = "translateX(0)";
        currentImageIndex = index;
        isAnimating = false;
    }, 300);
}

document.addEventListener("DOMContentLoaded", initializePage);

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

const carDetailsCarousel = {
    currentSlideIndex: 0,
    slides: null,
    dots: null,

    init() {
        this.slides = document.querySelectorAll(".car_details_slide");
        this.dots = document.querySelectorAll(".car_details_dot");
        this.showSlides(this.currentSlideIndex);
    },

    moveSlide(n) {
        this.showSlides(this.currentSlideIndex + n);
    },

    currentSlide(n) {
        this.showSlides(n);
    },

    showSlides(n) {
        if (!this.slides || !this.dots) return;

        if (n >= this.slides.length) {
            this.currentSlideIndex = 0;
        } else if (n < 0) {
            this.currentSlideIndex = this.slides.length - 1;
        } else {
            this.currentSlideIndex = n;
        }

        this.slides.forEach((slide) => {
            slide.classList.remove("active");
            slide.classList.remove("fade");
        });
        this.dots.forEach((dot) => dot.classList.remove("active"));

        this.slides[this.currentSlideIndex].classList.add("active");
        this.slides[this.currentSlideIndex].classList.add("fade");
        this.dots[this.currentSlideIndex].classList.add("active");
    },
};

document.addEventListener("DOMContentLoaded", () => {
    carDetailsCarousel.init();
});
