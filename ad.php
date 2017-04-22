<?php
	include("config.php");
	
	include("session.php");
	
      function resizeandUpload($index){
      	include("config.php");
		$upload_image = $_FILES["image".$index][ "name" ];
		$tmpName=$_FILES["image".$index]["tmp_name"];
		$filePath="images/".$_FILES["image".$index]["name"];
		
		//move_uploaded_file($_FILES["image"]["tmp_name"], "$folder".$_FILES["image"]["name"]);

		$result = move_uploaded_file($tmpName, $filePath);
		$orig_image = imagecreatefromjpeg($filePath);
		ob_start();
		imagejpeg($orig_image);
		$jpeg = ob_get_clean();
		/*echo '
			<tr>
				<td>
				<img src="data:image/jpeg;base64,'.base64_encode($jpeg).'"/>
				</td>
			</tr>';*/
		$image_info = getimagesize($filePath); 
		$width_orig  = $image_info[0]; // current width as found in image file
		$height_orig = $image_info[1]; // current height as found in image file
		//echo $width_orig, $height_orig;
		$width = 200; // new image width
		$height = $height_orig*200/$width_orig; // new image height
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
		if ($index=="1"){ 
			$sql = "insert into photos (image".$index.") values ('$file');";
			//echo "<h3>here</h3>";
		}
		else{
			$res=mysqli_fetch_array(mysqli_query($db, "select max(num) as w from photos;"));
			//$sql = "insert into photos (image".$index.") values ('$file') where num=".(string)$res['w'].";";
			$sql = "update 	photos
					set image".$index."='$file'
					where num=".$res['w'].";";
			//echo "<h3>here</h3>";
		}
		//echo "<h3>here</h3>";
		
		$result = mysqli_query($db,$sql);
		if ($result){
			echo "<script>alert('Image inserted successfull')</script>";
		}
		else{
			echo "<h3>query unsuccessful</h3>";
		}
      }

      if (isset($_POST['upload1'])) {

      		resizeandUpload("1");

      }
      else if (isset($_POST['upload2'])) {
      		//echo "<h3>here</h3>";
      		resizeandUpload("2");
      }
      else if (isset($_POST['upload3'])) {
      		resizeandUpload("3");
      }
      else if (isset($_POST['upload4'])) {
      		resizeandUpload("4");
      }
      if (isset($_POST['submit'])){
      	  $prname = mysqli_real_escape_string($db,$_POST['prname']);
	      $category = mysqli_real_escape_string($db,$_POST['cgory']);
	      $price = mysqli_real_escape_string($db,$_POST['price']);
	      $desc = mysqli_real_escape_string($db,$_POST['desc']); 

	      $res=mysqli_fetch_array(mysqli_query($db, "select max(num) as w from photos;"));
		  $query = "select * from photos where num=".$res['w'].";";
		  $result = mysqli_query($db, $query);
		  $row = mysqli_fetch_array($result);
		  $image1=addslashes($row['image1']);
		  $image2=addslashes($row['image2']);
		  $image3=addslashes($row['image3']);
		  $image4=addslashes($row['image4']);
	      $myusername=$_SESSION['login_user'];
	      /*$sql = "SELECT id FROM userpass WHERE username = '$myusername' and passcode = '$mypassword'"  ;*/
	      $sql = "insert into Product(Seller_ID,Product_Name,Category,Decription,Expected_Price,Image1,Image2,Image3,Image4,Sold ) values('$myusername','$prname','$category','$desc','$price','$image1','$image2','$image3','$image4',0)"  ;
	     
	      $ress=mysqli_query($db,$sql);

		  header('Location: welcome.php');
	      
	     

      }
      $myusername=$_SESSION['login_user'];
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
			<div class="col-md-10"></div>
			<div class="col-md-1" >
				<div class="dropdown">
					<br>
					<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $user['Username'] ?>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu pull-right">
					  <li><a href="#">My Profile</a></li>
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
					$query = "select Profilepic from eid_profilepic where User_ID='$myusername';";
					$result = mysqli_query($db, $query);
					while ($row = mysqli_fetch_array($result))
					{	echo'
						<tr>
							<td>
								<img src="data:image/jpeg;base64,'.base64_encode($row['Profilepic']).'"/>
							</td>
						</tr>';
					}
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
						<div class="row content">
							<div class="form-group"  >
								<div class="col-md-6">
									<br><br><br><br><br><br><br><br>
									<div class="row content" >
										<div class="col-md-6">
											<div class="main-img-preview">
												<!-- <img class="thumbnail img-preview" style="width: 100%; height: 100px;" src="fb.png" title="Image 1"> -->
												<?php
													// include("config.php");
													if (!isset($_POST['upload1']) and !isset($_POST['upload2']) and !isset($_POST['upload3']) and !isset($_POST['upload4'])) {
														echo '	<form  action="" method="post" enctype="multipart/form-data">
																<input type="file" name="image1" id="image1">
																<br/>
																<input type="submit" name="upload1" id="upload1" value="Upload image">
																</form>';	
													}
													else {
														$res=mysqli_fetch_array(mysqli_query($db, "select max(num) as w from photos;"));
														$query = "select image1 from photos where num=".$res['w'].";";
														$result = mysqli_query($db, $query);
														while ($row = mysqli_fetch_array($result))
														{	echo'
															<tr>
																<td>
																	<img src="data:image/jpeg;base64,'.base64_encode($row['image1']).'"/>
																</td>
															</tr>';
														}
													}	
													
												?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="main-img-preview">
												<!-- <img class="thumbnail img-preview" style="width: 100%; height: 100px;" src="fb.png" title="Image 1"> -->

												<?php
													// include("config.php");
													if (!isset($_POST['upload2']) and !isset($_POST['upload3']) and !isset($_POST['upload4'])) {
														echo '	<form  action="" method="post" enctype="multipart/form-data">
																<input type="file" name="image2" id="image2">
																<br/>
																<input type="submit" name="upload2" id="upload2" value="Upload image">
																</form>';	
													}
													else {
														//echo "<h1>",$_POST['upload2'],"</h1>";
														$res=mysqli_fetch_array(mysqli_query($db, "select max(num) as w from photos;"));
														$query = "select image2 from photos where num=".$res['w'].";";
														$result = mysqli_query($db, $query);
														while ($row = mysqli_fetch_array($result))
														{	echo'
															<tr>
																<td>
																	<img src="data:image/jpeg;base64,'.base64_encode($row['image2']).'"/>
																</td>
															</tr>';
														}
													}	
													
												?>										
											</div>
										</div>
									</div>
									<div class="row content">
										<div class="col-md-6">
											<div class="main-img-preview">
												<!-- <img class="thumbnail img-preview" style="width: 100%; height: 100px;" src="fb.png" title="Image 1"> -->
												<?php
													// include("config.php");
													if (!isset($_POST['upload3']) and !isset($_POST['upload4'])) {
														echo '	<form  action="" method="post" enctype="multipart/form-data">
																<input type="file" name="image3" id="image3">
																<br/>
																<input type="submit" name="upload3" id="upload3" value="Upload image">
																</form>';	
													}
													else {

														$res=mysqli_fetch_array(mysqli_query($db, "select max(num) as w from photos;"));	
														$query = "select image3 from photos where num=".$res['w'].";";
														$result = mysqli_query($db, $query);
														while ($row = mysqli_fetch_array($result))
														{	echo'
															<tr>
																<td>
																	<img src="data:image/jpeg;base64,'.base64_encode($row['image3']).'"/>
																</td>
															</tr>';
														}
													}	
													
												?>	

											</div>
										</div>
										<div class="col-md-6">
											<div class="main-img-preview">
												<!-- <img class="thumbnail img-preview" style="width: 100%; height: 100px;" src="fb.png" title="Image 1"> -->

												<?php
													// include("config.php");
													if (!isset($_POST['upload4'])) {
														echo '	<form  action="" method="post" enctype="multipart/form-data">
																<input type="file" name="image4" id="image4">
																<br/>
																<input type="submit" name="upload4" id="upload4" value="Upload image">
																</form>';	
													}
													else {
														$res=mysqli_fetch_array(mysqli_query($db, "select max(num) as w from photos;"));
														$query = "select image4 from photos where num=".$res['w'].";";
														$result = mysqli_query($db, $query);
														while ($row = mysqli_fetch_array($result))
														{	echo'
															<tr>
																<td>
																	<img src="data:image/jpeg;base64,'.base64_encode($row['image4']).'"/>
																</td>
															</tr>';
														}
													}	
													
												?>										
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<br><br><br><br><h3>Post an Advertisement</h3>
									<form method="post">
										
										<label for="pname">Product Name:</label>
										<input type="text" class="form-control" name="prname" id="pname" placeholder="Batista44">
										<label for="cgory">Select Category (Select One):</label>
										<select class="form-control" name="cgory" id="cgory">
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
										<label for="price">Price (in Rs.):</label>
										<input type="number" class="form-control" name="price" id="price" placeholder="444">
										<label for="desc">Description:</label>
										<input type="text" class="form-control" name="desc" id="desc" placeholder="description...">
										<br><br>
										<div class="text-center">
											<input class="btn btn-primary" type="submit" name="submit" value="Post" align="middle" style="background-color:#001933;">
										</div>
									</form>
									<br><br><br><br>
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