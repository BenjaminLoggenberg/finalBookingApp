<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Query the database to fetch the user's bookings
// Display a list of bookings with options to cancel or generate receipts
?>
<!DOCTYPE html>
<html>
<head>
<style><?php include 'styles.css'; ?></style>
    <title>Bookings</title>
</head>
<body>
    <h1>Your Bookings</h1>
    <!-- Display a list of bookings -->
</body>
</html>
