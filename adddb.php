<?php
include "db.php";

 if(isset($_POST['add'])){
    
    	$lat =($_POST['lat']);
	    $lng = $_POST['lng'];
        $name=$_POST['name'];
        $address=$_POST['address'];
      
    $query = "INSERT INTO `marker`(`lat`,`lng`,`name`, `address`) VALUES (' $lat',' $lng','$name','$address')";
    $result = mysqli_query($conn, $query);
    echo "successfull";
    header("location:addpark.php");
  
   
 }
?>