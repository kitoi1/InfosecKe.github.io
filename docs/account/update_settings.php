<?php
require '../auth_check.php';
require '../db.php';

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = $_POST['password'];

if (empty($name) || empty($email)) {
  die("Name and email are required.");
}

$updateQuery = "UPDATE users SET name = ?, email = ?";
$params = [$name, $email];

if (!empty($password)) {
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  $updateQuery .= ", password = ?";
  $params[] = $hashedPassword;
}

$updateQuery .= " WHERE id = ?";
$params[] = $_SESSION['user_id'];

$stmt = $pdo->prepare($updateQuery);
$stmt->execute($params);

header("Location: settings.php?success=1");
exit();
?>
