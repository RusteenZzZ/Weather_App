<?php
require_once "../include/connect.php"
?>

<!DOCTYPE html>
<html>
<head>
    <title>Weather App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="interactive.css" rel="stylesheet" type="text/css">
</head>
    
<body>
    <header style="z-index: 100;">
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
        <canvas id="canvas" width="1200" height="800" style="z-index: 10;">
            It looks like your browser doesn't support canvas :(
        </canvas>
    </main>

    <label style="margin-left: 100px; margin-top: 10px; background-color: rgb(210,210,210); border: 1px solid black; width: 800px">
        <div style="margin: 10px;">
          Welcome to the interactive mode! Here you can add some data to the database and find some interesting things! It's like a game. Use W A S D buttons to move (This mode doesn't support mobile devices)<br>
          <b>Radio:</b><br>
          Approach to the radio and press F to turn it on or change the music<br>
          Approach to the radio and press C to turn it off<br>
          <b>Trailer:</b><br>
          Approach to the trailer and press F to talk to Bobby<br>
          <b>Laptop:</b><br>
          Approach to the laptop and press F to add some data (Some form will appear to fill). Fill it, press submit, and your data is added!<br>
          Press C in order to close the laptop<br>
          <b>Exit:</b><br>
          Approach to it and press F to open the main page<br>
        </div>
    </label>

    <section id="ADD" style="width:1000px;height:1700px;z-index:-50;display:none;position:absolute;left:100px;top:100px;margin:0px 100px">
    <form action="/" method="POST" id="form">
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
        <input type="submit" value="Submit" id="Submit">
      </div>
    </form>
    </section>

    <script src="interactive.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>