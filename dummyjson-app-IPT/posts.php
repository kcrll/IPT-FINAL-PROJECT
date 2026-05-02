<?php
session_start();
// Security: Redirect to login if no session exists
if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit; 
}

// API Source: https://dummyjson.com/posts
$json = file_get_contents('https://dummyjson.com/posts');
$data = json_decode($json, true); // Decode JSON data
$posts = $data['posts'];

include 'header.php';
?>

<div style="margin-bottom: 20px;">
    <h2>Community Posts</h2>
    <p class="text-muted">Latest updates and stories from the DummyJSON API.</p>
</div>

<div class="grid grid-cols-3">
    <?php foreach($posts as $post): ?>
    <div class="card" style="display: flex; flex-direction: column; justify-content: space-between;">
        <div>
            <!-- Display Post Title[cite: 1] -->
            <h3 style="font-size: 1.2rem; color: var(--primary); margin-bottom: 10px;">
                <?= htmlspecialchars($post['title']) ?>
            </h3>
            
            <!-- Display Body (preview)[cite: 1] -->
            <p class="text-muted" style="margin-bottom: 15px; font-size: 0.95rem;">
                <?= htmlspecialchars(substr($post['body'], 0, 120)) ?>...
            </p>
        </div>

        <div>
            <!-- Display Tags[cite: 1] -->
            <div style="margin-bottom: 15px;">
                <?php foreach($post['tags'] as $tag): ?>
                    <span style="display: inline-block; background: #ebf2ff; color: #2563eb; padding: 2px 8px; border-radius: 4px; font-size: 0.75rem; margin-right: 5px;">
                        #<?= htmlspecialchars($tag) ?>
                    </span>
                <?php endforeach; ?>
            </div>

            <!-- Display Reactions[cite: 1] -->
            <div style="border-top: 1px solid var(--border); padding-top: 10px; display: flex; justify-content: space-between; align-items: center;">
                <span style="font-size: 0.9rem;">
                    👍 <?= $post['reactions']['likes'] ?? $post['reactions'] ?> 
                    <span style="margin-left: 10px;">👎 <?= $post['reactions']['dislikes'] ?? 0 ?></span>
                </span>
                <span class="text-muted" style="font-size: 0.8rem;">Views: <?= $post['views'] ?? 0 ?></span>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

</body>
</html>