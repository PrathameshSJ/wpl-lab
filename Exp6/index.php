<?php
include 'db.php'; // Include connection

// Check if there is an action (Delete operation)
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $delete_sql = "DELETE FROM students WHERE id = $id";
    if ($conn->query($delete_sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Data Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Student Registration Form (Insert)</h2>
    <form action="insert.php" method="POST">
        <label>Name:</label>
        <input type="text" name="sname" required>
        
        <label>Email:</label>
        <input type="email" name="semail" required>
        
        <label>Branch:</label>
        <select name="sbranch" required>
            <option value="Computer Engineering">Computer Engineering</option>
            <option value="Information Technology">Information Technology</option>
            <option value="Mechanical Engineering">Mechanical Engineering</option>
        </select>
        
        <button type="submit" name="submit">Add Student</button>
    </form>
</div>

<div class="container">
    <h2>Registered Students (Fetch & Display)</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Branch</th>
            <th>Actions</th>
        </tr>
        <?php
        // Fetch query to display data
        $sql = "SELECT id, name, email, branch FROM students";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row['id']."</td>
                        <td>".$row['name']."</td>
                        <td>".$row['email']."</td>
                        <td>".$row['branch']."</td>
                        <td>
                            <a href='update.php?id=".$row['id']."' class='action-btn edit-btn'>Edit</a>
                            <a href='index.php?delete=".$row['id']."' class='action-btn delete-btn' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5' style='text-align:center;'>No records found in database</td></tr>";
        }
        
        // Close database connection
        $conn->close();
        ?>
    </table>
</div>

</body>
</html>
