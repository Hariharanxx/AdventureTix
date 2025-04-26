<?php
session_start();
require 'config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch all rides
$rides = $conn->query("SELECT * FROM rides ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Rides</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f4f6f8;
      padding: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 0 8px rgba(0,0,0,0.05);
      margin-top: 20px;
    }
    th, td {
      padding: 12px 15px;
      text-align: center;
      border: 1px solid #eee;
    }
    th {
      background: #007bff;
      color: white;
    }
    img {
      width: 80px;
      height: auto;
      border-radius: 6px;
    }
    .delete-btn {
      color: red;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>

<h2>All Rides</h2>

<table>
  <tr>
    <th>ID</th>
    <th>Ride</th>
    <th>Price</th>
    <th>Description</th>
    <th>Image</th>
    <th>Action</th>
  </tr>
  <?php foreach ($rides as $ride): ?>
  <tr>
    <td><?= $ride['id'] ?></td>
    <td><?= $ride['name'] ?></td>
    <td>₹<?= $ride['price'] ?></td>
    <td><?= $ride['description'] ?></td>
    <td><img src="images/rides/<?= $ride['image'] ?>" alt="<?= $ride['name'] ?>"></td>
     <td>
      <a class="delete-btn" href="delete_ride.php?id=<?= $ride['id'] ?>" onclick="return confirm('Are you sure you want to delete this ride?')">Delete</a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>

</body>
</html>
