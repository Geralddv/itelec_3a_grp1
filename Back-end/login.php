<?php
$host = "localhost:3307"; // Ensure the port is correct
$username = "root";
$password = "";
$dbname = "appointment";

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["success" => false, "error" => "Connection failed: " . $conn->connect_error]));
}

// Check if the required POST parameters are set
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentnumber = isset($_POST['studentnumber']) ? $_POST['studentnumber'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    // Check if any of the required fields are null
    if ($studentnumber === null || $password === null) {
        echo json_encode(["success" => false, "error" => "Missing required fields"]);
        exit();
    }

    // Prepare an SQL statement to select the user
    $stmt = $conn->prepare("SELECT fullname FROM tblregistration WHERE studentnumber = ? AND password = ?");
    
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("ss", $studentnumber, $password);

        // Execute the statement
        $stmt->execute();

        // Bind the result to a variable
        $stmt->bind_result($fullname);

        // Check if a record was found
        if ($stmt->fetch()) {
            // Return success with student details
            echo json_encode([
                "success" => true,
                "studentnumber" => $studentnumber,
                "fullname" => $fullname
            ]);
        } else {
            echo json_encode(["success" => false, "error" => "Invalid student number or password"]);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "error" => "Error preparing statement: " . $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}

$conn->close();
?>
