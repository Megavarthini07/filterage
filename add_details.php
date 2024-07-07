<?php
session_start();
require 'db.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $city = $_POST['city'];

    $sql = "INSERT INTO citizens (name, age, city) VALUES ('$name', '$age', '$city')";
    if ($conn->query($sql) === TRUE) {
        $success = "Details added successfully";
    } else {
        $error = "Error: " . $conn->error;
    }
}

$sql = "SELECT * FROM citizens";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Details</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="details-container">
        <h2>Add Details</h2>
        <form method="POST" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>
            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>
            <button type="submit">Add</button>
        </form>
        <?php if (isset($success)) { echo "<p class='success'>$success</p>"; } ?>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <h3>Citizens Details</h3>
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
