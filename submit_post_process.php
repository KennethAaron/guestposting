<?php
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (isset($_POST['title'], $_POST['content'], $_POST['website_link'])) {
        // Retrieve form data
        $title = $_POST['title'];
        $content = $_POST['content'];
        
        // Ensure website link starts with "https://"
        $website_link = $_POST['website_link'];
        if (!preg_match("~^(?:f|ht)tps?://~i", $website_link)) {
            $website_link = "https://" . $website_link;
        }
        
        $author_id = $_SESSION['user_id'];
        
        // Check if an image was uploaded
        if ($_FILES['image']['name']) {
            // Define the upload directory
            $upload_dir = 'uploads/';
            
            // Generate a unique filename for the uploaded image
            $image_name = uniqid('image_') . '_' . time() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            
            // Move the uploaded image to the upload directory
            move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $image_name);
        } else {
            // If no image was uploaded, set image URL to null
            $image_name = null;
        }
        
        // Retrieve alt text for the image
        $image_alt = $_POST['image_alt'];
        
        // Insert post into database
        $stmt = $pdo->prepare("INSERT INTO posts (title, content, website_link, author_id, image_url, image_alt) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$title, $content, $website_link, $author_id, $image_name, $image_alt])) {
            // Redirect with success message
            header("Location: submit_post.php?post_success=1");
            exit();
        } else {
            // Display error message
            echo "Error in creating your post";
        }
    } else {
        // Display error message if required fields are not set
        echo "All required fields are not set";
    }
} else {
    // Display error message if form is not submitted
    echo "Form submission method is not POST";
}
?>
