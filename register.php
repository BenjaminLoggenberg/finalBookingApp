<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username or email is already in use
    $checkQuery = "SELECT id FROM customers WHERE username=? OR email=?";
    $checkStmt = mysqli_prepare($conn, $checkQuery);
    mysqli_stmt_bind_param($checkStmt, "ss", $username, $email);
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_store_result($checkStmt);

    if (mysqli_stmt_num_rows($checkStmt) > 0) {
        // User with the same username or email already exists
        echo "Username or email already in use.";
    } else {
        // Insert the new user into the database
        $insertQuery = "INSERT INTO customers (username, email, password) VALUES (?, ?, ?)";
        $insertStmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($insertStmt, "sss", $username, $email, $hashedPassword);

        if (mysqli_stmt_execute($insertStmt)) {
            // Registration successful, set session variables
            $_SESSION['user_id'] = mysqli_insert_id($conn);
            header("Location: index.php"); // Redirect to the homepage
            exit();
        } else {
            echo "Registration failed. Please try again later.";
        }
    }
}
?>
<!-- Display the registration form -->
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style><?php include 'styles.css'; ?></style>
</head>
<body>
    <h1>Register</h1>
    <form method="post" action="register.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Register</button>
    </form>
    <a href="login.php">Login</a>
</body>
</html>
