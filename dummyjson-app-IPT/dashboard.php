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
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<nav class="navbar">
<div id="logoutModal" class="modal-overlay">
    <div class="modal-content">
        <h3>Confirm Logout</h3>
        <p>Are you sure you want to leave? Your session will end.</p>
        <div class="modal-buttons">
            <a href="logout.php" class="btn-confirm">Yes, Logout</a>
            <button onclick="closeModal()" class="btn-cancel">Stay Here</button>
        </div>
    </div>
</div>
    <a class="navbar-brand" href="dashboard.php" style="color: var(--primary); font-weight: bold; text-decoration: none;">LORA</a>
    <div class="nav-links">
        <a href="dashboard.php">Dashboard</a>
        <a href="products.php">Products</a>
        <a href="users.php">Users & Carts</a>
        <a href="posts.php">Posts</a> 
        <a href="#" class="btn-logout" onclick="openModal(event)">Logout</a>
    </div>
</nav>

<div class="container fade-in">
   <div style="margin-bottom: 30px;">
    <h2>Dashboard</h2>

    <h4 class="welcome-text">Welcome, <?=($username) ?>!</h4>
</div>
    <div class="grid grid-cols-3">
        <div class="card" style="text-align: center;">
            <h3>Products</h3>
            <p class="text-muted" style="margin-bottom: 15px;">View API product data.</p>
            <a href="products.php" class="btn btn-primary w-100">View Products</a>
        </div>
        <div class="card" style="text-align: center;">
            <h3>Users & Carts</h3>
            <p class="text-muted" style="margin-bottom: 15px;">View users and their carts.</p>
            <a href="users.php" class="btn btn-primary w-100">View Users</a>
        </div>
        <div class="card" style="text-align: center;">
            <h3>Posts</h3>
            <p class="text-muted" style="margin-bottom: 15px;">Read API blog posts.</p>
            <a href="posts.php" class="btn btn-primary w-100">View Posts</a>
        </div>
    </div>
</div>
</body></html>

<script> // logout
const modal = document.getElementById('logoutModal');

function openModal(event) {
    event.preventDefault(); // Stop the logout link from working instantly
    modal.style.display = 'flex'; // Show our custom design
}

function closeModal() {
    modal.style.display = 'none'; // Hide the design if they cancel
}

// Close the modal if the user clicks outside the box
window.onclick = function(event) {
    if (event.target == modal) {
        closeModal();
    }
}
</script>
