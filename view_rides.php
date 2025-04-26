<?php
session_start();
require 'config.php';

// Fetch all rides
$stmt = $conn->query("SELECT * FROM rides ORDER BY id DESC");
$rides = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>All Rides - Adventure Kingdom</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/animations.css" />
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
</head>
<body>
<style>
  .book-now-btn {
    background: linear-gradient(to right,rgb(255, 252, 95), #feb47b);
    color: white;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    border: none;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
  }

  .book-now-btn:hover {
    background: linear-gradient(to right,rgb(215, 254, 123), #ff7e5f);
    transform: scale(1.1);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
  }
</style>
<!-- HEADER (Optional) -->
<header>
  <h1>Adventure Kingdom</h1>
  <nav>
  </nav>
</header>

<!-- RIDES SECTION -->
<section class="ride-container" style="margin-top: 80px;">
  <?php foreach ($rides as $ride): ?>
    <div class="ride-card">
      <img src="images/rides/<?= htmlspecialchars($ride['image']) ?>" alt="<?= htmlspecialchars($ride['name']) ?>">
      <h3><?= htmlspecialchars($ride['name']) ?></h3>
      <p><?= htmlspecialchars($ride['description']) ?></p>
      <a href="book_tickets.php?ride=<?= urlencode($ride['name']) ?>" class="btn book-now-btn" style="margin-top:10px; display:inline-block; " >Book Now</a>

    </div>
  <?php endforeach; ?>
</section>

<!-- FOOTER -->
<footer>
  <p>&copy; <?php echo date("Y"); ?> Adventure Kingdom. All Rights Reserved.</p>
  <div class="social-icons">
    <a href="#">Facebook</a>
    <a href="#">Instagram</a>
    <a href="#">Twitter</a>
  </div>
</footer>

<script src="js/script.js"></script>
</body>
</html>
