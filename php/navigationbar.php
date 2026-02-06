
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dentura</title>

    <link rel="icon" href="/assets/images/dlogo.ico" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/navigationbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg custom-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand" href="homepage.php">
                <img src="/assets/images/DENTURA.png" alt="DENTURA" style="width: 100px; height: auto;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item category">
                        <a class="nav-link" aria-current="page" href="homepage.php">Home</a>
                    </li>
                    <li class="nav-item category">
                      <a class="nav-link" aria-current="page" href="aboutus.php">About Us</a>
                    </li>
                    <li class="nav-item category">
                      <a class="nav-link" aria-current="page" href="services-1.php">Services</a>
                    </li>
                    
                    <li class="nav-item category">
                        <a class="nav-link" aria-current="page" href="contactus.php">Contact Us</a>
                    </li>
                </ul>
                
                <!-- Right-aligned user options -->
                <!-- Right-aligned user options -->
<ul class="navbar-nav">
    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
        
        <li class="nav-item">
            <span class="nav-link">Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?></span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
        <li class="nav-item">
            <i class="fas fa-bell  notification-icon" data-bs-toggle="modal" data-bs-target="#notificationsModal"></i>
        </li>
    <?php else: ?>
        <li class="nav-item">
            <a class="nav-link coloraccount" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link coloraccount" data-bs-toggle="modal" data-bs-target="#signupModal">Sign up</a>
        </li>        
    <?php endif; ?>
</ul>

            </div>
        </div> 
    </nav>

 <!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="login.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Signup Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="signup.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="signupModalLabel">Signup</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Signup</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
