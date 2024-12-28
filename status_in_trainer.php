<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GetFit-Status_trainer</title>

        
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
  background-color: #8d99ae;
}
h1{
 font-family:tw cen mt;
 font-size: 45px;
}
p{
  padding-top:23px;
  font-family:garamond;
 font-size: 25px;
 color:black;
}
 </style>
 </head>
 <body>
 <h1 align="center">Request Status</h1>

 </body>
 </html>


 <?php
session_start();
include 'conn.php';

if (!isset($_SESSION['trainer_id'])) {
    die("Trainer not logged in.");
}

$trainer_id = $_SESSION['trainer_id'];

$sql = "SELECT status FROM trainer_requests WHERE id_trainer = ? ORDER BY request_date DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $trainer_id);
$stmt->execute();
$stmt->bind_result($status);
$stmt->fetch();

if ($status !== null) {
    echo "<p> Your Request: " . htmlspecialchars($status) ;
} else {
    echo "Damnnnh...Nothing Available!";
}

$stmt->close();
$conn->close();
?>
