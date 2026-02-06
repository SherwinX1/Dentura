<?php
require 'config.php'; // Include your database connection file

// Define the target directory for image uploads.
$target_dir = "../admin/php/uploads/";

// Fetch all services from the database.
$sql = "SELECT service_name, image, description FROM services";
$result = $conn->query($sql);

$services = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if (!str_starts_with($row['image'], $target_dir)) {
            $row['image'] = $target_dir . basename($row['image']);
        }
        $services[] = $row;
    }
}
$conn->close();
?>

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services</title>
    <link rel="icon" href="/assets/images/dlogo.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/css/services-1.css">
    <style>
        /* Slower carousel transition time */
        .carousel-item {
            transition: transform 1.5s ease, opacity 1.5s ease;
        }
    </style>
</head>
<body>
    <?php include 'navigationbar.php'; ?>
    <?php include 'notif_modal.php'; ?>

    <div class="container mt-5">
        <h2 class="mb-4 title-page"><b>Our Services</b></h2>
        <?php if (!empty($services)): ?>
            <div id="servicesCarousel" class="carousel slide" data-bs-ride="false" data-bs-interval="false">
                <div class="carousel-inner">
                    <?php foreach ($services as $index => $service): ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <img src="<?php echo htmlspecialchars($service['image']); ?>" class="d-block w-100" alt="<?php echo htmlspecialchars($service['service_name']); ?>" style="max-height: 500px; object-fit: cover;">
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#servicesCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#servicesCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <!-- Service Description Card -->
            <div class="card mt-4 mx-auto" style="max-width: 700px;">
                <div class="description-box" id="serviceDescription">
                    <h5 class="service-name"><?php echo htmlspecialchars($services[0]['service_name']); ?></h5>
                    <p class="service-description"><?php echo htmlspecialchars($services[0]['description']); ?></p>
                </div>
            </div>
        <?php else: ?>
            <p>No services available at the moment.</p>
        <?php endif; ?>
    </div>

    <br><br><br><br><br><br><br><br><br>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const descriptions = <?php echo json_encode(array_column($services, 'description')); ?>;
    const names = <?php echo json_encode(array_column($services, 'service_name')); ?>;
    const descriptionBox = document.getElementById('serviceDescription');
    const serviceName = descriptionBox.querySelector('.service-name');
    const serviceDescription = descriptionBox.querySelector('.service-description');

    document.getElementById('servicesCarousel').addEventListener('slide.bs.carousel', function (event) {
        serviceName.innerText = names[event.to];
        serviceDescription.innerText = descriptions[event.to];
    });
    </script>
</body>
</html>
