<?php # Script 9.2 - mysqli_connect.php

// This file contains the database access information.
// This file also establishes a connection to MySQL,
// selects the database, and sets the encoding.

// Set the database access information as constants:
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'bookInventory');
    
// Make the connection:
$conn = new MySQLi(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
// Verify the connection:
if ($conn->connect_error) {
    echo $conn->connect_error;
    unset($conn);
} else { // Establish the encoding.
    $conn->set_charset('utf8');
}