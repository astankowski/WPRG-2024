<?php
include_once 'db.php';
include_once 'post.php';
include_once 'auth.php';

$database = new Database();
$db = $database->getConnection();
$post = new Post($db);

$stmt = $post->read();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>Blog</h1>
<?php if (isLoggedIn()): ?>
    <p>Welcome, <?php echo $_SESSION['role']; ?>! <a href="auth.php?action=logout">Logout</a></p>
<?php else: ?>
    <p><a href="login.php">Login</a> | <a href="register.php">Register</a></p>
<?php endif; ?>
<hr>
<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
    <div class="post">
        <h2><?php echo htmlspecialchars($row['title']); ?></h2>
        <p><?php echo htmlspecialchars($row['content']); ?></p>
        <?php if ($row['image']): ?>
            <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Post Image">
        <?php endif; ?>
        <p><small>Posted on <?php echo htmlspecialchars($row['created_at']); ?></small></p>
        <p><a href="post_details.php?id=<?php echo $row['id']; ?>">Read more</a></p>
    </div>
    <hr>
<?php endwhile; ?>
</body>
</html>
