<?php
include 'db.php'; // Include connection

if (isset($_POST['submit'])) {
    // Sanitize user inputs
    $name = $conn->real_escape_string($_POST['sname']);
    $email = $conn->real_escape_string($_POST['semail']);
    $branch = $conn->real_escape_string($_POST['sbranch']);

    // Insert Query
    $sql = "INSERT INTO students (name, email, branch) VALUES ('$name', '$email', '$branch')";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to main page on success
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
