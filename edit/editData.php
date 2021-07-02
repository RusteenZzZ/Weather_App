<?php
require_once "../include/connect.php";

$ID = $_POST['weatherID'];

if($_POST['Delete?'] == "true"){
    $SQL = "DELETE FROM weather WHERE weather.weatherDataID = :ID";
    $query = $pdo->prepare($SQL);
    $query->execute(['ID'=>$ID]);
}else{
    $date = $_POST["date"];
    $time = $_POST['time'];
    $temp = $_POST['temp'];
    $air_pres = $_POST['air_pres'];
    $precip = $_POST['precip'];
    $solar_rad = $_POST['solar_rad'];
    $wind_speed = $_POST['wind_speed'];
    $wind_dir = $_POST['wind_dir'];
    $humidity = $_POST['humidity'];
    $uv_index = $_POST['uv_index'];
    $cloudiness = $_POST['cloudiness'.$ID];
    $overall = $_POST['overall'.$ID];

    $SQL = "UPDATE weather SET dateMeasurement = :date , timeMeasurement = :time , temperature = :temp , airPressure = :air_pres , precipitation = :precip, solarRadiance = :solar_rad , windSpeed = :wind_speed, windDirection = :wind_dir , humidity = :humidity, UVindex = :uv_index, cloudinessID = :cloudiness, weatherOverallID = :overall WHERE weather.weatherDataID = :weatherID";
    $query = $pdo->prepare($SQL);

    $query->execute(['date'=>$date, 'time'=>$time, 'temp'=>$temp, 'air_pres'=>$air_pres, 'precip'=>$precip, 'solar_rad'=>$solar_rad, 'wind_speed'=>$wind_speed, 'wind_dir'=>$wind_dir, 'humidity'=>$humidity, 'uv_index'=>$uv_index, 'cloudiness'=>$cloudiness, 'overall'=>$overall, 'weatherID'=>$ID]);
}

header('Location: /WeatherApp');
?>