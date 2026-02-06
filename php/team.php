<?php
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

// Define target directory for dentist photos
$target_dir = "../admin/php/uploads/";

// Fetch dentists from the database, including position and social links
$sql = "SELECT name, photo, position, fb_link, ig_link FROM dentists";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Dentists</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/team.css">
</head>

<body>
    <div class="team-boxed">
        <div class="container">
            <h2 class="text-center mb-4">Our Dentists</h2>
            <div class="row people">
                <?php
                // Check if there are dentists in the database
                if ($result->num_rows > 0) {
                    // Loop through each dentist and generate a box
                    while ($row = $result->fetch_assoc()) {
                        $name = htmlspecialchars($row['name']);
                        $position = htmlspecialchars($row['position']);
                        $photo = htmlspecialchars($row['photo']);
                        $fb_link = htmlspecialchars($row['fb_link'] ?? '#');
                        $ig_link = htmlspecialchars($row['ig_link'] ?? '#');
                        $profile_image = $target_dir . basename($photo);

                        echo "
                        <div class='col-md-6 col-lg-4 item'>
                            <div class='box'>
                                <img class='rounded-circle' src='$profile_image' alt='$name' style='width:150px; height:150px;'>
                                <h3 class='name'>$name</h3>
                                <p class='title'>$position</p>
                                <div class='social'>
                                    <a href='$fb_link' target='_blank'><i class='fa fa-facebook-official'></i></a>
                                    <a href='$ig_link' target='_blank'><i class='fa fa-instagram'></i></a>
                                </div>
                            </div>
                        </div>";
                    }
                } else {
                    echo "<p class='text-center'>No dentists found.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>
