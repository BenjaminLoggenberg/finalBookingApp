<?php
session_start();
include('config.php');

if (isset($_GET['id'])) {
    $hotelId = $_GET['id'];

      // Set the session variable with the selected hotel ID
      $_SESSION['selected_hotel_id'] = $hotelId;
      $_SESSION['booking_start_date'] = $startDate; // Set with the actual start date value
      $_SESSION['booking_end_date'] = $endDate;     // Set with the actual end date value
      $_SESSION['booking_total_cost'] = $totalCost; // Set with the actual total cost value


    // Query the database to get hotel details
    $query = "SELECT * FROM hotels WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $hotelId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $hotel = mysqli_fetch_assoc($result);

    // Display hotel information and booking form
    if ($hotel) {
        echo '<h1>' . $hotel['name'] . '</h1>';
        echo '<p>' . $hotel['description'] . '</p>';
        echo '<img src="' . $hotel['image'] . '" alt="' . $hotel['name'] . '">';

        // Display a form for booking
        echo '<form method="post" action="confirm_booking.php">';
        echo '<input type="hidden" name="hotel_id" value="' . $hotelId . '">';
        echo 'Start Date: <input type="date" name="start_date" required><br>';
        echo 'End Date: <input type="date" name="end_date" required><br>';
        echo '<button type="submit">Book</button>';
        echo '</form>';
        echo '<a href="index.php">Choose Another Hotel</a>';
    } else {
        echo 'Hotel not found.';
    }
}
?>
<!-- Add any additional HTML or styling as needed -->
<!DOCTYPE html>
<html>
<head>
    <title>View Hotel</title>
</head>
<body>
    <!-- Display hotel details and booking form -->
</body>
</html>
