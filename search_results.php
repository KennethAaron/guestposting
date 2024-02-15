<?php
session_start();
include 'db.php';

if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];

    // Prepare the SQL query to search for posts
    $stmt = $pdo->prepare("SELECT posts.*, users.username 
                    FROM posts 
                    INNER JOIN users ON posts.author_id = users.id
                    WHERE title LIKE :searchTitle OR content LIKE :searchContent
                    ORDER BY posts.id DESC");
    
    // Bind the search parameters
    $searchPattern = '%' . $searchQuery . '%';
    $stmt->bindValue(':searchTitle', $searchPattern, PDO::PARAM_STR);
    $stmt->bindValue(':searchContent', $searchPattern, PDO::PARAM_STR);

    // Execute the query
    $stmt->execute();

    // Fetch the search results
    $searchResults = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container mt-4">
    <form action="search_results.php" method="GET" class="mb-4">
            <div class="input-group">
                 <input type="text" class="form-control" name="search" placeholder="Search...">
                <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container mt-4">
        <h2>Search Results for "<?php echo $searchQuery; ?>"</h2>
        <?php if (isset($searchResults) && !empty($searchResults)): ?>
            <div class="row">
                <?php foreach ($searchResults as $post): ?>
                    <div class="col-md-4 mb-4">
                        <!-- Display each post -->
                        <div class="card">
                            <?php if (!empty($post['image_url'])): ?>
                                <img src="uploads/<?php echo $post['image_url']; ?>" class="card-img-top" alt="<?php echo $post['image_alt']; ?>">
                            <?php else: ?>
                                <div class="text-center pt-5 pb-4">No Image</div>
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $post['title']; ?></h5>
                                <p class="card-text"><?php echo substr($post['content'], 0, 200); ?>...</p>
                                <a href="full_post.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info" role="alert">
                No posts found matching your search criteria.
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
