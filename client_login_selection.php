<?php

session_start(); 
include "conn.php"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $password = $_POST['password'] ?? '';
  $client_id = $_POST['client_id'] ?? '';

  $stmt = $conn->prepare("SELECT * FROM `clients` WHERE client_id=? AND pass=?");
  $stmt->bind_param("is", $client_id, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if($result->num_rows === 0) {
      echo "Invalid credentials try again";
      http_response_code(401);
      exit();
  }else{ 
      $row = $result->fetch_assoc();
      $_SESSION['name'] = $row['name'];
      $_SESSION['client_id'] = $row['client_id'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['pass'] = $row['pass'];
      $name=$row['name'];
      $email=$row['email'];
      $pass=$row['pass'];
      // Redirect to insert.php (uncomment this if needed)
      // header("Location: insert.php");
      // exit();
  } 
} 


if (!isset($_SESSION['client_id'])) {
    // Redirect to login_selection.php (uncomment this if needed)
    // header("Location: login_selection.php");
    // exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GetFit-client_profile</title>
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
  background-color: #181c14;
}
h1{
    font-family:tw cen mt ;
    color: rgb(219, 223, 228);
    text-align:right;
   padding-right:206px;
   padding-top: 123px;
   font-size: 65px;
}
h2{
    font-family:  garamond;
    font-size: 35px;
    color:rgb(219, 223, 228);
    text-align: right;
    line-height:60px;
    padding-right: 204px;
}
p{
    font-family: tw cen mt;
    font-size: 45px;
    color:rgb(219, 223, 228);
    text-align: right;
    padding-right: 204px;
}
.b1{
    width: 21%;
    height:45px;
    top:97px;
    left:556px;
    background-color:whitesmoke; 
    position: relative;
    display: flexbox;
    color:black;
    font-size: 18px;
    border-color: black;
    font-family:tw cen mt;
    padding: 5px;
    text-align: center;
    border-width: 5px;
    border-color:black;
    border-radius: 8px;
    cursor: pointer;
}
button.b1:hover{
    box-shadow:
  0 10px 15px -3px #507F80,
  0 4px 6px -2px #507F80;
}
.b2{
    width: 21%;
    height:45px;
    top:97px;
    left:556px;
    background-color:whitesmoke; 
    position: relative;
    display: flexbox;
    color:black;
    font-size: 18px;
    border-color: black;
    font-family:tw cen mt;
    padding: 5px;
    text-align: center;
    border-color: black;
    border-width: 5px;
    border-radius: 8px;
    cursor: pointer;
}
button.b2:hover{
    box-shadow:
  0 10px 15px -3px #8d99ae,
  0 4px 6px -2px #8d99ae;
}
  </style>
</head>

<body background="./profile.png" >
    <h1>YOUR PROFILE</h1>
    <h2 class="a" ><?php echo  "$name "?></h2>
    <h2 class="b"><?php echo "Unique Id : " . $client_id; ?></h2>
    <h2 class="c"><?php echo "Email Id : " . $email; ?></h2>
    <h2 class="d"><?php echo "Password  : " . $pass; ?></h2>
    <a href="./coaches.php"> <button class="b1">Trainers</button></a>
    <a href="./status_in_client.php"> <button class="b2">Request Status</button></a>
    </body>
</html>




