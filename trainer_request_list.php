<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GetFit - Trainer Requests</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      overflow-x: hidden;
      min-width: 100vw;
      min-height: 100vh;
      background-color: #3d5a80;
    }
    p {
      color: #e0fbfc;
      font-family: garamond;
      font-size: 25px;
    }
    h1 {
      color: #e0fbfc;
      font-family: "Tw Cen MT";
      font-size: 65px;
    }
    button {
      font-family: "Tw Cen MT";
      background-color: #293241;
      color: #e0fbfc;
      font-size: 15px;
      border-radius: 9px;
      padding: 8px;
      cursor: pointer;
      border-width: 3px;
      border-color: #98c1d9;
      width: 10%;
      margin-right: 10px;
    }
    button:hover {
      box-shadow: 0 10px 15px -3px #e7e8eb4f, 0 4px 6px -2px #98c1d9;
    }
  </style>
</head>
<body>
  <h1 align="center">Trainer Requests</h1>
  
  <?php
include 'conn.php';

$sql = "SELECT id, cname, cemail, ccont, cedu, certificate, file, status FROM trainer_requests WHERE status = 'Pending'";
$result = $conn->query($sql);

while ($coach = $result->fetch_assoc()) {
  echo <<<HTML
  <div>
  <p><strong>Name:</strong> {$coach['cname']}</p>
      <p><strong>Email:</strong> {$coach['cemail']}</p>
      <p><strong>Contact:</strong>  {$coach['ccont']} </p>
      <p><strong>Specialization:</strong>  {$coach['cedu']}  </p>
      <p><strong>Certificate:</strong>   {$coach['certificate']}  </p>
      <p><strong>Certificate File:</strong> <img src={$coach['file']} alt='Certificate Image' width='400'></p>
      <button onclick="updateRequestStatus({$coach['id']}, 'accepted')">Accept</button>
      <button onclick="updateRequestStatus({$coach['id']}, 'rejected')">Reject</button>

  </div><br><br>
HTML;


}

$conn->close();
?>


  <script type="text/javascript">

function updateRequestStatus(requestId, status) {
    console.log("Request ID:", requestId); // Check if ID is correct
    console.log("Status:", status); // Check if status is correct

    fetch('update_status_trainer.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: requestId, status: status })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Check the response data
        if (data.success) {
            alert("Response Submitted...");
            location.reload(); // Reload to show updated list
        } else {
            alert("Somethinggg Fishhhyyyy!!!.");
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("An error occurred while updating the request status.");
    });
}

</script>
</body>
</html>
