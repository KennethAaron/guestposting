<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Post</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding-top: 50px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 10px;
            border-color: #ced4da;
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 10px;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="mb-4">Submit a Post</h2>
        <form action="submit_post_process.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control" id="content" name="content" rows="8" required></textarea>
            </div>
            <div class="form-group">
                <label for="website_link">Website Link:</label>
                <input type="text" class="form-control" id="website_link" name="website_link" required>
            </div>
            <div class="form-group">
                <label for="image">Upload Image:</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="image_alt">Image Alt Text:</label>
                <input type="text" class="form-control" id="image_alt" name="image_alt" placeholder="Enter Alt Text for Image">
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: #0D1F75; color: white; ">Submit</button>
        </form>
    </div>

    <div class="container text-center">
        <a href="index.php" class="btn btn-secondary mt-4" style="background-color: #0D1F75; color: white;">Back to Homepage</a>
    </div>
<br><br>
    <!-- JavaScript for displaying pop-up message -->
    <script>
        // Check if the URL contains the post_success parameter with a value of 1
        if (window.location.search.includes("post_success=1")) {
            // Display a success pop-up message
            window.alert("Post submitted successfully!");
            // Redirect to homepage after pressing OK
            window.location.href = "index.php";
        }
    </script>
</body>
</html>
