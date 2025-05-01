<?php
session_start();

if ($_SESSION['role'] != 'shop') {
    die("Access denied.");
}

$conn = new mysqli("localhost", "root", "", "auto_assistant");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch breakdown requests for the shop
$shop_id = $_SESSION['user_id'];
$query = "SELECT br.*, u.name FROM breakdown_requests br
          JOIN users u ON br.user_id = u.id
          WHERE br.status = 'Pending'";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Repair Shop Dashboard</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #0a0f2c, #1c2a48);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #ffffff;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

        h2 {
            margin-top: 20px;
            color: #00d4ff;
            text-align: center;
        }

        a {
            color: #00d4ff;
            text-decoration: none;
            font-size: 16px;
            margin-top: 10px;
            display: inline-block;
            text-align: center;
        }

        a:hover {
            color: #00b4d8;
        }

        table {
            width: 90%;
            margin-top: 30px;
            border-collapse: collapse;
            color: white;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #00d4ff;
            text-transform: uppercase;
        }

        table tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.1);
        }

        table tr:hover {
            background-color: rgba(0, 212, 255, 0.2);
        }

        table form select {
            padding: 5px;
            background-color: rgba(255, 255, 255, 0.15);
            border: none;
            border-radius: 5px;
            color: white;
        }

        table form button {
            padding: 5px 12px;
            background-color: #00d4ff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            color: #0a0f2c;
            font-weight: bold;
            transition: background 0.3s;
        }

        table form button:hover {
            background-color: #00b4d8;
        }

        /* Centering content */
        .content-container {
            width: 80%;
            max-width: 1200px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<div class="content-container">
    <h2>Repair Shop Dashboard</h2>
    <a href="logout.php">Logout</a>

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

        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['vehicle_number'] ?></td>
            <td><?= $row['location'] ?></td>
            <td><?= $row['issue'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <form method="post" action="shop_update.php">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <select name="status">
                        <option <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                        <option <?= $row['status'] == 'Resolved' ? 'selected' : '' ?>>Resolved</option>
                        <option <?= $row['status'] == 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <!-- Navigation to Repair Services page -->
    <div class="navigation-link">
        <a href="shop_repair_services.php">Go to Repair Services</a>
    </div>
</div>

<?php
$conn->close();
?>

</body>
</html>
