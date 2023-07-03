<?php require_once "db.php"; ?>
<?php
if (isset($_POST['submit'])) {
    // Retrieve form data
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $email = $_POST['email'];
    $formPassword = $_POST['password'];

    // Prepare and execute the SQL query
    $sql = "INSERT INTO `users` (`firstname`, `lastname`, `email`, `password`) VALUES ('$firstName', '$lastName', '$email', '$formPassword')";

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if ($conn->query($sql) === TRUE) {
        echo "User registered successfully";
        echo "<script>window.location.href = 'LogIn.php';</script>";
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-+J/oNtp7hws/kvPWuV7Xte/6KjVhDB/3vU+q3U8YFmPp72DbK+MfRgB//8r6U2r6HrBwL1BrqDdd6Zs0sZzjg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/SignUp_Style.css">
</head>

<body>
  <header class="header">
    <a class="text-center">Sign Up for SchedulerAI</a>
  </header>

  <main class="container">
    <section class="row">
      <div class="col-md-12">
        <div class="signup-container border border-primary p-4 rounded col-md-6">

          <form id="signup-form" action="" method="POST"> <!-- Added method="POST" -->
            <div class="form-group">
              <label for="first-name">First Name</label>
              <input type="text" class="form-control" id="first-name" name="first-name" placeholder="Enter first name" required>
            </div>
            <div class="form-group">
              <label for="last-name">Last Name</label>
              <input type="text" class="form-control" id="last-name" name="last-name" placeholder="Enter last name" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
              <label for="password">Password <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="right" title="Password must be at least 10 characters long and contain at least one number, one letter, and one symbol (!@#$%^&*)"></i></label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
              <div class="password-strength-indicator">
                <div class="password-strength-bar"></div>
                <div id="password-strength-text"></div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Sign Up</button>
          </form>

        </div>
      </div>
    </section>
  </main>

  <footer class="footer">
    <div class="container">
      <p>&copy; 2023 SchedulerAI</p>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoBtWBmJXpTu0CibVxufeGhjHVNUzoswE8CwN6Jw9" crossorigin="anonymous"></script>

  <!-- Custom JS -->
  <script src="scripts/signup.js"></script>
</body>

</html>
