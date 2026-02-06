<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Signup Modals</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Welcome to Our Website</h2>
        <!-- Buttons to open the modals -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
            Login
        </button>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#signupModal">
            Signup
        </button>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="login.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Login</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="login_email">Email:</label>
                            <input type="email" class="form-control" id="login_email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="login_password">Password:</label>
                            <input type="password" class="form-control" id="login_password" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Signup Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="signup.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="signupModalLabel">Signup</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="signup_first_name">First Name:</label>
                            <input type="text" class="form-control" id="signup_first_name" name="first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="signup_last_name">Last Name:</label>
                            <input type="text" class="form-control" id="signup_last_name" name="last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="signup_email">Email:</label>
                            <input type="email" class="form-control" id="signup_email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="signup_password">Password:</label>
                            <input type="password" class="form-control" id="signup_password" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Signup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
