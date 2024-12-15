<?php
session_start(); // Start session

if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
?>

<?php
include 'db.php'; // Include the database connection file

// Start a session to restrict access if required later
session_start();

// Fetch data from the `users` table
$sql = "SELECT matric, name, accessLevel FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }
        th {
            background: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">User List</h2>

    <table>
        <thead>
            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Access Level</th>
            </tr>
        </thead>
        <tbody>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['matric']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['accessLevel']}</td>
                    <td>
                        <a href='update.php?id={$row['matric']}'>Update</a> |
                        <a href='delete.php?id={$row['matric']}' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No users found</td></tr>";
    }
    ?>
</tbody>

    </table>
</body>
</html>
