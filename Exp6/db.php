<?php
// Establish PHP-MySQL connection
$host = "localhost";
$user = "root";       // Default XAMPP username
$pass = "";           // Default XAMPP password is empty
$dbname = "wpl_lab";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
