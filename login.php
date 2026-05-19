<?php
session_start();
require 'config/db.php';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$login, $login]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "<div class='notification notification-error'>Invalid credentials.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/variables.css">
    <link rel="stylesheet" href="assets/login.css">
</head>
<body class="login-page">
<div class="container fade-in auth-view">
    <div style="max-width: 400px; margin: 40px auto;">
        

        <div style="margin-bottom: 15px;">
            <a href="index.php" style="color: var(--primary); text-decoration: none; display: flex; align-items: center; gap: 5px; font-size: 0.9rem;">
                <span>&larr;</span> Back to Home
            </a>
        </div>

        <div class="card">
            <h3 style="text-align: center; margin-bottom: 20px;">Login</h3>
            
            <?= $error ?>
            
            <form method="POST">
                <div class="form-group">
                    <input type="text" name="login" class="form-control" placeholder="Username or Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="button button-primary w-100">Login</button>
            </form>

            <div style="text-align: center; margin-top: 20px; border-top: 1px solid var(--border); padding-top: 15px;">
                <p class="text-subtle" style="font-size: 0.85rem;">
                    Don't have an account? <a href="register.php" style="color: var(--primary);">Register here</a>
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
