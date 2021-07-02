<?php
require_once "../include/connect.php"
?>

<!DOCTYPE html>
<html>
<head>
  <title>Weather App</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="add.css" rel="stylesheet" type="text/css">
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
    <form action="addData.php" method="POST" id="form">
      <div class="inp">
        <span>
          Date:
        </span>
        <input type="date" name="date" required>
      </div>
      <div class="inp">
        <span>
          Time:
        </span>
        <input type="time" name="time" required>
      </div>
      <div class="inp">
        <span>
          Temperature:
        </span>
        <input type="number" name="temp" required>
      </div>
      <div class="inp">
        <span>
          Air pressure:
        </span>
        <input type="number" name="air_pres" required>
      </div>
      <div class="inp">
        <span>
          Precipitation:
        </span>
        <input type="number" name="precip" required>
      </div>
      <div class="inp">
        <span>
          Solar radiation:
        </span>
        <input type="number" name="solar_rad" required>
      </div>
      <div class="inp">
        <span>
          Wind speed:
        </span>
        <input type="number" name="wind_speed" required>
      </div>
      <div class="inp">
        <span>
          Wind direction:
        </span>
        <input type="number" name="wind_dir" required>
      </div>
      <div class="inp">
        <span>
          Humidity:
        </span>
        <input type="number" name="humidity" required>
      </div>
      <div class="inp">
        <span>
          UV index:
        </span>
        <input type="number" name="uv_index" required>
      </div>
      <div class="inp2">
        <span>
          Cloudiness:
        </span><br><br>
        <?php
          $SQL2 = "SELECT * FROM cloudiness";
          $query2 = $pdo->query($SQL2);
          while($row2 = $query2->fetch(PDO::FETCH_OBJ)){
        ?>
          <input type="radio" name="cloudiness" value="<?php echo $row2->cloudinessID; ?>" <?php if( 1 == intval($row2->cloudinessID )) echo "checked"; ?> ><label> <?php echo $row2->cloudinessDescription ?> </label><br>
        <?php
          }
        ?>
      </div>
      <div class="inp2">
        <span>
          Weather overall:
        </span><br><br>
        <?php
          $SQL3 = "SELECT * FROM weather_overall";
          $query3 = $pdo->query($SQL3);
          while($row3 = $query3->fetch(PDO::FETCH_OBJ)){
        ?>
          <input type="radio" name="overall" value="<?php echo $row3->weatherOverallID; ?>" <?php if( 1 == intval($row3->weatherOverallID )) echo "checked"; ?> ><label> <?php echo $row3->weatherDescription ?> </label><br>
        <?php
          }
        ?>
      </div>
      <div class="inp">
        <input type="submit" value="Submit">
      </div>
    </form>
  </main>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>