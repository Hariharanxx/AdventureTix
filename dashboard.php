
<?php
session_start();
require 'config.php';

// Fetch total users
$stmtUsers = $conn->query("SELECT COUNT(*) FROM users");
$totalUsers = $stmtUsers->fetchColumn();

// Fetch total bookings
$stmtBookings = $conn->query("SELECT COUNT(*) FROM bookings");
$totalBookings = $stmtBookings->fetchColumn();

// Fetch total revenue
$stmtRevenue = $conn->query("SELECT SUM(amount) FROM bookings");
$totalRevenue = $stmtRevenue->fetchColumn();

// Fetch today's bookings
$today = date('Y-m-d');
$stmtToday = $conn->prepare("SELECT COUNT(*) FROM bookings WHERE date = :today");
$stmtToday->execute(['today' => $today]);
$todaysBookings = $stmtToday->fetchColumn();

// Fetch upcoming bookings
$stmtUpcoming = $conn->prepare("SELECT * FROM bookings WHERE date > :today ORDER BY date ASC LIMIT 3");
$stmtUpcoming->execute(['today' => $today]);
$upcomingBookings = $stmtUpcoming->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Adventure Kingdom</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> <!-- FontAwesome icons -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        header {
            background: linear-gradient(to right, #4facfe, #00f2fe);
            padding: 20px;
            text-align: center;
            color: white;
            font-size: 28px;
            font-weight: bold;
        }
        .dashboard-container {
            padding: 30px;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .stats-container {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }
        .stat-card {
            background: linear-gradient(to right, #4facfe, #00f2fe);
            padding: 25px;
            border-radius: 12px;
            flex: 1;
            color: white;
            text-align: center;
            box-shadow: 0px 6px 15px rgba(0,0,0,0.2);
            transition: transform 0.3s;
        }
        .stat-card:hover {
            transform: scale(1.05);
        }
        .stat-card i {
            margin-bottom: 15px;
        }
        .stat-card h3 {
            margin-bottom: 8px;
            font-size: 22px;
        }
        .stat-card p {
            font-size: 28px;
            font-weight: bold;
        }
        .extra-section {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .extra-section h2 {
            margin-bottom: 20px;
        }
        .upcoming-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .upcoming-table th, .upcoming-table td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }
        .upcoming-table th {
            background: #4facfe;
            color: white;
        }
    </style>
</head>
<body>
<div class="dashboard-container">
    <h2>Dashboard Overview</h2>

    <div class="stats-container">
        <div class="stat-card">
            <i class="fas fa-users fa-3x"></i>
            <h3>Total Users</h3>
            <p><?php echo $totalUsers; ?></p>
        </div>

        <div class="stat-card">
            <i class="fas fa-ticket-alt fa-3x"></i>
            <h3>Total Bookings</h3>
            <p><?php echo $totalBookings; ?></p>
        </div>

        <div class="stat-card">
            <i class="fas fa-rupee-sign fa-3x"></i>
            <h3>Total Revenue</h3>
            <p>₹<?php echo number_format($totalRevenue, 2); ?></p>
        </div>
    </div>
</div>

</body>
</html>
