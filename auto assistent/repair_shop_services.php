<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "auto_assistant");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicle = $_POST['vehicle'];
    $location = $_POST['location'];
    $issue = $_POST['issue'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO breakdown_requests (user_id, vehicle_number, location, issue) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $vehicle, $location, $issue);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Auto Assistant - Breakdown Request</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #0a0f2c, #1c2a48);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #ffffff;
        }

        /* Banner Section */
        .service-banner {
            position: relative;
            background: url('https://images.pexels.com/photos/4489730/pexels-photo-4489730.jpeg?auto=compress&cs=tinysrgb&w=1200') center center / cover no-repeat;
            color: white;
            padding: 100px 20px;
            text-align: center;
        }

        .service-banner .overlay {
            background: rgba(0, 0, 0, 0.6);
            padding: 60px 20px;
            border-radius: 12px;
            max-width: 900px;
            margin: auto;
        }

        .service-banner h4 {
            color: #ff4c60;
            letter-spacing: 2px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .service-banner h1 {
            font-size: 36px;
            font-weight: 700;
            line-height: 1.4;
            color: #fff;
        }

        .service-banner p {
            color: #ccc;
            margin: 10px auto 30px;
            font-size: 16px;
            max-width: 700px;
        }

        .service-banner .stats {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .service-banner .stats div {
            font-size: 18px;
            margin: 10px 20px;
            font-weight: 500;
        }

        .service-banner .stats strong {
            font-size: 32px;
            color: #00d4ff;
            display: block;
        }

        /* Welcome */
        h2 {
            text-align: center;
            margin-top: 20px;
            color: #00d4ff;
        }

        /* Form Styling */
        .breakdown-form-container {
            background: rgba(255, 255, 255, 0.05);
            padding: 40px 30px;
            border-radius: 12px;
            width: 350px;
            margin: 40px auto 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(8px);
            text-align: center;
        }

        .breakdown-form-container h3 {
            margin-bottom: 25px;
            color: #00d4ff;
        }

        .breakdown-form-container input,
        .breakdown-form-container textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            background: rgba(255,255,255,0.15);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 14px;
            outline: none;
        }

        .breakdown-form-container textarea {
            resize: none;
            height: 80px;
        }

        .breakdown-form-container button {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            background-color: #00d4ff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            color: #0a0f2c;
            cursor: pointer;
            font-weight: bold;
        }

        .breakdown-form-container button:hover {
            background-color: #00b4d8;
        }

        /* Table Styling */
        h3 {
            text-align: center;
            margin-top: 40px;
            color: #00d4ff;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            color: white;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #444;
        }

        table th {
            background-color: #00d4ff;
            color: #0a0f2c;
        }

        table tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.1);
        }

        table tr:hover {
            background-color: rgba(0, 212, 255, 0.2);
        }
    </style>
</head>
<body>

    <!-- Service Banner -->
    <section class="service-banner">
        <div class="overlay">
            <h4>OUR CUSTOMISATION</h4>
            <h1>Auto Assistance Matched with Great<br> Workmanship</h1>
            <p>Our skilled technicians and support team take pride in delivering top-tier roadside help and servicing for your vehicle — anywhere, anytime.</p>
            <div class="stats">
                <div><strong>65</strong>Total Requests</div>
                <div><strong>165</strong>Transparency</div>
                <div><strong>463</strong>Resolved Cases</div>
                <div><strong>5063</strong>Happy Customers</div>
            </div>
        </div>
    </section>

    <!-- Welcome & Logout -->
    <h2>Welcome <?= htmlspecialchars($_SESSION['name']) ?> | <a style="color:#00d4ff;" href="logout.php">Logout</a></h2>

    <!-- Breakdown Form -->
    <div class="breakdown-form-container">
        <h3>Submit Breakdown Request</h3>
        <form method="post">
            <input name="vehicle" placeholder="Vehicle Number" required>
            <input name="location" id="location" placeholder="Location" required>
            <textarea name="issue" placeholder="Describe issue" required></textarea>
            <button type="submit">Submit Request</button>
        </form>
    </div>

    <!-- Breakdown Requests Table -->
    <h3>Your Breakdown Requests</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Vehicle</th>
            <th>Location</th>
            <th>Issue</th>
            <th>Status</th>
            <th>Time</th>
        </tr>
        <?php
        $user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM breakdown_requests WHERE user_id = $user_id ORDER BY id DESC";
        $result = $conn->query($query);

        if ($result !== false) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>" . htmlspecialchars($row['vehicle_number']) . "</td>
                    <td>" . htmlspecialchars($row['location']) . "</td>
                    <td>" . htmlspecialchars($row['issue']) . "</td>
                    <td>" . htmlspecialchars($row['status']) . "</td>
                    <td>" . (isset($row['created_at']) ? $row['created_at'] : 'N/A') . "</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Error loading requests.</td></tr>";
        }
        ?>
    </table>

    <script>
        // Autofill location from Geolocation
        navigator.geolocation.getCurrentPosition(function(position) {
            const loc = `${position.coords.latitude}, ${position.coords.longitude}`;
            document.getElementById("location").value = loc;
        });
    </script>

</body>
</html>
