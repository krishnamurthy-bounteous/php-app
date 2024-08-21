<?php
include 'db.php';

// Start output buffering
ob_start();

$id = $_GET['id'];

// Ensure that no output is generated before this header function
$sql = "DELETE FROM users WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    // Redirect after deletion
    header("Location: index.php");
    exit; // Stop script execution after the header
} else {
    echo "Error deleting record: " . $conn->error;
}

// End output buffering and flush output
ob_end_flush();
?>
