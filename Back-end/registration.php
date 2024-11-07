<?php
$host = "localhost:3307"; // Make sure the port is correct
$username = "root";
$password = "";
$dbname = "appointment";

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error);
}

// Log incoming POST data for debugging
file_put_contents('php://stderr', print_r($_POST, TRUE)); // Log POST data to error log

// Check if the required POST parameters are set
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : null; // Get the full name
    $studentnumber = isset($_POST['studentnumber']) ? $_POST['studentnumber'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    $department = isset($_POST['department']) ? $_POST['department'] : null;

    // Check if any of the required fields are null
    if ($fullname === null || $studentnumber === null || $email === null || $password === null || $department === null) {
        echo "Error: Missing required fields.";
        exit();
    }

    // Prepare an SQL statement
    $stmt = $conn->prepare("INSERT INTO tblregistration (fullname, studentnumber, email, password, department) VALUES (?, ?, ?, ?, ?)");

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("sssss", $fullname, $studentnumber, $email, $password, $department);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error; // Output the error if execution fails
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error; // Output the error if preparation fails
    }
} else {
    echo "No POST data received."; // Debugging message
}

$conn->close();
?>