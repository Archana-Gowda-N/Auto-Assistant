<?php
$conn = new mysqli("localhost", "root", "", "auto_assistant");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $role);

    if ($stmt->execute()) {
        echo "<p class='success-message'>Registration successful. <a href='login.php'>Login here</a></p>";
    } else {
        echo "<p class='error-message'>Error: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Auto Assistant - Register</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: 
            /* linear-gradient(rgba(10, 15, 44, 0.85), rgba(28, 42, 72, 0.85)), */
            url('https://media.istockphoto.com/id/1347150429/photo/professional-mechanic-working-on-the-engine-of-the-car-in-the-garage.webp?a=1&b=1&s=612x612&w=0&k=20&c=I9kCVeGbPl3yrto59PFC7ErW8i27mJ1pD5ohzdBADFI=') 
            no-repeat center center fixed;
            background-size: cover;
       
            /* background: linear-gradient(135deg, #0a0f2c, #1c2a48); */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        .register-form {
            background: rgba(255, 255, 255, 0.05);
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.5);
            width: 320px;
            backdrop-filter: blur(8px);
            text-align: center;
        }
        .register-form h2 {
            margin-bottom: 20px;
            color: #00d4ff;
        }
        .register-form input,
        .register-form select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 6px;
            background: rgba(255,255,255,0.2);
            color: white;
            font-size: 15px;
        }
        .register-form input::placeholder,
        .register-form select option {
            color: #dcdcdc;
        }
        .register-form button {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            background-color: #00d4ff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            color: #0a0f2c;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }
        .register-form button:hover {
            background-color: #00b4d8;
        }

        .admin-login-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #ff6600;
            padding: 10px 15px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .admin-login-btn:hover {
            background-color: #ff4500;
        }

        /* Error and success message styles */
        .error-message {
            color: #ff4d4d;
            text-align: center;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .success-message {
            color: #4caf50;
            text-align: center;
            font-size: 16px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <!-- Admin login button -->
    <a href="admin_login.php">
        <button class="admin-login-btn">Admin Login</button>
    </a>

    <form method="post" class="register-form">
        <h2>Register</h2>
        
        <!-- Display Error or Success Messages -->
        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
        
        <input type="text" name="name" placeholder="Full Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <select name="role" required>
            <option value="" disabled selected>Select Role</option>
            <option value="owner">Vehicle Owner</option>
            <option value="shop">Repair Shop</option>
        </select><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
