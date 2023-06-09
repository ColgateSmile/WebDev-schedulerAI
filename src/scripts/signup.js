  function saveFields(event) {
    event.preventDefault();
    const firstName = document.getElementById("first-name").value;
    const lastName = document.getElementById("last-name").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    // Check if all fields are filled
    if (firstName === "" || lastName === "" || email === "" || password === "") {
      alert("Please fill all the fields");
      return;
    }

    // Check if password is strong
    const passwordStrength = document.getElementById("password-strength-text").textContent;
    if (passwordStrength !== "Strong") {
      alert("Password should be at least 10 characters long and contain at least one number, one letter, and one symbol (!@#$%^&*)");
      return;
    }

    // Save fields to local storage
    localStorage.setItem("firstName", firstName);
    localStorage.setItem("lastName", lastName);
    localStorage.setItem("email", email);
    localStorage.setItem("password", password);

    // Redirect to index.php
    window.location.href ="../src/index.php";
  }

  function checkPasswordStrength(password) {
    const passwordStrengthIndicator = document.querySelector(".password-strength-indicator");
    const passwordStrengthBar = document.querySelector(".password-strength-bar");
    const passwordStrengthText = document.querySelector("#password-strength-text");

    let strength = 0;

    // Check password length
    if (password.length >= 10) {
      strength += 1;
    }

    // Check if password contains a number
    if (/\d/.test(password)) {
      strength += 1;
    }

    // Check if password contains a letter
    if (/[a-zA-Z]/.test(password)) {
      strength += 1;
    }

    // Check if password contains a symbol
    if (/[!@#$%^&*]/.test(password)) {
      strength += 1;
    }

    // Change password strength bar color and text based on password strength
    if (strength === 0) {
      passwordStrengthBar.style.backgroundColor = "transparent";
      passwordStrengthText.textContent = "";
    } else if (strength === 1) {
      passwordStrengthBar.style.backgroundColor = "red";
      passwordStrengthText.textContent = "Weak";
    } else if (strength === 2) {
      passwordStrengthBar.style.backgroundColor = "orange";
      passwordStrengthText.textContent = "Moderate";
    } else if (strength === 3) {
      passwordStrengthBar.style.backgroundColor = "yellow";
      passwordStrengthText.textContent = "Strong";
    } else {
      passwordStrengthBar.style.backgroundColor = "green";
      passwordStrengthText.textContent = "Very Strong";
    }
  }

  // Initialize password strength bar
  checkPasswordStrength("");

  // Show password strength bar on password input
  const passwordInput = document.getElementById("password");
  passwordInput.addEventListener("input", () => {
    const password = passwordInput.value;
    checkPasswordStrength(password);
  });
