~<?php
$host = "localhost:3307"; // Ensure the port is correct
$username = "root";
$password = "";
$dbname = "appointment";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['professor']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['purpose'])) {
    $professor = $conn->real_escape_string($_POST['professor']);
    $date = $conn->real_escape_string($_POST['date']);
    $time = $conn->real_escape_string($_POST['time']);
    $purpose = $conn->real_escape_string($_POST['purpose']);

    // Convert the date from DD/MM/YYYY to YYYY-MM-DD
    $dateParts = explode('/', $date);
    if (count($dateParts) == 3) {
        $date = $dateParts[2] . '-' . str_pad($dateParts[1], 2, '0', STR_PAD_LEFT) . '-' . str_pad($dateParts[0], 2, '0', STR_PAD_LEFT);
    } else {
        die("Invalid date format");
    }

    $sql = "INSERT INTO tblcenarcappointment (professor, date, time, purpose) VALUES ('$professor', '$date', '$time', '$purpose')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New appointment created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Required fields are missing";
}

$conn->close();
?>