<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Delete the remember me cookie if it exists
if (isset($_COOKIE['remember_me'])) {
    $cookie_name = 'remember_me';
    setcookie($cookie_name, '', time() - 3600, '/');
}

// Redirect to the login page
header("Location: LogIn.php");
exit();
?>

