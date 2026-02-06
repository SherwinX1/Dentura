<?php
session_start();

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

// Check if form data is set and the user is logged in
if (isset($_SESSION['user_id'], $_POST['number'], $_POST['reason'], $_POST['branch'], $_POST['date'], $_POST['time'])) {
    // Get the user ID from the session
    $user_id = $_SESSION['user_id'];

    // Retrieve first name, last name, and email for the user
    $userQuery = $conn->prepare("SELECT first_name, last_name, email FROM users WHERE id = ?");
    $userQuery->bind_param("i", $user_id);
    $userQuery->execute();
    $userQuery->bind_result($first_name, $last_name, $email);
    $userQuery->fetch();
    $userQuery->close();

    // Combine first and last name
    $name = $first_name . ' ' . $last_name;

    // Prepare and bind the statement for booking insertion
    $stmt = $conn->prepare("INSERT INTO bookings (uid, name, email, number, reason, branch, date, time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssss", $user_id, $name, $email, $number, $reason, $branch, $date, $time);

    // Get remaining form data
    $number = $_POST['number'];
    $reason = $_POST['reason'];
    $branch = $_POST['branch'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['booking_success'] = "Booking successfully made!";
        header("Location: booking_form.php"); // Redirect to the booking form with success message
        exit();
    } else {
        echo "Error: " . $stmt->error; // Database insertion error
    }

    $stmt->close();
} else {
    echo "Error: Missing form data or user not logged in.";
}

$conn->close();
?>
