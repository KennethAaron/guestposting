<?php
include 'db.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");

if ($stmt->execute([$username, $email, $password])) {
    // Redirect to login page with success message
    header("Location: login.php?registration_success=1");
    exit();
} else {
    // Display error message
    echo "Error in creating your account";
}
?>
