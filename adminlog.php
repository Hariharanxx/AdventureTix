<?php
session_start();
require 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check admin credentials
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin'] = $admin['username'];
        header("Location: admin_panel.php");
        exit();
    } else {
        $error = "Invalid login credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login - Adventure Kingdom</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #6a11cb, #2575fc);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .login-box {
      background: #fff;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.2);
      width: 400px;
    }
    .login-box h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #444;
    }
    .login-box label {
      font-weight: 600;
    }
    .login-box input[type="text"],
    .login-box input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 8px 0 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    .login-box button {
      width: 100%;
      padding: 12px;
      background: #2575fc;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }
    .login-box button:hover {
      background: #1e63d1;
    }
    .error {
      color: red;
      text-align: center;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>
 <header style="
  background: linear-gradient(to right, #4facfe,rgb(254, 0, 199));
  padding: 20px;
  text-align: center;
  color: white;
  font-size: 28px;
  font-family: 'Playfair Display', serif;
  font-weight: bold;
  letter-spacing: 1px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 1000;
">
  Adventure Kingdom Admin Panel
</header>
<div class="login-box">
  <h2>Admin Login</h2>

  <?php if ($error): ?>
    <div class="error"><?php echo $error; ?></div>
  <?php endif; ?>

  <form method="POST" action="">
    <label for="username">Username</label>
    <input type="text" name="username" required />

    <label for="password">Password</label>
    <input type="password" name="password" required />

    <button type="submit">Login</button>
  </form>
</div>

</body>
</html>
