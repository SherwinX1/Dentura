<?php
session_start();

// Database configuration
$servername = "localhost"; // Database host
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password (usually empty)
$dbname = "dentura"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission to add a new service
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['service'])) {
    $newService = htmlspecialchars(trim($_POST['service']));
    $description = htmlspecialchars(trim($_POST['description']));
    $cost = htmlspecialchars(trim($_POST['cost']));

    // Handle the image upload
    $image = $_FILES['image'];
    $target_dir = "uploads/"; // Ensure this directory exists and is writable
    $target_file = $target_dir . basename($image['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($image['tmp_name']);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (5MB limit)
    if ($image['size'] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    $allowed_file_types = ['jpg', 'png', 'jpeg', 'gif'];
    if (!in_array($imageFileType, $allowed_file_types)) {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 due to an error
    if ($uploadOk === 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Attempt to move the uploaded file to the target directory
        if (move_uploaded_file($image['tmp_name'], $target_file)) {
            // Prepare and bind the statement to insert service details into the database
            $stmt = $conn->prepare("INSERT INTO services (service_name, description, cost, image) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssds", $newService, $description, $cost, $target_file);

            // Execute the statement
            if ($stmt->execute()) {
                header('Location: frontend/view_services.php');
                exit;
            } else {
                echo "Error: " . $stmt->error; // Handle errors
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/css/add_service.css">
</head>
<body>
<div class="container">
    <div class="form-box">
        <h1 class="mt-5">Add Dental Service</h1>
        
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="service" class="form-label">Service Name</label>
                <input type="text" class="form-control" id="service" name="service" required>
            </div>
            <div class="form-group mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="cost" class="form-label">Cost</label>
                <input type="number" class="form-control" id="cost" name="cost" step="0.01" required>
            </div>
            <div class="form-group mb-3">
                <label for="image" class="form-label">Service Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Service</button>
        </form>
        
        <div class="mt-4">
            <a href="frontend/view_services.php" class="btn btn-secondary">Back to Services</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
