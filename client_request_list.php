<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GetFit-Client_requests</title>
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
  background-color: #3d5a80;
}
p{
  color:#e0fbfc;
  font-family:garamond;
  font-size: 25px;
}
h1{
  color:#e0fbfc;
  font-family:tw cen mt;
 font-size: 65px;
}
button{
  font-family:tw cen mt;
background-color: #293241;
color: #e0fbfc;
font-size: 15px;
border-radius: 9px;
padding: 8px;
cursor: pointer;
border-width: 3px;
border-color: #98c1d9 ;
width:5%;
}
button:hover {
  box-shadow:
  0 10px 15px -3px #e7e8eb4f,
  0 4px 6px -2px #98c1d9;
}


</style>
</head>
<body>
  <h1 align="center">Client Requests</h1>


<script>
function updateRequestStatus(requestId, status) {
    fetch('status_in_client.php', { 
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ requestId: requestId, status: status })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
      
    })
    .catch(error => console.error('Error:', error));
}
</script>

</body>
</html>


<?php
session_start();
include "conn.php";

// Check if trainer_id is in session
if (!isset($_SESSION['trainer_id'])) {
    die("Trainer not logged in.");
}
$trainer_id = $_SESSION['trainer_id'];

// Fetch pending requests for this trainer
$sql = "SELECT client_requests.id, clients.name AS client_name, clients.email AS client_email
        FROM client_requests
        JOIN clients ON client_requests.id_client = clients.client_id
        WHERE client_requests.id_trainer = ? AND client_requests.status = 'Pending'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $trainer_id);
$stmt->execute();
$result = $stmt->get_result();

while ($request = $result->fetch_assoc()) {
    echo "<div>";
    echo "<p>Client: " . htmlspecialchars($request['client_name']) . " - " . htmlspecialchars($request['client_email']) . "</p>";
    echo "<button   onclick=\"updateRequestStatus(" . $request['id'] . ", 'approved')\">Approve</button>";
    echo "<button   onclick=\"updateRequestStatus(" . $request['id'] . ", 'rejected')\">Reject</button>";
    echo "</div>";
    echo"<br>"; echo"<br>";
}

$stmt->close();
$conn->close();
?>

