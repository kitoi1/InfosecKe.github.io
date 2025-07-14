<?php
// update_settings.php
session_start();

// Dummy check to simulate logged-in user
if (!isset($_SESSION['user_id'])) {
  header('Location: login.html');
  exit();
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm-password'] ?? '';

$errors = [];

if (empty($name) || empty($email)) {
  $errors[] = "Name and email are required.";
}

if (!empty($password)) {
  if (strlen($password) < 6) {
    $errors[] = "Password must be at least 6 characters.";
  }
  if ($password !== $confirmPassword) {
    $errors[] = "Passwords do not match.";
  }
}

if (empty($errors)) {
  // Simulated DB update logic
  $_SESSION['name'] = $name;
  $_SESSION['email'] = $email;
  if (!empty($password)) {
    $_SESSION['password'] = password_hash($password, PASSWORD_DEFAULT);
  }
  echo "<h2>Settings updated successfully.</h2><a href='settings.html'>Back to Settings</a>";
} else {
  echo "<h2>Error updating settings:</h2><ul>";
  foreach ($errors as $error) {
    echo "<li>$error</li>";
  }
  echo "</ul><a href='settings.html'>Try Again</a>";
}
?>
