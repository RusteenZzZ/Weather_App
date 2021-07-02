<?php
require_once "include/connect.php";

$SQL = "SELECT * FROM weather
LEFT JOIN cloudiness ON weather.cloudinessID = cloudiness.cloudinessID
LEFT JOIN weather_overall ON weather.weatherOverallID = weather_overall.weatherOverallID
ORDER BY weather.dateMeasurement DESC, weather.timeMeasurement DESC";

$query = $pdo->query($SQL);

$row = $query->fetch(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Weather App</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="index.css" rel="stylesheet" type="text/css">
</head>
<body>
  
  <header>
    <!-- <nav>
      <div id="main_page">
        <a href="/"><img src="img/logo.png" alt="LOGO" id="logo"></a>
      </div>
      <div id="add">
        <a href="add/add.php" class="button">Add data</a>
      </div>
      <div id="edit">
        <a href="edit/edit.php" class="button">Edit data</a>
      </div>
      <div id="statistics">
        <a href="statistics/statistics.html" class="button">Statistics</a>
      </div>
      <div id="interactive_mode">
        <a href="interactive/interactive.html" class="button">Interactive mode(doesn't work)</a>
      </div>

      <span class="burger"></span>

    </nav> -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark navbar-fixed">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a href="/WeatherApp"><img src="img/logo.png" alt="LOGO" id="logo"></a>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
        <a href="add/add.php" class="button">Add data</a>
        </li>
        <li class="nav-item">
        <a href="edit/edit.php" class="button">Edit data</a>
        </li>
        <li class="nav-item">
        <a href="statistics/statistics.html" class="button">Statistics</a>
        </li>
        <li class="nav-item">
        <a href="interactive/interactive.php" class="button">Interactive mode</a>
        </li>
      </ul>
    </div>
  </nav>
  </header>

  <div id="welcome">
    <span>WELCOME!</span>
  </div>

  <div id="latest">
    <span>Some latest data:</span>
  </div>

  <main id="main">
    <div id="info">
      <div class="info2">
        <span><?php echo $row->dateMeasurement; ?></span>
      </div>
      <div class="info2">
        <span><?php echo $row->timeMeasurement; ?></span>
      </div>
      <div class="info2">
        <span><?php echo $row->weatherDescription; ?></span>
      </div>
      <div class="info2">
        <span><?php echo $row->cloudinessDescription; ?></span>
      </div>
      <div class="info2">
        <span>Temperature is <?php echo $row->temperature; ?> degrees</span>
      </div>
    </div>
    <div id="picture">
      <?php
        $time = intval(date('s', $row->timeMeasurement));
        if(($time >= 0 && $time <= 5) || ($time >= 18 && $time <= 23)){
          switch(intval($row->cloudinessID)){
            case 1:
              echo '<img src="img/Cloudless_night.png" alt="cloudless night" id="illustration">';
              break;
            case 2:
              echo '<img src="img/Cloudy_night.png" alt="cloudy night" id="illustration">';
              break;
            case 3:
              echo '<img src="img/Cloudy_night.png" alt="cloudy night" id="illustration">';
              break;
            case 4:
              echo '<img src="img/Cloudy_night.png" alt="cloudy night" id="illustration">';
              break;
            case 5:
              echo '<img src="img/Overcast_night.png" alt="overcast night" id="illustration">';
              break;
            case 6:
              echo '<img src="img/Light_rain_night.gif" alt="light rain night" id="illustration">';
              break;
            case 7:
              echo '<img src="img/Light_rain_night.gif" alt="light rain night" id="illustration">';
              break;
            case 8:
              echo '<img src="img/Rain_night.gif" alt="rain night" id="illustration">';
              break;
            case 9:
              echo '<img src="img/Rain_night.gif" alt="rain night" id="illustration">';
              break;
            case 10:
              echo '<img src="img/Thunderstorm_night.gif" alt="rain night" id="illustration">';
              break;
            case 11:
              echo '<img src="img/Snow_night.gif" alt="snow night" id="illustration">';
              break;
            case 12:
              echo '<img src="img/Snow_night.gif" alt="snow night" id="illustration">';
              break;
            case 13:
              echo '<img src="img/Snow_night.gif" alt="snow night" id="illustration">';
              break;
          }
        }else{
          switch(intval($row->cloudinessID)){
            case 1:
              echo '<img src="img/Cloudless_day.png" alt="cloudless day" id="illustration">';
              break;
            case 2:
              echo '<img src="img/Cloudy_day.png" alt="cloudy dat" id="illustration">';
              break;
            case 3:
              echo '<img src="img/Cloudy_day.png" alt="cloudy day" id="illustration">';
              break;
            case 4:
              echo '<img src="img/Cloudy_day.png" alt="cloudy day" id="illustration">';
              break;
            case 5:
              echo '<img src="img/Overcast_day.png" alt="overcast day" id="illustration">';
              break;
            case 6:
              echo '<img src="img/Light_rain_day.gif" alt="light rain day" id="illustration">';
              break;
            case 7:
              echo '<img src="img/Light_rain_day.gif" alt="light rain day" id="illustration">';
              break;
            case 8:
              echo '<img src="img/Rain_day.gif" alt="rain day" id="illustration">';
              break;
            case 9:
              echo '<img src="img/Rain_day.gif" alt="rain day" id="illustration">';
              break;
            case 10:
              echo '<img src="img/Thunderstorm_day.gif" alt="rain day" id="illustration">';
              break;
            case 11:
              echo '<img src="img/Snow_day.gif" alt="snow day" id="illustration">';
              break;
            case 12:
              echo '<img src="img/Snow_day.gif" alt="snow day" id="illustration">';
              break;
            case 13:
              echo '<img src="img/Snow_day.gif" alt="snow day" id="illustration">';
              break;
        }
      }
      ?>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>