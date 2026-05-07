<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$json = file_get_contents('https://dummyjson.com/users');
$data = json_decode($json, true);
$users = $data['users'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users</title>
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
    </div>
</div>
</nav>
<div class="container fade-in">
    <h2 style="margin-bottom: 20px;">System Users</h2>
    <div class="grid grid-cols-3">
        <?php foreach($users as $user): ?>
        <div class="card" style="display: flex; align-items: center;">
            <img src="<?= $user['image'] ?>" class="user-avatar" alt="User Image">
            <div>
                <h4 style="margin-bottom: 5px;"><?= htmlspecialchars($user['firstName'] . ' ' . $user['lastName']) ?></h4>
                <p class="text-muted" style="margin-bottom: 2px;"><?= htmlspecialchars($user['email']) ?></p>
                <p class="text-muted" style="margin-bottom: 10px;">Age: <?= $user['age'] ?></p>
                <a href="user_cart.php?user_id=<?= $user['id'] ?>" class="btn btn-outline" style="padding: 5px 10px; font-size: 0.85rem;">View Cart</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>

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