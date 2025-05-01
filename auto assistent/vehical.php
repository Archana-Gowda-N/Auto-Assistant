<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "auto_assistant");

// Check for database connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicle_number = $_POST['vehicle_number'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $user_id = $_SESSION['user_id'];

    // Prepare the SQL query
    $stmt = $conn->prepare("INSERT INTO vehicles (user_id, vehicle_number, make, model, year) VALUES (?, ?, ?, ?, ?)");

    // Check if the prepare statement failed
    if ($stmt === false) {
        die('MySQL prepare failed: ' . $conn->error);
    }

    // Bind the parameters and execute the query
    $stmt->bind_param("isssi", $user_id, $vehicle_number, $make, $model, $year);
    if ($stmt->execute()) {
        echo "Vehicle added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<h2>Welcome <?= $_SESSION['name'] ?> | <a href="logout.php">Logout</a></h2>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vehicle Management</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #0a0f2c, #1c2a48);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #ffffff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.05);
            padding: 40px 30px;
            border-radius: 12px;
            width: 350px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(8px);
            margin-bottom: 20px;
        }

        .form-container h3 {
            text-align: center;
            margin-bottom: 25px;
            color: #00d4ff;
        }

        .form-container input,
        .form-container select {
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

        .form-container button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            background-color: #00d4ff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            color: #0a0f2c;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }

        .form-container button:hover {
            background-color: #00b4d8;
        }

        table {
            width: 80%;
            margin-bottom: 3px;
            border-collapse: collapse;
        }

        table, th, td {
    border: 1px solid #ddd;
    text-align: left;
    padding: 8px;
    color: black; /* Set the text color to black */
}

th {
    background-color: #00d4ff;
    color: white; /* Optional: Make the header text white */
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

    </style>
</head>
<body>

    <div class="form-container">
        <h3>Add Vehicle</h3>
        <form method="post">
            <input name="vehicle_number" placeholder="Vehicle Number" required><br>
            <input name="make" placeholder="Make" required><br>
            <input name="model" placeholder="Model" required><br>
            <input name="year" placeholder="Year" type="number" required><br>
            <button type="submit">Add Vehicle</button>
        </form>
    </div>

    <h3>Your Vehicles</h3>
    <table>
        <tr><th>ID</th><th>Vehicle Number</th><th>Make</th><th>Model</th><th>Year</th></tr>

        <?php
        // Query to retrieve all vehicles
        $user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM vehicles WHERE user_id = $user_id ORDER BY id DESC";
        $result = $conn->query($query);

        // Check if query was successful
        if ($result === false) {
            echo "Error: " . $conn->error;
        } else {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['vehicle_number']}</td>
                    <td>{$row['make']}</td>
                    <td>{$row['model']}</td>
                    <td>{$row['year']}</td>
                </tr>";
            }
        }
        ?>
    </table>

</body>
</html>

<?php
$conn->close();
?>
