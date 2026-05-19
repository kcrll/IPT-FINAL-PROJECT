<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$json = file_get_contents('https://dummyjson.com/posts');
$data = json_decode($json, true);
$posts = $data['posts'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Posts</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/variables.css">
    <link rel="stylesheet" href="assets/posts.css">
    <link rel="stylesheet" href="assets/logout.css">
</head>
<body>
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
    <div style="margin-bottom: 20px;">
        <h2>COMMUNITY POSTS</h2>
        <p class="text-subtle">Latest updates and stories.</p>
    </div>

    <div class="posts-list">
    <?php foreach($posts as $post): ?>
    <div class="card post-card">
        <h6><?= htmlspecialchars($post['title']) ?></h6>
        
        <p class="post-body">
            <?= htmlspecialchars($post['body']) ?>
        </p>

        <div class="post-footer">
            <span>👍 <?= number_format($post['reactions']['likes'] ?? 0) ?></span>
        </div>
    </div>
    <?php endforeach; ?>
</div>
</div>
</body></html>


<script> // logout
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
