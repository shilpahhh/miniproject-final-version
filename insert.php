<?php
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

  
    if (empty($name) || empty($email) || empty($pass)) {
        echo "All fields are required.";
        exit();
    }
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $pass = mysqli_real_escape_string($conn, $pass);

  
    $sql = "INSERT INTO `clients` (`name`, `email`, `pass`) 
    VALUES ('$name', '$email', '$pass')";

  
    if (mysqli_query($conn, $sql))
     {
       // echo "Inserted successfully.";


        $client_id = mysqli_insert_id($conn);
       echo"<br>";
       //echo" This is your ID,you can login using this unique ID: " . $client_id;
  } 
    else
     {
      echo "Error: " . mysqli_error($conn);
   }


  
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GetFit-Successfull !</title>

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
  background-color: #134B70;
    font-family: perpetua;
}
h1.b{
    color: #c0c0c0;
 font-family: perpetua;
}
.b1{
    position: relative;
    display: flexbox;
    color:black;
    background-color:#c0c0c0;
    font-size: 34px;
    font-family:perpetua;
    padding: 6px;
    text-align: center;
    border-radius: 9px;
    font-weight: bold;
    border-color: #FFF2E1;
    cursor: pointer;
    transition: all 0.4s;
    width: 25%;
    border-width: 4px;
    
}
.b1:hover 
{
  background-color: #c0c0c0;
  color:black;
}

.b1 span 
{
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.b1 span:after 
{
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.b1:hover span
 {
  padding-right: 25px;
}

.b1:hover span:after 
{
  opacity: 1;
  right: 0;
}

.tracking-in-expand {
	-webkit-animation: tracking-in-expand 0.7s cubic-bezier(0.215, 0.610, 0.355, 1.000) both;
	        animation: tracking-in-expand 0.7s cubic-bezier(0.215, 0.610, 0.355, 1.000) both;
            color: whitesmoke;
 padding-top: 206px;
 font-family: perpetua;
 font-size: 127px;
 color:#c0c0c0;
}

 @-webkit-keyframes tracking-in-expand {
  0% {
    letter-spacing: -0.5em;
    opacity: 0;
  }
  40% {
    opacity: 0.6;
  }
  100% {
    opacity: 1;
  }
}
@keyframes tracking-in-expand {
  0% {
    letter-spacing: -0.5em;
    opacity: 0;
  }
  40% {
    opacity: 0.6;
  }
  100% {
    opacity: 1;
  }
}

    </style>

</head>
<body>

<center>
       
    <h1 class="tracking-in-expand">Yeah! <br>You joined</h1>
    <h1 class="b"> <?php echo "This is your ID,you can login using this unique ID: " . $client_id; ?> </h1><br>
   <a href="./plan" ><button class="b1"><span> Choose Plan</span></button></a>
</center>
</body>
</html>
