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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/variables.css">
    <link rel="stylesheet" href="assets/products.css">
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
    <h5>PRODUCT INVENTORY</h5>
    <br>    
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
