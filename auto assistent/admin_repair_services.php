<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Access denied.");
}

$conn = new mysqli("localhost", "root", "", "auto_assistant");

$result = $conn->query("SELECT * FROM repair_shop_services");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Repair Shop Services</title>
    <style>
        body {
            margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: 
        linear-gradient(rgba(10, 15, 44, 0.85), rgba(28, 42, 72, 0.85)),
        url('https://media.istockphoto.com/id/1892181739/photo/cars-open-bonnet-with-laptop-placed-next-to-engine-in-the-auto-repair-shop.webp?a=1&b=1&s=612x612&w=0&k=20&c=rcVyrua9H9If2Uw9mxphkSJQx7ZshyfmjhA0okaEHyc=') no-repeat center center fixed;
        background-size: cover;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
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
    <h2>Manage Repair Shop Services</h2>
    <a href="admin_panel.php">Back to Admin Panel</a><br><br>

    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Shop ID</th>
                <th>Service Type</th>
                <th>Price Range</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['shop_id'] ?></td>
                <td><?= $row['service_type'] ?></td>
                <td><?= $row['price_range'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

</body>
</html>
