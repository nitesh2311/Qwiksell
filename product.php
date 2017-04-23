<?php 
	include("config.php");
	include("session.php");
	
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

	if (isset($_POST['submitforsearch'])){
		/*echo "<h3>",$_POST['cgory'],"</h3>";
		$sql1=" where Category='".$_POST['cgory']."'";*/
		header("location: welcome.php?".$_POST['cgory']."=true&search=".$_POST['search']."");
	}
	
	$myusername=$_SESSION['login_user'];
    $user=mysqli_fetch_array(mysqli_query($db, "select * from user where User_ID='$myusername';"));
	$eid_profile=mysqli_fetch_array(mysqli_query($db, "select * from eid_profilepic where User_ID='$myusername';"));
	
?>
<html style="height: 100%;">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
		<div class="row content" style=" background-color:#2e353d;">
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
						</ul>
					</li>
					<li><a href="welcome.php?others=true">Others</a></li>
				</ul>
			</div>
			<div class="col-md-10" style=" background-color:#FFFFF0;">	
				<br><br><br><br><br><br><br><br><hr>
				<?php
					$product_id=$_GET['view'];
					$product=mysqli_fetch_array(mysqli_query($db, "select Seller_ID,Product_Name,Category,Decription,Expected_Price from Product where Product_ID=$product_id;"));
					$Img=mysqli_fetch_array(mysqli_query($db, "select Image1,Image2,Image3,Image4 from Product where Product_ID=$product_id;"));
					$uid=$product['Seller_ID'];
					$seller=mysqli_fetch_array(mysqli_query($db, "select * from user where User_ID='$uid';"));
				echo '	
				<div class="row content">
					<div class="col-md-4">	
						
						<div id="imagecarousel" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#imagecarousel" data-slide-to="0" class="active">
								<li data-target="#imagecarousel" data-slide-to="1">
								</li>
								<li data-target="#imagecarousel" data-slide-to="2">
								</li>
								<li data-target="#imagecarousel" data-slide-to="3">
								</li>
							</ol>
							<div class="carousel-inner" role="listbox">
								<div class="item active">
									<tr>
										<td>
											<img src="data:image/jpeg;base64,'.base64_encode($Img['Image1']).'"/>
										</td>
									</tr>
								</li>
								</div>
								<div class="item">
									<tr>
										<td>
											<img src="data:image/jpeg;base64,'.base64_encode($Img['Image2']).'"/>
										</td>
									</tr>
								</div>
								<div class="item">
									<tr>
										<td>
											<img src="data:image/jpeg;base64,'.base64_encode($Img['Image3']).'"/>
										</td>
									</tr>
								</div>
								<div class="item">
									<tr>
										<td>
											<img src="data:image/jpeg;base64,'.base64_encode($Img['Image4']).'"/>
										</td>
									</tr>
								</div>
							</div>
							<a class="left carousel-control" href="#imagecarousel" role="button" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#imagecarousel" role="button" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
					<div class="col-md-6">
						<div class="caption">
							<h3>',$product['Product_Name'],'</h3>
							<h4>Category : ',$product['Category'],'</h4>
							<p>Description : ',$product['Decription'],'</p>
							<p>Price: &#x20B9 ',$product['Expected_Price'],'/-</p>
						</div>
					</div>
					<div class="col-md-2">
						<p>
							<a href="#" class="btn btn-primary" role="button">Buy</a>
						</p>
					</div>
				</div>
				<hr><br><br><br><br>
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<h3>Seller Information : ',$seller['Username'],'</h3>
					<p>Seller ID : ',$product['Seller_ID'],'</p>
					<p>Mobile No. : ',$seller['Contact_no'],'</p>
					
				</div>
				<div class="col-md-4"></div>';?>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row content" style=" background-color:#001933;">
			<div class="col-md-2"></div>
			<div class="col-md-6">
				<br><p>
				&copy; 2017, QwikSell</p><br>
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
