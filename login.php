<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      $sql = "SELECT User_ID FROM user WHERE User_ID = '$myusername' and Password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      

      $count = mysqli_num_rows($result);
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         #session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>



<html style="height: 100%;">
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<head>
   <title>Login@QwikSell</title>
</head>

<body style="height: 100%;">

   <div class="container-fluid" style="height: 95%;">
      <div class="row content" style="height: 20%; background-color:#001933;">
         <div class="col-sm-12">

         </div>
      </div>

      <div class="row content" style="height: 65%; background-color:#009999;">
         <div class="col-sm-4">
            
         </div>
         <div class="col-sm-4">
            <br><br><br><br>
            <img src="logo.png" alt="QwikSell logo" style="width: 100%;" align="middle">
            <br><br><br><br>
            <!-- <div class="form-group" action = "" method = "post"> -->
            <form action = "" method = "post">   
               <label for="usr">User Name:</label>
               <input type="text" class="form-control" name = "username" id="usr" placeholder="Batista44">
               <label for="pwd">Password:</label>
               <input type="password" class="form-control" name = "password" id="pwd" placeholder="********">
               <div class="checkbox">
                  <label>
                     <input type="checkbox"> Remember Me
                  </label>
               </div>
               <br><br>
               <div class="text-center">
                  <input class="btn btn-primary" type="submit" value = " Log In " align="middle" style="background-color:#001933;">
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
