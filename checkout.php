<?php
session_start();

$appId = "TEST10578187173a3c7e3cd2b94a774c78187501";
$secretKey = "cfsk_ma_test_5377185047201c2952890fb4d07fb73f_17c7ac9c";

$ride = $_POST['ride_name'];
$date = $_POST['date'];
$time = $_POST['time'];
$tickets = $_POST['ticket_count'];
$amount = $_POST['amount'];
$orderId = "ORD" . rand(1000, 9999);

$data = [
  "order_id" => $orderId,
  "order_amount" => $amount,
  "order_currency" => "INR",
  "customer_details" => [
    "customer_id" => "CUST123",
    "customer_email" => "test@example.com",
    "customer_phone" => "9999999999"
  ],
  "order_meta" => [
    "return_url" => " https://c4c9-2401-4900-606b-f115-39d1-20a-6e7a-3c6e.ngrok-free.app/AdventureTix/success.php?order_id={$orderId}"
  ]
];

$payload = json_encode($data);
$timestamp = round(microtime(true) * 1000);
$signature = hash_hmac('sha256', $payload, $secretKey, false);



$headers = [
  "Content-Type: application/json",
  "x-api-version: 2022-09-01",
  "x-client-id: $appId",
  "x-request-id: " . uniqid(),
  "x-signature: $signature"
];

$ch = curl_init("https://sandbox.cashfree.com/pg/orders");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

$response = curl_exec($ch);
curl_close($ch);

$res = json_decode($response, true);

if (isset($res['payment_link'])) {
  header("Location: " . $res['payment_link']);
  exit();
} else {
  echo "<h3>Something went wrong. Please try again.</h3>";
  echo "<pre>";
  print_r($res);
  echo "</pre>";
}
