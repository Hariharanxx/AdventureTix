<?php
session_start();
require 'config.php';

if (!isset($_SESSION['admin'])) {
  header("Location: admin_login.php");
  exit();
}

$stmt = $conn->query("SELECT * FROM users ORDER BY id DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Users</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f5f5f5;
      padding: 20px;
    }
    h2 {
      color: #333;
      margin-bottom: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    th, td {
      padding: 12px 15px;
      text-align: center;
      border: 1px solid #ddd;
    }
    th {
      background: #007bff;
      color: white;
    }
    tr:hover {
      background: #f1f1f1;
    }
  </style>
</head>
<body>

  <h2>Registered Users</h2>

  <?php if (count($users) > 0): ?>
    <table>
      <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone</th>
      </tr>
      <?php foreach ($users as $user): ?>
        <tr>
          <td><?= $user['id'] ?></td>
          <td><?= $user['name'] ?></td>
          <td><?= $user['email'] ?></td>
          <td><?= $user['phone'] ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php else: ?>
    <p>No users found.</p>
  <?php endif; ?>

</body>
</html>
