<?php
session_start();

// Connect to the database
$conn = new mysqli("localhost", "root", "", "auto_assistant");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define predefined admin credentials (stored in the database)
    $admin_email = "admin@gmail.com";  // Replace with actual email
    $admin_password = "chetuu@2003";  // Replace with actual password

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if entered credentials match predefined admin credentials
    if ($email == $admin_email && $password == $admin_password) {
        // Set session variable and redirect to admin panel
        $_SESSION['role'] = 'admin';
        $_SESSION['user_id'] = 1;  // Admin user ID, if required
        header("Location: admin_panel.php");
        exit();
    } else {
        $error = "Invalid admin credentials.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <style>
        /* Style for the login form */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0a0f2c, #1c2a48);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        .login-form {
            background: rgba(255, 255, 255, 0.05);
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.5);
            width: 320px;
            backdrop-filter: blur(8px);
        }
        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #00d4ff;
        }
        .login-form input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 6px;
            background: rgba(255,255,255,0.2);
            color: white;
            font-size: 15px;
        }
        .login-form button {
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
        .login-form button:hover {
            background-color: #00b4d8;
        }
        .error-message {
            color: #ff4d4d;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <form method="post" class="login-form">
        <h2>Admin Login</h2>
        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>

</body>
</html>
