<?php
include "conn.php";

$data = json_decode(file_get_contents("php://input"), true);
$request_id = $data['requestId'];
$status = $data['status'];

// Update the status of the client request
$stmt = $conn->prepare("UPDATE client_requests SET status = ? WHERE id = ?");
$stmt->bind_param("si", $status, $request_id);

if ($stmt->execute()) {
    echo json_encode(["message" => "Request " . ($status == 'approved' ? "approved" : "rejected") . " successfully."]);
} else {
    echo json_encode(["message" => "Failed to update request status."]);
}

$stmt->close();
$conn->close();
?>
