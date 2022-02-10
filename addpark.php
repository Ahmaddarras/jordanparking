<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./download-removebg-preview.png" type="image/icon type">
    

    <title>Add Jordan Parking</title>
</head>

<body>
    <div class="col-md-12 ">
        <div class="row" style=" background-color: #f0f8ff7a;border-raduis:25px;border-radius: 25px;">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid" style="background-color: #709e9e;">
  <div style="padding: 10px;" >
                    <img src="./img/Jordan1.gif" alt=""
                        style="height: 59px;border-radius: 67px; ">
                        
                </div>
                
    <a class="navbar-brand" href="#" style="font-weight: bold;font-size: 26px;color: #ffffff;"> JORDAN PARKING</a>
   
    <a href="./parkingsys.php"><label for="floatingInput" style="color:#ffffff; font-weight: bold;cursor: pointer;">Home</label></a>
    
</nav>
        
        <div class="row">
            <div class="col-md-6" >
               
            <div id="canvas" class="card" style="width:30rem;position: relative;overflow: hidden;height: 39rem;     right: 24px;margin: 62px; border-radius: 25px;"> </div> 

            </div>
            <div class="col-md-6 " >
                <div class="card" style="width: 70%;margin: 62px; border-radius: 25px;background-color: #f1f1f1 ;">
                    <form action="addpark.php" method="post" style="padding: 21px;">
                        <label for="">Parking Name </label>
                        <br>
                        <input class="controls form-control" type="text" name="name" placeholder="Parking Name"
                            size="104"  required>
                        <br>
                        <label for="">Address </label>
                        <br>
                        <input id="map-search" id="map-search" name="address" class="controls form-control" type="text"
                            placeholder="Search Box" size="104" required>
                        <br>
                        <label for="">Latitude</label>
                        <br>
                        <input type="text" class="latitude form-control" name="lat" placeholder=" Latitude" required>
                        <br>
                        <label for="">Longitude</label>
                        <br>
                        <input type="text" class="longitude form-control " name="lng" placeholder=" Longitude" required>
                        <br>
                        <label for="">Start Open</label>
                        <br>
                        <input type="time" class=" form-control " name="op"  placeholder=" Open at" required>
                        <br>
                        
                        <label for="">close</label>
                        <br>
                        <input type="time" title="Insert a valid time in hh:mm:ss 24h format" placeholder="Insert a valid time" pattern="([0-1]\d|2[0-3]):[0-5]\d:[0-5]\d" class=" form-control " name="oc" placeholder=" Open at" required>
                        <br>
                        <label for="">Type Parking </label>
                        <br>
                        
                        <select class="form-select" aria-label="Default select example" name="type" required >
                            <option selected >Select Park</option>
                            <option >Park</option>
                            <option >AutoPark</option>
                        </select> 
                       
                        <span style="font-size: 11px;font-weight: bold;float: right;color: red;">Note: *** please Select Your Type Parking</span>
                        <br>
                        <label for="">Number Phone </label>
                        <br>
                        <input type="text" class="longitude form-control " name="No" placeholder=" Number phone Parking" required>
                        <br>
                        
                        <button type="submit" name="add" class="btn btn-primary">Add Park</button>
                        <br>
                        
                        
                        
                    </form>
                    
                      <a href="parkingsys.php" style="height: 0px;"><button type="submit"  class="btn btn-primary" style="float: right;margin: 12px;position: relative;bottom: 79px;">Back To Home</button></a>
                    

                </div>
                  
            </div>
            
            





        </div>


    </div>
   
    <script src="addpark.js"></script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCp4CA-s0PLfVAOXN29awR8zvQv6X0ICMM&libraries=places&callback=initialize"></script>
</body>

</html>
<?php
include "db.php";


 if(isset($_POST['add'])){
    
    	$lat =$_POST['lat'];
	    $lng = $_POST['lng'];
        $name=$_POST['name'];
        $address=$_POST['address'];
        $type=$_POST['type'];
            $num=$_POST['No'];
            $open=$_POST['op'];
            $close=$_POST['oc'];
      
    $query = "INSERT INTO `markers`(`name`, `address`,`lat`,`lng`, `type`,`number_ph`,`open`,`close`) 
    VALUES ('$name','$address',' $lat',' $lng','$type','$num','$open','$close')";
    $result = mysqli_query($conn, $query);
    if($query_run)
{
    alert( 'Thank you For Add Park   => Add Parking is pendding form Admin ');
}else{
    echo'<script>alert( "Thank you For Add Park   => Add Parking is pendding form Admin ")</script>';

}
    


  
   
 }
 
?>