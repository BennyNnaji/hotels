// Import dependencies
import "./bootstrap";
import Alpine from "alpinejs";
import $ from "jquery";
import "summernote/dist/summernote-lite.css";
import "summernote/dist/summernote-lite.js";
import "@fortawesome/fontawesome-free/css/all.min.css";
import AOS from "aos";
import "aos/dist/aos.css";
// import toastr from "toastr";
// import "toastr/build/toastr.min.css";
import { tns } from "tiny-slider";
import "tiny-slider/dist/tiny-slider.css";

import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

// Configure Toastr options
toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: "toast-top-right",
    timeOut: "5000",
};

// Display Toastr notifications based on session messages
document.addEventListener("DOMContentLoaded", function() {
    if (window.Laravel.successMessage) {
        toastr.success(window.Laravel.successMessage);
    }
    if (window.Laravel.errorMessage) {
        toastr.error(window.Laravel.errorMessage);
    }
    if (window.Laravel.infoMessage) {
        toastr.info(window.Laravel.infoMessage);
    }
    if (window.Laravel.warningMessage) {
        toastr.warning(window.Laravel.warningMessage);
    }
});


// Initialize AOS
AOS.init({
    offset: 50, // Offset from the original trigger point
    delay: 200, // Delay in milliseconds
    duration: 1000, // Duration of animation in milliseconds
    easing: "ease-in-out",
    once: false, // Whether animation should happen only once
});

// Initialize Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Initialize Summernote after the DOM is ready
$(document).ready(function () {
    $(".summernote").summernote({
        height: 300, // Set editor height
        minHeight: null, // Minimum height
        maxHeight: null, // Maximum height
        focus: true, // Focus on load
        toolbar: [
            ["style", ["style"]],
            ["font", ["bold", "italic", "underline", "clear"]],
            ["fontname", ["fontname"]],
            ["fontsize", ["fontsize"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["height", ["height"]],
            ["table", ["table"]],
            ["insert", ["link", "picture", "video"]],
            ["view", ["fullscreen", "codeview", "help"]],
        ],
        styleTags: [
            "p",
            "blockquote",
            "pre",
            "h1",
            "h2",
            "h3",
            "h4",
            "h5",
            "h6",
        ],
        fontNames: [
            "Arial",
            "Arial Black",
            "Comic Sans MS",
            "Courier New",
            "Merriweather",
            "Roboto",
        ],
        fontNamesIgnoreCheck: ["Merriweather", "Roboto"],
        fontsize: [
            "8",
            "9",
            "10",
            "11",
            "12",
            "14",
            "16",
            "18",
            "24",
            "36",
            "48",
            "64",
            "82",
            "150",
        ],
    });
});

//Frontpage menu and admin Sidebar
const btn = document.querySelector(".btn");
const mobile = document.querySelector(".mobile");
btn.addEventListener("click", () => {
    mobile.classList.toggle("hidden");
});
// Close the sidebar when clicking outside of it
document.addEventListener("click", (event) => {
    const isClickInsideSidebar = mobile.contains(event.target);
    const isClickInsideButton = btn.contains(event.target);

    if (!isClickInsideSidebar && !isClickInsideButton) {
        mobile.classList.add("hidden");
    }
});

// fixed navbar when u scroll and back to Top
const navigation = document.querySelector(".navbar");
const backTop = document.querySelector(".btt");
const threshold = 200;

window.addEventListener("scroll", () => {
    if (window.scrollY >= threshold) {
        navigation.classList.add("fixed");
        backTop.classList.remove("hidden");
    } else {
        navigation.classList.remove("fixed");
        backTop.classList.add("hidden");
    }
});

// Back to top
backTop.addEventListener("click", () => {
    window.scrollTo({
        top: 0,
        behavior: "smooth",
    });
});

// Making sure that checkIn date is today's date or future's date
const checkIn = document.querySelector("#checkIn");
const checkOut = document.querySelector("#checkOut");

// Set minimum check-in date to today's date
const today = new Date().toISOString().split("T")[0];
checkIn.setAttribute("min", today);

// Update check-out date minimum when check-in date changes
checkIn.addEventListener("change", function () {
    checkOut.value = "";
    checkOut.setAttribute("min", checkIn.value);
});

// Initially set check-out date minimum to today if no check-in date
checkOut.setAttribute("min", today);


function togglePaymentStatusText() {
    const paymentCheckbox = document.getElementById("payment");
    const statusText = document.getElementById("payment-status-text");
    statusText.textContent = paymentCheckbox.checked ? "Paid" : "Not Paid";
}

// Set the initial text on page load, in case of old input
document.addEventListener("DOMContentLoaded", togglePaymentStatusText);

// Initialize the slider
const slider = tns({
    container: "#guestReviewSlider",
    items: 1,
    slideBy: "page",
    autoplay: true,
    controls: false,
    nav: true,
    autoplayButtonOutput: false,
    responsive: {
        640: {
            items: 1,
        },
        700: {
            items: 2,
        },
        900: {
            items: 3,
        },
    },
});
