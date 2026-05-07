<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DummyJSON App</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container fade-in">
    <div class="center-screen" style="text-align: center; padding-top: 100px;">
    
    <!-- Animated Video Logo -->
    <video autoplay muted loop playsinline style="width: 200px; height: auto; margin-bottom: 1rem;">
        <source src="assets/animated logoo.mp4" type="video/mp4">
    </video>
    
    <p class="text-muted" style="font-size: 1.25rem; max-width: 600px; margin: 0 auto 2rem auto;">
        Explore products, users, carts, and posts.
    </p>
    
    <div style="display: flex; gap: 15px; justify-content: center;">
        <a href="login.php" class="btn btn-primary" style="font-size: 1.25rem;">Login</a>
        <a href="register.php" class="btn btn-outline" style="font-size: 1.25rem;">Register</a>
    </div>
</div>
</div>
</body></html>