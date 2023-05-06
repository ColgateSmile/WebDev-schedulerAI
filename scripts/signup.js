// Save the values in variables or perform any desired operations
function saveFields(event) {
    event.preventDefault(); // Prevent the form from submitting and page refresh

    // Get form field values
    var firstName = document.getElementById('first-name').value;
    var lastName = document.getElementById('last-name').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    // Perform validation or API call to save the user data
    // Replace this with your own validation logic and data saving logic

    // Redirect to the homepage or display a success message
    window.location.href = 'index.html';
}

function checkPasswordStrength(password) {
    var indicator = document.getElementById('password-strength-indicator');
    var label = document.getElementById('password-strength-label');

    // Reset the indicator
    indicator.className = 'password-strength-indicator';

    // Evaluate password strength
    if (password.length < 7 || !/\d/.test(password) || !/[a-zA-Z]/.test(password) || !/[!@#$%^&*]/.test(password)) {
        indicator.classList.add('password-weak');
        label.textContent = 'Weak Password';
        label.style.color = 'red';
    } else {
        indicator.classList.add('password-strong');
        label.textContent = 'Strong Password';
        label.style.color = 'green';
    }
}
