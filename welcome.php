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
		<div class="row content" style=" background-color:#2e353d;">
			<div class="col-md-2" style=" background-color:#2e353d;">
				<br><br>
				<form>
					<input type="text" name="search" placeholder="Search..">
				</form>
				<br><br>
				<form method="post">
				<ul class="nav nav-pills nav-stacked">
					
					<li class="active"><a href="welcome.php" >Home</a></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown"  href="#">Electronics
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="?cooler=true" >Cooler</a></li>
							<li><a href="?laptop=true">Laptop</a></li>
							<li><a href="?mobile=true">Mobile</a></li>
							<li><a href="?ac=true">Air Conditioner</a></li>							
							<li><a href="?elec-othrs=true">Others</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" name="books" href="#">Books
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="?novel=true">Novel</a></li>
							<li><a href="?txtbook=true">Textbook</a></li>							
							<li><a href="?book-othrs=true">Others</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Vehicles
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="?car=true">Car</a></li>
							<li><a href="?bicycle=true">Bicycle</a></li>
							<li><a href="?bike=true">Bike</a></li>							
							<li><a href="?vehicles-othrs=true">Others</a></li>
						</ul>
					</li>
					
					<li><a href="?others=true" >Others</a></li>
					
				</ul>
				</form>
			</div>
			<div class="col-md-10" style=" background-color:#FFFFF0;">	
				<br>
				<?php
					
					while($row=mysqli_fetch_array($table)){
						
						//$_SESSION['product_id']=$Product_ID;
						$Img=mysqli_fetch_array($tt);	
						echo '<div class="row content">
								<div class="col-md-4">	
									<div class="thumbnail">
										
										<tr>
											<td>
												<img src="data:image/jpeg;base64,'.base64_encode($Img['Image1']).'"/>
											</td>
										</tr>
									</div>
								</div>
								<div class="col-md-6">
									<div class="caption">

										<h3>',$row['Product_Name'],'</h3>
										<p>Category : ',$row['Category'],'</p>
										<p>Description : ',$row['Decription'],'</p>
										<p>Price : &#x20B9 ' ,$row['Expected_Price'],'/-</p>
										<h3>',$Product_ID,'</h3>
									</div>
								</div>
								<div class="col-md-2">
									<p>
										
										<a href="product.php?view=',$row['Product_ID'],'" class="btn btn-primary" role="button">View</a>
										<a href="#" class="btn btn-default" name="buy" role="button">Buy</a>
										
									</p>
								</div>
							</div>
							<br><br><br>
							<hr>';

							
					}		
					
					
				?>
				
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
