<?php
session_start();
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    // Redirect to index page with success message
    header("Location: index.php?login_success=1");
    exit();
} else {
    // Redirect to login page with error message
    header("Location: login.php?login_error=1");
    exit();
}
?>
