<?php

$cities = ['New York','Miami','Orlando'];

define("MAPS_HOST", "maps.google.com");
define("KEY", "AIzaSyC7M9RhSGGWl9fFdU82BFagze8-aCX9o0o");	//Personal Google Maps API key

function getHumidity($city_name){
    $base_url = "http://" . MAPS_HOST . "/maps/geo?output=xml" . "&key=" . KEY;


    $api_key = '43536a8f226f8ac30ffd28cf223f3c34';
    $api_url = 'http://api.openweathermap.org/data/2.5/weather?q='.$city_name. '&lang=en&units=metric&appid='.$api_key;

    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    
    curl_close($ch);
    $data = json_decode($response);
    $currentTime = time();
    

    return $data;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Humidity</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
    
        
        <?php 
            foreach($cities as $city_name){
                $data = getHumidity($city_name);
                ?>
                <div class="card text-center" style="width: 18rem;">
                    <h2><?php echo $data->name; ?> Humidity Status</h2>
                    <div class="card-body">
                        <div class="time">
                            <div>Humidity:  <?php echo $data->main->humidity; ?> %</div>  
                            <div>Long:  <?php echo $data->coord->lon; ?></div>  
                            <div>Lat:  <?php echo $data->coord->lat; ?></div>  
                        </div>
                    </div>
                </div>
                <br>
                <?php
            }
        ?>
       
    
    


</body>
</html>
