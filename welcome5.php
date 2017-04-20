<?php

	include("config.php");
	include("session.php");

	$msg = "";
	if (isset($_POST['sumit'])) {
		
		$upload_image = $_FILES["image"][ "name" ];
		$tmpName=$_FILES["image"]["tmp_name"];
		$filePath="images/".$_FILES["image"]["name"];
		
		//move_uploaded_file($_FILES["image"]["tmp_name"], "$folder".$_FILES["image"]["name"]);

		$result = move_uploaded_file($tmpName, $filePath);
		$orig_image = imagecreatefromjpeg($filePath);
		ob_start();
		imagejpeg($orig_image);
		$jpeg = ob_get_clean();
		echo '
			<tr>
				<td>
				<img src="data:image/jpeg;base64,'.base64_encode($jpeg).'"/>
				</td>
			</tr>';
		$image_info = getimagesize($filePath); 
		$width_orig  = $image_info[0]; // current width as found in image file
		$height_orig = $image_info[1]; // current height as found in image file
		echo $width_orig, $height_orig;
		$width = 200; // new image width
		$height = 150; // new image height
		$destination_image = imagecreatetruecolor($width, $height);
		imagecopyresampled($destination_image, $orig_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
		// This will just copy the new image over the original at the same filePath.
		imagejpeg($destination_image, $filePath, 100);

		
		ob_start();
		imagejpeg($destination_image);
		$file1 = ob_get_clean();

		//$file = addslashes(file_get_contents($_FILES['image']['tmp_name']));
		$file = addslashes($file1);
		$sql = "insert into photostemp (image) values ('$file');";
		$result = mysqli_query($db, $sql);
		if ($result){
			echo "<script>alert('Image inserted successfull')</script>";
		}
		else{
			echo "<h3>query unsuccessful</h3>";
		}
		
		//header('Location: welcome3.php');
	}
?>

<html>

	<head>
		<title>Welcome</title>
	</head>

	<body>
		<h1>Welcome</h1>
		<form method="post" enctype="multipart/form-data">
			<input type="file" name="image">
			<br/>
			<input type="submit" name="sumit" value="Upload image">
		</form>
		<table class="table table-bordered">
		<tr>
			<th>Image</th>
		</tr>
		<?php
			// include("config.php");
			$query = "select * from photostemp;";
			$result = mysqli_query($db, $query);
			while ($row = mysqli_fetch_array($result))
			{	
				
				// echo $row['image'];
				echo '
					<tr>
						<td>
						<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>
						</td>
					</tr>
				';
			}
		?>
		</table>
		<h2><a href = "logout.php">Sign Out</a></h2>
	</body>

</html>
