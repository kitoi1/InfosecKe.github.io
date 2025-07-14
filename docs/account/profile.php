<?php
require '../auth_check.php';
require '../db.php';

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile – InfoSecKe</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <div class="layout">
    <header>
      <h1>Your Profile</h1>
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
        <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Registered:</strong> <?php echo htmlspecialchars($user['created_at']); ?></p>
      </section>
    </main>

    <footer>
      <p>&copy; 2025 InfoSecKe. All rights reserved.</p>
    </footer>
  </div>
</body>
</html>
