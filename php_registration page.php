<?php

// Connect to the database
$db = new mysqli('localhost', 'username', 'password', 'database_name');

// Check for errors
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Check if the form has been submitted
if (isset($_POST['submit'])) {

    // Collect the user's information from the form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Store the user's information in the database
    $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    $stmt->execute();

    // Redirect the user to the login page
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
</head>
<body>
    <h1>Registration Page</h1>
    <form action="register.php" method="POST">
        <label>Username:</label>
        <input type="text" name="username"><br>
        <label>Email:</label>
        <input type="email" name="email"><br>
        <label>Password:</label>
        <input type="password" name="password"><br>
        <input type="submit" name="submit" value="Register">
    </form>
</body>
</html>
