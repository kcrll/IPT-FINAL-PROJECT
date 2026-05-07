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
    <div style="margin-bottom: 20px;">
        <h2>Community Posts</h2>
        <p class="text-muted">Latest updates and stories.</p>
    </div>

    <div class="grid grid-cols-3">
    <?php foreach($posts as $post): ?>
    <div class="card post-card">
        <h3><?= htmlspecialchars($post['title']) ?></h3>
        
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