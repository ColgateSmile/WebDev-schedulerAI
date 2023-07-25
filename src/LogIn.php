<?php
session_start();

$isLoggedIn = isset($_SESSION['user']);

if ($isLoggedIn) {
    echo "<script>window.location.href = 'index.php';</script>";
    exit;
}

$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rememberMe = isset($_POST['rememberMe']) && $_POST['rememberMe'] === 'on';

    $server_xampp = 'localhost';
    $server_docker = 'db';
    $username = 'root';
    $db_password = '';
    $database = '312148489_207037227';
        
    $conn = new mysqli($server_xampp, $username, $db_password, $database);

    if ($conn->connect_error) {
        $conn = new mysqli($server_docker, $username, $db_password, $database);
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }
    }

    $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $dbPassword = $row['password'];

        if ($password === $dbPassword) {
            $_SESSION['user'] = true;
            $_SESSION['username'] = $row['firstname'] . " " . $row['lastname'];
            $_SESSION['email'] = $row['email'];

            if ($rememberMe) {
                $cookieExpiration = time() + (30 * 24 * 60 * 60); // 30 days
                setcookie('rememberMe', $email, $cookieExpiration);
            }

            echo "<script>window.location.href = 'index.php';</script>";
            exit;
        }
    }

    $errorMsg = 'Invalid email or password!';

    $stmt->close();
    $conn->close();
}
?>
<?php
  require_once "./db.php"
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/login-style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-l3UDC6yX4dH47gX2D9GSuMWEV4gK+lfhZ9elOqI9b94Nt1xrgDdpnXrK3y4EMIEiehTvsJlYdoS35f5db7Dy4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
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
            <button type="submit" class="btn btn-primary mt-3 d-flex justify-content-center">Login</button>
            <div class="forgot-signup mt-3 d-flex justify-content-center">
              <button type="button" class="btn btn-link mr-2" onclick="window.location.href = 'restore.php';">Forgot password?</button>
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

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGi/7SfCypdtkWr+0nx384Zk+5T0Ukre/WRS" crossorigin="anonymous"></script>
</body>

</html>
