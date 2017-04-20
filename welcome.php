<?php
   include('session.php');
   include('config.php');
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
			<br>
			<div class="col-md-1" >
				<img src="profile.png" alt="profile pic">
			</div>
			<div class="col-md-1" >
				<a href="ad.php" class="btn btn-primary" role="button">Post</a>
			</div>
			<div class="col-md-8"></div>
			<div class="col-md-1" >
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Batista
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
				<img src="profile.png" alt="profile pic">
			</div>
		</div>
		<div class="row content" style=" background-color:#2e353d;">
			<div class="col-md-2" style=" background-color:#2e353d;">
				<br><br>
				<form>
					<input type="text" name="search" placeholder="Search..">
				</form>
				<br><br>
				<ul class="nav nav-pills nav-stacked">
					<li class="active"><a href="#">Home</a></li>
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
			<div class="col-md-10" style=" background-color:#FFFFF0;">	
				<br>
				<?php
					$table = array();
					$Imagearray=array();
					$index=0;

					/*while($res=){
						$table[$index]=$res;
						$index++;
					}*/
					
					$table=mysqli_query($db, "select Product_ID,Product_Name,Category,Decription,Expected_Price from Product;");
					$tt=mysqli_query($db, "select Image1 from Product;");
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
