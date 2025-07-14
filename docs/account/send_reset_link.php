<?php
// send_reset_link.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'] ?? '';

  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Simulate sending reset email (in production, use mail() or PHPMailer)
    echo "<h2>Password reset link sent to $email</h2>";
    echo "<p>Please check your inbox. If you don’t receive an email, check your spam folder.</p>";
    echo "<a href='login.html'>Return to Login</a>";
  } else {
    echo "<h2>Invalid email address.</h2>";
    echo "<a href='forgot-password.html'>Try Again</a>";
  }
} else {
  header('Location: forgot-password.html');
  exit();
}
?>
