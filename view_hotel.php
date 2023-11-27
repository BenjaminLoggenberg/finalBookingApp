<?php
session_start();
include('config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$startDate = "";
$endDate = "";
$totalCost = "";

// set session based on Hotel ID 
if (isset($_GET['id'])) {
    $hotelId = $_GET['id'];
    echo "The 'id' parameter is present in the URL.";
    $_SESSION['selected_hotel_id'] = $hotelId;
    var_dump($_SESSION['selected_hotel_id']);
    // Check if the user has submitted a booking form
}
//This runs if the hotel booking form is submitted
if (isset($_POST['submit_form'])) {

    echo "A form has been submitted (POST request).";
    // Retrieve user-selected start and end dates
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];


    // Set these values in the session
$_SESSION['booking_start_date'] = $startDate;
$_SESSION['booking_end_date'] = $endDate ;
  $_SESSION['booking_total_cost'] = $totalCost;
  header("Location: checkout.php");
}

// Query the database to get hotel details
$query = "SELECT * FROM hotels WHERE id=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $hotelId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$hotel = mysqli_fetch_assoc($result);

if ($hotel) {
    echo '<div class=hotel-book-container>';
    echo '<h1>' . $hotel['name'] . '</h1>';
    echo '<p>' . $hotel['description'] . '</p>';
    echo '<img src="' . $hotel['image'] . '" alt="' . $hotel['name'] . '">';
    // Display a form for booking with the correct session variables
    echo '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
    echo '<input type="hidden" name="hotel_id" value="' . $hotelId . '">';
    echo 'Start Date: <input type="date" name="start_date" value="' . $startDate . '" required><br>';
    echo 'End Date: <input type="date" name="end_date" value="' . $endDate . '" required><br>';
    echo '<input type="hidden" name="booking_start_date" value="' . $startDate . '">';
    echo '<input type="hidden" name="booking_end_date" value="' . $endDate . '">';
    echo '<input type="hidden" name="booking_total_cost" value="' . $totalCost . '">';
    echo '<button type="submit" name="submit_form" value="true">Book</button>';
    echo '</form>';
    echo '<a href="index.php">Choose Another Hotel</a>';
    echo '</div>';
} else {
    echo 'Hotel not found.';
}
?>
<!-- Add any additional HTML or styling as needed -->
<!DOCTYPE html>
<html>
<head>
    <title>View Hotel</title>
    <style><?php include 'styles.css'; ?></style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <!-- Display hotel details and booking form -->
</body>
</html>
