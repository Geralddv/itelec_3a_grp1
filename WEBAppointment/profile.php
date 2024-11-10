<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "appointment"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


session_start();
$student_id = $_SESSION['student_id']; 

$sql = "SELECT * FROM students WHERE id = '$student_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  
  $student = $result->fetch_assoc();
} else {
  echo "No student found.";
  exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  session_destroy();
  header("Location: login.php"); 
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

      
      <form action="" method="post">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($student['full_name']); ?>" />

        <label for="student-no">Student Number:</label>
        <input type="text" id="student-no" name="student-no" value="<?php echo htmlspecialchars($student['student_number']); ?>" />

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" />

        <label for="department">Department:</label>
        <input type="text" id="department" name="department" value="<?php echo htmlspecialchars($student['department']); ?>" />

        
        <button type="submit">Logout</button>
      </form>
    </div>
  </div>

  <script>
    function previewImage(event) {
      const file = event.target.files[0]; 
      const reader = new FileReader();

      reader.onload = function() {
        const image = document.getElementById("profile-image");
        image.src = reader.result; 
      };

      if (file) {
        reader.readAsDataURL(file);
      }
    }
  </script>
</body>

</html>

<?php

$conn->close();
?>