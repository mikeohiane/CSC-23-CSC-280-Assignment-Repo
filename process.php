<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "student_db_mike");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get inputs
$full_name = trim($_POST['full_name']);
$email = trim($_POST['email']);
$department = trim($_POST['department']);
$matric_number = trim($_POST['matric_number']);

// Validation
if (empty($full_name) || empty($email) || empty($department) || empty($matric_number)) {
    die("All fields are required.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}

// Insert into DB
$stmt = $conn->prepare("INSERT INTO student_records (full_name, email, department, matric_number) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $full_name, $email, $department, $matric_number);

if ($stmt->execute()) {
    echo "Student registered successfully. <a href='view.php'>View Students</a>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
