
<?php
	/* Database connection settings */
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'maps';
	$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
    
 	$coordinates = array();
 	$latitudes = array();
 	$longitudes = array();
     $open = array();
     $close = array();



	// Select all the rows in the markers table
    
	$query = "SELECT   `lat`, `lng`,`open`,`close` FROM `markers`  where stutes=1 ";
	$result = $mysqli->query($query) or die('data selection for google map failed: ' . $mysqli->error);
    $marker="";
 	while ($row = mysqli_fetch_array($result)) {
		$latitudes[] = $row['lat'];
		$longitudes[] = $row['lng'];
        $open=$row['open'];
        $close=$row['close'];
		$coordinates[] = 'new google.maps.LatLng(' . $row['lat'] .','. $row['lng'] .'),';
       
        
        $ParkSchedule = [
            'Sun' => ['08:00 AM' => '08:00 PM'],
            'Mon' => ['07:00 AM' => '11:00 PM'],
            'Tue' => ['08:00 AM' => '11:00 PM'],
            'Wed' => ['08:00 AM' => '10:00 PM'],
            'Thu' => ['08:00 AM' => '11:00 PM'],
            'Fri' => ['00:00 AM' => '00:00 PM'],
            'Sat' => ['08:00 AM' => '11:00 PM']
        ];
        $timestamp = time();
        $status = 'closed';
        $currentTime = (new DateTime())->setTimestamp($timestamp);
        foreach ($ParkSchedule[date('D', $timestamp)] as $startTime => $endTime) {
                $startTime = DateTime::createFromFormat('h:i A', $startTime);
                $endTime   = DateTime::createFromFormat('h:i A', $endTime);
    
                // check if current time is within a range
                
                if (($startTime < $currentTime) && ($currentTime <  $endTime)) {
                    $status = 'open';
                $marker.="
                s2 = {lat:$row[0], lng: $row[1]};
                var marker = new google.maps.Marker({
                position: s2,
                map: map,
                icon: m,
                animation: google.maps.Animation.DROP
                }); ";
           
            }else{
                $status = ' Close';
                $marker.="
                s2 = {lat:$row[0], lng: $row[1]};
                var marker = new google.maps.Marker({
                position: s2,
                map: map,
                icon: mark1,
                animation: google.maps.Animation.DROP
                }); ";

            }  
	}
}
?>


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
    <link rel="stylesheet" href="pakingsys.css">
    <link rel="icon" href="./img/download-removebg-preview.png" type="icon ">
    <title> Jordan Parking</title>
</head>


<body>
    <div class="col-md-12">
        <div class="row" style="background-color: #ffffffa3; height: auto; border-radius: 15px; ">
        

 <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  <div >
                    <img src="./img/download-removebg-preview.png" alt=""
                        style="height: 59px; padding-top: 10px;padding-left: 3px;">
                </div>
    <a class="navbar-brand" href="#" style="color: #0076b9;" > JORDAN PARKING</a>
    
    <!-- <br>
    <input type="text" class="form-control" placeholder="Search Parking" style="opacity: 0.8;border-radius: 25px;border-color: rgb(121, 121, 245);">
    <br> -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <form class="d-flex">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-primary" type="submit">Search</button>
    </form>
      <ul class="navbar-nav" style="font-weight: 600;">  
      
        
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="pagevisitor.php" style="padding-right: 20px;">Home</a>
        </li>
       
        <li class="nav-item dropdown">
          <a class="nav-link " href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Contact Admin</a>
        </li>
       
        <li class="nav-item dropdown">
          <a class="nav-link " href="login.php"   aria-current="page">
            Login
          </a>
        </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>     
        <div class="row" id="map" style="height: 42rem; ">
        </div>
    </div>
</body>
<script>
 function doNothing() {}

        let map, infoWindow;


        function initMap() {
            
      
         map = new google.maps.Map(document.getElementById("map"), {
             
      
      center: { lat: 31.979468690410922, lng:35.84560588354764 },
            zoom:12,
            
            
        } );
    };
</script>
    <script defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCp4CA-s0PLfVAOXN29awR8zvQv6X0ICMM&callback=initMap">
    </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
</html>
