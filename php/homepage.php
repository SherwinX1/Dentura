<?php
session_start();
?>

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
    <link rel="stylesheet" href="/css/homepage.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Include the Navigation Bar -->
    <?php include 'navigationbar.php'; ?>
    <?php include 'notif_modal.php'; ?>

    <div class="d-flex align-items-center justify-content-center flex-column flex-lg-row mt-4">
        <div class="image-container me-4">
            <img src="/assets/images/Saly-44.png" alt="image">
        </div>

        <main class="text-container">
            <h1>Welcome to Dentura</h1>
            <p>One of the best dental clinics in Pangasinan. We are here to provide you with the best dental care services.</p>
            
            <!-- Check if the user is logged in before showing the booking link -->
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                <a href="booking_form.php" class="btn btn-appointment btn-lg">Book an Appointment</a>
            <?php else: ?>
                <!-- Show login modal if user is not logged in -->
                <a class="btn btn-appointment text-white btn-lg" data-toggle="modal" data-target="#loginModal">
                    Book an Appointment
            </a>
            <?php endif; ?>
            
            
        </main>
    </div>

    <br>
    </div>

    <br>

    

    <?php include 'about.php'; ?>

    <div>
        <h2 class="text-center">Latest Reviews</h2>
        <br>
        <?php include 'review.php'; ?>
    </div>

    <div>
        <h2 class="text-center">Meet our Dentists</h2>
    </div>
    
    <?php include 'team.php'; ?>

    <br><br>
    <div><br></div>

    <?php include 'mission.php'; ?>

    <div><br></div>

    <br><br><br><br>

    <?php include 'branch.php'; ?>

    <br><br><br><br><br>
    <?php include 'footer.php'; ?>

    


    
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
