<?php
// Database connection settings
$host = "localhost";
$username = "root";       // default XAMPP username
$password = "";           // default XAMPP password (empty)
$database = "hostel_db";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
