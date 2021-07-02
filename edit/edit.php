<?php
require_once "../include/connect.php";

$SQL = "SELECT * FROM weather
LEFT JOIN cloudiness ON weather.cloudinessID = cloudiness.cloudinessID
LEFT JOIN weather_overall ON weather.weatherOverallID = weather_overall.weatherOverallID
ORDER BY weather.dateMeasurement, weather.timeMeasurement";

$query = $pdo->query($SQL);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Weather App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="edit.css" rel="stylesheet" type="text/css">
</head>
<body>
    <header>
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
            while($row = $query->fetch(PDO::FETCH_OBJ)){
        ?>
        <form action="editData.php" method="POST">
        <div class="info">
            <input id="secret" name="weatherID" value="<?php echo $row->weatherDataID; ?>">

            <div class="info2">
                <?php
                    $time = intval(date('s', $row->timeMeasurement));
                    if(($time >= 0 && $time <= 5) || ($time >= 18 && $time <= 23)){
                        switch(intval($row->cloudinessID)){
                          case 1:
                            echo '<img src="../img/Cloudless_night.png" alt="cloudless night" class="illustration">';
                            break;
                          case 2:
                            echo '<img src="../img/Cloudy_night.png" alt="cloudy night" class="illustration">';
                            break;
                          case 3:
                            echo '<img src="../img/Cloudy_night.png" alt="cloudy night" class="illustration">';
                            break;
                          case 4:
                            echo '<img src="../img/Cloudy_night.png" alt="cloudy night" class="illustration">';
                            break;
                          case 5:
                            echo '<img src="../img/Overcast_night.png" alt="overcast night" class="illustration">';
                            break;
                          case 6:
                            echo '<img src="../img/Light_rain_night.gif" alt="light rain night" class="illustration">';
                            break;
                          case 7:
                            echo '<img src="../img/Light_rain_night.gif" alt="light rain night" class="illustration">';
                            break;
                          case 8:
                            echo '<img src="../img/Rain_night.gif" alt="rain night" class="illustration">';
                            break;
                          case 9:
                            echo '<img src="../img/Rain_night.gif" alt="rain night" class="illustration">';
                            break;
                          case 10:
                            echo '<img src="../img/Thunderstorm_night.gif" alt="rain night" class="illustration">';
                            break;
                          case 11:
                            echo '<img src="../img/Snow_night.gif" alt="snow night" class="illustration">';
                            break;
                          case 12:
                            echo '<img src="../img/Snow_night.gif" alt="snow night" class="illustration">';
                            break;
                          case 13:
                            echo '<img src="../img/Snow_night.gif" alt="snow night" class="illustration">';
                            break;
                        }
                      }else{
                        switch(intval($row->cloudinessID)){
                          case 1:
                            echo '<img src="../img/Cloudless_day.png" alt="cloudless day" class="illustration">';
                            break;
                          case 2:
                            echo '<img src="../img/Cloudy_day.png" alt="cloudy day" class="illustration">';
                            break;
                          case 3:
                            echo '<img src="../img/Cloudy_day.png" alt="cloudy day" class="illustration">';
                            break;
                          case 4:
                            echo '<img src="../img/Cloudy_day.png" alt="cloudy day" class="illustration">';
                            break;
                          case 5:
                            echo '<img src="../img/Overcast_day.png" alt="overcast day" class="illustration">';
                            break;
                          case 6:
                            echo '<img src="../img/Light_rain_day.gif" alt="light rain day" class="illustration">';
                            break;
                          case 7:
                            echo '<img src="../img/Light_rain_day.gif" alt="light rain day" class="illustration">';
                            break;
                          case 8:
                            echo '<img src="../img/Rain_day.gif" alt="rain day" class="illustration">';
                            break;
                          case 9:
                            echo '<img src="../img/Rain_day.gif" alt="rain day" class="illustration">';
                            break;
                          case 10:
                            echo '<img src="../img/Thunderstorm_day.gif" alt="thunderstorm day" class="illustration">';
                            break;
                          case 11:
                            echo '<img src="../img/Snow_day.gif" alt="snow day" class="illustration">';
                            break;
                          case 12:
                            echo '<img src="../img/Snow_day.gif" alt="snow day" class="illustration">';
                            break;
                          case 13:
                            echo '<img src="../img/Snow_day.gif" alt="snow day" class="illustration">';
                            break;
                      }
                    }
                ?>
            </div>

            <div class="info2">
                <span>
                    Date:
                </span>
                <input type="date" name="date" required value="<?php echo $row->dateMeasurement; ?>">
            </div>
            <div class="info2">
                <span>
                    Time:
                </span>
                <input type="time" name="time" required value="<?php echo $row->timeMeasurement; ?>">
            </div>
            <div class="info2">
                <span>
                    Temperature:
                </span>
                <input type="number" name="temp" required value="<?php echo $row->temperature; ?>">
            </div>
            <div class="info2">
                <span>
                    Air pressure:
                </span>
                <input type="number" name="air_pres" required value="<?php echo $row->airPressure; ?>">
            </div>
            <div class="info2">
                <span>
                    Precipitation:
                </span>
                <input type="number" name="precip" required value="<?php echo $row->precipitation; ?>">
            </div>
            <div class="info2">
                <span>
                    Solar radiation:
                </span>
                <input type="number" name="solar_rad" required value="<?php echo $row->solarRadiance; ?>">
            </div>
            <div class="info2">
                <span>
                    Wind speed:
                </span>
                <input type="number" name="wind_speed" required value="<?php echo $row->windSpeed; ?>">
            </div>
            <div class="info2">
                <span>
                    Wind direction:
                </span>
                <input type="number" name="wind_dir" required value="<?php echo $row->windDirection; ?>">
            </div>
            <div class="info2">
                <span>
                    Humidity:
                </span>
                <input type="number" name="humidity" required value="<?php echo $row->humidity; ?>">
            </div>
            <div class="info2">
                <span>
                    UV index:
                </span>
                <input type="number" name="uv_index" required value="<?php echo $row->UVindex; ?>">
            </div>
            <div class="info3">
                <span>
                    Cloudiness:
                </span><br><br>
                <?php
                    $SQL2 = "SELECT * FROM cloudiness";
                    $query2 = $pdo->query($SQL2);
                    while($row2 = $query2->fetch(PDO::FETCH_OBJ)){
                ?>
                    <input type="radio" name="cloudiness<?php echo $row->weatherDataID ?>" value="<?php echo $row2->cloudinessID; ?>" <?php if(intval($row->cloudinessID) == intval($row2->cloudinessID)) echo "checked"; ?> ><label> <?php echo $row2->cloudinessDescription ?> </label><br>
                <?php
                    }
                ?>
            </div>
            <div class="info3">
                <span>
                    Weather overall:
                </span><br><br>
                <?php
                    $SQL3 = "SELECT * FROM weather_overall";
                    $query3 = $pdo->query($SQL3);
                    while($row3 = $query3->fetch(PDO::FETCH_OBJ)){
                ?>
                    <input type="radio" name="overall<?php echo $row->weatherDataID; ?>" value="<?php echo $row3->weatherOverallID; ?>" <?php if(intval($row->weatherOverallID) == intval($row3->weatherOverallID)) echo "checked"; ?> ><label> <?php echo $row3->weatherDescription ?> </label><br>
                <?php
                    }
                ?>
            </div>
            <div class="info3">
                <input type="checkbox" name="Delete?" value="true">
                <label>Do you want to delete this record?:</label>
            </div>
            <div class="info2">
                <input type="submit" value="Submit">
            </div>
        </div>
        </form>
        <?php
            }
        ?>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>