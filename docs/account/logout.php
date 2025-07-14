<?php
// logout.php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to logout confirmation page
header("Location: account/logout.html");
exit();
?>
