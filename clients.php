<?php

session_start(); 
include "conn.php"; 

?>

<html>
    <head>
        <title>GetFit-Clients</title>
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
    color:white ;
    font-family:tw cen mt;
}
.train_list{
  display: flex;
flex-direction: row;
flex-wrap: wrap;
justify-content: center;
margin-top: 100px;

}

.per1{
  background-color:rgb(240, 241, 242) ;
  border-radius: 8px;
  width: 28%;
  height: 80%;
  margin: 20px;
  overflow: hidden;
  padding-bottom: 30px;
}
p.ps6{
  font-size: 37px;
    font-family:tw cen mt; 
    color:black;
    padding-left: 25px;
    padding-top: 12px;
}
.b4{
    width:38%;
    height: 25%;
    background-color:black; 
    position: relative;
    display: flexbox;
    color:white;
    font-size: 15px;
    font-family:tw cen mt;
    padding: 5px;
    left: 120px;
    text-align: center;
    border-radius: 5px;
    cursor: pointer;
    border-width: 2px;
    transition: all 0.4s;
}
.b4:hover {
    background-color:rgb(240, 241, 242);
    color: black;
  }
  .b4 span 
{
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.b4 span:after 
{
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.b4:hover span
 {
  padding-right: 25px;
}

.b4:hover span:after 
{
  opacity: 1;
  right: 0;
}

/*trainer 2*/
.per2{
  background-color:rgb(240, 241, 242) ;
  border-radius: 8px;
  width: 28%;
  height: 44%;
  margin: 20px;
  overflow: hidden;
  padding-bottom: 30px;
}
p.ps7{
  font-size: 37px;
    font-family:tw cen mt; 
    color:black;
    padding-left: 25px;
    padding-top: 12px;
}
.b5{
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
    cursor: pointer;
    border-width: 2px;
    transition: all 0.4s;
}
.b5:hover {
    background-color:rgb(240, 241, 242);
    color: black;
  }
  .b5 span 
{
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.b5 span:after 
{
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.b5:hover span
 {
  padding-right: 25px;
}

.b5:hover span:after 
{
  opacity: 1;
  right: 0;
}

/* trainer 3*/
.per3{
  background-color:rgb(240, 241, 242) ;
  border-radius: 8px;
  width: 28%;
  height: 44%;
  margin: 20px;
  overflow: hidden;
  padding-bottom: 30px;
}
p.ps8{
  font-size: 37px;
    font-family:tw cen mt; 
    color:black;
    padding-left: 27px;
    padding-top: 12px;
}

                           /*trainer4*/
.per4{
  background-color:rgb(240, 241, 242) ;
  border-radius: 8px;
  width: 28%;
  height: 44%;
  margin: 20px;
  overflow: hidden;
  padding-bottom: 25px;

}
p.ps9{
  font-size: 37px;
    font-family:tw cen mt; 
    color:black;
    padding-left: 27px;
    padding-top: 12px;
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
           /*trainer6*/
  .per6{
    background-color:rgb(240, 241, 242) ;
  border-radius: 8px;
  width: 28%;
  height: 44%;
  margin: 20px;
  overflow: hidden;
  padding-bottom: 25px;
  }
  p.ps11{
  font-size: 37px;
    font-family:tw cen mt; 
    color:black;
    padding-left: 27px;
    padding-top: 12px;
  }




        </style>
    </head>
    <body>
        <div class="page5"><br>
            <h3 class="h310" align="center"> OUR CLIENTS</h3>

           <?php

$result = $conn->query("SELECT * FROM clients"); 

if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        
        $name = htmlspecialchars($row['name']);
        $email = htmlspecialchars($row['email']);
        $pass = htmlspecialchars($row['pass']);
        
       
        echo ' <div class="train_list">

        <div class="per5">  <!-- New Trainer Entry -->
            <p class="ps10"><big>' . $name . '</big></p><br>
            <p class="pcontent" style="font-family:tw cen mt; font-size: 18px; padding-left: 25px; line-height: 23pt;">
                Email: <small style="font-family: garamond;">' . $email . '</small><br>
                Contact: <small style="font-family: garamond;">' . $pass . '</small><br>
            </p>
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
