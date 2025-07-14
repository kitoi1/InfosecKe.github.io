use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

$mail = new PHPMailer(true);
$mail->setFrom('support@infosecke.ke', 'InfoSecKe Support');
$mail->addAddress($email);
$mail->Subject = 'Password Reset';
$mail->Body    = "Click to reset: https://yourdomain/reset-password.php?token=$token";
$mail->send();
