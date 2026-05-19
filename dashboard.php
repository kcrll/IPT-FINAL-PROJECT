<?php
session_start();
if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit; 
}

$username = $_SESSION['username'] ?? 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/variables.css">
    <link rel="stylesheet" href="assets/dashboard.css">
    <link rel="stylesheet" href="assets/logout.css">
</head>
<body class="dashboard-page">
<nav class="navbar">
<div id="logoutModal" class="modal-overlay">
    <div class="modal-content">
        <h3>Confirm Logout</h3>
        <p>Are you sure you want to leave? Your session will end.</p>
        <div class="modal-buttons">
            <a href="logout.php" class="button-confirm">Yes, Logout</a>
            <button onclick="closeModal()" class="button-cancel">Stay Here</button>
        </div>
    </div>
</div>
    <a class="navbar-brand" href="dashboard.php" style="text-decoration: none; display: inline-flex; align-items: center;">
        <img src="assets/Images/shop.gif" alt="" style="height: 48px; width: auto; display: block;">
    </a>
    <div class="nav-links">
        <a href="dashboard.php">Dashboard</a>
        <a href="products.php">Products</a>
        <a href="users.php">Users & Carts</a>
        <a href="posts.php">Posts</a> 
        <a href="#" class="button-logout" onclick="openModal(event)">Logout</a>
    </div>
</nav>

<div class="container fade-in">
   <div style="margin-bottom: 30px;">
    <h1 class="welcome-text">WELCOME, <?= htmlspecialchars($username) ?>!</h1>
</div>
    <div class="grid layout-grid-3">
        <div class="card">
            <div class="card-icon"><i class="fa-solid fa-box-open"></i></div>
            <h3>Products</h3>
            <p class="text-subtle">View API product data.</p>
            <a href="products.php" class="button button-primary w-100">View Products</a>
        </div>

        <div class="card">
            <div class="card-icon"><i class="fa-solid fa-users-gear"></i></div>
            <h3>Users & Carts</h3>
            <p class="text-subtle">View users and their carts.</p>
            <a href="users.php" class="button button-primary w-100">View Users</a>
        </div>

        <div class="card">
            <div class="card-icon"><i class="fa-solid fa-scroll"></i></div>
            <h3>Posts</h3>
            <p class="text-subtle">Read API blog posts.</p>
            <a href="posts.php" class="button button-primary w-100">View Posts</a>
        </div>
    </div>
</div>

<script>
const modal = document.getElementById('logoutModal');

function openModal(event) {
    event.preventDefault();
    modal.style.display = 'flex';
}

function closeModal() {
    modal.style.display = 'none';
}

window.onclick = function(event) {
    if (event.target == modal) {
        closeModal();
    }
}
</script>
</body>
</html>