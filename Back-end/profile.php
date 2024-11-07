<?php
// Database connection parameters
$host = "localhost:3307";
$db_name = "appointment";
$username = "root";
$password = "";

// Connect to the database
$conn = new mysqli($host, $username, $password, $db_name);

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get student_number from the request
$studentnumber = $_GET['studentnumber'];

// Prepare and execute the SQL statement
$sql = "SELECT fullname, studentnumber, email, department FROM tblregistration WHERE studentnumber = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $studentnumber);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo json_encode($user);
} else {
    echo json_encode(["error" => "User not found"]);
}

$stmt->close();
$conn->close();
?>
