<?php
// login.php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
  $stmt->execute([$email]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    header("Location: dashboard.html");
    exit();
  } else {
    die("Invalid email or password.");
  }
} else {
  header("Location: login.html");
  exit();
}
?>
