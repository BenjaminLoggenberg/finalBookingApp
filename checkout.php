<?php
session_start();
include('config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ .'/functions/functions.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Retrieve the hotel and booking details from session or database
if (isset($_SESSION['selected_hotel_id'])) {

    $hotelId = $_SESSION['selected_hotel_id'];

    $query = "SELECT * FROM hotels WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $hotelId);
    
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $hotel = mysqli_fetch_assoc($result);
        
        if ($hotel) {
            // Rest of the code to display hotel details
            // ...
        } else {
            echo 'Hotel details could not be fetched from the database. LINE 32';
        }
    } else {
        echo 'Error executing the database query Line 35: ' . mysqli_error($conn);
    }
} else {
    // Handle the case where hotel details are not available
    echo "Hotel details not found. Line 39";
    exit();
}

// Retrieve user details based on the session
$userId = $_SESSION['user_id'];
$query = "SELECT * FROM customers WHERE id=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

// Handle form submission for booking confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Insert the booking data into the database
    $startDate = $_SESSION['booking_start_date'];
    $endDate = $_SESSION['booking_end_date'];
    $totalCost = calculateTotalCost($_SESSION['booking_start_date'], $_SESSION['booking_end_date'], $hotel['price_per_night']);

    $query = "INSERT INTO bookings (customer_id, hotel_id, start_date, end_date, total_cost) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "iissi", $userId, $hotelId, $startDate, $endDate, $totalCost);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['booking_created'] = true;
        // Booking successful, you can redirect to a confirmation page or display a success message
        // Optionally, generate a receipt and perform other actions
        echo "<h1>Booking Successful!</h1>";
        echo "<p>Your booking has been confirmed.</p>";
        echo '<a href="index.php">Return To Home</a>';
        // You can provide a link to the user's bookings or return to the homepage
    } else {
        // Handle booking failure
        echo "<p>Booking failed. Please try again later.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style><?php include 'styles.css'; ?></style>
    <title>Checkout</title>
</head>
<body>

<?php
    if ($_SESSION['booking_created'] == FALSE){
?>
      <h1>Checkout</h1>
<?php }?>


    <!-- Display customer details -->
    <h2>Customer Details</h2>
    <p>Name: <?php echo $user['username']; ?></p>
    <p>Email: <?php echo $user['email']; ?></p>

    <!-- Display hotel details -->
    <h2>Hotel Details</h2>
    <p>Hotel Name: <?php echo $hotel['name']; ?></p>
    <p>Description: <?php echo $hotel['description']; ?></p>
    <p>Price Per Night: $<?php echo $hotel['price_per_night']; ?></p>

    <!-- Display booking details -->
    <h2>Booking Details</h2>
    <p>Start Date: <?php echo $_SESSION['booking_start_date']; ?></p>
    <p>End Date: <?php echo $_SESSION['booking_end_date']; ?></p>
    <p>Total Cost: $<?php echo calculateTotalCost($_SESSION['booking_start_date'], $_SESSION['booking_end_date'], $hotel['price_per_night']); ?></p>

<?php
    if ($_SESSION['booking_created'] == FALSE){
?>
    <!-- Provide a button to confirm the booking -->
    <form method="post">
        <button type="submit">Confirm Booking</button>
    </form>
<?php }?>
</body>
</html>
