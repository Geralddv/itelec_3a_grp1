<?php
// Step 1: Connect to the database
$servername = "localhost"; // Change to your DB host
$username = "root"; // Change to your DB username
$password = ""; // Change to your DB password
$dbname = "appointment"; // Change to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Step 2: Fetch student data (assuming you have a session with student ID)
session_start();
$student_id = $_SESSION['student_id']; // Assuming you have logged in and stored the student ID in session

$sql = "SELECT * FROM students WHERE id = '$student_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Fetch the student's data
  $student = $result->fetch_assoc();
} else {
  echo "No student found.";
  exit;
}

// Step 3: Handle form submission (e.g., logout)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Logout logic
  session_destroy();
  header("Location: login.php"); // Redirect to login page after logout
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Profile</title>
</head>

<body>
  <nav class="navbar">
    <a href="#" class="navbar-logo">
      <img src="pictures/logo.png" alt="Logo" />
    </a>
  </nav>

  <div class="form-container-wrapper">
    <div class="form-container">
      <h2>Student Profile</h2>

      <!-- Profile Image and Edit Button -->
      <div class="profile-container">
        <img id="profile-image" src="pictures/user.png" alt="Student Image" />
        <div class="file-input-wrapper">
          <input
            type="file"
            id="image-upload"
            name="image-upload"
            accept="image/*"
            onchange="previewImage(event)" />
          <label for="image-upload">Edit</label>
        </div>
      </div>

      <!-- Step 4: Populate the form with PHP -->
      <form action="" method="post">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($student['full_name']); ?>" />

        <label for="student-no">Student Number:</label>
        <input type="text" id="student-no" name="student-no" value="<?php echo htmlspecialchars($student['student_number']); ?>" />

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" />

        <label for="department">Department:</label>
        <input type="text" id="department" name="department" value="<?php echo htmlspecialchars($student['department']); ?>" />

        <!-- Logout button -->
        <button type="submit">Logout</button>
      </form>
    </div>
  </div>

  <script>
    function previewImage(event) {
      const file = event.target.files[0]; // Get the selected file
      const reader = new FileReader();

      reader.onload = function() {
        const image = document.getElementById("profile-image");
        image.src = reader.result; // Update the image source to the selected file
      };

      if (file) {
        reader.readAsDataURL(file); // Read the file as a data URL (base64)
      }
    }
  </script>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>