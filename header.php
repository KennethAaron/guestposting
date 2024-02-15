    <!-- header.php -->
    <?php
    // Generate a random number to append as a query parameter
    $random_number = rand();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mention Project</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f3f3f3;
            }
            .navbar-gg {
                background-color: #0D1F75 !important;
            }
            .navbar-brand {
                padding: 0;
            }
            .navbar-brand img {
                max-height: 40px;
            }
            .nav-link {
                color: #fff !important;
                transition: color 0.3s;
            }
            .nav-link:hover {
                color: #d9d9d9 !important;
            }
            .dropdown-menu {
                background-color: #0D1F75 !important;
            }
            .dropdown-item {
                color: #fff !important;
            }
            .dropdown-item:hover {
                background-color: #061259 !important;
            }
            .dropdown-divider {
                background-color: #061259 !important;
            }
            /* Hover effects for Register and Login */
            .nav-item:hover .nav-link {
                color: #d9d9d9 !important;
                text-decoration: none;
            }

        </style>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-gg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php?r=<?php echo $random_number; ?>">
                <img src="img/logo.png" alt="Rectangle Sample Image">
            </a>
            <!-- Navbar toggler for responsive design -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar content -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php?r=<?php echo $random_number; ?>">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php?r=<?php echo $random_number; ?>">Login</a>
                        </li>
                    <?php else: ?>
                        <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="submit_post.php?r=<?php echo $random_number; ?>">
                                <button class="btn btn-primary" style="background-color: #C0FFFF; color: black;">Submit Post</button>
                            </a>
                        </li>
                        <li class="nav-item">
                        </li>
                        <?php endif; ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                User
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="account.php?r=<?php echo $random_number; ?>">Manage Posts</a>
                                <a class="dropdown-item" href="edit_account.php?r=<?php echo $random_number; ?>">Edit Account</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index.php?logout=true&r=<?php echo $random_number; ?>">Logout</a>
                            </div>
                        </li>
                        <!-- Button for Submit Post -->
                        
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <nav class="navbar navbar-dark" style="background-color: #4565DB;">
        <div class="container">
            <div class="text-center">
                <p class="text-white"><b>FIND AMAZING NEW COMPANIES AND FANTASTIC PROJECTS</b></p>
            </div>
        </div>
    </nav>


