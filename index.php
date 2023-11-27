<style><?php include 'styles.css'; ?></style>

<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$_SESSION['booking_created'] = false;
include('config.php');



// Fetch hotels from the database
$query = "SELECT * FROM hotels";
$result = mysqli_query($conn, $query);

// Display hotel cards with information


// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, you can either redirect to the login page or display a message.
    // For example, you can uncomment the following line to redirect to the login page:
    // header("Location: login.php");
    // exit();
    echo "<p>Please log in or register to view hotels.</p>";
    echo '<a href="login.php">Login</a>';
    echo '<br>';
    echo '<a href="register.php">Register</a>';
} else {
    echo '<h1>Here are the available hotels:</h1>';
    echo '<div class="hotel-cards-container">';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="hotel-card">';
        echo '<h2>' . $row['name'] . '</h2>';
        echo '<p>' . $row['description'] . '</p>';
        echo '<img src="' . $row['image'] . '" alt="' . $row['name'] . '">';
        echo '<br>';
        echo '<a href="view_hotel.php?id=' . $row['id'] . '">View Details</a>';
        echo '</div>';
    }
    // Add a button/link to view the hotel details
    echo '<div>';
    echo '<a href="logout.php">Logout</a>';
    echo '</div>';
    echo '</div>';
}
?>
<!-- Add any additional HTML or styling as needed -->
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style><?php include 'styles.css'; ?></style>
    <title>Hotel Booking App</title>
</head>
<body>
    <!-- You can add more content here for both logged-in and non-logged-in users -->
</body>
</html>


