<?php
session_start();
include('config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$startDate = "";
$endDate = "";
$totalCost = "";

if (isset($_GET['id'])) {
    $hotelId = $_GET['id'];
    echo "The 'id' parameter is present in the URL.";
    // Check if the user has submitted a booking form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        echo "A form has been submitted (POST request).";
        // Retrieve user-selected start and end dates
        $startDate = $_POST['start_date'];
        $endDate = $_POST['end_date'];


        // Set these values in the session
    $_SESSION['booking_start_date'] = $startDate;
    $_SESSION['booking_end_date'] = $endDate ;
      $_SESSION['booking_total_cost'] = $totalCost;
      $_SESSION['selected_hotel_id'] = $hotelId;
    }
}

// Query the database to get hotel details
$query = "SELECT * FROM hotels WHERE id=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $hotelId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$hotel = mysqli_fetch_assoc($result);

if ($hotel) {
    echo '<h1>' . $hotel['name'] . '</h1>';
    echo '<p>' . $hotel['description'] . '</p>';
    echo '<img src="' . $hotel['image'] . '" alt="' . $hotel['name'] . '">';
    // Display a form for booking with the correct session variables
    echo '<form method="POST" action="checkout.php">';
    echo '<input type="hidden" name="hotel_id" value="' . $hotelId . '">';
    echo 'Start Date: <input type="date" name="start_date" value="' . $startDate . '" required><br>';
    echo 'End Date: <input type="date" name="end_date" value="' . $endDate . '" required><br>';
    echo '<input type="hidden" name="booking_start_date" value="' . $startDate . '">';
    echo '<input type="hidden" name="booking_end_date" value="' . $endDate . '">';
    echo '<input type="hidden" name="booking_total_cost" value="' . $totalCost . '">';
    echo '<button type="submit">Book</button>';
    echo '</form>';
    echo '<a href="index.php">Choose Another Hotel</a>';
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
</head>
<body>
    <!-- Display hotel details and booking form -->
</body>
</html>
