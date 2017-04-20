<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myname = mysqli_real_escape_string($db,$_POST['name']);
      $mycontact_no = mysqli_real_escape_string($db,$_POST['contact_no']);
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      /*$sql = "SELECT id FROM userpass WHERE username = '$myusername' and passcode = '$mypassword'"  ;*/
      $sql = "insert into user values('$myusername','$myname','$mypassword','$mycontact_no')"  ;
      mysqli_query($db,$sql);
      $sql1 = "insert into eid_profilepic(User_ID) values('$myusername')"  ;
      mysqli_query($db,$sql1);
      header("location: login.php");
   }
?>


<html style="height: 100%;">
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<head>
   <title>SignUp@QwikSell</title>
</head>

<body style="height: 100%;">

   <div class="container-fluid" style="height: 95%;">
      <div class="row content" style="height: 10%; background-color:#001933;">
         <div class="col-sm-12">

         </div>
      </div>

      <div class="row content" style="height: 75%; background-color:#009999;">
         <div class="col-sm-4">
            
         </div>
         <div class="col-sm-4">
            <img src="logo.png" alt="QwikSell logo" style="width: 100%;" align="middle">
            <br><br>
            <!-- <div class="form-group"> -->
            <form action = "" method = "post">   
               <label for="nm">Full Name:</label>
               <input type="text" class="form-control" name="name" placeholder="Batista Pujara">
               <!-- <label for="eml">IIT-D email ID:</label>
               <input type="text" class="form-control" name="eml" placeholder="batista@iitd.ac.in"> -->
               <label for="mob">Mobile No.:</label>
               <input type="text" class="form-control" name="contact_no" placeholder="9914344143">
               <!-- <label for="add">Address:</label>
               <input type="text" class="form-control" name="add" placeholder="Kumaon House, IIT Delhi."> -->
               <label for="usr">User Name:</label>
               <input type="text" class="form-control" name="username" placeholder="Batista44">
               <label for="pwd">Password:</label>
               <input type="password" class="form-control" name="password" placeholder="********">
               <br><br>
               <div class="text-center">
                  <input class="btn btn-primary" type="submit" value=" Signup " align="middle" style="background-color:#001933;">
               </div>
            </form>   
            <!-- </div> -->
         </div>
         <div class="col-sm-4">
            
         </div>
      </div>

      <div class="row content" style="height: 15%; background-color:#001933;">
         <div class="col-sm-12">

         </div>
      </div>
   </div>

   <div class="copyright" style="height: 5%; background-color:#606060;">
      <div class="container">
         <div class="col-md-6">
               <p style="color: #001933; font-size: 16px;">&copy; 2017 - All Rights with QwikSell</p>
         </div>
         <div class="col-md-6">
               <ul class="bottom_ul" style="list-style-type: none; float: right; margin-bottom: 0px;">
               <li style="float: left; line-height: 40px;"><a href="#" style="color: #001933; font-size: 12px;">qwiksell.com </a>|</li>
                 <li style="float: left; line-height: 40px;"><a href="#" style="color: #001933; font-size: 12px;">About us </a>|</li>
                 <li style="float: left; line-height: 40px;"><a href="#" style="color: #001933; font-size: 12px;">Contact us </a>|</li>
               </ul>
               <img src="fb.png" alt="fb" style="width: 8%;" align="right">
         </div>
      </div>
   </div>

</body>
</html> 
