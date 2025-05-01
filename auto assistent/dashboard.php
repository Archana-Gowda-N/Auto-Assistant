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

<h2>Welcome <?= $_SESSION['name'] ?> | <a href="logout.php">Logout</a></h2>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Breakdown Request</title>
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
            text-align: center;
            margin-top: 20px;
            color: #00d4ff;
        }

        .breakdown-form-container {
            background: rgba(255, 255, 255, 0.05);
            padding: 40px 30px;
            border-radius: 12px;
            width: 350px;
            margin-top: 30px;
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

        .breakdown-form-container input::placeholder,
        .breakdown-form-container textarea::placeholder {
            color: #ccc;
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
            transition: background 0.3s;
        }

        .breakdown-form-container button:hover {
            background-color: #00b4d8;
        }

        .navigation {
            margin-top: 20px;
        }

        .navigation p {
            text-align: center;
        }

        .navigation a {
            color: #00d4ff;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
        }

        .navigation a:hover {
            color: #00b4d8;
        }

        /* Table styling */
        table {
            width: 80%;
            margin-top: 40px;
            border-collapse: collapse;
            color: white;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #00d4ff;
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

    <div class="breakdown-form-container">
        <h3>Submit Breakdown Request</h3>
        <form method="post">
            <input name="vehicle" placeholder="Vehicle Number" required><br>
            <input name="location" id="location" placeholder="Location" required><br>
            <textarea name="issue" placeholder="Describe issue" required></textarea><br>
            <button type="submit">Submit Request</button>
        </form>

        
    </div>

    <!-- Link to navigate to Repair Services -->
   

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

        // Execute the query to get breakdown requests
        $query = "SELECT * FROM breakdown_requests WHERE user_id = $user_id ORDER BY id DESC";
        $result = $conn->query($query);

        // Check if the query was successful
        if ($result === false) {
            // If there was an error with the query, display the error
            echo "Error: " . $conn->error;
        } else {
            // Fetch and display the results
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['vehicle_number']}</td>
                    <td>{$row['location']}</td>
                    <td>{$row['issue']}</td>
                    <td>{$row['status']}</td>";

                // Check if the 'created_at' field exists
                if (isset($row['created_at'])) {
                    echo "<td>{$row['created_at']}</td>";
                } else {
                    // If 'created_at' is not available, display a default message or leave it blank
                    echo "<td>Not available</td>";
                }

                echo "</tr>";
            }
        }
        ?>
    </table>

</body>
</html>

<script>
navigator.geolocation.getCurrentPosition(function(position) {
    const loc = `${position.coords.latitude}, ${position.coords.longitude}`;
    document.getElementById("location").value = loc;
});
</script>
