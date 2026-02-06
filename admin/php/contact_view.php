<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'error' => 'Unauthorized access']);
    exit();
}

// Check if the contact ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode(['success' => false, 'error' => 'No contact ID provided']);
    exit();
}

// Sanitize the contact ID
$contactId = intval($_GET['id']);

// Connect to the database
$conn = new mysqli("localhost", "root", "", "dentura");

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Database connection failed']);
    exit();
}

// Fetch the contact details
$sql = "SELECT full_name, email, message, created_at FROM contacts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $contactId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $contact = $result->fetch_assoc();
    echo json_encode(['success' => true, 'contact' => $contact]);
} else {
    echo json_encode(['success' => false, 'error' => 'Contact not found']);
}

// Close connections
$stmt->close();
$conn->close();
?>
