<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

if (isset($_GET['id'])) {
    $matric = $_GET['id'];

    $sql = "DELETE FROM users WHERE matric = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $matric);

    if ($stmt->execute()) {
        header("Location: display.php");
        exit();
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}
?>
