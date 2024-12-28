<?php

session_start(); 
include "conn.php"; 

?>

<html>
    <head>
        <title>GetFit-ourteam</title>
        <style>
        *{
          margin: 0;
           padding: 0;
           box-sizing: border-box;
        }
        body{
          border-radius: 12px;
          background-color:#507F80;
        }
h3.h310{
    font-size: 40px;
    color:black ;
    font-family:tw cen mt;
}
p.p4{
    text-align: center;
  font-size: 20px;
  font-family: tw cen mt;
  text-indent: 30px;
  color:white;
  padding-top: 23px;
  padding-bottom:24px;
}
.train_list{
  display: flex;
flex-direction: row;
flex-wrap: wrap;
justify-content: center;
margin-top: 100px;

}



.b6{
    width:38%;
    height: 25%;
    background-color:black; 
    position: relative;
    display: flexbox;
    color:white;
    left:120px;
     font-size: 15px;
    font-family:tw cen mt;
    padding: 5px;
    text-align: center;
    border-radius: 7px;
    border-width: 2px;
    cursor: pointer;
    transition: all 0.4s;
}
.b6:hover {
    background-color:rgb(240, 241, 242);
    color: black;
  }
  .b6 span 
{
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.b6 span:after 
{
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.b6:hover span
 {
  padding-right: 25px;
}

.b6:hover span:after 
{
  opacity: 1;
  right: 0;
}
       
          /*trainer5*/
  .per5{
    background-color:rgb(240, 241, 242) ;
  border-radius: 8px;
  width: 28%;
  height: 44%;
  margin: 20px;
  overflow: hidden;
  padding-bottom: 25px;

  }
  p.ps10{
  font-size: 37px;
    font-family:tw cen mt; 
    color:black;
    padding-left: 27px;
    padding-top: 12px;
  }
.backbutton{
  width:18%;
    height: 5%;
    background-color:black; 
    position: relative;
    display: flexbox;
    color:white;
     font-size: 25px;
     left:586px;
    font-family:tw cen mt;
    padding: 5px;
    text-align: center;
    border-radius: 7px;
    border-width: 2px;
    cursor: pointer;
    transition: all 0.4s;
}
.backbutton:hover {
    background-color:rgb(240, 241, 242);
    color: black;
  }
  .backbutton span 
{
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.backbutton span:after 
{
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.backbutton:hover span
 {
  padding-right: 25px;
}

.backbutton:hover span:after 
{
  opacity: 1;
  right: 0;
}
    



        </style>
    </head>
    <body>
        <div class="page5"><br>
            <h3 class="h310" align="center"> OUR TEAM</h3>
            <p class="p4"><big>GetFit</big> have strong , certified coach team to train our hardworking clients ! <br>
                Some of the profiles of our coaches ...You can check intependandly and join with them.</p>

      

                <?php

$result = $conn->query("SELECT * FROM coach"); 

if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        
        $cname = htmlspecialchars($row['cname']);
        $cemail = htmlspecialchars($row['cemail']);
        $ccont = htmlspecialchars($row['ccont']);
        $cedu = htmlspecialchars($row['cedu']);
        $certificate = htmlspecialchars($row['certificate']);
        $trainer_id = htmlspecialchars($row['trainer_id']);  
        
        echo ' <div class="train_list">
        <div class="per5">  
            <p class="ps10"><big>' . $cname . '</big></p><br>
            <p class="pcontent" style="font-family:tw cen mt; font-size: 18px; padding-left: 25px; line-height: 23pt;">
                Email: <small style="font-family: garamond;">' . $cemail . '</small><br>
                Contact: <small style="font-family: garamond;">' . $ccont . '</small><br>
                Specialization: <small style="font-family: garamond;">' . $cedu . '</small><br>
                Certificate: <small style="font-family: garamond;">' . $certificate . '</small><br>
            </p>
            <button class="b6" onclick="sendRequest(' . $trainer_id . ')">SEND REQUEST</button>
        </div>
         </div>';
    }
    echo'<a href="./login.html"><button class="backbutton">BACK</button></a>';
} else {
    echo "No additional trainers found.";
}

$conn->close();
?>

<script type="text/javascript">
  function sendRequest(trainer_id) 
  { 
    if (trainer_id === undefined || trainer_id === null) {
      console.error('trainer_id is undefined');
      return; 
    }
    alert("Request successfully sent");

    fetch('client_requesting.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ trainerId: trainer_id }) 
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
