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
        $error = "<div class='alert alert-error'>Invalid credentials.</div>";
    }
}
include 'header.php';
?>
<div style="max-width: 400px; margin: 60px auto;">
    <div class="card">
        <h3 style="text-align: center;">Sign In</h3>
        <?= $error ?>
        <form method="POST">
            <div class="form-group"><input type="text" name="login" class="form-control" placeholder="Username or Email" required></div>
            <div class="form-group"><input type="password" name="password" class="form-control" placeholder="Password" required></div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>
</body></html>