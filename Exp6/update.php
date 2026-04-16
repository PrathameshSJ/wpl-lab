<?php
include 'db.php'; // Include connection

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Update Logic Process
if (isset($_POST['update'])) {
    $uid = intval($_POST['id']);
    $name = $conn->real_escape_string($_POST['sname']);
    $email = $conn->real_escape_string($_POST['semail']);
    $branch = $conn->real_escape_string($_POST['sbranch']);

    $sql = "UPDATE students SET name='$name', email='$email', branch='$branch' WHERE id=$uid";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch single record for pre-filling the form
$row = [];
if ($id > 0) {
    $result = $conn->query("SELECT * FROM students WHERE id = $id");
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        die("Record not found!");
    }
} else {
    die("Invalid ID");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Student Data</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Update Student Record</h2>
    <form action="update.php" method="POST">
        <!-- Hidden input for ID -->
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        
        <label>Name:</label>
        <input type="text" name="sname" value="<?php echo $row['name']; ?>" required>
        
        <label>Email:</label>
        <input type="email" name="semail" value="<?php echo $row['email']; ?>" required>
        
        <label>Branch:</label>
        <select name="sbranch" required>
            <option value="Computer Engineering" <?php if($row['branch'] == 'Computer Engineering') echo 'selected'; ?>>Computer Engineering</option>
            <option value="Information Technology" <?php if($row['branch'] == 'Information Technology') echo 'selected'; ?>>Information Technology</option>
            <option value="Mechanical Engineering" <?php if($row['branch'] == 'Mechanical Engineering') echo 'selected'; ?>>Mechanical Engineering</option>
        </select>
        
        <button type="submit" name="update" style="background-color: #ff9800;">Update Student</button>
        <a href="index.php" style="display:block; text-align:center; margin-top:10px; color:#1976d2; text-decoration:none;">Cancel</a>
    </form>
</div>

<?php 
// Close database connection
$conn->close();
?>
</body>
</html>
