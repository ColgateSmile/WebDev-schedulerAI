<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the email from the form
  $email = $_POST["email"];

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
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Reset Password</title>
</head>
<body>
  <h2>Reset Password</h2>
  
  <?php if (isset($error)) { ?>
    <p><?php echo $error; ?></p>
  <?php } ?>
  
  <?php if (isset($success)) { ?>
    <p><?php echo $success; ?></p>
  <?php } ?>
  
  <form method="post" action="">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>
    <input type="submit" value="Reset Password">
  </form>
</body>
</html>