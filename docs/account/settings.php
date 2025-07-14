<?php
require '../auth_check.php';
require '../db.php';

$stmt = $pdo->prepare("SELECT name, email FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Settings – InfoSecKe</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <div class="layout">
    <header>
      <h1>Account Settings</h1>
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
      <form action="update_settings.php" method="POST">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label for="password">New Password</label>
        <input type="password" name="password" id="password" placeholder="Leave blank to keep current">

        <button type="submit">Update Settings</button>
      </form>
    </main>

    <footer>
      <p>&copy; 2025 InfoSecKe. All rights reserved.</p>
    </footer>
  </div>
</body>
</html>
