<?php
session_start();

// Connect to the database
$conn = new mysqli("localhost", "root", "", "auto_assistant");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $email = strtolower(trim($_POST['email'])); // Ensure case-insensitive comparison
    $password = $_POST['password'];

    // Prepare and execute SQL query
    $stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $name, $hashedPassword, $role);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashedPassword)) {
            // Password matched, set session variables
            $_SESSION['user_id'] = $id;
            $_SESSION['name'] = $name;
            $_SESSION['role'] = $role;

            // Debugging: Check role value
            var_dump($role);  // Uncomment this to check the role, and comment it out later after debugging

            // Redirect based on role
            if ($role === 'owner') {
                header("Location: owner_dashboard.php");
                exit();
            } elseif ($role === 'shop') {
                header("Location: shop_dashboard.php");
                exit();
            } elseif ($role === 'admin') {
                header("Location: admin_dashboard.php");
                exit();
            } else {
                $error = "Invalid role.";
            }
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Email not found.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- Login Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Assistant - Login</title>
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

        
        .login-form {
            background: rgba(255, 255, 255, 0.05);
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.5);
            width: 350px;
            backdrop-filter: blur(8px);
            text-align: center;
        }
        .login-form h2 {
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
        .login-form input::placeholder {
            color: #dcdcdc;
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
            margin-bottom: 10px;
        }
        .login-form p {
            font-size: 14px;
            color: #dcdcdc;
        }
        .login-form p a {
            color: #00d4ff;
            text-decoration: none;
        }
        .login-form p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <form method="post" class="login-form">
        <h2>Login</h2>
        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </form>

</body>
</html>
