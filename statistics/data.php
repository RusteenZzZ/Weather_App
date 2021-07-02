<?php
session_start();
require_once "../include/connect.php";
require_once('jpgraph/jpgraph.php');
require_once('jpgraph/jpgraph_line.php');

if($_POST['f_or_l'] == "l"){
    $SQL1 = "SELECT * FROM weather ORDER BY weather.dateMeasurement DESC, weather.timeMeasurement DESC";
    $_SESSION['f_or_l'] = "l";
} else {
    $SQL1 = "SELECT * FROM weather ORDER BY weather.dateMeasurement, weather.timeMeasurement";
    $_SESSION['f_or_l'] = "f";
}

$SQL2 = "SELECT COUNT(*) as num_of_rows FROM weather";


$query2 = $pdo->query($SQL2);
$num_of_recs = $query2->fetch(PDO::FETCH_OBJ)->num_of_rows;

$query1 = $pdo->query($SQL1);

$_SESSION["sql"] = $SQL1;
$_SESSION["num"] = $_POST['num_of_records'];

?>
<!DOCTYPE html>
<html>
<head>
  <title>Weather App</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="statistics.css" rel="stylesheet" type="text/css">
</head>
<body>
  <header>
    <!-- <nav>
      <div id="main_page">
        <a href="../"><img src="../img/logo.png" alt="LOGO" id="logo"></a>
      </div>
      <div id="add">
        <a href="../add/add.php" class="button">Add data</a>
      </div>
      <div id="edit">
        <a href="../edit/edit.php" class="button">Edit data</a>
      </div>
      <div id="statistics">
        <a href="../statistics/statistics.html" class="button">Statistics</a>
      </div>
      <div id="interactive_mode">
        <a href="../interactive/interactive.html" class="button">Interactive mode(doesn't work)</a>
      </div>
    </nav> -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark navbar-fixed">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <a href="/WeatherApp"><img src="../img/logo.png" alt="LOGO" id="logo"></a>
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
            <a href="../add/add.php" class="button">Add data</a>
            </li>
            <li class="nav-item">
            <a href="../edit/edit.php" class="button">Edit data</a>
            </li>
            <a href="../statistics/statistics.html" class="button">Statistics</a>
            </li>
            <li class="nav-item">
            <a href="../interactive/interactive.php" class="button">Interactive mode</a>
            </li>
          </ul>
        </div>
      </nav>
  </header>

  <main>
      <?php
        if($num_of_recs < $_POST['num_of_records'] || $_POST['num_of_records'] <= 0){
      ?>
        <div class="inp">
            <label>Your input of number of records is invalid or there are no enough records in the database</label>
        </div>
        <div class="inp">
            <a href="statistics.html">Try again!</a>
        </div>
      <?php
        }else{

            $Temp_Max = -9999;
            $Temp_Min = 9999;
            $Temp_Avr = 0;

            $Pres_Max = -9999;
            $Pres_Min = 9999;
            $Pres_Avr = 0;

            $Precip_Max = -9999;
            $Precip_Min = 9999;
            $Precip_Avr = 0;

            $Rad_Max = -9999;
            $Rad_Min = 9999;
            $Rad_Avr = 0;

            $Wind_Max = -9999;
            $Wind_Min = 9999;
            $Wind_Avr = 0;

            $Hum_Max = -9999;
            $Hum_Min = 9999;
            $Hum_Avr = 0;

            $UV_Max = -9999;
            $UV_Min = 9999;
            $UV_Avr = 0;

            for( $i=0; $i<intval($_POST['num_of_records']); $i++){

                $row = $query1->fetch(PDO::FETCH_OBJ);

                if($row->temperature >= $Temp_Max) $Temp_Max = $row->temperature;
                if($row->temperature <= $Temp_Min) $Temp_Min = $row->temperature;
                $Temp_Avr = $row->temperature + $Temp_Avr;

                if($row->airPressure >= $Pres_Max) $Pres_Max = $row->airPressure;
                if($row->airPressure <= $Pres_Min) $Pres_Min = $row->airPressure;
                $Pres_Avr = $row->airPressure + $Pres_Avr;

                if($row->precipitation >= $Precip_Max) $Precip_Max = $row->precipitation;
                if($row->precipitation <= $Precip_Min) $Precip_Min = $row->precipitation;
                $Precip_Avr = $row->precipitation + $Precip_Avr;

                if($row->solarRadiance >= $Rad_Max) $Rad_Max = $row->solarRadiance;
                if($row->solarRadiance <= $Rad_Min) $Rad_Min = $row->solarRadiance;
                $Rad_Avr = $row->solarRadiance + $Rad_Avr;

                if($row->windSpeed >= $Wind_Max) $Wind_Max = $row->windSpeed;
                if($row->windSpeed <= $Wind_Min) $Wind_Min = $row->windSpeed;
                $Wind_Avr = $row->windSpeed + $Wind_Avr;

                if($row->humidity >= $Hum_Max) $Hum_Max = $row->humidity;
                if($row->humidity <= $Hum_Min) $Hum_Min = $row->humidity;
                $Hum_Avr = $row->humidity + $Hum_Avr;

                if($row->UVindex >= $UV_Max) $UV_Max = $row->UVindex;
                if($row->UVindex <= $UV_Min) $UV_Min = $row->UVindex;
                $UV_Avr = $row->UVindex + $UV_Avr;
              }

              $Temp_Avr = $Temp_Avr/$_POST['num_of_records'];
              $Pres_Avr = $Pres_Avr/$_POST['num_of_records'];
              $Precip_Avr = $Precip_Avr/$_POST['num_of_records'];
              $Rad_Avr = $Rad_Avr/$_POST['num_of_records'];
              $Wind_Avr = $Wind_Avr/$_POST['num_of_records'];
              $Hum_Avr = $Hum_Avr/$_POST['num_of_records'];
              $UV_Avr = $UV_Avr/$_POST['num_of_records'];

      ?>
        <div class="data">
            <label>Temperature:</label><br>
            <p>Max temperature is: <?php echo number_format($Temp_Max,2); ?></p>
            <p>Min temperature is: <?php echo $Temp_Min; ?></p>
            <p>Average temperature is: <?php echo $Temp_Avr; ?></p>
            <hr>
            <label>Air pressure:</label><br>
            <p>Max air pressure is: <?php echo $Pres_Max; ?></p>
            <p>Min air pressure is: <?php echo $Pres_Min; ?></p>
            <p>Average air pressure is: <?php echo $Pres_Avr; ?></p>
            <hr>
            <label>Precipitation:</label><br>
            <p>Max precipitation is: <?php echo $Precip_Max; ?></p>
            <p>Min precipitation is: <?php echo $Precip_Min; ?></p>
            <p>Average precipitation is: <?php echo $Precip_Avr; ?></p>
            <hr>
            <label>Solar radiance:</label><br>
            <p>Max soalr radiance is: <?php echo $Rad_Max; ?></p>
            <p>Min solar radiance is: <?php echo $Rad_Min; ?></p>
            <p>Average solar radiance is: <?php echo $Rad_Avr; ?></p>
            <hr>
            <label>Wind speed:</label><br>
            <p>Max wind speed is: <?php echo $Wind_Max; ?></p>
            <p>Min wind speed is: <?php echo $Wind_Min; ?></p>
            <p>Average wind speed is: <?php echo $Wind_Avr; ?></p>
            <hr>
            <label>Humidity:</label><br>
            <p>Max humidity is: <?php echo $Hum_Max; ?></p>
            <p>Min humidity is: <?php echo $Hum_Min; ?></p>
            <p>Average humidity is: <?php echo $Hum_Avr; ?></p>
            <hr>
            <label>UV index:</label><br>
            <p>Max UV index is: <?php echo $UV_Max; ?></p>
            <p>Min UV index is: <?php echo $UV_Min; ?></p>
            <p>Average UV index is: <?php echo $UV_Avr; ?></p>
        </div>
        <div class="data">
            <label>The graphs:</label><br>
            <hr>
            <img src="graphs/temp.php" alt="temperature">
            <hr>
            <img src="graphs/pressure.php" alt="pressure">
            <hr>
            <img src="graphs/precipitation.php" alt="precipitation">
            <hr>
            <img src="graphs/radiance.php" alt="radiance">
            <hr>
            <img src="graphs/speed.php" alt="speed">
            <hr>
            <img src="graphs/humidity.php" alt="humidity">
            <hr>
            <img src="graphs/UV.php" alt="UV">
        </div>
      <?php
        }
      ?>
  </main>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>