<?php

// Connect to the database
$db = new mysqli('localhost', 'username', 'password', 'database_name');

// Check for errors
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Generate a random reference number for the ticket
$reference_number = rand(100000, 999999);

// Store the ticket information in the database
$stmt = $db->prepare("INSERT INTO tickets (user_id, departure, destination, transport_type, price, reference_number) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssis", $user_id, $departure, $destination, $transport_type, $price, $reference_number);
$stmt->execute();

// Get the price of the ticket from the database
$stmt = $db->prepare("SELECT price FROM tickets WHERE reference_number = ?");
$stmt->bind_param("i", $reference_number);
$stmt->execute();
$stmt->bind_result($price);
$stmt->fetch();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Confirmation Page</title>
</head>
<body>
    <h1>Thank you for your purchase!</h1>
    <p>Your reference number is: <?php echo $reference_number; ?></p>
    <p>The total cost of your ticket is: £<?php echo $price; ?></p>
</body>
</html>
