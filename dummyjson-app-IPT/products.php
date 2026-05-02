<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$json = file_get_contents('https://dummyjson.com/products');
$data = json_decode($json, true);
$products = $data['products'];

include 'header.php';
?>
<h2 style="margin-bottom: 20px;">Products Inventory</h2>
<div class="grid grid-cols-4">
    <?php foreach($products as $product): ?>
    <div class="card">
        <img src="<?= $product['thumbnail'] ?>" class="card-img" alt="Product Image">
        <span class="badge">Stock: <?= $product['stock'] ?></span>
        <h4 style="margin: 10px 0 5px; font-size: 1.1rem;"><?= htmlspecialchars($product['title']) ?></h4>
        <p class="text-muted" style="margin-bottom: 10px;"><?= htmlspecialchars($product['category']) ?></p>
        <p style="font-weight: bold; font-size: 1.25rem;">$<?= $product['price'] ?></p>
    </div>
    <?php endforeach; ?>
</div>
</body></html>