<?php
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// Check if post ID is provided
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$post_id = $_GET['id'];

// Fetch post details
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch();

// Check if post exists and belongs to the logged-in user
if (!$post || $post['author_id'] != $_SESSION['user_id']) {
    // If post doesn't exist or doesn't belong to the user, redirect to account page
    header("Location: account.php");
    exit();
}

// Delete post from the database
$stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
$stmt->execute([$post_id]);

// Redirect to account page after deleting post
header("Location: account.php");
exit();
?>
