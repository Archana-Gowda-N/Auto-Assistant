<?php
// Initialize session
session_start();

// Connect to the database
$conn = new mysqli("localhost", "root", "", "auto_assistant");

// Check for form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = trim($_POST['name']);
    $email = strtolower(trim($_POST['email'])); // Making email case-insensitive
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if password and confirm password match
    if ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        // Hash the password before storing
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if the email already exists in the database
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Email already exists
            $error = "Email is already taken.";
        } else {
            // Insert the new user into the database
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
            $role = "user"; // Default role for new users
            $stmt->bind_param("ssss", $name, $email, $hashedPassword, $role);

            if ($stmt->execute()) {
                // Redirect to login page after successful sign up
                header("Location: login.php");
                exit();
            } else {
                $error = "Error: Could not register user.";
            }
        }
    }

    // Close the statement
    $stmt->close();
    $conn->close();
}
?>

<!-- Sign Up Form -->
<form method="post">
    <h2>Sign Up</h2>
    <?php if (isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <input type="text" name="name" placeholder="Full Name" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
    <button type="submit">Sign Up</button>
</form>
