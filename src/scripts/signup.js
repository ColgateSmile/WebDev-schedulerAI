function saveFields(event) {
  event.preventDefault();
  const firstname = document.getElementById("first-name").value;
  const lastname = document.getElementById("last-name").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  // Check if all fields are filled
  if (firstname === "" || lastname === "" || email === "" || password === "") {
    alert("Please fill all the fields");
    return;
  }

  // Create a data object with the form values
  const data = {
    "first-name": firstname,
    "last-name": lastname,
    "email": email,
    "password": password
  };

  // Make an AJAX request to the PHP file for database operations
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "SignUp.php", true);
  xhr.setRequestHeader("Content-Type", "application/json");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Request successful, do something with the response if needed
        console.log(xhr.responseText);
        // Redirect to index.php or perform other actions
        // window.location.href = "index.php";
      } else {
        // Request failed, display an error message if needed
        console.error(xhr.status);
      }
    }
  };

  // Convert the data object to JSON format
  const jsonData = JSON.stringify(data);

  // Send the JSON data to the PHP file
  xhr.send(jsonData);
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
