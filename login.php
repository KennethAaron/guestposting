<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Kodinger">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login Mention Project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/my-login.css">
    <style>
        .btn-primary {
            background-color: #0D1F75;
            border-color: #0D1F75;
        }

        .btn-primary:hover {
            background-color: #061259;
            border-color: #061259;
        }
    </style>
</head>
<body class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <!-- Wrap the image inside an anchor tag -->
                    <a href="index.php">
                        <div class="brand">
                            <img src="img/favicon.png" alt="mentionproject">
                        </div>
                    </a>
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title text-center">Login</h4>
                            <form id="loginForm" method="POST" class="my-login-validation" novalidate="" form action="login_process.php" method="POST">
                                
                                <div class="form-group">
                                    <label for="email">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control" name="email" required>
                                    <div class="invalid-feedback">
                                        Your email is invalid
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required data-eye>
                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
                                </div>
    <br>
                                
                                
								<button type="submit" class="btn btn-primary btn-block">Login</button>
                                <div class="mt-4 text-center">
                                    Don't have an account? 
                                </div><br>
                                <div class="form-group m-0 justified text-center">
                                <a href="register.php" class="btn btn-primary mr-2" target="_blank" style="background-color: #4565DB; border-color: #4565DB;">Register</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="footer">
                        Copyright &copy; 2024 &mdash; Mention Project 
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/my-login.js"></script>
    <script>
        // Add event listener to form submission
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            // Retrieve the password input element
            var passwordInput = document.getElementById("password");
            
            // Check if password is empty or not
            if (passwordInput.value.trim() === "") {
                // Display alert for empty password
                alert("Please enter your password.");
                // Prevent form submission
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
