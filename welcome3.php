<?php
	include ("session.php");
	include("config.php");
	$msg = "";
	if (isset($_POST['sumit'])) {
	// if($_SERVER["REQUEST_METHOD"] == "POST") {
		$file = addslashes(file_get_contents($_FILES['image']['tmp_name']));
		// $type = exif_imagetype($_FILES['image']['name']);
		// echo "<script>alert('$type')</script>";
		// if($type!=False){
		// 	echo "<script>alert('$type')</script>";
		// }
		// else{
		// 	echo "<script>alert('Image not correct')</script>";
		// }
		// $target = "images/".basename($_FILES['image']['name']);

		// $db = mysqli_connect("localhost", "root", "", "photos");

		// $image = mysqli_real_escape_string($db,$_FILES['image']['name']);
		// $image = $_FILES['image']['name'];
		// $image = "index.jpeg";

		// $sql = "INSERT INTO PHOTOS (image) VALUES ('$image');";
		$sql = "insert into photos1 (image) values ('$file');";
		// echo "<h3>", $target, "</h3>";
		$result = mysqli_query($db, $sql);
		if ($result){
			echo "<script>alert('Image inserted successfull')</script>";
		}
		else{
			echo "<h3>query unsuccessful</h3>";
		}
		// echo "<h3>gfsd</h3>";

		// if (move_uploaded_file($_FILES['image']['tmp_name'], $target)){
		// // if (move_uploaded_file($image, $target)){
		// 	echo "<h1>Image uploaded successfully</h1>";
		// }
		// else{
		// 	echo "<h1>Image not uploaded</h1>";
		// }
		// alert($msg);
		header('Location: welcome3.php');
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
			$query = "select * from photos1;";
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
			// header("Content-type: image/jpeg");
			// echo mysql_result($result, 0);
		?>
		</table>
		<h2><a href = "logout.php">Sign Out</a></h2>
	</body>

</html>
