<?php
// Database connection variables
$servername = "localhost:3307";  // MySQL server address
$username = "root";         // MySQL username
$password = "";             // MySQL password
$dbname = "appointment";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully"; // Optional: Confirm successful connection
}
?>