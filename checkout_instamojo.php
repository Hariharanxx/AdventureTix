<?php
session_start();

// Get data from the form
$ride = $_POST['ride_name'];
$date = $_POST['date'];
$time = $_POST['time'];
$tickets = $_POST['ticket_count'];
$amount = $_POST['amount'];

// Store in session to show in success page (optional)
$_SESSION['ride'] = $ride;
$_SESSION['date'] = $date;
$_SESSION['time'] = $time;
$_SESSION['tickets'] = $tickets;
$_SESSION['amount'] = $amount;

// Your Instamojo Payment Link (replace this)
$instamojoLink = "https://imjo.in/px8BYV"; // <-- Replace with your actual Instamojo link

// Redirect to Instamojo
header("Location: $instamojoLink");
exit();
