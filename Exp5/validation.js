document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("registrationForm");
    const pname = document.getElementById("pname");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");

    // Validation Rules
    const validateField = (field, errorId, validationFn, errorMessage) => {
        const errorSpan = document.getElementById(errorId);
        if (!validationFn(field.value)) {
            field.classList.add("error-input");
            field.classList.remove("valid-input");
            errorSpan.innerText = errorMessage;
            return false;
        } else {
            field.classList.remove("error-input");
            field.classList.add("valid-input");
            errorSpan.innerText = "";
            return true;
        }
    };

    const isNotEmpty = (val) => val.trim() !== "";
    const isValidEmail = (val) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val);
    const isValidPassword = (val) => val.length >= 8;
    const doPasswordsMatch = (val) => val === password.value;

    // Real-time validation
    pname.addEventListener("input", () => {
        validateField(pname, "nameError", isNotEmpty, "Name is required.");
    });

    email.addEventListener("input", () => {
        validateField(email, "emailError", isValidEmail, "Enter a valid email address.");
    });

    password.addEventListener("input", () => {
        validateField(password, "passwordError", isValidPassword, "Password must be at least 8 characters.");
        if (confirmPassword.value !== "") {
            validateField(confirmPassword, "confirmPasswordError", doPasswordsMatch, "Passwords do not match.");
        }
    });

    confirmPassword.addEventListener("input", () => {
        validateField(confirmPassword, "confirmPasswordError", doPasswordsMatch, "Passwords do not match.");
    });

    // Q7: JavaScript function that checks user inputs before submission
    function validateFormBeforeSubmit(e) {
        let isNameValid = validateField(pname, "nameError", isNotEmpty, "Name is required.");
        let isEmailValid = validateField(email, "emailError", isValidEmail, "Enter a valid email address.");
        let isPasswordValid = validateField(password, "passwordError", isValidPassword, "Password must be at least 8 characters.");
        let isConfirmValid = validateField(confirmPassword, "confirmPasswordError", doPasswordsMatch, "Passwords do not match.");

        // Check if required fields are filled to provide specific user feedback (as requested)
        if (!isNotEmpty(pname.value) || !isNotEmpty(email.value) || !isNotEmpty(password.value) || !isNotEmpty(confirmPassword.value)) {
            alert("Error: Some required fields are currently empty. Please fill out all required fields.");
        }

        if (!(isNameValid && isEmailValid && isPasswordValid && isConfirmValid)) {
            e.preventDefault(); // Stop submission
        }
        // If valid, allow form to naturally submit to the PHP handler
    }

    form.addEventListener("submit", validateFormBeforeSubmit);
});
