<?php
include_once 'db.php';
include_once 'post.php';
include_once 'comment.php';

$postId = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Missing post ID.');

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);
$post->id = $postId;
$postStmt = $post->readOne();

$comment = new Comment($db);
$comment->post_id = $postId;
$commentStmt = $comment->read();

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Post Details</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Post Details</h1>

    <?php if ($postRow = $postStmt->fetch(PDO::FETCH_ASSOC)): ?>
        <div class="post">
            <h2><?php echo htmlspecialchars($postRow['title']); ?></h2>
            <p><?php echo htmlspecialchars($postRow['content']); ?></p>
            <?php if ($postRow['image']): ?>
                <img src="uploads/<?php echo htmlspecialchars($postRow['image']); ?>" alt="Post Image">
            <?php endif; ?>
            <p>Posted on <?php echo htmlspecialchars($postRow['created_at']); ?></p>
        </div>
    <?php else: ?>
        <p>No post found.</p>
    <?php endif; ?>

    <h2>Comments</h2>
    <?php if ($commentStmt && $commentStmt->rowCount() > 0): ?>
        <?php while ($commentRow = $commentStmt->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="comment">
                <p><?php echo htmlspecialchars($commentRow['content']); ?></p>
                <p><small>Posted by <?php echo htmlspecialchars($commentRow['username']); ?> on <?php echo htmlspecialchars($commentRow['created_at']); ?></small></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No comments found.</p>
    <?php endif; ?>

    <h2>Add a Comment</h2>
    <form action="add_comment.php" method="post">
        <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>
        <label for="content">Comment:</label>
        <textarea name="content" id="content" required></textarea><br>
        <input type="submit" value="Add Comment">
    </form>
</body>
</html>
