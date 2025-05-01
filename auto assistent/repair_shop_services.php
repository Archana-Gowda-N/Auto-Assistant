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
    $shop_id = $_POST['shop_id'];
    $service_type = $_POST['service_type'];
    $price_range = $_POST['price_range'];

    // Prepare the SQL query
    $stmt = $conn->prepare("INSERT INTO repair_shop_services (shop_id, service_type, price_range) VALUES (?, ?, ?)");

    // Check if the prepare statement failed
    if ($stmt === false) {
        die('MySQL prepare failed: ' . $conn->error);
    }

    // Bind the parameters and execute the query
    $stmt->bind_param("iss", $shop_id, $service_type, $price_range);
    if ($stmt->execute()) {
        echo "Service added successfully!";
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
    <title>Repair Shop Services</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #0a0f2c, #1c2a48);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
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
        .form-container textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            background: rgba(255,255,255,0.15);
            border: none;
            border-radius: 8px;
            color: black;
            font-size: 14px;
            outline: none;
        }

        .form-container button {
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

        .form-container button:hover {
            background-color: #00b4d8;
        }

        table {
            width: 80%;
            margin-top: 20px;
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
        <h3>Add Repair Shop Service</h3>
        <form method="post">
            <input name="shop_id" placeholder="Shop ID" required><br>
            <input name="service_type" placeholder="Service Type" required><br>
            <input name="price_range" placeholder="Price Range" required><br>
            <button type="submit">Submit Service</button>
        </form>
    </div>

    <h3>Repair Shop Services</h3>
    <table>
        <tr><th>ID</th><th>Shop ID</th><th>Service Type</th><th>Price Range</th></tr>

        <?php
        // Query to retrieve all services
        $query = "SELECT * FROM repair_shop_services ORDER BY id DESC";
        $result = $conn->query($query);

        // Check if query was successful
        if ($result === false) {
            echo "Error: " . $conn->error;
        } else {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['shop_id']}</td>
                    <td>{$row['service_type']}</td>
                    <td>{$row['price_range']}</td>
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
