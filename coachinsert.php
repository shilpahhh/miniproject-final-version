<?php
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cname = $_POST['cname'];
    $cemail = $_POST['cemail'];
    $ccont = $_POST['ccont'];
    $cedu = $_POST['cedu'];
    $certificate = $_POST['certificate'];

    if (empty($cname) || empty($cemail) || empty($ccont) || empty($cedu) || empty($certificate)) {
        echo "All fields are required.";
        exit();
    }

    $cname = mysqli_real_escape_string($conn, $cname);
    $cemail = mysqli_real_escape_string($conn, $cemail);
    $ccont = mysqli_real_escape_string($conn, $ccont);
    $cedu = mysqli_real_escape_string($conn, $cedu);
    $certificate = mysqli_real_escape_string($conn, $certificate);

    // Check if the file was uploaded
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $upload_dir = 'uploads/';
        $file_name = basename($_FILES['file']['name']);
        $target_file = $upload_dir . $file_name;

        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
            // Insert data into the `coach` table
            $sql = "INSERT INTO `coach` (`cname`, `cemail`, `ccont`, `cedu`, `certificate`, `file`) 
                    VALUES ('$cname', '$cemail', '$ccont', '$cedu', '$certificate', '$target_file')";

           
if (mysqli_query($conn, $sql)) {
  // echo "Inserted successfully.";
  //displaying id
  $trainer_id = mysqli_insert_id($conn);
  echo"<br>";
} 
        }}
else {
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
  background-color: #134B70;
}
h1.b{
    color: whitesmoke;
 font-family: perpetua;
}
.b1{
    position: relative;
    display: flexbox;
    color:black;
    background-color: #508C9B;
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
  background-color: #508C9B;
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
 padding-top: 289px;
 font-family: perpetua;
 font-size: 127px;
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

    <h1 class="tracking-in-expand">you joined !<br> as a Trainer</h1> <br>
    <h1 class="b"><?php echo "This is your ID,you can login using this unique ID: " . $trainer_id; ?> </h1><br>
   <a href="./login_coach.html" ><button class="b1"><span>LOGIN </span></button></a>
</center>
</body>
</html>