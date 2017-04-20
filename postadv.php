<?php
   /*include("config.php");
   #include('session.php');
   #session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $myname = mysqli_real_escape_string($db,$_POST['name']);
      $mycontact_no = mysqli_real_escape_string($db,$_POST['contact_no']);
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      $sql = "insert into user values('$myusername','$myname','$mypassword','$mycontact_no')"  ;
      mysqli_query($db,$sql);
      header("location: login.php");
   }*/
/*   echo "<h1>dqweg</h1>";*/
?>


<html style="height: 100%;">
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<head>
   <title>PostAdv@QwikSell</title>
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
               <label for="prnm">Product Name:</label>
               <input type="text" class="form-control" name="product_name" >
               <div class="dropdown pull-left" method="get">
	               <label for="cat" >Category:</label>
	               <br>
	               <select name="category" style="width: 100%;" >
   	  					<option value="select" selected="selected">Select Category</option>
   	  					<option value="electronic">Electronics</option>
   	  						
   	  					<option value="books">Books</option>
   	  					<option value="vehicles">Vehicles</option>
   	  					<option value="others">Others</option>
				      </select>
			      </div>
   			   <div class="dropdown pull-right">
   				   <label for="cat" >SubCategory:</label>
   				   <br>
   				   <select name="subcategory" style="width: 100%;" >
   	  					<!-- <option value="select" selected="selected">Select SubCategory</option>
   	  					<option value="choose">Electronics</option>
   	  						
   	  					<option value="cycle">Books</option>
   	  					<option value="mobile">Vehicles</option>
   	  					<option value="books">Others</option> -->
   	  					<option value="subselect" selected="selected">Select SubCategory</option>
   	  					<?php echo $_GET['category'];
   	  					/*if ($_POST['category']){*/
   		  					echo '
   		  					<option value="cooler">Cooler</option>
   		  					<option value="laptop">Laptop</option>
   		  					<option value="mobile">Mobile</option>
   		  					<option value="others">Others</option>';
   	  					/*} */
   	  					?>  					
   				   </select>
   			   </div>
			      <br>
               <!-- <label for="add">Address:</label>
               <input type="text" class="form-control" name="add" placeholder="Kumaon House, IIT Delhi."> -->
               <label for="expprice">Expected Price:</label>
               <input type="text" class="form-control" name="expected_price" >
               <label for="proddesc">Description:</label>
               <input type="text" class="form-control" name="product_desc" >
               <br><br>
               <div class="text-center">
                  <input class="btn btn-primary" type="submit" value=" Add " align="middle" style="background-color:#001933;">
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
