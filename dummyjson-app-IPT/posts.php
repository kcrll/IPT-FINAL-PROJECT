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
    <a class="navbar-brand" href="dashboard.php" style="color: var(--primary); font-weight: bold; text-decoration: none;">SHOP NAME</a>
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
        <div class="card">
            <h3 style="font-size: 1.2rem; color: var(--primary); margin-bottom: 10px;">
                <?= htmlspecialchars($post['title']) ?>
            </h3>
            <p class="text-muted" style="margin-bottom: 15px; font-size: 0.95rem;">
                <?= htmlspecialchars(substr($post['body'], 0, 120)) ?>
            </p>
            <div style="border-top: 1px solid var(--border); padding-top: 10px;">
                <span style="font-size: 0.9rem;">👍 <?= $post['reactions']['likes'] ?? 0 ?></span>
            </div>
        </div>
        <?php endforeach; ?>
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