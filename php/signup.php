<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $checkEmailQuery = "SELECT email FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        // Email already exists
        echo "<script>
                alert('Error: Email is already in use.');
                window.location.href = 'homepage.php';
              </script>";
    } else {
        // Insert new user
        $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Signup successful. You can now login.');
                    window.location.href = 'homepage.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error: " . $conn->error . "');
                    window.location.href = 'homepage.php';
                  </script>";
        }
    }
}
?>
