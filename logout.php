<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page (you can change the URL to your actual login page)
header("Location: login.php");
exit();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logged Out</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style><?php include 'styles.css'; ?></style>
</head>
<body>
    <h1>You have been successfully logged out.</h1>
    <p><a href="login.php">Log in again</a></p>
</body>
</html>
