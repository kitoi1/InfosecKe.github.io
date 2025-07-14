<?php
require '../auth_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard – InfoSecKe</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <div class="layout">
    <header>
      <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?> 👋</h1>
      <nav>
        <ul>
          <li><a href="dashboard.php">Dashboard</a></li>
          <li><a href="profile.php">Profile</a></li>
          <li><a href="settings.php">Settings</a></li>
          <li><a href="../logout.php">Logout</a></li>
        </ul>
      </nav>
    </header>

    <main>
      <section>
        <p>You are successfully logged in to your InfoSecKe account.</p>
        <p>Access tools, participate in community, and update your account anytime.</p>
      </section>
    </main>

    <footer>
      <p>&copy; 2025 InfoSecKe. All rights reserved.</p>
    </footer>
  </div>
</body>
</html>
