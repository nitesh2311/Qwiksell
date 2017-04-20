<html>
<body>
		
<form method="POST"  enctype="multipart/form-data">
 <input type="file" name="image1">
 <input type="submit" name="upload_image" value="Upload">
</form>

</body>
</html>

<?php


$upload_image = $_FILES[" image1 "][ "name" ];

$folder = "images/";

move_uploaded_file($_FILES[" image1 "][" tmp_name "], "$folder".$_FILES[" image1 "][" name "]);

$file = 'images/'.$_FILES[" image1 "][" name "];



$uploadimage = $folder.$_FILES[" image1 "][" name "];
$newname = $_FILES[" image1 "][" name "];

// Set the resize_image name
$resize_image = $folder.$newname."_resize.jpg"; 
$actual_image = $folder.$newname.".jpg";

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
    Default quality is 75


$out_image=addslashes(file_get_contents($resize_image));

// After that you can insert the path of the resized image into the database

$insertquery = " insert into resize_images values('1,$out_image') ";
$result = mysql_query( $insertquery );

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
?>

