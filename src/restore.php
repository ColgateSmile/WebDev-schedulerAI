<?php
require_once "./db.php";

<<<<<<< Updated upstream
  // Validate the email (you can add more validation if needed)
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email format";
  } else {
    // Generate a random token
    $token = bin2hex(random_bytes(32));

    // Store the token and email in a database or file
    // This is just a basic example, you should use a secure method to store the token and email
    // For database storage, you can use a library like PDO or mysqli

    // Send the reset link to the user's email
    $resetLink = "https://example.com/reset_password.php?token=" . $token;
    $message = "Click the following link to reset your password: $resetLink";
    $subject = "Password Reset";
    // Replace <sender_email> with the email address from which you want to send the email
    $headers = "From: <sender_email>";

    // Uncomment the following line to send the email (make sure your server is configured to send emails)
    // mail($email, $subject, $message, $headers);

    // Display a success message
    $success = "Password reset link has been sent to your email";
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
<<<<<<< Updated upstream
  <h2>Reset Password</h2>
  
  
  <form method="post" action="">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>
    <input type="submit" value="Reset Password">
  </form>
</body>
</html>
