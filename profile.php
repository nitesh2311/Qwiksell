<?php
	include("config.php");
    include("session.php");
    $myusername=$_SESSION['login_user'];
    				

	function resizeandUpload(){
      	include("config.php");
		$upload_image = $_FILES["image"][ "name" ];
		$tmpName=$_FILES["image"]["tmp_name"];
		$filePath="images/".$_FILES["image"]["name"];
		$myusername=$_SESSION['login_user'];
		$result = move_uploaded_file($tmpName, $filePath);
		$orig_image = imagecreatefromjpeg($filePath);
		ob_start();
		imagejpeg($orig_image);
		$jpeg = ob_get_clean();
		
		$image_info = getimagesize($filePath); 
		$width_orig  = $image_info[0]; // current width as found in image file
		$height_orig = $image_info[1]; // current height as found in image file
		//echo $width_orig, $height_orig;
		$width = 80; // new image width
		$height = $height_orig*80/$width_orig; // new image height
		$destination_image = imagecreatetruecolor($width, $height);
		imagecopyresampled($destination_image, $orig_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
		// This will just copy the new image over the original at the same filePath.
		imagejpeg($destination_image, $filePath, 100);

		
		ob_start();
		imagejpeg($destination_image);
		$file1 = ob_get_clean();
		$sql="";
		//$file = addslashes(file_get_contents($_FILES['image']['tmp_name']));
		$file = addslashes($file1);
		$sql = "update 	eid_profilepic
				set Profilepic='$file'
				where User_ID='$myusername';";
		//echo '<h3>',$sql,'</h3>';
		$result = mysqli_query($db,$sql);
		if ($result){
			echo "<script>alert('Image inserted successfull')</script>";
		}
		else{
			echo "<h3>query unsuccessful</h3>";
		}
      }

      if (isset($_POST['upload1'])) {

      		resizeandUpload();

      }
      if (isset($_POST['submit'])){
      	  $name = mysqli_real_escape_string($db,$_POST['name']);
	      $contact_no = mysqli_real_escape_string($db,$_POST['contact_no']);
	      $e_id = mysqli_real_escape_string($db,$_POST['e-id']);
	     
	      $sql = "update 	eid_profilepic
				  set Email='$e_id'
				  where User_ID='$myusername';";
	     
	      $ress=mysqli_query($db,$sql);
	      $sql = "update 	user
				  set Username='$name', Contact_no=$contact_no
				  where User_ID='$myusername';";
	     
	      $ress1=mysqli_query($db,$sql);
	      //$user=mysqli_fetch_array(mysqli_query($db, "select * from user where User_ID='$myusername';"));
		  //$eid_profile=mysqli_fetch_array(mysqli_query($db, "select * from eid_profilepic where User_ID='$myusername';"));
	
		}	
	$user=mysqli_fetch_array(mysqli_query($db, "select * from user where User_ID='$myusername';"));
	$eid_profile=mysqli_fetch_array(mysqli_query($db, "select * from eid_profilepic where User_ID='$myusername';"));
				
?>

<html style="height: 100%;">
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<head>
	<title>Welcome@QwikSell</title>
</head>

<body>
	<div class="container-fluid">
		<div class="row content" style=" background-color:#001933;">
			
			<!-- <div class="col-md-1" >
				<img src="profile.png" alt="profile pic">
			</div> -->
			<div class="col-md-1" >
				<br>
				<a href="ad.php" class="btn btn-primary" role="button">Post Ad</a>
			</div>
			<div class="col-md-9"></div>
			<div class="col-md-1" >
				<div class="dropdown">
					<br>
					<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $user['Username'] ?>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu pull-right">
					  <li><a href="profile.php">My Profile</a></li>
					  <li><a href="#">My Dashboard</a></li>
					  <li><a href="logout.php">Logout</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-1" >
				
				<?php
				if (is_null($eid_profile['Profilepic'])){
					echo '<img src="profile.png" alt="profile pic">';
				}
				else{
					/*$query = "select * from eid_profilepic where User_ID='$myusername';";
					$result = mysqli_query($db, $query);
					while ($row = mysqli_fetch_array($result))
					{*/	echo'
						<tr>
							<td>
								<img src="data:image/jpeg;base64,'.base64_encode($eid_profile['Profilepic']).'"/>
							</td>
						</tr>';
					//}
				}	
				?>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row content" style="background-color:#2e353d;">
			<div class="col-md-2" style=" background-color:#2e353d;">
				<br><br>
				<form>
					<input type="text" name="search" placeholder="Search..">
				</form>
				<br><br>
				<ul class="nav nav-pills nav-stacked">
					<li class="active"><a href="welcome.php">Home</a></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Electronics
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="#">Cooler</a></li>
							<li><a href="#">Laptop</a></li>
							<li><a href="#">Mobile</a></li>
							<li><a href="#">Air Conditioner</a></li>							
							<li><a href="#">Others</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Books
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="#">Novel</a></li>
							<li><a href="#">Textbook</a></li>							
							<li><a href="#">Others</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Vehicles
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="#">Car</a></li>
							<li><a href="#">Bicycle</a></li>
							<li><a href="#">Bike</a></li>							
							<li><a href="#">Others</a></li>
						</ul>
					</li>
					<li><a href="#">Others</a></li>
				</ul>
			</div>
			<div class="col-md-10">
				<div class="row content" style="background-color:#009999;">
					<div class="col-md-1">
						
					</div>
					<div class="col-md-10">
						<h3>User : <?php echo $user['Username'],'(',$myusername,')'?></h3>
						<div class="row content">
							<div class="form-group"  >
								<div class="col-md-8">
									
									<div class="row content" >
										<div class="col-md-6">
											<br><h3>Edit Profile</h3>
											<form method="post">
												<?php 
												
													echo 	'<label for="name">Name:</label>
															<input type="text" class="form-control" name="name" id="name" placeholder=',$user['Username'],'>
															
															<label for="contact_no">Contact No.:</label>
															<input type="text" class="form-control" name="contact_no" id="contact_no" placeholder=',$user['Contact_no'],'>
															';
													if (is_null($eid_profile['Email'])){
														echo   '<label for="e-id">Email ID:</label>
																<input type="text" class="form-control" name="e-id" id="e-id" placeholder="xxx@yyy.com">';
													}
													else{
														echo   '<label for="e-id">Email ID:</label>
																<input type="text" class="form-control" name="e-id" id="e-id" placeholder=',$eid_profile['Email'],'>';		
													}
													
												?>

												<br><br>
												<div class="text-center">
													<input class="btn btn-primary" type="submit" name="submit" value="Change" align="middle" style="background-color:#001933;">
												</div>
											</form>
											<br><br><br><br>



										</div>
										
									</div>
								</div>
								<div class="col-md-4">
									<br>
									<h3>Profile Picture</h3>
									<br>
									<div class="main-img-preview">
										<?php
										
											if (!isset($_POST['upload1']) ) {
												echo '	<form  action="" method="post" enctype="multipart/form-data">
														<input type="file" name="image" id="image">
														<br/>
														<input type="submit" name="upload1" id="upload1" value="Upload image">
														</form>';	
											}
											else {
												/*$query = "select Profilepic from eid_profilepic where User_ID='$myusername';";
												$result = mysqli_query($db, $query);
												while ($row = mysqli_fetch_array($result))
												{*/	echo'
													<tr>
														<td>
															<img src="data:image/jpeg;base64,'.base64_encode($eid_profile['Profilepic']).'"/>
														</td>
													</tr>';
												//}
											}	
											
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-1">
						
					</div>
				</div>
			</div>
		</div>

		<div class="row content" style="height: 15%; background-color:#001933;">
			<div class="col-sm-12">

			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row content" style=" background-color:#001933;">
			<div class="col-md-2"></div>
			<div class="col-md-6">
				<br><p>
				&copy; 2017, All rights reserved with QwikSell</p><br>
			</div>
			<div class="col-md-4">
				<br>
				<img src="fb.png" alt="fb" style="width: 40px">
				<a href="#">QwikSell.com</a>|
				<a href="#">About Us</a>|
				<a href="#">Contact Us</a>
				<br>
			</div>
		</div>
	</div>

</body>
</html> 