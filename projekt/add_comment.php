<?php
include_once 'db.php';
include_once 'comment.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'];
    $username = $_POST['username'];
    $content = $_POST['content'];

    $database = new Database();
    $db = $database->getConnection();
    $comment = new Comment($db);

    $comment->post_id = $post_id;
    $comment->username = $username;
    $comment->content = $content;
    $comment->created_at = date('Y-m-d H:i:s');

    if ($comment->create()) {
        header("Location: post_details.php?id=$post_id");
    } else {
        echo "Error adding comment.";
    }
}
?>
