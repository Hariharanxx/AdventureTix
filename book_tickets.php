<?php
session_start();
include 'config.php'; // database connection

// Fetch all rides
$stmt = $conn->prepare("SELECT * FROM rides ORDER BY id DESC");
$stmt->execute();
$rides = $stmt->fetchAll(PDO::FETCH_ASSOC);

// If ride passed through URL
$selectedRide = isset($_GET['ride']) ? $_GET['ride'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book Your Adventure - Adventure Kingdom</title>
    <link rel="stylesheet" href="css/style3.css" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
</head>
<body>
    <div class="booking-container">
        <h1 class="booking-title">🎟️ Book Your Adventure</h1>

        <form action="check.php" method="POST">
            <label for="ride">Select Your Ride:</label>
            <select id="ride" name="ride_name" onchange="updatePrice()" required>
                <option value="">-- Select a Ride --</option>
                <?php foreach ($rides as $ride): ?>
                    <option 
                        value="<?= htmlspecialchars($ride['name']) ?>" 
                        data-price="<?= $ride['price'] ?>"
                        <?= ($ride['name'] == $selectedRide) ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($ride['name']) ?> - ₹<?= $ride['price'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="date">Choose Date:</label>
            <input type="date" id="date" name="date" required />

            <label for="time">Select Time:</label>
            <input type="time" id="time" name="time" required />

            <label for="tickets">Number of Tickets:</label>
            <input type="number" id="tickets" name="ticket_count" min="1" max="10" value="1" required oninput="updatePrice()" />

            <h3>Total Price: ₹<span id="totalPrice">0</span></h3>

            <!-- Hidden field to store amount -->
            <input type="hidden" name="amount" id="amount" value="0" />

            <button type="submit" class="book-btn">Proceed to Payment</button>
        </form>
    </div>

    <script>
        function updatePrice() {
            const ride = document.getElementById("ride");
            const tickets = document.getElementById("tickets").value || 1;
            const selected = ride.options[ride.selectedIndex];
            if (!selected) return;

            const pricePerTicket = selected.getAttribute("data-price") || 0;
            const total = pricePerTicket * tickets;
            document.getElementById("totalPrice").textContent = total;
            document.getElementById("amount").value = total;
        }

        // Call updatePrice once if ride pre-selected
        window.onload = updatePrice;
    </script>
</body>
</html>
