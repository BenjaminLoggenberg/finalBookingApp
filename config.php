<?php
$host = 'localhost';
$username = 'root';
$password = 'root';
$database = 'hotel_bookingapp';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
