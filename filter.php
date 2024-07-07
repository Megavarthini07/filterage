<?php
session_start();
require 'db.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$sql = "SELECT * FROM citizens WHERE age < 75";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Filter Age</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="filter-container">
        <h2>Citizens Below Age 75</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>City</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo $row['city']; ?></td>
                </tr>
            <?php } ?>
        </table>
        <button onclick="window.location.href='dashboard.php'">Back</button>
    </div>
</body>
</html>
