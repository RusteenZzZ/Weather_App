<?php
require_once "../include/connect.php";

$date = $_POST['date'];
$time = $_POST['time'];
$temp = $_POST['temp'];
$air_pres = $_POST['air_pres'];
$precip = $_POST['precip'];
$solar_rad = $_POST['solar_rad'];
$wind_speed = $_POST['wind_speed'];
$wind_dir = $_POST['wind_dir'];
$humidity = $_POST['humidity'];
$uv_index = $_POST['uv_index'];
$cloudiness = $_POST['cloudiness'];
$overall = $_POST['overall'];

$SQL = "INSERT INTO weather (weatherDataID, dateMeasurement, timeMeasurement, temperature, airPressure, precipitation, solarRadiance, windSpeed, windDirection, humidity, UVindex, cloudinessID, weatherOverallID) VALUES (NULL, :date, :time, :temp, :air_pres, :precip, :solar_rad, :wind_speed, :wind_dir, :humidity, :uv_index, :cloudiness, :overall)";
$query = $pdo->prepare($SQL);

$query->execute(['date'=>$date, 'time'=>$time, 'temp'=>$temp, 'air_pres'=>$air_pres, 'precip'=>$precip, 'solar_rad'=>$solar_rad, 'wind_speed'=>$wind_speed, 'wind_dir'=>$wind_dir, 'humidity'=>$humidity, 'uv_index'=>$uv_index, 'cloudiness'=>$cloudiness, 'overall'=>$overall]);

echo json_encode($_POST['date']);
?>