<?php

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
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

    // Get the user ID from the session
    $user_id = $_SESSION['user_id'];

    // Fetch the bookings for the logged-in user
    $bookings = [];
    $sql = "SELECT * FROM bookings WHERE uid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $bookings[] = $row;
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- Modal HTML -->
<div class="modal fade" id="notificationsModal" tabindex="-1" role="dialog" aria-labelledby="notificationsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationsModalLabel">Your Bookings</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <?php if (!empty($bookings)): ?>
                        <?php foreach ($bookings as $booking): ?>
                            <li class="list-group-item">
                                <strong>Date:</strong> <?php echo htmlspecialchars($booking['date']); ?><br>
                                <strong>Time:</strong> <?php echo htmlspecialchars($booking['time']); ?><br>
                                <strong>Reason:</strong> <?php echo htmlspecialchars($booking['reason']); ?><br>
                                <strong>Branch:</strong> <?php echo htmlspecialchars($booking['branch']); ?><br>
                                <strong>Status:</strong> <?php echo htmlspecialchars($booking['status']); ?>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="list-group-item">No bookings found.</li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
