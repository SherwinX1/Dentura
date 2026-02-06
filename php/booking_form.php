<?php
// Start the session conditionally
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database configuration
$servername = "localhost";
$username = "root";
$password = ""; // Use your database password
$dbname = "dentura"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the current user's information if logged in
$logged_in_user = null;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $userQuery = $conn->prepare("SELECT first_name, last_name, email FROM users WHERE id = ?");
    $userQuery->bind_param("i", $user_id);
    $userQuery->execute();
    $userQuery->bind_result($first_name, $last_name, $email);
    $userQuery->fetch();
    $logged_in_user = ['name' => $first_name . ' ' . $last_name, 'email' => $email];
    $userQuery->close();
}

// Fetch service names for the reason dropdown
$reasons = [];
$reasonQuery = "SELECT service_name FROM services";
$result = $conn->query($reasonQuery);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reasons[] = $row['service_name'];
    }
}

// Fetch branch locations for the branch dropdown
$branches = [];
$branchQuery = "SELECT location FROM branches";
$result = $conn->query($branchQuery);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $branches[] = $row['location'];
    }
}

// Check for success message
$booking_success = isset($_SESSION['booking_success']) ? $_SESSION['booking_success'] : false;
if ($booking_success) {
    unset($_SESSION['booking_success']); // Clear the session variable after displaying the message
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denture Ni Ano</title>
    <link rel="icon" href="/assets/images/dlogo.ico" type="image/x-icon">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/homepage.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'navigationbar.php'; ?>
    <?php include 'notif_modal.php'; ?>

    <div class="container-fluid d-flex align-items-center justify-content-center vh-100">
        <div class="row w-75">
            <div class="col-md-6">
                <div class="image-container">
                    <img src="/assets/images/saly10.png" alt="Book an Appointment" class="contact-image">
                </div>
            </div>
            <div class="col-md-6 booking-form">
                <h5 class="text-center excited-text">We're excited to assist you</h5>
                <h2 class="text-center">Book an Appointment</h2>

                <form id="bookingForm" method="POST" action="process_booking.php">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="name" name="name" 
                                value="<?php echo htmlspecialchars($logged_in_user['name'] ?? ''); ?>" 
                                placeholder="Enter your name" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" id="email" name="email" 
                                value="<?php echo htmlspecialchars($logged_in_user['email'] ?? ''); ?>" 
                                placeholder="Enter your email" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="tel" class="form-control" id="number" name="number" placeholder="Enter your number" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reason"><i class="fas fa-book"></i> Reason for Booking</label>
                        <select class="form-control" id="reason" name="reason" required>
                            <option value="" disabled selected>Select your reason</option>
                            <?php foreach ($reasons as $reason): ?>
                                <option value="<?php echo htmlspecialchars($reason); ?>"><?php echo htmlspecialchars($reason); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="branch"><i class="fas fa-map-marker-alt"></i> Branch</label>
                        <select class="form-control" id="branch" name="branch" required>
                            <option value="" disabled selected>Select a branch</option>
                            <?php foreach ($branches as $branch): ?>
                                <option value="<?php echo htmlspecialchars($branch); ?>"><?php echo htmlspecialchars($branch); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            </div>
                            <input type="time" class="form-control" id="time" name="time" required min="07:30" max="16:00">
                        </div>
                    </div>
                    <button type="submit" id="booked" class="btn btn-submit btn-block mt-3" style="background-color: #0085BE; color: #ffffff;">Book Now</button>
                </form>

                <!-- Success message displayed after a successful booking -->
                <?php if ($booking_success): ?>
                    <p class="text-success text-center mt-3">Booking sent! Check your notifications.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    // Set the minimum date to today for the date input
    document.getElementById('date').min = new Date().toISOString().split('T')[0];

    // Optional: Set the default time to 7:30 AM
    document.getElementById('time').value = '07:30';

    // Prevent multiple submissions by listening to the form's submit event
    document.getElementById('bookingForm').addEventListener('submit', function(event) {
        document.getElementById('booked').disabled = true; // Disable the button
        document.getElementById('booked').innerHTML = "Booking..."; // Optionally, change button text to show action
    });
    </script>
</body>
</html>
