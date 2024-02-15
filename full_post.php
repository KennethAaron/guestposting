<?php
session_start();
include 'db.php';

// Check if post title is provided
if (!isset($_GET['title'])) {
    header("Location: index.php");
    exit();
}

$post_title = urldecode($_GET['title']);

// Fetch post details
$stmt = $pdo->prepare("SELECT posts.*, users.username 
                        FROM posts 
                        INNER JOIN users ON posts.author_id = users.id
                        WHERE posts.title = ?");
$stmt->execute([$post_title]);
$post = $stmt->fetch();


// Check if post exists
if (!$post) {
    header("Location: index.php");
    exit();
}

// Fetch recent latest posts for sidebar
$stmt_recent = $pdo->query("SELECT posts.*, users.username 
                            FROM posts 
                            INNER JOIN users ON posts.author_id = users.id
                            ORDER BY posts.created_at DESC
                            LIMIT 5");
$recent_posts = $stmt_recent->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <?php
    // Truncate the content to 154 characters for the meta description
    $description = substr($post['content'], 0, 154);
    ?>
    <meta name="description" content="<?php echo htmlspecialchars($description); ?>">
    <meta name="author" content="<?php echo htmlspecialchars($post['username']); ?>">
    <meta name="keywords" content="mention project, <?php echo htmlspecialchars($post['title']); ?>, <?php echo htmlspecialchars($post['username']); ?>">
    <link rel="canonical" href="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
    <!-- Other meta tags can be added as needed for SEO -->
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Your custom CSS styles */
        .post-image {
            width: 100%;
            height: auto;
            max-height: 400px; /* Adjust the max height as needed */
            object-fit: contain;
        }
        .sidebar {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
        }
        .anjing {
            color: #0D1F75 !important;
        }

        /* Hover effect for links */
        .anjing:hover {
            color: #0D1F75 !important;
            text-decoration: underline; /* Optional: underline on hover */
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container mt-4">
    <img src="img/header.jpg" class="img-fluid" alt="Responsive Image">
    <br><br>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <?php if (!empty($post['image_url'])): ?>
                        <img src="uploads/<?php echo $post['image_url']; ?>" class="card-img-top post-image" alt="Post Image">
                    <?php endif; ?>
                    <div class="card-body"><br>
                        <h1 class="card-title" style="font-size: 20px;"><b><?php echo $post['title']; ?></b></h1><br>
                        <p class="card-text"><?php echo $post['content']; ?></p><br>
                        <p class="card-text"><small class="text-muted">Posted by <?php echo $post['username']; ?> on <?php echo date('F j, Y', strtotime($post['created_at'])); ?></small></p>
                        <a href="index.php" class="btn btn-secondary" style="background-color: #0D1F75; border-color: #0D1F75;">Back to Home</a>
                        <?php if (!empty($post['website_link'])): ?>
                            <a href="<?php echo $post['website_link']; ?>" class="btn btn-primary mr-2" target="_blank" style="background-color: #4565DB; border-color: #4565DB;">Visit Website</a>
                        <?php endif; ?>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="sidebar" style="background-color: #fff; padding: 15px; border-radius: 5px;">
                    <h5>Search</h5>
                    <form action="search_results.php" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search...">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>

                    <h5>Recent Latest Posts</h5>
                    <ul class="list-unstyled">
                        <?php foreach ($recent_posts as $recent_post): ?>
                            <li><a class="anjing" href="full_post.php?title=<?php echo urlencode($recent_post['title']); ?>"><?php echo $recent_post['title']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <br>
                    <div class="list-unstyled">
                        <h5 class="card-title">Featured Item</h5>
                        <!-- Replace the image source and link with your actual image and destination -->
                        <a href="https://tiranga.app" target="_blank">
                            <img src="img/featured.png" alt="tiranga-games" class="img-fluid" alt="Featured Item">
                        </a>
                    </div>
                </div>
                <br>
            </div>
            <br><br> 
            <br>


            <!-- Bootstrap and jQuery scripts -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
        </html>
