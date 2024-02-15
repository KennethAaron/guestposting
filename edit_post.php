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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form data
    // Here, you can add validation for title, content, website link, and image.

    // Update post in the database
    $title = $_POST['title'];
    $content = $_POST['content'];
    $website_link = $_POST['website_link'];

    // Handle image upload
    $image_url = $post['image_url']; // Default to the existing image if not changed
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_url = 'uploads/' . $image_name;
        move_uploaded_file($image_tmp_name, $image_url);
    }

    $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ?, website_link = ?, image_url = ? WHERE id = ?");
    $stmt->execute([$title, $content, $website_link, $image_url, $post_id]);

    // Redirect to account page after editing post
    header("Location: account.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php'; ?>
    <div class="container mt-5">
        <h2 class="mb-4">Edit Post</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $post['title']; ?>">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5"><?php echo $post['content']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="website_link">Website Link</label>
                <input type="text" class="form-control" id="website_link" name="website_link" value="<?php echo $post['website_link']; ?>">
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
