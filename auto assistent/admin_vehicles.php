<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Access denied.");
}

$conn = new mysqli("localhost", "root", "", "auto_assistant");

$result = $conn->query("SELECT * FROM vehicles");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Vehicles</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0a0f2c, #1c2a48);
            color: white;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding-top: 40px;
        }
        h2 {
            text-align: center;
            color: #00d4ff;
            margin-bottom: 20px;
        }
        a {
            text-decoration: none;
            background-color: #00d4ff;
            color: #0a0f2c;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #00b4d8;
        }
        .table-container {
            margin-top: 40px;
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #444;
        }
        th {
            background-color: #2a2a2a;
        }
        tr:nth-child(even) {
            background-color: #1a1a1a;
        }
        tr:hover {
            background-color: #333;
        }
        td {
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage Vehicles</h2>
    <a href="admin_panel.php">Back to Admin Panel</a><br><br>

    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Vehicle Number</th>
                <th>Make</th>
                <th>Model</th>
                <th>Year</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['user_id'] ?></td>
                <td><?= $row['vehicle_number'] ?></td>
                <td><?= $row['make'] ?></td>
                <td><?= $row['model'] ?></td>
                <td><?= $row['year'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

</body>
</html>
