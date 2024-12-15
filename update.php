<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

if (isset($_GET['id'])) {
    $matric = $_GET['id'];

    // Fetch the current user data
    $sql = "SELECT * FROM users WHERE matric = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
    } else {
        die("User not found.");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $accessLevel = $_POST['accessLevel'];

    $sql = "UPDATE users SET name = ?, accessLevel = ? WHERE matric = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $accessLevel, $matric);

    if ($stmt->execute()) {
        header("Location: display.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background-color: #f4f4f4; }
        form { background: #fff; padding: 20px; border-radius: 5px; width: 300px; margin: auto; }
        label, input, button { display: block; width: 100%; margin-bottom: 10px; }
        button { background: #007bff; color: white; border: none; padding: 10px; cursor: pointer; border-radius: 5px; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <h2>Update User</h2>
    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required>

        <label for="accessLevel">Access Level:</label>
        <input type="text" id="accessLevel" name="accessLevel" value="<?php echo $user['accessLevel']; ?>" required>

        <button type="submit">Update</button>
    </form>
</body>
</html>
