<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
include 'header.php';
?>
<div style="margin-bottom: 30px;">
    <h2>Dashboard</h2>
    <p class="text-muted">Welcome to your control panel.</p>
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
</body>
</html>