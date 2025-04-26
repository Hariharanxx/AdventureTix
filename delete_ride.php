<?php
session_start();
require 'config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete ride
    $stmt = $conn->prepare("DELETE FROM rides WHERE id = :id");
    $stmt->execute(['id' => $id]);

    header("Location: view_rides_admin.php");
    exit();
}
?>
