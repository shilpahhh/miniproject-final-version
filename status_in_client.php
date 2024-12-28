

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GetFit-Status_client</title>

        
 <style>
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
body{
  overflow-x: hidden;
  /* padding:1em; */
  min-width:100vw;
  min-height: 100vh;
  background-color:#293241;
}
h1{
 font-family:tw cen mt;
 font-size: 65px;
 color:  #edf2f4;
}
p{
  font-family:garamond;
 font-size: 25px;
 color:#edf2f4;
}
 </style>
 </head>
 <body>
 <h1 align="center">Request Status</h1>

  
 </body>
 </html>


 <?php
session_start();
include "conn.php";

// Check if the client is logged in
if (!isset($_SESSION['client_id'])) {
    die("Client not logged in.");
}

$client_id = $_SESSION['client_id'];

// Handle both fetching requests and updating status
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // This part updates the request status
    $data = json_decode(file_get_contents("php://input"), true);
    $request_id = $data['requestId'];
    $status = $data['status'] == "approved" ? "Accepted" : "Rejected"  ;

    // Update the status of the client request
    $stmt = $conn->prepare("UPDATE client_requests SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $request_id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Your Request " . ($status == 'approved' ? "approved" : "rejected") . " successfully."]);
    } else {
        echo json_encode(["message" => "Sorry It's Bad News."]);
    }

    $stmt->close();
} else {
    $sql = "SELECT coach.cname AS trainer_name, client_requests.status, client_requests.id 
            FROM client_requests
            JOIN coach ON client_requests.id_trainer = coach.trainer_id
            WHERE client_requests.id_client = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $client_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo "<p>Trainer: " . htmlspecialchars($row['trainer_name']) . " - Status: " 
        . htmlspecialchars(ucfirst($row['status'])) ;
    }

    $stmt->close();
}

$conn->close();
?>
