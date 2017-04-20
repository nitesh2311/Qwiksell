<?php
	include('session.php');
	include("config.php");
	
	
	if (isset($_POST['upload'])) {


		$upload_image = $_FILES["image"][ "name" ];

		$folder = "images/";

		move_uploaded_file($_FILES["image"]["tmp_name"], "$folder".$_FILES["image"]["name"]);

		$file = 'images/'.$_FILES["image"]["name"];



		$uploadimage = $folder.$_FILES["image"]["name"];
		$newname = $_FILES["image"]["name"];

		// Set the resize_image name
		$resize_image = $folder."resize_".$newname; 
		$actual_image = $folder.$newname;

		// It gets the size of the image
		list( $width,$height ) = getimagesize( $uploadimage );


		// It makes the new image width of 350
		$newwidth = 350;


		// It makes the new image height of 350
		$newheight = 350;


		// It loads the images we use jpeg function you can use any function like imagecreatefromjpeg
		$thumb = imagecreatetruecolor( $newwidth, $newheight );
		$source = imagecreatefromjpeg( $resize_image );


		// Resize the $thumb image.
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);


		// It then save the new image to the location specified by $resize_image variable

		imagejpeg( $thumb, $resize_image, 100 ); 

		// 100 Represents the quality of an image you can set and ant number in place of 100.
		    


		$out_image=addslashes(file_get_contents($_FILES['image']['tmp_name']));

		// After that you can insert the path of the resized image into the database

		$sql = "insert into photos (image) values ('$out_image');";
		$result = mysqli_query($db, $sql);



		/*$file = addslashes(file_get_contents($_FILES['image']['tmp_name']));		

		echo "<h3>",$_FILES['image']['tmp_name'],"/",$_FILES['image']['name'],"</h3>";

		$percent = 0.5;
		$filename=$_FILES['image']['tmp_name']."/".$_FILES['image']['name'];
		// Get new sizes
		list($width, $height) = getimagesize($filename);
		$newwidth = $width * $percent;
		$newheight = $height * $percent;

		// Load
		$thumb = imagecreatetruecolor($newwidth, $newheight);
		$source = imagecreatefromjpeg($filename);

		// Resize
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

		// Output and free memory
		//the resized image will be 400x300
		imagejpeg($thumb);
		imagedestroy($thumb);


		$sql = "insert into photos (image) values ('$file');";
		$result = mysqli_query($db, $sql);
		
		if ($result){
			//echo "<h3>Image inserted successful</h3>";
		}
		else{
			//echo "<h3>query unsuccessful</h3>";
		}*/
		//echo "<h3>",$_POST['upload'],"</h3>";
	}
?>

<html>

	<head>
		<title>Welcome </title>
	</head>

	<body>
		<h1>Welcome</h1>
		
		
		<?php
			// include("config.php");
			if (!isset($_POST['upload'])) {
				echo '	<form method="post" action="welcome2.php" enctype="multipart/form-data">
						<input type="file" name="image" id="image">
						<br/>
						<input type="submit" name="upload" id="upload" value="Upload image">
						</form>';	
			}
			else{

				$query = "select * from photos;";
				$result = mysqli_query($db, $query);
				while ($row = mysqli_fetch_array($result))
				{	echo'
					<tr>
						<td>
							<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>
						</td>
					</tr>';
				}
			}	
			
		?>
		<h2><a href = "logout.php">Sign Out</a></h2>
	</body>

</html>

