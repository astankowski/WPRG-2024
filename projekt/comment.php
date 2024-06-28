<?php
class Comment {
    private $conn;
    private $table_name = "comments";

    public $id;
    public $post_id;
    public $username;
    public $content;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET post_id=:post_id, username=:username, content=:content, created_at=:created_at";
        $stmt = $this->conn->prepare($query);

        $this->post_id = htmlspecialchars(strip_tags($this->post_id));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));

        $stmt->bindParam(':post_id', $this->post_id);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':created_at', $this->created_at);

        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE post_id = :post_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':post_id', $this->post_id);
        $stmt->execute();
        return $stmt;
    }
}
?>
