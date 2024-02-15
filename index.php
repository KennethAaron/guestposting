<?php
session_start();
include 'db.php';

// Logout functionality
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect the user to the homepage
    header("Location: index.php");
    exit();
}

// Number of posts per page
$postsPerPage = 10;

// Get current page number
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Calculate offset for pagination
$offset = ($page - 1) * $postsPerPage;

// Retrieve posts for the current page
$stmt = $pdo->prepare("SELECT posts.*, users.username 
                    FROM posts 
                    INNER JOIN users ON posts.author_id = users.id
                    ORDER BY posts.id DESC
                    LIMIT :offset, :limit");
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':limit', $postsPerPage, PDO::PARAM_INT);
$stmt->execute();
$posts = $stmt->fetchAll();

// Count total number of posts
$totalPostsStmt = $pdo->query("SELECT COUNT(*) FROM posts");
$totalPosts = $totalPostsStmt->fetchColumn();

// Calculate total number of pages
$totalPages = ceil($totalPosts / $postsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($post) ? htmlspecialchars($post['title']) : "Mention Project - Find Amazing FANTASTIC PROJECTS here"; ?></title>
    <meta name="description" content="Welcome to Mention Project! We are dedicated to providing insightful articles on various topics, including technology, business, lifestyle, and more free..">  
    <link rel="canonical" href="https://mentionproject.com" />
    <link rel="icon" href="img/favicon.co" type="image/x-icon" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .post-image {
            width: 100%;
            height: 200px; /* Adjust the height as needed */
            object-fit: cover;
        }
        .custom-card {
            background-color: #F3F3F3;
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
        <form action="search_results.php" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search...">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php if (empty($posts)): ?>
                    <div class="alert alert-info" role="alert">
                        No posts found.
                    </div>
                <?php else: ?>
                    <?php foreach ($posts as $post): ?>
                        <div class="col-md-12 mb-4">
                            <!-- Display each post -->
                            <div class="card border-0" style="background-color: #F3F3F3;">
                                <div class="row no-gutters align-items-center">
                                    <div class="col-md-4">
                                        <?php if (!empty($post['image_url'])): ?>
                                            <img src="uploads/<?php echo $post['image_url']; ?>" class="card-img img-fluid rounded" style="height: 200px; object-fit: cover;" alt="<?php echo $post['image_alt']; ?>">
                                        <?php else: ?>
                                            <div class="text-center pt-5 pb-4">No Image</div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h2 class="card-title" style="font-size: 18px;"><b><?php echo $post['title']; ?></b></h2>
                                            <p class="card-text"><?php echo substr($post['content'], 0, 200); ?>...</p><br>
                                            <a href="full_post.php?title=<?php echo urlencode($post['title']); ?>" class="btn btn-primary mr-2" style="background-color: #0D1F75; border-color: #0D1F75;">See More</a> <!-- Applied inline CSS -->
                                            <?php if (!empty($post['website_link'])): ?>
                                                <a href="<?php echo $post['website_link']; ?>" class="btn btn-secondary" target="_blank" style="background-color: #4565DB; border-color: #4565DB;">Visit Website</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    <?php endforeach; ?>
                <?php endif; ?>
                <br><br>
                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>" style="background-color: #0D1F75; color: white;"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>

            </div>
            <div class="col-md-4">
                <!-- Sidebar with latest posts -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Latest Posts</h5>
                        <ul class="list-group list-group-flush">
                            <?php
                            // Retrieve latest posts for the sidebar
                            $latestPostsStmt = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT 5");
                            $latestPostsStmt->execute();
                            $latestPosts = $latestPostsStmt->fetchAll();
                            foreach ($latestPosts as $latestPost):
                            ?>
                            <li class="list-group-item"><a class="anjing" href="full_post.php?title=<?php echo urlencode($latestPost['title']); ?>"><?php echo htmlspecialchars($latestPost['title']); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <!-- Additional Sidebar with Image and Link -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Featured Item</h5>
                        <!-- Replace the image source and link with your actual image and destination -->
                        <a href="https://tiranga.app" target="_blank">
                            <img src="img/featured.png" alt="tiranga-games" class="img-fluid" alt="Featured Item">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-auto py-3 bg-white text-white">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="text-muted">&copy; 2024 Mention Project. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>


    <!-- Bootstrap and jQuery scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

