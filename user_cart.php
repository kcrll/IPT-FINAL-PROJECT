<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_GET['user_id'])) { 
    header("Location: users.php"); 
    exit; 
}

$user_id = $_GET['user_id'];

// 1. Fetch the user's cart data
$cart_json = file_get_contents('https://dummyjson.com/carts');
$cart_data = json_decode($cart_json, true);
$carts = $cart_data['carts'];

$user_cart = null;
foreach ($carts as $cart) {
    if ($cart['userId'] == $user_id) { 
        $user_cart = $cart; 
        break; 
    }
}

// 2. Fetch the user's profile info to get their name
$user_json = @file_get_contents("https://dummyjson.com/users/$user_id");
$display_name = "User"; // Fallback name if API fails

if ($user_json) {
    $user_info = json_decode($user_json, true);
    // Combines firstName and lastName if available, otherwise falls back to username
    if (isset($user_info['firstName'])) {
        $display_name = $user_info['firstName'] . ' ' . $user_info['lastName'];
    } elseif (isset($user_info['username'])) {
        $display_name = ucfirst($user_info['username']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Updated the browser tab title dynamically too! -->
    <title><?= htmlspecialchars($display_name) ?>'s Cart</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/variables.css">
    <link rel="stylesheet" href="assets/user_cart.css">
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
    <div class="nav-links"><a href="#" class="button-logout" onclick="openModal(event)">Logout</a></div>
</nav>

<div class="container fade-in">
    <div style="margin-bottom: 20px;"><a href="users.php" class="button button-outline">&larr; Back to Users</a></div>
    <?php if ($user_cart): ?>
        <div class="card">
            <h3><?= htmlspecialchars($display_name) ?>'s Cart</h3>
            <p><strong>Total Amount:</strong> $<?= $user_cart['total'] ?></p>
            <table class="table">
                <thead><tr><th>Product Title</th><th>Quantity</th><th>Price</th></tr></thead>
                <tbody>
                    <?php foreach($user_cart['products'] as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['title']) ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td>$<?= $item['price'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="notification notification-error">No cart found for <?= htmlspecialchars($display_name) ?>.</div>
    <?php endif; ?>
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