<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$json = file_get_contents('https://dummyjson.com/products');
$data = json_decode($json, true);
$products = $data['products'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
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
        <a href="logout.php" class="btn-logout" onclick="confirmLogout(event)">Logout</a>
    </div>
</nav>

<div class="container fade-in">
    <h2>Products Inventory</h2>
    <div class="grid grid-cols-4">
        <?php foreach($products as $product): ?>
        <div class="card product-card">
            <img src="<?= $product['thumbnail'] ?>" class="product-img" alt="<?= htmlspecialchars($product['title']) ?>">
            <div class="product-info">
                <span class="badge">Stock: <?= $product['stock'] ?></span>
                <h4><?= htmlspecialchars($product['title']) ?></h4>
               <p class="category-tag"><?= ucfirst(htmlspecialchars($product['category'])) ?></p>
            </div>
            <div class="product-price">
                $<?= number_format($product['price'], 2) ?>
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
    modal.style.display = 'none'; // hide the design if they cancel
}

// close the modal if the user clicks outside the box
window.onclick = function(event) {
    if (event.target == modal) {
        closeModal();
    }
}
</script>