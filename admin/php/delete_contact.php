<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../loginadmin.php");
    exit();
}

// Check if the contact ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: view_contacts.php?message=No%20contact%20ID%20provided&type=error");
    exit();
}

// Sanitize the contact ID
$contactId = intval($_GET['id']);

// Connect to the database
$conn = new mysqli("localhost", "root", "", "dentura");

if ($conn->connect_error) {
    header("Location: view_contacts.php?message=Database%20connection%20failed&type=error");
    exit();
}

// Delete the contact
$sql = "DELETE FROM contacts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $contactId);

if ($stmt->execute()) {
    header("Location: frontend/view_contacts.php?message=Contact%20deleted%20successfully&type=success");
} else {
    header("Location: frontend/view_contacts.php?message=Failed%20to%20delete%20contact&type=error");
}

// Close connections
$stmt->close();
$conn->close();
exit();
?>
