<?php
session_start();

// Database configuration
$servername = "localhost";
$username = "root"; // Update with your database username
$password = ""; // Update with your database password
$dbname = "dentura"; // Update with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
$contact_success = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $conn->real_escape_string($_POST['fullName']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert the data into the contacts table
    $sql = "INSERT INTO contacts (full_name, email, message) VALUES ('$fullName', '$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        $contact_success = true;
        $_SESSION['contact_success'] = true; // Store success in session to display in contactus.php
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();

// Redirect back to contactus.php after processing
header("Location: contactus.php");
exit();
?>
