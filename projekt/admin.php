<?php
include_once 'db.php';
include_once 'auth.php';

if (!isAdmin()) {
    header("Location: index.php");
    exit;
}

$database = new Database();
$db = $database->getConnection();
$post = new Post($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'delete' && isset($_POST['id'])) {
        $post->id = $_POST['id'];
        $post->delete();
    } elseif ($_POST['action'] === 'create' && isset($_POST['title'], $_POST['content'])) {
        $post->title = $_POST['title'];
        $post->content = $_POST['content'];
        $post->created_at = date('Y-m-d H:i:s');
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $post->image = $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $_FILES['image']['name']);
        }
        $post->create();
    }
}

$stmt = $post->read();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Admin Panel</h1>
    <p>Welcome, <?php echo $_SESSION['role']; ?>! <a href="auth.php?action=logout">Logout</a></p>
    <hr>
    <h2>Create Post</h2>
    <form action="admin.php" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required><br>
        <label for="content">Content:</label>
        <textarea name="content" id="content" required></textarea><br>
        <label for="image">Image:</label>
        <input type="file" name="image" id="image"><br>
        <input type="hidden" name="action" value="create">
        <input type="submit" value="Create Post">
    </form>
    <hr>
    <h2>Manage Posts</h2>
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <div class="post">
            <h2><?php echo htmlspecialchars($row['title']); ?></h2>
            <p><?php echo htmlspecialchars($row['content']); ?></p>
            <?php if ($row['image']): ?>
                <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Post Image">
            <?php endif; ?>
            <p><small>Posted on <?php echo htmlspecialchars($row['created_at']); ?></small></p>
            <form action="admin.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="hidden" name="action" value="delete">
                <input type="submit" value="Delete Post">
            </form>
        </div>
        <hr>
    <?php endwhile; ?>
</body>
</html>
