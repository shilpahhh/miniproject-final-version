<?php
session_start();
include 'conn.php';

if (!isset($_SESSION['trainer_id'])) {
    echo json_encode(["success" => false, "message" => "Trainer not logged in"]);
    exit;
}

$trainer_id = $_SESSION['trainer_id'];
$trainerDetailsQuery = "SELECT cname, cemail, ccont, cedu, certificate, file FROM coach WHERE trainer_id = ?";
$stmt = $conn->prepare($trainerDetailsQuery);
$stmt->bind_param("i", $trainer_id);
$stmt->execute();
$stmt->bind_result($cname, $cemail, $ccont, $cedu, $certificate, $file);
$stmt->fetch();
$stmt->close();

// Insert request into trainer_requests table
$sql = "INSERT INTO trainer_requests (id_trainer, cname, cemail, ccont, cedu, certificate, file, status, request_date)
           VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending', NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issssss", $trainer_id, $cname, $cemail, $ccont, $cedu, $certificate, $file);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Error sending request"]);
}

$stmt->close();
$conn->close();
?>
