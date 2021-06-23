<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Conversion Site - Home</title>
  </head>
  <body>

    <?php
      require 'function.php';

      $input = "";
      $result = "";
      $converted = "";

      if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $selection = $_POST['selection'];
        $input = $_POST['value'];

        $readData = read();
        $arr1 = json_decode($readData);

        for($i = 0; $i < count($arr1); $i++) {
          $decode = $arr1[$i];
          if ($decode->from === $selection) {
            $result = $input*$decode->value;
            $converted = $decode->to;
            break;
          }
          if ($decode->to === $selection) {
            $result = $input/$decode->value;
            $converted = $decode->from;
            break;
          }
        }

        session_start();
        $_SESSION['selection'] = $selection;
        if(!isset($_SESSION['history'])) {
          $_SESSION["history"] = "from " . $selection . " to " . $converted . "," . $input . "," . $result;
        }
        else {
          $_SESSION["history"] = $_SESSION["history"] . "," . "from " . $selection . " to " . $converted . "," . $input .  "," . $result;
        }
      }
    ?>

    <h3>Page 1 [Home]</h3>
    <?php require 'menu.html'; ?>
    <h4>Converter: </h4>
    <br>

<p>Distance Converter</p>
      <form class="" action="distance converter.php" method="post">
        <label for="">Select a Conversion Option</label><br>
        <select class="" name="Distance" required>
          
          <option value="Centimeter to Inch">Centimeter to Inch</option>
          <option value="Centimeter to Milimetre">Centimeter to Milimetre</option>
          <option value="Milimetre to Centimeter">Milimetre to Centimeter</option>
          <option value="Micrometres to Meter">Micrometres to Meter</option>
          <option value="Meter to Micrometres">Meter to Micrometres</option>
          

        </select>
        <input id="amount" type="text" name="amount" value="" placeholder="Enter a Value" required><br>
        <h3>
          <?php

            if (isset($_POST['convert'])) {
              $amount=$_POST['amount'];
              $option=$_POST['Distance'];

              
              if ($option=='Centimeter to Inch') {
                $result=$amount/2.54;
                echo $amount." Centimeter = ".$result." Inch";
              }
              if ($option=='Centimeter to Milimetre') {
                $result=$amount*10;
                echo $amount." Centimeter = ".$result." Milimetre";
              }
              if ($option=='Milimetre to Centimeter') {
                $result=$amount/10;
                echo $amount." Milimetre = ".$result." Centimeter";
              }
              if ($option=='Micrometres to Meter') {
                $result=$amount/1e+6;
                echo $amount." Micrometres = ".$result." Meter";
              }
              if ($option=='Meter to Micrometres') {
                $result=$amount*1e+6;
                echo $amount." Meter = ".$result." Micrometres";
             
              }

            }else {
              echo "Choose a Conversion Option";
            }


           ?>
        </h3>

        <input id="convert" type="submit" name="convert" value="Convert">

      </form>

    </div>


    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" autocomplete="off" method="POST">

      <select name="selection">

      <?php
        $readData = read();
        $arr1 = json_decode($readData);
        session_start();

        for($i = 0; $i < count($arr1); $i++) {
          $decode = $arr1[$i];
          $str1 = $str2 = "";

          if(isset($_SESSION["selection"])) {
            if($decode->from === $_SESSION['selection']) {
              $str1 = "selected";
            }
            if($decode->to === $_SESSION['selection']) {
              $str2 = "selected";
            }
          }
          else {
            $str1 = $decode->from;
          }

          echo "<option value=" . $decode->from . " " . $str1 . ">" . $decode->from . " to " . $decode->to . "</option>";
          echo "<option value=" . $decode->to . " " . $str2 . ">" . $decode->to . " to " . $decode->from . "</option>";
        }
      ?>



      </select>
      <br><br>
      <label for="value">Value: </label>
      <input type="number" name="value" value="<?php echo $input; ?>">
      <br><br>
      <button type="submit">Convert</button>
    </form>
    <br>
    <label for="result">Result: </label>
    <input type="number" name="result" value="<?php echo $result; ?>" disabled>

<input type="submit" name="submit"> &nbsp;&nbsp;

  </body>
</html>