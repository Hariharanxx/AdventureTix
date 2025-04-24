<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book Your Adventure - Adventure Kingdom</title>
    <link rel="stylesheet" href="css/style3.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@300;400;600&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="booking-container">
      <h1 class="booking-title">🎟️ Book Your Adventure</h1>

      <form action="check.php" method="POST">
        <label for="ride">Select Your Ride:</label>
        <select id="ride" name="ride" onchange="updatePrice()">
          <option value="sky-fury" data-price="500">🎢 The Sky Fury - ₹500</option>
          <option value="golden-wheel" data-price="300">🎡 The Golden Wheel - ₹300</option>
          <option value="storm-surge" data-price="400">💦 Storm Surge - ₹400</option>
        </select>

        <label for="date">Choose Date:</label>
        <input type="date" id="date" name="date" required />

        <label for="time">Select Time:</label>
        <input type="time" id="time" name="time" required />

        <label for="tickets">Number of Tickets:</label>
        <input
          type="number"
          id="tickets"
          name="tickets"
          min="1"
          max="10"
          value="1"
          required
          oninput="updatePrice()"
        />

        <h3>Total Price: ₹<span id="totalPrice">500</span></h3>

        <!-- Hidden fields to send calculated data -->
        <input type="hidden" name="amount" id="amount" value="500" />
        <input type="hidden" name="ride_name" id="ride_name" value="The Sky Fury" />
        <input type="hidden" name="ticket_count" id="ticket_count" value="1" />
        
        <button type="submit" class="book-btn">Proceed to Payment</button>
      </form>
    </div>

    <script>
      function updatePrice() {
        const ride = document.getElementById("ride");
        const tickets = document.getElementById("tickets").value || 1;
        const selected = ride.options[ride.selectedIndex];
        const pricePerTicket = selected.getAttribute("data-price");
        const rideName = selected.text;

        const total = pricePerTicket * tickets;
        document.getElementById("totalPrice").textContent = total;
        document.getElementById("amount").value = total;
        document.getElementById("ride_name").value = rideName;
        document.getElementById("ticket_count").value = tickets;
      }
    </script>
  </body>
</html>
