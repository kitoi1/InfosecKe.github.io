<?php
// register.php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
  }

  if (strlen($password) < 6) {
    die("Password must be at least 6 characters.");
  }

  $hashed = password_hash($password, PASSWORD_DEFAULT);

  $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");

  try {
    $stmt->execute([$name, $email, $hashed]);
    header("Location: login.html");
    exit();
  } catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062) {
      die("Email already registered.");
    }
    die("Registration failed: " . $e->getMessage());
  }
} else {
  header("Location: register.html");
  exit();
}
?>
