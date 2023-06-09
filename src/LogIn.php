<?php
session_start();

// Check if the user is already logged in
$isLoggedIn = isset($_SESSION['user']);

// If the user is already logged in, redirect to the homepage
if ($isLoggedIn) {
    header('Location: index.php');
    exit;
}

// If the form is submitted, process the login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the values from the form
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rememberMe = isset($_POST['remember_me']) && $_POST['remember_me'] === 'on';

    // Check if the email and password match the desired combination
    if ($email === 'test@test.test' && $password === 'test123') {
        // Set session for user authentication
        $_SESSION['user'] = true;

        // If "Remember me" is checked, set a cookie
        if ($rememberMe) {
            $cookieExpiration = time() + (30 * 24 * 60 * 60); // 30 days
            setcookie('remember_me', $email, $cookieExpiration);
        }

        // Redirect to the homepage
        header('Location: index.php');
        exit;
    } else {
        // Invalid login, display an error message
        echo '<p>Invalid email or password. Please try again.</p>';
    }
}

// Check if a remember me cookie exists and log in the user automatically
if (isset($_COOKIE['remember_me'])) {
    $email = $_COOKIE['remember_me'];

    // Implement your email validation logic here
    // Replace the condition below with your actual validation
    if ($email === 'test@test.test') {
        $_SESSION['user'] = true;
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
  <!-- Header -->
  <nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand">SchedulerAI</a>


  </nav>

  <div class="container">
    <div class="row">
      <div class="col-md-12 mx-auto">
        <div class="login-container">
          <h1>Login SchedulerAI</h1>
          <form method="post" action="#" onsubmit="validateLogin(event)">
            <div class="form-group">
              <label for="email">E-mail</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Enter e-mail">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Login</button>
            <div class="forgot-signup mt-3">
              <button type="button" class="btn btn-link">Forgot password?</button>
              <button type="button" class="btn btn-link" onclick="window.location.href = 'SignUp.php';">Sign up</button>
            </div>

            <div id="g_id_onload" data-client_id="411721865539-jj0p6k0o9u5hib7dn9frqcptkna4b7vp.apps.googleusercontent.com" data-auto_select="true" data-login_uri="index.php" data-type="standard" data-size="large" data-theme="outline"></div>
        </div>
        </form>
      </div>
    </div>
  </div>
  </div>

  <!-- Footer -->
  <footer>
    <div class="container py-3">
      <div class="row">
        <div class="col-md-6">
          <p>&copy; 2023 SchedulerAI</p>
        </div>
        <div class="col-md-6 text-bottom">
          <p id="datetime"></p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGi/7SfCypdtkWr+0nx384Zk+5T0Ukre/WRS" crossorigin="anonymous"></script>
  <script src="https://accounts.google.com/gsi/client" async defer></script>
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <script src="https://accounts.google.com/gsi/client" async defer></script>
  <script src="https://apis.google.com/js/platform.js" async defer></script>

  <script src="scripts/login.js">
  </script>
</body>

</html>
