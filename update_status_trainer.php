<?php
session_start();
include "conn.php";

// Get raw POST data
$inputData = file_get_contents("php://input");
$data = json_decode($inputData, true);

// Ensure data contains id and status
if (isset($data['id']) && isset($data['status'])) {
    $requestId = $data['id'];
    $status = $data['status'];

    // Update the request status in the database
    $query = "UPDATE trainer_requests SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $requestId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update request status']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid data provided']);
}
$conn->close();
?>
