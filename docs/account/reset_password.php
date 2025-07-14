<?php
// reset_password.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $password = $_POST['password'] ?? '';
  $confirm = $_POST['confirm-password'] ?? '';
  $token = $_POST['token'] ?? '';

  // Simulated token check (you would normally validate this against DB)
  if ($token !== 'sampletoken123') {
    echo "<h2>Invalid or expired reset token.</h2><a href='forgot-password.html'>Try again</a>";
    exit();
  }

  if (strlen($password) < 6) {
    echo "<h2>Password must be at least 6 characters long.</h2><a href='reset-password.html'>Try again</a>";
    exit();
  }

  if ($password !== $confirm) {
    echo "<h2>Passwords do not match.</h2><a href='reset-password.html'>Try again</a>";
    exit();
  }

  // Simulate password update
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  echo "<h2>Password successfully reset.</h2><p><a href='login.html'>Return to login</a></p>";

} else {
  header('Location: reset-password.html');
  exit();
}
?>
