<?php
	include("config.php");
    include("session.php");
    $myusername=$_SESSION['login_user'];
    	
    	$sql1='';
		$Category=array('Electronics-Cooler','Electronics-Laptop','Electronics-Moblie','Electronics-Air Conditioner','Electronics-Others','Books-Novel','Books-Textbook','Books-Others','Vehicles-Car','Vehicles-Bicycle','Vehicles-Bike','Vehiles-Others','Others');
		$category=array('cooler','laptop','moblie','ac','elec-othrs','novel','txtbook','book-othrs','car','bicycle','bike','vehicles-othrs','others');
		$i=0;
		while($i<13){
			
			if (isset($_GET[$category[$i]])){
				$sql1=" where Category='".$Category[$i]."'";
				//echo "<h3>others</h3>";
			}

			$i=$i+1;
		}

		$table=mysqli_query($db, "select Product_ID,Product_Name,Category,Decription,Expected_Price from Product".$sql1.";");
		$tt=mysqli_query($db, "select Image1 from Product".$sql1.";");
				

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
	     
		}	
		if (isset($_POST['submitforsearch'])){
			/*echo "<h3>",$_POST['cgory'],"</h3>";
			$sql1=" where Category='".$_POST['cgory']."'";*/
			header("location: welcome.php?".$_POST['cgory']."=true&search=".$_POST['search']."");
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
			
			<div class="col-md-1" >
				<br>
				<a href="ad.php" class="btn btn-primary" role="button">Post Ad</a>
			</div>
			<div class="col-md-1"></div>
			<form method="post">
				<div class="col-md-3">
					<br>
					<select class="form-control" name="cgory" id="cgory">
						<option>Select Category for Search...</option>
						<option>Others</option>
						<option>Electronics-Cooler</option>
						<option>Electronics-Air Conditioner</option>
						<option>Electronics-Laptop</option>
						<option>Electronics-Mobile</option>
						<option>Electronics-Others</option>
						<option>Vehicles-Car</option>
						<option>Vehicles-Bike</option>
						<option>Vehicles-Bicycle</option>
						<option>Vehicles-Others</option>
						<option>Books-Novel</option>
						<option>Books-Textbook</option>
						<option>Books-Others</option>
					</select>
				</div>	
				<div class="col-md-2">
					<br>

					<input type="text" name="search" id="search" placeholder="Search..">
				</div>
				<div class="col-md-1">
					<br>	
					<div class="text-center">
						<input class="btn btn-primary" type="submit" name="submitforsearch" value="Search" align="left" style="background-color:#001933;">
					</div>
				</div>	
			
			<div class="col-md-2"></div>
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
			</form>
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
							<li><a href="welcome.php?cooler=true" >Cooler</a></li>
							<li><a href="welcome.php?laptop=true">Laptop</a></li>
							<li><a href="welcome.php?mobile=true">Mobile</a></li>
							<li><a href="welcome.php?ac=true">Air Conditioner</a></li>							
							<li><a href="welcome.php?elec-othrs=true">Others</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Books
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="welcome.php?novel=true">Novel</a></li>
							<li><a href="welcome.php?txtbook=true">Textbook</a></li>							
							<li><a href="welcome.php?book-othrs=true">Others</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Vehicles
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="welcome.php?car=true">Car</a></li>
							<li><a href="welcome.php?bicycle=true">Bicycle</a></li>
							<li><a href="welcome.php?bike=true">Bike</a></li>							
							<li><a href="welcome.php?vehicles-othrs=true">Others</a></li>
						</ul>
					</li>
					<li><a href="welcome.php?others=true">Others</a></li>
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