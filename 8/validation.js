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
        // Re-validate confirm password if it's already filled
        if (confirmPassword.value !== "") {
            validateField(confirmPassword, "confirmPasswordError", doPasswordsMatch, "Passwords do not match.");
        }
    });

    confirmPassword.addEventListener("input", () => {
        validateField(confirmPassword, "confirmPasswordError", doPasswordsMatch, "Passwords do not match.");
    });

    // Form Submission
    form.addEventListener("submit", function (e) {
        let isNameValid = validateField(pname, "nameError", isNotEmpty, "Name is required.");
        let isEmailValid = validateField(email, "emailError", isValidEmail, "Enter a valid email address.");
        let isPasswordValid = validateField(password, "passwordError", isValidPassword, "Password must be at least 8 characters.");
        let isConfirmValid = validateField(confirmPassword, "confirmPasswordError", doPasswordsMatch, "Passwords do not match.");

        if (!(isNameValid && isEmailValid && isPasswordValid && isConfirmValid)) {
            e.preventDefault();
            alert("Please correct the errors before submitting.");
        } else {
            alert("Registration successful! (Demo only)");
            e.preventDefault(); // Prevent actual submission for demo purposes
        }
    });

    console.log("Validation system initialized.");
});
