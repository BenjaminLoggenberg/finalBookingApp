<?php
$host = 'localhost';
$username = 'your_db_username';
$password = 'your_db_password';
$database = 'your_db_name';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
