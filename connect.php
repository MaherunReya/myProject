<?php
// connect.php

$host = 'localhost';      // Database host (usually localhost)
$user = 'root';           // Database username (default in XAMPP is 'root')
$pass = '';               // Database password (default is empty)
$db = 'safenari_db';      // YOUR database name (you want to use safenari_db)

$conn = new mysqli($host, $user, $pass, $db);

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>
