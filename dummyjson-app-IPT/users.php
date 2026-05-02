<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$json = file_get_contents('https://dummyjson.com/users');
$data = json_decode($json, true);
$users = $data['users'];

include 'header.php';
?>
<h2 style="margin-bottom: 20px;">System Users</h2>
<div class="grid grid-cols-3">
    <?php foreach($users as $user): ?>
    <div class="card flex-row">
        <img src="<?= $user['image'] ?>" class="user-avatar" alt="User Image">
        <div>
            <h4 style="margin-bottom: 5px;"><?= htmlspecialchars($user['firstName'] . ' ' . $user['lastName']) ?></h4>
            <p class="text-muted" style="margin-bottom: 2px;"><?= htmlspecialchars($user['email']) ?></p>
            <p class="text-muted" style="margin-bottom: 10px;">Age: <?= $user['age'] ?> | <?= htmlspecialchars($user['phone']) ?></p>
            <a href="user_cart.php?user_id=<?= $user['id'] ?>" class="btn btn-outline" style="padding: 5px 10px; font-size: 0.85rem;">View Cart</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
</body></html>