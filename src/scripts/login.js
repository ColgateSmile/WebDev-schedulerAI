function handleCredentialResponse(response) {
    // Handle the response from the Google Sign-In API
    console.log(response.credential);
}

google.accounts.id.initialize({
    client_id: '411721865539-jj0p6k0o9u5hib7dn9frqcptkna4b7vp.apps.googleusercontent.com',
    callback: handleCredentialResponse
});

google.accounts.id.prompt();

function validateLogin(event) {
    event.preventDefault(); // Prevent form submission

    // Get the entered email and password
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Perform validation or API call to check if user exists in the database
    // Replace this with your own validation logic

    // Simulating validation success for demonstration purposes
    const isAdmin = (email.toLowerCase() === 'admin' && password === 'admin');

    if (isAdmin) {
        // Redirect to the admin page
        window.location.href = 'index.php';
    } else {
        // Display an error message or perform any necessary action
        alert('Invalid email or password. Please try again.');
    }
}
