<?php
session_start();
require 'config.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists in the database
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, start session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $email;
        // Redirect to homepage or dashboard
        header("Location: view_rides.php");
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Adventure Kingdom</title>
    <link rel="stylesheet" href="css/style2.css" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet"/>
</head>
<body>
    <div class="login-container">
        <h2>Welcome Back!</h2>
        <p>Login to continue your adventure</p>

        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>

        <form action="login.php" method="POST">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required />
            </div>

            <div class="input-group password-container">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required />
            </div>

            <button type="submit" class="login-btn">Login</button>
        </form>

        <p class="register-link">
            Don't have an account? <a href="register.php">Register here</a>
        </p>
    </div>

    <script src="script.js"></script> <!-- Include JavaScript -->
</body>
</html>
