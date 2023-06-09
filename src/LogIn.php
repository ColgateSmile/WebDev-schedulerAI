<?php
session_start();

// Check if the user is already logged in
$isLoggedIn = isset($_SESSION['user']);

// If the user is already logged in, redirect to the homepage
if ($isLoggedIn) {
    header('Location: index.php');
    exit;
}

// Initialize error message
$errorMsg = '';

// If the form is submitted, process the login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the values from the form
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rememberMe = isset($_POST['rememberMe']) && $_POST['rememberMe'] === 'on';

    // Check if the email and password match the desired combination
    if ($email === 'admin' && $password === 'admin') {
        // Set session for user authentication
        $_SESSION['user'] = true;

        // If "Remember me" is checked, set a cookie
        if ($rememberMe) {
            $cookieExpiration = time() + (30 * 24 * 60 * 60); // 30 days
            setcookie('rememberMe', $email, $cookieExpiration);
        }

        // Redirect to the homepage
        header('Location: index.php');
        exit;
    } else {
        // Invalid login, set error message
        $errorMsg = 'Invalid email or password. Please try again.';
    }
}

// Check if a remember me cookie exists and log in the user automatically
if (isset($_COOKIE['rememberMe'])) {
    $email = $_COOKIE['rememberMe'];

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
  <link rel="stylesheet" type="text/css" href="css/login-style.css">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-l3UDC6yX4dH47gX2D9GSuMWEV4gK+lfhZ9elOqI9b94Nt1xrgDdpnXrK3y4EMIEiehTvsJlYdoS35f5db7Dy4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <?php if (!empty($errorMsg) && $_SERVER['REQUEST_METHOD'] === 'POST'): ?>
              <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <?php echo $errorMsg; ?>
              </div>
            <?php endif; ?>
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
            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
              <label class="form-check-label" for="rememberMe">Remember Me</label>
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
</body>

</html>
