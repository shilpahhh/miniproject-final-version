<?php

session_start(); 
include "conn.php"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cname = $_POST['cname'] ?? '';
    $trainer_id = $_POST['trainer_id'] ?? '';

    if ($trainer_id) {
      
        $stmt = $conn->prepare("SELECT * FROM coach WHERE trainer_id = ?");
        $stmt->bind_param("s", $trainer_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc(); 
            $cemail = $row['cemail']; 
            $trainer_id = $row['trainer_id']; 
            $ccont = $row['ccont']; 
            $cemail = $row['cemail']; 
            $cemail = $row['cemail']; 
            $cedu = $row['cedu'];
            $certificate = $row['certificate'];
            $file = $row['file'];

            $_SESSION['trainer_id']=$trainer_id;

            // header("Location: insert.php");
            // exit();
        } 
        else {
            echo "OOOPS !! No details found.";
        }
    } 
    else {
        echo "Invalid trainer ID.";
    }
}


if (!isset($_SESSION['trainer_id'])) {
    // header("Location: login_selection.php");
    // exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GetFit-coach_profile</title>
  <style>
    *{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
body{
    background-repeat: no-repeat;
    overflow-x: hidden;
  /* padding:1em; */
  min-width:100vw;
  min-height: 100vh;
  background-color:#507f80;
}
.body.background{
    padding-left:567px;
}
h1{
    font-family: tw cen mt ;
    color: black;
    text-align:right;
   padding-right:356px;
   padding-top: 123px;
   font-size: 65px;
}
p{
    font-family: garamond;
    font-size: 45px;
    color:black;
    text-align: right;
    padding-right: 445px;
}
.b1{
    background-color:black;
    color: white;
    font-size: 15px;
    margin-right: 20px;
    font-family:tw cen mt; 
    padding: 8px;
    text-align: center;
    border-radius: 10px;
    border-color: black;
   cursor: pointer;
   width: 24%;
}
.b2{
    background-color:black;
    color: white;
    font-size: 15px;
    margin-right: 20px;
    font-family:tw cen mt; 
    padding: 8px;
    text-align: center;
    border-radius: 10px;
    border-color: black;
   cursor: pointer;
   width: 24%;
}
.b3{
    background-color:black;
    color: white;
    font-size: 15px;
    margin-right: 20px;
    font-family:tw cen mt; 
    padding: 8px;
    text-align: center;
    border-radius: 10px;
    border-color: black;
   cursor: pointer;
   width: 24%;
}
.buttons{
    padding-left:294px;
    padding-bottom:56px;
}
  </style>
</head>

<body  >
    <h1>YOUR PROFILE</h1>
    <h2 class="a cname" ><?php echo "Welcome , ".$cname ?></h2>
    <h2 class="b"><?php echo "Unique Id : " .$trainer_id; ?></h2>
    <h2 class="c cemail"><?php echo "Email Id : " .$cemail; ?></h2>
    <h2 class="d ccont"><?php echo "Contact : " .$ccont; ?></h2>
    <h2 class="d cedu"><?php echo "Specialization : " .$cedu; ?></h2>
    <h2 class="d certificate"><?php echo "Certificate : " .$certificate; ?></h2>
    <h2 class="d file"><?php echo "<img src='$file' alt=image>"; ?></h2>
<div class="buttons">
    <a href="./status_in_trainer.php"> <button class="b1">Request Status</button></a>
    <a href="./client_request_list.php"><button class="b2">Client Requests</button></a>
    <button class="b3"  onclick="sendJoinRequest()">Submit Request</button>
</div>


<script>
    
    function sendJoinRequest() {
    // Retrieve the trainer's ID from the PHP session
    let idTrainer = <?php echo json_encode($_SESSION['trainer_id']); ?>;

    // Construct the request data
    let requestData = {
        id_trainer: idTrainer
    };

    // Make the POST request to 'trainer_requesting.php'
    fetch('trainer_requesting.php', { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(requestData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Request Sended Successfully!");
        } else {
            alert("Something Fishhhyyy... ");
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Something Went Wrong.");
    });
}


</script>
    </body>
</html>




