<?php
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_name= $_POST['client_name'];
    $comment= $_POST['comment'];

    if ( empty($client_name)||empty($comment)) {
        echo "All fields are required.";
        exit();
    }

    $client_name = mysqli_real_escape_string($conn, $client_name);
    $comment = mysqli_real_escape_string($conn, $comment);

    $sql = "INSERT INTO `comments` (`client_name`, `comment`) 
        VALUES ('$client_name', '$comment')";

    // Execute SQL query
    if (mysqli_query($conn, $sql))
     {
        //echo "Inserted successfully.";
        $result = mysqli_query($conn, "SELECT `created_at` FROM `comments` ORDER BY `created_at` DESC LIMIT 1");
        $row = mysqli_fetch_assoc($result);
        $created_at = $row['created_at'];

        // Display success message with the creation date
       //echo "Comment added successfully.<br>";
        echo "Date: $created_at";
  } 
    else
     {
      echo "Error: " . mysqli_error($conn);
   }


    // Close the connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GetFit-successfull</title>

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
  background-color: #2E3944;
}
  .b1{
    position: relative;
    display: flexbox;
    color:black;
    background-color:#748D92;
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
  background-color: #748D92;
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
 padding-top: 326px;
 font-family: perpetua;
 font-size: 97px;
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
       
       <h1 class="tracking-in-expand">Thank you For your <br>Valuable Response</h1> <br>
       <a href="./comments2.php" ><button class="b1"><span>See More Comments</span></button></a>

</body>
</html>
