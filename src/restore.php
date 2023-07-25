<?php
require_once "./db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } else {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        if (!$user) {
            $error = "Email doesn't exist";
        } else {
            $token = bin2hex(random_bytes(32));
            $resetLink = "https://example.com/reset_password.php?token=" . $token;
            $message = "Click the following link to reset your password: $resetLink";
            $subject = "Password Reset";
            $headers = "From: <sender_email>";
            $success = "Password reset link has been sent to your email";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/login-style.css">
    <link rel="stylesheet" type="text/css" href="css/ResetPass.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-l3UDC6yX4dH47gX2D9GSuMWEV4gK+lfhZ9elOqI9b94Nt1xrgDdpnXrK3y4EMIEiehTvsJlYdoS35f5db7Dy4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand">SchedulerAI</a>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="reset-password-container">
                    <h1>Reset Password</h1>
                    <form method="post" action="">
                        <label>Please enter your account email:</label><br>
                        <input type="email" name="email" required><br><br>
                        <input type="submit" value="Reset Password">
                    </form>
                    <?php if (isset($error)) { ?>
                        <p><?php echo $error; unset($error)?></p>
                    <?php } ?>
                    <?php if (isset($success)) { ?>
                        <p><?php echo $success; unset($success)?></p>
                    <?php } ?>
                    <button onclick="window.location.href='LogIn.php'">Back to Login</button>
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
