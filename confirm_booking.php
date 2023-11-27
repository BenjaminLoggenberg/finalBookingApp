<?php
session_start();
include('config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $customerId = $_SESSION['user_id'];
//     $hotelId = $_POST['hotel_id'];
//     $startDate = $_POST['start_date'];
//     $endDate = $_POST['end_date']; // Add this line to retrieve the end date

//     // Query the database to get hotel price per night
//     $priceQuery = "SELECT price_per_night FROM hotels WHERE id=?";
//     $priceStmt = mysqli_prepare($conn, $priceQuery);
//     mysqli_stmt_bind_param($priceStmt, "i", $hotelId);
//     mysqli_stmt_execute($priceStmt);
//     $priceResult = mysqli_stmt_get_result($priceStmt);
//     $priceRow = mysqli_fetch_assoc($priceResult);

//     if ($priceRow) {
//         $pricePerNight = $priceRow['price_per_night'];

//         // Calculate the total cost
//         $totalCost = calculateTotalCost($startDate, $endDate, $pricePerNight);
//         $totalCost = doubleval($totalCost);
        
//         var_dump($customerId, $hotelId, $startDate, $endDate, $totalCost);
// break;


//         // Insert the booking data into the database
//         $insertQuery = "INSERT INTO bookings (customer_id, hotel_id, start_date, end_date, total_cost) VALUES (?, ?, ?, ?, ?)";
//         $insertStmt = mysqli_prepare($conn, $insertQuery);
//         mysqli_stmt_bind_param($insertStmt, "iissd", $customerId, $hotelId, $startDate, $endDate, $totalCost);

//         if (mysqli_stmt_execute($insertStmt)) {
//             // Generate a receipt and save it as a .txt file
//             generateReceipt($customerId, $hotelId, $startDate, $endDate, $totalCost);

//             // Redirect to the checkout
//             header("Location: checkout.php");
//             exit();
//         } else {
//             echo "Booking failed. Please try again later.";
//         }
//     } else {
//         echo "Hotel not found.";
//     }
// }


?>
<!-- Add any additional HTML or styling as needed -->
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style><?php include 'styles.css'; ?></style>
    <title>Confirm Booking</title>
</head>
<body>
    <!-- Display booking details and confirmation message -->
    <h2>Booking Details</h2>
    <p>Start Date: <?php echo $startDate; ?></p>
    <p>End Date: <?php echo $endDate; ?></p>
    <p>Total Cost: $<?php echo $totalCost; ?></p>
    <a href="checkout.php">Confirm Booking</a>
</body>
</html>
