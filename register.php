<?php
include 'config.php';

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // ✅ Check if passwords match
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match!');</script>";
        exit();
    }

    // ✅ Secure password before storing
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // ✅ Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);

    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Email already registered! Try logging in.');</script>";
    } else {
        // ✅ Insert user into the database
        $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password) VALUES (:name, :email, :phone, :password)");
        $insert = $stmt->execute([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $hashedPassword
        ]);

        if ($insert) {
            echo "<script>window.location.href ='login.php';</script>";
            exit();
        } else {
            die("Error: " . implode(" | ", $stmt->errorInfo())); // Show SQL error
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - Adventure Kingdom</title>
    <link rel="stylesheet" href="css/style1.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@300;400;600&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="register-container">
      <h2>Join the Adventure!</h2>
      <p>Sign up to book your thrilling rides!</p>

      <form action="register.php" method="POST">
        <div class="input-group">
          <label for="name">Full Name</label>
          <input type="text" id="name" name="name" required />
        </div>

        <div class="input-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required />
        </div>

        <div class="input-group">
          <label for="phone">Phone Number</label>
          <input type="tel" id="phone" name="phone" required />
        </div>

        <div class="input-group password-container">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required />
        </div>

        <div class="input-group password-container">
          <label for="confirm-password">Confirm Password</label>
          <input
            type="password"
            id="confirm-password"
            name="confirm-password"
            required
          />
        </div>

        <button type="submit" name="register" class="register-btn">Register</button>

      </form>

      <p class="login-link">
        Already have an account? <a href="login.php">Login here</a>
      </p>
    </div>
    <script src="script.js"></script>
  </body>
</html>
