<?php
$servername = "localhost";
$username = "root"; // Change if your username differs
$password = ""; // Change if your password differs
$dbname = "Lab_5b";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
