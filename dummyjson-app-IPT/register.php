<?php
session_start();
require 'config/db.php';
$message = '';
$success = false; // Flag to track successful registration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password !== $confirm) {
        $message = "<div class='alert alert-error'>Passwords do not match.</div>";
    } else {
        // Apply password hashing as required
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (fullname, email, username, password) VALUES (?, ?, ?, ?)");
        try {
            $stmt->execute([$fullname, $email, $username, $hashed_password]);
            $message = "<div class='alert alert-success'>Registration successful!</div>";
            $success = true; // Trigger the appearance of the login button
        } catch(PDOException $e) {
            $message = "<div class='alert alert-error'>Username or Email already exists.</div>";
        }
    }
}
include 'header.php';
?>

<div class="fade-in" style="max-width: 400px; margin: 40px auto;">
    <!-- Back to index.php button[cite: 1] -->
    <div style="margin-bottom: 15px;">
        <a href="index.php" style="color: #38bdf8; text-decoration: none; display: flex; align-items: center; gap: 5px; font-size: 0.9rem;">
            <span>&larr;</span> Back to Home
        </a>
    </div>

    <div class="card">
        <h3 style="text-align: center; margin-bottom: 20px;">Register Account</h3>
        
        <?= $message ?>

        <?php if (!$success): ?>
            <!-- Only show form if registration hasn't succeeded yet[cite: 1] -->
            <form method="POST">
                <div class="form-group"><input type="text" name="fullname" class="form-control" placeholder="Full Name" required></div>
                <div class="form-group"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
                <div class="form-group"><input type="text" name="username" class="form-control" placeholder="Username" required></div>
                <div class="form-group"><input type="password" name="password" class="form-control" placeholder="Password" required></div>
                <div class="form-group"><input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required></div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        <?php else: ?>
            <!-- Show Login button only after successful submission[cite: 1] -->
            <div style="text-align: center; margin-top: 10px;">
                <p class="text-muted" style="margin-bottom: 20px;">You may now access your account.</p>
                <a href="login.php" class="btn btn-primary w-100" style="display: block; text-decoration: none;">Login Now</a>
            </div>
        <?php endif; ?>
        
        <div style="text-align: center; margin-top: 20px; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 15px;">
            <p class="text-muted" style="font-size: 0.85rem;">
                Already have an account? <a href="login.php" style="color: #38bdf8;">Sign In</a>
            </p>
        </div>
    </div>
</div>
</body></html>