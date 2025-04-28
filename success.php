<?php
session_start();
require 'config.php';

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

// Save booking to database (only on success)
if (isset($_SESSION['ride']) && isset($_SESSION['amount'])) {
    $stmt = $conn->prepare("INSERT INTO bookings (ride, date, time, tickets, amount) 
                            VALUES (:ride, :date, :time, :tickets, :amount)");
    $stmt->execute([
        'ride' => $_SESSION['ride'],
        'date' => $_SESSION['date'],
        'time' => $_SESSION['time'],
        'tickets' => $_SESSION['tickets'],
        'amount' => $_SESSION['amount']
    ]);
}

// Now Send Email to User
try {
    $mail = new PHPMailer(true);

    // SMTP Settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'hariharanperumal01@gmail.com'; // your Gmail
    $mail->Password   = 'ikgclyxlzsykeepd';   // your App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('yourgmail@gmail.com', 'Adventure Kingdom');
    $mail->addAddress($_SESSION['email']); // send to user's email

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Your Adventure Kingdom Ticket!';
    $mail->Body    = "
    <div style='font-family: Arial, sans-serif; padding: 20px; background: #f9f9f9; border: 2px solid #4facfe; border-radius: 10px;'>
        <h2 style='color: #4facfe;'>Your Adventure Kingdom Ticket</h2>
        <p><strong>Ride:</strong> {$_SESSION['ride']}</p>
        <p><strong>Date:</strong> {$_SESSION['date']}</p>
        <p><strong>Time:</strong> {$_SESSION['time']}</p>
        <p><strong>Tickets:</strong> {$_SESSION['tickets']}</p>
        <p><strong>Total Paid:</strong> ₹{$_SESSION['amount']}</p>
        <br>
        <p style='color: green; font-weight: bold;'>Please show this email at the entrance gate. Enjoy your adventure!</p>
    </div>
";


    $mail->send();
    $emailStatus = "Ticket sent to your Email!";
} catch (Exception $e) {
    $emailStatus = "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Payment Success</title>
  <link rel="stylesheet" href="css/style3.css">
</head>
<body>
  <header>
      <h1>Adventure Kingdom</h1>
  </header>
  
  <div class="booking-container">
    <h1 class="booking-title">Payment Successful!</h1>
    <p>Thank you for booking with Adventure Kingdom!</p>

    <!-- Show Email Status -->
    <p style="color: goldenrod; font-weight: bold;"><?php echo $emailStatus; ?></p>

    <div class="details">
      <p><strong>Ride:</strong> <?php echo $_SESSION['ride']; ?></p>
      <p><strong>Date:</strong> <?php echo $_SESSION['date']; ?></p>
      <p><strong>Time:</strong> <?php echo $_SESSION['time']; ?></p>
      <p><strong>Tickets:</strong> <?php echo $_SESSION['tickets']; ?></p>
      <p><strong>Total Paid:</strong> ₹<?php echo $_SESSION['amount']; ?></p>
    </div>

    <button onclick="downloadTicket()" style="
      background: linear-gradient(to right, #4facfe, #00f2fe);
      color: white;
      border: none;
      padding: 12px 20px;
      font-size: 16px;
      font-weight: bold;
      border-radius: 8px;
      cursor: pointer;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: background 0.3s ease, transform 0.2s ease;
      margin-top: 20px;
    " 
    onmouseover="this.style.background='linear-gradient(to right, #00f2fe, #4facfe)'; this.style.transform='scale(1.05)';" 
    onmouseout="this.style.background='linear-gradient(to right, #4facfe, #00f2fe)'; this.style.transform='scale(1)';">
      Download Ticket
    </button>
  </div>

  <script>
    function downloadTicket() {
      const content = `Adventure Kingdom - Ticket\nRide: <?php echo $_SESSION['ride']; ?>\nDate: <?php echo $_SESSION['date']; ?>\nTime: <?php echo $_SESSION['time']; ?>\nTickets: <?php echo $_SESSION['tickets']; ?>\nAmount Paid: ₹<?php echo $_SESSION['amount']; ?>\nEnjoy your adventure!`;
      const blob = new Blob([content], { type: "text/plain" });
      const url = window.URL.createObjectURL(blob);
      const a = document.createElement("a");
      a.href = url;
      a.download = "ticket.txt";
      a.click();
      window.URL.revokeObjectURL(url);
    }
  </script>
</body>
</html>
