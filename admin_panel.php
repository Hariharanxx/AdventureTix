<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: adminlog.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Panel - Adventure Kingdom</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Poppins', sans-serif;
      display: flex;
      height: 100vh;
      background: #f0f2f5;
    }
    header {
      position: fixed;
      width: 100%;
      height: 60px;
      background: #007bff;
      color: white;
      text-align: center;
      line-height: 60px;
      font-size: 22px;
      font-weight: 600;
      top: 0;
      z-index: 100;
    }
    .sidebar {
      width: 220px;
      background: #1a1a2e;
      padding-top: 80px;
      height: 100vh;
      color: white;
      position: fixed;
    }
    .sidebar a {
      display: block;
      padding: 15px 25px;
      color: #ddd;
      text-decoration: none;
      transition: 0.3s;
    }
    .sidebar a:hover {
      background: #16213e;
      color: #fff;
    }
    .content {
      margin-left: 220px;
      margin-top: 60px;
      padding: 30px;
      width: 100%;
    }
    .card {
      background: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
      margin-bottom: 20px;
    }
    iframe {
      width: 100%;
      height: 600px;
      border: none;
    }
  </style>
</head>
<body>

<header>Adventure Kingdom Admin Panel</header>

<div class="sidebar">
  <a href="dashboard.php" target="adminContent">Dashboard</a>
  <a href="view_users.php" target="adminContent">View Users</a>
  <a href="view_bookings.php" target="adminContent">View Bookings</a> <!-- spelling corrected -->
  <a href="manage_rides.php" target="adminContent">Manage Rides</a>
  <a href="view_rides_admin.php" target="adminContent">View All Rides</a>
  <a href="logout.php">Logout</a>
</div>

<div class="content">
  <div class="card">
    <iframe name="adminContent" src="dashboard.php"></iframe> <!-- HERE: changed from admin_dashboard.php to dashboard.php -->
  </div>
</div>

</body>
</html>
