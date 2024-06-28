<?php
session_start();
include_once 'db.php';
include_once 'user.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'login') {
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        if ($user->login()) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['role'] = $user->role;
            header("Location: index.php");
        } else {
            echo "Login failed!";
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'register') {
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        $user->role = 'user';
        if ($user->register()) {
            echo "Registration successful!";
        } else {
            echo "Registration failed!";
        }
    }
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function isAuthor() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'author';
}

function logout() {
    session_destroy();
    header("Location: index.php");
}
?>
