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

  // Create a data object with the form values
  const data = {
    firstName: firstName,
    lastName: lastName,
    email: email,
    password: password
  };

  // Make an AJAX request to the PHP file for database operations
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "save_user.php", true);
  xhr.setRequestHeader("Content-Type", "application/json");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Request successful, do something with the response if needed
        console.log(xhr.responseText);
        // Redirect to index.php or perform other actions
        window.location.href = "../src/index.php";
      } else {
        // Request failed, display an error message if needed
        console.error(xhr.status);
      }
    }
  };

  // Send the data as JSON to the PHP file
  xhr.send(JSON.stringify(data));
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

// Attach the saveFields function to the form submit event
const signupForm = document.getElementById("signup-form");
signupForm.addEventListener("submit", saveFields);
