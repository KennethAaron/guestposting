<?php
// Load database connection and necessary dependencies
include 'db.php';

// Set the header content type to XML
header('Content-Type: application/xml');

// Start the XML document
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <!-- Homepage URL -->
    <url>
        <loc>https://mentionproject.com/</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <!-- Posts URLs -->
    <?php
    // Query to fetch all posts from the database
    $stmt = $pdo->query("SELECT * FROM posts");

    // Loop through each post and add it to the sitemap
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Escape special XML characters in the post title
        $title = htmlspecialchars($row['title']);

        // Generate the full post URL based on the title
        $url = htmlspecialchars("https://mentionproject.com/full_post.php?title=" . urlencode($row['title']));

        // Format the post creation date in ISO 8601 format
        $lastmod = date('Y-m-d', strtotime($row['created_at']));

        // Output the URL entry in the sitemap
        echo '<url>';
        echo "<loc>{$url}</loc>";
        echo "<lastmod>{$lastmod}</lastmod>"; // Use the post creation date in ISO 8601 format
        echo '</url>';
    }
    ?>
</urlset>
