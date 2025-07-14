<?php
// password/send_reset_link.php
require '../db.php';
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email']);
  
  // Lookup user
  $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
  $stmt->execute([$email]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user) {
    // Generate reset token (not stored in DB in this version)
    $token = bin2hex(random_bytes(32));

    // Simulate sending the link
    $resetLink = $BASE_URL . "/password/reset-password.html?token=$token";

    echo "<p>Reset link (simulated): <a href='$resetLink'>$resetLink</a></p>";
    echo "<p>Check your email inbox (if mail is set up).</p>";
  } else {
    echo "<p>Email not found.</p>";
  }
} else {
  header("Location: ../forgot-password.html");
  exit();
}
?>
