<?php

session_start(); 
include "conn.php"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $pass_word = $_POST['pass_word'] ?? '';

    if ($name && $pass_word) {
    
        $stmt = $conn->prepare("SELECT * FROM admin WHERE name = ? AND pass_word = ?");
        $stmt->bind_param("ss", $name, $pass_word); 
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc(); 
            $name = $row['name']; 
            $pass_word = $row['pass_word']; 

        
            $_SESSION['name'] = $name;
            $_SESSION['pass_word'] = $pass_word;

            // Redirect to insert.php (uncomment this if needed)
            // header("Location: insert.php");
            // exit();
        } else {
            echo "OOOPS !!Something went Wrong.";
        }
    } else {
        echo "Invalid Username.";
    }
}

if (!isset($_SESSION['name'])) {
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
  <title>GetFit-ADMIN</title>
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
  background-color: black;
}
img{
  display: flex;
  padding-left: 57px;
  padding-top: 152px;
}
.page{
  display: flex;
  flex-direction: row;
  flex-basis: auto;
}
.image{
  display: flex;
  flex-direction:row;
  display: flex;
  flex-basis: auto;
}
.buttons{
  display: flex;
  flex-direction:column;
  padding-top: 155px;
  width: 56%;
 padding-right: 273px;
 row-gap: 45px;
}
.b1{
font-family:tw cen mt;
background-color: rgb(50, 48, 48);
color: white;
font-size: 33px;
border-radius: 9px;
padding: 8px;
cursor: pointer;
border-width: 3px;
border-color: aliceblue;
width: 100%;
}
button.b1:hover {
  box-shadow:
  0 10px 15px -3px #e7e8eb4f,
  0 4px 6px -2px #488aec17;
}
.b2{
  font-family:tw cen mt;
background-color: rgb(50, 48, 48);
color: white;
font-size: 33px;
border-radius: 9px;
padding: 8px;
cursor: pointer;
border-width: 3px;
border-color: aliceblue;
width: 100%;
}
button.b2:hover {
  box-shadow:
    0 10px 15px -3px #e7e8eb4f,
    0 4px 6px -2px #488aec17;
}
.b3{
  font-family:tw cen mt;
background-color: rgb(50, 48, 48);
color: white;
font-size: 33px;
border-radius: 9px;
padding: 8px;
cursor: pointer;
border-width: 3px;
border-color: aliceblue;
width: 100%;
}
button.b3:hover {
  box-shadow:
    0 10px 15px -3px #e7e8eb4f,
    0 4px 6px -2px #488aec17;
}

</style>
</head>
<body >
  <div class="page">
      <div class="image">
           <img src="./admin_wallpaper.jpg" width="98%" height="95%">
       </div> 
       <div class="buttons">
        <a href="./clients.php"> <button class="b1">Clients YOU HAVE</button></a><br>
           <a href="./trainer_request_list.php"><button class="b2">Trainer REQUESTS</button></a><br>
          <a href="./coaches.php" style="text-decoration: none;"><button class="b3"> Trianer's YOU  HAVE </button></a><br>

       </div>
</body>
</html>