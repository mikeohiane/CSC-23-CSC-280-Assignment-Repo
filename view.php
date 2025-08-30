<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "student_db_mike");


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete student if requested
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM student_records WHERE id=$id");
    header("Location: view.php");
    exit();
}

// Fetch students
$result = $conn->query("SELECT * FROM student_records");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registered Students</title>
    <link rel="stylesheet" href="style.css">

    <style>
        table, th, td { border: 1px solid black; border-collapse: collapse; padding: 8px; }
    </style>
</head>
<body>
    <h2>Registered Students</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Matric Number</th>
            <th>Action</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['full_name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['department']) ?></td>
            <td><?= htmlspecialchars($row['matric_number']) ?></td>
            <td><a class="delete-btn" href="view.php?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a></td>

        <?php } ?>
    </table>

    <br>
    <a href="index.php">Register Another Student</a>
</body>
</html>

<?php $conn->close(); ?>
