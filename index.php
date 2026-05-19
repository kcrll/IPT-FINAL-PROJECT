<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DummyJSON App</title>
    <link rel="stylesheet" href="assets/variables.css">
    <link rel="stylesheet" href="assets/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&family=Montserrat:wght@700&display=swap" rel="stylesheet">

</head>
<body>
<div class="container fade-in">
    <div class="layout-center" style="text-align: center;">
    
    <!-- Animated Logo centered -->
    <div style="margin: 0 0 1.5rem 0; display: flex; justify-content: center;">
        <img src="assets/Images/animated logo.gif" alt="Animated Logo" style="width: 420px; height: auto; display: block;">
    </div>
    
    <p class="text-subtle" style="font-size: 1.25rem; max-width: 600px; margin: 0 auto 2rem auto;">
        Explore products, users, carts, and posts.
    </p>
    
    <div style="display: flex; gap: 15px; justify-content: center;">
        <a href="login.php" class="button button-primary" style="font-size: 1.25rem;">Login</a>
        <a href="register.php" class="button button-outline" style="font-size: 1.25rem;">Register</a>
    </div>
</div>
</div>
</body></html>
