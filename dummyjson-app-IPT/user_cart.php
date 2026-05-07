<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_GET['user_id'])) { header("Location: users.php"); exit; }

$user_id = $_GET['user_id'];
$json = file_get_contents('https://dummyjson.com/carts');
$data = json_decode($json, true);
$carts = $data['carts'];

$user_cart = null;
foreach ($carts as $cart) {
    if ($cart['userId'] == $user_id) { $user_cart = $cart; break; }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Cart</title>
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
    <div class="nav-links"><a href="#" class="btn-logout" onclick="openModal(event)">Logout</a>
</nav>

<div class="container fade-in">
    <div style="margin-bottom: 20px;"><a href="users.php" class="btn btn-outline">&larr; Back to Users</a></div>
    <?php if ($user_cart): ?>
        <div class="card">
            <h3>Cart Details</h3>
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
        <div class="alert alert-error">No cart found for this user.</div>
    <?php endif; ?>
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