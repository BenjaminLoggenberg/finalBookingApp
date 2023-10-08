<?php
session_start();
include('config.php');

// Fetch hotels from the database
$query = "SELECT * FROM hotels";
$result = mysqli_query($conn, $query);

// Display hotel cards with information
while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="hotel-card">';
    echo '<h2>' . $row['name'] . '</h2>';
    echo '<p>' . $row['description'] . '</p>';
    echo '<img src="' . $row['image'] . '" alt="' . $row['name'] . '">';
    // Add a button/link to view the hotel details
    echo '<a href="view_hotel.php?id=' . $row['id'] . '">View Details</a>';
    echo '</div>';
}

// Implement login/logout button based on user session
if (isset($_SESSION['user_id'])) {
    echo '<a href="logout.php">Logout</a>';
} else {
    echo '<a href="login.php">Login</a>';
}
?>
