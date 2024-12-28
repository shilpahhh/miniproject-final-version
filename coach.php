<?php
session_start();
include "conn.php";
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GetFit-Signup_trainer</title>
        <style>

    
          img.i1{
            width: 100%;
            height: auto;
           
          }
          .trai{
            margin-left:456px;
          }

input[type=text] {
  width: 30%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: none;
  border-radius: 5px;
  border-bottom: 2px solid ;
}
input[type=email] {
  width: 30%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: none;
  border-radius: 5px;
  border-bottom: 2px solid;
  
}
select{
  width: 30%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: none;
  border-radius: 5px;
  border-bottom: 2px solid;
  
}
input[type=file]
{
  background-color: #ffff;
  font-size: 16px;
  font-family: garamond;
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
            width: 30%;
  
}
h2.h4{
 text-align: center;
  font-size: 45px;
  font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
  color:rgb(225, 235, 245);
}
p{
  color:rgb(225, 235, 245);
  font-size: 23px;
  margin-right:147px;
}
h3{
  font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
  color: white;
}

button.b3:hover {
  box-shadow:
    0 10px 15px -3px #488aec4f,
    0 4px 6px -2px #488aec17;
}

button.b3:focus,
button.b3:active {
  opacity: 0.85;
  box-shadow: none;
}

button .b3 svg {
  width: 1.25rem;
  height: 1.25rem;
}

button.b3{
  width: 45%;
    background-color:black; 
    position: relative;
    top:20px;
    color:white;
    font-size: 20px;
    font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif ;
    padding: 5px;
    text-align: center;
    border-radius: 10px;
    cursor: pointer;
}

body{
  background-color:white;
  background-repeat: no-repeat;
  border-radius: 12px;
}


        </style>
    </head>
    <body background="./equi2.jpg">
    
      <div class="trai">
        <h2 class="h4">Join as a TRAINER</h2>
        <center>
        <form id="coachform" name="coachform" action="coachinsert.php" method="POST" onsubmit="validateCoach()" 
        enctype="multipart/form-data" >
          <p >Enter Fullname</p>
            <input type="text"  id="cname" name="cname" >
            <p>Enter your Email</p>
            <input type="email" id="cemail" name="cemail">
            <p >Contact number </p>
            <input type="text" id="ccont" name="ccont" >
            <p >Specialization</p>
            <input type="text" id="cedu" name="cedu">
            
            <p>Your certificates</p>
            <select id="certificate" name="certificate">
              <option value="" disabled selected>Select your certificate</option>
              <option value="ACE">ACE</option>
              <option value="NASAM">NASAM</option>
              <option value="NIFS">NIFS</option>
              <option value="ISSA">ISSA</option>
            </select>
      <p >Upload certificate </p>
      <div class="upfile">
        <input type="file" id="file" name="file" accept=".pdf,.jpg,.jpeg,.png">
  </div>

       <button class="b3" >JOIN NOW !</button>  <br><br><br>
        </form>
<h3 >Already have an account?<a href="./login_coach.html" style="text-decoration: none; color: #488aec4f; font-size: 34px; ">Login</a></h3>
        
        <p id="errorMessages" style="color:red;"></p>                                                        
    </center>
  </div>
  <script type="text/javascript">
    function validateCoach()
    {
    
    document.getElementById('errorMessages').innerHTML = '';

      var name=document.getElementById("cname").value.trim();
      var email=document.getElementById("cemail").value.trim();
      var contact=document.getElementById("ccont").value.trim();
      var education=document.getElementById("cedu").value.trim();
      var certificate=document.getElementById("certificate").value.trim();
      var certi_file=document.getElementById("file").value.trim();
        
      var errorMessages = [];

      //validate name
      if (name === "") {
        errorMessages.push("Username is required.");
    }

      //validate email
      if (email === "") 
      {
        errorMessages.push("Email is required.");
    }
     else
      {
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

        if (!emailPattern.test(email)) 
        {
            errorMessages.push("Please enter a valid email address.");
        }
    }

      //validate contact
      if (contact === "") 
      {
        errorMessages.push("please enter contact details.");
    } 
    else if (contact.length !== 10)
     {
    errorMessages.push("Contact number must be exactly 10 digits.");
}

    //validate education
    if (education === "") {
        errorMessages.push("please enter the education field.");
    }

    //validating certificate
    if (certificate === "") {
       errorMessages.push("Please choose the certificate name you have.");
    }
    if (certi_file === "") {
        errorMessages.push("Please upload / mention the file.");
    }



    //displaying error if any occur
    if (errorMessages.length > 0)
     {
        document.getElementById('errorMessages').innerHTML = errorMessages.join('<br>');
        return false; // Prevent form submission
    }

    //if no error
    sendJoinRequest();
    return false;
  }

  function sendJoinRequest() {
    let idTrainer = <?= $_SESSION['trainer_id'] ?>
   cname =  <?php echo json_encode($_SESSION['cname']); ?>
   cemail = <?php echo json_encode($_SESSION['cemail']); ?>
     ccont = <?php echo json_encode($_SESSION['ccont']); ?>
     cedu = <?php echo json_encode($_SESSION['cedu']); ?>
     certificate =<?php echo json_encode($_SESSION['certificate']); ?>
       file= <?php echo json_encode($_SESSION['file']); ?>
                          
    ?>;

    let requestData = {
        id_trainer: idTrainer,
    };

  
    fetch('trainer_requesting.php', { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(requestData)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Network response was not ok " + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert("Request sent to admin successfully!");
          
        } else {
            alert("Failed to send request: " + data.message);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("An error occurred while sending the request: " + error.message);
    });
}

</script>
  </body>
</html>