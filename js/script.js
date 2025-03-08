document.addEventListener("DOMContentLoaded", function () {
  let slides = document.querySelectorAll(".testimonial-slider p");
  let index = 0;

  setInterval(() => {
    slides.forEach((slide) => (slide.style.display = "none"));
    slides[index].style.display = "block";
    index = (index + 1) % slides.length;
  }, 3000);
});
// Wait until the page loads
document.addEventListener("DOMContentLoaded", function () {
    
    // Password and Confirm Password Validation
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm-password");

    confirmPassword.addEventListener("keyup", function () {
        if (password.value !== confirmPassword.value) {
            confirmPassword.style.border = "2px solid red";
        } else {
            confirmPassword.style.border = "2px solid green";
        }
    });

    // Toggle Password Visibility
    const togglePassword = (inputId) => {
        const input = document.getElementById(inputId);
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    };

    // Adding Eye Icon for Password Fields
    document.querySelectorAll(".password-container").forEach(container => {
        const input = container.querySelector("input");
        const toggleBtn = document.createElement("span");
        toggleBtn.innerHTML = "👁️";
        toggleBtn.style.cursor = "pointer";
        toggleBtn.style.marginLeft = "10px";
        toggleBtn.onclick = () => togglePassword(input.id);
        container.appendChild(toggleBtn);
    });
});
// Wait until the page loads
document.addEventListener("DOMContentLoaded", function () {
    
    // Toggle Password Visibility
    const togglePassword = (inputId) => {
        const input = document.getElementById(inputId);
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    };

    // Adding Eye Icon for Password Fields
    document.querySelectorAll(".password-container").forEach(container => {
        const input = container.querySelector("input");
        const toggleBtn = document.createElement("span");
        toggleBtn.innerHTML = "👁️";
        toggleBtn.style.cursor = "pointer";
        toggleBtn.style.marginLeft = "10px";
        toggleBtn.onclick = () => togglePassword(input.id);
        container.appendChild(toggleBtn);
    });

    // Form Validation for Login
    document.querySelector("form").addEventListener("submit", function (event) {
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        if (email.trim() === "" || password.trim() === "") {
            alert("Please enter both email and password!");
            event.preventDefault(); // Stop form submission
        }
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const dateInput = document.getElementById("date");
    const timeInput = document.getElementById("time");
    const ticketsInput = document.getElementById("tickets");

    // Prevent past dates
    const today = new Date().toISOString().split("T")[0];
    dateInput.setAttribute("min", today);

    form.addEventListener("submit", function (event) {
        let valid = true;

        // Check date selection
        if (dateInput.value === "") {
            showError(dateInput, "Please select a valid date.");
            valid = false;
        } else {
            removeError(dateInput);
        }

        // Check time selection
        if (timeInput.value === "") {
            showError(timeInput, "Please select a time.");
            valid = false;
        } else {
            removeError(timeInput);
        }

        // Check ticket count
        if (ticketsInput.value < 1 || ticketsInput.value > 10) {
            showError(ticketsInput, "Select between 1 to 10 tickets.");
            valid = false;
        } else {
            removeError(ticketsInput);
        }

        if (!valid) event.preventDefault(); // Prevent form submission if invalid
    });

    function showError(input, message) {
        input.style.border = "2px solid red";
        let error = input.nextElementSibling;
        if (!error || !error.classList.contains("error-message")) {
            error = document.createElement("div");
            error.classList.add("error-message");
            error.style.color = "red";
            error.style.fontSize = "14px";
            input.parentNode.appendChild(error);
        }
        error.innerText = message;
    }

    function removeError(input) {
        input.style.border = "2px solid #ccc";
        let error = input.nextElementSibling;
        if (error && error.classList.contains("error-message")) {
            error.remove();
        }
    }
});
document.addEventListener("DOMContentLoaded", function () {
  const rideSelect = document.getElementById("ride");
  const ticketsInput = document.getElementById("tickets");
  const totalPriceDisplay = document.getElementById("totalPrice");

  function updatePrice() {
    const selectedRide = rideSelect.options[rideSelect.selectedIndex];
    const ridePrice = parseInt(selectedRide.getAttribute("data-price"));
    const ticketCount = parseInt(ticketsInput.value) || 1;
    const totalPrice = ridePrice * ticketCount;
    totalPriceDisplay.textContent = totalPrice;
  }

  rideSelect.addEventListener("change", updatePrice);
  ticketsInput.addEventListener("input", updatePrice);
});
