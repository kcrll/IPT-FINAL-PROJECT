<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_GET['user_id'])) { header("Location: users.php"); exit; }

$user_id = $_GET['user_id'];
$json = file_get_contents('https://dummyjson.com/carts');
$data = json_decode($json, true);
$carts = $data['carts'];

$user_cart = null;
foreach ($carts as $cart) {
    if ($cart['userId'] == $user_id) {
        $user_cart = $cart;
        break;
    }
}

include 'header.php';
?>
<div style="margin-bottom: 20px;">
    <a href="users.php" class="btn btn-outline">&larr; Back to Users</a>
</div>
<?php if ($user_cart): ?>
    <div class="card">
        <div style="background: var(--bg); padding: 15px; margin: -20px -20px 20px -20px; border-bottom: 1px solid var(--border); border-radius: 8px 8px 0 0;">
            <h3>Cart Details</h3>
            <p class="text-muted">Cart ID: <?= $user_cart['id'] ?> | User ID: <?= $user_cart['userId'] ?></p>
        </div>
        
        <p><strong>Total Items:</strong> <?= $user_cart['totalProducts'] ?></p>
        <p><strong>Total Amount:</strong> $<?= $user_cart['total'] ?></p>
        
        <table class="table">
            <thead>
                <tr><th>Product Title</th><th>Quantity</th><th>Price</th><th>Total per item</th></tr>
            </thead>
            <tbody>
                <?php foreach($user_cart['products'] as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['title']) ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td>$<?= $item['price'] ?></td>
                    <td>$<?= $item['total'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="alert alert-error">No cart found for this user.</div>
<?php endif; ?>
</body></html>