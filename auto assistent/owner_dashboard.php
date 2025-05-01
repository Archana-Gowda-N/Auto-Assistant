<?php
session_start();

// Check if user is logged in and is an owner
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'owner') {
    header("Location: login.php");
    exit("Access denied.");
}

// Handle breakdown submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input to avoid security issues
    $user_id = $_SESSION['user_id'];
    $vehicle_number = $_POST['vehicle_number'];
    $issue = $_POST['issue'];
    $location = $_POST['location'];

    // Database connection
    $conn = new mysqli("localhost", "root", "", "auto_assistant");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert breakdown request into the database
    $stmt = $conn->prepare("INSERT INTO breakdown_requests (user_id, vehicle_number, issue, location) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $vehicle_number, $issue, $location);

    if ($stmt->execute()) {
        $breakdown_id = $stmt->insert_id;

        // Notify all repair shops
        $shop_result = $conn->query("SELECT id FROM users WHERE role = 'shop'");
        if ($shop_result) {
            while ($shop_row = $shop_result->fetch_assoc()) {
                $shop_id = $shop_row['id'];
                $message = "New breakdown request for vehicle $vehicle_number at $location.";
                
                // Insert notification for each shop
                $notification_stmt = $conn->prepare("INSERT INTO notifications (breakdown_id, shop_id, message) VALUES (?, ?, ?)");
                $notification_stmt->bind_param("iis", $breakdown_id, $shop_id, $message);
                $notification_stmt->execute();
                $notification_stmt->close();
            }
        }

        echo "<p style='color:green;'>Breakdown reported successfully. Repair shops have been notified.</p>";
    } else {
        echo "<p style='color:red;'>Error: Could not report the breakdown. Please try again.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- Breakdown Reporting Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report a Breakdown - Auto Assistant</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #141e30, #243b55);
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        h2, h3 {
            text-align: center;
            margin: 10px 0;
        }

        a {
            color: #00d4ff;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.05);
            padding: 40px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.7);
            width: 400px;
            margin-top: 20px;
        }

        form input[type="text"],
        form textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid #00d4ff;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            outline: none;
        }

        form textarea {
            resize: none;
            height: 100px;
        }

        form button {
            width: 100%;
            padding: 12px;
            background-color: #00d4ff;
            border: none;
            color: #0a0f2c;
            font-weight: bold;
            font-size: 18px;
            border-radius: 8px;
            margin-top: 15px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        form button:hover {
            background-color: #00b4d8;
        }
    </style>
</head>
<body>

<h2>Welcome <?= htmlspecialchars($_SESSION['name']) ?> | <a href="logout.php">Logout</a></h2>

<div class="form-container">
    <h3>Report a Breakdown</h3>
    <form method="post">
        <input type="text" name="vehicle_number" placeholder="Vehicle Number" required><br>
        <textarea name="issue" placeholder="Describe the issue" required></textarea><br>
        <input type="text" name="location" placeholder="Location" required><br>
        <button type="submit">Report Breakdown</button>
    </form>
</div>

</body>
</html>

