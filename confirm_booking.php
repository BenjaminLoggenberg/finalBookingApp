<?php
session_start();
include('config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerId = $_SESSION['user_id'];
    $hotelId = $_POST['hotel_id'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date']; // Add this line to retrieve the end date

    // Query the database to get hotel price per night
    $priceQuery = "SELECT price_per_night FROM hotels WHERE id=?";
    $priceStmt = mysqli_prepare($conn, $priceQuery);
    mysqli_stmt_bind_param($priceStmt, "i", $hotelId);
    mysqli_stmt_execute($priceStmt);
    $priceResult = mysqli_stmt_get_result($priceStmt);
    $priceRow = mysqli_fetch_assoc($priceResult);

    if ($priceRow) {
        $pricePerNight = $priceRow['price_per_night'];

        // Calculate the total cost
        $totalCost = calculateTotalCost($startDate, $endDate, $pricePerNight);

        // Insert the booking data into the database
        $insertQuery = "INSERT INTO bookings (customer_id, hotel_id, start_date, end_date, total_cost) VALUES (?, ?, ?, ?, ?)";
        $insertStmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($insertStmt, "iisss", $customerId, $hotelId, $startDate, $endDate, $totalCost);

        if (mysqli_stmt_execute($insertStmt)) {
            // Generate a receipt and save it as a .txt file
            generateReceipt($customerId, $hotelId, $startDate, $endDate, $totalCost);

            // Redirect to the checkout
            header("Location: checkout.php");
            exit();
        } else {
            echo "Booking failed. Please try again later.";
        }
    } else {
        echo "Hotel not found.";
    }
}

// Function to calculate total cost
function calculateTotalCost($startDate, $endDate, $pricePerNight) {
    // Calculate the number of nights between start and end dates
    $start = new DateTime($startDate);
    $end = new DateTime($endDate);
    $interval = $start->diff($end);
    $numNights = $interval->days;

    // Calculate the total cost
    return $numNights * $pricePerNight;
}

// Function to generate and save a booking receipt
function generateReceipt($customerId, $hotelId, $startDate, $endDate, $totalCost) {
    // Generate the receipt content
    $receiptContent = "Booking Details:\n";
    $receiptContent .= "Customer ID: $customerId\n";
    $receiptContent .= "Hotel ID: $hotelId\n";
    $receiptContent .= "Start Date: $startDate\n";
    $receiptContent .= "End Date: $endDate\n";
    $receiptContent .= "Total Cost: $totalCost\n";

    // Generate a unique filename (e.g., using timestamp)
    $filename = "receipt_" . time() . ".txt";

    // Save the receipt as a .txt file
    file_put_contents($filename, $receiptContent);
}
?>
<!-- Add any additional HTML or styling as needed -->
<!DOCTYPE html>
<html>
<head>
    <title>Confirm Booking</title>
</head>
<body>
    <!-- Display booking details and confirmation message -->
    <h2>Booking Details</h2>
    <p>Start Date: <?php echo $startDate; ?></p>
    <p>End Date: <?php echo $endDate; ?></p>
    <p>Total Cost: $<?php echo $totalCost; ?></p>
</body>
</html>
