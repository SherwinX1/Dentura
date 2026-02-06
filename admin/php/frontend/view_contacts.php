<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../loginadmin.php"); // Redirect to login if not logged in
    exit();
}

// Database configuration for booking notifications and contacts
$conn = new mysqli("localhost", "root", "", "dentura");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Count new (pending) bookings for notifications
$result = $conn->query("SELECT COUNT(*) as newBookings FROM bookings WHERE status = 'Pending'");
$newBookings = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $newBookings = $row['newBookings'];
}

// Fetch all contacts from the database for display
$sql = "SELECT id, full_name, email, message, created_at FROM contacts";
$contactsResult = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DenturAdmin</title>
    <link rel="icon" href="/assets/images/dlogo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/admin/css/admin_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <style>
        /* Additional CSS for hiding/showing sections */
        .hidden {
            display: none;
        }
    </style>
</head>
<body>

<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="/assets/images/DENTURA.png" alt="DenturAdmin Logo" style="height: 100px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span class="nav-link text-dark">Hello, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b> !</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#" id="notification-btn">
                        <i class="fas fa-bell"></i> Notifications 
                        <?php if ($newBookings > 0): ?>
                            <span class="badge badge-danger"><?php echo $newBookings; ?></span>
                        <?php endif; ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../logout.php" class="nav-link text-dark">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <h4 class="text-center">D E N T U R A D M I N</h4>
                <ul class="nav flex-column">
                    <li class="nav-item active">
                        <a class="nav-link" href="../manage_admin.php">
                            <i class="fas fa-user-shield"></i> Manage Admins
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_dentists.php">
                            <i class="fas fa-user-md"></i> Dentists
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_services.php">
                            <i class="fas fa-tools"></i> Services
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_branches.php">
                            <i class="fas fa-building"></i> Branches
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_contacts.php">
                            <i class="fas fa-envelope"></i> View Contacts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../view_bookings.php">
                            <i class="fas fa-calendar-check"></i> View Bookings
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <h1 class="text-center mt-5 dashboard-header">Welcome to the D E N T U R A D M I N</h1>
            <?php
                if (isset($_GET['message'])) {
                    $message = htmlspecialchars($_GET['message']);
                    echo "<div class='alert alert-success text-center'>$message</div>";
                }
                ?>
            <!-- Display Contacts Information -->
            <div id="contacts-info" class="mt-5">
                

                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($contactsResult->num_rows > 0): ?>
                            <?php while ($contact = $contactsResult->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($contact['id']); ?></td>
                                    <td><?php echo htmlspecialchars($contact['full_name']); ?></td>
                                    <td><?php echo htmlspecialchars($contact['email']); ?></td>
                                    <td><?php echo htmlspecialchars(substr($contact['message'], 0, 50)) . (strlen($contact['message']) > 50 ? '...' : ''); ?></td>
                                    <td><?php echo htmlspecialchars($contact['created_at']); ?></td>
                                    <td>
                                        <a href="#" class="text-info mr-3 action-button" data-id="<?php echo htmlspecialchars($contact['id']); ?>" data-action="view" title="View Message">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="text-danger action-button" data-id="<?php echo htmlspecialchars($contact['id']); ?>" data-action="delete" title="Delete Message">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan='6' class='text-center'>No contact messages found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>



<!-- Modal for Viewing Message -->
<div class="modal fade" id="viewMessageModal" tabindex="-1" role="dialog" aria-labelledby="viewMessageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewMessageModalLabel">View Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6><strong>From:</strong> <span id="modalFullName"></span></h6>
                <h6><strong>Email:</strong> <span id="modalEmail"></span></h6>
                <hr>
                <p id="modalMessageContent"></p>
                <p><small><strong>Received at:</strong> <span id="modalCreatedAt"></span></small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap Modal for Confirmation -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this message?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmButton">Confirm</button>
            </div>
        </div>
    </div>
</div>





<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let contactIdToDelete = null;

        document.querySelectorAll('.action-button').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const action = this.getAttribute('data-action');
                const contactId = this.getAttribute('data-id');

                if (action === 'view') {
                    // AJAX request to fetch contact details
                    fetch(`../contact_view.php?id=${contactId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Populate the modal with the contact information
                                document.getElementById('modalFullName').innerText = data.contact.full_name;
                                document.getElementById('modalEmail').innerText = data.contact.email;
                                document.getElementById('modalMessageContent').innerText = data.contact.message;
                                document.getElementById('modalCreatedAt').innerText = data.contact.created_at;

                                // Show the view message modal
                                $('#viewMessageModal').modal('show');
                            } else {
                                alert(data.error || 'Failed to load contact message.');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                } else if (action === 'delete') {
                    // Save the contact ID for deletion
                    contactIdToDelete = contactId;

                    // Show the confirmation modal
                    $('#confirmModal').modal('show');
                }
            });
        });

        // Confirm deletion when the "Confirm" button in the modal is clicked
        document.getElementById('confirmButton').addEventListener('click', function () {
            if (contactIdToDelete) {
                window.location.href = `../delete_contact.php?id=${contactIdToDelete}`;
            }
        });
    });
</script>




<script>
    $(document).ready(function () {
        $('#notification-btn').on('click', function (e) {
            e.preventDefault();
            if (<?php echo $newBookings; ?> > 0) {
                swal({
                    title: "Pending Appointments",
                    text: "You have <strong><?php echo $newBookings; ?></strong> pending appointments. Please review them in Bookings!",
                    html: true,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Go to Bookings",
                    cancelButtonText: "Close",
                    closeOnConfirm: false,
                    closeOnCancel: true
                }, function (isConfirm) {
                    if (isConfirm) {
                        window.location.href = "../view_bookings.php";
                    }
                });
            }
        });
    });
</script>

</body>
</html>
