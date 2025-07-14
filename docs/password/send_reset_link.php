<?php
// password/send_reset_link.php
require '../db.php';
require '../config.php';
require '../vendor/autoload.php'; // Make sure PHPMailer is installed via Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email']);

  $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
  $stmt->execute([$email]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user) {
    // Generate reset token
    $token = bin2hex(random_bytes(32));
    $resetLink = $BASE_URL . "/password/reset-password.html?token=$token";

    // Setup PHPMailer
    $mail = new PHPMailer(true);
    try {
      $mail->isSMTP();
      $mail->Host       = $MAIL_CONFIG['host'];
      $mail->SMTPAuth   = true;
      $mail->Username   = $MAIL_CONFIG['username'];
      $mail->Password   = $MAIL_CONFIG['password'];
      $mail->SMTPSecure = $MAIL_CONFIG['smtp_secure'];
      $mail->Port       = $MAIL_CONFIG['port'];

      $mail->setFrom($MAIL_CONFIG['from_email'], $MAIL_CONFIG['from_name']);
      $mail->addAddress($email, $user['name']);

      $mail->isHTML(true);
      $mail->Subject = 'Reset Your Password';
      $mail->Body    = "<p>Hi {$user['name']},</p>
                        <p>Click the link below to reset your password:</p>
                        <p><a href='$resetLink'>$resetLink</a></p>
                        <p>If you didn't request this, please ignore it.</p>";

      $mail->send();

      header("Location: ../forgot-password.html?sent=1");
      exit();

    } catch (Exception $e) {
      echo "<p>Email could not be sent. Mailer Error: {$mail->ErrorInfo}</p>";
    }

  } else {
    header("Location: ../forgot-password.html?error=1");
    exit();
  }
} else {
  header("Location: ../forgot-password.html");
  exit();
}
?>
