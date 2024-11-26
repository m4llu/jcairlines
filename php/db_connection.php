<?php
// Database connection settings
$servername = "localhost:3307";  // Host
$username = "root";              // MySQL username (default in XAMPP is 'root')
$password = "";                  // MySQL password (default in XAMPP is empty)
$dbname = "db";              // Database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>