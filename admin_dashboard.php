<?php
session_start();
require 'config.php';

// Redirect if not logged in
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch bookings from your table (assume it's 'bookings')
$stmt = $conn->query("SELECT * FROM bookings ORDER BY id DESC");
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard - Adventure Kingdom</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f0f4f8;
      padding: 40px;
    }
    .container {
      max-width: 900px;
      margin: auto;
      background: #fff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 0 12px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #333;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 25px;
    }
    table, th, td {
      border: 1px solid #ddd;
    }
    th, td {
      padding: 12px 15px;
      text-align: center;
    }
    th {
      background: #007bff;
      color: white;
    }
    .logout {
      float: right;
      background: #dc3545;
      color: white;
      padding: 8px 16px;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
    }
    .logout:hover {
      background: #c82333;
    }
  </style>
</head>
<body>

<div class="container">
  <a href="logout.php" class="logout">Logout</a>
  <h2>Admin Dashboard</h2>

  <?php if (count($bookings) > 0): ?>
    <table>
      <tr>
        <th>ID</th>
        <th>Ride</th>
        <th>Date</th>
        <th>Time</th>
        <th>Tickets</th>
        <th>Amount</th>
      </tr>
      <?php foreach ($bookings as $row): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= $row['ride'] ?></td>
          <td><?= $row['date'] ?></td>
          <td><?= $row['time'] ?></td>
          <td><?= $row['tickets'] ?></td>
          <td>₹<?= $row['amount'] ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php else: ?>
    <p>No bookings yet.</p>
  <?php endif; ?>
</div>

</body>
</html>
