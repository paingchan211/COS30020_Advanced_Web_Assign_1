// Wait for the DOM to load
document.addEventListener("DOMContentLoaded", function () {
  // Get the button element
  const btnBackToTop = document.getElementById("btn-back-to-top");
  // Add a scroll event listener to the window
  window.addEventListener("scroll", function () {
    // Show the button after scrolling down 200px
    if (window.scrollY > 300) {
      btnBackToTop.style.display = "block";
    } else {
      btnBackToTop.style.display = "none";
    }
  });
  // Add a click event listener to smoothly scroll back to the top when clicked
  btnBackToTop.addEventListener("click", function (event) {
    event.preventDefault(); // Prevent default anchor click behavior
    window.scrollTo({ top: 0, behavior: "smooth" });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  // Check if contributeModal exists before running the modal-related code
  var contributeModalElement = document.getElementById("contributeModal");
  var showModalFlag = document.getElementById("showModalFlag");

  if (
    contributeModalElement &&
    showModalFlag &&
    showModalFlag.value === "true"
  ) {
    var contributeModal = new bootstrap.Modal(contributeModalElement);
    contributeModal.show();
  }
});

// Reset Registration Form functionality
window.onload = function () {
  // Check if the reset button exists on the current page before adding the reset functionality
  var resetBtn = document.getElementById("resetBtn");
  if (resetBtn) {
    resetForm();
  }
};

// Form validation and reset logic
function resetForm() {
  document
    .getElementById("resetBtn")
    .addEventListener("click", function (event) {
      event.preventDefault();

      // Clear the input values, excluding radio inputs
      document.querySelectorAll("input").forEach(function (inputElement) {
        if (inputElement.type !== "radio") {
          inputElement.value = "";
        }
      });

      // Clear error messages (if any exist)
      document
        .querySelectorAll(".text-danger")
        .forEach(function (errorElement) {
          errorElement.textContent = "";
        });
    });
}
