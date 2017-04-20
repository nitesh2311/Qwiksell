<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '12345');
   define('DB_DATABASE', 'projectdatabase');
   
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   
   if (!$db){
 
    //echo "<h1>not connected</h1>";
 
   }
   else {
 
    //echo "<h1>connected</h1>";
   
   }
   #$sql1 = "insert into userpass values(6,'user4','pwd5')";
   #mysqli_query($db,$sql1); 



?>