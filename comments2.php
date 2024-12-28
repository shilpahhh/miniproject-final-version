
<?php

session_start();
include "conn.php";

?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GetFit-commentsection</title>
  <style>
 
 *{
          margin: 0;
           padding: 0;
           box-sizing: border-box;
 }
body{
    border-radius: 12px;
    background-color: #c0c0c0;
 }
 .title{
    padding-top:34px;
 }
 h3{
color:rgb(29, 26, 26);
padding-top: 34px;
font-size: 34px;
width: 20%;
border-radius: 7%;
font-family:garamond;
padding-bottom:34px;
 }
 .comment_list{
    display: flex;
flex-direction:column;
flex-wrap: wrap;
justify-content: center;
margin-top: 56px;
 }
 .comm1{
    background-color:rgb(29, 26, 26);
  border-radius: 8px;
  width: 45%;
  height:30%;
  overflow: hidden;
  margin-left: 67px;
 }
 .name{
    color:#c0c0c0;
    font-family: garamond;
    font-size:16px;
 }
 .date{
    color:#6e6b6b;
    font-family: garamond;
    font-size:16px;
 }
 .comment{
    color:#c0c0c0;
    font-family: garamond;
    font-size:20px;
 }

 
        </style>
</head>
<body>
    <div class="title">
<h3 class="heading" align="center">COMMENTS</h3>
</div>

<?php

$result = $conn->query("SELECT * FROM comments"); 

if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        
        $client_name = htmlspecialchars($row['client_name']);
        $comment = htmlspecialchars($row['comment']);
        $created_at=htmlspecialchars($row['created_at']);
        echo ' <div class="comment_list">

        <div class="comm1"> 
         <p class="name">@' . $client_name. '</p>
         <p class="date">' . $created_at . '</p><br>
              <p class="comment">' . $comment. '</p>
     </div>
     
      </div>';
 }
} else {
 echo "No additional trainers found.";
}


$conn->close();
?> 
      
    </body>
</html>
