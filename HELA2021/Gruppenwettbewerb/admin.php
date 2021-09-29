<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Wettbewerb</title>
    <link rel="Stylesheet" href="style.css">
    <link rel="Stylesheet" href="admin.css">
</head>
<body>
  <div id="Header">
    <nav>
      <ul>
        <li>
          <a href="/">Home</a>
        </li>
        <li>
          <a class="Current" href="#">Admin</a>
        </li>
      </ul>
    </nav>
  </div>
  <div id="content">
    <form id="form" action="safe.php" method="post">
      <div id="gruppenwahl">
        <label id="wahl">Gruppenauswahl:</label>
        <?php
          $myfile = fopen("./values.json", "r") or die("Unable to open file!");
          $json_str = fread($myfile, filesize("values.json"));
          fclose($myfile);
          $json = json_decode(preg_replace('/(\r|\n|\s)+/m', ' ', $json_str));

          foreach($json as $key => $val) {
            ?>
            <div id="wahl-wrapper">
              <input type="radio" id="html" name="gruppenwahl" value="<?php echo($key);?>">
              <label for="<?php echo($key); ?>"><?php echo($key); ?></label>
            </div>
        <?php
          }
        ?>
      </div>
      <div id="elements">
        <div id="element-wrapper">
          <label for="fname">Datum:</label>
          <input type="date" id="start" name="date" value="2021-10-10" min="2021-10-09" max="2021-10-17">
        </div>
        <div id="element-wrapper">
          <label for="points">Punkte:</label>
          <input type="number" id="points" name="points">
        </div>
      </div>
      <div id="button-wrapper">
        <input type="submit" value="Speichern">
      </div>
    </form>
  </div>
</body>
</html>