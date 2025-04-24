<?php
session_start();

// Store form data
$_SESSION['ride'] = $_POST['ride_name'];
$_SESSION['date'] = $_POST['date'];
$_SESSION['time'] = $_POST['time'];
$_SESSION['tickets'] = $_POST['ticket_count'];
$_SESSION['amount'] = $_POST['amount'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Secure Payment</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background:rgba(240, 240, 245, 0);
    }
    .payment-box {
      max-width: 500px;
      margin: 50px auto;
      background: #fff;
      padding: 25px 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #444;
    }
    label {
      font-weight: 500;
      margin-top: 15px;
      display: block;
    }
    select, button {
      width: 100%;
      padding: 12px;
      margin-top: 8px;
      font-size: 16px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    button {
      background: #28a745;
      color: white;
      border: none;
      cursor: pointer;
      margin-top: 25px;
    }
    button:hover {
      background: #218838;
    }
    .summary {
      margin-top: 20px;
      background:rgba(248, 248, 250, 0);
      padding: 15px;
      border-radius: 6px;
    }
    .summary p {
      margin: 8px 0;
      font-weight: 500;
      color: #000;
    }
  </style>
</head>
<body>

  <div class="payment-box">
    <h2>Secure Payment</h2>

    <div class="summary">
      <p>Ride: <?php echo $_SESSION['ride']; ?></p>
      <p>Date: <?php echo $_SESSION['date']; ?></p>
      <p>Time: <?php echo $_SESSION['time']; ?></p>
      <p>Tickets: <?php echo $_SESSION['tickets']; ?></p>
      <p>Amount to Pay: ₹<?php echo $_SESSION['amount']; ?></p>
    </div>

    <form action="success.php" method="POST">
      <label for="payment-method">Select Payment Method</label>
      <select name="payment-method" id="payment-method" required>
        <option value="">-- Select Payment Method --</option>
        <option value="upi">UPI</option>
        <option value="card">Credit / Debit Card</option>
        <option value="netbanking">Net Banking</option>
        <option value="wallet">Wallet (Paytm, PhonePe)</option>
      </select>

      <button type="submit">Pay Now</button>
    </form>
  </div>

</body>
</html>
