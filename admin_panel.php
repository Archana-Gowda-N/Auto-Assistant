<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Access denied.");
}

$conn = new mysqli("localhost", "root", "", "auto_assistant");
$result = $conn->query("SELECT br.*, u.name FROM breakdown_requests br JOIN users u ON br.user_id = u.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Breakdown Requests</title>
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
            margin-right: 20px;
        }
        button {
            background-color: #00d4ff;
            color: #0a0f2c;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
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
        .actions form {
            display: inline;
        }
        .actions button {
            background-color: #ff4d4d;
            color: white;
            padding: 6px 12px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            border: none;
            transition: background-color 0.3s;
        }
        .actions button:hover {
            background-color: #e43f3f;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Admin Panel - Manage Breakdown Requests</h2>
    <a href="logout.php"><button>Logout</button></a><br><br>

    <!-- Add buttons for vehicles and shop repair services -->
    <a href="admin_vehicles.php"><button>Manage Vehicles</button></a>
    <a href="admin_repair_services.php"><button>Manage Repair Shop Services</button></a>

    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Vehicle</th>
                <th>Location</th>
                <th>Issue</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['vehicle_number'] ?></td>
                <td><?= $row['location'] ?></td>
                <td><?= $row['issue'] ?></td>
                <td><?= $row['status'] ?></td>
                <td class="actions">
                    <form action="admin_update.php" method="post">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <select name="status">
                            <option <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                            <option <?= $row['status'] == 'Resolved' ? 'selected' : '' ?>>Resolved</option>
                        </select>
                        <button type="submit">Update</button>
                    </form>
                    <form action="admin_delete.php" method="post" onclick="return confirm('Delete this request?')">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

</body>
</html>
