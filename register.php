<?php
session_start();
require 'config/db.php';
$message = '';
$success = false; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password !== $confirm) {
        $message = "<div class='notification notification-error'>Passwords do not match.</div>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (fullname, email, username, password) VALUES (?, ?, ?, ?)");
        try {
            $stmt->execute([$fullname, $email, $username, $hashed_password]);
            $message = "<div class='notification notification-success'>Registration successful!</div>";
            $success = true; 
        } catch(PDOException $e) {
            $message = "<div class='notification notification-error'>Username or Email already exists.</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - DummyJSON App</title>
    <link rel="stylesheet" href="assets/variables.css">
     <link rel="stylesheet" href="assets/register.css">
</head>
<body>

<div class="fade-in register-container">
    <div style="margin-bottom: 10px;">
        <a href="index.php" style="color: var(--primary); text-decoration: none; display: flex; align-items: center; gap: 5px; font-size: 0.9rem;">
            <span>&larr;</span> Back to Home
        </a>
    </div>

    <div class="card">
        <?php if (!$success): ?>
            <h3 style="text-align: center; margin-bottom: 15px;">Register Account</h3>
        <?php endif; ?>
        
        <?= $message ?>

        <?php if (!$success): ?>
            <form method="POST">
                <div class="form-group">
                    <p class="form-label">Full Name</p>
                    <input type="text" name="fullname" class="form-control" placeholder="Enter your full name" required>
                </div>
                <div class="form-group">
                    <p class="form-label">Email</p>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <p class="form-label">Username</p>
                    <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <p class="form-label">Password</p>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <p class="form-label">Confirm Password</p>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm your password" required>
                </div>
                <button type="submit" class="button button-primary w-100">Submit</button>
            </form>
        <?php else: ?>
            <!-- Show Login button only after successful submission -->
            <div style="text-align: center; margin-top: 10px;">
                <p class="text-subtle" style="margin-bottom: 20px;">You may now access your account.</p>
                <a href="login.php" class="button button-primary success-button">Login Now</a>
            </div>
        <?php endif; ?>

        <?php if (!$success): ?>
            <div style="text-align: center; margin-top: 15px; border-top: 1px solid var(--border); padding-top: 10px;">
                <p class="text-subtle" style="font-size: 0.85rem;">
                    Already have an account? <a href="login.php" style="color: var(--primary);">Login</a>
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
