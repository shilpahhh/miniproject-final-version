<?php
session_start();
include "conn.php";

// Check if client_id is in session
if (!isset($_SESSION['client_id'])) {
    die(json_encode(["message" => "Client not logged in."]));
}
$client_id = $_SESSION['client_id'];

// Get trainer_id from the POST request
$data = json_decode(file_get_contents("php://input"), true);
$trainer_id = $data['trainerId'];

// Insert request with 'pending' status
$stmt = $conn->prepare("INSERT INTO client_requests (id_client, id_trainer, status) VALUES (?, ?, 'pending')");
$stmt->bind_param("ii", $client_id, $trainer_id);

if ($stmt->execute()) {
    echo json_encode(["message" => "Please Login To See Your Request Status .."]);
} else {
    echo json_encode(["message" => "Failed to send request."]);
}

$stmt->close();
$conn->close();
?>
